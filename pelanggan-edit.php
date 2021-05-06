<?php 

$title = 'Edit Data Pelanggan';

require_once "template/theHeader.php";

?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perbarui Data Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item">Layanan</li>
              <li class="breadcrumb-item active">Data Pelanggan</li>
              <li class="breadcrumb-item active"><a href="#">Edit Pelanggan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<?php

if(isset($_GET['id'])) {
    $query = $conn->query(sprintf("SELECT * FROM pelanggan INNER JOIN kode_tarif USING(kode_tarif) INNER JOIN user USING(id_user) WHERE id_pelanggan = %s", $_GET['id']));
    $item = $query->fetch_object();
} else {
    return header('Location:pelanggan.php');
}

if(isset($_POST['simpan'])) {

    $sql = sprintf("UPDATE pelanggan SET nama_pelanggan = '%s', alamat = '%s',no_hp = '%s', nometer = '%s', kode_tarif = '%s' WHERE id_pelanggan = %s",$_POST['nama'],$_POST['alamat'],$_POST['no_hp'],$_POST['nometer'],$_POST['kode_tarif'],$_GET['id']);

    if($conn->query($sql)){
        return header('Location:pelanggan.php');
    }

    var_dump($sql);
    hasMessage('Maaf!,Tidak dapat mengubah data.');
}



?>




<div class="card">
    <div class="card-header">
        <div class="card-body">
        <form action="" method="POST">
        <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $_SESSION['id_user']; ?>"  >
        <input type="hidden" class="form-control" name="id_pelanggan" id="id_pelanggan" value="<?= $item->id_pelanggan; ?>"  >
            <div class="form-group">
                <label for="nama">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= old('nama', $item->nama_pelanggan)  ?>" placeholder="Nama Pelanggan" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= old('alamat',$item->alamat)  ?>" placeholder="Alamat" required>
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="number" class="form-control" name="no_hp" id="no_hp" value="<?= old('no_hp',$item->no_hp)  ?>" placeholder="Nomor HP" required>
            </div>
            <div class="form-group">
                <label for="nometer">Nomor Meter</label>
                <input type="number" class="form-control" name="nometer" id="no_hp" value="<?= old('nometer',$item->nometer)  ?>" placeholder="Nomor Meter" required>
            </div>
            <div class="form-group">
                <label for="kode_tarif">Kode Tarif</label>
                <select name="kode_tarif" id="kode_tarif" class="custom-select my-1 mr-sm-2" required="">
				<option hidden="" value="<?= $item->kode_tarif; ?>"><?= $item->kode_tarif . ' - ' . $item->daya . ' VA ' . '- Rp. ' . $item->tarifkwh ?></option>
                    <optgroup label="Kode Tarif">
                        <?php 
                        $query = $conn->query("SELECT * FROM kode_tarif");

                        while ($item = $query->fetch_object()) {
                        ?>
                            <option value="<?= $item->kode_tarif ?>"><?= $item->kode_tarif . ' - ' . $item->daya . ' VA ' . '- Rp. ' . $item->tarifkwh ?></option>
                        <?php } ?>
                    </optgroup>
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

require_once "template/theFooter.php"

?>