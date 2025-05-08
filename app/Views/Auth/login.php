<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Informasi Kosan</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="login-container">
    <h2>Masuk ke Sistem Kosan</h2>

    <form method="post" action="/login" class="login-form">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Kata Sandi" required>

        <button type="submit">Masuk</button>

        <div class="login-options">
            <a href="/register">Belum punya akun? Daftar</a>
            <hr>
            <a href="/google-login" class="google-login">Masuk dengan Google</a>
        </div>
    </form>
</div>

</body>
</html>
