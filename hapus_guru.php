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

if (isset($_GET['id'])) {
    $nomor_induk = $_GET['id'];

    // Menghapus data gaji yang terkait terlebih dahulu
    $sql_gaji = "DELETE FROM gaji WHERE nomor_induk = $nomor_induk";
    if ($conn->query($sql_gaji) === TRUE) {
        // Menghapus data guru setelah data gaji terhapus
        $sql_guru = "DELETE FROM guru WHERE nomor_induk = $nomor_induk";
        if ($conn->query($sql_guru) === TRUE) {
            echo "Data guru berhasil dihapus.";
            header("Location: tampil_guru.php");
            exit();
        } else {
            echo "Error: " . $sql_guru . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_gaji . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

$conn->close();
?>

$conn->close();
?>
