<?php
    include_once("config.php");

    if(isset($_POST['search'])){
        $cari=$_POST['cari'];
        $result= mysqli_query($mysqli,  "SELECT * FROM pertemuan JOIN kelas ON pertemuan.kelas_id=kelas.id WHERE pertemuan_ke LIKE '%".$cari."%'");   
    }
    else{
        $result = mysqli_query($mysqli, "SELECT * FROM pertemuan JOIN kelas ON pertemuan.kelas_id=kelas.id");
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Halaman Pertemuan</title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
        <h1 class="text-center">Data Pertemuan</h1>
        
        <div class="row py-2">
        <div class="col-sm">
            <form action="index_pertemuan.php" method="POST">
			<input type="text" style="margin-left: 1025px" name="cari" placeholder="Cari Pertemuan" autocomplete="off">
            <br></br><button type="submit" name="search" class="btn btn-outline-success" style="margin-left: 1150px">Search</button>
			<a href="add_pertemuan.php" class="btn btn-outline-success"> Add Pertemuan </a>
            <a href="halaman_admin.php" class="btn btn-outline-success">Home </a>
            
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
                <th scope="col" class="text-center">No.</th>
				<th class="text-center">Kelas</th> 
				<th class="text-center">Pertemuan Ke-</th>
				<th class="text-center">Tanggal</th>
				<th class="text-center">Materi</th>
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
                        <td><?php echo $data['nama_matkul'] ?></td>
                        <td><?php echo $data['pertemuan_ke'] ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['materi'] ?></td>
						<td class="text-center">
						<a href="import.php?pertemuan_id=<? = $row['pertemuan_id'];?>" class='btn btn-sm btn-primary'> Import File CSV </a>
						</td>
                    </tr>
                    <?php } ?>
        
                </tbody>
            </table>
            </div>
        </div>
    </div>
  </body>
</html>
