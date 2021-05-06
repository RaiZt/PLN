<?php

$title = 'Tambah Tagihan';

require_once "template/theHeader.php"

?>

<?php

$query = $conn->query(sprintf(
    "SELECT * FROM penggunaan
    INNER JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan
    WHERE id_penggunaan = %s",$_GET['id']));
$getPlg = $query->fetch_object();

$query = $conn->query("SELECT pelanggan.id_pelanggan,penggunaan.id_penggunaan,meter_awal,meter_akhir,kode_tarif.kode_tarif,kode_tarif.tarifkwh
FROM penggunaan,pelanggan,kode_tarif
WHERE kode_tarif.kode_tarif = pelanggan.kode_tarif 
AND pelanggan.id_pelanggan = penggunaan.id_pelanggan 
AND penggunaan.id_penggunaan");
$getTrf = $query->fetch_object();

// Jumlah Meter meter akhir - meter awal
$jumlah_meter = (int)$getPlg->meter_akhir - (int)$getPlg->meter_awal;
// Jumlah Tagihan Jumlah Meter * tarifperkwh 
$jumlah_tagihan = $jumlah_meter * (int)$getTrf->kode_tarif;

if(isset($_POST['simpan'])) {

  

    $sql = sprintf(
    "INSERT INTO tagihan(id_penggunaan,bulan,tahun,jumlah_meter,jumlah_tagihan,status,id_user) 
    VALUES ('%s','%s','%s','%s','%s','Belum Bayar','%s')",
    $_POST['id_penggunaan'],$_POST['bulan'],$_POST['tahun'],$_POST['jumlah_meter'],$_POST['jumlah_tagihan'],$_SESSION['id_user']);

    
    
    if($conn->query($sql)) {
        header('Location:tagihan.php');
    } else {
        var_dump($sql);
        hasMessage('Maaf!, tidak dapat menyimpan data.');
    }
}
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Buat Data Tagihan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item">Layanan</li>
              <li class="breadcrumb-item">Penggunaan</li>
              <li class="breadcrumb-item active"><a href="#">Tambah</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header">
        <div class="card-body">
        <form action="" method="post" id="mainform">
        <input type="hidden" class="form-control" name="id_penggunaan" id="id_penggunaan" value="<?= old('id_penggunaan',$getPlg->id_penggunaan); ?>"  >
        <div class="form-group">
                <label for="nama_pelangggan">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama_pelanggan" id="nama" value="<?= $getPlg->nama_pelanggan;  ?>" placeholder="Nama Pelanggan" readonly>
            </div>
            <div class="form-group">
                <label for="nometer">Nomor Meter</label>
                <input type="text" class="form-control" name="nometer" id="nama" value="<?= $getPlg->nometer;  ?>" placeholder="Nama Pelanggan" readonly>
            </div>
            <div class="form-group">
                <label for="bulan">Bulan</label>
    
                <input type="text" class="form-control" name="bulan" id="bulan" value="<?= bulan($getPlg->bulan)  ?>" placeholder="Nama Pelanggan" readonly>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" class="form-control" name="tahun" id="tahun" value="<?= $getPlg->tahun;  ?>" placeholder="Nama Pelanggan" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah_meter">Jumlah Meter</label>
                <input type="text" class="form-control" name="jumlah_meter" id="jumlah_meter" value="<?=  old('jumlah_meter',$jumlah_meter) ?>" placeholder="Jumlah Meter" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah_tagihan">Jumlah Tagihan</label>
                <input type="text" class="form-control" name="jumlah_tagihan" id="jumlah_tagihan" value="<?=  old('jumlah_tagihan',$jumlah_tagihan) ?>" placeholder="Jumlah Tagihan" readonly>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <button type="reset" name="reset" class="btn btn-info">Reset</button>
            </div>
        </form>
<?php

require_once "template/theFooter.php"

?>
