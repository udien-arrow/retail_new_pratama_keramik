<table width="100%"><tr><td>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="scrolls">
	<thead>
    <?php
	$expl=explode("_",$_GET['cus']);
    if($_GET['cus']!=''){
		//$kon=$db->select("tx_piutang","*","id_cus='$expl[0]' and type=1 and jenis=1 and status_bayar='0'");
		$kon=$db->select("tx_piutang","*","id_cus='$expl[0]' and type=1 and status_bayar='0'");
	}
	?>
    <tr height="30px" bgcolor="#EBEBEB">
      <td colspan="5"align="center" ><strong>Kredit Note</strong></td>
      </tr>
    <tr height="30px" bgcolor="#EBEBEB">
          <td width="1%"align="center" ><b>#</b></td>
          <td align="center" width="8%" ><b>No Faktur</b></td>
          <td align="center" width="15%" ><b>No SPJ</b></td>
          <td width="8%" align="center" ><b>Total</b></td>
          <td align="center" width="8%" ><b>Piutang</b></td>
          </tr>
       </thead>   
        <?php
        $no=1;
         foreach($kon as $d){ 
		 foreach($db->select("tx_pembayaran_sales","sum(total_dibayar)as bay","no_faktur='$d[no_faktur_jual]' and jenis_piutang='1'")as $pem2); 
		 $tot=abs($d['total_piutang']);
		?>
    <tr>
          <td align="center"  bgcolor="#EBEBEB"><input type="radio" name="kredit[<?=$no?>]" id="kredit[<?=$no?>]" value="<?=$d['id_piutang'].'_'.$d['no_faktur_jual'].'_'.$d['no_ref']?>"></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['no_faktur_jual']?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['no_ref']?></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=number_format($d['total_piutang']-$pem2['bay'])?>
          <input type="hidden" name="total_kredit[<?=$no?>]" value="<?=$d['total_piutang']-$pem2['bay']?>" ></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
           <select name="piu[<?=$no?>]" id="piu" class="select-search" >
			<?php 
            $gudang=$db->select("tx_piutang","*","status_bayar='0' and status='1' and id_cus='$expl[0]' and jenis is null");
            foreach($gudang as $val){
				
				
            ?>
            <option value="<?=$val['no_faktur_jual'].'_'.$val['total_piutang'].'_'.$val['id_piutang']?>"><?=$val['no_faktur_jual'].' - '.number_format($val['total_piutang'])?></option> 
           <?php } ?>
          </select>
           </td>
        </tr>
    <?php $no++;} ?>
</table></td>

</tr></table>