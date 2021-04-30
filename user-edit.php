<?php 

require_once "template/theHeader.php";

?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perbarui Data User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Kelola User</li>
              <li class="breadcrumb-item active"><a href="#">Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<?php
if(isset($_POST['simpan'])){
    $sql = sprintf("UPDATE user SET nama = '%s',username = '%s',password = '%s', level = '%s' WHERE id_user = %s",
    $_POST['nama'],$_POST['username'],$_POST['password'],$_POST['level'],$_POST['id']);

    if ($conn->query($sql)) {
        return header('Location:user.php');
    }

    var_dump($sql);
    hasMessage('Maaf!, Tidak dapat mengubah data.');

}

if (isset($_GET['id'])) {
    $query = $conn->query(sprintf("SELECT * FROM user WHERE id_user = %s", $_GET['id']));
    $item = $query->fetch_object();
} else {
    return header('Location:user.php');
}

?>

<div class="card">
    <div class="card-header">
        <div class="card-body">
            <form action="" method="post">

            <input type="hidden" name="id" value="<?= $item->id_user;?>">

            <div class="form-group">
                <label for="nama">Nama User</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= old('nama', $item->nama);  ?>" placeholder="Nama User" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= old('username', $item->username)  ?>" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?= old('password', $item->password)  ?>" placeholder="Password" required>
            </div>
            <div class="form-group">
            <label for="level">Level</label>
            <select class="form-control" name="level" id="level" required> 
            <?php 
            $query = $conn->query("SELECT * FROM user WHERE id_user='$_GET[id]'");
            $d = $query->fetch_array();

            if ($d['level'] == 'Admin'){
                echo "<option value='Admin' selected>Admin</option>
                <option value='Kasir'>Kasir</option>
                <option value='Pelanggan'>Pelanggan</option>";
            } else if ($d['level'] == 'Kasir') {
                echo "<option value='Admin'>Admin</option>
                <option value='Kasir' selected>Kasir</option>
                <option value='Pelanggan'>Pelanggan</option>";
            } else {
                echo "<option value='Admin'>Admin</option>
                <option value='Kasir' >Kasir</option>
                <option value='Pelanggan' selected>Pelanggan</option>";
            }
            ?>
                <!-- <option hidden>Pilih Level</option>
                <option value="Admin">Admin</option>
                <option value="Kasir">Kasir</option>
                <option value="Pelanggan">Pelanggan</option> -->
            </select>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-success" onclick="return confirm('Apakah anda yakin ingin memperbarui data user ini?')">Perbarui</button>
                <button type="" name="reset" class="btn btn-info">Reset</button>
            </div>

        </div>
    </div>
</div>



</form>

<?php

require_once "template/theFooter.php"

?>