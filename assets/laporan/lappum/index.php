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
<?php
if($_GET['bulan']==1){
            $awalk="kredit";
            $awald="debet";
            $mutd="D1";
            $mutk="K1";
            }else{
                for($i=1;$i<$_GET['bulan'];$i++){
                    $ad.="D".$i."+";
                    $ak.="K".$i."+";
                    }
                $awald="(debet+".substr($ad,0,-1).")";
                $awalk="(kredit+".substr($ak,0,-1).")";
                $mutd="D".$i;
                $mutk="K".$i;
                }

?>
  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		 
           <div class="panel panel-flat">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        Laporan Jurnal Umum <?php echo"$_SESSION[NAMA_PERUSAHAAN]";?>
                      </h5>
                        <div class="heading-elements noprint">
							<ul class="icons-list">
		                		<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>
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
                              	  <select name="cab" id="cab" class="select-search">
                                  <option value="all">---Cabang---</option>
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
                                  <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>

                                  <input class="form-control datepicker1" name="tgl1" id="tgl1"  value="<?=$_GET['d1']?>"/>
                                  </div>
                               </div>
                               
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                   <input class="form-control datepicker1" name="tgl2" id="tgl2" value="<?=$_GET['d2']?>" />

                                 </div>
                                  
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(tgl1.value,tgl2.value,cab.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table width="100%" class="table-columned" id="example5" >
                        <thead>
                            <tr>
                              <th colspan="7" style="text-align:center" ><h5>LAPORAN PENGGUNAAN UANG MUKA  
                              					<br>PERIODE <br /><?php echo date("d/m/Y", strtotime($_GET[d1]))." s.d. ".date("d/m/Y",strtotime($_GET[d2])).""; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                              <th width="5%" rowspan="2">No.</th>
                              <th width="15%" rowspan="2">No. UM</th>
                              <th width="15%" rowspan="2">Pengguna</th>
                              <th width="25%" rowspan="2">Keperluan</th>
                              <th width="15%" rowspan="2">Tgl. Pengajuan</th>
                              <th width="15%" rowspan="2">Status</th>
                              <th width="10%" rowspan="2">Total</th>
                              
                              <!--<th width="30%" rowspan="2">Uraian</th>

                              <th colspan="2">Mutasi</th>-->

                                
                          </tr>
                          <!--<tr>
                             <td width="15%" align="center"><strong>Debet</strong></td>
                             <td width="15%" align="center"><strong>Kredit</strong></td>
                          </tr> -->
                      </thead>
                      <tbody>
                      
                      <?php
							if(!empty($_GET[d1]) OR !empty($_GET[d2])){
							$tbl="ak_pum a
									LEFT JOIN m_cabang c ON a.CABANG = c.id_cabang
									LEFT JOIN r_user_login d ON a.USERID = d.ID";
							$f="a.ID as id,
								a.CABANG as id_cabang,
								a.NO_PUM AS no_pum,
								d.KETERANGAN AS nama_user,
								a.CATATAN AS keperluan,
								a.TANGGAL AS tanggal,
								a.`STATUS` as `status`,
								a.TOTAL AS total";	
							if($_GET['cab']=="all"){
							$wh="date(a.TANGGAL) between '$_GET[d1]' AND '$_GET[d2]'";
							}else{
							$wh="date(a.TANGGAL) between '$_GET[d1]' AND '$_GET[d2]' and a.CABANG='$_GET[cab]'";	
							}
							}
							$sa=$db->select($tbl,$f,$wh);
							$no = 1;
							foreach($sa as $sa1){
								//$no = 1;
                     	?>
                      	<tr>
                      	  	 <td><?=$no?></td>
                             <!--<td><?=$sa1[id_cabang]?></td>-->
                             <td><?=$sa1[no_pum]?></td>
                             <td><?=$sa1[nama_user]?></td>
                             <td><?=$sa1[keperluan]?></td>
                             <td><?=$sa1[tanggal]?></td>                             
                             <td><?php if($sa1['status']==0){
							 			 echo "<span style='background-color:red; color:white; text-align: center;'>Pengajuan</span>";
										} else if($sa1['status']==1){
										 echo "<span style='background-color:blue; color:white; text-align:center'>Approve</span>";
										} else {
										 echo "<span style='background-color:green; color:white; text-align: center;'>Sudah di Cairkan</span>";
										}
							 
							 	 ?>
                             </td>
                             <!--<td><?=$sa1[KET_DTL]?></td>-->
                             <td align="right"><?=number_format($sa1[total],2)?></td>
                             <!--<td align="right"><?=number_format($sa1[kredit],2)?></td>-->

                        </tr> 
                         
                        <?php
							$d+=$sa1[total];
							//$k+=$sa1[kredit];
							$no++;
						}
						
						?>
                        </tbody>
                        <tfoot>
                        <tr>
                          
                             
                             <td colspan="6" align="right"><strong>Total</strong><strong></strong></td>
                             <td align="right"><strong><?=number_format($d,2)?>&nbsp;</strong></td>
                             <!--<td align="right"><strong>
                             <?=number_format($k,2)?>
                             </strong>
                             </td>-->

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

