<!-- resources/views/components/categories-page.blade.php -->
<x-bootstrap-installer/>
@props(['categori'])

<div class="kategori-content" style="display: none;">
    <h1 class="page-title"><i class="fas fa-tags"></i> Manajemen Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-card">
        <div class="table-header">
            <div class="table-title">Daftar Kategori</div>
            <div class="table-actions">
                <button class="btn btn-primary" id="addNewCategoryBtn">
                    <i class="fas fa-plus"></i> Tambah Kategori Baru
                </button>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="categorySearch" placeholder="Cari kategori...">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="categoriesTable">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categori as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <button class="action-btn edit-category-btn"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}"
                                data-slug="{{ $category->slug }}"
                                data-description="{{ $category->description }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn delete-category-btn"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div id="editCategoryModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Kategori</h2>
            <span class="close-edit-category-modal">&times;</span>
        </div>
        <div class="modal-body">
            <form id="editCategoryForm" action="{{ route('admin.categories.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editCategoryId">
                <div class="form-group">
                    <label for="editCategoryName">Nama Kategori</label>
                    <input type="text" id="editCategoryName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="editCategorySlug">Slug</label>
                    <input type="text" id="editCategorySlug" name="slug">
                </div>
                <div class="form-group">
                    <label for="editCategoryDescription">Deskripsi</label>
                    <textarea id="editCategoryDescription" name="description" rows="3"></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" id="cancelEditCategory" class="btn btn-outline">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>