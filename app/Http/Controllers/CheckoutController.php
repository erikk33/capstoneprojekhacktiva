<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            $validItems = [];

            foreach ($cart as $item) {
                $product = Product::find($item['product_id']);

                if (!$product) {
                    continue;
                }

                $price = $product->price;
                $totalAmount += $price * $item['quantity'];

                $validItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                ];
            }

            if (empty($validItems)) {
                return back()->with('error', 'No valid products in your cart');
            }

            $orderNumber = 'ORD-' . strtoupper(Str::random(8)) . '-' . time();

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            foreach ($validItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('cart');

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Order placed successfully! Order Number: ' . $orderNumber);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            return back()->with('error', 'Failed to process order: ' . $e->getMessage());
        }
    }
}
