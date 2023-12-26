<!DOCTYPE html>
<html lang="en">
<head>
    <title>Formulir Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Sisipkan file koneksi untuk menghubungkan ke database
    include "koneksi.php";

    // Fungsi untuk membersihkan input dari karakter yang tidak diinginkan
    function bersihkanInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    // Periksa apakah ada kiriman formulir melalui metode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = bersihkanInput($_POST["nama"]);
        $sekolah = bersihkanInput($_POST["sekolah"]);
        $jurusan = bersihkanInput($_POST["jurusan"]);
        $no_hp = bersihkanInput($_POST["no_hp"]);
        $alamat = bersihkanInput($_POST["alamat"]);

        // Query untuk menyimpan data ke tabel peserta
        $sql = "INSERT INTO peserta (nama, sekolah, jurusan, no_hp, alamat) VALUES ('$nama', '$sekolah', '$jurusan', '$no_hp', '$alamat')";

        // Eksekusi query di atas
        $hasil = mysqli_query($kon, $sql);

        // Cek apakah query berhasil atau tidak
        if ($hasil) {
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
        }
    }
    ?>
    <h2>Formulir Pendaftaran</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required />
        </div>
        <div class="form-group">
            <label>Sekolah:</label>
            <input type="text" name="sekolah" class="form-control" placeholder="Masukkan Nama Sekolah" required/>
        </div>
        <div class="form-group">
            <label>Jurusan :</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No HP" required/>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukkan Alamat" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
