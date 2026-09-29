<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
?>

<?php
if($_GET['jen']==1){
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td colspan="5"align="center"><b>SPJ Rilis</b></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="50%"><strong>Nama Barang</strong></td>
          <td width="10%"align="center"><strong># </strong></td>
          <td width="10%" align="center"><strong>Harga</strong></td>
          <td width="10%" align="center"><strong>Qty </strong></td>
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
     </tr>
        <?php $no++;} ?>
</table>	
<?php }?>
<?php if($_GET['jen']==2){?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td colspan="5"align="center"><b>SPJ Rilis</b></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="50%"><strong>Nama Barang</strong></td>
          <td width="10%"align="center"><strong># </strong></td>
          <td width="10%" align="center"><strong>Harga</strong></td>
          <td width="10%" align="center"><strong>Qty </strong></td>
    </tr>
        <?php
		$exp=explode("_",$_GET['id']);
		$kon=$db->select("tx_prp_dtl a 
		left join tx_po b on a.no_prp=b.no_prp
		left join m_barang c on a.id_barang=c.id_barang 
		left join m_satuan d on c.id_satuan=d.id_satuan 
		","*","b.no_jwa='$exp[1]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="center">&nbsp;<?=number_format($d['harga_beli'])?>&nbsp;</td>
          <td align="right"><?=$d['qty']?>                                              &nbsp;</td>
     </tr>
        <?php $no++;} ?>
</table>	
<?php }?>
