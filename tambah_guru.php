<!DOCTYPE html>
<html>
<head>
    <title>Tambah Guru</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Tambah Guru</h1>
    <br>
    <a class='table-link' href='index.html'>Kembali ke Menu Utama</a>
    <form action="proses_tambah_guru.php" method="POST">
        Nomor Induk: <input type="text" name="nomor_induk" required><br>
        Nama: <input type="text" name="nama" required><br>
        TTL: <input type="date" name="ttl"><br>
        Jenis Kelamin: <select name="jenis_kelamin">
            <option value="perempuan">Perempuan</option>
            <option value="laki-laki">Laki-laki</option>
        </select><br>
        Golongan: <input type="text" name="golongan"><br>
        Mapel: <input type="text" name="mapel"><br>
        Alamat: <textarea name="alamat"></textarea><br>
        Status: <select name="status">
            <option value="tetap">Tetap</option>
            <option value="honorer">Honorer</option>
        </select><br>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
