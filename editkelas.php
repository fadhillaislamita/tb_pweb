<?php

    include_once("config.php");

    if(isset($_POST['edit'])) {
        $update = mysqli_query($mysqli, "UPDATE kelas SET id = '".$_POST['id']."', 
        kode_kelas = '".$_POST['kode_kelas']."', kode_matkul= '".$_POST['kode_matkul']."', 
        nama_matkul = '".$_POST['nama_matkul']."', tahun= '".$_POST['tahun']."',
        semester = '".$_POST['semester']."' , sks = '".$_POST['sks']."' WHERE id = '".$_POST['id']."'");
        
        if($mysqli->affected_rows > 0){
            $message = "Sukses Ubah Data!";
        }
    }
    
    $id = $_REQUEST['id'];
    $sql = 'SELECT * FROM kelas WHERE id='.$id;

    if(!$hasil = $mysqli->query($sql)){
        die("Ups!Terjadi Sesuatu");
    }

    $result = $hasil->fetch_assoc();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Halaman Edit Data Kelas</title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
        <h1 class="text-center">Edit Data Kelas</h1>

        <div class="row py-2">
            <div class="col-sm">
                <a href="indexkelas.php" class="btn btn-outline-success"> Lihat Data </a>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-sm">

            <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
              <?php  } ?>

        <form action="editkelas.php" method="POST">
                <div class="mb-3">
                <div style="display: none;">
                <label for="id">ID</label>
                <input type="integer" class="form-control" id="id" name="id" value="<?php echo $result['id']; ?>" required> 
                </div>

                <div class="mb-3">
                <label for="kode_kelas">Kode Kelas</label>
                <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" value="<?php echo $result['kode_kelas']; ?>" required>
                </div>

                <div class="mb-3">
                <label for="kode_matkul">Kode Mata Kuliah</label>
                <input type="text" class="form-control" id="kode_matkul" name="kode_matkul" value="<?php echo $result['kode_matkul']; ?>" required>
                </div>

                <div class="mb-3">
                <label for="nama_matkul">Mata Kuliah</label>
                 <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" value="<?php echo $result['nama_matkul']; ?>" required>    
                </div>

                <div class="mb-3">
                <label for="tahun">Tahun Ajaran</label>
                <input type="integer" class="form-control" id="tahun" name="tahun" value="<?php echo $result['tahun']; ?>" required>
                </div>

                <div class="mb-3">
                <label for="semester">Semester</label>
                <select class="form-select" name="semester" required>
                <?php
           
                    if ($result['semester'] == "1") echo "<option value='1' selected>Ganjil</option>";
                    else echo "<option value='1'>Ganjil</option>";

                    if ($result['semester'] == "2") echo "<option value='2' selected>Genap</option>";
                    else echo "<option value='2'>Genap</option>";    
                ?>
                </select>
                </div>


               <div class="mb-3">
                <label for="sks">SKS</label>
                <input type="integer" class="form-control" id="sks" name="sks" value="<?php echo $result['sks']; ?>" required>
                </div>

                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                </div>
        
            </form>
            </div>
        </div>
    </div>

  </body>
</html>
