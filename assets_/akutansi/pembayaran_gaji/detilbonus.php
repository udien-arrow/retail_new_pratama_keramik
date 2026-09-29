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
          <th width="8%" rowspan="2" align="center" ><b>Jumlah Bonus</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Pot Pelanggaran</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Pot Lain2</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Jumlah Terima</b></th>
    </tr>
     </thead>
     <tbody>
<?php 
$sk=$db->select("hr_bonus a join m_pegawai b on a.id_pegawai=b.id_pegawai","*","a.periode='$_GET[a]' and jenis='$_GET[b]'");
$no=1;
foreach($sk as $ks){
?>
    <tr>
    <td><?=$no?></td>
    <td><?=$ks['nama_pegawai']?></td>
	<td align="right"><?=number_format($ks['jumlah_bonus'])?></td>
  <td align="right"><?=number_format($ks['pot_pelanggaran'])?></td>
  <td align="right"><?=number_format($ks['pot_lain'])?></td>
  <td align="right"><?=number_format($ks['jumlah_terima'])?></td>
    </tr>
<?php 
$tot+=$ks['jumlah_terima'];
$no++;} ?>
<tr>
<td colspan="5" align="right">Total</td>
<td align="right"><?=number_format($tot);?></td>
</tr>

  	</tbody>
</table>
</form>
      <p>&nbsp;</p>
</div>
</div>