<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>

<div class="table-responsive">
<div class="table-responsive pre-scrollable">
<form action="javascript:void(0)" method="post" id="budget">
<input type="hidden" name="id_budget" id="id_budget" value="<?=$_GET['id']?>" />
<input type="hidden" name="account" id="account" value="<?=$_GET['acc']?>" />
<table width="100%" border="1">
  <tr>
    <td><strong>No</strong></td>
    <td><strong>No Ref</strong></td>
    <td><strong>Nama</strong></td>
    <td><strong>Keterangan</strong></td>
    <td><strong>Jumlah</strong></td>
  </tr>
  

<?php

$pum=$db->select("ak_pum a join r_user_login e on a.USERID=e.ID JOIN m_pegawai b ON e.ID_PEGAWAI=b.id_pegawai JOIN ak_jenisum c ON a.TIPE=c.id_jenisum","NO_PUM, TANGGAL, CATATAN, TOTAL, nama_pegawai, c.account","a.`STATUS`='1'");
foreach($pum as $rpum){
	?>
  <tr>
    <td>&nbsp;</td>
    <td><a href="javascript:void(0)" onclick="kembali('<?=$rpum[NO_PUM]?>','<?=$rpum[nama_pegawai]." - ".$rpum[CATATAN]?>','<?=$rpum[TOTAL]?>','<?=$rpum[account]?>')"><?=$rpum[NO_PUM]?></a>&nbsp;</td>
    <td><?=$rpum[nama_pegawai]?></td>
    <td><?=$rpum[CATATAN]?></td>
    <td><?=$rpum[TOTAL]?></td>
  </tr>
    <?php
	}
?>
</table>	
</form> 
</div>
</div>
<script>
function kembali(a,b,c,d){
	//alert(a);
	parent.document.getElementById('j').value = a;
	parent.document.getElementById('korekj').value = d;
	parent.document.getElementById('ket1').value = b;
	parent.document.getElementById('jml1').value = c;
	
	$('.close').click();
	}
</script>
