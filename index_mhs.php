<?php
    include_once("config.php");

    if(isset($_POST['submit'])){
        if(isset($_POST['aksi']) && $_POST['aksi'] == 'hapus'){
            $id = $_POST['id'];
            $result = mysqli_query($mysqli, "DELETE FROM mahasiswa WHERE id='$id'");
        if($mysqli->affected_rows > 0){
                $message = "Data Berhasil Dihapus";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Main Page of Data</title>
  </head>
  <body  background="ba.jpeg">
    <div class="container">
    <br>
        <h1 class="text-center">Data Mahasiswa</h1>
        
        <div class="row py-2">
        <div class="col-sm">
            <form action="index_mhs.php" method="POST">
            <a href="add_mhs.php" class="btn btn-outline-success"> Add Data </a>
             <a href="halaman_admin.php" class="btn btn-outline-success">Home </a>
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
				 <th scope="col" class="text-center">No.</th>
				<th class="text-center">Nama</th> 
				<th class="text-center">NIM</th>
				<th class="text-center">Email</th>
                <th class="text-center">Aksi</th>
				</tr>
                 </thead>
                <tbody>
                    <?php
                    include "config.php";
					$batas = 10;
                $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;    
 
                $previous = $halaman - 1;
                $next = $halaman + 1;
                
                $data = mysqli_query($mysqli,"select * from mahasiswa");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);

                        $mhs = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE tipe=2 limit $halaman_awal, $batas");
                        $no=$halaman_awal+1;
                        while($data = mysqli_fetch_array($mhs)) {
                    ?>
                    <tr>
                        <th class="text-center" scope="row"><?php echo $no++ ?></th>
                        <td class="text-center"><?php echo $data['nama'] ?></td>
                        <td class="text-center"><?php echo $data['nim'] ?></td>
                        <td class="text-center"><?php echo $data['email'] ?></td>

                        <td class="text-center">
                            <a href="edit_mhs.php?id=<?php echo $data['id'] ?>" class='btn btn-sm btn-primary'> Edit </a>
                            <input type="hidden" name="aksi" value="hapus">
                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                            <a href="delete_mhs.php?id=<?php echo $data['id'] ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" class='btn btn-sm btn-danger'> Delete </a>
                        </td>
                    </tr>
                    <?php } ?>
        
                </tbody>
            </table>
            <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
                </li>
                <?php 
                for($x=1;$x<=$total_halaman;$x++){
                    ?> 
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                }
                ?>              
                <li class="page-item">
                    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
                </li>
            </ul>
        </nav>
            </div>
        </div>
    </div>
  </body>
</html>