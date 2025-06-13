<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email</title>
</head>
<body>
    <h2>Selamat datang, {{ $user->fullName }}!</h2>
    <p>Terima kasih telah mendaftar. Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.</p>
    <a href="{{ url('/verify/' . $user->verification_token) }}"
       style="background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
       Verifikasi Alamat Email
    </a>
    <p>Jika Anda tidak membuat akun ini, Anda bisa mengabaikan email ini.</p>
</body>
</html>
