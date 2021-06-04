<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
	 <body>
	<br>
	<h1>LOGIN USER</h1>

	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Nama dan Password tidak sesuai !</div>";
		}
	}
	?>
	<div class="kotak_login">
		<p class="tulisan_login">Silahkan login</p>
 
		<form action="cek_login.php" method="post">
			<label>Nama</label>
			<input type="text" name="nama" class="form_login" placeholder="Masukan Nama " required="required">
 
			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Masukan Password " required="required">
 
			<input type="submit" class="tombol_login" value="LOGIN">
 
			<br/>
			<br/>
			<center>
				<a href="add.php">Admin yang belum memiliki akun, silahkan registrasi disini</a>
			</center>
		</form>
		
	</div>
 
 
</body>
</html>