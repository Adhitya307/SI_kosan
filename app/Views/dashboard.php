<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    
    <p>Role Anda: <?= esc($role) ?></p>
    
    <!-- Jika role adalah admin, tampilkan opsi admin -->
    <?php if ($role === 'admin'): ?>
        <p>Anda adalah Admin. Anda memiliki akses penuh.</p>

    <?php elseif ($role === 'customer'): ?>
        <p>Anda adalah Customer. Anda dapat melihat produk dan memesan.</p>

    <?php else: ?>
        <p>Role tidak dikenali.</p>
    <?php endif; ?>

    <!-- Tombol Logout -->
    <form action="/logout" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
