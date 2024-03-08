<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./style/edit_foto.css">
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
                    <?php
session_start();    
if (!isset($_SESSION['userid'])) {
?>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php
} else {
?>
                    <li class="nav-item"><a class="nav-link" href="index2.php">Home</a></li>
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
    <div class="container1">
        <h1>Edit Foto</h1>
        <form action="update_foto.php" method="post" enctype="multipart/form-data">
            <?php
            include "koneksi.php";
            $fotoid = $_GET['fotoid'];
            $sql = mysqli_query($conn, "select * from foto where fotoid='$fotoid'");
            while ($data = mysqli_fetch_array($sql)) {
                ?>
            <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
            <div class="form-group">
                <label for="judulfoto" class="form-label">Judul</label>
                <input type="text" id="judulfoto" name="judulfoto" class="form-control"
                    value="<?= $data['judulfoto'] ?>">
            </div>
            <div class="form-group">
                <label for="deskripsifoto" class="form-label">Deskripsi</label>
                <input type="text" id="deskripsifoto" name="deskripsifoto" class="form-control"
                    value="<?= $data['deskripsifoto'] ?>">
            </div>
            <div class="form-group">
                <label for="lokasifile" class="form-label">Lokasi File</label>
                <input type="file" id="lokasifile" name="lokasifile" class="form-control">
            </div>
            <div class="form-group">
                <label for="albumid" class="form-label">Album</label>
                <select name="albumid" id="albumid" class="form-control">
                    <?php
                        $userid = $_SESSION['userid'];
                        $sql2 = mysqli_query($conn, "select * from album where userid='$userid'");
                        while ($data2 = mysqli_fetch_array($sql2)) {
                            ?>
                    <option value="<?= $data2['albumid'] ?>" <?php if ($data2['albumid'] == $data['albumid']) {
                                echo 'selected';
                            } ?>>
                        <?= $data2['namaalbum'] ?>
                    </option>
                    <?php
                        }
                        ?>
                </select>
            </div>
            <button type="submit" class="btn btn-submit">Ubah</button>
            <?php
            }
            ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>