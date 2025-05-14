<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background: #f9f9f9; }
        h1 { text-align: center; padding-top: 30px; }
        .menu-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 50px;
        }
        .menu-item {
            width: 120px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
            transition: 0.3s;
            background: #fff;
            text-decoration: none;
            color: #333;
        }
        .menu-item:hover {
            background: #e0e0e0;
        }
        .menu-item img {
            width: 64px;
            height: 64px;
        }
        .kamar-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .kamar-item {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            width: 200px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .kamar-item h4 {
            font-size: 1.1em;
            margin-bottom: 10px;
        }
        .kamar-item p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<h1>Dashboard</h1>

<?php
$role = session()->get('user')['role']; // Ambil role dari session
?>

<?php if ($role === 'admin'): ?>
    <div class="menu-container">
        <a href="<?= base_url('transaksi') ?>" class="menu-item">
            <img src="<?= base_url('icons/data_transaksi.png') ?>" alt="Data Transaksi">
            <p>Data Transaksi</p>
        </a>
        <a href="<?= base_url('admin') ?>" class="menu-item">
            <img src="<?= base_url('icons/data_admin.png') ?>" alt="Data Admin">
            <p>Data Admin</p>
        </a>
        <a href="<?= base_url('customer') ?>" class="menu-item">
            <img src="<?= base_url('icons/data_customer.png') ?>" alt="Data Customer">
            <p>Data Customer</p>
        </a>
        <a href="<?= base_url('kamar') ?>" class="menu-item">
            <img src="<?= base_url('icons/data_kamar.png') ?>" alt="Data Kamar">
            <p>Data Kamar</p>
        </a>
    </div>

<?php elseif ($role === 'customer'): ?>
    <h2 style="text-align:center;">Kamar Tersedia</h2>
    <div class="kamar-list">
        <?php if (!empty($kamar)) : ?>
            <?php foreach ($kamar as $k) : ?>
                <div class="kamar-item">
                    <h4><?= esc($k['nama_kamar']) ?></h4>
                    <p>Harga: Rp<?= number_format($k['harga'], 0, ',', '.') ?></p>
                    <p>Status: <?= esc($k['status']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;">Tidak ada kamar tersedia.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

</body>
</html>
