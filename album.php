<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
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
    <link rel="stylesheet" href="./style/album.css">
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
        <div class="card mb-4">
            <div class="card-body">
            <div class="card-header">
                    <h5 class="mb-0">Tambah album</h5>
                </div>
                <form action="tambah_album.php" method="post">
                    <div class="mb-3">
                        <label for="namaalbum" class="form-label">Nama Album</label>
                        <input type="text" class="form-control" id="namaalbum" name="namaalbum">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
        <h3 class="mb-1">Daftar Album</h3>
        <div class="row">
            <?php
            include "koneksi.php";
            $userid = $_SESSION['userid'];
            $sql = mysqli_query($conn, "select * from album where userid='$userid'");
            while ($data = mysqli_fetch_array($sql)) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://picsum.photos/400/250?random=<?= rand(1, 1000) ?>" class="card-img-top"alt="Album Image">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $data['namaalbum'] ?>
                            </h5>
                            <p class="card-text">
                                <?= $data['deskripsi'] ?>
                            </p>
                            <a href="foto2.php?albumid=<?= $data['albumid'] ?>" class="btn btn-primary">Lihat Foto</a>
                            <a href="edit_album.php?albumid=<?= $data['albumid'] ?>" class="btn btn-primary">Edit</a>
                            <a href="hapus_album.php?albumid=<?= $data['albumid'] ?>" class="btn btn-primary">Delete</a>
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