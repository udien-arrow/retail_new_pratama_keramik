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
                    <hr>
                     <div class="form-group">
						<div class="col-lg-4">
  			<select name="cus" id="cus" class="select-search" onChange="pindahData2(cus.value)">
                <option value="">---Supplier---</option>
                <option value="all" <?php if($_GET['supp']=='all'){echo "selected";}?>>All Supplier</option>
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
            </span></span></span>
           
    </div>
                    <div class="col-lg-4">       
                    <input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button>
           			</div>
           			</div>
  <table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0" id="example4">
    <thead>
     
      <?php
       	$exp2=explode("_",$_GET['cus']);
 	   	if($_GET['supp']!='all'){
		   $jum=count($db->select("tx_bph","*","id_supplier='$_GET[supp]' and status=1"));
		}else{
		   $jum=count($db->select("tx_bph","*","status=1"));
		}
		
	   	if($jum>0){		  
	  ?>    
				<tr>
					<th colspan="9" align="left"><b>Hutang</b></th>
				</tr>
				<tr bgcolor="#28343a">
					<th width="10%" align="center"><font style="color:#FFF"><b>Kode</b></font></th>
					<th width="25%" align="center"><font style="color:#FFF"><b>Supplier</b></font></th>
					<th width="25%" align="center"><font style="color:#FFF"><b>Keterangan</b></font></th>
					<th width="10%" align="center"><font style="color:#FFF"><b>Tgl </b></font></th>
					<th width="10%" align="center"><font style="color:#FFF"><b>Total Hutang</b></font></th>
				</tr>
			  <!--<tr bgcolor="#28343a">
				<th width="5%" rowspan="2" align="center"><font style="color:#FFF"><b>Kode</b></font></th>
				<th width="26%" rowspan="2" align="center"><font style="color:#FFF"><b>Supplier</b></font></th>
				<th width="20%" rowspan="2" align="center"><font style="color:#FFF"><b>No Billing</b></font></th>
				<th width="9%" rowspan="2" align="center"><font style="color:#FFF"><b>Tgl </b></font></th>
				<th colspan="2" align="center"><font style="color:#FFF"><b>Total Hutang</b></font></th>
			  </tr>-->
			  <!--<tr bgcolor="#28343a">
				<th width="15%" align="center"><font style="color:#FFF"><b>Semen</b></font></th>
				<th width="16%" align="center"><font style="color:#FFF"><b>Non Semen</b></font></th>
			  </tr>-->
     </thead>
			<?php 
			if($_GET['supp']!='all'){
				$bil=$db->select("tx_bph b JOIN m_supplier c ON b.id_supplier = c.id_supp","b.no_bph AS no_bph, c.nama_usaha AS nama_usaha, b.keterangan AS keterangan, b.tgl AS tgl, b.total AS jumlah","b.id_supplier='$_GET[supp]' and b.status='1'");
			}else{
				$bil=$db->select("tx_bph b JOIN m_supplier c ON b.id_supplier = c.id_supp","b.no_bph AS no_bph, c.nama_usaha AS nama_usaha, b.keterangan AS keterangan, b.tgl AS tgl, b.total AS jumlah","b.status='1'");	
			}
			
				//$hit=0;
				//$tam=0;
				foreach($bil as $bill){
					/*$ce1=$db->select("tx_order_tagihan_bayar","sum(dibayar) as dibayar","no_billing='$bill[no_billing]' and status='1'");
					foreach($ce1 as $cek1){}
					
					$kmtg=$db->select("m_klaim_ktg ORDER BY tgl_berlaku desc LIMIT 1","*");
								foreach($kmtg as $kmt){}
						
					$k=$db->select("tx_order_tagihan_kd","*","digunakan_bill='$bill[no_billing]' and status='1'");
					$hit=0;
					$tam=0;
					foreach($k as $kdn){
					
						if($kdn['jenis']==0){
							$hit=($kdn['claim_utuh']*$kdn['harga'])+($kdn['claim_ktg']*$kmt['harga']);
						}elseif($kdn['jenis']==1){
							$hit=$kdn['total'];
						}elseif($kdn['jenis']==2){
							$tam=$kdn['total'];
						}
					}
					
					$tot=($bill['total_bil']-$hit+$tam)-$cek1['dibayar'];
					
					if($tot==0){				
					}else{*/
						?>
						<tr>
							<td><?=$bill['no_bph']?></td>
							<td><?=$bill['nama_usaha']?></td>
							<td><?=$bill['keterangan']?></td>
							<td><?=$bill['tgl']?></td>
                            <td><?php echo number_format($bill['jumlah'],2,',','.');?></td>
							<!--<td></td>
								<?php if($bill['jenis']==1){
								//echo number_format($tot);
								}?>
							
							<td><?php if($bill['jenis']==0){
								echo number_format($tot,2,',','.');
								}?>
							</td>-->
						</tr>
						<?php
						/*if($bill['jenis']==1){
							//$totals+=$tot;
						}elseif($bill['jenis']==0){
							$total2+=$tot;
						}*/
						$total2+=$bill['jumlah'];	
					//} 
				} ?>
			<tr>
				<td colspan="4" align="right"><b>Total</b></td>
				<!--<td><?=number_format($totals)?></td>-->
				<td><?=number_format($total2,2,',','.')?></td>
			</tr>
		  </table>
				<input type="hidden" name="aksi" id="aksi"  value=""  required>
				<input type="hidden" name="id" id="id"  value=""  required>
			  </div>
			  
			  </div>
	<?php } ?>
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

