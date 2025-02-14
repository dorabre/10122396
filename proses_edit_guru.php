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

$nomor_induk = $_POST['nomor_induk'];
$nama = $_POST['nama'];
$ttl = $_POST['ttl'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$golongan = $_POST['golongan'];
$mapel = $_POST['mapel'];
$alamat = $_POST['alamat'];
$status = $_POST['status'];

$sql = "UPDATE guru SET nama='$nama', ttl='$ttl', jenis_kelamin='$jenis_kelamin', golongan='$golongan', mapel='$mapel', alamat='$alamat', status='$status' WHERE nomor_induk=$nomor_induk";

if ($conn->query($sql) === TRUE) {
    echo "Data guru berhasil diperbarui.";
    header("Location: tampil_guru.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
