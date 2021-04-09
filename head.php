<?php
include "root.php";
session_start();
if (!isset($_SESSION['username'])) {
	$root->redirect("index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/index.css">
	<link rel="stylesheet" type="text/css" href="assets/awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/datatable/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/datatable/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/datatable/css/select2.min.css">



	<script type="text/javascript" src="assets/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/datatable/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="assets/datatable/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="assets/datatable/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="assets/datatable/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/datatable/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="assets/datatable/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="assets/datatable/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/datatable/js/jszip.min.js"></script>
	<script type="text/javascript" src="assets/datatable/js/moment.js"></script>
	<script type="text/javascript" src="assets/datatable/js/pdfmake.min.js"></script>
	<script type="text/javascript" src="assets/datatable/js/vfs_fonts.js"></script>

	<script type="text/javascript" src="assets/datatable/js/select2.min.js"></script>

</head>

<body>

	<div class="sidebar">
		<h3><i class="fa fa fa-shopping-cart"></i> RESNLIGHT</h3>
		<ul><?php
			if ($_SESSION['status'] == 1) {
			?>
				<li class="admin-info">
					<img src="assets/img/logo.jpg">
					<span></i>OWNER SHOP RULY</span>
				</li>
				<li><a id="dash" href="home.php"><i class="fa fa-home"></i> Dashboard</a></li>
				<li><a id="barang" href="barang.php"><i class="fa fa-bars"></i> Barang</a></li>
				<li><a id="kategori" href="kategori.php"><i class="fa fa-tags"></i> Kategori Barang</a></li>
				<li><a id="users" href="users.php"><i class="fa fa-users"></i> Kasir</a></li>
				<li><a id="laporan" href="laporan.php"><i class="fa fa-book"></i> Laporan Penjualan</a></li>
				<li><a id="laporan_stok" href="laporan_barang_stok.php"><i class="fa fa-book"></i> Laporan Stok Modal</a></li>

			<?php
			} else {
			?>
				<li><a id="transaksi" href="transaksi.php"><i class="fa fa-money"></i> Transaksi</a></li>

			<?php
			}
			?>
		</ul>
	</div>
	<div class="nav">
		<ul>
			<li><a href=""><i class="fa fa-user"></i> <?= $_SESSION['username'] ?></a>
				<ul>
					<?php
					if ($_SESSION['status'] == 1) {
					?>
						<li><a href="setting_akun.php"><i class="fa fa-cog"></i> Pengaturan Akun</a></li>
					<?php } ?>
					<li><a href="handler.php?action=logout"><i class="fa fa-sign-out"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>