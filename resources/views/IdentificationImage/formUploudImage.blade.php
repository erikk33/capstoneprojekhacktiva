<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Gambar Tanaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .main-container { max-width: 600px; margin-top: 50px; }
        .card-custom {
            padding: 2rem;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        .btn-custom { background-color: #28a745; border-color: #28a745; }
        .btn-custom:hover { background-color: #218838; border-color: #1e7e34; }
        .result-image { max-width: 100%; height: auto; border-radius: 8px; margin-bottom: 1rem; }
        .result-details ul { list-style-type: none; padding-left: 0; }
        .result-details li { background-color: #e9ecef; padding: 8px 12px; border-radius: 5px; margin-bottom: 5px; }
        .result-details li strong { color: #495057; }
    </style>
</head>
<body>
<div class="container">
    <div class="main-container mx-auto">

        @if (session('result'))
            @php $result = session('result'); @endphp
            <div class="card-custom text-center">
                <h3 class="mb-3">Hasil Identifikasi</h3>
                <img src="{{ asset('storage/' . $result['image_path']) }}" alt="Gambar yang diidentifikasi" class="result-image">

                @if ($result['label'] !== 'Tidak dapat diidentifikasi')
                    <div class="alert alert-success text-start result-details">
                        <ul>
                            <li><strong>Nama:</strong> {{ $result['label'] }}</li>
                            <li><strong>Tingkat Kepercayaan:</strong> {{ number_format($result['score'] * 100, 1) }}%</li>
                            @if ($result['details'])
                                @if(isset($result['details']['family']))
                                    <li><strong>Famili:</strong> {{ $result['details']['family'] }}</li>
                                @endif
                                @if(isset($result['details']['genus']))
                                    <li><strong>Genus:</strong> {{ $result['details']['genus'] }}</li>
                                @endif
                            @else
                                <li><em>Detail tambahan tidak ditemukan.</em></li>
                            @endif
                        </ul>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <strong>{{ $result['label'] }}</strong>
                        <p class="mb-0">Model tidak dapat mengenali gambar ini. Coba lagi dengan gambar yang lebih jelas.</p>
                    </div>
                @endif
                <hr>
                <a href="{{ route('identification.form') }}" class="btn btn-secondary">Coba Gambar Lain</a>
            </div>
        @endif


        <div class="card-custom">
            <h1 class="text-center">Asisten Tani Bali</h1>
            <p class="text-center text-muted mb-4">Unggah foto tanaman atau hama untuk identifikasi.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('identification.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Pilih Gambar</label>
                    <input class="form-control" type="file" id="image" name="image" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom btn-lg text-white">Identifikasi Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
