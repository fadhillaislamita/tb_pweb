<?php
include 'config.php';
    $id_kelas = $_GET['id'];
	$data = mysqli_query($mysqli,"SELECT * FROM kelas WHERE id='$id_kelas'");

    while($d = mysqli_fetch_array($data)){
        $id_kelas = $d['id'];
        $nama_matkul = $d['nama_matkul'];
    }

if (isset($_POST['Submit'])) {
        $kelas_id = $_POST['kelas_id'];
        $pertemuan_ke = $_POST['pertemuan_ke'];
        $tanggal = $_POST['tanggal'];
        $materi = $_POST['materi'];
        
        $result = mysqli_query($mysqli, "INSERT INTO pertemuan (kelas_id,pertemuan_ke,tanggal,materi) 
        VALUES ('$kelas_id','$pertemuan_ke','$tanggal','$materi')");
        
        if ($result) {
            echo "<script> alert ('Pertemuan berhasil ditambahkan') ; document.location.href='index_pertemuan.php'; </script>";
        }
        else {
            echo "<script> alert ('Pertemuan gagal ditambahkan') ; document.location.href='index_pertemuan.php';</script>"; 
        }
    }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Tambah Pertemuan</title>
</head>
<body background="ba.jpeg">
<div class="container">
    <br>
        <h1 class="text-center">Add Meeting Data</h1>

        <div class="row py-2">
            <div class="col-sm">
                <a href="index_pertemuan.php" class="btn btn-secondary"> View Data </a>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-sm">
            <form action="addpertemuan_kelas.php" method="POST">
                <div class="mb-3">
                <label for="kelas_id">Kelas</label>
                    <input type="hidden" name="kelas_id" value="<?php echo $id_kelas; ?>">
                    <input type="text" class="form-control" name="nama_matkul" value="<?php echo $nama_matkul; ?> " readonly >
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</body>
</html>