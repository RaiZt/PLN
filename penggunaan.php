<?php 

$title = 'Data Penggunaan';

require_once "template/theHeader.php";

?>

<?php

if(isset($_GET['hapus'])) {
    $sql = sprintf("DELETE FROM penggunaan WHERE id_penggunaan = %s",$_GET['hapus']);

    if($conn->query($sql)) {
        return header('Location:penggunaan.php');
    } else {
        $message = 'Maaf!, Tidak bisa menghapus data';
    }
}

hasMessage();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Penggunaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item">Layanan</li>
              <li class="breadcrumb-item active"><a href="#">Data Penggunaan</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header ">
        <div class="row justify-content-between">
            <div class="col">
                <h3 class="card-title">Table Penggunaan</h3>
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
                <th scope="col">Meter Awal</th>
                <th scope="col">Meter Akhir</th>
                <th scope="col">Tanggal Check</th>
                <th scope="col">Operator</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $query = $conn->query("SELECT * FROM penggunaan INNER JOIN user USING(id_user) INNER JOIN pelanggan USING(id_pelanggan)  ORDER BY id_pelanggan ASC");

            while ($item = $query->fetch_object()) {
        ?>
            <tr>
                <td><?= $item->id_penggunaan; ?></td>
                <td><?= $item->nometer; ?></td>
                <td><?= $item->bulan; ?></td>
                <td><?= $item->tahun; ?></td>
                <td><?= $item->meter_awal; ?></td>
                <td><?= $item->meter_akhir; ?></td>
                <td><?= $item->tgl_cek; ?></td>
                <td><?= $item->nama; ?></td>
                <td>
                    <a href="tagihan-create.php?id=<?= $item->id_penggunaan;?>" type="button" class="btn btn-primary">
                    Tagihan</a>
                    <?php if ($_SESSION['level'] == "Admin") { ?>                
                    <a href="?hapus=<?= $item->id_penggunaan;?>" type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?');"><i class="far fa-trash-alt"></i>
                    Hapus</a>
                    <a href="penggunaan-edit.php?id=<?= $item->id_penggunaan;?>" type="button" class="btn btn-info"><i class="far fa-edit"></i>
                    Edit</a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        </div>
    </table>
</div>

<?php 

require_once "template/theFooter.php";

?>