<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Sistem Kosan</title>
    <link rel="stylesheet" href="/css/regis.css">
</head>
<body>

<div class="register-container">
    <h2>Daftar Akun Sistem Kosan</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <p class="error"><?= session()->getFlashdata('error') ?></p>
    <?php elseif (session()->getFlashdata('success')): ?>
        <p class="success"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <form method="post" action="/register" class="register-form">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Kata Sandi" required>

        <button type="submit">Daftar</button>

        <div class="register-options">
            <a href="/login">Sudah punya akun? Masuk di sini</a>
        </div>
    </form>
</div>

</body>
</html>
