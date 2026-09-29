<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			</style>
<table width="300" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><strong>Shipto </strong></td>
    <td align="center"><strong>nama</strong></td>
    <td align="center"><strong>Aksi</strong></td>
  </tr>
  <?php
  require( '../../../webclass.php' );
  $db=new kelas;
  $kon=$db->select("m_gudang_shipto","shipto_code,shipto_name","id_gudang='$_GET[id]'");
  
  $no=1;
  foreach($kon as $d){  ?>
  <tr>
    <td><?php echo $d['shipto_code'];?>&nbsp;</td>
    <td align="center"><?=$d['shipto_name']?>&nbsp;</td>
    <td align="center"><a href="javascript:void(0)" onclick="hapuskeranjang(<?php echo $d['id'];?>)">hapus</a>&nbsp;</td>
  </tr>
  <?php } ?>
</table><br>
