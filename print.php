<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak laporan</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.2/css/bulma.min.css">
	<style type="text/css" media="print">
		@page {
			size: landscape;
		}
	</style>
</head>
<body>
	<?php 

	require_once __DIR__ . "/config/config.php";
  
  $id_bayar   = $_GET['id_bayar'];
	?>

  <center>
  
	<div class="table-container">
  <h1>Struk Pembayaran</h1>
	<table border="0">
		<!-- <thead>
			<tr>
				<th>ID Bayar</th>
				<th>Nama Pelanggan</th>
				<th>Nomor Meter</th>
				<th>ID Tagihan</th>
				<th>Bulan bayar</th>
				<th>Tahun bayar</th>
				<th>Tanggal</th>
				<th>Denda</th>
        <th>Jumlah Tagihan</th>
        <th>Biaya Admin</th>
        <th>Total Bayar</th>
			</tr>
		</thead> -->
		<tbody align="center">
			<?php 

			$sql = "SELECT * FROM pembayaran 
      INNER JOIN tagihan ON tagihan.id_tagihan = pembayaran.id_tagihan
      INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan
      INNER JOIN pelanggan ON pelanggan.id_pelanggan = penggunaan.id_pelanggan
      INNER JOIN kode_tarif ON kode_tarif.kode_tarif = pelanggan.kode_tarif
      WHERE id_bayar = '".$id_bayar."'";

			$query = $conn->query($sql);

			while ($item = $query->fetch_object()) {
			
			?>
				<tr>
          <td width="100">ID Bayar</td>
          <td width="10">:</td>
					<td width="250"><?= $item->id_bayar; ?></td>
        </tr>
        <tr>
          <td>Nama Pelanggan </td>
          <td>:</td>
					<td><?= $item->nama_pelanggan; ?></td>
        </tr>
				<tr>
          <td>Nomor Meter </td>
          <td>:</td>
					<td><?= $item->nometer; ?></td>
        </tr>
        <tr>
          <td>ID Tagihan </td>
          <td>:</td>
					<td><?= $item->id_tagihan; ?></td>
        </tr>
        <tr>
          <td>Bulan </td>
          <td>:</td>
					<td><?= $item->bulan; ?></td>
        </tr>
        <tr>
          <td>Tahun </td>
          <td>:</td>
					<td><?= $item->tahun; ?></td>
        </tr>
        <tr>
          <td>Tanggal </td>
          <td>:</td>
					<td><?= $item->tanggal; ?></td>
        </tr>
        <tr>
          <td>Denda </td>
          <td>:</td>
					<td><?= money($item->denda); ?></td>
        </tr>
        <tr>
          <td>Jumlah Tagihan </td>
          <td>:</td>
					<td><?= money($item->jumlah_tagihan); ?></td>
        </tr>
        <tr>
          <td>Biaya Admin </td>
          <td>:</td>
					<td><?= money(2500); ?></td>
        </tr>
        <tr>
          <td>Total Bayar </td>
          <td>:</td>
					<td><?= money($item->total_bayar); ?></td>
        <!-- </tr>
					<td><?= $item->nometer; ?></td>
          <td><?= $item->id_tagihan; ?></td>
					<td><?= $item->bulan; ?></td>
          <td><?= $item->tahun; ?></td>
          <td><?= $item->tanggal; ?></td>
					<td><?= money($item->denda); ?></td>
          <td><?= money($item->jumlah_tagihan); ?></td>
          <td><?= money(2500); ?></td>
          <td><?= money($item->total_bayar); ?></td>
				</tr> -->
			<?php } ?>
		</tbody>
	</table>
</div>
</center>
<script>
	// window.print();
</script>	
</body>
</html>