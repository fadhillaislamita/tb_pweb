<?php
include 'config.php';

$kelas_id = 1;
$pertemuan_id = $_GET['pertemuan_id'];

if (isset($_POST["upload"])) {

    $fileName = $_FILES["file"]["tmp_name"];
    $namaFile = $_FILES["file"]["name"];
    $ekstensiValid = 'csv';
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if ($ekstensiFile != $ekstensiValid) {
        $type = "error";
        $message = "File tidak valid. Upload file ekstensi <b>.csv</b>";
    } else {

        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");
            $skipLines = 7;
            $lineNum = 1;
            while (fgetcsv($file)) {
                if ($lineNum > $skipLines) {
                    break;
                }
                $lineNum++;
            }

            while (($column = fgetcsv($file, 1000, ";")) !== FALSE) {

                if (isset($column[1])) {
                    $coljointime = $column[1];
                    $pcsjointime = preg_split('/[, ]/', $coljointime);
                    $jam_masuk = $pcsjointime[2];
                }

                if (isset($column[2])) {
                    $colleavetime = $column[2];
                    $pcsleavetime = preg_split('/[, ]/', $colleavetime);
                    $jam_keluar = $pcsleavetime[2];
                }

                if (isset($column[4])) {
                    $colemail = $column[4];
                    $nim = substr($colemail, 0, 10);

                    $statement = $db->prepare("SELECT krs.krs_id FROM krs 
                                        JOIN mahasiswa ON krs.mahasiswa_id = mahasiswa.mahasiswa_id 
                                        WHERE krs.kelas_id = ? AND mahasiswa.nim = ?");
                    $statement->bind_param('is', $kelas_id, $nim);
                    $statement->execute();
                    $res = $statement->get_result();
                    $col = $res->fetch_assoc();
                    $krs_id = $col['krs_id'];
                }

                $join = strtotime($jam_masuk);
                $leave = strtotime($jam_keluar);
                $durasi = $leave - $join;

                $sqlInsert = "INSERT INTO absensi (krs_id, pertemuan_id, jam_masuk, jam_keluar, durasi) VALUES (?, ?, ?, ?, ?)";
                $statement = $db->prepare($sqlInsert);
                $statement->bind_param('iissi', $krs_id, $pertemuan_id, $jam_masuk, $jam_keluar, $durasi);
                $statement->execute();

                if ($mysqli->affected_rows > 0) {
                    $type = "success";
                    $message = "Data absensi berhasil diupload";
                } else {
                    $type = "error";
                    $message = "Terjadi masalah dalam upload file";
                }
            }
        }
    }
}

$stmt = $mysqli->prepare("SELECT * FROM absensi 
INNER JOIN krs ON absensi.krs_id = krs.krs_id 
INNER JOIN mahasiswa ON krs.mahasiswa_id = mahasiswa.mahasiswa_id
WHERE absensi.pertemuan_id = ? AND krs.kelas_id = ?");
$stmt->bind_param('ii', $pertemuan_id, $kelas_id);
$stmt->execute();
$result = $stmt->get_result();

$stm = $mysqli->prepare("SELECT * FROM absensi
RIGHT JOIN krs ON absensi.krs_id = krs.krs_id 
RIGHT JOIN mahasiswa ON krs.mahasiswa_id = mahasiswa.mahasiswa_id
WHERE krs.kelas_id = 1 AND krs.krs_id NOT IN 
(SELECT absensi.krs_id FROM absensi 
JOIN krs ON absensi.krs_id = krs.krs_id 
WHERE absensi.pertemuan_id = ? AND krs.kelas_id = ?)");
$stm->bind_param('ii', $pertemuan_id, $kelas_id);
$stm->execute();
$rslt = $stm->get_result();

?>

<div class="container">
    <div class="row">
        <div class="col my-3">
            <h3>Daftar Kehadiran </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-5">
            <div id="response" class="<?php if (!empty($type) && $type == "success") {
                                            echo $type . " display-block alert alert-success";
                                        } else if (!empty($type) && $type == "error") {
                                            echo $type . " display-block alert alert-danger";
                                        }
                                        ?>">
                <?php if (!empty($message)) echo $message; ?>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <label for="file" class="form-label"><i>Pilih file absensi ekstensi .csv</i></label>
        <div class="col-5">
            <form action="" method="post" name="formCSVUpload" id="formCSVUpload" enctype="multipart/form-data">
                <input type="file" class="form-control" id="file" name="file" accept=".csv">
        </div>
        <div class="col">
            <button type="submit" id="submit" name="upload" class="btn btn-primary"><i class="bi bi-file-earmark-arrow-up"></i> Upload</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Jam Keluar</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <?php
                        $hours = floor($row['durasi'] / 3600);
                        $minutes = floor(($row['durasi'] / 60) % 60);
                        $seconds = $row['durasi'] % 60;
                        ?>
                        <tr>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['jam_masuk']; ?></td>
                            <td><?= $row['jam_keluar']; ?></td>
                            <td><?php if ($hours != 0) echo $hours . "h " ?>
                                <?php if ($minutes != 0) echo $minutes . "m " ?>
                                <?php if ($seconds != 0) echo $seconds . "s " ?>
                            </td>
                            <td><?= 'Hadir' ?></td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if (mysqli_num_rows($result) > 0) : ?>
                        <?php while ($data = $rslt->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $data['nama']; ?></td>
                                <td><?= $data['jam_masuk']; ?></td>
                                <td><?= $data['jam_keluar']; ?></td>
                                <td><?= $data['durasi']; ?></td>
                                <td><?= 'Tidak Hadir' ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>