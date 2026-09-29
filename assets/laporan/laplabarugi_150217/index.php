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
if($_GET[cab]=="A"){
	$b="";
	} else {
		$b="AND b.CABANG='$_GET[cab]'";
		
		}				

?>
  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		 
           <div class="panel panel-flat">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        Laporan Laba Rugi
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
                              <th colspan="8" style="text-align:center" ><h5>LAPORAN LABA RUGI <br>PERIODE <?php echo $db->bulanh($_GET[bulan])." s/d $_GET[tahun]"; ?></h5></th>
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
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '4' AND '6' AND substr(akun1,1,3)='300' group by akun1","*");
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
						
                      	$as3=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun3=b.account AND akun2='$ak2[akun2]' group by a.akun3","*");
						foreach($as3 as $ak3){
						?>
                      	<tr>
                             <td><?=$ak3[akun3]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak3[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>	
						
						<?php
						
						$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]'","*");
						foreach($as4 as $ak4){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak4[account]',1,3) $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							
							foreach($sa as $sa1){
								if($sa1[status]=="K"){
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
									
								} else {
									
									
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								}
								
								}
							
                     	?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ak4[description]?></td>
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
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
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
                          <?=$db->minus($m1sa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1mut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1so)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
							
							$tpsa=$m1sa;
							$tpmut=$m1mut;
							$tpso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}	
							
						}
						?>
                        <!--- pindah halaman -->
                        <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '4' AND '6' AND substr(akun1,1,3)='400' group by akun1","*");
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
						
                      	$as3=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun3=b.account AND akun2='$ak2[akun2]' group by a.akun3","*");
						foreach($as3 as $ak3){
						?>
                      	<tr>
                             <td><?=$ak3[akun3]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak3[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
						$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]'","*");
						foreach($as4 as $ak4){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak4[account]',1,3) $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							
							foreach($sa as $sa1){
								if($sa1[status]=="K"){
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
									
								} else {
									
									
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								}
								
								}
							
                     	?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ak4[description]?></td>
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
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
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
                          <?=$db->minus($m1sa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1mut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1so)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        
                        <?php
							$thppsa=$m1sa;
							$thppmut=$m1mut;
							$thppso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						
						}
						$grossconsa=$tpsa-$thppsa;
						$grossconmut=$tpmut-$thppmut;
						$grossconso=$tpso-$thppso;
						?>
                        <tr>
                          <td></td>
                          <td><strong>Gross Contribution</strong></td>
                          <td align="right"><strong><?=$db->minus($grossconsa)?>&nbsp;</strong></td>
                          <td align="right"><strong><?=$db->minus($grossconmut)?>&nbsp;</strong></td>
                          <td align="right"><strong><?=$db->minus($grossconso)?>&nbsp;</strong></td>
                          <td align="right">&nbsp;</td>
                        </tr>
                       	<!--- pindah halaman -->
                        <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '4' AND '6' AND substr(akun1,1,3)='500' group by akun1","*");
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
						
                      	$as2=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun2=b.account AND akun1='$ak1[akun1]' AND  substr(akun2,1,3) BETWEEN '510' AND '520' group by a.akun2","*");
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
						
                      	$as3=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun3=b.account AND akun2='$ak2[akun2]' group by a.akun3","*");
						foreach($as3 as $ak3){
						?>
                      	<tr>
                             <td><?=$ak3[akun3]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak3[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
						$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]'","*");
						foreach($as4 as $ak4){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak4[account]',1,3) $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							
							foreach($sa as $sa1){
								if($sa1[status]=="K"){
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
									
								} else {
									
									
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								}
								
							}
							
                     	?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ak4[description]?></td>
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
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
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
							$lkotorsa=$grossconsa-$m1sa;
							$lkotormut=$grossconmut-$m1mut;
							$lkotorso=$grossconso-$m1so;
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laba Kotor </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($grossconsa-$m1sa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($grossconmut-$m1mut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($grossconso-$m1so)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        
                        <?php
							$thppsa=$m1sa;
							$thppmut=$m1mut;
							$thppso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						
						}
						?>
                        <!--- pindah halaman -->
                        <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '4' AND '6' AND substr(akun1,1,3)='500' group by akun1","*");
						foreach($as as $ak1){
                      ?>
                      	<!-- <tr>
                             <td><?=$ak1[akun1]?></td>
                             <td><?=$ak1[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>  -->
                        <?php
						
                      	$as2=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun2=b.account AND akun1='$ak1[akun1]' AND  substr(akun2,1,3) BETWEEN '530' AND '530' group by a.akun2","*");
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
						foreach($as3 as $ak3){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak3[account]',1,3) $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							
							foreach($sa as $sa1){
								if($sa1[status]=="K"){
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
									
								} else {
									
									
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								}
								
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
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak2[description]?>
                             </strong></td>
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
							$lusahasa=$lkotorsa-$m1sa;
							$lusahamut=$lkotormut-$m1mut;
							$lusahaso=$lkotorso-$m1so;
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laba Usaha</strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lkotorsa-$m1sa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lkotormut-$m1mut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lkotorso-$m1so)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        
                        <?php
							$thppsa=$m1sa;
							$thppmut=$m1mut;
							$thppso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
							
						}
						?> 
                        
                        <!--- pindah halaman -->
                        <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '4' AND '6' AND substr(akun1,1,3)='600' group by akun1","*");
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
						
                      	$as3=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun3=b.account AND akun2='$ak2[akun2]' group by a.akun3","*");
						foreach($as3 as $ak3){
						?>
                      	<tr>
                             <td><?=$ak3[akun3]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak3[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
						$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]'","*");
						foreach($as4 as $ak4){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak4[account]',1,3) $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							
							foreach($sa as $sa1){
								if($sa1[status]=="K"){
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
									
								} else {
									
									
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								}
								
							}
							
                     	?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ak4[description]?></td>
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
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
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
                          <?=$db->minus($m1sa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1mut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1so)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        
                        <?php
							$tpblainsa=$m1sa;
							$tpblainmut=$m1mut;
							$tpblainso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						
						}
						$tebitsa=$lusahasa+$tpblainsa;
						$tebitmut=$lusahamut+$tpblainmut;
						$tebitso=$lusahaso+$tpblainso;
						?> 
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laba Sebelum Bunga dan Pajak</strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lusahasa+$tpblainsa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lusahamut+$tpblainmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lusahaso+$tpblainso)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <!--- pindah halaman -->
                        <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '4' AND '6' AND substr(akun1,1,3)='700' group by akun1","*");
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
						foreach($as3 as $ak3){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak3[account]',1,3) $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							
							foreach($sa as $sa1){
								if($sa1[status]=="K"){
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
									
								} else {
									
									
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								}
								
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
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak2[description]?>
                             </strong></td>
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
                          <?=$db->minus($m1sa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1mut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1so)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        
                        <?php
							$tbbungasa=$m1sa;
							$tbbungamut=$m1mut;
							$tbbungaso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
							
						}
							$tebtsa=$tebitsa-$tbbungasa;
							$tebtmut=$tebitmut-$tbbungamut;
							$tebtso=$tebitso-$tbbungaso;
						?>
						<tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laba Sebelum Pajak (EBT)</strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tebtsa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tebtmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tebtso)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                       <!--- pindah halaman -->
                        <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '4' AND '6' AND substr(akun1,1,3)='800' group by akun1","*");
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
						foreach($as3 as $ak3){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak3[account]',1,3) $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							
							foreach($sa as $sa1){
								if($sa1[status]=="K"){
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
									
								} else {
									
									
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								}
								
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
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak2[description]?>
                             </strong></td>
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
                          <?=$db->minus($m1sa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1mut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1so)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        
                        <?php
							$ttpajaksa=$m1sa;
							$ttpajakmut=$m1mut;
							$ttpajakso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
							
						}
							$teatsa=$tebtsa-$ttpajaksa;
							$teatmut=$tebtmut-$ttpajakmut;
							$teatso=$tebtso-$ttpajakso;
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laba Setalah Pajak (EAT)</strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($teatsa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($teatmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($teatso)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <!--- pindah halaman -->
                        <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '4' AND '6' AND substr(akun1,1,3)='900' group by akun1","*");
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
						
                      	$as2=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun2=b.account AND akun1='$ak1[akun1]' AND substr(akun2,1,3) between '910' and '920' group by a.akun2","*");
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
						foreach($as3 as $ak3){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND substr(a.account,1,3)= substr('$ak3[account]',1,3) $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							
							foreach($sa as $sa1){
								if($sa1[status]=="K"){
									$awal=$sa1[KAWAL]-$sa1[DAWAL];
									$mut=$sa1[mutk]-$sa1[mutd];
									$akhir=$awal+$mut;
									$t="K";
									
								} else {
									
									
									$awal=$sa1[DAWAL]-$sa1[KAWAL];
									$mut=$sa1[mutd]-$sa1[mutk];
									$akhir=$awal+$mut;
									$t="D";
								}
								
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
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak2[description]?>
                             </strong></td>
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
                          <?=$db->minus($m1sa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1mut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($m1so)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        
                        <?php
							$tpkomsa=$m1sa;
							$tpkommut=$m1mut;
							$tpkomso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
							
						}
							$tpkomlsa=$teatsa-$tpkomsa;
							$tpkomlmut=$teatmut-$tpkommut;
							$tpkomlso=$teatso-$tpkomso;
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laba Komperehensif Bulan Berjalan</strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tpkomlsa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tpkomlmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tpkomlso)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
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

