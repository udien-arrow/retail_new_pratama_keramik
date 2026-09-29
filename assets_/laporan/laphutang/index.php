  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
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
						<div class="col-lg-4">
                    	<select name="supp" id="supp" class="select-search" >
                <option value="">---Supplier---</option>
                <option value="all">All Supplier</option>
                <?php
				$cab=$db->ses_cab($_SESSION['ID_CABANG']);
				$query=$db->select("ex_customer a join m_supplier b on a.id_supp=b.id_supp","a.*,b.nama_usaha");
				foreach($query as $sel){	
				?>
			<option value="<?=$sel['id_supp']?>" <?php if($sel['id_supp']==$_GET['supp']){echo "selected";}?>>
			  <?=$sel['nama_usaha']?>
                </option>
                <?php }?>
              </select>
                       </div>
                       <div class="col-lg-3">
                    	<select class="select" name="aging" id="aging" >
                          <option value="">--Aging--</option>
								<?php
									$query=$db->select("m_umur","*","jenis=3");
									foreach($query as $sel){	
			                    ?>
                                        	<option value="<?=$sel['id_aging']?>"  <?php if($sel['id_aging']==$_GET['aging']){echo "selected";}?>><?=$sel['nama_aging']?></option> <?php } ?>
						 </select>
                       </div>
                       <div class="col-lg-1">
                        <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData2(supp.value,aging.value)">
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
				<th colspan="12" align="left"><b>HUTANG SUPPLIER</b></th>
			</tr>
          <tr bgcolor="#28343a">
            <th width="11%" align="center"><font style="color:#FFF"><b>No Expd</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl Expd</b></font></th>
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
			echo '>'.$aa5['awal'];
			?>
            </b></font></th>
          </tr>
          </thead>
          <?php
if($_GET['supp']!='all'){  
	  $query=$db->select("m_supplier a","a.id_supp,a.nama_usaha,a.kode_supp,a.alamat_usaha","a.status='1' and a.id_supp in (select id_supp from ex_expediture where status=0) and a.id_supp='$_GET[supp]'");
}else{
		$query=$db->select("m_supplier a","a.id_supp,a.nama_usaha,a.kode_supp,a.alamat_usaha","a.status='1' and a.id_supp in (select id_supp from ex_expediture where status=0)");	
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
            <td colspan="12" ><b><?php echo $sel['nama_usaha'].' - '.$sel['alamat_usaha']?></b></td>
          </tr>
          <?php 
		  $dtl=$db->select("ex_expediture","
		no_expediture,
	tgl,
	tempo_tambahan,total_ao,
	(ifnull(n_tempo_n,0)+ifnull(n_tempo_t,0)) AS term,CURDATE(),datediff(CURDATE(),tgl) as days,
	if(datediff(CURDATE(),tgl)<=ifnull(n_tempo_n,0)+ifnull(n_tempo_t,0),total_ao,0)as belum_tempo,
	if(datediff(CURDATE(),tempo_tambahan)>=$aa1[awal] and datediff(CURDATE(),tempo_tambahan)<=$aa1[akhir],total_ao,0)as s_1_30,
	if(datediff(CURDATE(),tempo_tambahan)>=$aa2[awal] and datediff(CURDATE(),tempo_tambahan)<=$aa2[akhir],total_ao,0)as s_31_60,
	if(datediff(CURDATE(),tempo_tambahan)>=$aa3[awal] and datediff(CURDATE(),tempo_tambahan)<=$aa3[akhir],total_ao,0)as s_61_90,
	if(datediff(CURDATE(),tempo_tambahan)>=$aa4[awal] and datediff(CURDATE(),tempo_tambahan)<=$aa4[akhir],total_ao,0)as s_91_120,
	if(datediff(CURDATE(),tempo_tambahan)>=$aa5[awal],total_ao,0)as s_120
		  ","status=0 and id_supp='$sel[id_supp]'");
		  foreach($dtl as $arr){
			  
			//perhitungna dika
			$ce1=$db->select("ex_pembayaran_ex","sum(dibayar) as dibayar","no_expediture='$arr[no_expediture]'");
			foreach($ce1 as $cek1){}
			
			if($arr['belum_tempo']!=0){
				$arr['belum_tempo']=$arr['belum_tempo']-$cek1['dibayar'];
			}
			if($arr['s_1_30']!=0){
				$arr['s_1_30']=$arr['s_1_30']-$cek1['dibayar'];
			}
			if($arr['s_31_60']!=0){
				$arr['s_31_60']=$arr['s_31_60']-$cek1['dibayar'];
			}
			if($arr['s_61_90']!=0){
				$arr['s_61_90']=$arr['s_61_90']-$cek1['dibayar'];
			}
			if($arr['s_91_120']!=0){
				$arr['s_91_120']=$arr['s_91_120']-$cek1['dibayar'];
			}
			if($arr['s_120']!=0){
				$arr['s_120']=$arr['s_120']-$cek1['dibayar'];
			}
			
				//end dik
		  ?>
          <tr>
            <td align="left"><?php echo $arr['no_expediture'];?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($arr['tgl']));?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($arr['tempo_tambahan']));?></td>
            <td align="right"><?php echo $arr['term']?></td>
            <td align="right"><?php echo $arr['days']?></td>
            <td align="right"><?php echo number_format($arr['total_ao'])?></td>
            <td align="right"><?php echo number_format($arr['belum_tempo'])?></td>
            <td align="right"><?php echo number_format($arr['s_1_30'])?></td>
            <td align="right"><?php echo number_format($arr['s_31_60'])?></td>
            <td align="right"><?php echo number_format($arr['s_61_90'])?></td>
            <td align="right"><?php echo number_format($arr['s_91_120'])?></td>
            <td align="right"><?php echo number_format($arr['s_120'])?></td>
          </tr>
          <?php 
		  	//}
		  
			//===================================================================end piutang
		  ?>
          
          <?php 
		  	 $no++;
			 $tot1=$tot1+$arr['total_ao'];
			 $tot2=$tot2+$arr['belum_tempo'];
			 $tot3=$tot3+$arr['s_1_30'];
			 $tot4=$tot4+$arr['s_31_60'];
			 $tot5=$tot5+$arr['s_61_90'];
			 $tot6=$tot6+$arr['s_91_120'];
			 $tot7=$tot7+$arr['s_120'];
			 
			  }?>
        </tbody>
       
           <tr>
            <td colspan="5" align="left">TOTAL</td>
            <td align="right" ><?php echo number_format($tot1)?></td>
            <td align="right" ><?php echo number_format($tot2)?></td>
            <td align="right" ><?php echo number_format($tot3)?></td>
            <td align="right" ><?php echo number_format($tot4)?></td>
            <td align="right" ><?php echo number_format($tot5)?></td>
            <td align="right" ><?php echo number_format($tot6)?></td>
            <td align="right" ><?php echo number_format($tot7)?></td>
            </tr>
            <tr>
            <td colspan="12" align="left">&nbsp;</td>
         </tr>
    <?php  
			
			 
			 
			 $tott1=$tott1+$tot1;
			 $tott2=$tott2+$tot2;
			 $tott3=$tott3+$tot3;
			 $tott4=$tott4+$tot4;
			 $tott5=$tott5+$tot5;
			 $tott6=$tott6+$tot6;
			 $tott7=$tott7+$tot7;
			 
			 $tot1=0;
			 $tot2=0;
			 $tot3=0;
			 $tot4=0;
			 $tot5=0;
			 $tot6=0;
			 $tot7=0;
	}
	?>  
     <tr>
            <td colspan="5" align="left">TOTAL PIUTANG</td>
            <td align="right" ><?php echo number_format($tott1)?></td>
            <td align="right" ><?php echo number_format($tott2)?></td>
            <td align="right" ><?php echo number_format($tott3)?></td>
            <td align="right" ><?php echo number_format($tott4)?></td>
            <td align="right" ><?php echo number_format($tott5)?></td>
            <td align="right" ><?php echo number_format($tott6)?></td>
            <td align="right" ><?php echo number_format($tott7)?></td>
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