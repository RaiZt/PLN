<?php
require_once 'template/theHeader.php';
?>

<?php 

if (isset($_GET['hapus'])) {
	$sql = sprintf("DELETE FROM user WHERE id_user = %s", $_GET['hapus']);

	if ($conn->query($sql)) {
		return header('location:user.php');
	} else {
		$message = 'Maaf!, Tidak bisa menghapus data tersebut.';
	}
}

hasMessage();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kelola User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Kelola User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

    <div class="card">
              <div class="card-header ">
                <div class="row justify-content-between">
                    <div class="col">
                    <h3 class="card-title">Kelola User</h3>
                    </div>
                    <div class="col-md-100">
                    <a href="user-create.php" type="button" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
              </div>
              <div class="card-body">
              <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID user</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Level</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = $conn->query("SELECT * FROM user ORDER BY id_user ASC"); 
                        
                            while ($item = $query->fetch_object()) {

                        ?>
                        
                        <tr>
                            <td><?= $item->id_user; ?></td>
                            <td><?= $item->nama; ?></td>
                            <td><?= $item->username; ?></td>
                            <td><?= $item->password; ?></td>
                            <td><?= $item->level; ?></td>
                           <td>
                            <a href="?hapus=<?= $item->id_user;?>" type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?');">
                            Hapus</a>
                            <a href="user-edit.php?id=<?= $item->id_user;?>" type="button" class="btn btn-info">
                            Edit</a>
                           </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
              </div>
              <!-- /.card-footer-->
    </div>

<?php
require_once 'template/theFooter.php';
?>

