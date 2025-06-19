<x-bootstrap-installer/>
@props(['users'])
       <!-- Users Content -->
       <div class="content users-content" style="display: none;">
        <h1 class="page-title"><i class="fas fa-users"></i> Manajemen Pengguna</h1>

        <div class="table-card">
            <div class="table-header">
                <div class="table-title">Daftar Pengguna</div>
                <div class="table-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="userSearch" placeholder="Cari pengguna...">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->fullName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                                <button class="action-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>