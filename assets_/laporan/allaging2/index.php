
          <div class="col-lg-12">
		  <div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">
					<?php
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
                    	<select class="select" name="cabang" id="cabang">
                          <option value="">--Cabang--</option>
                          
								<?php
									
									if($_SESSION['ID_CABANG']==0 OR $_SESSION['ID_CABANG']==99){
										$query=$db->select("m_cabang","id_cabang,nama_cabang","status='1'");echo "<option value='all'>All</option>";
									} else {
										$query=$db->select("m_cabang","id_cabang,nama_cabang","status='1' AND id_cabang='$_SESSION[ID_CABANG]'");
										
									}
									
									foreach($query as $sel){	
			                    ?>
                                        	<option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$_GET['cab']){echo "selected";}?>><?=$sel['nama_cabang']?></option> <?php } ?>
						  </select>
                       </div>
                       <div class="col-lg-2">
                    	<select class="select" name="aging" id="aging" >
                          <option value="">--Aging--</option>
								<?php
									$query=$db->select("m_umur","*","jenis=1");
									foreach($query as $sel){	
			                    ?>
                                        	<option value="<?=$sel['id_aging']?>"  <?php if($sel['id_aging']==$_GET['aging']){echo "selected";}?>><?=$sel['nama_aging']?></option> <?php } ?>
						 </select>
                       </div>
                       <div class="col-lg-2">
                    		<input type="text" name="tgl" id="tgl" class="form-control datepicker" value="<?php if($_GET['tgl']==''){echo date("d-m-Y");}else{echo $_GET['tgl'];}?>" >
                       </div>
                       
                       <div class="col-lg-1">
                        <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData2(cabang.value,aging.value,tgl.value)">
                       </div>
                      
           			</div>
           <?php
           if($_GET['cab']!=''){
		   ?>         
					<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0" id="example4">
    <thead> 
            <tr>
				<th colspan="14" align="left"><b>PIUTANG CABANG : <?php
                foreach($db->select("m_cabang","nama_cabang","id_cabang='$_GET[cab]'")as $caba);
				echo $caba['nama_cabang'];
				?></b></th>
			</tr>
          <tr bgcolor="#28343a">
            <th width="11%" align="center"><font style="color:#FFF"><b>Cabang</b></font></th>
            <th width="11%" align="center"><font style="color:#FFF"><b>Kode Pel</b></font></th>
            <th width="11%" align="center"><font style="color:#FFF"><b>Nama Pel</b></font></th>
            <th width="11%" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl </b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Term</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Umur</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Total</b></font></th>
            <!--<th width="8%" align="center"><font style="color:#FFF"><b>Belum Jatuh Tempo</b></font></th>-->
            <th width="8%" align="center"><font style="color:#FFF"><b>
            <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=1")as $aa1);
			echo $aa1['awal'].'-'.$aa1['akhir'];
			?></b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=2")as $aa2);
			echo $aa2['awal'].'-'.$aa2['akhir'];
			?>
            </b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=3")as $aa3);
			echo $aa3['awal'].'-'.$aa3['akhir'];
			?>
            </b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=4")as $aa4);
			echo $aa4['awal'].'-'.$aa4['akhir'];
			?>
            </b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=5")as $aa5);
			echo $aa5['awal'].'-'.$aa5['akhir'];
			?>
            </b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>
              <?php
            foreach($db->select("m_umur_dtl","*","id_aging='$_GET[aging]' and urut=6")as $aa6);
			echo '>'.$aa6['awal'];
			?>
            </b></font></th>
          </tr>
          </thead>
          <?php
if($_GET['cab']!='all'){  
	 $cabin="a.id_cabang='$_GET[cab]' and";
}else{
	$cabin="";			
}
	
		
	  $totsem='';
	  $totnon='';
	  //foreach($query as $sel){
	  ?>   
        <tbody>
          <?php 
		  $no=1;
		  $tgl=date("Y-m-d");
		  ?>
          <?php 
		  $tglan=date("Y-m-d",strtotime($_GET['tgl']));
		  $dtl=$db->select("
		  (
	select 
	b.kode_cus,b.nama_usaha,c.nama_cabang,a.*,
		('30') AS term,CURDATE(),datediff('$tglan',tgl)as days,
		if(datediff(CURDATE(),tgl)<=30,a.total_piu,'0')as belum_tempo,
		if(datediff(CURDATE(),tgl)>=$aa1[awal] and datediff(CURDATE(),tgl)<=$aa1[akhir],a.total_piu,0)as s_1_30,
		if(datediff(CURDATE(),tgl)>=$aa2[awal] and datediff(CURDATE(),tgl)<=$aa2[akhir],a.total_piu,0)as s_31_60,
		if(datediff(CURDATE(),tgl)>=$aa3[awal] and datediff(CURDATE(),tgl)<=$aa3[akhir],a.total_piu,0)as s_61_90,
		if(datediff(CURDATE(),tgl)>=$aa4[awal] and datediff(CURDATE(),tgl)<=$aa4[akhir],a.total_piu,0)as s_91_120,
		if(datediff(CURDATE(),tgl)>=$aa5[awal] and datediff(CURDATE(),tgl)<=$aa5[akhir],a.total_piu,0)as s_120,
		if(datediff(CURDATE(),tgl)>=$aa6[awal],a.total_piu,0)as s_1202
	from 
	(
		select a.id_cabang,a.status,a.no_faktur_jual,a.no_ref,a.id_cus,a.tgl,tgl as tempo_tambahan,a.total_piutang,ifnull(b.total_dibayar,0)total_dibayar,	
		(a.total_piutang-ifnull(b.total_dibayar,0)) as total_piu	
		from tx_piutang a 	
		LEFT JOIN (	
			select replace(no_faktur,'-RB','')no_faktur,sum(total_dibayar)total_dibayar from tx_pembayaran_sales where jenis_pembayaran<>'4' and tgl_bayar<='$tglan'
 GROUP BY replace(no_faktur,'-RB','')
		)b on a.no_faktur_jual=b.no_faktur	
		LEFT JOIN(	
			select z.no_ref,z.jumlah_so as total_retur,z.id_cus,(SELECT no_faktur_jual from tx_piutang where no_ref=z.no_ref ORDER by id_piutang limit 0,1 )as no_fj 
			from tx_retur_pen z where z.tgl_retur<='$tglan' 
		)c on a.no_faktur_jual=c.no_fj	
		WHERE a.tgl<='$tglan' 	
		GROUP BY a.no_faktur_jual			
	)a 
	join m_customer b on a.id_cus=b.id_cus
	join m_cabang c on a.id_cabang=c.id_cabang where  total_piu <>'0' order by id_cabang,id_cus,datediff('$tglan',tgl) DESC

) a		  ","*","a.total_piu<>0 and a.status!=2 order by a.id_cabang,a.id_cus,a.days");
		  
		  foreach($dtl as $arr){
			$totalpi=$arr['total_piu'];
			if($totalpi!=0){
		  ?>
          <tr>
            <td align="left"><?php echo $arr['nama_cabang'];?></td>
            <td align="left"><?php echo $arr['kode_cus'];?></td>
            <td align="left"><?php echo $arr['nama_usaha'];?></td>
            <td align="left"><?php echo $arr['no_faktur_jual'];?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($arr['tempo_tambahan']));?></td>
            <td align="right"><?php echo $arr['term']?></td>
            <td align="right"><?php echo $arr['days']?></td>
            <td align="right"><?php echo number_format($totalpi,2)?></td>
            <!--<td align="right"><?php echo number_format($arr['belum_tempo'],2)?></td>-->
            <td align="right"><?php echo number_format($arr['s_1_30'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_31_60'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_61_90'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_91_120'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_120'],2)?></td>
            <td align="right"><?php echo number_format($arr['s_1202'],2)?></td>
          </tr>
          <?php 
			}
		  
			//===================================================================end piutang
		  ?>
          
          <?php 
		  	 $no++;
			 $tot1=$tot1+$totalpi;
			 $tot2=$tot2+$arr['belum_tempo'];
			 $tot3=$tot3+$arr['s_1_30'];
			 $tot4=$tot4+$arr['s_31_60'];
			 $tot5=$tot5+$arr['s_61_90'];
			 $tot6=$tot6+$arr['s_91_120'];
			 $tot7=$tot7+$arr['s_120'];
			 $tot8=$tot8+$arr['s_1202'];
			  
			 $totalpi=0;
			 $arr['belum_tempo']=0;
			 $arr['s_1_30']=0;
			 $arr['s_31_60']=0;
			 $arr['s_61_90']=0;
			 $arr['s_91_120']=0;
			 $arr['s_120']=0;
			 $arr['s_1202']=0;
			// }
	}
	?>  
     <tr>
            <td colspan="7" align="left">TOTAL PIUTANG</td>
            <td align="right" ><?php echo number_format($tot1,2)?></td>
            <!--<td align="right" ><?php echo number_format($tot2,2)?></td>-->
            <td align="right" ><?php echo number_format($tot3,2)?></td>
            <td align="right" ><?php echo number_format($tot4,2)?></td>
            <td align="right" ><?php echo number_format($tot5,2)?></td>
            <td align="right" ><?php echo number_format($tot6,2)?></td>
            <td align="right" ><?php echo number_format($tot7,2)?></td>
            <td align="right" ><?php echo number_format($tot8,2)?></td>
            </tr>
            </tbody>  
          
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