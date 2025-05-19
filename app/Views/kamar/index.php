<!-- app/Views/kamar/index.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Data Kamar Kos</title>
</head>

<body>
    <h2>Daftar Kamar</h2>
    <a href="/kamar/create">+ Tambah Kamar Baru</a>
    <br><br>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($kamars)): ?>
                <?php foreach ($kamars as $kamar): ?>
                    <tr>
                        <td><?= esc($kamar['nama_kamar']) ?></td>
                        <td>Rp <?= number_format($kamar['harga'], 0, ',', '.') ?></td>
                        <td><?= esc($kamar['deskripsi']) ?></td>
                        <td>
                            <?php if ($kamar['foto']): ?>
                                <img src="/uploads/<?= esc($kamar['foto']) ?>" width="100">
                            <?php else: ?>
                                Tidak ada foto
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/kamar/edit/<?= $kamar['id'] ?>">Edit</a> |
                            <a href="/kamar/delete/<?= $kamar['id'] ?>" onclick="return confirm('Yakin ingin menghapus kamar ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Belum ada data kamar.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>