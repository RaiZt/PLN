<?php 

$title = 'Pembayaran';

require_once "template/theHeader.php"

?>

<?php 

if (isset($_GET['hapus'])) {
	$sql = sprintf("DELETE FROM pembayaran WHERE id_bayar = %s", $_GET['hapus']);

	if ($conn->query($sql)) {
		return header('location:pembayaran.php');
	} else {
    echo '<script>alert("Maaf!,Tidak Dapat Menghapus data tersebut")</script>';
    echo '<script>document.location="pembayaran.php"</script>';
	}
}

?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Layanan</li>
              <li class="breadcrumb-item active">Data Pembayaran</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header ">
        <div class="row justify-content-between">
            <div class="col">
                <h3 class="card-title">Table Pembayaran</h3>
            </div>
        </div>
    </div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID Pembayaran</th>
      <th scope="col">Nomor Meter</th>
      <th scope="col">Bulan Bayar</th>
      <th scope="col">Tahun</th>
      <th scope="col">Tanggal Transaksi</th>
      <th scope="col">Denda</th>
      <th scope="col">Jumlah Tagihan</th>
      <th scope="col">Total Bayar</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
  $query = $conn->query("SELECT * FROM pembayaran INNER JOIN user using(id_user) INNER JOIN tagihan using(id_tagihan) INNER JOIN pelanggan using(id_pelanggan) INNER JOIN penggunaan using(id_penggunaan)");
  while ($item = $query->fetch_object()) {
?>
  <tr>
    <td><?= $item->id_bayar; ?></td>
    <td><?= $item->nometer; ?></td>
    <td><?= $item->bulan; ?></td>
    <td><?= $item->tahun; ?></td>
    <td><?= $item->tanggal; ?></td>
    <td><?= $item->denda; ?></td>
    <td><?= $item->jumlah_tagihan; ?></td>
    <td><?= $item->total_bayar; ?></td>
    <td>
        <a href="print.php?id_bayar=<?= $item->id_bayar;?>" type="button" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i>
        Print</a>
        <?php if ($_SESSION['level'] == "Admin") { ?>
        <a href="?hapus=<?= $item->id_bayar;?>" type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?');"><i class="far fa-trash-alt"></i>
        Hapus</a>
        <?php } ?>
        <!-- <a href="pembayaran-edit.php?id=<?= $item->id_pembayaran;?>" type="button" class="btn btn-info">
        Edit</a> -->
    </td>
  </tr>
  <?php } ?>
  </tbody>
</table>
</div>
</div>
<?php 

require_once "template/theFooter.php"

?>
