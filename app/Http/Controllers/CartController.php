<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);

        // Cek apakah produk sudah ada di cart
        $existingIndex = null;
        foreach ($cart as $index => $item) {
            if ($item['product_id'] == $request->product_id) {
                $existingIndex = $index;
                break;
            }
        }

        if ($existingIndex !== null) {
            // Update quantity jika produk sudah ada
            $cart[$existingIndex]['quantity'] += $request->quantity;
        } else {
            // Tambahkan produk baru
            $cart[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image_path ? asset('storage/' . $product->image_path) : asset('images/default-product.jpg')
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', [
            'cartItems' => $cart,
            'total' => $total
        ]);
    }

    public function removeFromCart(Request $request, $index)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', array_values($cart)); // Reindex array
        }

        return back()->with('success', 'Product removed from cart');
    }
}