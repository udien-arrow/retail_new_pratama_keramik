<?php
		//$kon=$db->select("tx_order_tagihan_dtl","*","no_pt='$_GET[id]' group by no_billing");
		$kon=$db->select("tx_order_tagihan_dtl","*","no_pt='$aa[0]' group by no_billing");
        $no=1;
        foreach($kon as $d){  
		?>
&nbsp;No Billing : <?=$d['no_billing'];?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="10%" align="center"><strong>No SPJ</strong></td>
          <td width="10%" align="center"><strong>Total</strong></td>
          <td width="15%" align="center"><strong>Dibayar</strong></td>
          <td width="15%" align="center"><strong>Sudah Dibayar</strong></td>
          <td width="2%" align="center"><input type="checkbox" name="select-all" id="select-all" /></td>
    </tr>
   <?php 
   $ce=$db->select("tx_order_tagihan_dtl","*","no_billing='$d[no_billing]'");
   	 foreach($ce as $cak){
		 //echo $cak['id_dtl']."<br>";
		$hit=$db->select("tx_order_tagihan_dk","*","no_billing='$d[no_billing]' and no_spj='$cak[no_spj]'");
		foreach($hit as $tung){}
		
			$wes=$cak['total_bil'];
		
	   $ce=$db->select("tx_order_tagihan_bayar","sum(dibayar) as dibayar","no_billing='$d[no_billing]' and no_spj='$cak[no_spj]' and no_pt='$aa[0]' and id_bill_dtl='$cak[id_bill_dtl]'");
		foreach($ce as $cek){}
		//echo $cek['dibayar']."<br>";
   ?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?=$cak['no_spj'];?>&nbsp;</td>
          <td align="right">&nbsp;<?=number_format($wes)?>&nbsp;</td>
          <td align="center">
          <input type="hidden" name="no_billing[]" value="<?=$d['no_billing']?>" readonly>          
          <input type="text" name="dibayar[]" style="width:120px;" value="<?=number_format($wes-$cek['dibayar'])?>">          
          <input type="hidden" name="total[]" style="width:80px;" value="<?=number_format($wes-$cek['dibayar'])?>" readonly>
          <input type="hidden" name="no_pt" style="width:80px;" value="<?=$aa['0']?>" readonly>
          <input type="hidden" name="no_spj[]" value="<?=$cak['no_spj']?>" readonly>
          <input type="hidden" name="bill_dtl[]" value="<?=$cak['id_dtl']?>" readonly>
          </td>
          <td align="right"><input type="text" name="sudahdibayar[]" value="<?=number_format($cek['dibayar'])?>" readonly></td>
          <td align="center">
          <?php if($cak['status']!=4){ ?>
          <input type="checkbox" class="control-primary" name="app[]" id="app[]" value="<?=$cak['id_bill_dtl']?>">
          <?php } ?>
          </td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
   }  ?>
</table>
<?php } ?>	
<br>