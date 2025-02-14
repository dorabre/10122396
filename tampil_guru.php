<!DOCTYPE html>
<html>
<head>
    <title>Tabel Guru</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbguru";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM guru";
$result = $conn->query($sql);

echo "<h1>Tabel Guru</h1>";
echo "<a class='table-link' href='index.html'>Kembali ke Menu Utama</a><br><br>";  // Tombol Kembali ke Menu Utama
echo "<a class='table-link' href='tambah_guru.php'>Tambah Guru</a><br><br>";  // Tombol Tambah Guru

if ($result->num_rows > 0) {
    echo "<table><tr><th>Nomor Induk</th><th>Nama</th><th>TTL</th><th>Jenis Kelamin</th><th>Golongan</th><th>Mapel</th><th>Alamat</th><th>Status</th><th>Aksi</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nomor_induk"]. "</td><td>" . $row["nama"]. "</td><td>" . $row["ttl"]. "</td><td>" . $row["jenis_kelamin"]. "</td><td>" . $row["golongan"]. "</td><td>" . $row["mapel"]. "</td><td>" . $row["alamat"]. "</td><td>" . $row["status"]. "</td><td><a href='edit_guru.php?id=".$row["nomor_induk"]."'>Edit</a> | <a href='hapus_guru.php?id=".$row["nomor_induk"]."'>Hapus</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "<div class='message'>0 results</div>";
}
$conn->close();
?>

</body>
</html>
