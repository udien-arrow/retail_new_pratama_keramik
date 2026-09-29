<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
  <table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
         
          <tr bgcolor="#28343a">
            <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b>Tgl Faktur</b></font></th>
            <th colspan="2" align="center"><font style="color:#FFF"><b>Total Piutang</b></font></th>
            <th width="12%" colspan="3" align="center"><font style="color:#FFF"><b>Umur Piutang</b></font></th>
          </tr>
          <tr bgcolor="#28343a">
            <th align="center"><font style="color:#FFF"><b>Semen</b></font></th>
            <th align="center"><font style="color:#FFF"><b>Non Semen</b></font></th>
            <th width="6%" align="center"><font style="color:#FFF"><b>Tempo</b></font></th>
            <th width="6%" align="center"><font style="color:#FFF"><b>Tambahan</b></font></th>
            <th width="6%" align="center"><font style="color:#FFF"><b>Umur</b></font></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		  if($_GET['id']!=''){
		  $exp2=explode("_",$_GET['id']);
		  $info=$db->select("m_customer a","id_cus,a.kode_cus,a.nama_usaha","a.status=1 and head='' and a.id_cus='$exp2[0]'");
		  }
		  $no=1;
		  $tgl=date("Y-m-d");
		  foreach($info as $infoval){
		  ?>
          <tr>
            <td colspan="7" ><b><?php echo $infoval['nama_usaha']?></b></td>
          </tr>
          <?php 
		  $dtl=$db->select("tx_piutang","*","id_cus='$infoval[id_cus]' and status=1 and status_bayar=0");
		  foreach($dtl as $arr){  
		  foreach($db->select("tx_pembayaran_sales","sum(total_dibayar)as bay","no_faktur='$arr[no_faktur_jual]'")as $pem);
		  
		  foreach($db->select("tx_pembayaran_sales","abs(sum(total_dibayar))as bay","no_faktur_ref='$arr[no_faktur_jual]'")as $pem2); 
		  
		  ?>
          <tr>
            <td align="left"><?php echo $arr['no_faktur_jual'];?></td>
            <td align="center" ><?php echo date("d-m-Y",strtotime($arr['tgl']));?></td>
            <td width="11%" align="right"><?php
			if($arr['jenis_jual']==1){
				echo number_format($jums=$arr['total_piutang']-$pem['bay']-$pem2['bay']);
				$totsem=$totsem+$jums;
			}
			?></td>
            <td width="12%" align="right"><?php
            if($arr['jenis_jual']==2){
				echo number_format($jumn=$arr['total_piutang']-$pem['bay']-$pem2['bay'],0);
				$totnon=$totnon+$jumn;
			}
			?></td>
            <td align="right" <?php if($tgl>$arr['tempo_normal']){?>bgcolor="#B9F9A4"<?php }?>><?php echo date("d-m-Y",strtotime($arr['tempo_normal']));?></td>
            <td align="right" <?php if($tgl>$arr['tempo_tambahan']){?>bgcolor="#FCABC1"<?php }?>><?php echo date("d-m-Y",strtotime($arr['tempo_tambahan']));?></td>
            <td align="right">
            <?php
             $selisih = ((abs(strtotime ($arr['tempo_tambahan']) - strtotime ($arr['tgl'])))/(60*60*24));
			 echo $selisih.' H';
			?>
            </td>
          </tr>
          <?php }?>
          
          <?php 
		  		
				
			  $no++;
			  }?>
        </tbody>
         <tr>
            <td colspan="7" align="left">&nbsp;</td>
            </tr>
           <tr>
            <td align="left">&nbsp;</td>
            <td align="center" >&nbsp;</td>
            <td align="right"><?php
            	echo number_format($totsem,0);
			?></td>
            <td align="right"><?php
            	echo number_format($totnon,0);
			?></td>
            <td colspan="2" align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
          </tr>
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
					  $lim=$db->select("m_customer_plafon","*","id_cus='$infoval[id_cus]' and jenis_plafon<3");
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
