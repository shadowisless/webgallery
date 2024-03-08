<?php
if(isset($_GET['fotoid'])) {
    $fotoid = $_GET['fotoid'];

    include "koneksi.php";
    $sql = mysqli_query($conn, "SELECT lokasifile FROM foto WHERE fotoid = $fotoid");
    $data = mysqli_fetch_array($sql);
    $lokasiFile = $data['lokasifile'];

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($lokasiFile).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($lokasiFile));

    readfile($lokasiFile);
    exit;
}
?>
