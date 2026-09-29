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
$var=$db->select("hr_posting_gaji_habor a
LEFT JOIN m_pegawai b ON a.id_pegawai = b.id_pegawai
JOIN m_cabang d on b.id_cabang=d.id_cabang
LEFT JOIN m_jabatan f on b.id_jabatan=f.id_jabatan","
a.*,
b.nama_pegawai,
b.nik,
d.nama_cabang,f.nama_jabatan","a.id = '$_GET[id]'
ORDER BY
	a.id ASC
LIMIT 0,
 1");
$jumlah_pot=0;
foreach($var as $gg){
}
?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
  	<td colspan="4" style="width:3%;font-size:16px;text-align:center"><b>SLIP GAJI<BR><BR>PERIODE : <?=$gg['bulan']?>-<?=$gg['tahun']?></b></td>
</tr>
  <tr>
  	<td style="width:15%;font-size:11px;text-align:left;"><b>Nama Pegawai</b></td>
    <td style="width:27%;font-size:11px;text-align:left"><?=$gg['nama_pegawai']?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Cabang</b></td>
    <td style="width:15%;font-size:11px;text-align:left"><?=$gg['nama_cabang']?></td>
  </tr>
   <tr>
  	<td style="width:15%;font-size:11px;text-align:left"><b>Kode Pegawai</b></td>
    <td style="width:10%;font-size:11px;text-align:left"><?=$gg['nik']?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Bagian</b></td>
    <td style="width:10%;font-size:11px;text-align:left"><?=$gg['nama_jabatan']?></td>
  </tr>
  <tr>
  	<td style="width:15%;font-size:11px;text-align:left" rowspan="3"><b>Periode</b></td>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="3"><?=$gg['bulan']?>-<?=$gg['tahun']?></td>
    <td style="width:10%;font-size:11px;text-align:left">&nbsp;</td>
    <td style="width:10%;font-size:11px;text-align:left">&nbsp;</td>
  </tr>
  <tr>
    <td style="width:10%;font-size:11px;text-align:left">&nbsp;</td>
    <td style="width:10%;font-size:11px;text-align:left">&nbsp;</td>
  </tr>
  <tr>
    <td style="width:10%;font-size:11px;text-align:left">&nbsp;</td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
  </tr>

<tr>
  	<td style="width:10%;font-size:11px;text-align:center" colspan="4"><b>Rincian</b></td>
  </tr>
<tr>
    <td colspan="3" style="width:10%;font-size:11px;text-align:left"><b>Gaji Diterima</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['jumlah_terima'],2)?></td>
  </tr>
<tr>
    <td colspan="3" style="width:10%;font-size:11px;text-align:left"><b>Lembur</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['lembur'],2)?></td>
  </tr>
<tr>
    <td colspan="3" style="width:10%;font-size:11px;text-align:left"><b>Diterima</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><b>
      <?=number_format($gg['total_terima'],2)?></b></td>
  </tr>
</table>