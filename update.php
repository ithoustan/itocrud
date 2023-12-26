<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    // Sisipkan file koneksi, untuk menghubungkan ke database
    include "koneksi.php";

    // Fungsi untuk membersihkan inputan dari karakter yang tidak sesuai
    function bersihkanInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada nilai yang dikirim menggunakan metode GET dengan nama id_peserta
    if (isset($_GET['id_peserta'])) {
        $id_peserta = bersihkanInput($_GET["id_peserta"]);

        $sql = "SELECT * FROM peserta WHERE id_peserta = $id_peserta";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari metode post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_peserta = htmlspecialchars($_POST["id_peserta"]);
        $nama = bersihkanInput($_POST["nama"]);
        $sekolah = bersihkanInput($_POST["sekolah"]);
        $jurusan = bersihkanInput($_POST["jurusan"]);
        $no_hp = bersihkanInput($_POST["no_hp"]);
        $alamat = bersihkanInput($_POST["alamat"]);

        // Query update data pada tabel peserta
        $sql = "UPDATE peserta SET
			nama = '$nama',
			sekolah = '$sekolah',
			jurusan = '$jurusan',
			no_hp = '$no_hp',
			alamat = '$alamat'
			WHERE id_peserta = $id_peserta";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }

    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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

        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
