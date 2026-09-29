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
    <tr height="30px" bgcolor="#EBEBEB">
    	<th width="1%"align="center" ><b>No</b></th>
          <th width="8%" align="center" ><b>Pegawai</b></th>
          <th width="8%" align="center" ><b>Gaji Bruto</b></th>
          <th width="8%" align="center" ><b>Tunj Tetap</b></th>
          <th width="8%" align="center" ><b>Tunj Tidak Tetap</b></th>
          <th width="8%" align="center" ><b>Simpan Pinjam</b></th>
          <th width="8%" align="center" ><b>Simpanan Wajib</b></th>
          <th width="8%" align="center" ><b>Pensiun</b></th>
          <th width="8%" align="center" ><b>Hutang</b></th>
          <th width="8%" align="center" ><b>Lain2</b></th>
          </tr>
    </thead> 
    <tbody> 
      <?php $hr=$db->select("hr_posting_gaji a join m_pegawai b on a.id_pegawai=b.id_pegawai","a.id_pegawai,b.nama_pegawai,(gaji_pokok+tunj_pengabdian+ub_notebook+ub_komunikasi+ub_motor+ub_diklat+ins_cabang+rapel+lain2+jamsostek_724+tunj_sehat-potpel_pr-potpel_pf-potpel_pp) AS gaji_bruto,
	(tunj_umum+tunj_fungsi+tunj_repre) AS tunj_tetap,
	(tunj_presensi+tunj_penempatan) AS tunj_tidaktetap,
	(simpan_pinjam) AS simpan_pinjam,
	(simpanan_wajib) AS simpanan_wajib,
	(pensiun) AS pensiun,
	(hutang) AS hutang,
	(lain22+jamsostek_924+potbpjssehat) AS lain22,
	bulan,tahun,
	(jumlah_terima) AS jumlah_terima"," bulan='$_GET[a]' and tahun='$_GET[b]' and a.id_cabang='$_GET[c]'");
		$no=1;
		$as=0;
	  foreach($hr as $hor){ ?>    
  <tr>
  <td align="right"><?=$no?></td>
  <td align="left"><?=$hor['nama_pegawai']?></td>
  <td align="right"><?=number_format($hor['gaji_bruto'])?></td>
  <td align="right"><?=number_format($hor['tunj_tetap'])?></td>
  <td align="right"><?=number_format($hor['tunj_tidaktetap'])?></td>
  <td align="right"><?=number_format($hor['simpan_pinjam'])?></td>
  <td align="right"><?=number_format($hor['simpanan_wajib'])?></td>
  <td align="right"><?=number_format($hor['pensiun'])?></td>
  <td align="right"><?=number_format($hor['hutang'])?></td>
  <td align="right"><?=number_format($hor['lain22'])?></td>
  </tr>
  <?php 
  $gb+=$hor['gaji_bruto'];
  $tt+=$hor['tunj_tetap'];
  $ttt+=$hor['tunj_tidaktetap'];
  $sp+=$hor['simpan_pinjam'];
  $sw+=$hor['simpanan_wajib'];
  $p+=$hor['pensiun'];
  $h+=$hor['hutang'];
  $l+=$hor['lain22'];
  
  $no++;
  }  ?><br>
  <tr>
    <td colspan="2" align="right">Total </td>
    <td align="right"><?=number_format($gb)?></td>
    <td align="right"><?=number_format($tt)?></td>
    <td align="right"><?=number_format($ttt)?></td>
    <td align="right"><?=number_format($sp)?></td>
    <td align="right"><?=number_format($sw)?></td>
    <td align="right"><?=number_format($p)?></td>
    <td align="right"><?=number_format($h)?></td>
    <td align="right"><?=number_format($l)?></td>
  </tr>
  <tr>
    <td colspan="9" align="right">Grant </td>
    <td align="right"><?=number_format(($gb+$tt+$ttt+$sp+$sw)-$p-$h-$l)?></td>
  </tr>
  </table>

</form>
      <p>&nbsp;</p>
</div>
</div>