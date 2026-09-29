  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		  <div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?=$title?>
					</h5>
                    <hr>
					<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
          <tr>
            <th colspan="11" align="left"><span class="icons-list"><span class="panel-title"><span class="col-lg-4">
              <select name="cus" id="cus" class="select-search" onChange="pindahData2(cus.value)">
                <option value="">---Pelanggan---</option>
                <?php
				$query=$db->select("m_customer","id_cus,nama_usaha,kode_cus","status='1' and head='' and id_cabang='$_SESSION[ID_CABANG]'");
				foreach($query as $sel){	
				?>
			<option value="<?=$sel['id_cus'].'_'.$sel['kode_cus']?>" <?php if($sel['id_cus'].'_'.$sel['kode_cus']==$_GET['cus']){echo "selected";}?>>
			  <?=$sel['nama_usaha']?>
                </option>
                <?php }?>
              </select>
            </span></span></span></th>
          </tr>
      <?php
       $exp2=explode("_",$_GET['cus']);
 $jum=count($db->select("tx_piutang","*","id_cus='$exp2[0]' and status_bayar=0"));
      if($jum>0){		  
	  ?>    
            <tr>
				<th colspan="11" align="left"><b>Piutang</b></th>
			</tr>
          <tr bgcolor="#28343a">
            <th width="11%" rowspan="2" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b>Tgl Faktur</b></font></th>
            <th colspan="2" align="center"><font style="color:#FFF"><b>Total Piutang</b></font></th>
            <th width="12%" colspan="2" align="center"><font style="color:#FFF"><b>Umur Piutang</b></font></th>
            <th width="10%" rowspan="2" align="center"><font style="color:#FFF"><b>Nilai BG</b></font></th>
            <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b> No BG</b></font></th>
            <th width="10%" rowspan="2" align="center"><font style="color:#FFF"><b>Bank BG</b></font></th>
            <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b>Jenis</b></font></th>
            <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b>Jatuh Tempo</b></font></th>
            
          </tr>
          <tr bgcolor="#28343a">
            <th align="center"><font style="color:#FFF"><b>Semen</b></font></th>
            <th align="center"><font style="color:#FFF"><b>Non Semen</b></font></th>
            <th width="12%" align="center"><font style="color:#FFF"><b>Tempo</b></font></th>
            <th width="6%" align="center"><font style="color:#FFF"><b>Umur</b></font></th>
          </tr>
        </thead>
        <tbody>
          <?php 

		  if($_GET['cus']!=''){
		  
		  $info=$db->select("m_customer a","id_cus,a.kode_cus,a.nama_usaha","a.status=1 and head='' and a.id_cus='$exp2[0]' 
		  union 
		  select b.id_cus,b.kode_cus,b.nama_usaha from m_customer b where b.head='$exp2[1]' and b.status=1");
		  }
		  $no=1;
		  $tgl=date("Y-m-d");
		  foreach($info as $infoval){
		  ?>
          <tr>
            <td colspan="11" ><b><?php echo $infoval['nama_usaha']?></b></td>
          </tr>
          <?php 
		  /////////////////////===========================piutang
		  
		  $dtl=$db->select("tx_piutang","*","id_cus='$infoval[id_cus]' and status=1 and status_bayar=0");
		  foreach($dtl as $arr){
			  foreach($db->select("tx_pembayaran_sales","sum(total_dibayar)as bay","no_spj='$arr[no_ref]'")as $pem); 
			  foreach($db->select("tx_tagihan_kembali_dtl","dibayar,no_seribg,nama_bank,jatuh_tempo","no_spj='$arr[no_ref]' and jenis_pem='3' and status=0 order by id_dtl desc limit 0,1")as $bg); 
		  ?>
         
          <tr>
            <td align="left"><?php echo $arr['no_faktur_jual'];?></td>
            <td align="center" ><?php echo date("d-m-Y",strtotime($arr['tgl']));?></td>
            <td width="11%" align="right"><?php
			if($arr['jenis_jual']==1){
				echo number_format($jums=$arr['total_piutang']-$pem['bay']);
				$totsem=$totsem+$jums;
			}
			?></td>
            <td width="12%" align="right"><?php
            if($arr['jenis_jual']==2){
				
				echo number_format($jumn=$arr['total_piutang']-$pem['bay'],0);
				$totnon=$totnon+$jumn;
			}
			?></td>
            <td align="right"><?php echo date("d-m-Y",strtotime($arr['tempo_tambahan']));?></td>
            <td align="right">
            <?php
             $selisih = ((abs(strtotime ($arr['tempo_tambahan']) - strtotime ($arr['tgl'])))/(60*60*24));
			 echo $selisih.' Hari';
			?>
            </td>
            <td align="right"><?php echo number_format($bg['dibayar']);?></td>
            <td align="center"><?php echo $bg['no_seribg'];?></td>
            <td align="center"><?php echo $bg['nama_bank'];?></td>
            <td align="center"><?php if($bg['jenis_bg']==1){
					echo 'Cair';
				}elseif($bg['jenis_bg']==2){
					echo 'blonk';
					}?></td>
            <td align="right"><?php 
			if($bg['jatuh_tempo']!=''){
			echo date("d-m-Y",strtotime($bg['jatuh_tempo']));
			}
			?></td>
          </tr>
          <?php 
		  	}
		  
			//===================================================================end piutang
		  ?>
          
          <?php 
		  	 $no++;
			  }?>
        </tbody>
         <tr>
            <td colspan="11" align="left">&nbsp;</td>
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
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
          </tr>
    <?php }?>      
          
      </table>
      <?php
	  $jum=count($db->select("tx_piutang_kndn","*","id_cus='$exp2[0]' and status_bayar=0"));
      if($jum>0){
	  ?>
					<table  class=" datatable table-bordered table-striped table-hover dataTable no-footer" border="0" width="50%">
					  <thead>
					    <tr>
					      <th colspan="6" align="left"><b>Debet / Kredit Note</b></th>
				        </tr>
					    <tr bgcolor="#28343a">
					      <th width="11%" rowspan="2" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
					      <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b>Tgl Faktur</b></font></th>
					      <th colspan="2" align="center"><font style="color:#FFF"><b>Total Piutang</b></font></th>
					      <th width="12%" colspan="2" align="center"><font style="color:#FFF"><b>Umur Piutang</b></font></th>
				        </tr>
					    <tr bgcolor="#28343a">
					      <th align="center"><font style="color:#FFF"><b>Semen</b></font></th>
					      <th align="center"><font style="color:#FFF"><b>Non Semen</b></font></th>
					      <th width="12%" align="center"><font style="color:#FFF"><b>Tempo</b></font></th>
					      <th width="6%" align="center"><font style="color:#FFF"><b>Umur</b></font></th>
				        </tr>
				      </thead>
					  <tbody>
					    <?php 
		  if($_GET['cus']!=''){
		  $exp2=explode("_",$_GET['cus']);
		  $info=$db->select("m_customer a","id_cus,a.kode_cus,a.nama_usaha","a.status=1 and head='' and a.id_cus='$exp2[0]' 
		  union 
		  select b.id_cus,b.kode_cus,b.nama_usaha from m_customer b where b.head='$exp2[1]' and b.status=1");
		  }
		  $no=1;
		  $tgl=date("Y-m-d");
		  foreach($info as $infoval){
		  ?>
					    <tr>
					      <td colspan="6" ><b><?php echo $infoval['nama_usaha']?></b></td>
				        </tr>
					    <?php 
		  /////////////////////===========================piutang
		  
		  $dtl=$db->select("tx_piutang_kndn","*","id_cus='$infoval[id_cus]' and status_bayar=0");
		  foreach($dtl as $arr){ 
		  ?>
					    <tr>
					      <td align="left"><?php echo $arr['no_faktur_jual'];?></td>
					      <td align="center" ><?php echo date("d-m-Y",strtotime($arr['tgl']));?></td>
					      <td width="11%" align="right"><?php
			if($arr['jenis_jual']==1){
				echo number_format($jums=$arr['total_kndn']);
				$totsem=$totsem+$jums;
			}
			?></td>
					      <td width="12%" align="right"><?php
            if($arr['jenis_jual']==2){
				
				echo number_format($jumn=$arr['total_kndn'],0);
				$totnon=$totnon+$jumn;
			}
			?></td>
					      <td align="right"><?php echo date("d-m-Y",strtotime($arr['tempo_tambahan']));?></td>
					      <td align="right"><?php
             $selisih = ((abs(strtotime ($arr['tempo_tambahan']) - strtotime ($arr['tgl'])))/(60*60*24));
			 echo $selisih.' Hari';
			?></td>
				        </tr>
					    <?php 
		  	}
			//===================================================================end piutang
		  ?>
					    <?php 
		  	 $no++;
			  }?>
				      </tbody>
					  <tr>
					    <td colspan="6" align="left">&nbsp;</td>
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
					    <td align="right">&nbsp;</td>
					    <td align="right">&nbsp;</td>
				      </tr>
				  </table>
                  <?php }?>
                  
					<table class="table" border="0">
					  <thead>
					    <tr>
					      <th colspan="3">&nbsp;</th>
				        </tr>
				      </thead>
					  <tbody>
					    <?php 
		  
		  $info=$db->select("m_customer","id_cus,nama_usaha","status=1 and head='' and id_cus='$exp2[0]'");
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
					          <td align="right" width="10%"><a title="<?='Normal '.number_format($limval['tempo_normal']).' Hari, '.'Tambahan '.number_format($limval['tempo_tambahan']).' Hari'?>">
					            <?=number_format($limval['tempo_pembayaran']).' Hari'?>
					            </a></td>
					          <td align="right" width="10%"><a title="<?='pkb :'.number_format($limval['limit_pkb']).' - pkc :'.number_format($limval['limit_pkc'])?>">
					            <?=number_format($limval['limit_plafon'])?>
					            </a></td>
					          <?php if($limval['jenis_plafon']==1){?>
					          <td align="right" width="20%" <?php if($totsem>$limval['limit_plafon']){?>bgcolor="#F8BADA"<?php }?>><?php  echo number_format($totsem);?></td>
					          <?php }?>
					          <?php if($limval['jenis_plafon']==2){?>
					          <td align="right" width="20%" <?php if($totnon>$limval['limit_plafon']){?>bgcolor="#F8BADA"<?php }?>><?php  echo number_format($totnon);?></td>
					          <?php }?>
					          <?php if($limval['jenis_plafon']==3){?>
					          <td align="right" width="20%" <?php if($totexp>$limval['limit_plafon']){?>bgcolor="#F8BADA"<?php }?>><?php  echo number_format($totexp);?></td>
					          <?php }?>
				            </tr>
					        <?php }?>
					        </table></td>
				        </tr>
					    <?php 
			  $no++;
			  }?>
				      </tbody>
				  </table>
<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
          
          </div>

