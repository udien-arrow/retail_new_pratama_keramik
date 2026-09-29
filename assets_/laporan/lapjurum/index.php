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

  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
           <div class="panel panel-flat">
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
                                <li><a target="_blank" href="../../../../../../waruabadi/assets/laporan/lapkasbank/cetak.php?cab=<?=$_GET['cab']?>&a=<?=$gg?>&b=<?=$wp?>&jenis=<?=$_GET['jenis']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table width="100%"  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
                    <div class="col-lg-9">
                                <div class="form-group">     
                              	<div class="col-lg-3">
                              	  <select name="cab" id="cab" class="select-search" onchange="pindahData3(cab.value)">
                                  <option value="">---Cabang---</option>
                                  <?php
								  			if($_SESSION['ID_CABANG']==0 OR $_SESSION['ID_CABANG']==99){
												$query=$db->select("m_cabang","id_cabang,nama_cabang","status='1'");
												} else {
													$query=$db->select("m_cabang","id_cabang,nama_cabang","status='1' AND id_cabang='$_SESSION[ID_CABANG]'");
												}
											foreach($query as $sel){	
			                            ?>
                                  <option value="<?=$sel['id_cabang']?>" <?php if($sel['id_cabang']==$_GET['cab']){echo "selected";}?>>
                                    <?=$sel['nama_cabang']?>
                                  </option>
                                  <?php }?>
                                </select>
                               </div>
                               <!--<div class="col-lg-2">
                              	  <select name="jenis" id="jenis" class="select-search">
                                  <option value="KM" <?php if($_GET['jenis']=='KM'){echo "selected";}?>>Kas Masuk</option>
                                  <option value="BM" <?php if($_GET['jenis']=='BM'){echo "selected";}?>>Bank Masuk</option>
                                  <option value="KK" <?php if($_GET['jenis']=='KK'){echo "selected";}?>>Kas keluar</option>
                                  <option value="BK" <?php if($_GET['jenis']=='BK'){echo "selected";}?>>Bank keluar</option>
                                  </select>
                               </div>-->
                               <div class="col-lg-3">
                              	  <select name="gud" id="gud" class="select-search">
                                  <option value="">---Gudang---</option>
                                  <?php
								  			if($_SESSION['ID_CABANG']==0 OR $_SESSION['ID_CABANG']==99){
												$query=$db->select("m_gudang","id_gudang,nama_gudang","status='1'");
												/*} else if($_SESSION['ID_CABANG']!="") {
													$query=$db->select("m_gudang","id_gudang,nama_gudang","status='1' id_cabang = $_SESSION[ID_CABANG]");*/
												} else {
													$query=$db->select("m_gudang","id_gudang,nama_gudang","status='1' AND id_cabang = $_GET[cab]");
												}
											foreach($query as $sel){
											?>
                                      <option value="<?=$sel['id_gudang']?>" <?php if($sel['id_gudang']==$_GET['gud']){echo "selected";}?>>
                                        <?=$sel['nama_gudang']?>
                                      </option>
                                  <?php }?>
                                </select>
                               </div>
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
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(<?=$_GET[cab]?>,tg.value,tgsd.value,gud.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table class="tableku" >
                        <thead>
                            <tr>
                              <th colspan="9" style="text-align:center" ><h5> 
							  LAPORAN KAS/BANK  <?php 
							  if($_GET['jenis']=='KM'){
								  echo "KAS MASUK";
							  }elseif($_GET['jenis']=='BM'){
								  echo "BANK MASUK";
							  }elseif($_GET['jenis']=='KK'){
								  echo "KAS KELUAR";
							  }elseif($_GET['jenis']=='BK'){
								  echo "BANK KELUAR";
							  }
							  foreach($db->select("m_gudang","nama_gudang","id_gudang='$_GET[gud]'")as $cb1); echo $cb1['nama_gudang'];
							  ?> CABANG <?php foreach($db->select("m_cabang","nama_cabang","id_cabang='$_GET[cab]'")as $cb); echo $cb['nama_cabang'];?><br>PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            
                            <tr height="30px" bgcolor="#EFEFEF">
                              	<th width="15%" rowspan="2">No Jurnal</th>
                              	<th width="15%" rowspan="2">No Reff</th>
                                <th width="10%" rowspan="2">Tgl</th>
                              	<th width="15%" rowspan="2">Deskripsi</th>
                                <th width="20%" colspan="2">Mutasi</th>
                                <td width="5%" rowspan="2">&nbsp;</td>
                          </tr>
                          <tr>
                             <td width="10%" align="center"><strong>Debet</strong></td>
                             <td width="10%" align="center"><strong>Kredit</strong></td>
                             
                          </tr>  
                       </thead>
                       <tbody>
                         <?php 
						 $aa=date("Y-m-d",strtotime($_GET['a']));
						 $bb=date("Y-m-d",strtotime($_GET['b']));
						 /*if($_GET['jenis']=='KM' || $_GET['jenis']=='BM'){
							 $dat=$db->select("ak_kas_masuk a
												JOIN m_cabang b ON a.id_cab = b.id_cabang
												JOIN ak_jurnal c ON a.IDKM = c.IDKM
												JOIN ak_jurnal_dtl e on c.NO_JURNAL=e.NO_JURNAL
												JOIN ak_paruskas d ON e.TYPE_ARUSKAS = d.id_param","a.*,a.idkm as id,b.nama_cabang,d.nama","e.ID_CAB='$_GET[cab]' and substr(a.IDKM,1,2)='$_GET[jenis]' and a.tgl_tran between '$aa' AND '$bb'");
						 }elseif($_GET['jenis']=='KK' || $_GET['jenis']=='BK'){
							 $dat=$db->select("ak_kas_keluar a
												JOIN m_cabang b ON a.id_cabang = b.id_cabang
												JOIN ak_jurnal c ON a.IDKK = c.IDKM
												JOIN ak_jurnal_dtl e on c.NO_JURNAL=e.NO_JURNAL
												JOIN ak_paruskas d ON e.TYPE_ARUSKAS = d.id_param","a.*,a.idkk as id,b.nama_cabang,d.nama","e.ID_CAB='$_GET[cab]' and substr(IDKK,1,2)='$_GET[jenis]' and a.tgl_tran between '$aa' AND '$bb'"); 
						 }*/
						 	$tbl="ak_jurnal a
									JOIN ak_jurnal_dtl b ON a.NO_JURNAL = b.NO_JURNAL
									LEFT JOIN ak_acc c ON c.account = b.acc_code
									LEFT JOIN m_cabang d ON b.ID_CAB = d.id_cabang";
							$f="a.IDKM,
								d.id_cabang,
								b.no_jurnal,
								b.tgl_jurnal,
								b.KET_DTL,
								a.debet,
								a.kredit";
						 	$wh="date(a.tgl_jurnal) between '$aa' AND '$bb' and d.id_cabang='$_GET[cab]' AND SUBSTRING_INDEX(b.NO_JURNAL,'/',1) = 'JU' GROUP BY b.NO_JURNAL";
						 $dat=$db->select($tbl,$f,$wh);
						 $no=1;
						 foreach($dat as $dat2){
						 ?>
                          <tr>
                              <!--<td align="center"><?=$no?></td>-->
                              <td align="left"><?=$dat2['no_jurnal']?></td>
                              <td align="left"><?=$dat2['IDKM']?></td>
                              <td align="left"><?=date("d-m-Y",strtotime($dat2['TGL_JURNAL']))?></td>
                              <td align="left"><?=$dat2['KET_DTL']?></td>                              
                              <td align="right"><?=number_format($dat2['debet'],2)?></td>
                              <td align="right"><?=number_format($dat2['kredit'],2)?></td>
                              
                              <?php
                              /*if($_GET['jenis']=='KM'){
									$page="v_kasmasuk";  
							  }
							  if($_GET['jenis']=='BM'){
									$page="v_bankmasuk";  
							  }
							  if($_GET['jenis']=='KK'){
									$page="v_kaskeluar";  
							  }
							  if($_GET['jenis']=='BK'){
									$page="v_bankkeluar";  
							  }*/
							  $no++;
							  $d+=$dat2['debet'];
							  $k+=$dat2['kredit'];
						 	
							  ?>
                              <td align="center">
                              	<a target="_blank" href="cetak.php?&page=<?=$page?>&id=<?=$dat2['no_jurnal']?>&cab=<?=$dat2['id_cabang']?>&a=<?=$_GET['a']?>&b=<?=$_GET['b']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a>
                              <!-- <a target="_blank" href="cetak.php?&page=<?=$page?>&id=<?=$dat2['id']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Void"></button></a> -->
                              </td>
                               <?php
						  }
						  ?>
                          </tr>
                          </tbody>
                      <tfoot>
                        <tr>
                          
                             <td colspan="4" align="right"><strong>Total</strong></td>
                             <td align="right"><strong><?=number_format($d,2)?></strong></td>
                             <td align="right"><strong><?=number_format($k,2)?></strong></td>

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

