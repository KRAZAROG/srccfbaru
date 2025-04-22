<?php
$db = \Config\Database::connect();

$kd = esc($_GET['kode_cs'] ?? ''); 
$builder = $db->table('customer');
$cs = $builder->getWhere(['kode_customer' => $kd])->getRowArray();


$keranjang = $db->table('keranjang')->getWhere(['kode_customer' => $kd])->getResultArray();
?>


<?php include 'header.php'; ?>

<div class="container" style="padding-bottom: 200px">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Checkout</b></h2>
	<div class="row">
		<div class="col-md-6">
			<h4>Daftar Pesanan</h4>
			<table class="table table-stripped">
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Qty</th>
					<th>Sub Total</th>
				</tr>
				<?php 
				$no = 1;
				$hasil = 0;

				foreach ($keranjang as $row):
					$subtotal = $row['harga'] * $row['qty'];
					$hasil += $subtotal;
				?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= esc($row['nama_produk']); ?></td>
						<td>Rp.<?= number_format($row['harga']); ?></td>
						<td><?= $row['qty']; ?></td>
						<td>Rp.<?= number_format($subtotal); ?></td>
					</tr>
				<?php endforeach; ?>
				<tr>
					<td colspan="5" style="text-align: right; font-weight: bold;">Grand Total = <?= number_format($hasil); ?></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 bg-success">
			<h5>Pastikan Pesanan Anda Sudah Benar</h5>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6 bg-warning">
			<h5>Isi Form di bawah ini</h5>
		</div>
	</div>
	<br>

	<form action="<?= base_url('proses/order') ?>" method="POST">
		<input type="hidden" name="kode_cs" value="<?= esc($kd); ?>">
		<div class="form-group">
			<label for="nama">Nama</label>
			<input type="text" class="form-control" name="nama" placeholder="Nama" style="width: 557px;" value="<?= esc($cs['nama'] ?? '') ?>" readonly>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Provinsi</label>
					<input type="text" class="form-control" name="prov" placeholder="Provinsi">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Kota</label>
					<input type="text" class="form-control" name="kota" placeholder="Kota">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" class="form-control" name="almt" placeholder="Alamat">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Kode Pos</label>
					<input type="text" class="form-control" name="kopos" placeholder="Kode Pos">
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success">
			<i class="glyphicon glyphicon-shopping-cart"></i> Order Sekarang
		</button>
		<a href="<?= base_url('keranjang') ?>" class="btn btn-danger">Cancel</a>
	</form>
</div>

<?php include 'footer.php'; ?>
