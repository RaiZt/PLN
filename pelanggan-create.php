<?php 

$title = 'Tambah Pelanggan';

require_once "template/theHeader.php";

?>

<?php

if(isset($_POST['simpan'])) {

    $sql = sprintf("INSERT INTO pelanggan(id_user,nama_pelanggan,alamat,nometer,no_hp,kode_tarif) VALUES (%s,'%s','%s','%s','%s','%s')",$_POST['id_user'],$_POST['nama'],$_POST['alamat'],$_POST['nometer'],$_POST['no_hp'],$_POST['kode_tarif']);

    if ($conn->query($sql)) {
        header('Location:pelanggan.php');
    }
    var_dump($sql);
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
              <li class="breadcrumb-item">Layanan</li>
              <li class="breadcrumb-item">Pelanggan</li>
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
        <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $_SESSION['id_user']; ?>"  >
            <div class="form-group">
                <label for="nama">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= old('nama')  ?>" placeholder="Nama Pelanggan" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= old('alamat')  ?>" placeholder="Alamat" required>
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="number" class="form-control" name="no_hp" id="no_hp" value="<?= old('no_hp')  ?>" placeholder="Nomor HP" required>
            </div>
            <div class="form-group">
                <label for="nometer">Nomor Meter</label>
                <input type="number" class="form-control" name="nometer" id="no_hp" value="<?= old('nometer')  ?>" placeholder="Nomor Meter" required>
            </div>
            <div class="form-group">
                <label for="kode_tarif">Kode Tarif</label>
                <select name="kode_tarif" id="kode_tarif" class="custom-select my-1 mr-sm-2" required="">
				<option hidden="">Kode Tarif</option>
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

require_once "template/theHeader.php";

?>