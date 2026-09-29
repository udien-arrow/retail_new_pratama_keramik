<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
  <table class="table" border="0">
    <thead>
          <tr bgcolor="#28343a">
            <th width="15%" align="center"><font style="color:#FFF"><b>No SPJ</b></font></th>
            <th width="15%" align="center"><font style="color:#FFF"><b>Tgl SPJ</b></font></th>
            <th width="15%" align="center"><font style="color:#FFF"><b>T.Normal </b></font></th>
            <th width="15%" align="center"><font style="color:#FFF"><b>T.Tambahan</b></font></th>
            <th width="20%" align="center"><font style="color:#FFF"><b>Semen</b></font></th>
            <th width="20%" align="center"><font style="color:#FFF"><b>Non Semen</b></font></th>
            
          </tr>
        </thead>
        <tbody>
          <?php 
		  $exp2=explode("_",$_GET['id']);
		  $info=$db->select("m_customer a","id_cus,a.kode_cus,a.nama_usaha","a.status=1 and head='' and a.id_cus='$exp2[0]' union select b.id_cus,b.kode_cus,b.nama_usaha from m_customer b where b.head='$exp2[1]' and b.status=1");
		  $no=1;
		  $tgl=date("Y-m-d");
		  foreach($info as $infoval){
			 ?>
          <tr>
            <td colspan="6" bgcolor="#EBEBEB" ><b><?php echo $infoval['nama_usaha']?></b></td>
          </tr>
          <?php 
		  $dtl=$db->select("tx_do a 
		  join tx_do_dtl b on a.id_spj=b.id_spj
		  ","a.*,ifnull((select sum(s.jumlah_so) from tx_retur_pen s where a.no_spj=s.no_ref),0)as jumlah_so_ret,
ifnull((select sum(h.total_dibayar) from tx_pembayaran_sales h where a.no_spj=h.no_spj),0)as jumlah_bayar","a.id_cus='$infoval[id_cus]' and a.status=0");
		  foreach($dtl as $arr){
			  
		  ?>
          <tr>
            <td align="center"><?=$arr['no_spj']?></td>
            <td align="center"><?php echo date('d-m-Y', strtotime($arr['tgl_spj']));?></td>
            <td align="center" <?php if($tgl>$arr['tempo_normal']){?>bgcolor="#B9F9A4"<?php }?>><?php echo date('d-m-Y', strtotime($arr['tempo_normal']));?></td>
            <td align="right" <?php if($tgl>$arr['tempo_tambahan']){?>bgcolor="#FCABC1"<?php }?>><?php echo date('d-m-Y', strtotime($arr['tempo_tambahan']));?></td>
            <td align="right"><?php
			if($arr['jenis_jual']==1){
				echo number_format($jums=$arr['jumlah_so']-$arr['jumlah_so_ret']-$arr['jumlah_bayar']);
				$totsem=$totsem+$jums;
			}
			?></td>
            <td align="right"><?php
            if($arr['jenis_jual']==2){
				echo number_format($jumn=$arr['jumlah_so']);
				$totnon=$totnon+$jumn;
			}
			?></td>
          </tr>
          <?php }?>
          
          <?php 
		  		
				
			  $no++;
			  }?>
        </tbody>
      </table>
</div>
<table class="table" border="0">
  <thead>
    <tr>
      <th colspan="3">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php 
		  
		  $info=$db->select("m_customer","id_cus,nama_usaha","status=1 and head='' and id_cus='$_GET[id]'");
		  $no=1;
		  foreach($info as $infoval){
			 ?>
    <tr>
      <td width="35%" ><div class="media-left media-middle"> <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs"> <span class="letter-icon">
        <?=strtoupper(substr($infoval['nama_usaha'],0,1))?>
      </span></a></div>
        <div class="media-body">
          <div class="media-heading"> <a href="#" class="letter-icon-title">
            <?=$infoval['nama_usaha']?>
          </a></div>
        </div></td>
      <td colspan="2" align="right"><table width="100%" class="table text-nowrap">
        <?php if($no==1){?>
        <tr>
          <td colspan="3" align="center">Limit</td>
          <td align="center">Piutang</td>
          </tr>
        <?php
					}
					  $limval['limit_plafon']=0;
					  $lim=$db->select("m_customer_plafon","*","id_cus='$infoval[id_cus]'");
					  foreach($lim as $limval)
					  {
					  ?>
        <tr>
          <td width="1%" align="right"><?php
                            if($limval['urut']==1){
								echo "Semen";	
							}
							if($limval['urut']==2){
								echo "Non";	
							}
							if($limval['urut']==3){
								echo "Expd";	
							}
							?></td>
          <td align="right" width="10%"><a title="<?='Normal '.number_format($limval['tempo_normal']).' Hari, '.'Tambahan '.number_format($limval['tempo_tambahan']).' Hari'?>"><?=number_format($limval['tempo_pembayaran']).' Hari'?></a></td>
          <td align="right" width="10%"><a title="<?='pkb :'.number_format($limval['limit_pkb']).' - pkc :'.number_format($limval['limit_pkc'])?>"><?=number_format($limval['limit_plafon'])?></a></td>
          <?php if($limval['jenis_plafon']==1){?><td align="right" width="20%" <?php if($totsem>$limval['limit_plafon']){?>bgcolor="#F8BADA"<?php }?>><?php  echo number_format($totsem);?></td><?php }?>
		  <?php if($limval['jenis_plafon']==2){?><td align="right" width="20%" <?php if($totnon>$limval['limit_plafon']){?>bgcolor="#F8BADA"<?php }?>><?php  echo number_format($totnon);?></td><?php }?>	  
          <?php if($limval['jenis_plafon']==3){?><td align="right" width="20%" <?php if($totexp>$limval['limit_plafon']){?>bgcolor="#F8BADA"<?php }?>><?php  echo number_format($totexp);?></td><?php }?>    
             
		 
		 
          </tr>
        <?php }?>
      </table></td>
    </tr>
    <?php 
			  $no++;
			  }?>
  </tbody>
</table>
      <p>&nbsp;</p>
</div>
