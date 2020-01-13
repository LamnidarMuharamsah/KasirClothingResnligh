<script type="text/javascript">
	document.title="Transaksi Baru";
	document.getElementById('transaksi').classList.add('active');
</script>
<script type="text/javascript">
		$(document).ready(function(){
			if ($.trim($('#contenth').text())=="") {
				$('#prosestran').attr("disabled","disabled");
				$('#prosestran').attr("title","tambahkan barang terlebih dahulu");
				$('#prosestran').css("background","#ccc");
				$('#prosestran').css("cursor","not-allowed");
			}
		})

</script>
<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Entry  Transaksi Baru</h3>
				<form class="form-input" method="post" action="handler.php?action=tambah_tempo" style="padding-top: 30px;">
					<label>Pilih Barang : </label>
					<br>
					<br>
					<select style="width: 372px;cursor: pointer;" required="required" name="id_barang" class="select2-barang">
						<?php
						$data=$root->con->query("select * from barang");
						while ($f=$data->fetch_assoc()) {
							echo "<option value='$f[id_barang]'> Id Barang : $f[id_barang]  | $f[nama_barang] (Stock : $f[stok])</option>";
						}
						?>
					</select>
					<br>
					<br>
					<label>Jumlah Beli :</label>
					<input required="required" type="number" name="jumlah">
					<input type="hidden" name="trx" value="<?php echo date("d")."/AF/".$_SESSION['id']."/".date("y") ?>">
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Simpan</button>
			
		
			</form>

				
				
			</div>
		</div>
		<br>
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Data transaksi</h3>
				<table class="datatable" style="width: 100%;">
				<thead>
				<tr>
					<th width="35px">NO</th>
					<th>ID Barang</th>
					<th>Nama Barang</th>
					<th>Jumlah Beli</th>
					<th>Total Harga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="contenth">
				<?php
				$trx=date("d")."/AF/".$_SESSION['id']."/".date("y");
				$data=$root->con->query("select barang.nama_barang,tempo.id_subtransaksi,tempo.id_barang,tempo.jumlah_beli,tempo.total_harga from tempo inner join barang on barang.id_barang=tempo.id_barang where trx='$trx'");
				$getsum=$root->con->query("select sum(total_harga) as grand_total from tempo where trx='$trx'");
				$getsum1=$getsum->fetch_assoc();
				
				$no=1;
				while ($f=$data->fetch_assoc()) {
					?><tr>
						<td><?= $no++ ?></td>
						<td><?= $f['id_barang'] ?></td>
						<td><?= $f['nama_barang'] ?></td>
						<td><?= $f['jumlah_beli'] ?></td>
						<td>Rp. <?= number_format($f['total_harga']) ?></td>
						<td><a href="handler.php?action=hapus_tempo&id_tempo=<?= $f['id_subtransaksi'] ?>&id_barang=<?= $f['id_barang'] ?>&jumbel=<?= $f['jumlah_beli'] ?>" class="btn redtbl"><span class="btn-hapus-tooltip">Cancel</span><i class="fa fa-close"></i></a></td>
						</tr>
					<?php
				}
				?>
			</tbody>

				<tr>
				
					<td colspan="3"></td><td>Total :</td>
					<td > Rp. <?= number_format($getsum1['grand_total']) ?></td>
					
				</tr>
				
				
				<tr>
					<td colspan="3"></td><td>Diskon :</td>
					<td>
						<select id="dis">
							<option value="0">0%</option>
							<option value="10">10%</option>
							<option value="20">20%</option>
							<option value="30">30%</option>
							<option value="40">40%</option>
							<option value="50">50%</option>
							<option value="60">60%</option>
							<option value="70">70%</option>
							<option value="80">80%</option>
							<option value="90">90%</option>
							<option value="100">100%</option>
						</select>
					</td>
				</tr>
				<tr>
					<?php if ($getsum1['grand_total']>0) { ?>
					<td colspan="3"></td><td>Grand Total :</td>
					<td id="text_total"> Rp. <?= number_format($getsum1['grand_total']) ?></td> <input type="hidden" id="total" value="<?php echo $getsum1['grand_total']?>"> <input type="hidden" id="temp_total" value="<?php echo $getsum1['grand_total']?>">
					<td></td>
					<?php }else{ ?>
					<td colspan="6">Data masih kosong</td>
					<?php } ?>
				</tr>
				
				<tr>
					<td colspan="3"></td><td>Bayar :</td>
					<td><input type="number" id="cash"></td>
				</tr>
				
			
				<tr>
					<td colspan="3"></td><td>Kembalian :</td>
					<td><p id="kembalian">Rp.</p> </td>
				</tr>
			</table>
			<br>
			<form class="form-input" action="handler.php?action=selesai_transaksi" method="post">
					<label>Nama Pembeli :</label>
					<input required="required" type="text" name="nama_pembeli">
					<input type="hidden" name="bayar" value="0">
					<input type="hidden" name="diskon" value="0">
					<input type="hidden" name="total_bayar" value="<?= $getsum1['grand_total'] ?>">
					<button class="btnblue" id="prosestran" type="submit"><i class="fa fa-save"></i> Proses Transaksi</button>
			</form>

			</div>
		</div>


	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $(".select2-barang").select2({
	    	minimumInputLength: 1
	    });
	    $('#prosestran').prop('disabled', true);
	    var change = 0;	    
	    $('#dis').change(function() {
	    	var diskon = $('#dis').val();
	    	if (diskon > 0) {
	    		var total = parseInt($('#temp_total').val())-parseInt($('#temp_total').val()*diskon/100);
	    		$('#text_total').text("Rp. "+total.toLocaleString());
	    		$('#total').val(total);
	    		$('input[name=total_bayar]').val(total);
	    		$('input[name=diskon]').val(diskon);

	    	}else{
	    		var total = parseInt($('#temp_total').val())
	    		$('#text_total').text("Rp. "+total.toLocaleString());
	    		$('#total').val(total);
	    		$('input[name=total_bayar]').val(total);
	    		$('input[name=diskon]').val(diskon);
	    	}
	    	
	    	
	    });	       
	    $('#cash').change(function() {
	    	if (parseInt($('#total').val()) > parseInt($('#cash').val())) {
	    		alert('UANG KURANG MOHON ULANGI !');
	    		$('#cash').val(0);
	    		var change = 0;
	    		$('#prosestran').prop('disabled', true);
	    	}else{
	    		var change = $('#cash').val() - $('#total').val();
	    		$('input[name=bayar]').val($('#cash').val())
	    		$('#prosestran').prop('disabled', false);	    		
	    	}
	    	
	    	$('#kembalian').text("Rp. "+change.toLocaleString());
	    	$('#cash').val().toLocaleString();
	    });

	    console.log(change);
	    

	});
</script>
<?php
include "foot.php";
?>