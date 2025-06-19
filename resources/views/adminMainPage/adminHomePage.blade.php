<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Toko erik's</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('style/adminPage.css') }}">
</head>
<style>
    /*STYLE HALAMAN ADMIN HOMEPAGE*/
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --danger: #f72585;
        --warning: #fca311;
        --info: #4895ef;
        --dark: #2b2d42;
        --light: #f8f9fa;
        --gray: #8d99ae;
        --sidebar-width: 250px;
        --header-height: 70px;
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f5f7fb;
        color: var(--dark);
        display: flex;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Sidebar */
    .sidebar {
        width: var(--sidebar-width);
        background: linear-gradient(180deg, var(--primary), var(--secondary));
        color: white;
        height: 100vh;
        position: fixed;
        transition: var(--transition);
        z-index: 100;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .logo {
        padding: 20px 15px;
        height: var(--header-height);
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logo h2 {
        font-size: 1.4rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .logo img {
        height: 40px;
    }

    .sidebar-menu {
        padding: 20px 0;
    }

    .menu-item {
        padding: 12px 20px;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: var(--transition);
        border-left: 4px solid transparent;
    }

    .menu-item:hover,
    .menu-item.active {
        background: rgba(255, 255, 255, 0.1);
        border-left: 4px solid white;
    }

    .menu-item i {
        margin-right: 12px;
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
    }

    .menu-text {
        font-size: 1rem;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: var(--transition);
    }

    /* Header */
    .header {
        height: var(--header-height);
        background: white;
        padding: 0 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 99;
    }

    .header-left h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark);
    }

    .header-right {
        display: flex;
        align-items: center;
    }

    .search-box {
        position: relative;
        margin-right: 20px;
    }

    .search-box input {
        padding: 8px 15px 8px 40px;
        border-radius: 30px;
        border: 1px solid #e0e0e0;
        outline: none;
        width: 250px;
        transition: var(--transition);
    }

    .search-box input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }

    .user-profile {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .user-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }

    .user-name {
        font-weight: 500;
    }

    /* Content Area */
    .content {
        padding: 25px;
    }

    .page-title {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: var(--dark);
        display: flex;
        align-items: center;
    }

    .page-title i {
        margin-right: 10px;
        color: var(--primary);
    }

    /* Dashboard Stats */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: var(--primary);
    }

    .stat-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .sales .stat-icon {
        background: var(--success);
    }

    .orders .stat-icon {
        background: var(--warning);
    }

    .users .stat-icon {
        background: var(--info);
    }

    .products .stat-icon {
        background: var(--danger);
    }

    .stat-title {
        font-size: 0.9rem;
        color: var(--gray);
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: var(--dark);
    }

    .stat-change {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .change-up {
        color: #2ecc71;
    }

    .change-down {
        color: #e74c3c;
    }

    /* Charts Row */
    .charts-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
    }

    .chart-actions {
        display: flex;
    }

    .chart-action {
        background: #f5f7fb;
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 0.85rem;
        margin-left: 10px;
        cursor: pointer;
        transition: var(--transition);
    }

    .chart-action:hover {
        background: var(--primary);
        color: white;
    }

    .chart-container {
        height: 300px;
        position: relative;
    }

    /* Tables */
    .table-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .table-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
    }

    .table-actions {
        display: flex;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        display: flex;
        align-items: center;
    }

    .btn i {
        margin-right: 8px;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--secondary);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
        margin-left: 10px;
    }

    .btn-outline:hover {
        background: var(--primary);
        color: white;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #f5f7fb;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    th {
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
        color: var(--gray);
        font-size: 0.9rem;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        color: var(--dark);
    }

    tr:hover td {
        background: #f9fbfd;
    }

    .status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
    }

    .status-pending {
        background: #fff8e1;
        color: #ff9800;
    }

    .status-processing {
        background: #e3f2fd;
        color: #2196f3;
    }

    .status-shipped {
        background: #e8f5e9;
        color: #4caf50;
    }

    .status-completed {
        background: #e0f7fa;
        color: #00bcd4;
    }

    .action-btn {
        padding: 5px 10px;
        border-radius: 6px;
        background: #f5f7fb;
        color: var(--dark);
        cursor: pointer;
        transition: var(--transition);
        border: none;
        margin-right: 5px;
    }

    .action-btn:hover {
        background: var(--primary);
        color: white;
    }

    /* AI Recommendation Section */
    .ai-section {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .ai-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .ai-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
    }

    .ai-controls {
        display: flex;
        gap: 10px;
    }

    .ai-toggle {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .ai-toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .ai-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 24px;
    }

    .ai-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.ai-slider {
        background-color: var(--success);
    }

    input:checked+.ai-slider:before {
        transform: translateX(26px);
    }

    .ai-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .ai-metrics,
    .ai-products {
        background: #f9fbfd;
        border-radius: 8px;
        padding: 15px;
        border: 1px solid #eee;
    }

    .ai-metric {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .ai-metric:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .metric-label {
        font-size: 0.9rem;
        color: var(--gray);
        margin-bottom: 5px;
    }

    .metric-value {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
    }

    .ai-product {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .ai-product:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .ai-product-img {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: var(--gray);
    }

    .ai-product-info {
        flex: 1;
    }

    .ai-product-name {
        font-weight: 500;
        margin-bottom: 3px;
    }

    .ai-product-stats {
        font-size: 0.85rem;
        color: var(--gray);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .modal-header {
        padding: 15px 20px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 1.4rem;
    }

    .close-modal {
        font-size: 1.5rem;
        cursor: pointer;
        transition: var(--transition);
    }

    .close-modal:hover {
        transform: scale(1.1);
    }

    .modal-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 20px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .charts-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 992px) {
        .sidebar {
            width: 70px;
        }

        .sidebar .menu-text,
        .logo h2 {
            display: none;
        }

        .logo {
            justify-content: center;
        }

        .main-content {
            margin-left: 70px;
        }

        .menu-item {
            justify-content: center;
            border-left: none;
        }

        .menu-item i {
            margin-right: 0;
            font-size: 1.4rem;
        }

        .menu-item.active {
            border-left: none;
            position: relative;
        }

        .menu-item.active::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: white;
        }
    }

    @media (max-width: 768px) {
        .header {
            padding: 0 15px;
        }

        .search-box input {
            width: 150px;
        }

        .user-name {
            display: none;
        }

        .content {
            padding: 15px;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }

        .ai-content {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .table-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .table-actions {
            margin-top: 10px;
            width: 100%;
        }

        .table-actions .btn {
            width: 100%;
            margin-bottom: 10px;
            margin-left: 0;
            justify-content: center;
        }

        .chart-actions {
            display: none;
        }

        .modal-content {
            width: 95%;
        }

        .form-actions {
            flex-direction: column;
            gap: 10px;
        }

        .form-actions .btn {
            width: 100%;
            margin-left: 0;
        }
    }

    /*==========================*/
</style>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-circle-user"></i>
            <h2>Toko erik's</h2>
        </div>
        <div class="sidebar-menu">
            <div class="menu-item active" data-page="dashboard">
                <i class="fas fa-home"></i>
                <span class="menu-text">Dashboard</span>
            </div>
            <div class="menu-item" data-page="products">
                <i class="fas fa-box"></i>
                <span class="menu-text">Produk</span>
            </div>
            <div class="menu-item" data-page="category">
                <i class="fas fa-tags"></i>
                <span class="menu-text">Kategori</span>
            </div>
            <div class="menu-item" data-page="users">
                <i class="fas fa-users"></i>
                <span class="menu-text">Pengguna</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <span class="menu-text">Pesanan</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-chart-line"></i>
                <span class="menu-text">Analitik AI</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-cog"></i>
                <span class="menu-text">Pengaturan</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>Dashboard Admin</h1>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari...">
                </div>
                <div class="user-profile">
                    <div class="user-img">AM</div>
                    <div class="user-name">Admin Manager</div>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="content dashboard-content">
            <h1 class="page-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card sales">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-title">Total Penjualan</div>
                    <div class="stat-value">Rp 25.450.000</div>
                    <div class="stat-change change-up">
                        <i class="fas fa-arrow-up"></i> 12.5% dari bulan lalu
                    </div>
                </div>

                <div class="stat-card orders">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-title">Pesanan Baru</div>
                    <div class="stat-value">42</div>
                    <div class="stat-change change-up">
                        <i class="fas fa-arrow-up"></i> 8.2% dari minggu lalu
                    </div>
                </div>

                <div class="stat-card users">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-title">Pengguna Baru</div>
                    <div class="stat-value">28</div>
                    <div class="stat-change change-up">
                        <i class="fas fa-arrow-up"></i> 5.3% dari kemarin
                    </div>
                </div>

                <div class="stat-card products">
                    <div class="stat-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="stat-title">Produk Stok Rendah</div>
                    <div class="stat-value">7</div>
                    <div class="stat-change change-down">
                        <i class="fas fa-arrow-down"></i> Perlu restok segera
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="charts-row">
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">Statistik Penjualan (30 Hari Terakhir)</div>
                        <div class="chart-actions">
                            <div class="chart-action">Harian</div>
                            <div class="chart-action active">Mingguan</div>
                            <div class="chart-action">Bulanan</div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">Distribusi Kategori Produk</div>
                        <div class="chart-actions">
                            <div class="chart-action active">2025</div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- AI Recommendation Section -->
            <div class="ai-section">
                <div class="ai-header">
                    <div class="ai-title">Sistem Rekomendasi AI</div>
                    <div class="ai-controls">
                        <label class="ai-toggle">
                            <input type="checkbox" checked>
                            <span class="ai-slider"></span>
                        </label>
                        <button class="btn btn-outline"><i class="fas fa-sync"></i> Refresh</button>
                    </div>
                </div>
                <div class="ai-content">
                    <div class="ai-metrics">
                        <div class="ai-metric">
                            <div class="metric-label">Akurasi Rekomendasi</div>
                            <div class="metric-value">92.7%</div>
                        </div>
                        <div class="ai-metric">
                            <div class="metric-label">Konversi Penjualan</div>
                            <div class="metric-value">18.4%</div>
                        </div>
                        <div class="ai-metric">
                            <div class="metric-label">Pengguna Aktif Harian</div>
                            <div class="metric-value">1,248</div>
                        </div>
                        <div class="ai-metric">
                            <div class="metric-label">Waktu Pemrosesan</div>
                            <div class="metric-value">0.42 detik</div>
                        </div>
                    </div>
                    <div class="ai-products">
                        <h3>Produk Direkomendasikan AI</h3>
                        <div class="ai-product">
                            <div class="ai-product-img">
                                <i class="fas fa-shoe-prints"></i>
                            </div>
                            <div class="ai-product-info">
                                <div class="ai-product-name">Sepatu Lari X-Trail</div>
                                <div class="ai-product-stats">+142% kenaikan klik | 78% konversi</div>
                            </div>
                        </div>
                        <div class="ai-product">
                            <div class="ai-product-img">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div class="ai-product-info">
                                <div class="ai-product-name">Kaos Olahraga DryFit</div>
                                <div class="ai-product-stats">+98% kenaikan klik | 65% konversi</div>
                            </div>
                        </div>
                        <div class="ai-product">
                            <div class="ai-product-img">
                                <i class="fas fa-socks"></i>
                            </div>
                            <div class="ai-product-info">
                                <div class="ai-product-name">Kaus Kaki Sport</div>
                                <div class="ai-product-stats">+85% kenaikan klik | 72% konversi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="table-card">
                <div class="table-header">
                    <div class="table-title">Produk Terlaris</div>
                    <div class="table-actions">
                        <button class="btn btn-primary" id="addProductBtn"><i class="fas fa-plus"></i> Tambah
                            Produk</button>
                        <button class="btn btn-outline"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Terjual</th>
                                <th>Stok</th>
                                <th>Rating</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sepatu Lari X-Trail</td>
                                <td>Sepatu Olahraga</td>
                                <td>Rp 450.000</td>
                                <td>142</td>
                                <td>23</td>
                                <td><i class="fas fa-star text-warning"></i> 4.8</td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Kaos Olahraga DryFit</td>
                                <td>Pakaian</td>
                                <td>Rp 120.000</td>
                                <td>98</td>
                                <td>15</td>
                                <td><i class="fas fa-star text-warning"></i> 4.6</td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Sepatu Kasual Urban</td>
                                <td>Sepatu Kasual</td>
                                <td>Rp 350.000</td>
                                <td>87</td>
                                <td>7</td>
                                <td><i class="fas fa-star text-warning"></i> 4.7</td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tas Olahraga Multifungsi</td>
                                <td>Aksesoris</td>
                                <td>Rp 250.000</td>
                                <td>76</td>
                                <td>12</td>
                                <td><i class="fas fa-star text-warning"></i> 4.5</td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Sepatu Basket Pro</td>
                                <td>Sepatu Olahraga</td>
                                <td>Rp 620.000</td>
                                <td>65</td>
                                <td>5</td>
                                <td><i class="fas fa-star text-warning"></i> 4.9</td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-card">
                <div class="table-header">
                    <div class="table-title">Pesanan Terbaru</div>
                    <div class="table-actions">
                        <button class="btn btn-primary"><i class="fas fa-sync"></i> Refresh</button>
                        <button class="btn btn-outline"><i class="fas fa-download"></i> Ekspor</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#KMU-2025-00128</td>
                                <td>Budi Santoso</td>
                                <td>15 Jun 2025</td>
                                <td>Rp 1.250.000</td>
                                <td><span class="status status-processing">Processing</span></td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#KMU-2025-00127</td>
                                <td>Ani Rahayu</td>
                                <td>14 Jun 2025</td>
                                <td>Rp 980.000</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#KMU-2025-00126</td>
                                <td>Dewi Kurnia</td>
                                <td>14 Jun 2025</td>
                                <td>Rp 2.150.000</td>
                                <td><span class="status status-shipped">Shipped</span></td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#KMU-2025-00125</td>
                                <td>Rudi Hermawan</td>
                                <td>13 Jun 2025</td>
                                <td>Rp 750.000</td>
                                <td><span class="status status-completed">Completed</span></td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#KMU-2025-00124</td>
                                <td>Citra Wijaya</td>
                                <td>12 Jun 2025</td>
                                <td>Rp 1.620.000</td>
                                <td><span class="status status-shipped">Shipped</span></td>
                                <td>
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--BAGIAN HALAMAN PRODUCT-->
        <!-- Products Content -->
        <div class="content products-content" style="display: none;">
            <h1 class="page-title"><i class="fas fa-box"></i> Manajemen Produk</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-card">
                <div class="table-header">
                    <div class="table-title">Daftar Produk</div>
                    <div class="table-actions">
                        <button class="btn btn-primary" id="addNewProductBtn">
                            <i class="fas fa-plus"></i> Tambah Produk Baru
                        </button>
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
                                <th>Description</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <!-- Di dalam tabel produk -->
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if ($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}"
                                                alt="{{ $product->name }}" style="max-width: 50px; max-height: 50px;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="action-btn edit-btn" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-category_id="{{ $product->category_id }}"
                                            data-price="{{ $product->price }}" data-stock="{{ $product->stock }}"
                                            data-description="{{ $product->description }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete-btn" data-id="{{ $product->id }}">
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
        <!--bagian halaman categori--->
        <!-- category Content -->
        <x-adminComponent.categories-page :categori="$categori" />

        <!-- Users Content -->
        <x-adminComponent.show-list-user :users="$users" />
    </div>

    <!-- Modal Tambah Produk -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tambah Produk Baru</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="productForm" action="{{ route('admin.products.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="productName">Nama Produk</label>
                        <input type="text" id="productName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Kategori</label>
                        <select id="productCategory" name="category_id" required>
                            @foreach ($categori as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Harga (Rp)</label>
                        <input type="number" id="productPrice" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="productStock">Stok</label>
                        <input type="number" id="productStock" name="stock" required>
                    </div>
                    <!-- TAMBAHKAN INPUT GAMBAR -->
                    <div class="form-group">
                        <label for="productImage">Gambar Produk</label>
                        <input type="file" id="productImage" name="image" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Deskripsi</label>
                        <textarea id="productDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="cancelAddProduct" class="btn btn-outline">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Edit Produk -->
    <!-- Modal Edit Produk -->
    <div id="editProductModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Produk</h2>
                <span class="close-edit-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editProductForm" action="{{ route('admin.products.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editProductId">
                    <div class="form-group">
                        <label for="editProductName">Nama Produk</label>
                        <input type="text" id="editProductName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editProductCategory">Kategori</label>
                        <select id="editProductCategory" name="category_id" required>
                            @foreach ($categori as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editProductPrice">Harga (Rp)</label>
                        <input type="number" id="editProductPrice" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="editProductStock">Stok</label>
                        <input type="number" id="editProductStock" name="stock" required>
                    </div>
                    <!-- TAMBAHKAN INPUT GAMBAR UNTUK EDIT -->
                    <div class="form-group">
                        <label for="editProductImage">Gambar Produk</label>
                        <input type="file" id="editProductImage" name="image" accept="image/*">
                        <small>Biarkan kosong jika tidak ingin mengubah gambar</small>
                    </div>
                    <div class="form-group">
                        <label for="editProductDescription">Deskripsi</label>
                        <textarea id="editProductDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="cancelEditProduct" class="btn btn-outline">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Kategori -->
    <!-- Modal Tambah Kategori -->
    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tambah Kategori Baru</h2>
                <span class="close-category-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">Nama Kategori</label>
                        <input type="text" id="categoryName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="categorySlug">Slug</label>
                        <input type="text" id="categorySlug" name="slug">
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription">Deskripsi</label>
                        <textarea id="categoryDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="cancelAddCategory" class="btn btn-outline">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <script>
        // Inisialisasi data produk
        const products = [{
                id: 1,
                name: "Sepatu Lari X-Trail",
                category: "Sepatu Olahraga",
                price: 450000,
                stock: 23,
                status: "Aktif"
            },
            {
                id: 2,
                name: "Kaos Olahraga DryFit",
                category: "Pakaian",
                price: 120000,
                stock: 15,
                status: "Aktif"
            },
            {
                id: 3,
                name: "Sepatu Kasual Urban",
                category: "Sepatu Kasual",
                price: 350000,
                stock: 7,
                status: "Stok Rendah"
            },
            {
                id: 4,
                name: "Tas Olahraga Multifungsi",
                category: "Aksesoris",
                price: 250000,
                stock: 12,
                status: "Aktif"
            },
            {
                id: 5,
                name: "Sepatu Basket Pro",
                category: "Sepatu Olahraga",
                price: 620000,
                stock: 5,
                status: "Stok Rendah"
            }
        ];

        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['1 Jun', '5 Jun', '10 Jun', '15 Jun', '20 Jun', '25 Jun', '30 Jun'],
                datasets: [{
                    label: 'Pendapatan (juta Rp)',
                    data: [3.2, 5.1, 4.7, 6.8, 7.5, 8.2, 9.1],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#4361ee',
                    pointRadius: 5,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Sepatu Olahraga', 'Sepatu Kasual', 'Pakaian', 'Aksesoris', 'Lainnya'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        '#4361ee',
                        '#4cc9f0',
                        '#f72585',
                        '#3a0ca3',
                        '#7209b7'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                },
                cutout: '70%'
            }
        });

        // Menu item click event
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelector('.menu-item.active').classList.remove('active');
                this.classList.add('active');

                // Update page content
                const page = this.getAttribute('data-page');
                if (page === 'dashboard') {
                    document.querySelector('.dashboard-content').style.display = 'block';
                    document.querySelector('.products-content').style.display = 'none';
                    document.querySelector('.header-left h1').textContent = 'Dashboard Admin';
                    document.querySelector('.kategori-content').style.display = 'none';
                } else if (page === 'products') {
                    document.querySelector('.dashboard-content').style.display = 'none';
                    document.querySelector('.products-content').style.display = 'block';
                    document.querySelector('.header-left h1').textContent = 'Manajemen Produk';
                    document.querySelector('.kategori-content').style.display = 'none';
                } else if (page == 'category') {
                    document.querySelector('.dashboard-content').style.display = 'none';
                    document.querySelector('.products-content').style.display = 'none';
                    document.querySelector('.header-left h1').textContent = 'Manajemen Produk';
                    document.querySelector('.kategori-content').style.display = 'block';
                }
                // Di dalam menu item click event
                else if (page == 'users') {
                    document.querySelector('.dashboard-content').style.display = 'none';
                    document.querySelector('.products-content').style.display = 'none';
                    document.querySelector('.kategori-content').style.display = 'none';
                    document.querySelector('.users-content').style.display = 'block';
                    document.querySelector('.header-left h1').textContent = 'Manajemen Pengguna';
                }
            });
        });

        // Chart action buttons
        document.querySelectorAll('.chart-action').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelector('.chart-action.active').classList.remove('active');
                this.classList.add('active');
            });
        });

        // Modal functionality
        const modal = document.getElementById("addProductModal");
        const addProductBtn = document.getElementById("addProductBtn");
        const addNewProductBtn = document.getElementById("addNewProductBtn");
        const closeModal = document.querySelector(".close-modal");
        const cancelBtn = document.getElementById("cancelAddProduct");

        // Open modal from dashboard
        if (addProductBtn) {
            addProductBtn.addEventListener('click', () => {
                modal.style.display = "flex";
            });
        }

        // Open modal from products page
        if (addNewProductBtn) {
            addNewProductBtn.addEventListener('click', () => {
                modal.style.display = "flex";
            });
        }

        // Close modal
        closeModal.addEventListener('click', () => {
            modal.style.display = "none";
        });

        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                modal.style.display = "none";
            });
        }

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });

        // Edit Product Modal
        const editModal = document.getElementById("editProductModal");
        const editButtons = document.querySelectorAll(".edit-btn");
        const closeEditModal = document.querySelector(".close-edit-modal");
        const cancelEditBtn = document.getElementById("cancelEditProduct");

        // Open edit modal and populate data
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const productName = this.getAttribute('data-name');
                const categoryId = this.getAttribute('data-category_id');
                const price = this.getAttribute('data-price');
                const stock = this.getAttribute('data-stock');
                const description = this.getAttribute('data-description');

                document.getElementById('editProductId').value = productId;
                document.getElementById('editProductName').value = productName;
                document.getElementById('editProductCategory').value = categoryId;
                document.getElementById('editProductPrice').value = price;
                document.getElementById('editProductStock').value = stock;
                document.getElementById('editProductDescription').value = description;

                editModal.style.display = "flex";
            });
        });

        // Close edit modal
        closeEditModal.addEventListener('click', () => {
            editModal.style.display = "none";
        });

        if (cancelEditBtn) {
            cancelEditBtn.addEventListener('click', () => {
                editModal.style.display = "none";
            });
        }

        // Delete product
        const deleteButtons = document.querySelectorAll(".delete-btn");
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                    // Kirim request delete
                    const formData = new FormData();
                    formData.append('id', productId);
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'DELETE');

                    fetch("{{ route('admin.products.destroy') }}", {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Network response was not ok.');
                        })
                        .then(data => {
                            if (data.success) {
                                alert('Produk berhasil dihapus');
                                location.reload();
                            } else {
                                alert('Gagal menghapus produk: ' + (data.message || ''));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus produk');
                        });
                }
            });
        });

        // Form submission
        document.getElementById("productForm")?.addEventListener("submit", async function(e) {
            e.preventDefault();

            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    alert("Produk berhasil ditambahkan!");
                    modal.style.display = "none";
                    // Refresh halaman jika di products page
                    if (document.querySelector('.products-content').style.display === 'block') {
                        location.reload();
                    }
                } else {
                    const result = await response.json();
                    alert(`Error: ${result.message}`);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menambahkan produk');
            }
        });


        // Product search functionality
        document.getElementById("productSearch").addEventListener("input", function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll("#productsTable tbody tr");

            rows.forEach(row => {
                const productName = row.cells[0].textContent.toLowerCase();
                row.style.display = productName.includes(searchTerm) ? "" : "none";
            });
        });

        // Edit Category Modal
        const editCategoryModal = document.getElementById("editCategoryModal");
        const editCategoryButtons = document.querySelectorAll(".edit-category-btn");
        const closeEditCategoryModal = document.querySelector(".close-edit-category-modal");
        const cancelEditCategoryBtn = document.getElementById("cancelEditCategory");

        // Open edit modal and populate data
        editCategoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');
                const categorySlug = this.getAttribute('data-slug');
                const categoryDescription = this.getAttribute('data-description');

                document.getElementById('editCategoryId').value = categoryId;
                document.getElementById('editCategoryName').value = categoryName;
                document.getElementById('editCategorySlug').value = categorySlug;
                document.getElementById('editCategoryDescription').value = categoryDescription;

                editCategoryModal.style.display = "flex";
            });
        });

        // Close edit modal
        closeEditCategoryModal.addEventListener('click', () => {
            editCategoryModal.style.display = "none";
        });

        if (cancelEditCategoryBtn) {
            cancelEditCategoryBtn.addEventListener('click', () => {
                editCategoryModal.style.display = "none";
            });
        }

        // Delete category
        const deleteCategoryButtons = document.querySelectorAll(".delete-category-btn");
        deleteCategoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');
                if (confirm(`Apakah Anda yakin ingin menghapus kategori "${categoryName}"?`)) {
                    // Kirim request delete
                    const formData = new FormData();
                    formData.append('id', categoryId);
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'DELETE');

                    fetch("{{ route('admin.categories.destroy') }}", {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Network response was not ok.');
                        })
                        .then(data => {
                            if (data.success) {
                                alert('Kategori berhasil dihapus');
                                location.reload();
                            } else {
                                alert('Gagal menghapus kategori: ' + (data.message || ''));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus kategori');
                        });
                }
            });
        });

        // Mendapatkan elemen modal kategori
        const categoryModal = document.getElementById("addCategoryModal");
        const addNewCategoryBtn = document.getElementById("addNewCategoryBtn");
        const closeCategoryModal = document.querySelector(".close-category-modal");
        const cancelCategoryBtn = document.getElementById("cancelAddCategory");

        // Event untuk membuka modal kategori
        if (addNewCategoryBtn) {
            addNewCategoryBtn.addEventListener('click', () => {
                categoryModal.style.display = "flex";
            });
        }

        // Event untuk menutup modal kategori
        if (closeCategoryModal) {
            closeCategoryModal.addEventListener('click', () => {
                categoryModal.style.display = "none";
            });
        }

        if (cancelCategoryBtn) {
            cancelCategoryBtn.addEventListener('click', () => {
                categoryModal.style.display = "none";
            });
        }

        // Tutup modal kategori ketika klik di luar
        window.addEventListener('click', (e) => {
            if (e.target === categoryModal) {
                categoryModal.style.display = "none";
            }
        });



        // Pencarian kategori
        const categorySearchInput = document.getElementById("categorySearch");
        if (categorySearchInput) {
            categorySearchInput.addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll("#categoriesTable tbody tr");

                rows.forEach(row => {
                    const categoryName = row.cells[0].textContent.toLowerCase();
                    row.style.display = categoryName.includes(searchTerm) ? "" : "none";
                });
            });
        }

        // Tambahkan fungsi pencarian
        document.getElementById("userSearch")?.addEventListener("input", function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll("#usersTable tbody tr");

            rows.forEach(row => {
                const userName = row.cells[0].textContent.toLowerCase();
                const userEmail = row.cells[1].textContent.toLowerCase();
                const text = userName + " " + userEmail;
                row.style.display = text.includes(searchTerm) ? "" : "none";
            });
        });
    </script>
</body>

</html>
