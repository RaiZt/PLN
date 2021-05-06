<?php 

$title = 'Buat Pembayaran';

require_once "template/theHeader.php"

?>

<?php 

$query = $conn->query(sprintf(
    "SELECT * FROM tagihan
    INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan
    INNER JOIN pelanggan ON pelanggan.id_pelanggan = penggunaan.id_pelanggan
    INNER JOIN kode_tarif ON kode_tarif.kode_tarif = pelanggan.kode_tarif
    WHERE id_tagihan = %s",$_GET['id']));
$getPlg = $query->fetch_object();

if(isset($_POST['simpan'])){

    $sql = sprintf(
    "INSERT INTO pembayaran(id_tagihan,id_pelanggan,id_user,tanggal,bulan,tahun,jumlah_tagihan,denda,total_bayar,biaya_admin) 
    VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','2500')",
    $_POST['id_tagihan'],$_POST['id_pelanggan'],$_SESSION['id_user'],$_POST['tanggal'],$_POST['bulan'],$_POST['tahun'],$_POST['jumlah_tagihan'],$_POST['denda'],$_POST['total_bayar']);

    if($conn->query($sql)) {
        header('Location:pembayaran.php');
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
            <h1>Buat Data Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item">Layanan</li>
              <li class="breadcrumb-item">Pembayaran</li>
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
        <input type="hidden" class="form-control" name="id_tagihan" id="id_tagihan" value="<?= old('id_tagihan',$getPlg->id_tagihan); ?>"  >
        <input type="hidden" class="form-control" name="id_pelanggan" id="id_pelanggan" value="<?= old('id_pelanggan',$getPlg->id_pelanggan); ?>"  >
        <div class="form-group">
                <label for="nama_pelangggan">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?= $getPlg->nama_pelanggan;  ?>" placeholder="Nama Pelanggan" readonly>
            </div>
            <div class="form-group">
                <label for="nometer">Nomor Meter</label>
                <input type="text" class="form-control" name="nometer" id="nometer" value="<?= $getPlg->nometer;  ?>" placeholder="Nama Pelanggan" readonly>
            </div>
            <div class="form-group">
                <label for="bulan">Bulan</label>
                <!-- <select name="bulan" class="form-control">
					<?php  
						for ($a=1; $a <=12 ; $a++) { 
							if ($a<10) {
								$b = "0".$a;
							}else{
								$b = $a;
							} ?>
				<option value="<?php echo $b; ?>" <?php if($a==$getPlg->bulan){echo "selected";};?>><?php old('bulan',bulan($b)); ?></option>
					<?php } ?>
				</select> -->
                <input type="text" class="form-control" name="bulan" id="bulan" value="<?= bulan($getPlg->bulan)  ?>" placeholder="Nama Pelanggan" readonly>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <!-- <select name="tahun" class="form-control">
                    <?php 
                        for ($a=date("Y") - 2;$a < 2031; $a++) {
                    ?>
                <option value="<?php echo $a; ?>" <?php if($a==$getPlg->tahun){echo "selected";};?>><?= old('tahun',$a) ; ?></option>
                <?php } ?>
                </select> -->
                <input type="text" class="form-control" name="tahun" id="tahun" value="<?= $getPlg->tahun  ?>" placeholder="Nama Pelanggan" readonly>

            </div>
            <div class="form-group">
                <label for="meter_akhir">Tanggal Pembayaran</label>
                <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" placeholder="Tanggal Cek" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah_meter">Denda</label>
                <?php 
                $bulan_now = date("m");
                $tahun_now = date("Y");
                $denda = 0;
                if ($bulan_now != $getPlg->bulan && $getPlg->tahun != date("Y")) {
                    $denda = $getPlg->dendatrf;
                } elseif ($bulan_now == $getPlg->bulan) {
                    if (date("d") > 20) {
                        $denda = $getPlg->dendatrf;
                } else if($bulan_now > $getPlg->bulan) {
                    $denda = 1;
                }
                } else {
                    $denda = 2;
                }

                $denda = 0;
								if ($getPlg->bulan < $bulan_now && $getPlg->tahun <= $tahun_now) {
									    $denda = 2500;
                                } else if ($bulan_now == $getPlg->bulan) {
									if (date("d") > 20) {
										$denda = 0;
									}
								} else if ($bulan_now != $getPlg->bulan && $tahun_now >= $getPlg->tahun) {
									$denda = 0;
								} else if ($bulan_now == $getPlg->bulan && $tahun_now < $getPlg->tahun) {
                                    $denda = 2500;
                                } else {
                                    $denda = 2500;
                                }

                // Total
                $total_bayar = $getPlg->jumlah_tagihan + $denda + 2500;
                
                ?>
                
                <input type="text" class="form-control" name="denda" id="denda" value="<?=  old('denda',$denda) ?>" placeholder="Jumlah Meter" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah_tagihan">Jumlah Tagihan</label>
                <input type="text" class="form-control" name="jumlah_tagihan" id="jumlah_tagihan" value="<?=  old('jumlah_tagihan',$getPlg->jumlah_tagihan) ?>" placeholder="Jumlah Tagihan" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah_tagihan">Biaya Admin</label>
                <input type="text" class="form-control" name="biaya_admin" id="biaya_admin" value="<?=  2500 ?>" placeholder="Jumlah Tagihan" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah_meter">Total Bayar</label>
                <input type="text" class="form-control" name="total_bayar" id="total_bayar" value="<?=  old('total_bayar',$total_bayar) ?>" placeholder="Jumlah Meter" readonly>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <button type="reset" name="reset" class="btn btn-info">Reset</button>
            </div>
        </form>
        </div>
    </div>
</div>


<?php 

require_once "template/theFooter.php"

?>
