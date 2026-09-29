<?php
include "../../../webclass.php";
$db=new kelas;
require('fpdf.php');
$s=$db->select("m_cabang","*","id_cabang='$_GET[cab]'");
foreach($s as $cabang){}

$pdf=new FPDF('L','mm');
//$pdf->SetAutoPageBreak(true,15);
//$pdf->SetMargins(15,8,0);
//$pdf->AliasNbPages();
$pdf->AddPage();
/////////////////////////////////////////////////////// HEADER ///////////////////////
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'LAPORAN PENERIMAAN BARANG',0,1,'C',false);
$pdf->Cell(0,5,'PERIODE   : '.$_GET['a'],0,1,'L',false);
$pdf->Ln(1);
/////////////////////////////////////////////// END ///////////////////////////////

///////////////////////////////////////////TABEL HEADER //////////////////////////////
$pdf->SetFont('Times','B',10);
$pdf->Cell(10,5,'No',1,0,'C');
$pdf->Cell(30,5,'No BM',1,0,'C');
$pdf->Cell(20,5,'Tgl',1,0,'C');
$pdf->Cell(30,5,'No Ref',1,0,'C');
$pdf->Cell(30,5,'Surat Jalan',1,0,'C');
$pdf->Cell(25,5,'Dari',1,0,'C');
$pdf->Cell(20,5,'Gudang',1,0,'C');
$pdf->Cell(30,5,'Nama Barang',1,0,'L',false);
$pdf->Cell(20,5,'#',1,0,'C');
$pdf->Cell(10,5,'Qty',1,0,'C');
$pdf->Cell(20,5,'Qty Terima',1,0,'C');
$pdf->Cell(20,5,'Claim Utuh',1,0,'C');
$pdf->Cell(20,5,'Claim Ktg',1,0,'C'); 
$pdf->Cell(1,5,'',1,1,'C');//////////// ganti baris //////////////
////////////////////////////////////////////////////// E N D /////////////////////////////////////////////

////////////////////////////////////////// DATA ////////////////////////////////////////
$no=1;
$z=$db->select("v_l_bm","*","id_cabang='$_GET[cab]' AND tgl BETWEEN '$_GET[a]' AND '$_GET[b]' and jenis='$_GET[jenis]'");
foreach($z as $zoro){
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$end_y = $pdf->GetY();
$pdf->SetFont('Times','',9);
$pdf->MultiCell(10,20,$no,1,'C');
$current_x = $current_x +10;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,20,$zoro['no_masuk'],1,'L');
$current_x = $current_x +30;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20,20,$zoro['tgl'],1,'C');
$current_x = $current_x + 20;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,20,$zoro['no_ref'],1,'C');
$current_x = $current_x + 30;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,20,$zoro['surat_jalan'],1,'C');
$current_x = $current_x +30;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(25,6.7,$zoro['dari_siapa'],1,'L');
$current_x = $current_x + 25;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20,10,$zoro['nama_gudang'],1,'C');
$current_x = $current_x + 20;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,6.7,$zoro['nama_barang'],1,'L');
$current_x = $current_x + 30;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20,20,$zoro['nama_satuan'],1,'C');
$current_x = $current_x + 20;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(10,20,$zoro['qty'],1,'C');
$current_x = $current_x + 10;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20,20,$zoro['qty_terima'],1,'C');
$current_x = $current_x + 20;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20,20,$zoro['claim_utuh'],1,'C');
$current_x = $current_x + 20;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20,20,$zoro['claim_ktg'],1,'C');
$current_x = $current_x + 20;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(1,20,'',1,'C');
$no++;
}
$pdf->SetFont('Times','',11);

$pdf->Output();
?>