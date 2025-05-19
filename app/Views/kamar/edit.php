<!-- app/Views/kamar/edit.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Edit Kamar</title>
</head>

<body>
    <h2>Form Edit Kamar Kos</h2>
    <form action="/kamar/update/<?= $kamar['id'] ?>" method="post" enctype="multipart/form-data">
        <label>Nama Kamar:</label><br>
        <input type="text" name="nama_kamar" value="<?= esc($kamar['nama_kamar']) ?>" required><br><br>

        <label>Harga (Rp):</label><br>
        <input type="number" name="harga" value="<?= esc($kamar['harga']) ?>" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="4" cols="40" required><?= esc($kamar['deskripsi']) ?></textarea><br><br>

        <label>Foto Saat Ini:</label><br>
        <?php if ($kamar['foto']): ?>
            <img src="/uploads/<?= esc($kamar['foto']) ?>" width="120"><br>
        <?php else: ?>
            Tidak ada foto
        <?php endif; ?>
        <br>

        <label>Ganti Foto (jika perlu):</label><br>
        <input type="file" name="foto" accept="image/*"><br><br>

        <button type="submit">Update</button>
        <a href="/kamar">Batal</a>
    </form>
</body>

</html>