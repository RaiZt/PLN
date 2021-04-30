<?php 

require_once "template/theHeader.php";

?>

<?php 

if (isset($_POST['simpan'])) {

    $sql = sprintf("INSERT INTO user(nama,username,password,level) VALUES ('%s','%s','%s','%s')",$_POST['nama'], $_POST['username'], $_POST['password'], $_POST['level']);

    if ($conn->query($sql)) {
        exit(header('Location:user.php'));
    }

    hasMessage('Maaf!, tidak dapat menyimpan data.');
}

?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Buat Data User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item">Kelola User</li>
              <li class="breadcrumb-item active"><a href="#">Tambah</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header">
        <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nama">Nama User</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= old('nama')  ?>" placeholder="Nama User" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= old('username')  ?>" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?= old('password')  ?>" placeholder="Password" required>
            </div>
            <!-- <div class="form-group">
            <label for="level">Level</label>
            <select class="form-control" name="level" id="level" required> 
                <option hidden>Pilih Level</option>
                <option value="Admin">Admin</option>
                <option value="Kasir">Kasir</option>
                <option value="Pelanggan">Pelanggan</option>
            </select>
            </div> -->
            <div class="form-group">
            <label for="level">Level</label>
            <select class="form-control" name="level" id="level" required> 
                <option hidden>Pilih Level</option>
                <option value="Admin">Admin</option>
                <option value="Kasir">Kasir</option>
                <option value="Pelanggan">Pelanggan</option>
            </select>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <button type="" name="reset" class="btn btn-info">Reset</button>
            </div>
        </form>
        </div>
    </div>
</div>


<?php 

require_once "template/theFooter.php";

?>