<!DOCTYPE html>
<html>
<head>
    <title>Tabel Gaji</title>
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

$sql = "SELECT * FROM gaji";
$result = $conn->query($sql);

echo "<h1>Tabel Gaji</h1>";
echo "<a class='table-link' href='index.html'>Kembali ke Menu Utama</a><br><br>";  // Tombol Kembali ke Menu Utama
echo "<a class='table-link' href='tambah_guru.php'>Tambah Guru</a><br><br>";  // Tombol Tambah Guru

if ($result->num_rows > 0) {
    echo "<table><tr><th>Nomor Induk</th><th>Gaji Pokok</th><th>Tunjangan</th><th>Total Gaji</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nomor_induk"]. "</td><td>Rp " . number_format($row["gaji_pokok"], 0, ',', '.') . "</td><td>Rp " . number_format($row["tunjangan"], 0, ',', '.') . "</td><td>Rp " . number_format($row["total_gaji"], 0, ',', '.') . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<div class='message'>0 results</div>";
}
$conn->close();
?>

</body>
</html>
