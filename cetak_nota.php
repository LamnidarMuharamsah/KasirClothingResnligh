<?php
require('assets/lib/fpdf.php');
class PDF extends FPDF
{
function Header()
{
   
    $this->SetFont('Arial','B',8);

    $this->Cell(10,0,'RESNLIGHT');

    $this->Ln(3);
    $this->SetFont('Arial','i',3.5);
    $this->cell(10,0.5,'Jl Amin Jasuta No.1069 (BRIMOB) Serang-Banten'.'');

    $this->Ln(2);
    $this->SetFont('Arial','',4);
    $this->cell(10,0.5,'Tanggal');
    $this->cell(1,0.5,':');
    $this->cell(10,0.5,''.base64_decode($_GET['uuid']).'');

    $this->Ln(2);
    $this->SetFont('Arial','',4);
    $this->cell(10,0.5,'No Invoice');
    $this->cell(1,0.5,':');
    $this->cell(10,0.5,''.base64_decode($_GET['inf']).'');
       
    $this->Ln(1.5);
  
    $this->SetFont('Arial','',4);
    $this->cell(10,0.5,'Konsumen');
    $this->cell(1,0.5,':');
    $this->Cell(10,0.5,''.base64_decode($_GET['id-uid']).'');

    $this->Ln(1.5);

    session_start();
    $this->cell(10,0.5,'Kasir');
    $this->cell(1,0.5,':');
    $this->cell(10,0.5,''.$_SESSION['username'].'');
    
    $this->Ln(1.5);
    $this->SetFont('Arial','',4);
    $this->cell(10,0.5,'Instagram');
    $this->cell(1,0.5,':');
    $this->cell(10,0.5,'resnlight_official');
    $this->Line(1,17,28,17);
    $this->Line(1,17,28,17);
    $this->Line(1,17,28,17);
}
function LoadData(){
	mysql_connect("localhost","root","");
	mysql_select_db("resnlight");
	$id=base64_decode($_GET['oid']);
	$data=mysql_query("select sub_transaksi.jumlah_beli,barang.nama_barang,barang.harga_jual,sub_transaksi.total_harga,sub_transaksi.bayar,sub_transaksi.diskon from sub_transaksi inner join barang on barang.id_barang=sub_transaksi.id_barang where sub_transaksi.id_transaksi='$id'");
	
	while ($r=  mysql_fetch_array($data))
		        {
		            $hasil[]=$r;
		        }
		        return $hasil;
}
function BasicTable($header, $data)
{
    
    $this->SetFont('Arial','B',3.5);
        $this->Cell(10.5,2,$header[0]);
        $this->Cell(7.5,2,$header[1]);
        $this->Cell(2.5,2,$header[2]);

        $this->Cell(7,2,$header[3]);
    $this->Ln();
    
    $this->SetFont('Arial','B',3.5);
    $bayar = 0;
    foreach($data as $row)
    {
  
        $this->Cell(10.5,2,$row['nama_barang']);
        $this->Cell(7.5,2,"Rp ".number_format($row['harga_jual']));
        $this->Cell(2.5,2,$row['jumlah_beli']);
        $this->Cell(7,2,"Rp ".number_format($row['total_harga']));
        $this->Ln();
    
    $bayar = $row['bayar'];
    $diskon = $row['diskon'];


    }

    mysql_connect("localhost","root","");
	mysql_select_db("renslight");
	$id=base64_decode($_GET['oid']);

    $getsum=mysql_query("select sum(total_harga) as grand_total,sum(jumlah_beli) as jumlah_beli , (sum(total_harga)*diskon/100) as potongan from sub_transaksi where id_transaksi='$id'");
	$getsum1=mysql_fetch_array($getsum);
    
    $this->SetFont('Arial','B',4);
    $this->Ln(2);
	$this->cell(10,0.5,'Total ');
    $this->cell(10,0.5,':');
	$this->cell(5,0.5,'Rp. '.number_format($getsum1['grand_total']));

    $this->Ln(2);
    $this->cell(10,0.5,'Diskon ');
    $this->cell(10,0.5,':');
    $this->Cell(5,0.5,number_format($diskon)."%"); 

    $this->Ln(2);
    $this->cell(10,0.5,'Grand Total ');
    $this->cell(10,0.5,':');
    $this->cell(5,0.5,'Rp. '.number_format($getsum1['grand_total']-$getsum1['potongan']));
	
    $this->Ln(2);
    $this->cell(10,0.5,'Bayar ');
    $this->cell(10,0.5,':');
    $this->Cell(5,0.5,"Rp. ".number_format($bayar));
    $this->Ln(2);   


    $this->cell(10,0.5,'Kembalian ');
    $this->cell(10,0.5,':');
    $this->Cell(5,0.5,"Rp. ".number_format($bayar -($getsum1['grand_total']-$getsum1['potongan'])));

    $this->Ln(1.5);
    $this->SetFont('Arial','',4);
  

    $this->Ln(1);
    $this->SetFont('Arial','B',3);
    $this->cell(-10,-1,'* Barang Yang Sudah Dibeli Tidak Bisa Dikembalikan.');
    
} 

}

$pdf = new PDF("p","mm",array(58,35));
$pdf->SetMargins(0,4,10); 
$pdf->SetTitle('Invoice : '.base64_decode($_GET['inf']).'');
$pdf->AliasNbPages();
$header = array('Nama Barang','Harga' ,'Qty', 'Total Harga');
$data = $pdf->LoadData();
$pdf->AddPage();

$pdf->Ln(2);
$pdf->BasicTable($header,$data);
$filename=base64_decode($_GET['inf']);
$pdf->Output('','RESNLIGHT/'.$filename.'.pdf');
?>
