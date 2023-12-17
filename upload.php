<?php
session_start();
$koneksi = new mysqli("localhost","root","","proyek");

if (isset($_POST['upload'])){
    $file = rand(1000,1000000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "upload/";

    $new_size = $file_size/1024;
    $new_filename = strtolower($file);
    $final_file= str_replace(' ','-',$new_filename);
    if(move_uploaded_file($file_loc,$folder.$final_file)){
        $sql = "INSERT INTO file (nama_file, format, ukuran) VALUES ('$final_file', '$file_type', '$new_size')";
        mysqli_query($koneksi, $sql);

        echo "<script>alert('Berkas sudah berhasil di upload');</script>";
        echo "<script>location='checkout.php';</script>";
    }
    else{
        echo "<script>alert('Berkas gagal di upload');</script>";
    }
}
?>