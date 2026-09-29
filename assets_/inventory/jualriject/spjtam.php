<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td colspan="6"align="center"><b>SPJ Rilis</b></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="50%"><strong>Nama Barang</strong></td>
          <td width="10%"align="center"><strong># </strong></td>
          <td width="10%" align="center"><strong>Harga</strong></td>
          <td width="10%" align="center"><strong>Qty </strong></td>
          <td width="10%" align="center"><strong>Aksi</strong></td>
    </tr>
        <?php
		$exp=explode("_",$_GET['id']);
		$kon=$db->select("v_spj_rilis","*","no_spj='$exp[1]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="center">&nbsp;<?=number_format($d['price'])?>&nbsp;</td>
          <td align="right"><?=$d['qty_do']?>                                              &nbsp;</td>
          <td align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_tmp'];?>)">hapus</a>&nbsp;</td>
     </tr>
        <?php $no++;} ?>
</table>	
