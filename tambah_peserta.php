<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Halaman Peserta Kelas</title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
<?php
    include 'config.php';
            if(isset($_POST['mahasiswa_id'])) {
				$kelas_id = $_POST['kelas_id'];
                $mahasiswa_id = $_POST['mahasiswa_id'];
                
                $add = mysqli_query($mysqli,"INSERT INTO `krs`(kelas_id,mahasiswa_id) VALUES ('$kelas_id','$mahasiswa_id')");
                
                if ($add) {
                    echo "<script> alert ('Peserta berhasil ditambahkan') ; document.location.href='lihat_detail_kelas.php?id=$kelas_id'; </script>";
                }
                else {
                    echo "<script> alert ('Peserta gagal ditambahkan') ; document.location.href='lihat_detail_kelas.php?id=$kelas_id';</script>"; 
                }
            }
                
            ?>
		</div>
	</body>
</html>