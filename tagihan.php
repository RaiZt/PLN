<?php 

$title = 'Data Tagihan';

require_once "template/theHeader.php";

?>

<?php 

if(isset($_GET['hapus'])) {
    $sql = sprintf("DELETE FROM tagihan WHERE id_tagihan = %s", $_GET['hapus']);

    if ($conn->query($sql)) {
        return header('Location:tagihan.php');
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
            <h1>Data Tagihan</h1>
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
                <h3 class="card-title">Table Tagihan</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
<div class=table-responsive>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID Penggunaan</th>
      <th scope="col">Nomor Meter</th>
      <th scope="col">Bulan</th>
      <th scope="col">Tahun</th>
      <th scope="col">Jumlah Meter</th>
      <th scope="col">Jumlah Tagihan</th>
      <th scope="col">Status</th>
      <th scope="col">Operator</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $query = $conn->query("SELECT * FROM tagihan INNER JOIN user using(id_user) INNER JOIN penggunaan using(id_penggunaan) INNER JOIN pelanggan using(id_pelanggan)");
        
        while ($item = $query->fetch_object()) {
    ?>
        <tr>
            <td><?= $item->id_penggunaan; ?></td>
            <td><?= $item->nometer; ?></td>
            <td><?= $item->bulan; ?></td>
            <td><?= $item->tahun; ?></td>
            <td><?= $item->jumlah_meter; ?></td>
            <td><?= money($item->jumlah_tagihan) ?></td>
            <td><?= $item->status; ?></td>
            <td><?= $item->nama; ?></td>
            <td>
            <?php
                if($item->status != "Sudah Bayar"){
            ?>  
                <a href="pembayaran-create.php?id=<?= $item->id_tagihan;?>" type="button" class="btn btn-success"><i class="fas fa-dollar-sign"></i>
                Bayar</a> 
             <?php   } ?>
                            
             <a href="?hapus=<?= $item->id_tagihan;?>" type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?');"><i class="far fa-trash-alt"></i>
              Hapus</a>
              <!-- <a href="penggunaan-edit.php?id=<?= $item->id_ta;?>" type="button" class="btn btn-info">
              Edit</a> -->
            </td>
        </tr>

        <?php } ?>
  </tbody>
  </div>
</table>
<?php 

require_once "template/theFooter.php";

?>