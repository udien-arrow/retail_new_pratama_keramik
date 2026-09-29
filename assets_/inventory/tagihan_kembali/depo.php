<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="10%"align="center"><strong>Pelanggan</strong></td>
          <td width="10%" align="center"><strong>NO SPJ</strong></td>
          <td width="10%"align="center"><strong>NO FJ</strong></td>
          <td width="10%"align="center"><strong>Piutang</strong></td>
          <td width="10%"align="center"><strong>Deposit</strong></td>
          <td width="10%"align="center"><strong>Dibayar</strong></td>
          <td width="4%" align="center"><strong> <!--<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></li>
			</ul>--></strong></td>
    </tr>
        <?php								  
$kon=$db->select("tx_buku_tagihan_dtl b left join m_customer c on b.id_cus=c.id_cus ","b.*,
c.nama_usaha","b.no='$_GET[id]' and b.status='1'");
        $no=1;
        foreach($kon as $d){
		$a=0;
		$s=$db->select("tx_tagihan_kembali_tmp","sum(dibayar) as dibayar","no_fj='$d[no_fj]'");
		foreach($s as $v){
		$a=$v['dibayar'];
		}
		$dtl=$db->select("tx_tagihan_kembali_dtl a join tx_tagihan_kembali b on a.no_ta=b.no_ta","dibayar","a.no_fj='$d[no_fj]' and b.no_ref='$d[no]'");
		foreach($dtl as $s){
		$g=$s['dibayar'];
		}
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp; </td>
          <td align="center"><?=$d['nama_usaha']?>&nbsp;</td>
          <td align="center">&nbsp;<?php echo $d['no_spj']?>&nbsp;<input type="hidden" name="no_spj[]" id="no_spj<?=$d['id_dtl']?>"  value="<?=$d['no_spj']?>" required></td>
          <td align="center"><?=$d['no_fj']?>&nbsp;<input type="hidden" name="no_fj[]" id="no_fj<?=$d['id_dtl']?>"  value="<?=$d['no_fj']?>" required></td>
          <td align="center"><?=number_format($sis=$d['total_piutang']-$a-$g)?>&nbsp;<input type="hidden" name="totalpiutang[]" id="totalpiutang<?=$d['id_dtl']?>"  value="<?=$d['total_piutang']-$a-$g?>"  placeholder='piutang' required><br></td>
          <td align="center">
		  <?php
		  $dep['nominal']=0;
		  foreach($db->select("m_customer_deposit","nominal","id_cus='$d[id_cus]'")as $dep);
		  $ds=$db->select("tx_tagihan_kembali_tmp","sum(dibayar) as dibayar","jenis_pem='5'");
		  foreach($ds as $dv){}
		   echo number_format($dep['nominal']-$dv['dibayar']);
		  
		  
		  ?>
		  <input type="hidden" name="deposit[]" id="deposit<?=$d['id_dtl']?>"  value="<?=$dep['nominal']-$dv['dibayar']?>" required>          
          <td align="center"><input type="text" name="dibayar[]"  class="dibayar" style="width:70px;height:25px;margin-top:5px" id="dibayar<?=$d['id_dtl']?>" onBlur="cek(<?php echo $d['id_dtl'];?>)" autocomplete="off" value="<?php 
		 if($dep['nominal']>=$sis){
			 echo $sis;
		 }else{
			 echo $dep['nominal']-$dv['dibayar'];
		 }
		  ?>" >&nbsp;
          <input type="hidden" name="tempo_normal[]" id="tempo_normal<?=$d['id_dtl']?>"  value="<?=$d['tempo_normal']?>" required>
          <input type="hidden" name="tempo_tambahan[]" id="tempo_tambahan<?=$d['id_dtl']?>"  value="<?=$d['tempo_tambahan']?>" required>
          <input type="hidden" name="id_cus[]" id="id_cus<?=$d['id_dtl']?>"  value="<?=$d['id_cus']?>" required>
           <input type="hidden" name="dtl[]" id="dtl<?=$d['id_dtl']?>"  value="<?=$d['id_dtl']?>" required>
          <td align="center">
          <ul class='icons-list'>
			<?php if($d['total_piutang']-$a-$g<>0){ ?><li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah(<?php echo $d['id_dtl'];?>)' class='icon-add' style='cursor:pointer'></a></li>
			</ul>          
            <?php }else { } ?>
            </td>
     </tr>
        <?php $no++;
		} 
		?>
      
</table>