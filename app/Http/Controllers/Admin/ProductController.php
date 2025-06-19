<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function showAdminPage()
    {
        $products = Product::with('category')->get();
        $categori = Category::all();
        $users = User::select('id', 'fullName', 'email', 'created_at')->get(); // Tambahkan ini

        return view('adminMainPage.adminHomePage', compact('products','categori', 'users'));

    }
    /**
     * Menampilkan halaman manajemen produk dengan daftar produk.
     */
    // Menyimpan produk baru
    public function store(Request $request): RedirectResponse
{
    $storeData = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name'        => 'required|string|max:255',
        'slug'        => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('product_images', 'public');
        $storeData['image_path'] = $imagePath;
    }

    // Jika slug kosong, buat otomatis
    if (empty($storeData['slug'])) {
        $storeData['slug'] = Str::slug($storeData['name']);
    }

    Product::create($storeData);

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
}

public function update(Request $request): RedirectResponse
{
    $updateData = $request->validate([
        'id'          => 'required|exists:products,id',
        'category_id' => 'required|exists:categories,id',
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'description' => 'nullable|string',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    $product = Product::find($updateData['id']);

    // Handle image update
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $imagePath = $request->file('image')->store('product_images', 'public');
        $updateData['image_path'] = $imagePath;
    }

    $product->update($updateData);

    return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
}

      public function destroy(Request $request)
      {
          $request->validate([
              'id' => 'required|exists:products,id'
          ]);

          $product = Product::find($request->id);
          $product->delete();

          return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus!']);
      }







    public function simpanCategory(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'slug', 'description']);

        // Generate slug jika kosong
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        Category::create($data);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateCategory(Request $request): RedirectResponse
{
    $updateData = $request->validate([
        'id'          => 'required|exists:categories,id',
        'name'        => 'required|string|max:255',
        'slug'        => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ]);

    $category = Category::find($updateData['id']);

    // Jika slug kosong, buat otomatis
   // Jika slug kosong, buat otomatis
   if (empty($updateData['slug'])) {
    $updateData['slug'] = Str::slug($updateData['name']);
}

    $category->update($updateData);

    return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
}

// Hapus kategori
// Update method to handle AJAX responses
public function destroyCategory(Request $request)
{
    $id = $request->input('id');
    $category = Category::find($id);

    // Cek apakah ada produk yang menggunakan kategori ini
    if ($category->products()->count() > 0) {
        return response()->json([
            'success' => false,
            'message' => 'Kategori tidak bisa dihapus karena memiliki produk terkait!'
        ], 400);
    }

    $category->delete();

    return response()->json([
        'success' => true,
        'message' => 'Kategori berhasil dihapus!'
    ]);
}


 // Tambahkan method baru
 public function showUsers()
 {
     $users = User::select('id', 'fullName', 'email', 'created_at')->get();
     return view('adminMainPage.adminHomePage', compact('users'));
 }

}
