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
	<th width="1%"align="center" ><b>No</b></th>
          <th width="8%" align="center" ><b>Nama</b></th>
          <th width="8%" align="center" >Jabatan</th>
          <th width="8%" align="center" ><b>Gaji</b></th>
          <th width="8%" align="center" ><b>Lembur</b></th>
          <th width="8%" align="center" ><b>Total Penerimaan</b></th>
          </tr>
      
     </thead>
     <tbody>
<?php 
$sk=$db->select("hr_posting_gaji_habor a 
join m_pegawai b on a.id_pegawai=b.id_pegawai
join m_jabatan c on b.id_jabatan=c.id_jabatan
","*","a.bulan='$_GET[a]' and a.tahun='$_GET[b]'");
$no=1;
foreach($sk as $ks){
?>
    <tr>
    <td><?=$no?></td>
    <td><?=$ks['nama_pegawai']?></td>
    <td align="left"><?=$ks['nama_jabatan']?></td>
	<td align="right"><?=number_format($ks['gaji_pokok'])?></td>
    <td align="right"><?=number_format($ks['lembur'])?></td>
    <td align="right"><?=number_format($tot=$ks['gaji_pokok']+$ks['lembur'])?></td>
  </tr>
<?php 
$total+=$tot;
}?>
<tr>
<td colspan="5" align="right">Total</td>
<td  align="right"><?=number_format($total)?></td>
</tr>

  	</tbody>
</table>
</form>
      <p>&nbsp;</p>
</div>
</div>