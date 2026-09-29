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
	   $jum=count($db->select("tx_brg_masuk","*","id_supp='$_GET[supp]' and status=0"));
	   }else{
	   $jum=count($db->select("tx_brg_masuk","*","status=0"));
	  }
	   if($jum>0){		  
	  ?>    
            <tr>
				<th colspan="9" align="left"><b>Hutang</b></th>
			</tr>
            <tr bgcolor="#28343a">
                <th width="5%" align="center"><font style="color:#FFF"><b>Kode</b></font></th>
                <th width="25%" align="center"><font style="color:#FFF"><b>Supplier</b></font></th>
                <th width="20%" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
                <th width="10%" align="center"><font style="color:#FFF"><b>Tgl </b></font></th>
                <th width="10%" align="center"><font style="color:#FFF"><b>Total Hutang</b></font></th>
                <th width="10%" align="center"><font style="color:#FFF"><b>Dibayar</b></font></th>
                <th width="10%" align="center"><font style="color:#FFF"><b>Sisa Hutang</b></font></th>


          	</tr>
        </thead>
        <?php 
		if($_GET['supp']!='all'){
		$bil=$db->select("tx_brg_masuk a join m_supplier b on a.id_supp=b.id_supp","a.*,b.nama_usaha,b.kode_supp","a.id_supp='$_GET[supp]' and a.status='0'");
		}else{
		$bil=$db->select("tx_brg_masuk a join m_supplier b on a.id_supp=b.id_supp","a.*,b.nama_usaha,b.kode_supp"," a.status='0'");	
		}
		$hit=0;
		$tam=0;
		$total = 0;
		$total2 = 0;
		$dibayar = 0;
		foreach($bil as $bill){
		$ce1=$db->select("tx_pembayaran_hutang","sum(total_dibayar) as dibayar","no_faktur='$bill[no_masuk]'");
		foreach($ce1 as $cek1){}
		?>
        <tr>
              	<td><?=$bill['kode_supp']?></td>
              	<td><?=$bill['nama_usaha']?></td>
               	<td><?=$bill['no_masuk']?></td>
                <td><?=$bill['tgl']?></td>
                <td><?=number_format($bill['total'],0)?></td>
                <td><?=number_format($cek1['dibayar'],0)?></td>              
                <td><?=number_format($bill['total']-$cek1['dibayar'],0)?></td>
        </tr>
        <?php
		$total = $total + $bill['total'];
		$dibayar = $dibayar + $cek1['dibayar'];	
		$total2 = $total2 + $bill['total']-$cek1['dibayar'];
		} ?>
        <tr>
        <td colspan="4" align="right"><b>Total</b></td>
        <td><?=number_format($total,2,',','.')?></td>
         <td><?=number_format($dibayar,2,',','.')?></td>      
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

