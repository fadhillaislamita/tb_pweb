<!doctype html>
<html lang="en">
  <head>
  	 <body  background="bgok.jpeg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Main Page of Data User</title>
  </head>
<body>
	<?php 
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['tipe']==""){
		header("location:index.php?pesan=gagal");
	}
	?>
	<br>
	<h2 class="text-center" ><b>SELAMAT DATANG DI</b></h2>
	<h2 class="text-center" ><b>SISTEM INFORMASI REKAPITULASI PERKULIAHAN</b></h2></br>
<center>
	<h5 class="text-center" >Halo <b><?php echo $_SESSION['nama']; ?></b> telah login sebagai <b>Admin</b>.</h5>
	<a href="index_pertemuan.php" class='btn btn-outline-primary btn-lg'> Lihat Pertemuan </a>
	<a href="indexkelas.php" class='btn btn-outline-primary btn-lg'> Kelola Kelas </a>
	<a href="index_mhs.php" class='btn btn-outline-primary btn-lg'> Kelola Mahasiswa </a>
	<a href="logout.php" class='btn btn-outline-primary btn-lg'> Logout </a>
</center>

	<br/>
	<br/>
</body>
</html>