<?php 

$title = 'Tambah Penggunaan';

require_once "template/theHeader.php";

?>

<?php 

    // Ambil data Pelanggan
    $query = $conn->query(sprintf("SELECT * FROM pelanggan WHERE id_pelanggan = %s",$_GET['id']));
    $getPlg = $query->fetch_object();

if(isset($_POST['simpan'])) {

    $sql = sprintf("INSERT INTO penggunaan(id_pelanggan,bulan,tahun,meter_awal,meter_akhir,tgl_cek,id_user) VALUES (%s,'%s','%s','%s','%s','%s','%s')",
    $_POST['id_pelanggan'],$_POST['bulan'],$_POST['tahun'],$_POST['meter_awal'],$_POST['meter_akhir'],$_POST['tgl_cek'],$_POST['id_user']);
    $meter_awal = $_POST['meter_awal'];
    $meter_akhir = $_POST['meter_akhir'];
    if($meter_akhir <= $meter_awal) {
        hasMessage('Maaf!, Meter Akhir Tidak mungkin kurang dari Meter Awal!');
    } else if($conn->query($sql)) {
        header('Location:penggunaan.php');
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
            <h1>Buat Data Penggunaan</h1>
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
        <form action="" method="post">
        <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $_SESSION['id_user']; ?>"  >
        <input type="hidden" class="form-control" name="id_pelanggan" id="id_user" value="<?= old('id_pelanggan',$getPlg->id_pelanggan); ?>"  >
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
                <select name="bulan" class="form-control">
					<?php  
						for ($a=1; $a <=12 ; $a++) { 
							if ($a<10) {
								$b = "0".$a;
							}else{
								$b = $a;
							} ?>
				<option value="<?php echo $b; ?>"><?php old('tahun',bulan($b)); ?></option>
					<?php } ?>
				</select>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select name="tahun" class="form-control">
                    <?php 
                        for ($a=date("Y") - 2;$a < 2031; $a++) {
                    ?>
                <option value="<?php echo $a; ?>"><?= old('tahun',$a) ; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="meter_awal">Meter Awal</label>
                <input type="number" class="form-control" name="meter_awal" id="nama" value="<?= old('meter_awal') ?>" placeholder="Meter Awal" >
            </div>
            <div class="form-group">
                <label for="meter_akhir">Meter Akhir</label>
                <input type="number" class="form-control" name="meter_akhir" id="nama" value="<?= old('meter_akhir') ?>" placeholder="Meter Akhir" >
            </div>
            <div class="form-group">
                <label for="meter_akhir">Tanggal Pengecekan</label>
                <input type="date" class="form-control" name="tgl_cek" id="tgl_cek" value="<?= old('tgl_cek') ?>" placeholder="Tanggal Cek" >
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



require_once "template/theHeader.php";

?>