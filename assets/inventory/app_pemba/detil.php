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
    <h5 style="background-color:black;color:white">Debet Note</h5>
	<th>No Billing</th>
    <th>No SPJ</th>
    <th>QTY</th>
    <th>Harga</th>
    <th>Sub Total</th>
    <th>Jenis</th>
    <th>Claim Utuh</th>
    <th>Claim Ktg</th>
    <th>Total</th>
     </thead>
     <tbody>
     <?php 
	 $c=$db->select("tx_order_tagihan_kd","*","(jenis='1' or jenis='0') and (urut not in(select ifnull(urut,0) as urut from tx_order_tagihan_kd_tmp) or no_spj not in(select no_spj from tx_order_tagihan_kd_tmp)) and status='0' and id_supp='$_GET[supp]'");
	 		foreach($c as $kd){ ?>
    <tr>
    <td><?=$kd['no_billing']?></td>
    <td><a onclick="pindah('<?=$kd[no_spj].'_'.$_GET[id].'_'.$kd[urut]?>','<?=$_GET[pt]?>')"><?=$kd['no_spj']?></a></td>
    <td><?=number_format($kd['qty'])?></td>
    <td><?=number_format($kd['harga'])?></td>
    <td><?=number_format($kd['total'])?></td>
    <td><input type="hidden" value="<?=$kd['jenis']?>" name="jenis">
	<?php if($kd['jenis']==0){
		echo "Claim Utuh/Ktg";}
		elseif($kd['jenis']==1){
			echo "Barang Belum Diterima"; }
		 ?></td>
    <td><?=number_format($kd['claim_utuh'])?></td>
    <td><?=number_format($kd['claim_ktg'])?></td>
    <?php 
if($kd['jenis']==0)
{
	$hit=($kd['claim_utuh']*$kd['harga'])+($kd['claim_ktg']*1000);
}elseif($kd['jenis']==1)
{
	$hit=$kd['total'];
}
?>
<td><?=number_format($hit)?></td>
    </tr>
        <?php } ?>
  	</tbody>
</table>
<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
    <h5 style="background-color:black;color:white">Kredit Note</h5>
	<th>No Billing</th>
    <th>No SPJ</th>
    <th>QTY</th>
    <th>Harga</th>
    <th>Total</th>
    <th>Jenis</th>
    <th>Claim Utuh</th>
    <th>Claim Ktg</th>
	<th>Total</th>
     </thead>
     <tbody>
     <?php 
	 $c=$db->select("tx_order_tagihan_kd","*","(jenis='2' or jenis='3') and no_spj not in(select no_spj from tx_order_tagihan_kd_tmp) and status='0' and id_supp='$_GET[supp]'");
	 		foreach($c as $kd){ ?>
    <tr>
    <td><?=$kd['no_billing']?></td>
    <td><a onclick="pindah('<?=$kd[no_spj].'_'.$_GET[id]?>','<?=$_GET[pt]?>')"><?=$kd['no_spj']?></a></td>
    <td><?=number_format($kd['qty'])?></td>
    <td><?=number_format($kd['harga'])?></td>
    <td><?=number_format($kd['total'])?></td>
    <td><?php if($kd['jenis']==2){
		echo "Barang Tak Bertuan";}
		 ?></td>
    <td><?=number_format($kd['claim_utuh'])?></td>
    <td><?=number_format($kd['claim_ktg'])?></td>
    <td><?=number_format($kd['total'])?></td>
    </tr>
        <?php } ?>
  	</tbody>
</table>
</form>
      <p>&nbsp;</p>
</div>