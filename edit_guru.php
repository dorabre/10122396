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
    
    $sql = "SELECT * FROM guru WHERE nomor_induk = $nomor_induk";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Guru</title>
</head>
<body>
    <h1>Edit Guru</h1>
    <form action="proses_edit_guru.php" method="POST">
        Nomor Induk: <input type="text" name="nomor_induk" value="<?php echo $row['nomor_induk']; ?>" readonly><br>
        Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required><br>
        TTL: <input type="date" name="ttl" value="<?php echo $row['ttl']; ?>"><br>
        Jenis Kelamin: <select name="jenis_kelamin">
            <option value="perempuan" <?php if($row['jenis_kelamin'] == 'perempuan') echo 'selected'; ?>>Perempuan</option>
            <option value="laki-laki" <?php if($row['jenis_kelamin'] == 'laki-laki') echo 'selected'; ?>>Laki-laki</option>
        </select><br>
        Golongan: <input type="text" name="golongan" value="<?php echo $row['golongan']; ?>"><br>
        Mapel: <input type="text" name="mapel" value="<?php echo $row['mapel']; ?>"><br>
        Alamat: <textarea name="alamat"><?php echo $row['alamat']; ?></textarea><br>
        Status: <select name="status">
            <option value="tetap" <?php if($row['status'] == 'tetap') echo 'selected'; ?>>Tetap</option>
            <option value="honorer" <?php if($row['status'] == 'honorer') echo 'selected'; ?>>Honorer</option>
        </select><br>
        <input type="submit" value="Simpan Perubahan">
    </form>
</body>
</html>
