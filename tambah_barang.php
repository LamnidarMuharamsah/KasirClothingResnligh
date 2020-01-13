<script type="text/javascript">
	document.title="Tambah Barang";
	document.getElementById('barang').classList.add('active');
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Tambah Barang</h3>
					<?php  
						$query=$root->con->query("SELECT max(id_barang) FROM barang");
						
					 
						$kode_faktur = mysqli_fetch_array($query);
					 
						if($kode_faktur){
							$nilai = substr($kode_faktur[0], 1);
							$kode = (int) $nilai;
					 
							//tambahkan sebanyak + 1
							$kode = $kode + 1;
							$auto_kode = "B" .str_pad($kode, 4, "0",  STR_PAD_LEFT);
						} else {
							$auto_kode = "B0001";
						}
					?>
				<form class="form-input" method="post" action="handler.php?action=tambah_barang">
					
					<input type="text" name="id_barang" value="<?php echo $auto_kode; ?>" required="required" readonly="readonly">
					<input type="text" name="nama_barang" placeholder="Nama Barang" required="required">
					<input type="number" name="stok" placeholder="Stok" required="required">
					<input type="number" name="harga_beli" placeholder="Harga Modal" required="required">
					<input type="number" name="harga_jual" placeholder="Harga Jual" required="required">
					<select style="width: 372px;cursor: pointer;" required="required" name="kategori">
						<option value="">Pilih Kategori :</option>
						<?php $root->tampil_kategori2(); ?>
					</select>
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<a href="barang.php" class="btnblue" style="background: #f33155"><i class="fa fa-close"></i> Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>
