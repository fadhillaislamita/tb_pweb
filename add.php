<?php
    if(isset($_POST['Submit'])) {
		$nama = $_POST['nama'];
		$nim = $_POST['nim'];
		$email = $_POST['email'];
		$tipe = $_POST['tipe'];
		$password = $_POST['password'];

        include_once("koneksi.php");
        $result = mysqli_query($koneksi, "INSERT INTO mahasiswa (nama,nim,email,tipe,password) values ('$nama','$nim','$email','$tipe','$password')");
        
        if($koneksi->affected_rows > 0){
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

    <title>Page of Registration</title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
        <h1 class="text-center">Registration New Admin</h1>

        <div class="row py-2">
            <div class="col-sm">
                <a href="index.php" class="btn btn-secondary"> Silahkan Login </a>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-sm">

            <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
              <?php  } ?>
            
            <form action="add.php" method="POST">

                <div class="mb-3">
                <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"  placeholder="Masukkan Nama" autocomplete="off" required>
                </div>

				<div class="mb-3">
                <label for="nim">NIP</label>
                    <input type="text" class="form-control" id="nim" name="nim"  placeholder="Masukkan NIP" autocomplete="off" required>
                </div>
				
				<div class="mb-3">
                <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"  placeholder="Masukkan Email" autocomplete="off" required>
                </div>
				
                <div class="mb-3">
                <label for="tipe">Tipe</label>
                <select class="form-select" name="tipe" required>
                    <option disabled selected value="">Pilih Tipe User</option>
                    <option value="1">Admin</option>
                </select>
                </div>
				
				<div class="mb-3">
                <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"  placeholder="Masukkan Password" autocomplete="off" required>
                </div>


                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" name="Submit" class="btn btn-primary" >Daftar</button>
                </div>
                
            </form>
            </div>
        </div>
    </div>
  </body>
</html>