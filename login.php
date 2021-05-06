<?php
require 'config/config.php';
 

$username = $_POST["username"];
$password = $_POST["password"];
// $level = $_POST["level"];

$sql = "select * from user where username='".$username."' and password='".$password."' limit 1";
$hasil = mysqli_query($conn,$sql);
$jumlah = mysqli_num_rows($hasil);


	if ($jumlah>0) {
		$row = mysqli_fetch_assoc($hasil);
		$_SESSION['id_user']=$row['id_user'];
		$_SESSION['nama']=$row['nama'];
		$_SESSION['username']=$row['username'];
		$_SESSION['level']=$row['level'];
        $_SESSION['status'] = "login";
		
		if ($row['level'] == 'Admin') {
			echo '<script>alert("Selamat Datang Admin")</script>';
			echo '<script>document.location="index.php"</script>';
		  } else if ($row['level'] == 'Kasir'){
			echo '<script>alert("Selamat Datang Operator")</script>';
			echo '<script>document.location="index.php"</script>';
		  } else if ($row['level'] == 'Pelanggan') {
			echo '<script>alert("Selamat Datang Pelanggan")</script>';
			echo '<script>document.location="index.php"</script>';
		  } else {
		  echo  '<script>alert("USERNAME ATAU PASSWORD ANDA SALAH")</script>';
		  header("location:login.php");
		  }
		
	}else {
        header("location:index.html");
        
	}
?>