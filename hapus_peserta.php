<?php
include 'config.php';

$krs_id = $_GET['krs_id'];
$kelas_id = $_GET['kelas_id'];
 
$delete = mysqli_query($mysqli,"DELETE FROM `krs` WHERE krs_id='$krs_id'");

if ($delete) {
    echo "<script> alert ('Peserta berhasil dihapus') ; document.location.href='lihat_detail_kelas.php?id=$kelas_id'; </script>";
}
else {
    echo "<script> alert ('Peserta gagal dihapus') ; document.location.href='lihat_detail_kelas.php?id=$kelas_id';</script>"; 

}
 
?>