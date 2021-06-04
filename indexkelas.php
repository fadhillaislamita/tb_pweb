<?php

include_once("config.php");

 if(isset($_POST['submit'])){
        if(isset($_POST['aksi']) && $_POST['aksi'] == 'hapus'){
            $id = $_POST['id'];
            $result = mysqli_query($mysqli, "DELETE FROM kelas WHERE id='$id'");
            if($mysqli->affected_rows > 0){
                $message = "Data Berhasil Dihapus";
            }
        }
    }

$result = mysqli_query($mysqli, "SELECT * FROM kelas ORDER BY tahun DESC, semester DESC");
if($result === false){
    throw new Exception(mysqli_error($mysqli));
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Halaman Data Kelas</title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
        <h1 class="text-center">Data Kelas</h1>   
        <div class="row py-2">
        <div class="col-sm">
            <form action="indexkelas.php" method="POST">
            <a href="tambahkelas.php" class="btn btn-outline-success"> Add Data </a>
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
                        <th scope="col" class="text-center">Kode Kelas</th>
                        <th scope="col" class="text-center">Kode Mata Kuliah</th>
                        <th scope="col" class="text-center">Mata Kuliah</th>
                        <th scope="col" class="text-center">Tahun Ajaran</th>
                        <th scope="col" class="text-center">Semester</th>
                        <th scope="col" class="text-center">SKS</th>
                        <th scope="col" class="text-center">Aksi</th>
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
                        <td class="text-center"><?php echo $data['sks'] ?></td>
                        <td class="text-center">

                            <a href="editkelas.php?id=<?php echo $data['id'] ?>" class='btn btn-sm btn-primary'> Edit </a>
                            <input type="hidden" name="aksi" value="hapus">
                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                            <a href="lihat_detail_kelas.php?id=<?php echo $data['id'] ?>" class='btn btn-sm btn-dark'> Detail </a>

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