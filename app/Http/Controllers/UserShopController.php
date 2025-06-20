<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class UserShopController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $category = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort');

        // Query produk dengan filter
        $productsQuery = Product::query();

        // Filter kategori
        if ($category && $category !== 'All Products') {
            $productsQuery->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        // Filter harga
        if ($minPrice) {
            $productsQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $productsQuery->where('price', '<=', $maxPrice);
        }

        // Sorting
        switch ($sort) {
            case 'Price: Low to High':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'Price: High to Low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'Newest Arrivals':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'Best Selling':
                $productsQuery->withCount('orderItems')
                    ->orderBy('order_items_count', 'desc');
                break;
            default:
                $productsQuery->orderBy('created_at', 'desc');
        }

        // Pagination
        $products = $productsQuery->paginate(12);

        // Ambil semua kategori untuk tab
        $categories = Category::all()->pluck('name')->toArray();
        array_unshift($categories, 'All Products');

        return view('userShop', [
            'products' => $products,
            'categories' => $categories,
            'appliedFilters' => [
                'category' => $category,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'sort' => $sort,
            ]
        ]);
    }
}