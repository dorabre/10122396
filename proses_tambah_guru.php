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

$sql = "INSERT INTO guru (nomor_induk, nama, ttl, jenis_kelamin, golongan, mapel, alamat, status) VALUES ('$nomor_induk', '$nama', '$ttl', '$jenis_kelamin', '$golongan', '$mapel', '$alamat', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Data guru berhasil ditambahkan.";
    header("Location: tampil_guru.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
