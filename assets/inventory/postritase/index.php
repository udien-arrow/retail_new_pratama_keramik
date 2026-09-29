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
    white-space:nowrap
}
</style>

  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		 
           <div class="panel panel-flat">
					<div class="panel-heading noprint" >
						<h5 class="panel-title"><?=$title?>
                        </h5>
                        <div class="heading-elements noprint">
							<ul class="icons-list">
		                		<?php 
						  $a=explode('/',$_GET['tgl']);
						  $gg=$a[2]."-".$a[0]."-".$a[1];
						  $b=explode("/",$_GET['b']);
						  $wp=$b[2]."-".$b[0]."-".$b[1];
							?>
		                		<!--<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>-->
                                <li><!--<a target="_blank" href="cetak.php?cab=<?=$_GET['cab']?>&a=<?=$gg?>&b=<?=$wp?>&jenis=<?=$_GET['jenis']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li><li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button>--></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
                     <form class="form-horizontal" action="index.php?x=postritase" name="formku" id="formku" method="post">
             <table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
                    <div class="col-lg-9">
                                <div class="form-group">     
                              <div class="col-lg-3">
                              
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[tgl]?>">
                                  </div>
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(tg.value)">
                               </div>
                               <div class="col-lg-2">
                               <a href='javascript:void(0)' onClick="posting('$gg')">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Posting">
                                </a>
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                        <thead>
                            <tr>
                              <th colspan="9" style="text-align:center" ><h5><?=strtoupper($title)?> <br>PERIODE <?php echo "$_GET[tgl]"; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="5%">No</th>
                                <th width="30%">Tanggal</th>
                                <th width="30%">Nama Supir</th>
                              	<th width="20%">Jenis Kendaraan</th>
                                <th width="10%">Jumlah</th> 
                                <th  width="10px" align="center" class="tables"><strong><input type="checkbox" name="select-all" id="select-all" /></strong></th> 
                          </tr> 
                      </thead>
                      <?php 
					  $no=1;
					  $c=$db->select("tx_sales_biaya_dtl a
JOIN tx_sales_biaya b ON a.no_sb = b.no_sb","*","a.id_cus<>'' and b.tgl='$gg' group by b.tgl,a.id_cus");
foreach($c as $head){
	
	$s=$db->select("tx_sales_biaya_dtl a
JOIN tx_sales_biaya b ON a.no_sb = b.no_sb
JOIN m_kendaraan c ON a.nopol = c.nopol
join m_jenis_kendaraan d on c.id_jenis=d.id_jenis
join m_pegawai e on a.id_supir=e.id_pegawai","d.nama,
a.id_cus,
a.id_supir,
a.no_so,
b.tgl,
c.id_jenis,
a.no_sb,
e.nama_pegawai,
e.id_cabang,
count(c.id_jenis)as wp
","a.id_cus<>'' and tgl='$head[tgl]' and id_supir='$head[id_supir]' and e.id_cabang='$_SESSION[ID_CABANG]'
");
foreach($s as $wk){}
if($wk['wp']>=2){
$ck=$db->select("tx_posting_ritase","*","id_supir='$wk[id_supir]' and tgl='$wk[tgl]' and jenis_kendaraan='$wk[id_jenis]'");
foreach($ck as $cek){}
if($cek['id_supir']==$wk['id_supir'] && $cek['tgl']==$wk['tgl'] && $cek['jenis_kendaraan']==$wk['id_jenis'])
{
	$ff="";
}else{
	$ff="<input type='checkbox' class='control-primary' name='app[]' id='app[]' value='<?=$no?>'>";};
					   ?>
                      <tr>
                      <td><?=$no?></td>
                      <td><?=$wk['tgl']?><input type="hidden" name="tglk[]" value="<?=$wk['tgl']?>"></td>
                      <td><?=$wk['nama_pegawai']?><input type="hidden" name="id_supir[]" value="<?=$wk['id_supir']?>"></td>
                      <td><?=$wk['nama']?><input type="hidden" name="jenis_ken[]" value="<?=$wk['id_jenis']?>"></td>
                      <td><?=$wk['wp'];?><input type="hidden" name="tota[]" value="<?=$wk['wp']?>"></td>
                      <td align="center" class="tables">
                      <?=$ff?>
                      </td>
                      </tr>
                      <?php $no++; } } ?>
                      <tfoot>
                      <tr>
                             <td colspan="4"></td>
                             <td align="right">&nbsp;</td>
                              <td align="right">
                              <!--<input type="" name="hiu" id="hiu"  value="0"  class="form-control chiu" required>--> 
                              
                              </td>
                           </tr> 
                      </tfoot>
                       </table>    
                     
  			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"   value=""  required>
            <input type="hidden" name="val" id="val"   value=""  required>
            <input type="hidden" name="hiu2" id="hiu2"  value="0"  required>
            <input type="hidden" name="tglr" id="tglr"  value="<?=$_GET['tgl']?>"  required>
   		  </div>
		</div>
</form>
<?php
if($_POST['val']=='ok'){
	$id=$db->idurut("tx_posting_ritase","id");
	foreach($_POST['app'] as $key => $val){
		if($val!=""){
			if($_POST['tota'][$key]=='2'){
			$dp="25000";	
			}elseif($_POST['tota'][$key]>'2'){
			$dp="30000";	
			}
		$data = array( 
						'id' => $id,
						'id_user' => $_SESSION['ID_LOGIN'],
						'id_supir' => $_POST['id_supir'][$key],
						'tgl' => $_POST['tglk'][$key],
						'jumlah' => $_POST['tota'][$key],
						'insentif' => $dp,
						'jenis_kendaraan' => $_POST['jenis_ken'][$key],
						);
	$db->insert("tx_posting_ritase",$data);
		}
		}
		
		echo "<script>window.location='index.php?x=postritase&tgl=$_POST[tglr]'</script>";
}
?>        
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

