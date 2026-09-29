  	 <div class="col-lg-12">
		  <div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php
                    $cab=$db->ses_cab($_SESSION['ID_CABANG']);
					echo $title;
					?>
					</h5>
                    <div class="heading-elements noprint">
							<!--<ul class="icons-list">
                                 <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Detil Hutang" onClick="window.location='index.php?x=lapkroscekbeli'"></button></li>     
						  </ul>-->
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
                    		<input type="text" name="tgl" id="tgl" class="form-control datepicker" value="<?php if($_GET['tgl']==''){echo date("m/d/Y");}else{echo $_GET['tgl'];}?>" >
                       </div>
                       <div class="col-lg-1">
                        <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData2(supp.value,aging.value,tgl.value)">
                       </div>
                      <div class="col-lg-4">  
                           
                    <input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button>
                   <!-- <input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Detil Hutang" onClick="window.location='index.php?x=lapkroscekbeli'">-->
           			</div>
                      
           			</div>
           <?php
           if($_GET['supp']!=''){
		   ?>    
              <div class="dataTables_wrapper"></div>
					<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0" id="example4">
    <thead> 
            <tr>
				<th colspan="13" align="left"><b>HUTANG SUPPLIER</b></th>
			</tr>
          <tr bgcolor="#28343a">
            <th width="11%" align="center"><font style="color:#FFF"><b>Cabang</b></font></th>
            <th width="11%" align="center"><font style="color:#FFF"><b>Supplier</b></font></th>
            <th width="11%" align="center"><font style="color:#FFF"><b>No SPJ</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl SPJ</b></font></th>
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
        
        <tbody>
          <?php 
		$no=1;
		$tgl=date("Y-m-d");
		$tglan=date("Y-m-d",strtotime($_GET['tgl']));
		 if($_GET['supp']=='all'){
			 $supp="id_supp in (select id_supp from m_supplier where jenis_aging=2)";
		 }else{
			 foreach($db->select("m_supplier","jenis_aging","id_supp='$_GET[supp]'")as $cek);
			 if($cek['jenis_aging']==1){
				$supp="id_supp='tidak'"; 
			 }else{
			 	$supp="id_supp='$_GET[supp]'";
			 }
	     } 
		 	$supp="id_supp in (select id_supp from m_supplier where jenis_aging=1)";
		  
		$table="(
		SELECT a.id_supp,
		case 
			when a.id_ref is null THEN a.no_ref
			when a.id_ref is not null THEN a.surat_jalan 
		end as
		no_spj,a.no_masuk,b.nama_cabang, a.tgl as tgl_spj, a.jatuh_tempo as tgl_jt,''as kode_shipto,a.total as total_bil, 
		(ifnull(a.term,0)) AS term,CURDATE(),datediff('$tglan',a.tgl)as days, if(datediff(CURDATE(),a.tgl)<=term,total,0)as belum_tempo, 
		if(datediff(CURDATE(),a.tgl)>=$aa1[awal]+(ifnull(term,0)) and datediff(CURDATE(),a.tgl)<=$aa1[akhir]+(ifnull(term,0)),total,0)as s_1_30, 
		if(datediff(CURDATE(),a.tgl)>=$aa2[awal]+(ifnull(term,0)) and datediff(CURDATE(),a.tgl)<=$aa2[akhir]+(ifnull(term,0)),total,0)as s_31_60, 
		if(datediff(CURDATE(),a.tgl)>=$aa3[awal]+(ifnull(term,0)) and datediff(CURDATE(),a.tgl)<=$aa3[akhir]+(ifnull(term,0)),total,0)as s_61_90, 
		if(datediff(CURDATE(),a.tgl)>=$aa4[awal]+(ifnull(term,0)) and datediff(CURDATE(),a.tgl)<=$aa4[akhir]+(ifnull(term,0)),total,0)as s_91_120, 
		if(datediff(CURDATE(),a.tgl)>=$aa5[awal]+(ifnull(term,0)) and datediff(CURDATE(),a.tgl)<=$aa5[akhir]+(ifnull(term,0)),total,0)as s_120, 
		if(datediff(CURDATE(),a.tgl)>=$aa6[awal]+(ifnull(term,0)),total,0)as s_1202 
		FROM 
			tx_brg_masuk a left join m_cabang b on a.id_cabang=b.id_cabang 
		WHERE 
			$supp  and a.tgl<='$tglan' and a.jenis not in (4,5,9)
	
) a left JOIN m_supplier b on a.id_supp=b.id_supp
LEFT JOIN (
	select 
	id_supp,no_spj,ifnull(sum(dibayar),0) as dibayar
	from 
	tx_order_tagihan_bayar where status='1' and tgl_bayar<='$tglan' GROUP BY id_supp,no_spj
) d on a.id_supp=d.id_supp and a.no_spj=d.no_spj
LEFT JOIN (						
			SELECT				
				a.no_retur,			
				a.tgl_retur,			
				a.no_ref,			
				a.no_spj,			
				b.qty_kembali,b.harga_beli, sum(b.qty_kembali*b.harga_beli) as jumlah_retur			
			FROM				
				tx_retur_pem a			
			JOIN tx_retur_pem_dtl b ON a.no_retur = b.no_retur				
			WHERE				
				a.tgl_retur <='$tglan' GROUP BY a.no_spj			
	)e on a.no_spj=e.no_spj						
	LEFT JOIN (						
			select (total_sebelumnya-total) as jumlah_kor,no_ref,no_koreksi from tx_koreksi_habel where tgl_koreksi <='$tglan'			
	)f on a.no_masuk=f.no_ref
	
";
	$isi="b.nama_usaha,b.jenis_aging,a.*,ifnull(d.dibayar,0)dibayar,ifnull(e.jumlah_retur,0)jumlah_retur,ifnull(f.jumlah_kor,0)jumlah_kor,
CASE
	WHEN b.jenis_aging=2 then (select no_faktur2 from tx_billing_dtl where no_masuk=a.no_masuk limit 0,1)
	WHEN b.jenis_aging=1 then (select a.no_faktur from tx_billing a JOIN tx_billing_dtl b on a.no_billing=b.no_billing where b.no_spj=a.no_spj limit 0,1)
end as faktur";

	if($_GET['supp']=='all'){
		$supp3="";
	}else{
		$supp3="a.id_supp='$_GET[supp]'";
	}
	$where="$supp3";
	
	
		$dtl=$db->select($table,$isi,$where);
			
		
		  foreach($dtl as $arr){
			$totalbil=($arr['total_bil']-$arr['dibayar']-$arr['jumlah_retur']+$arr['jumlah_kor']+$arr['jumlah_hut']);
			
			if($arr['belum_tempo']!=0){
				$arr['belum_tempo']=($arr['belum_tempo']-$arr['dibayar']-$arr['jumlah_retur']+$arr['jumlah_kor']+$arr['jumlah_hut']);
			}
			if($arr['s_1_30']!=0){
				$arr['s_1_30']=($arr['s_1_30']-$arr['dibayar']-$arr['jumlah_retur']+$arr['jumlah_kor']+$arr['jumlah_hut']);
			}
			if($arr['s_31_60']!=0){
				$arr['s_31_60']=($arr['s_31_60']-$arr['dibayar']-$arr['jumlah_retur']+$arr['jumlah_kor']+$arr['jumlah_hut']);
			}
			if($arr['s_61_90']!=0){
				$arr['s_61_90']=($arr['s_61_90']-$arr['dibayar']-$arr['jumlah_retur']+$arr['jumlah_kor']+$arr['jumlah_hut']);
			}
			if($arr['s_91_120']!=0){
				$arr['s_91_120']=($arr['s_91_120']-$arr['dibayar']-$arr['jumlah_retur']+$arr['jumlah_kor']+$arr['jumlah_hut']);
			}
			if($arr['s_120']!=0){
				$arr['s_120']=($arr['s_120']-$arr['dibayar']-$arr['jumlah_retur']+$arr['jumlah_kor']+$arr['jumlah_hut']);
			}
			if($arr['s_1202']!=0){
				$arr['s_1202']=($arr['s_1202']-$arr['dibayar']-$arr['jumlah_retur']+$arr['jumlah_kor']+$arr['jumlah_hut']);
			}
				//end dik
					
			if($totalbil<>0){		
		  ?>
          <tr>
            <td align="left"><?php 
			if($arr['nama_cabang']==''){
				echo "Migrasi tidak ada shipto";
				}else{
			echo $arr['nama_cabang'];
				}
			?></td>
            <td align="left"><?php echo $arr['nama_usaha']?></td>
            <td align="left"><?php echo $arr['no_spj'];?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($arr['tgl_spj']));?></td>
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
		  	
		 	// $totalbil=0;
		  	 $no++;
			 $tot1=$tot1+$totalbil;
			 $tot2=$tot2+$arr['belum_tempo'];
			 $tot3=$tot3+$arr['s_1_30'];
			 $tot4=$tot4+$arr['s_31_60'];
			 $tot5=$tot5+$arr['s_61_90'];
			 $tot6=$tot6+$arr['s_91_120'];
			 $tot7=$tot7+$arr['s_120'];
			 $tot8=$tot8+$arr['s_1202'];
			 }
			 
		  } //end
			  ?>
        </tbody>
     <tr>
            <td colspan="5" align="left">TOTAL HUTANG</td>
            <td align="right" ><?php echo number_format($tot1,2)?></td>
            <td align="right" ><?php echo number_format($tot2,2)?></td>
            <td align="right" ><?php echo number_format($tot3,2)?></td>
            <td align="right" ><?php echo number_format($tot4,2)?></td>
            <td align="right" ><?php echo number_format($tot5,2)?></td>
            <td align="right" ><?php echo number_format($tot6,2)?></td>
            <td align="right" ><?php echo number_format($tot7,2)?></td>
            <td align="right" ><?php echo number_format($tot8,2)?></td>
            </tr> 
      </table>
      <?php }?>

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