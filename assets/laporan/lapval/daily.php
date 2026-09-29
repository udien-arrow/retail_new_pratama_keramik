<?php
error_reporting(0);
session_start();
include"../../../webclass.php";
$db=new kelas();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
    .table1 {
        border-collapse: collapse;
    }
    
    .table1, .td, .th {
        border: 1px solid black;
        padding:3px;
    }
    </style>
    <style type="text/css">
    <!--
    
    
    body,td,th {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 12px;
    }
    
    -->
    </style>
</head>

<body>
<center>
PROFORMA PENDAPATAN<br />
<?php
 $tgl=date("Y-m-d");
 $tujuh_hari = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
 echo"".date("d M Y",$tujuh_hari)."";
 $tgl1=date("Y-m-d",$tujuh_hari);
 $bulan=date("m",$tujuh_hari);
 $tahun=date("Y",$tujuh_hari);
?>
</center>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td class="td"><strong>No</strong></td>
    <td class="td"><strong>Pendapatan dari</strong></td>
    <td class="td"><strong>Qty</strong></td>
    <td class="td"><strong>Total</strong></td>
  </tr>
  <?php
 
  $tbl1="tx_".(int)($bulan)."".$tahun." a
		JOIN bo_m_card b ON a.id_card = b.id_card
		JOIN bo_m_bank c ON c.id_bank = b.id_bank
		JOIN bo_spk_head d ON d.id_mitra=b.id_bank and jenis_mitra='1'";
  $field1=" sum(qty) as qty,
			sum(qty)*tarif as total,
			nama_bank,
			b.nama_card,
			tarif";
  $where1="jenis = '1'
			AND unit = '1'
			AND cabang = '6'
			AND date(tgl) = '$tgl1'
			group by b.id_bank, b.id_card"; 
  $no=1;

  foreach($db->select($tbl1,$field1,$where1) as $cc){
  
  ?>
  <tr>
    <td class="td"><?=$no?>&nbsp;</td>
    <td class="td"><?=strtoupper($cc[nama_bank])." - ".ucwords(strtolower($cc[nama_card]))?>&nbsp;</td>
    <td align="right"><?=$cc[qty]?>&nbsp;</td>
    <td align="right"><?=number_format($cc[total])?>&nbsp;</td>
  </tr>
  <?php 
  		$no++;
  $t+=$cc[total];
  } 

  $tbl1="tx_".(int)($bulan)."".$tahun." a";
  $field1=" sum(qty) as qty,
			sum(nominal) as total
			";
  $where1=" jenis = '2'
			AND unit = '1'
			AND cabang = '6'
			AND date(tgl) = '$tgl1'
			";
	foreach($db->select($tbl1,$field1,$where1) as $cc){
  
  ?>
  <tr>
    <td class="td"><?=$no?>&nbsp;</td>
    <td class="td">Debit Card&nbsp;</td>
    <td align="right"><?=$cc[qty]?>&nbsp;</td>
    <td align="right"><?=number_format($cc[total])?>&nbsp;</td>
  </tr>
  <?php 
   $no++;
   $t+=$cc[total];
   }
  $tbl1="tx_".(int)($bulan)."".$tahun." a";
  $field1=" sum(qty) as qty,
			sum(nominal) as total
			";
  $where1=" jenis = '3'
			AND unit = '1'
			AND cabang = '6'
			AND date(tgl) = '$tgl'
			";
	//echo"select $field1 from $tbl1 where $where1";		
	foreach($db->select($tbl1,$field1,$where1) as $cc){
  
  ?>
  <tr>
    <td class="td"><?=$no?>&nbsp;</td>
    <td class="td">Cash Payment&nbsp;</td>
    <td align="right"><?=$cc[qty]?>&nbsp;</td>
    <td align="right"><?=number_format($cc[total])?>&nbsp;</td>
  </tr>
  <?php 
  		$no++;
  $t+=$cc[total];
  }	

  
  $tbl1="tx_".(int)($bulan)."".$tahun." a
  		JOIN bo_pkslain b ON b.idpks=a.id_card
		JOIN bo_spk_head d ON d.id_mitra=a.id_card and jenis_mitra='2'";
  $field1=" sum(qty) AS qty,
			sum(qty) * tarif AS total,
			b.nama,
			tarif";
  $where1="jenis = '5'
			AND unit = '1'
			AND cabang = '6'
			AND date(tgl) = '$tgl'
			group by a.id_card";			 			
 //echo"select $field1 from $tbl1 where $where1";	
 foreach($db->select($tbl1,$field1,$where1) as $cc){
  
  ?>
  <tr>
    <td class="td"><?=$no?>&nbsp;</td>
    <td class="td"><?=$cc[nama]?>&nbsp;</td>
    <td align="right"><?=$cc[qty]?>&nbsp;</td>
    <td align="right"><?=number_format($cc[total])?>&nbsp;</td>
  </tr>
  <?php 
  		$no++;
	$t+=$cc[total];	
	}
	 $tbl1="tx_".(int)($bulan)."".$tahun." a";
  $field1=" sum(qty) as qty,
			sum(nominal) as total
			";
  $where1=" jenis = '6'
			AND unit = '1'
			AND cabang = '6'
			AND date(tgl) = '$tgl'
			";
	//echo"select $field1 from $tbl1 where $where1";		
	foreach($db->select($tbl1,$field1,$where1) as $cc){
  
  ?>
  <tr>
    <td class="td"><?=$no?>&nbsp;</td>
    <td class="td">Reflexy &nbsp;</td>
    <td align="right"><?=$cc[qty]?>&nbsp;</td>
    <td align="right"><?=number_format($cc[total])?>&nbsp;</td>
  </tr>
  <?php 
  		$no++;
  $t+=$cc[total];
  }
   $tbl1="tx_".(int)($bulan)."".$tahun." a";
  $field1=" sum(qty) as qty,
			sum(nominal) as total
			";
  $where1=" jenis = '7'
			AND unit = '1'
			AND cabang = '6'
			AND date(tgl) = '$tgl'
			";
	//echo"select $field1 from $tbl1 where $where1";		
	foreach($db->select($tbl1,$field1,$where1) as $cc){
  
  ?>
  <tr>
    <td class="td"><?=$no?>&nbsp;</td>
    <td class="td">VIP Room&nbsp;</td>
    <td align="right"><?=$cc[qty]?>&nbsp;</td>
    <td align="right"><?=number_format($cc[total])?>&nbsp;</td>
  </tr>
  <?php 
  		$no++;
  $t+=$cc[total];
  }		
  ?>
  <tr>
    <td colspan="3" align="right"><strong>Grand Total</strong></td>
    <td align="right"><strong>
      <?=number_format($t)?>
    &nbsp;</strong></td>
  </tr>
</table>

</body>
</html>