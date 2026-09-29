    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
    <div class="col-lg-6">
		<form action="index.php?x=pricel_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></li>
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Transaksi" onClick="window.location='index.php?x=pembsupp'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="20%">No</th>
                              	<th width="50%">Supplier</th>
                                <th width="20%">Tgl</th>
                                <th width="1%">#</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil</h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                		<?php
                                foreach($supp=$db->select("tx_order_tagihan_bayar","sum(dibayar-selisih)dibay,no_ps","no_pt='$_GET[id]' group by no_ps")as $bay){
									$gb=$_GET['id'].'-'.$bay['no_ps'];
								?>
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="<?=$bay['no_ps']?>" onClick="pindah('<?=$gb?>')"></button></li>
                               
                                <?php 
								}
								?>
							</ul>
                            </div>
                        
					</div>
                    <div class="dataTables_wrapper"></div>
                    
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Jurnal</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                  
                                </div>
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Billing</strong></td>
                                <td align="center"><strong>Spj</strong></td>
                                <td align="center"><strong>Total</strong></td>
                                <td align="center"><strong>Dibayar Logistik</strong></td>
                                <td align="center"><strong>+/-</strong></td>
                                <td align="center"><strong>Sudah Dibayar</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_order_tagihan a
JOIN tx_order_tagihan_dtl b ON a.no_pt = b.no_pt","b.*,b.dibayar","a.no_pt='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								foreach($supp=$db->select("tx_order_tagihan_bayar","sum(dibayar)dibay","no_pt='$_GET[id]' and id_bill_dtl='$valsupp[id_bill_dtl]' and status='1'")as $bay);  
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="left"><?=$valsupp['no_billing']?></td>
                                <td align="center"><?=$valsupp['no_spj']?></td>
                                <td align="right"><?=number_format($valsupp['total_bil'],2)?></td>
                                <td align="right"><?=number_format($valsupp['dibayar'],2)?></td>
                                <td align="right"><?=number_format($valsupp['kurang_lebih'],2)?></td>
                                <td align="right"><?=number_format($bay['dibay'],2)?></td>
                                </tr>
                                <?php $no++; 
								$tdeb+=$valsupp['total_bil'];
								$tkre+=$valsupp['dibayar'];
								$by+=$bay['dibay'];
								} ?>
                                <tr>
                                <td colspan="3" align="right"><b>Total</b></td>
                                <td align="right"><b><?=number_format($tdeb,2)?></b></td>
                                <td align="right"><b><?=number_format($tkre,2)?></b></td>
                                <td align="right">&nbsp;</td>
                                <td align="right"><b><?=number_format($by,2)?></b></td>
                                </tr>
                                </table>
                                <?php
								//$kj=$db->select("tx_order_tagihan_min","sum(dibayar)dibayar","no_pt='$_GET[id]'");
								//foreach($kj as $jk){}
								 ?>
                                <h4>
                                Total : <?=number_format($tdeb)?><br>
                                Dibayar : <?=number_format($tkre)?><br>
                                Lebih/Kurang : <?=number_format($tkre-$tdeb)?></h4> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
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

