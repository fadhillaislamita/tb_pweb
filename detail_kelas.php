<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Halaman Mahasiswa</title>
</head>
<body  background="ba.jpeg">
<br>
<div class="container"></div>
    <h3 class="text-center" >Lihat Daftar Kelas</h3>
    <?php
        include_once("config.php");
        $krs_id = $_GET['id_krs'];
        $kelas_id = $_GET['id_kelas'];
        $result = mysqli_query($mysqli,"SELECT * from kelas where id=$kelas_id");
        $result1 = mysqli_query($mysqli,"SELECT * from pertemuan where kelas_id=$kelas_id");
        $result2 = mysqli_query($mysqli,"SELECT * from absensi where krs_id=$krs_id");
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
                <th class="text-center">Kelas ID</th> 
                <th class="text-center">Kode Kelas</th> 
                <th class="text-center">Kode Matkul</th> 
                <th class="text-center">Nama Matkul</th>
                </tr>
                 </thead>
                <tbody>
                    <?php
                        while($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id'] ?></td>
                        <td><?php echo $data['kode_kelas'] ?></td>
                        <td><?php echo $data['kode_matkul'] ?></td>
                        <td><?php echo $data['nama_matkul'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-light">
                <tr>
                <th class="text-center">Tanggal</th> 
                <th class="text-center">Pertemuan Ke</th> 
                <th class="text-center">Materi</th>
                <th class="text-center">Kehadiran</th>
                </tr>
                 </thead>
                <tbody>
                    <?php
                        while($data = mysqli_fetch_array($result1)) {
                    ?>
                    <tr>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['pertemuan_ke'] ?></td>
                        <td><?php echo $data['materi'] ?></td>
                        <td>
                        <?php while($data1 = mysqli_fetch_array($result2)) {
                            if($data1['pertemuan_id']==$data['pertemuan_id']){
                                echo "Hadir";
                            }else{
                                echo "Tidak hadir";
                            }
                        }
                        ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
			 <a href="halaman_mahasiswa.php" class="btn btn-primary"> Home</a>
			 <a href="logout.php" class="btn btn-danger"> Logout</a>
            </div>
        </div>
    </div>
	</br>
</body>
</html>