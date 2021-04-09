<?php
require('assets/lib/fpdf.php');
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 30);
        $this->Cell(30, 10, 'RESNLIGHT');

        $this->Ln(10);
        $this->SetFont('Arial', 'i', 10);
        $this->cell(30, 10, 'JL Amin Jasuta No.1069');


        $this->Ln(5);
        $this->SetFont('Arial', 'i', 10);
        $this->cell(30, 10, 'Telepon : 087771111761');


        $this->Ln(5);
        $this->SetFont('Arial', 'i', 10);
        $this->cell(30, 10, 'Data Laporan Tanggal : ' . $_POST['tgl_laporan'] . '');

        $this->Ln(5);
        $this->SetFont('Arial', 'i', 10);
        $this->cell(30, 10, 'Jenis : ' . $_POST['jenis_laporan'] . '');

        $this->cell(130);
        $this->SetFont('Arial', '', 10);
        $this->cell(30, 10, 'Serang, ' . date("d-m-Y") . '');

        $this->Line(10, 45, 200, 45);
        $this->Ln(15);
    }
    function data_barang()
    {
        $con = mysqli_connect("localhost", "root", "", "resnlight");
        $tanggal = $_POST['tgl_laporan'];
        if ($_POST['jenis_laporan'] == "perhari") {
            $split1 = explode('-', $tanggal);
            $tanggal = $split1[2] . "-" . $split1[1] . "-" . $split1[0];
            $query = mysqli_query($con, "
                select t.id_transaksi,t.tgl_transaksi,t.no_invoice,SUM(b.harga_beli* st.jumlah_beli) as modal,t.total_bayar,t.nama_pembeli,user.username 
                    from transaksi t
                    join sub_transaksi st on t.id_transaksi=st.id_transaksi
                    join barang b on b.id_barang=st.id_barang
                    join user on t.kode_kasir=user.id 
                    where t.tgl_transaksi like '%$tanggal%' 
                    GROUP by st.no_invoice ASC");
        } else if ($_POST['jenis_laporan'] == "perbulan") {
            $split1 = explode('-', $tanggal);
            $tanggal = $split1[1] . "-" . $split1[0];
            $query = mysqli_query($con, "
                select t.id_transaksi,t.tgl_transaksi,t.no_invoice,SUM(b.harga_beli* st.jumlah_beli) as modal,t.total_bayar,t.nama_pembeli,user.username 
                    from transaksi t
                    join sub_transaksi st on t.id_transaksi=st.id_transaksi
                    join barang b on b.id_barang=st.id_barang
                    join user on t.kode_kasir=user.id 
                    where t.tgl_transaksi like '%$tanggal%' 
                    GROUP by st.no_invoice ASC");
        } else if ($_POST['jenis_laporan'] == "pertahun") {
            $split1 = explode('-', $tanggal);
            $tanggal = $split1[0];
            $query = mysqli_query($con, "
                select t.id_transaksi,t.tgl_transaksi,t.no_invoice,SUM(b.harga_beli* st.jumlah_beli) as modal,t.total_bayar,t.nama_pembeli,user.username 
                    from transaksi t
                    join sub_transaksi st on t.id_transaksi=st.id_transaksi
                    join barang b on b.id_barang=st.id_barang
                    join user on t.kode_kasir=user.id 
                    where t.tgl_transaksi like '%$tanggal%' 
                    GROUP by st.no_invoice ASC");
        }
        while ($r =  mysqli_fetch_array($query)) {
            $hasil[] = $r;
        }
        return $hasil;
    }
    function set_table($data)
    {
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(7, 7, "No", 1);
        $this->Cell(32, 7, "No Invoice", 1);
        $this->Cell(20, 7, "Kasir", 1);
        $this->Cell(25, 7, "Nama Pembeli", 1);
        $this->Cell(32, 7, "Tanggal Transaksi", 1);
        $this->Cell(24, 7, "Modal", 1);
        $this->Cell(24, 7, "Total Bayar", 1);
        $this->Cell(25, 7, "Keuntungan", 1);

        $this->Ln();

        $this->SetFont('Arial', '', 9);
        $no = 1;
        $sum_modal = 0;
        $sum_total = 0;
        $sum_keuntungan = 0;
        foreach ($data as $row) {
            $this->Cell(7, 7, $no++, 1);
            $this->Cell(32, 7, $row['no_invoice'], 1);
            $this->Cell(20, 7, $row['username'], 1);
            $this->Cell(25, 7, $row['nama_pembeli'], 1);
            $this->Cell(32, 7, date("d-m-Y h:i:s", strtotime($row['tgl_transaksi'])), 1);
            $this->Cell(24, 7, "Rp. " . number_format($row['modal']), 1);
            $this->Cell(24, 7, "Rp. " . number_format($row['total_bayar']), 1);
            $this->Cell(25, 7, "Rp. " . number_format($row['total_bayar'] - $row['modal']), 1);

            $this->Ln();

            $sum_modal += $row['modal'];
            $sum_total += $row['total_bayar'];
            $sum_keuntungan += ($row['total_bayar'] - $row['modal']);
        }
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(7, 7);
        $this->Cell(32, 7);
        $this->Cell(20, 7);
        $this->Cell(25, 7);
        $this->Cell(32, 7, "Total", 1);
        $this->Cell(24, 7, "Rp. " . number_format($sum_modal), 1);
        $this->Cell(24, 7, "Rp. " . number_format($sum_total), 1);
        $this->Cell(25, 7, "Rp. " . number_format($sum_keuntungan), 1);
        $this->Ln(25);
    }
}

$pdf = new PDF();
$pdf->SetTitle('Cetak Data Barang');

$data = $pdf->data_barang();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(1);
$pdf->set_table($data);
$pdf->Output('', 'resnlight/Barang/' . date("d-m-Y") . '.pdf');
