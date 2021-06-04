<?php
    include 'config.php';
        if(isset($_GET['id'])){
            $id_kelas =$_GET['id'];
        }
        else {
            die ("Error. No ID Selected!");    
        }
        $query = mysqli_query($mysqli, "SELECT * FROM kelas WHERE id='$id_kelas'");
        $result = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>detail kelas</title>
</head>
 <body  background="ba.jpeg">
    <div class="container">
    <h1 class="text-center">Detail Kelas</h1>

    <button id="add_mhs" onclick="myfunction()">Tambah Anggota Kelas</button>
    <br>
        <tr>
            <td size="90">Kode Kelas</td>
            <td>: <?php echo $result['kode_kelas']?></td>
        </tr>
       <br>
        <tr>
            <td>Kode Matkul</td>
            <td>: <?php echo $result['kode_matkul']?></td>
        </tr>
        <br>
        <tr>
            <td>Nama Matkul</td>
            <td>: <?php echo $result['nama_matkul']?></td>
        </tr>
        <br>
        <tr>
            <td>Tahun</td>
            <td>: <?php echo $result['tahun']?></td>
        </tr>
        <tr>
        <br>
            <td>Semester</td>
            <td>: <?php echo $result['semester']?></td>
        </tr>
        <tr>
        <br>
            <td>SKS</td>
            <td>: <?php echo $result['sks']?></td>
        </tr>
        </table>
        <br>

        <div id="div_add" style="display: none;">

        <?php
            $que = mysqli_query($mysqli, "SELECT * FROM mahasiswa where mahasiswa.id not in (select mahasiswa_id from `krs` where kelas_id=$id_kelas) AND mahasiswa.tipe=2");
        ?>
            <form action="tambah_peserta.php" method="post">
                <input type="hidden" name="kelas_id" value="<?php echo $id_kelas ?>">
                <select name="mahasiswa_id" id="mahasiswa_id">
                    <option selected disabled>Pilih Nama Mahasiswa</option>
                    <?php
                        while($res  =mysqli_fetch_array($que)){
                            ?>
                            <option value="<?php echo $res['id'] ?>">
                                <?php echo $res['nama'] ?>
                            </option>
                            <?php
                        }
                    ?>
                </select>
                <button type="submit">Tambah</button>
            </form>
        </div>
        <tr>
            <td>Data Mahasiswa</td>
            <br>
        </tr>
        <table class="table table-striped table-hover table-bordered" border="0" cellpadding="4">
        <thead class="table-dark">
        <tr bgcolor="silver">
            <th scope="col" class="text-center">No.</th>
            <th class="text-center">Nama</th>
            <th class="text-center">OPSI</th>
        </tr>
        </thead>

        <?php
         
        $no=0;
        $query2 = mysqli_query($mysqli, "SELECT * FROM `krs` join mahasiswa on mahasiswa.id=`krs`.`mahasiswa_id` where kelas_id=$id_kelas");
        while($result2  =mysqli_fetch_array($query2)){
        $no++;

        ?>

        <tr>
            <td><?php echo $no?></td>
            <td><?php echo $result2['nama']?></td>
            <td><a href="hapus_peserta.php?krs_id=<?php echo $result2['krs_id']?>&&kelas_id=<?php echo $id_kelas?>" class="btn btn-danger" style="margin-left: 0,1px" sonclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a></td>
        </tr>
        <?php
        }
        ?>

        <table>
        <tr>
            <td>Data Pertemuan</td>
            <br>
        </tr>
        <table class="table table-striped table-hover table-bordered" border="0" cellpadding="4">
        <thead class="table-dark">
        <tr bgcolor="silver"> 
            <th scope="col" class="text-center">No.</th>
            <th class="text-center">Kelas</th>
            <th class="text-center">Pertemuan Ke</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Materi</th>

         </tr>
         </thead>

         <?php
            
            $no=0;
            $sql = mysqli_query($mysqli,"SELECT * FROM pertemuan JOIN kelas ON pertemuan.kelas_id=kelas.id WHERE kelas_id=$id_kelas");
            while ($value = mysqli_fetch_array($sql)) {
            $no++;
            ?>

            <tr>
                <td><?php echo $no?></td>
                <td><?php echo $value['nama_matkul']?></td>
                <td><?php echo $value['pertemuan_ke']?></td>
                <td><?php echo $value['tanggal']?></td>
                <td><?php echo $value['materi']?></td>
            </tr>
            <?php
            }
         ?>
         </table>
    </table>
    </div>
    <br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
<script>
        function myfunction(){
            document.getElementById("div_add").style.display = 'block';
        }
  </script>
<a href="indexkelas.php" class="btn btn-danger" style="margin-left: 110px"> Back </a>
<a href="addpertemuan_kelas.php?id=<?php echo $id_kelas ?>" class="btn btn-primary"> Tambah Pertemuan </a>
</body>
</html>