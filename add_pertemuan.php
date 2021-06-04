<?php
    if(isset($_POST['Submit'])) {
        $kelas_id = $_POST['kelas_id'];
        $pertemuan_ke = $_POST['pertemuan_ke'];
        $tanggal = $_POST['tanggal'];
        $materi = $_POST['materi'];
        
        include_once("config.php");
        $result = mysqli_query($mysqli, "INSERT INTO pertemuan (kelas_id,pertemuan_ke,tanggal,materi) 
        VALUES ('$kelas_id','$pertemuan_ke','$tanggal','$materi')");
        
        if($mysqli->affected_rows > 0){
            $message = "Data Berhasil Ditambahkan";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Halaman Tambah Pertemuan</title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
        <h1 class="text-center">Tambah Data Pertemuan</h1>

        <div class="row py-2">
            <div class="col-sm">
                <a href="index_pertemuan.php" class="btn btn-secondary"> View Data </a>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-sm">

            <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
              <?php  } ?>
            
            <form action="add_pertemuan.php" method="POST">
                <div class="mb-3">
                <label for="kelas_id">Kelas</label>
                   <select class="form-select" name="kelas_id" required>
                    <option disabled selected> Pilih Kelas</option>
                  <?php
                  include 'config.php';
                   $add = mysqli_query($mysqli, "SELECT * FROM kelas");
                    while($data =mysqli_fetch_array($add)){
                  ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama_matkul']; ?></option>
                  <?php
                    }
                  ?>
                </select>
                </div>
                <div class="mb-3">
                <label for="pertemuan_ke">Pertemuan Ke</label>
                    <input type="number" class="form-control" id="pertemuan_ke" name="pertemuan_ke"  placeholder="Masukkan Pertemuan Ke" autocomplete="off" required>
                </div>
                
                <div class="mb-3">
                <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"  placeholder="Pilih Tanggal" autocomplete="off" required>
                </div>

               <div class="mb-3">
                <label for="materi">Materi</label>
                    <input type="text" class="form-control" id="materi" name="materi"  placeholder="Masukkan Materi yang Disampaikan" autocomplete="off" required>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" name="Submit" class="btn btn-primary" >Save</button>
                </div>
                
            </form>
            </div>
        </div>
    </div>
  </body>
</html>
