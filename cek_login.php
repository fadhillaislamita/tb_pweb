<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan mysqli database
include 'config.php';

// menangkap data yang dikirim dari form login
$nama = $_POST['nama'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($mysqli,"select * from mahasiswa where nama='$nama' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_array($login);

	// cek jika user login sebagai admin
	if($data['tipe']=="1"){

		// buat session login dan username
		$_SESSION['id'] = $data['id'];
		$_SESSION['nama'] = $nama;
		$_SESSION['tipe'] = "1";
		// alihkan ke halaman dashboard admin
		header("location:halaman_admin.php");

	// cek jika user login sebagai pegawai
	}else 
		
	if($data['tipe']=="2"){
		// buat session login dan username
		$_SESSION['id'] = $data['id'];
		$_SESSION['nama'] = $nama;
		$_SESSION['tipe'] = "2";
		// alihkan ke halaman dashboard pegawai
		header("location:halaman_mahasiswa.php");


	}else{

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}

?>