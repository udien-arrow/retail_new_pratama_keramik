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
.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap}
</style>

  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		 
           <div class="panel panel-flat scrolls">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        <?=$title?>
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
                                <li><a target="_blank" href="cetak.php?cab=<?=$_GET['cab']?>&a=<?=$gg?>&b=<?=$wp?>&jenis=<?=$_GET['jenis']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
                    <div class="col-lg-9">
                                <div class="form-group"> 
                               
                              <div class="col-lg-3">
                              
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[a]?>">
                                  </div>
                               </div>
                               
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgsd" id="tgsd" value="<?php echo $_GET[b]?>">
                                  </div>
                                  
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(tg.value,tgsd.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table id="example5" class="tableku datatable-basic " >
                        <thead>
                            <tr>
                              <th colspan="7" style="text-align:center" ><h5>LAPORAN REKAPITULASI PEMBELIAN <?php if($_GET['jenis']==3){echo "SEMEN";}elseif($_GET['jenis']==1){echo "NON SEMEN";}?><br>PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                              <th width="10%">Cabang</th>
                                <th width="10%">No PO</th>
                                <th width="5%">Tgl</th>
                                <th width="10%">Supplier</th>
                              	<th width="10%">Shipto</th>
                                <th width="10%">Jumlah</th>  
                          </tr> 
                      </thead>
                      <tfoot>
                      <tr>
                             <td colspan="5"></td>
                              <td align="right">
                              <!--<input type="" name="hiu" id="hiu"  value="0"  class="form-control chiu" required>--> 
                              <span id="hiu"></span>
                              </td>
                           </tr> 
                      </tfoot>
                       </table>    
                     
  			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"   value=""  required>
            <input type="hidden" name="hiu2" id="hiu2"  value="0"  required>
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

