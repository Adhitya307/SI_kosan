<!-- app/Views/kamar/create.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Kamar</title>
</head>

<body>
    <h2>Form Tambah Kamar Kos</h2>
    <form action="/kamar/store" method="post" enctype="multipart/form-data">
        <label>Nama Kamar:</label><br>
        <input type="text" name="nama_kamar" required><br><br>

        <label>Harga (Rp):</label><br>
        <input type="number" name="harga" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="4" cols="40" required></textarea><br><br>

        <label>Foto Kamar:</label><br>
        <input type="file" name="foto" accept="image/*"><br><br>

        <button type="submit">Simpan</button>
        <a href="/kamar">Kembali</a>
    </form>
</body>

</html>