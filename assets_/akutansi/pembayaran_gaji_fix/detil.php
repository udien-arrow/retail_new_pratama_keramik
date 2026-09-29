<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
<form method="POST" name="kd" id="kd">
  <table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
    <tr>
	<th width="1%" rowspan="2"align="center" ><b>No</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Nama</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Gaji Pokok</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Umum</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Repre</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Fungsi</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Ins Presensi</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Penemp</b></th>
          <?php 
		  $tj22=$db->select("hr_m_potongan_opr","*","type='2'");
		  foreach($tj22 as $tjas){
?>
          <th width="8%" rowspan="2" align="center" ><b><?=$tjas['nama_jenis']?></b></th>
          <?php }?>
          <th width="8%" rowspan="2" align="center" ><b>Jamsostek 7.24%</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Kesehatan</b></th>
         
          <th width="8%" rowspan="2" align="center" ><b>Jumlah Kotor</b></th>
          <?php 
		  $tj22=$db->select("hr_m_potongan_opr","*","type='1'");
		  foreach($tj22 as $tjas){
		  ?>
          <th width="8%" rowspan="2" align="center" ><b><?=$tjas['nama_jenis']?></b></th>
          <?php }?>
          <th width="8%" rowspan="2" align="center" ><b>Jamsostek 9.24%</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Iuran BPJS <br>kesehatan</b></th>
          <th width="8%" colspan="3" align="center" ><b>Potongan Pelanggaran</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Jumlah Penerimaan</b></th>
          </tr>
      <th align="center" ><b>Representative</b></th>
      <th align="center" ><b>Fungsional</b></th>
      <th align="center" ><b>Presensi</b></th>
    </tr>
     </thead>
     <tbody>
<?php 
$sk=$db->select("hr_posting_gaji a join m_pegawai b on a.id_pegawai=b.id_pegawai","*","a.bulan='$_GET[a]' and a.tahun='$_GET[b]'");
$no=1;
foreach($sk as $ks){
?>
    <tr>
    <td><?=$no?></td>
    <td><?=$ks['nama_pegawai']?></td>
	<td align="right"><?=number_format($ks['gaji_pokok'])?></td>
  <td align="right"><?=number_format($ks['tunj_umum'])?></td>
  <td align="right"><?=number_format($ks['tunj_repre'])?></td>
  <td align="right"><?=number_format($ks['tunj_fungsi'])?></td>
  <td align="right"><?=number_format($ks['tunj_presensi'])?></td>
  <td align="right"><?=number_format($ks['tunj_penempatan'])?></td>
  <td align="right"><?=number_format($ks['tunj_pengabdian'])?></td>
  <td align="right"><?=number_format($ks['ub_notebook'])?></td>
  <td align="right"><?=number_format($ks['ub_komunikasi'])?></td>
  <td align="right"><?=number_format($ks['ub_diklat'])?></td>
  <td align="right"><?=number_format($ks['ins_cabang'])?></td>
  <td align="right"><?=number_format($ks['rapel'])?></td>
  <td align="right"><?=number_format($ks['lain2'])?></td>
  <td align="right"><?=number_format($ks['ub_motor'])?></td>
  <td align="right"><?=number_format($ks['jamsostek_724'])?></td>
  <td align="right"><?=number_format($ks['tunj_sehat'])?></td>
  <td align="right"><?=number_format($ks['jumlah_kotor'])?></td>
  <td align="right"><?=number_format($ks['simpan_pinjam'])?></td>
  <td align="right"><?=number_format($ks['simpanan_wajib'])?></td>
  <td align="right"><?=number_format($ks['pensiun'])?></td>
  <td align="right"><?=number_format($ks['hutang'])?></td>
  <td align="right"><?=number_format($ks['lain22'])?></td>
  <td align="right"><?=number_format($ks['jamsostek_924'])?></td>
  <td align="right"><?=number_format($ks['potbpjssehat'])?></td>
  <td align="right"><?=number_format($ks['potpel_pr'])?></td>
  <td align="right"><?=number_format($ks['potpel_pf'])?></td>
  <td align="right"><?=number_format($ks['potpel_pp'])?></td>
  <td align="right"><?=number_format($ks['jumlah_terima'])?></td>
    </tr>
<?php 
$tot+=$ks['jumlah_terima'];
$gaji_pokok+=$ks['gaji_pokok'];
$tunj_umum+=$ks['tunj_umum'];
$tunj_repre+=$ks['tunj_repre'];
$tunj_fungsi+=$ks['tunj_fungsi'];
$tunj_presensi+=$ks['tunj_presensi'];
$tunj_penempatan+=$ks['tunj_penempatan'];
$tunj_pengabdian+=$ks['tunj_pengabdian'];
$ub_notebook+=$ks['ub_notebook'];
$ub_komunikasi+=$ks['ub_komunikasi'];
$ub_diklat+=$ks['ub_diklat'];
$ins_cabang+=$ks['ins_cabang'];
$rapel+=$ks['rapel'];
$lain2+=$ks['lain2'];
$ub_motor+=$ks['ub_motor'];
$jamsostek_724+=$ks['jamsostek_724'];
$tunj_sehat+=$ks['tunj_sehat'];
$jamsostek_724+=$ks['jamsostek_724'];
$jumlah_kotor+=$ks['jumlah_kotor'];
$simpan_pinjam+=$ks['simpan_pinjam'];
$simpanan_wajib+=$ks['simpanan_wajib'];
$pensiun+=$ks['pensiun'];
$hutang+=$ks['hutang'];
$lain22+=$ks['lain22'];
$jamsostek_924+=$ks['jamsostek_924'];
$potbpjssehat+=$ks['potbpjssehat'];
$potpel_pr+=$ks['potpel_pr'];
$potpel_pf+=$ks['potpel_pf'];
$potpel_pp+=$ks['potpel_pp'];


$no++;} ?>
<tr>
<td colspan="29" align="right">Total</td>
<td align="right"><?=number_format($tot);?></td>
</tr>

  	</tbody>
</table>
</form>
      <p>&nbsp;</p>
</div>
</div>