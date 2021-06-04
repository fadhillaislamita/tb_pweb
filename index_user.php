<?php
    include_once("koneksi.php");

    if(isset($_POST['search'])){
        $cari=$_POST['cari'];
        $result= mysqli_query($koneksi,  "SELECT * FROM mahasiswa WHERE nama LIKE '%".$cari."%'");   
    }
    else{
        $result = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Main Page of Data User</title>
  </head>
  <body  background="bgpweb.jpg">
    <div class="container">
    <br>
        <h1 class="text-center">Data User</h1>
        
        <div class="row py-2">
        <div class="col-sm">
            <form action="index_user.php" method="POST">
            <a href="add.php" class="btn btn-secondary" style="margin-right: 962px"> Back </a>
            <input type="text" name="cari" placeholder="Search User" autocomplete="off">
            <button class="btn btn-secondary" type="submit" name="search">Search</button>

        <div class="row py-2">
            <div class="col-sm">
            
            <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
              <?php  } ?>

            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                <tr>
				<th class="text-center">ID</th> 
				<th class="text-center">Nama</th> 
				<th class="text-center">NIM / NIP</th>
				<th class="text-center">Email</th>
				<th class="text-center">Tipe</th>
				</tr>
                 </thead>
                <tbody>
                    <?php
                        while($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id'] ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $data['nim'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td><?php echo $data['tipe'] ?></td>
                    </tr>
                    <?php } ?>
        
                </tbody>
            </table>
            </div>
        </div>
    </div>
  </body>
</html>