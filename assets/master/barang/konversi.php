<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			</style>
<table width="250" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><strong>Satuan</strong></td>
    <td align="center"><strong>Konversi</strong></td>
    <td align="center"><strong>Default</strong></td>
    <td align="center"><strong>Aksi</strong></td>
  </tr>
  <?php
  require( '../../../webclass.php' );
  $db=new kelas;
  $kon=$db->select("m_konversi","id_konv,konv,def,(select nama_satuan from m_satuan where id_satuan=SAT2) as sat2","id_barang='$_GET[id]'");
  
  $no=1;
  foreach($kon as $d){  ?>
  <tr>
    <td><?php echo $d['sat2'];?>&nbsp;</td>
    <td align="center"><?=$d['konv']?>&nbsp;</td>
    <td align="center"><?php if($d['def']==0){echo "Tidak";}elseif($d['def']==1){echo "Ya";}?></td>
    <td align="center"><a href="javascript:void(0)" onclick="hapuskeranjang(<?php echo $d['id_konv'];?>)">hapus</a>&nbsp;</td>
  </tr>
  <?php } ?>
</table><br>
