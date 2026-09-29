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
                        Laporan Stok Opname
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
								  
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>

                                  <select name="bulan" id="bulan" class="select">
                                  	<option value="">Pilih Periode Bulan</option>
                                  <?php

								  for($i=1;$i<=12;$i++){
									  echo"<option value=\"$i\">". $db->bulanh($i) ."</option>";
									  
									  }
								  ?>
                                  </select>
                                  </div>
                               </div>
                               
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                   <select name="tahun" id="tahun" class="select">
                                  	<option value="">Pilih Periode Tahun</option>
                                  <?php

								  for($i=2016;$i<=date("Y");$i++){
									  echo"<option value=\"$i\">". $i ."</option>";
									  
									  }
								  ?>
                                  </select>
                                  </div>
                                  
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(bulan.value,tahun.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table width="100%" class="table-columned" id="example5" >
                        <thead>
                            <tr>
                              <th colspan="8" style="text-align:center" ><h5>LAPORAN NERACA  <br>PERIODE <?php echo $db->bulanh($_GET[bulan])." s/d $_GET[tahun]"; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="10%">COA</th>
                                <th width="35%">Urian</th>
                              	<th width="20%">Bulan Lalu</th>
                                <th width="20%">Bulan Jalan</th>
                                <th width="20%">Saldo Akhir</th>
                                <th width="5%">%</th>
                                
                          </tr> 
                      </thead>
                      <tbody>
                      <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE (b.type BETWEEN '1' AND '4') group by akun1","*");
						foreach($as as $ak1){
                      ?>
                      	<tr>
                             <td><?=$ak1[akun1]?></td>
                             <td><?=$ak1[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                        <?php
						
                      	$as2=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun2=b.account AND akun1='$ak1[akun1]' group by a.akun2","*");
						foreach($as2 as $ak2){
                     	?>
                      	<tr>
                             <td><?=$ak2[akun2]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak2[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                         <?php
						
                      	$as3=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun3=b.account AND akun2='$ak2[akun2]'","*");
						//echo "select * from v_parent_akun a JOIN ak_acc b ON a.akun3=b.account AND akun2='$ak2[akun2]'";
						foreach($as3 as $ak3){
							//echo"<br>disini";
							
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type=d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak3[account]',1,3)";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk,
														   `status`
														   ";						
							
							$sa=$db->select($tbl,$f);
//							echo"select $f from $tbl<br>";
							
							foreach($sa as $sa1){
								if($sa1[status]=="D"){
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								} else {
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
								}
                     	?>
                      	<tr>
                             <td><?=$ak3[akun3]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ak3[description]?></td>
                             <td align="right"><?=number_format($awal)?></td>
                             <td align="right"><?=number_format($mut)?></td>
                             <td align="right"><?=number_format($akhir)?></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                         
                        <?php
							$msa+=$awal;
							$mmut+=$mut;
							$mso+=$akhir;
							}
						}
						?>
                      	<tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak2[description]?></strong></td>
                             <td align="right"><strong>
                             <?=number_format($msa)?>
                             </strong></td>
                             <td align="right"><strong>
                             <?=number_format($mmut)?>
                             </strong></td>
                             <td align="right"><strong>
                             <?=number_format($mso)?>
                             </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                        <?php
							$m1sa+=$msa;
							$m1mut+=$mmut;
							$m1so+=$mso;
							$msa=0;
							$mmut=0;
							$mso=0;
							
						}
						?>
                            <tr>
                              <td></td>
                                 <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak1[description]?></strong></td>
                                 <td align="right"><strong>
                                 <?=number_format($m1sa)?>
                                 </strong></td>
                                 <td align="right"><strong>
                                 <?=number_format($m1mut)?>
                                 </strong></td>
                                 <td align="right"><strong>
                                 <?=number_format($m1so)?>
                                 </strong></td>
                                 <td align="right">&nbsp;</td>
                            </tr> 
                        <?php
						}
						?>
                      </tbody>
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

