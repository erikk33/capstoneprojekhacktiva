<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\UserInteraction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserHomeController extends Controller
{
    public function index()
    {
        // Ambil produk dengan kategori dan urutkan dari yang terbaru
        $featuredProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Format harga untuk JavaScript
        $productsForJs = $featuredProducts->mapWithKeys(function ($product) {
            return [$product->id => [
                'title' => $product->name,
                'price' => '$' . number_format($product->price, 2),
                'description' => $product->description,
                'image' => $product->image_path ? asset('storage/' . $product->image_path) : asset('images/default-product.jpg')
            ]];
        });

        // Ambil produk rekomendasi berdasarkan riwayat pembelian user
        $recommendedProducts = collect();

        if (Auth::check()) {
            $userId = Auth::id();

            // Ambil produk yang paling sering dibeli oleh user
            $recommendedProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->whereHas('order', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->groupBy('product_id')
                ->orderBy('total_quantity', 'desc')
                ->take(5) // Ambil 5 produk teratas
                ->with('product.category')
                ->get()
                ->pluck('product')
                ->filter();

            // Simpan interaksi rekomendasi
            foreach ($recommendedProducts as $product) {
                try {
                    UserInteraction::create([
                        'user_id' => $userId,
                        'interaction_type' => 'recommendation_shown',
                        'product_id' => $product->id,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to save user interaction: ' . $e->getMessage());
                }
            }
        }

        // Jika tidak ada rekomendasi, ambil produk terpopuler
        if ($recommendedProducts->isEmpty()) {
            $recommendedProducts = Product::with('category')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('userMainPage.userHomePage', [
            'featuredProducts' => $featuredProducts,
            'recommendedProducts' => $recommendedProducts,
            'productsForJs' => $productsForJs
        ]);
    }
}