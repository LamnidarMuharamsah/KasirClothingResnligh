<?php include "head.php" ?>
<?php
	if (isset($_GET['action']) && $_GET['action']=="tambah_barang") {
		include "tambah_barang.php";
	}
	else if (isset($_GET['action']) && $_GET['action']=="edit_barang") {
		include "edit_barang.php";
	}
	else{

		
?>
<script type="text/javascript">
	document.title="Barang";
	document.getElementById('barang').classList.add('active');
</script>
<script type="text/javascript" src="assets\datatable\js\buttons.flash.min.js"></script>
<script type="text/javascript" src="assets\datatable\js\buttons.html5.min.js"></script>
<script type="text/javascript" src="assets\datatable\js\dataTables.bootstrap.js"></script>
<script type="text/javascript" src="assets\datatable\js\dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="assets\datatable\js\dataTables.buttons.min.js"></script>
<script type="text/javascript" src="assets\datatable\js\jquery.dataTables.js"></script>
<script type="text/javascript" src="assets\datatable\js\jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets\datatable\js\jquery.js"></script>
<script type="text/javascript" src="assets\datatable\js\jszip.min.js"></script>
<script type="text/javascript" src="assets\datatable\js\moment.js"></script>
<script type="text/javascript" src="assets\datatable\js\pdfmake.min.js"></script>
<script type="text/javascript" src="assets\datatable\js\vfs_fonts.js"></script>
<script type="text/javascript">
    $(function(){
    	 
		
    });
</script>
<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
			<div class="contenttop">
				<div class="left">
				<a href="?action=tambah_barang" class="btnblue"><i class="fa fa-plus"></i> Tambah Barang</a>
				<a href="cetak_barang.php" class="btnblue" target="_blank"><i class="fa fa-print"></i> Cetak</a>
				</div>
				<div class="right">
					<script type="text/javascript">
						function gotocat(val){
							var value=val.options[val.selectedIndex].value;
							window.location.href="barang.php?id_cat="+value+"";
						}
					</script>
					<select class="leftin1" onchange="gotocat(this)">
						<option value="">Filter kategori</option>
						<?php
							$data=$root->con->query("select * from kategori");
							while ($f=$data->fetch_assoc()) {
								?>
									<option <?php if (isset($_GET['id_cat'])) { if ($_GET['id_cat'] == $f['id_kategori']) { echo "selected"; } } ?> value="<?= $f['id_kategori'] ?>"><?= $f['nama_kategori'] ?></option>
								<?php
							}
						?>
					</select>
					<form class="leftin">
						<input type="search" name="q" placeholder="Cari Barang..." value="<?php echo $keyword=isset($_GET['q'])?$_GET['q']:""; ?>">
						<button><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="both"></div>
			</div>
			<span class="label">Jumlah Barang : <?= $root->show_jumlah_barang() ?></span>
			<table class="datatable" id="datatable">
				<thead>
				<tr>
					<th width="10px">#</th>
					<th style="cursor: pointer;">Kode Barang <i class="fa fa-sort"></i></th>
					<th style="cursor: pointer;">Nama Barang <i class="fa fa-sort"></i></th>
					<th style="cursor: pointer;" width="100px">Kategori <i class="fa fa-sort"></i></th>
					<th>Stok</th>
					<th width="120px">Harga Modal</th>
					<th width="120px">Harga Jual</th>
					<th width="150px">Tanggal Ditambahkan</th>
					<th width="60px">Aksi</th>
				</tr>
			</thead>
			<tbody>
					<?php
					if (isset($_GET['id_cat']) && $_GET['id_cat']) {
						$root->tampil_barang_filter($_GET['id_cat']);
					}else{
						$keyword=isset($_GET['q'])?$_GET['q']:"null";
						$root->tampil_barang($keyword);
					}
					?>
</tbody>

			</table>
			</div>
		</div>
	</div>
</div>


<?php 
}
include "foot.php" ?>
