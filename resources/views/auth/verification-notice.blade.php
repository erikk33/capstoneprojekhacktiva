<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <x-bootstrap-installer />
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h3>Verifikasi Alamat Email Anda</h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>Sebelum melanjutkan, mohon periksa email Anda untuk link verifikasi.</p>
                        <p>Jika Anda tidak menerima email, Anda bisa meminta kirim ulang.</p>
                        {{-- (Fungsi kirim ulang bisa ditambahkan nanti) --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
