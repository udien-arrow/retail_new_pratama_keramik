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
                                
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Transaksi" onClick="window.location='index.php?x=pjk'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table  class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" id="example4" >
                        <thead>
                            <tr>
                                <th width="20%">No</th>
                              	<th width="30%">Pegawai</th>
                                <th width="10%">Cabang</th>
                                <th width="20%">Tgl</th>
                                <th width="1%">#</th>
                            </tr>
                        </thead>
                        <?php
                        $da=$db->select("ak_pjk_dtl a
JOIN r_user_login b ON a. USER = b.ID
JOIN m_pegawai c ON b.ID_PEGAWAI = c.id_pegawai
JOIN m_cabang d ON mid(a.NO_PUM, 4, 2) = d.kode_cabang
GROUP BY NO_PUM","a.*, c.nama_pegawai,
	mid(a.NO_PUM, 4, 2) kdc,d.nama_cabang");
	foreach($da as $dta){
						?>
						 <tr>
                              <th><?=$dta['NO_PUM']?></th>
                              <th><?=$dta['nama_pegawai']?></th>
                              <th><?=$dta['nama_cabang']?></th>
                              <th><?=date("d-m-Y",strtotime($dta['TGL']))?></th>
                              <th>
                              <ul class='icons-list'>
		 	<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=v_pjk&id=<?=$dta['NO_PJK'].'-'.$dta['NO_PUM']?>') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=pjk_v&id=<?=$dta['NO_PJK']?>' class=' icon-folder-open' style='cursor:pointer'></a></li>
			</ul>
                              </th>
                        </tr>
                        <?php }?>
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
						<h5 class="panel-title">View Detil 
                        <ul class="icons-list">
                        <li><input style="height:26px; line-height: 0;float:right" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('dtl')"></li>
                        </ul></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                  
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Jurnal</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                  
                                </div>
                                
                                <div class="form-group">
								<table width="100%" id="dtl" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Acc Code</strong></td>
                                <td align="center"><strong>Cabang</strong></td>
                                <td align="center"><strong>Keterangan</strong></td>
                                <td align="center"><strong>Debet</strong></td>
                                <td align="center"><strong>Kredit</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("ak_jurnal a
JOIN ak_jurnal_dtl b ON a.NO_JURNAL = b.NO_JURNAL
JOIN ak_acc c on b.ACC_CODE=c.account
JOIN m_cabang d on b.ID_CAB=d.id_cabang","b.*,c.description,d.nama_cabang","a.NO_JURNAL='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="left"><?=$valsupp['ACC_CODE']."-".$valsupp['description']?></td>
                                <td align="center"><?=$valsupp['nama_cabang']?></td>
                                <td align="center"><?=$valsupp['KET_DTL']?></td>
                                <td align="right"><?=number_format($valsupp['DEBET'],2)?></td>
                                <td align="right"><?=number_format($valsupp['KREDIT'],2)?></td>
                                </tr>
                                <?php $no++; 
								$tdeb+=$valsupp['DEBET'];
								$tkre+=$valsupp['KREDIT'];
								} ?>
                                <tr>
                                <td colspan="4" align="right"><b>Total</b></td>
                                <td align="right"><b><?=number_format($tdeb,2)?></b></td>
                                <td align="right"><b><?=number_format($tkre,2)?></b></td>
                                </tr>
                                </table> 
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

