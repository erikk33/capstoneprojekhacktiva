 <!-- Products Content -->
 <div class="content products-content" style="display: none;">
    <h1 class="page-title"><i class="fas fa-box"></i> Manajemen Produk</h1>

    <div class="table-card">
        <div class="table-header">
            <div class="table-title">Daftar Produk</div>
            <div class="table-actions">
                <button class="btn btn-primary" id="addNewProductBtn"><i class="fas fa-plus"></i> Tambah Produk Baru</button>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="productSearch" placeholder="Cari produk...">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="productsTable">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th> <!-- Kolom baru -->
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sepatu Lari X-Trail</td>
                        <td>Sepatu Olahraga</td>
                        <td>Rp 450.000</td>
                        <td>23</td>
                        <td><span class="status status-processing">Aktif</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Kaos Olahraga DryFit</td>
                        <td>Pakaian</td>
                        <td>Rp 120.000</td>
                        <td>15</td>
                        <td><span class="status status-processing">Aktif</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sepatu Kasual Urban</td>
                        <td>Sepatu Kasual</td>
                        <td>Rp 350.000</td>
                        <td>7</td>
                        <td><span class="status status-pending">Stok Rendah</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Tas Olahraga Multifungsi</td>
                        <td>Aksesoris</td>
                        <td>Rp 250.000</td>
                        <td>12</td>
                        <td><span class="status status-processing">Aktif</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sepatu Basket Pro</td>
                        <td>Sepatu Olahraga</td>
                        <td>Rp 620.000</td>
                        <td>5</td>
                        <td><span class="status status-pending">Stok Rendah</span></td>
                        <td>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Modal Tambah Produk -->
<div id="addProductModal" class="modal">
<div class="modal-content">
    <div class="modal-header">
        <h2>Tambah Produk Baru</h2>
        <span class="close-modal">&times;</span>
    </div>
    <div class="modal-body">
        <form id="productForm">
            <div class="form-group">
                <label for="productName">Nama Produk</label>
                <input type="text" id="productName" placeholder="Masukkan nama produk" required>
            </div>
            <div class="form-group">
                <label for="productCategory">Kategori</label>
                <select id="productCategory" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Sepatu Olahraga">Sepatu Olahraga</option>
                    <option value="Sepatu Kasual">Sepatu Kasual</option>
                    <option value="Pakaian">Pakaian</option>
                    <option value="Aksesoris">Aksesoris</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="form-group">
                <label for="productPrice">Harga (Rp)</label>
                <input type="number" id="productPrice" placeholder="Masukkan harga" required>
            </div>
            <div class="form-group">
                <label for="productStock">Stok</label>
                <input type="number" id="productStock" placeholder="Masukkan jumlah stok" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Deskripsi</label>
                <textarea id="productDescription" placeholder="Masukkan deskripsi produk" rows="3"></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-outline" id="cancelAddProduct">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
</div>