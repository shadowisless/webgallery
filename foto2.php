<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
    exit();
}

if (!isset($_GET['albumid']) || !is_numeric($_GET['albumid'])) {
    header("location:album.php");
    exit();
}

$albumid = $_GET['albumid'];
$userid = $_SESSION['userid'];

$sql_album = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid' AND albumid='$albumid'");
$album_data = mysqli_fetch_assoc($sql_album);

if (!$album_data) {
    header("location:album.php");
    exit();
}

$sql_photos = mysqli_query($conn, "SELECT * FROM foto WHERE albumid='$albumid'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./style/foto2.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index2.php">Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index2.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="foto.php">Foto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
    <h3 class="mb-1">Daftar Foto</h3>
    <div class="row">
        <?php
        include "koneksi.php";
        $userid = $_SESSION['userid'];
        $sql = mysqli_query($conn, "SELECT foto.*, COUNT(komentarfoto.komentarid) AS jumlah_komentar, album.namaalbum 
                                    FROM foto 
                                    LEFT JOIN komentarfoto ON foto.fotoid = komentarfoto.fotoid 
                                    JOIN album ON foto.albumid = album.albumid
                                    WHERE foto.userid='$userid' 
                                    GROUP BY foto.fotoid");
        while ($data = mysqli_fetch_array($sql)) {
        ?>
        <div class="col-md-4">
            <div class="card">
                <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $data['judulfoto'] ?>
                    </h5>
                    <p class="card-text">
                        <?= $data['deskripsifoto'] ?>
                    </p>
                    <p class="card-text">Album:
                        <?= $data['namaalbum'] ?>
                    </p>
                    <p class="card-text">Comments: <?= $data['jumlah_komentar'] ?></p>
                    <a href="hapus_foto.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-danger">Hapus</a>
                    <a href="edit_foto.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-primary">Edit</a>
                    <a href="komentar.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-secondary"> daftar Komentar
                    </a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>