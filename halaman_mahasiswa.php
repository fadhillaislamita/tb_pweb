<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<title>Halaman Mahasiswa</title>
</head>
<body  background="ba.jpeg">
<div class="container"></div>
	<?php
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['tipe']==""){
		header("location:index.php?pesan=gagal");
	}

	?>
	<br>
	<h1 class="text-center" ><b>SISTEM INFORMASI REKAPITULASI PERKULIAHAN</b></h1>
	<br>
	<h3 class="text-center" >Lihat Daftar Kelas</h3>
	<?php
		include_once("config.php");
		$user = $_SESSION['id'];
		$result = mysqli_query($mysqli,"SELECT krs.krs_id, kelas.id,kelas.kode_kelas,kelas.kode_matkul,kelas.nama_matkul,kelas.tahun,kelas.semester,kelas.sks FROM krs
		join kelas on kelas.id=krs.kelas_id
        where mahasiswa_id=$user");
	?>

	<div class="row py-2">
            <div class="col-sm">
            
            <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
              <?php  } ?>

            <table class="table table-striped table-hover table-bordered">
                <thead class="table-light">
                <tr>
                <th class="text-center">No.</th> 
				<th class="text-center">Kode Kelas</th> 
				<th class="text-center">Kode Matkul</th> 
				<th class="text-center">Nama Matkul</th>
				<th class="text-center">Tahun</th> 
				<th class="text-center">Semester</th> 
				<th class="text-center">SKS</th>
				<th class="text-center">Aksi</th>
				</tr>
                 </thead>
                <tbody>
                    <?php
                    	$no=1;
                        while($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $data['kode_kelas'] ?></td>
                        <td><?php echo $data['kode_matkul'] ?></td>
                        <td><?php echo $data['nama_matkul'] ?></td>
                        <td><?php echo $data['tahun'] ?></td>
                        <td><?php echo $data['semester'] ?></td>
                        <td><?php echo $data['sks'] ?></td>
						<td class="text-center">
						<a href="detail_kelas.php?id_krs=<?php echo $data['krs_id']; ?> && id_kelas=<?php echo $data['id']; ?>" class='btn btn-sm btn-primary'> Detail </a>
						</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
	</br>
	<a href="logout.php" class='btn btn-danger' style="margin-left : 10px" >Logout</a>
</body>
</html>