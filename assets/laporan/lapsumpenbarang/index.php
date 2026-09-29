<style type="text/css">
@media print
{
.noprint {display:none;}
.datatable-header {display:none;}
 @page {
              size: portrait;
              margin-top: 0cm;
              margin-bottom: 1cm;
              margin-left: 0cm;
              margin-right: 0cm;
           }
		   

}
.tableku {
               border: .1em solid #ddd;border-collapse:collapse; 
               width:100%; 
        }
td {
	   
	   border: 1px solid #ddd; font-size:14px; line-height: 20px; 
	   vertical-align:middle; padding:3px; font-family:"Arial";
 	}
th {
	   
	   border: 1px solid #ddd; font-size:15px; line-height: 20px; 
	   vertical-align:middle; padding:1px; font-family:"Arial"; text-align:center
 	}
</style>
          <div class="col-lg-12">
		 
           <div class="panel panel-flat">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        Laporan Penjualan Barang
                        </h5>
                        <div class="heading-elements noprint">
							<ul class="icons-list">
		                		<?php 
						  $a=explode('/',$_GET['a']);
						  $gg=$a[2]."-".$a[0]."-".$a[1];
						  $b=explode("/",$_GET['b']);
						  $wp=$b[2]."-".$b[0]."-".$b[1];
							?>
		                		<!--<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>-->
                                <li><a target="_blank" href="cetak.php?jenis=<?=$_GET['jenis']?>&a=<?=$gg?>&b=<?=$wp?>&jenis_bayar=<?=$_GET['jenis_bayar']?>&jenis_jual=<?=$_GET['jenis_jual']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td> 
                    <div class="col-lg-10">
                                <div class="form-group">     
                              	<div class="col-lg-2">
                              	  <select name="jenis" id="jenis" class="select" onChange= "pindahdata()" >
                                  <option value="">- Jenis -</option>
                                  <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?> >Pelanggan</option>
                                  <option value="2" <?php if($_GET['jenis']==2){echo "selected";}?>>Jenis Jual</option>
                                  <option value="3" <?php if($_GET['jenis']==3){echo "selected";}?>>Jenis Bayar</option>
                                </select>
                               </div>
                               
<?php if($_GET[jenis]=='1'){?>                               
                               
                               <div class="col-lg-2">
                              	  <select name="pelanggan" id="pelanggan" class="select-search">
                                  <option value="">- Pelanggan -</option>
                                </select>
                               </div>
                               
<?php } else if($_GET[jenis]=='2'){ ?>                                                             	<div class="col-lg-2">
                              	  <select name="jenis_jual" id="jenis_jual" class="select" onChange= "pindahdata2(jenis.value,jenis_jual.value)">
                                  <option value="">- Jenis Jual -</option>
                                  <option value="x" <?php if($_GET['jenis_jual']==x){echo "selected";}?>> All</option>
                                  <option value="1" <?php if($_GET['jenis_jual']==1){echo "selected";}?>>Retail</option>
                                  <option value="2" <?php if($_GET['jenis_jual']==2){echo "selected";}?>>Grosir</option>
                                </select>
                               </div>
 <?php } else if($_GET[jenis]=='3') { ?>
                               
<div class="col-lg-2">
                              	  <select name="jenis_bayar" id="jenis_bayar" class="select" onChange= "pindahdata3(jenis.value,jenis_bayar.value)">
                                  <option value="">- Jenis Bayar -</option>
                                  <option value="x" <?php if($_GET['jenis_bayar']==x){echo "selected";}?>> All</option>
                                  <option value="1" <?php if($_GET['jenis_bayar']==1){echo "selected";}?>>Langsung</option>
                                  <option value="2" <?php if($_GET['jenis_bayar']==2){echo "selected";}?>>Kredit</option>
                                </select>
                               </div>
   
<?php } ?>   

  <div class="col-lg-2">
                              
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[a]?>">
                                  </div>
                               </div>
                               
                               <div class="col-lg-2">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgsd" id="tgsd" value="<?php echo $_GET[b]?>">
                                  
                                  </div>
                               </div>
                               <div class="col-lg-1">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahdata4(jenis.value,  tg.value, tgsd.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table id="example" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="10" style="text-align:center" ><h5>LAPORAN SUMMARY PENJUALAN BARANG <br>PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            <tr bgcolor="#EFEFEF">
                                <th width="15%" >Nomer penjualan </th>
                                <th width="10%" >Tgl Penjualan</th>
                              	<th width="10%">Pelanggan</th>
                                <th width="10%">Jenis Jual</th>
                                <th width="10%">Jenis Bayar</th>
                                <th width="10%">Total Jual</th> 
                                <th width="5%">Disc</th>
                                <th width="10%">Grant</th>
                                <th width="10%">Total Bayar</th>
                                <th width="10%">Kembali</th>  
                          </tr> 
                      </thead>
 <?php
 if($_GET['a']!=''){
 if($_GET['jenis']=='2'){
	
$where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' and jenis_jual='$_GET[jenis_jual]'";
}
else if($_GET['jenis']=='3'){
	
$where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' and jenis_bayar='$_GET[jenis_bayar]'";
}


		$kon=$db->select("pj_penjualan ", "*", $where2);
        $no=1; 
        foreach($kon as $d){
		$total=$total+$d['grantot_jual']; 
		?>
         <tr>
         <td width="10%" ><?php echo ucfirst(strtolower($d['no_penjualan']));?></td>
         <td width="5%" ><?php echo ucfirst(strtolower($d['tgl_penjualan']));?></td>
         <td width="10%"><?=$d['id_customer']?></td>
         <td width="10%">
           <?php $a= $d['jenis_jual'];
		 if ($a == 1) {
			 $a ='Retail';
			 }else if($a == 2){
				$a='Grosir';
			}
		 ?>
		 <button class="btn btn-success"  type="button" id="jual">
		 <?=$a?></button>
		 </td>
         <td width="10%">
         <?php $b= $d['jenis_bayar'];
		 if ($b == 1) {
			 $b ='Langsung';
			 }else if($b == 2){
				$b='Kredit';
			}
		 ?>
         <button class="btn btn-info"  type="button" id="bayar" ><?=$b?></button></td>
         <td width="15%"><?=number_format($d['total_jual'])?></td> 
         <td width="5%"><?=$d['disc_prs']?></td>
         <td width="10%" align="right"><?=number_format($d['grantot_jual'])?></td>
          <td width="5%"><?=number_format($d['bayar_tunai']+=$d['bayar_card'])?></td>
          <td width="5%"><?=number_format($d['kembali_tunai'])?></td>
         </tr> 
<?php }} ?>     
                      <tfoot>
                      <tr >
                             <td bgcolor="#EFEFEF" colspan="7" align="center">Total Penjualan</td>
                             <td align="right" colspan="3">
                              <?=number_format($total)?>
                              </td>
                           </tr>
                      </tfoot>
 
                       </table>    
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

