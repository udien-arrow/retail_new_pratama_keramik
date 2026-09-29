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
                $awald="sum(ifnull(debet,0)+".substr($ad,0,-1).")";
                $awalk="sum(ifnull(kredit,0)+".substr($ak,0,-1).")";
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
                        Laporan <?=$title?>
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
                               <div class="form-group">
                               <div class="col-lg-3">
                               		<select name="cabang" id="cabang" class="select">
                                     <option value="">Pilih Cabang</option>
                                     <option value="A">Semua Cabang</option>
									 <?php
									$cab=$db->select("m_cabang","*");
									
								 foreach($cab as $caba){
									  ?>
                                      <option value="<?=$caba['id_cabang']?>"> <?=$caba['nama_cabang']?></option>
                                      
                                      <?php
									  }
								  ?>
                                   </select>
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(bulan.value,tahun.value,cabang.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table width="100%" class="table-columned" id="example5" >
                        <thead>
                            <tr>
                              <th colspan="8" style="text-align:center" ><h5>LAPORAN NERACA SALDO <?php echo"$_SESSION[NAMA_PERUSAHAAN]";?> <br>PERIODE <?php echo strtoupper($db->bulanh($_GET[bulan]))." $_GET[tahun]"; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="10%" rowspan="2">COA</th>
                                <th width="30%" rowspan="2">Urian</th>
                              	<th width="15%" rowspan="2">Bulan Lalu</th>
                                <th colspan="2">Mutasi</th>
                                <th width="25%" rowspan="2">Saldo Akhir</th>
                                
                          </tr>
                          <tr>
                             <td width="15%" align="center"><strong>Debet</strong></td>
                             <td width="15%" align="center"><strong>Kredit</strong></td>
                          </tr>  
                      </thead>
                      <tbody>
                      
                      <?php
					  		if($_GET[cab]=="A"){$cab="";}else{$cab="WHERE b.CABANG='$_GET[cab]'";}
							$tbl="ak_acc a LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]' 
														 JOIN ak_acc_group d ON d.id_group=a.type
														 $cab group by account
													";
							$f="a.account,a.description as desk, 
								($awald) as DAWAL, 
								($awalk) as KAWAL, 
								SUM($mutd) as mutd, 
								SUM($mutk) as mutk,
								d.`status` as st ";						
							//echo"select $f from $tbl";
							$sa=$db->select($tbl,$f);
							foreach($sa as $sa1){
								if($sa1['st']=="D"){
									$sa=$sa1['DAWAL']-$sa1['KAWAL'];
									$so=($sa+$sa1['mutd'])-$sa1['mutk'];
									} else {
										$sa=$sa1['KAWAL']-$sa1['DAWAL'];
										$so=($sa+$sa1['mutk'])-$sa1['mutd'];
										
										}
                     	?>
                      	<tr>
                             <td><?=$sa1[account]?></td>
                             <td><?=$sa1[desk]?></td>
                             <td align="right"><?=number_format($sa)?></td>
                             <td align="right"><?=number_format($sa1[mutd])?></td>
                             <td align="right"><?=number_format($sa1[mutk])?></td>
                             <td align="right"><?=number_format($so)?>&nbsp;</td>
                        </tr> 
                         
                        <?php
							$msa+=$sa;
							$mmutd+=$sa1[mutd];
							$mmutk+=$sa1[mutk];
							$mso+=$so;
						}
						
						?>
                        </tbody>
                        <tfoot>
                        <tr>
                             <td></td>
                             <td><strong>Total</strong></td>
                             <td align="right"><strong>
                             <?=number_format($msa)?>
                             </strong></td>
                             <td align="right"><strong>
                             <?=number_format($mmutd)?>
                             </strong></td>
                             <td align="right"><strong>
                             <?=number_format($mmutk)?>
                             </strong></td>
                             <td align="right"><strong>
                             <?=number_format($mso)?>
                             &nbsp;</strong></td>
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

