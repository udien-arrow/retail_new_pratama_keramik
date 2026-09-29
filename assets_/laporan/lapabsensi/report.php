<?php 
session_start ();
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
		border-top: 0px;
		border-left: 0px;
		border-right: 0px;	
	}
.kop{
	border: 0px;
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
$var=$db->select("hr_posting_gaji a
LEFT JOIN m_pegawai b ON a.id_pegawai = b.id_pegawai
LEFT JOIN hr_pegawai_acc c ON b.id_pegawai = c.id_peg
JOIN m_cabang d on b.id_cabang=d.id_cabang
LEFT JOIN hr_st_jabatan e on a.id_st_jabatan=e.id_st_jabatan
LEFT JOIN m_jabatan f on b.id_jabatan=f.id_jabatan
LEFT JOIN hr_m_tingkat_golongan g on a.id_golongan=g.id_tingkat_gol","a.*,
b.nama_pegawai,
b.nik,
c.nama_bank,
c.no_rek,
d.nama_cabang,
e.st_jabatan AS bagian,
f.nama_jabatan AS jabatan,
g.tingkat_golongan AS golongan","a.id = '$_GET[id]'
ORDER BY
	c.id ASC
LIMIT 0,
 1");
$jumlah_pot=0;
foreach($var as $gg){
}
?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
  	<td colspan="6" style="width:3%;font-size:16px;text-align:center">
   <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
   <b><br>LAPORAN GAJI  <BR><BR>PERIODE : <?=$gg['bulan']?>-<?=$gg['tahun']?></b></td>
</tr>
  <tr>
  	<td style="width:15%;font-size:11px;text-align:left;"><b>Nama Pegawai</b></td>
    <td style="width:27%;font-size:11px;text-align:left"><?=$gg['nama_pegawai']?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Jabatan</b></td>
    <td style="width:10%;font-size:11px;text-align:left"><?=$gg['bagian']?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Bank</b></td>
    <td style="width:10%;font-size:11px;text-align:left"><?=$gg['nama_bank']?></td>
  </tr>
   <tr>
  	<td style="width:15%;font-size:11px;text-align:left"><b>Kode Pegawai</b></td>
    <td style="width:10%;font-size:11px;text-align:left"><?=$gg['nik']?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Cabang</b></td>
    <td style="width:15%;font-size:11px;text-align:left"><?=$gg['nama_cabang']?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>NPWP</b></td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
  </tr>
  <tr>
  	<td style="width:15%;font-size:11px;text-align:left" rowspan="3"><b>Periode</b></td>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="3"><?=$gg['bulan']?>-<?=$gg['tahun']?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Golongan</b></td>
    <td style="width:10%;font-size:11px;text-align:left"><?=$gg['golongan']?></td>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="3"><b>No. Rek</b></td>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="3"><?=$gg['no_rek']?></td>
  </tr>
  <tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Bagian</b></td>
    <td style="width:10%;font-size:11px;text-align:left"><?=$gg['jabatan']?></td>
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
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['gaji_pokok'])?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Komunikasi</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['ub_komunikasi'])?></td>
    <td style="width:10%;font-size:11px;text-align:left"><b>Iuran PKWA</b></td>
    <td style="width:10%;font-size:11px;text-align:right"></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Tunj Umum</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['tunj_umum'])?></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Bpjs TK 7, 24</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['jamsostek_724'])?></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Bpjs TK 9, 24</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['jamsostek_924'])?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Fungsional</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['tunj_fungsi'])?></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Tunj Buku</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['ub_notebook'])?></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Simpanan Wajib</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['simpanan_wajib'])?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Representasi</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['tunj_repre'])?></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Tunj Lain-lain</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['lain2'])?></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Koperasi</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['simpan_pinjam'])?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Presensi</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['tunj_presensi'])?></td>
    <td style="width:17%;font-size:11px;text-align:left"><b>Tunj PPH Psi Psl 21</b></td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Potongan Presensi</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['hutang'])?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="2"><b>Penempatan</b></td>
    <td style="width:10%;font-size:11px;text-align:right" rowspan="2"><?=number_format($gg['tunj_penempatan'])?></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Bpjs Kesehatan</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['tunj_sehat'])?></td>
    <td style="width:14%;font-size:11px;text-align:left"><b>Bpjs Kesehatan</b></td>
    <td style="width:10%;font-size:11px;text-align:left"></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left"><b>Rapel</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['rapel'])?></td>
    <td style="width:10%;font-size:11px;text-align:left" rowspan="2"><b>Lain-lain</b></td>
    <td style="width:10%;font-size:11px;text-align:right" rowspan="2"><?=number_format($gg['lain22'])?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left" colspan="3"><b>Bruto</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($gg['jumlah_kotor'])?></td>
</tr>
<tr>
    <td style="width:10%;font-size:11px;text-align:left" colspan="5"><b>Netto</b></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($gg['jumlah_terima'])?></td>
</tr>
<?php $jumlah_pot=$jumlah_pot+$gg['simpanan_wajib']+$gg['simpan_pinjam']+$gg['pensiun']+$gg['hutang']+$gg['lain2']; ?>
<tr>
    <td style="width:10%;font-size:11px;text-align:left" colspan="5"><b>Jumlah Potongan</b></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($jumlah_pot)?></td>
</tr>
</table>