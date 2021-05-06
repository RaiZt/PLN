<?php 
require "koneksi.php";
$sql = sprintf("INSERT INTO user(nama,username,password,level) VALUES ('%s','%s','%s','%s')",$_POST['nama'], $_POST['username'], $_POST['password'], $_POST['level']);

if ($kon->query($sql)) {
    exit(header('Location:index.html'));
}else{
    hasMessage('Maaf!, tidak dapat menyimpan data.');
}

?>