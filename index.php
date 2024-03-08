<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webgal photos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/index.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
session_start();    
if (!isset($_SESSION['userid'])) {
?>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php
} else {
?>
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                    <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php
}
?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Wellcome To Gallery Photo</h1>
                <p>Explore collection of our best photo and interaction with other user.</p>
            </div>
        </div>
        <form class="search-form mt-1">
            <div class="input-group mb-12">
                <input type="text" class="form-control" placeholder="Search Photo           ..." name="search">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <h2>All Collection</h2>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php
include "koneksi.php";
$search = isset($_GET['search']) ? $_GET['search'] : ''; 
$sql = mysqli_query($conn, "SELECT foto.*, COUNT(komentarfoto.komentarid) AS jumlah_komentar, user.namalengkap 
                             FROM foto 
                             LEFT JOIN komentarfoto ON foto.fotoid = komentarfoto.fotoid 
                             JOIN user ON foto.userid = user.userid 
                             WHERE foto.judulfoto LIKE '%$search%' 
                             GROUP BY foto.fotoid");
while ($data = mysqli_fetch_array($sql)) {
    ?>
                <div class="col">
                    <div class="card">
                        <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top"
                            alt="<?= $data['judulfoto'] ?>" onclick="toggleCardContent(this)">
                        <div class="card-body hidden">
                            <h5 class="card-title">
                                <?= $data['judulfoto'] ?>
                            </h5>
                            <p class="card-text">
                                <?= $data['deskripsifoto'] ?>
                            </p>
                            <p class="card-text">Uploader:
                                <?= $data['namalengkap'] ?>
                            </p>
                            <p class="card-text">Likes:
                                <?php
                $fotoid = $data['fotoid'];
                $sql2 = mysqli_query($conn, "SELECT COUNT(*) FROM likefoto WHERE fotoid='$fotoid'");
                $likes_count = mysqli_fetch_array($sql2)[0];
                echo $likes_count;
                ?>
                            </p>
                            <p class="card-text">Comments: <?= $data['jumlah_komentar'] ?></p>
                            <a href="like.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-primary">Like</a>
                            <a href="komentar.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-secondary">
                                <i class="fas fa-comment"></i>Komentar
                            </a>
                            <a href="download.php?fotoid=<?= $data['fotoid'] ?>"
                                class="btn btn-secondary download-button">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
                <?php
}
?>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-1">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <div class="social-icons mt-4">
                        <a href="https://www.facebook.com/cecep.r.mulyana.1" class="social-icon">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/schzweiyung" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/ccp.rdky/" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <p class="text mt-3">© 2024 Galeri Foto. Cecep Ridky M</p>
        </div>
    </footer>

    <script>
    function toggleCardContent(img) {
        var card = img.parentNode;
        var cardBody = card.querySelector('.card-body');
        cardBody.classList.toggle('hidden');
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<script>
< script >
    document.addEventListener('DOMContentLoaded', function() {
        var downloadButtons = document.querySelectorAll('.download-button');
        downloadButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.stopPropagation(); // Hindari memicu klik pada gambar
            });
        });
    });
</script>