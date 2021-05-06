<?php 

$title = 'Data Pelanggan';

require_once "template/theHeader.php";

?>

<?php 

if(isset($_GET['hapus'])) {
    $sql = sprintf("DELETE FROM pelanggan WHERE id_pelanggan = %s", $_GET['hapus']);

    if ($conn->query($sql)) {
        return header('Location:pelanggan.php');
    } else {
        $message = 'Maaf!, Tidak bisa menghapus data tersebut';
    }
}

hasMessage();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Layanan</li>
              <li class="breadcrumb-item active">Data Pelanggan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header ">
        <div class="row justify-content-between">
            <div class="col">
                <h3 class="card-title">Table Pelanggan</h3>
            </div>
            <div class="col-md-100">
            <?php if ($_SESSION['level'] == "Admin") { ?>
                <a href="pelanggan-create.php" type="button" class="btn btn-primary">Tambah</a>
            <?php } ?>
            </div>
        </div>
    </div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID Pelanggan</th>
      <th scope="col">Nama Pelanggan</th>
      <th scope="col">Alamat</th>
      <th scope="col">Nomor HP</th>
      <th scope="col">Nomor Meter</th>
      <th scope="col">Kode Tarif</th>
      <th scope="col">Operator</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
      $query = $conn->query("SELECT * FROM pelanggan INNER JOIN kode_tarif USING(kode_tarif) INNER JOIN user USING(id_user) ORDER BY id_pelanggan ASC");

      while ($item = $query->fetch_object()) {
  ?>
      <tr>
        <td><?= $item->id_pelanggan; ?></td>
        <td><?= $item->nama_pelanggan; ?></td>
        <td><?= $item->alamat; ?></td>
        <td><?= $item->no_hp; ?></td>
        <td><?= $item->nometer; ?></td>
        <td>T-<?= $item->kode_tarif; ?></td>
        <td><?= $item->username; ?></td>
      <td>
        <a href="penggunaan-create.php?id=<?= $item->id_pelanggan; ?>" type="button" class="btn btn-primary">
        Detail Penggunaan</a>
        <?php if ($_SESSION['level'] == "Admin") { ?>
        <a href="?hapus=<?= $item->id_pelanggan;?>" type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?');"><i class="far fa-trash-alt"></i>
        Hapus</a>
        <a href="pelanggan-edit.php?id=<?= $item->id_pelanggan;?>" type="button" class="btn btn-info"><i class="far fa-edit"></i>
        Edit</a>
        <?php } ?>
      </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div>

<?php 

require_once "template/theFooter.php";

?>