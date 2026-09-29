  	 <div class="col-lg-12">
		  <div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php
                    $cab=$db->ses_cab($_SESSION['ID_CABANG']);
					echo $title;
					?>
					</h5>
                    <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li></li>
							</ul>
                            </div>
                    <hr>
                     <div class="form-group">
						<div class="col-lg-3">
                    	<select name="supp" id="supp" class="select-search">
                <option value="">---Supplier---</option>
                <option value="all">All Supplier</option>
                <?php
				$cab=$db->ses_cab($_SESSION['ID_CABANG']);
				
				$query=$db->select("m_supplier","*","status='1'");
				foreach($query as $sel){	
				?>
			<option value="<?=$sel['id_supp']?>" <?php if($sel['id_supp']==$_GET['supp']){echo "selected";}?>>
			  <?=$sel['nama_usaha']?>
                </option>
                <?php }?>
              </select>
                       </div>
                       <div class="col-lg-2">
                    	<select class="select" name="aging" id="aging" >
                          <option value="">--Aging--</option>
								<?php
									$query=$db->select("m_umur","*","jenis=2");
									foreach($query as $sel){	
			                    ?>
                                        	<option value="<?=$sel['id_aging']?>"  <?php if($sel['id_aging']==$_GET['aging']){echo "selected";}?>><?=$sel['nama_aging']?></option> <?php } ?>
									</select>
                       </div>
                       <div class="col-lg-1">
                    		<input type="text" name="tgl" id="tgl" class="form-control datepicker" value="<?php if($_GET['tgl']==''){echo date("m-d-Y");}else{echo $_GET['tgl'];}?>" >
                       </div>
                       <div class="col-lg-1">
                        <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData2(supp.value,aging.value,tgl.value)">
                       </div>
                      <div class="col-lg-4">       
                    <input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button>
           			</div>
                      
           			</div>
           <?php
           if($_GET['supp']!=''){
		   ?>         
					<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0" id="example4">
    <thead> 
            <tr>
				<th colspan="15" align="left"><b>HUTANG SUPPLIER</b></th>
			</tr>
          <tr bgcolor="#28343a">
            <th width="11%" align="center"><font style="color:#FFF"><b>Cabang</b></font></th>
            <th width="11%" align="center"><font style="color:#FFF"><b>No SPJ</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl SPJ</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl JT</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Term</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Umur</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Total</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Belum Jatuh Tempo</b></font></th>
            <th align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=1")as $aa1);
			echo $aa1['awal'].'-'.$aa1['akhir'];
			?>
            </b></font></th>
            <th align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=2")as $aa2);
			echo $aa2['awal'].'-'.$aa2['akhir'];
			?>
            </b></font></th>
            <th align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=3")as $aa3);
			echo $aa3['awal'].'-'.$aa3['akhir'];
			?>
            </b></font></th>
            <th align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=4")as $aa4);
			echo $aa4['awal'].'-'.$aa4['akhir'];
			?>
            </b></font></th>
            <th align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=5")as $aa5);
			echo $aa5['awal'].'-'.$aa5['akhir'];
			?>
            </b></font></th>
            <th align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=6")as $aa6);
			echo '>'.$aa6['awal'];
			?>
            </b></font></th>
          </tr>
          </thead>
          <?php
if($_GET['supp']!='all'){  

	  $query=$db->select("m_supplier a","a.id_supp,a.nama_usaha,a.kode_supp,a.alamat_usaha,a.jenis_aging","a.status='1' and a.id_supp in (select id_supp from tx_brg_masuk) and a.id_supp='$_GET[supp]'");
}else{
		$query=$db->select("m_supplier a","a.id_supp,a.nama_usaha,a.kode_supp,a.alamat_usaha,a.jenis_aging","a.status='1' and a.id_supp in (select id_supp from tx_brg_masuk)");	
		
	}
		
	  $totsem='';
	  $totnon='';
	  foreach($query as $sel){
	  $s=$sel['id_cus'].'_'.$sel['kode_cus'];
      $exp2=explode("_",$s);
	  $totsem='';
	  $totnon='';
      ?>   
        <tbody>
          <?php 
		  $no=1;
		  $tgl=date("Y-m-d");
		  ?>
          <tr>
            <td colspan="15" ><b><?php echo $sel['nama_usaha'].' - '.$sel['alamat_usaha']?></b></td>
          </tr>
          <?php 
$tglan=date("Y-m-d",strtotime($_GET['tgl']));
if($sel['jenis_aging']==2){
		/*  $dtl=$db->select("tx_brg_masuk a left join m_cabang b on a.id_cabang=b.id_cabang","
		a.surat_jalan as no_spj,a.no_masuk,b.nama_cabang,
	a.tgl as tgl_spj,
	a.jatuh_tempo as tgl_jt,a.total as total_bil,
	(ifnull(a.term,0)) AS term,CURDATE(),datediff('$tglan',a.tgl)as days,
	if(datediff(CURDATE(),a.tgl)<=term,total,0)as belum_tempo,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa1[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa1[akhir],total,0)as s_1_30,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa2[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa2[akhir],total,0)as s_31_60,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa3[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa3[akhir],total,0)as s_61_90,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa4[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa4[akhir],total,0)as s_91_120,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa5[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa5[akhir],total,0)as s_120,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa6[awal],total,0)as s_1202
		  ","a.id_supp='$sel[id_supp]' and a.tgl<='$tglan'");*/
		   $dtl=$db->select("tx_brg_masuk a left join m_cabang b on a.id_cabang=b.id_cabang","
		a.surat_jalan as no_spj,a.no_masuk,b.nama_cabang,
	a.tgl as tgl_spj,
	a.jatuh_tempo as tgl_jt,a.total as total_bil,
	(ifnull(a.term,0)) AS term,CURDATE(),datediff('$tglan',a.tgl)as days,
	if(datediff(CURDATE(),a.tgl)<=term,total,0)as belum_tempo,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa1[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa1[akhir],total,0)as s_1_30,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa2[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa2[akhir],total,0)as s_31_60,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa3[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa3[akhir],total,0)as s_61_90,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa4[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa4[akhir],total,0)as s_91_120,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa5[awal] and datediff(CURDATE(),a.jatuh_tempo)<=$aa5[akhir],total,0)as s_120,
	if(datediff(CURDATE(),a.jatuh_tempo)>=$aa6[awal],total,0)as s_1202
		  ","a.id_supp='$sel[id_supp]' and a.tgl<='$tglan'");
		  
}elseif($sel['jenis_aging']==1){
		  /*$dtl=$db->select("tx_rilis_dtl a 
			left join tx_rilis aa on a.no_so=aa.no_so
			left join tx_so_dtl b on a.no_so=b.sales_order and a.line_item=b.line
			left join m_gudang_shipto d on a.kode_shipto=d.shipto_code
			left join m_gudang e on d.id_gudang=e.id_gudang
			left join m_cabang f on e.id_cabang=f.id_cabang
			","
		a.no_spj,
	a.tgl_spj,f.nama_cabang,a.kode_shipto,
	a.tgl_jt,(b.price*a.qty_do)as total_bil,
	(ifnull(a.term,0)) AS term,CURDATE(),datediff('$tglan',a.tgl_spj)as days,
	if(datediff(CURDATE(),a.tgl_spj)<=term,(b.price*a.qty_do),0)as belum_tempo,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa1[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa1[akhir],(b.price*a.qty_do),0)as s_1_30,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa2[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa2[akhir],(b.price*a.qty_do),0)as s_31_60,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa3[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa3[akhir],(b.price*a.qty_do),0)as s_61_90,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa4[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa4[akhir],(b.price*a.qty_do),0)as s_91_120,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa5[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa5[akhir],(b.price*a.qty_do),0)as s_120,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa6[awal],(b.price*a.qty_do),0)as s_1202
		  ","aa.id_supp='$sel[id_supp]' and a.tgl_spj<='$tglan' and (b.price*a.qty_do)>(select ifnull(sum(dibayar)+1,0) as bay from tx_order_tagihan_bayar where status=1 and no_spj=a.no_spj)");*/
		   $dtl=$db->select("tx_rilis_dtl a 
			left join tx_rilis aa on a.no_so=aa.no_so
			left join tx_so_dtl b on a.no_so=b.sales_order and a.line_item=b.line
			left join m_gudang_shipto d on a.kode_shipto=d.shipto_code
			left join m_gudang e on d.id_gudang=e.id_gudang
			left join m_cabang f on e.id_cabang=f.id_cabang
			","
		a.no_spj,
	a.tgl_spj,f.nama_cabang,a.kode_shipto,
	a.tgl_jt,(b.price*a.qty_do)as total_bil,
	(ifnull(a.term,0)) AS term,CURDATE(),datediff('$tglan',a.tgl_spj)as days,
	if(datediff(CURDATE(),a.tgl_spj)<=term,(b.price*a.qty_do),0)as belum_tempo,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa1[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa1[akhir],(b.price*a.qty_do),0)as s_1_30,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa2[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa2[akhir],(b.price*a.qty_do),0)as s_31_60,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa3[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa3[akhir],(b.price*a.qty_do),0)as s_61_90,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa4[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa4[akhir],(b.price*a.qty_do),0)as s_91_120,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa5[awal] and datediff(CURDATE(),a.tgl_jt)<=$aa5[akhir],(b.price*a.qty_do),0)as s_120,
	if(datediff(CURDATE(),a.tgl_jt)>=$aa6[awal],(b.price*a.qty_do),0)as s_1202
		  ","aa.id_supp='$sel[id_supp]' and a.tgl_spj<='$tglan'"); 
	
}
		
		  foreach($dtl as $arr){
			  if($arr['nama_cabang']==''){
			  		foreach($db->select("m_customer_shipto","shipto_name","shipto_code='$arr[kode_shipto]'")as $kk);
					$arr['nama_cabang']='DA '.$kk['shipto_name'];
			  }else{
				  $arr['nama_cabang']=$arr['nama_cabang'];
			  }
			  
			  if($sel['jenis_aging']==2){
			  	  foreach($db->select("tx_billing_dtl","no_faktur2","no_masuk='$arr[no_masuk]' limit 0,1")as $fk);
				  $faktur=$fk['no_faktur2'];
			  }elseif($sel['jenis_aging']==1){
				  foreach($db->select("tx_billing","no_faktur","no_spj='$arr[no_spj]'")as $fk);
				  $faktur=$fk['no_faktur'];
			  }
			  
			//perhitungna dika
			$ce1=$db->select("tx_order_tagihan_bayar","sum(dibayar) as dibayar","no_spj='$arr[no_spj]' and status='1' and tgl_bayar<='$tglan'");
			//echo "select sum(dibayar) as dibayar from tx_order_tagihan_bayar wehre no_spj='$arr[no_spj]' and status='1'<br>";
			foreach($ce1 as $cek1){}
			
			$kmtg=$db->select("m_klaim_ktg ORDER BY tgl_berlaku desc LIMIT 1","*");
			foreach($kmtg as $kmt){}
						
			$k=$db->select("tx_order_tagihan_kd","*","digunakan_bill='$arr[no_spj]' and status='1'");
			$hit=0;
			$tam=0;
						foreach($k as $kdn){
						
						if($kdn['jenis']==0)
						{
							$hit=($kdn['claim_utuh']*$kdn['harga'])+($kdn['claim_ktg']*$kmt['harga']);
						}elseif($kdn['jenis']==1)
						{
							$hit=$kdn['total'];
						}elseif($kdn['jenis']==2){
							$tam=$kdn['total'];
						}}
			$totalbil=($arr['total_bil']-$hit+$tam)-$cek1['dibayar'];
			
			if($arr['belum_tempo']!=0){
				$arr['belum_tempo']=($arr['belum_tempo']-$hit+$tam)-$cek1['dibayar'];
			}
			if($arr['s_1_30']!=0){
				$arr['s_1_30']=($arr['s_1_30']-$hit+$tam)-$cek1['dibayar'];
			}
			if($arr['s_31_60']!=0){
				$arr['s_31_60']=($arr['s_31_60']-$hit+$tam)-$cek1['dibayar'];
			}
			if($arr['s_61_90']!=0){
				$arr['s_61_90']=($arr['s_61_90']-$hit+$tam)-$cek1['dibayar'];
			}
			if($arr['s_91_120']!=0){
				$arr['s_91_120']=($arr['s_91_120']-$hit+$tam)-$cek1['dibayar'];
			}
			if($arr['s_120']!=0){
				$arr['s_120']=($arr['s_120']-$hit+$tam)-$cek1['dibayar'];
			}
			if($arr['s_1202']!=0){
				$arr['s_1202']=($arr['s_1202']-$hit+$tam)-$cek1['dibayar'];
			}
				//end dik
		  ?>
          <tr>
            <td align="left"><?php echo $arr['nama_cabang'];?></td>
            <td align="left"><?php echo $arr['no_spj'];?></td>
            <td align="left"><?php echo $faktur;?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($arr['tgl_spj']));?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($arr['tgl_jt']));?></td>
            <td align="right"><?php echo $arr['term']?></td>
            <td align="right"><?php echo $arr['days']?></td>
            <td align="right"><?php echo number_format($totalbil,2)?></td>
            <td align="right"><?php echo number_format($arr['belum_tempo'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_1_30'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_31_60'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_61_90'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_91_120'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_120'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_1202'],2)?></td>
          </tr>
          <?php 
		  	//}
		  
			//===================================================================end piutang
		  ?>
          
          <?php 
		  $totalbil=0;
		  	 $no++;
			 $tot1=$tot1+$arr['total_bil'];
			 $tot2=$tot2+$arr['belum_tempo'];
			 $tot3=$tot3+$arr['s_1_30'];
			 $tot4=$tot4+$arr['s_31_60'];
			 $tot5=$tot5+$arr['s_61_90'];
			 $tot6=$tot6+$arr['s_91_120'];
			 $tot7=$tot7+$arr['s_120'];
			 $tot8=$tot8+$arr['s_1202'];
			 
			  }?>
        </tbody>
       
           <tr>
            <td colspan="7" align="left">TOTAL</td>
            <td align="right" ><?php echo number_format($tot1,2)?></td>
            <td align="right" ><?php echo number_format($tot2,2)?></td>
            <td align="right" ><?php echo number_format($tot3,2)?></td>
            <td align="right" ><?php echo number_format($tot4,2)?></td>
            <td align="right" ><?php echo number_format($tot5,2)?></td>
            <td align="right" ><?php echo number_format($tot6,2)?></td>
            <td align="right" ><?php echo number_format($tot7,2)?></td>
            <td align="right" ><?php echo number_format($tot8,2)?></td>
            </tr>
            <tr>
            <td colspan="15" align="left">&nbsp;</td>
         </tr>
    <?php  
			
			 
			 
			 $tott1=$tott1+$tot1;
			 $tott2=$tott2+$tot2;
			 $tott3=$tott3+$tot3;
			 $tott4=$tott4+$tot4;
			 $tott5=$tott5+$tot5;
			 $tott6=$tott6+$tot6;
			 $tott7=$tott7+$tot7;
			 $tott8=$tott8+$tot8;
			 
			 $tot1=0;
			 $tot2=0;
			 $tot3=0;
			 $tot4=0;
			 $tot5=0;
			 $tot6=0;
			 $tot7=0;
			 $tot8=0;
	}
	?>  
     <tr>
            <td colspan="7" align="left">TOTAL HUTANG</td>
            <td align="right" ><?php echo number_format($tott1,2)?></td>
            <td align="right" ><?php echo number_format($tott2,2)?></td>
            <td align="right" ><?php echo number_format($tott3,2)?></td>
            <td align="right" ><?php echo number_format($tott4,2)?></td>
            <td align="right" ><?php echo number_format($tott5,2)?></td>
            <td align="right" ><?php echo number_format($tott6,2)?></td>
            <td align="right" ><?php echo number_format($tott7,2)?></td>
            <td align="right" ><?php echo number_format($tott8,2)?></td>
            </tr>
              
          
      </table>
      <?php }?>
<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
          
          </div>

<script>
	var tableToExcel = (function() {
		
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))

  }
})()
</script>