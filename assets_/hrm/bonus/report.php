<?php 
require( 'webclass.php' );
$db=new kelas;
session_start();
?>
<style>
table {
		  border-collapse: collapse
	  }
table, td, th {
				  border: 1px solid #DDD ;
				  padding:1px;
			  }
.th2{	
		border-top: 1px solid #ddd;	
	}
td{
padding:3px;	
}
.td2 {
			   
               border: 0px solid #666; font-size:11px; 
               vertical-align:middle; padding:0px;
           }
</style>
 <?php
		if($_GET['tahun']!='' && $_GET['jenis']!=''){
			$kon=$db->select("hr_bonus a 
			left join m_pegawai b on a.id_pegawai=b.id_pegawai","a.*,b.nama_pegawai,b.nik","year(a.periode)='$_GET[tahun]' and a.jenis='$_GET[jenis]' and a.id_pegawai='$_GET[id]'");
		}
		$totpot=0;
        foreach($kon as $d){ 
		$totpot=$d['pot_pelanggaran']+$d['pot_lain'];
		}
		?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
  	<td colspan="6" style="width:3%;font-size:16px;text-align:center"><b>LAPORAN BONUS<BR><BR>PERIODE : <?=$_GET['tahun']?></b></td>
</tr>
  <tr>
  	<td style="width:15%;font-size:11px;text-align:left;"><b>Nama Pegawai</b></td>
    <td style="width:27%;font-size:11px;text-align:left"><?php echo ucfirst(strtolower($d['nama_pegawai']));?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Jabatan</b></td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Bank</b></td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
  </tr>
   <tr>
  	<td style="width:15%;font-size:11px;text-align:left"><b>Kode Pegawai</b></td>
    <td style="width:10%;font-size:11px;text-align:left"><?php echo $d['nik'];?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Cabang</b></td>
    <td style="width:15%;font-size:11px;text-align:left"></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>NPWP</b></td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
  </tr>
  <tr>
  	<td style="width:15%;font-size:11px;text-align:left" rowspan="3"><b>Periode</b></td>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="3"><?php echo $d['periode'];?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Golongan</b></td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="3"><b>No. Rek</b></td>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Bagian</b></td>
    <td style="width:10%;font-size:11px;text-align:left">&nbsp;</td>
  </tr>
  <tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Unit</b></td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
  </tr>
<tr>
  	<td colspan="6" style="width:3%;font-size:15px;text-align:center">&nbsp;</td>
</tr>
<tr>
  	<td style="width:10%;font-size:11px;text-align:center" colspan="4"><b>Kesejahteraan</b></td>
    <td style="width:10%;font-size:11px;text-align:center" colspan="2"><b>Potongan</b></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Gaji Pokok</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?php echo number_format($d['gaji_pokok']);?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Tunj Tetap</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?php echo number_format($d['tunjangan_tetap']);?></td>
    <td style="width:10%;font-size:11px;text-align:left"><strong>Pelanggaran</strong></td>
    <td style="width:10%;font-size:11px;text-align:right"><?php echo number_format($d['pot_pelanggaran']);?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Presensi</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?php echo number_format($d['insentif_presensi']);?></td>
    <td style="width:14%;font-size:11px;text-align:left">&nbsp;</td>
    <td style="width:10%;font-size:11px;text-align:right">&nbsp;</td>
    <td style="width:14%;font-size:11px;text-align:left">&nbsp;</td>
    <td style="width:10%;font-size:11px;text-align:right">&nbsp;</td>
</tr>
<tr>
    <td rowspan="2" style="width:10%;font-size:11px;text-align:left"><strong>Total</strong></td>
    <td rowspan="2" style="width:10%;font-size:11px;text-align:right"><?php echo number_format($d['total'])?></</td>
    <td style="width:14%;font-size:11px;text-align:left">&nbsp;</td>
    <td style="width:10%;font-size:11px;text-align:right">&nbsp;</td>
    <td rowspan="2" style="width:14%;font-size:11px;text-align:left"><span style="width:10%;font-size:11px;text-align:left"><b>Lain</b></span></td>
    <td rowspan="2" style="width:10%;font-size:11px;text-align:right"><?php echo number_format($d['pot_lain']);?></td>
</tr>
<tr>
    <td style="width:17%;font-size:11px;text-align:left">&nbsp;</td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
  </tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left" colspan="5"><b>Jumlah Bonus</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?php echo number_format($d['jumlah_bonus']);?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left" colspan="5"><b>Jumlah Potongan</b></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($totpot)?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left" colspan="5"><b>Jumlah Terima</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?php echo number_format($d['jumlah_terima']);?></td>
</tr>
</table>