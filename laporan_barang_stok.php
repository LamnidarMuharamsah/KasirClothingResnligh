<?php include "head.php" ?>
<?php
if (isset($_GET['action']) && $_GET['action'] == "detail_transaksi") {
    include "detail_transaksi.php";
} else {
?>
    <script type="text/javascript">
        document.title = "Laporan Stok";
        document.getElementById('laporan_stok').classList.add('active');
    </script>

    <div class="content">
        <div class="padding">
            <div class="bgwhite">
                <div class="padding">
                    <div class="contenttop">
                        <div class="left">
                            <h3 class="jdl">Laporan Stok Modal Barang</h3>
                        </div>
                        <div class="right">
                            <a href="cetak_laporan_barang_stok.php" class="btnblue" target="_blank">
                                <i class="fa fa-print"></i> Cetak</a>
                        </div>
                        <div class="both"></div>
                    </div>
                    <table class="datatable" id="datatable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th style="cursor: pointer;">Kode Barang <i class="fa fa-sort"></i></th>
                                <th style="cursor: pointer;">Nama Barang <i class="fa fa-sort"></i></th>
                                <th style="cursor: pointer;" width="100px">Kategori <i class="fa fa-sort"></i></th>
                                <th>Stok</th>
                                <th width="120px">Harga Modal</th>
                                <th width="120px">Total Aset Modal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['id_cat']) && $_GET['id_cat']) {
                                $root->tampil_barang_filter($_GET['id_cat']);
                            } else {
                                $keyword = isset($_GET['q']) ? $_GET['q'] : "null";
                                $root->tampil_laporan_stok($keyword);
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