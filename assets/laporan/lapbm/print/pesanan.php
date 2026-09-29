<?php
define('FPDF_FONTPATH','fpdf17/font/');
require('fpdf17/fpdf.php');
require('serverconfig.php');
class PDF extends FPDF{

  function Header(){
   $this->SetTextColor(128,0,0); 
   $this->SetFont('Arial','B','10'); 
   
   
   $this->Cell(1);
   $this->Cell(17,0,'Mutiara Gallery',0,0,'C');
   $this->Ln();
   $this->Cell(1);
   $this->Cell(17,1,'Distibutor Gamis - Karawang',0,0,'C');

	$this->Ln();
   $this->SetFont('Arial','','8');
   $this->SetTextColor(0,0,0);
   $this->Cell(1);
   $this->Cell(2,0.4,'Pemesan',0,0,'L');$this->Cell(7,0.5,':  ',0,0,'L'); $this->Cell(2,0.4,'No. Pesanan',0,0,'L');$this->Cell(1,0.4,': XXXX',0,0,'L');
   $this->Ln();
   $this->Cell(3);$this->Cell(7,0.4,'  ',0,0,'L'); $this->Cell(2,0.4,'Tgl Pesanan',0,0,'L');$this->Cell(1,0.4,': dd-mm-yy',0,0,'L');
   $this->Ln();
   $this->Cell(3);$this->Cell(7,0.4,'  ',0,0,'L'); $this->Cell(2,0.4,'Halaman',0,0,'L');$this->Cell(1,0.4,': 1 of 1',0,0,'L');
   
   $this->Ln();
   
   
 
   $this->Ln();
   $this->SetFillColor(192,192,192);
   $this->SetTextColor(0,0,0); 
   $this->Cell(1);
   $this->Cell(1,0.7,'No','TB',0,'C',1); 
   $this->Cell(3,0.7,'Item','TB',0,'C',1); 
   $this->Cell(5,0.7,'Deskripsi','TB',0,'C',1); 
   $this->Cell(3,0.7,'Qty','TB',0,'C',1);  
   $this->Cell(2,0.7,'Dis','TB',0,'C',1); 
   $this->Cell(3,0.7,'Harga','TB',0,'C',1); 
  
   $this->Ln();
  }

  function Footer(){
		
		$this->SetY(11);
		$this->Cell(1);
 $this->Cell(17,0.2,'','B',1,'L');
   $this->Ln();   $this->Ln();
		$this->SetFont('Arial','',8);
		
   
$this->Cell(1);$this->Cell(3,0.4,' ',0,0,'L',0);$this->Cell(7,0.4,'',0,0,'L',0);$this->Cell(3,0.4,'Subtotal :',0,0,'R',0);$this->Cell(4,0.4,'0',0,0,'R',0);$this->Ln();
$this->Cell(1);$this->Cell(3,0.4,'',0,0,'L',0);$this->Cell(7,0.4,'',0,0,'L',0);$this->Cell(3,0.4,'Discount :',0,0,'R',0);$this->Cell(4,0.4,'0',0,0,'R',0);$this->Ln();              
$this->Cell(1);$this->Cell(3,0.4,' ',0,0,'L',0);$this->Cell(7,0.4,'',0,0,'L',0);$this->Cell(3,0.4,'PPN :',0,0,'R',0);$this->Cell(4,0.4,'0',0,0,'R',0);$this->Ln();
$this->Cell(1);$this->Cell(3,0.4,' ',0,0,'L',0);$this->Cell(7,0.4,'',0,0,'L',0);$this->Cell(3,0.4,'Total Order :',0,0,'R',0);$this->Cell(4,0.4,'0',0,0,'R',0);$this->Ln();
  } 
 }

 
$kode = $_REQUEST['nopesan'];
$q = mysql_query("select * from pesanan_detail where kodepesan ='$kode'");
 $i = 0;
 

 while($d=mysql_fetch_array($q)){
  $cell[$i][0]=$d['idbarang'];
  $cell[$i][1]=$d['hrgbeli'];
  $cell[$i][2]=$d['hrgjual'];
  $cell[$i][3]=$d['qty'];

  
  $i++;
 }

 $orientation = 'L';
 $size='A5';
 $pdf = new PDF($orientation,'cm',$size);

 $pdf->Open();
 $pdf->AliasNbPages();
 $pdf->AddPage();

 $pdf->SetFont('Arial','','8');
 for($j=0;$j<$i;$j++){
  $pdf->Cell(1);
  $pdf->Cell(1,0.5,$j+1,'',0,'C');
  $pdf->Cell(3,0.5,$cell[$j][0],'',0,'C');
  $pdf->Cell(5,0.5,'Deskripsi','',0,'L');
  $pdf->Cell(3,0.5,$cell[$j][3],'',0,'L');
  $pdf->Cell(2,0.5,'','',0,'L');
  $pdf->Cell(3,0.5,$cell[$j][1],'',0,'L');
  $pdf->Ln();
   
 }
 


 $pdf->Output(); 

?>