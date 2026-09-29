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
                         <div class="col-lg-12" align = "right">                      
							<ul class="icons-list">                          
							<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button></li>

							</ul> 
                            </div>                 
           			</div>                   

					<table id="example4" class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
          <tr>
            <th colspan="5" align="left"><span class="icons-list"><span class="panel-title"><span class="col-lg-4">
              <select name="cus" id="cus" class="select-search" onChange="pindahData2(cus.value)">
                <option value="">---Pelanggan---</option>
                <option value="all">All Pelanggan</option>
                <?php
				$cab=$db->ses_cab($_SESSION['ID_CABANG']);
				
				$query=$db->select("m_customer","id_cus,nama_usaha,kode_cus","status='1'");
				foreach($query as $sel){	
				?>
			<option value="<?=$sel['id_cus'].'_'.$sel['kode_cus']?>" <?php if($sel['id_cus'].'_'.$sel['kode_cus']==$_GET['cus']){echo "selected";}?>>
			  <?=$sel['kode_cus'].' - '.$sel['nama_usaha']?>
                </option>
                <?php }?>
              </select>
            </span></span></span></th>
          </tr>
      <?php
       $exp2=explode("_",$_GET['cus']);
 		?>    
            <tr>
				<th colspan="5" align="left"><b>Piutang</b></th>
			</tr>
          <tr bgcolor="#28343a">
            <th width="11%" align="center"><font style="color:#FFF"><b>Pelanggan</b></font></th>
            <th width="11%" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl </b></font></th>
            <th align="center"><font style="color:#FFF"><b>Total Piutang</b></font></th>
            <th width="12%" align="center"><font style="color:#FFF"><b>Umur Piutang</b></font></th>
          </tr>
          </thead>
        <tbody>
          <?php 
		  $no=1;
		  $tgl=date("Y-m-d");
		  ?>
          <?php 
		  if($_GET['cus']=='all'){
				$cus="";  
		  }else{
			  	$cus="a.id_cus='$exp2[0]' and";  
		  }
		  
		  $dtl=$db->select("tx_piutang a left join m_customer b on a.id_cus=b.id_cus","a.id_cus,no_faktur_jual,(total_piutang-ifnull((select sum(ifnull(total_dibayar,0)) from tx_pembayaran_sales where no_faktur=a.no_faktur_jual 
group by no_faktur
),0) )as total_piutang,tgl,b.nama_usaha"," $cus a.status=1 and a.status_bayar=0 ");
		  foreach($dtl as $arr){
		  ?>
          <tr>
            <td align="left"><?php echo $arr['nama_usaha'];?></td>
            <td align="left"><?php echo $arr['no_faktur_jual'];?></td>
            <td align="left"><?php echo date("d-m-Y",strtotime($arr['tgl']));?></td>
            <td width="11%" align="right"><?php echo number_format($arr['total_piutang']);?></td>
            <td align="right">
            <?php
			 $skr=date("Y-m-d");	
             $selisih = ((abs(strtotime ($skr) - strtotime ($arr['tgl'])))/(60*60*24));
			 echo $selisih.' Hari';
			?>
            </td>
          </tr>
          <?php 
		  	}
		  ?>
          
          
        </tbody>
         <tr>
            <td colspan="5" align="left">&nbsp;</td>
            </tr>
    <?php //}?>      
          
      </table>
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

