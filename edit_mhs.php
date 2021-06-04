<?php
include_once("config.php"); 


    if(isset($_POST['edit'])) {
        $update = mysqli_query($mysqli, "UPDATE mahasiswa SET id = '".$_POST['id']."', 
        nama = '".$_POST['nama']."', nim= '".$_POST['nim']."', 
        email = '".$_POST['email']."', password= '".$_POST['password']."',
        tipe = '".$_POST['tipe']."' WHERE id = '".$_POST['id']."'");

        if($mysqli->affected_rows > 0){
            $message = "Data Berhasil Diedit";
        }
    }
    
    $id = $_REQUEST['id'];
    $sql = 'SELECT * FROM mahasiswa WHERE id='.$id;

    if(!$hasil = $mysqli->query($sql)){
        die("Gagal");
    }

    $result = $hasil->fetch_assoc();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Page of Edit Data </title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
        <h1 class="text-center">Edit Data</h1>

        <div class="row py-2">
            <div class="col-sm">
                <a href="index_mhs.php" class="btn btn-outline-success"> Lihat Data </a>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-sm">

            <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
              <?php  } ?>

            <form action="edit_mhs.php" method="POST">
                <div class="mb-3">
                     <div style="display: none;">
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $result['id']; ?>" required> 
                </div>

                <div class="mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Update Nama" autocomplete="off" required>
                </div>
                
                <div class="mb-3">
                <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim"  value="<?php echo $result['nim']; ?>" required>
                </div>
                
                <div class="mb-3">
                <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"  placeholder="Update Email" autocomplete="off" >
                </div>

                <div class="mb-3">
                <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"  value="<?php echo $result['password']; ?>" required>
                </div>

                <div class="mb-3">
                <label for="tipe">Tipe</label>
                <select class="form-select" name="tipe" required>
                    <option disabled selected value="">Pilih Tipe</option>
                    <option value="2">Mahasiswa</option>
                </select>
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