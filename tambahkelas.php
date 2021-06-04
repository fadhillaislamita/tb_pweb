<?php
    if(isset($_POST['Submit'])) {
        $kode_kelas = $_POST['kode_kelas'];
        $kode_matkul = $_POST['kode_matkul'];
        $nama_matkul = $_POST['nama_matkul'];
        $tahun = $_POST['tahun'];
        $semester= $_POST['semester'];
        $sks = $_POST['sks'];

        include_once("config.php");
        $result = mysqli_query($mysqli, "INSERT INTO kelas(kode_kelas,kode_matkul,nama_matkul,tahun,semester,sks) VALUES ('$kode_kelas','$kode_matkul','$nama_matkul','$tahun','$semester','$sks')");
        
        if($mysqli->affected_rows > 0){
            $message = "Sukses Menambah Data!";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Halaman Tambah Data Kelas</title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
        <h1 class="text-center">Tambah Data Kelas</h1>

        <div class="row py-2">
            <div class="col-sm">
                <a href="indexkelas.php" class="btn btn-outline-success"> View Data </a>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-sm">

            <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
              <?php  } ?>
            
            <form action="tambahkelas.php" method="POST">
                

                <div class="mb-3">
                <label for="kode_kelas">Kode Kelas</label>
                    <input type="text" class="form-control" id="kode_kelas" name="kode_kelas"  placeholder="Masukkan Kode Kelas" autocomplete="off" required>
                </div>

                 <div class="mb-3">
                <label for="kode_matkul">Kode Mata Kuliah</label>
                    <input type="text" class="form-control" id="kode_matkul" name="kode_matkul"  placeholder="Masukkan Kode Mata Kuliah" autocomplete="off" required>
                </div>

                <div class="mb-3">
                <label for="nama_matkul">Mata Kuliah</label>
                    <input type="text" class="form-control" id="nama_matkul" name="nama_matkul"  placeholder="Masukkan Nama Mata Kuliah" autocomplete="off" required>
                </div>

                 <div class="mb-3">
                <label for="tahun">Tahun Ajaran</label>
                    <input type="integer" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun" autocomplete="off" required>
                </div>

                 <div class="mb-3">
                <label for="semester">Semester</label>
                    <select class="form-select" name="semester" required>
                    <option disabled selected value="">Pilih Semester</option>
                    <option value="1">Ganjil</option>
                    <option value="2">Genap</option>
                </select>
                </div>

                 <div class="mb-3">
                <label for="sks">SKS</label>
                    <input type="integer" class="form-control" id="sks" name="sks" placeholder="Masukkan SKS" autocomplete="off" required>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" name="Submit" class="btn btn-primary" >Simpan</button>
                </div>               
            </form>
            </div>
        </div>
    </div>
  </body>
</html>