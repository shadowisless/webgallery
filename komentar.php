<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Komentar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./style/komentar.css">
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
        <div class="photo-summary">
            <?php
        include "koneksi.php";
        $fotoid=$_GET['fotoid'];
        $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
        while($data=mysqli_fetch_array($sql)){
            ?>
            <h2><?=$data['judulfoto']?></h2>
            <img src="gambar/<?=$data['lokasifile']?>" alt="Foto <?=$data['judulfoto']?>">
            <p><?=$data['deskripsifoto']?></p>
            <?php
        }
        ?>
        </div>

        <div class="comments">
            <?php
        include "koneksi.php";
        $sql=mysqli_query($conn,"SELECT komentarfoto.komentarid, user.namalengkap, komentarfoto.isikomentar, komentarfoto.tanggalkomentar 
                                        FROM komentarfoto 
                                        INNER JOIN user ON komentarfoto.userid=user.userid 
                                        WHERE komentarfoto.fotoid='$fotoid'");
        while($data=mysqli_fetch_array($sql)){
            ?>
            <div class="comment-card">
                <div class="user"><?=$data['namalengkap']?></div>
                <div class="content"><?=$data['isikomentar']?></div>
                <div class="date"><?=$data['tanggalkomentar']?></div>
                <i class="far fa-heart like-icon"></i>
            </div>
            <?php
        }
        ?>
        </div>
        <div class="container">
            <form class="comment-form" action="tambah_komentar.php" method="post">
                <input type="text" name="fotoid" value="<?=$fotoid?>" hidden>
                <input type="text" name="isikomentar" placeholder="Tambahkan komentar Anda">
                <div class="button-group">
                    <a href="index2.php" class="btn btn-secondary">Kembali</a>
                    <input type="submit" value="Tambah" class="btn btn-primary">
                </div>
            </form>
        </div>

    </div>
</body>

</html>
<script>
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('like-icon')) {
        e.target.classList.toggle('far');
        e.target.classList.toggle('fas');
        e.target.classList.toggle('text-danger');
    }
});
</script>