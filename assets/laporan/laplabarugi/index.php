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
/*if($_GET['bulan']==1){
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
                }*/
if($_GET['bulan']==1){
            $awalk="ifnull(kredit,0)";
            $awald="ifnull(debet,0)";
            $mutd="ifnull(D1,0)";
            $mutk="ifnull(K1,0)";
            }else{
                for($i=1;$i<$_GET['bulan'];$i++){
                    $ad.="ifnull(D".$i.",0)+";
                    $ak.="ifnull(K".$i.",0)+";
                    }
                $awald="(ifnull(debet,0)+".substr($ad,0,-1).")";
                $awalk="(ifnull(kredit,0)+".substr($ak,0,-1).")";
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
                              <th colspan="8" style="text-align:center" ><h5>LAPORAN LABA RUGI <?php echo"$_SESSION[NAMA_PERUSAHAAN]";?> <br>PERIODE <?php echo $db->bulanh($_GET[bulan])." s/d $_GET[tahun]"; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="9%">COA</th>
                                <th width="44%">Urian</th>
                              	<th width="14%">Bulan Lalu</th>
                                <th width="14%">Bulan Jalan</th>
                                <th width="13%">Saldo Akhir</th>
                                <th width="6%">%</th>
                                
                          </tr> 
                      </thead>
                      <tbody>
                      
                        <?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '5' AND '6' AND substr(akun1,1,3)='300' group by akun1","*");

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
						
                      	$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak2[akun3]' group by a.akun4","*");
						foreach($as4 as $ak4){
						?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak4[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as5=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak2[akun4]' group by a.akun5","*");
						foreach($as5 as $ak5){
						?>
                      	<!-- <tr> 
                             <td><?=$ak5[akun5]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak5[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr> -->
                        <?php
						
						$as6=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun6=b.account AND akun5='$ak3[akun5]'","*");
						foreach($as6 as $ak6){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND a.account= '$ak6[account]' $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							//echo"select $f from $tbl<br><br>";
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
                             <td><?=$ak6[akun6]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ak6[description]?></td>
                             <td align="right"><?=$db->minus($awal)?></td>
                             <td align="right"><?=$db->minus($mut)?></td>
                             <td align="right"><?=$db->minus($akhir)?></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                         
                        <?php 
							$msa+=$awal;
							$mmut+=$mut;
							$mso+=$akhir;
							
							
							
						}}}
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($msa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mso)?>
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
						}}
						?>
                        <tr>
                          <td></td>
                             <td><strong>Total <?=$ak1[description]?></strong></td>
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
							$tpensa=$m1sa;
							$tpenmut=$m1mut;
							$tpenso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						
						
						?>
                       
                       	<!--- pindah halaman -->
                       	<?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '5' AND '6' AND substr(akun1,1,3)='400' group by akun1","*");

                      

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
						
                      	$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak2[akun3]' group by a.akun4","*");
						foreach($as4 as $ak4){
						?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak4[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as5=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak2[akun4]' group by a.akun5","*");
						foreach($as5 as $ak5){
						?>
                      	<!-- <tr> 
                             <td><?=$ak5[akun5]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak5[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr> -->
                        <?php
						
						$as6=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun6=b.account AND akun5='$ak3[akun5]'","*");
						foreach($as6 as $ak6){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND a.account= '$ak6[account]' $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							//echo"select $f from $tbl<br><br>";
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
                             <td><?=$ak6[akun6]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ak6[description]?></td>
                             <td align="right"><?=$db->minus($awal)?></td>
                             <td align="right"><?=$db->minus($mut)?></td>
                             <td align="right"><?=$db->minus($akhir)?></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                         
                        <?php 
							$msa+=$awal;
							$mmut+=$mut;
							$mso+=$akhir;
							
							
							
						}}}
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($msa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mso)?>
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
						}}
						?>
                        <tr>
                          <td></td>
                             <td><strong>Total <?=$ak1[description]?></strong></td>
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
							$tcpensa=$m1sa;
							$tcpenmut=$m1mut;
							$tcpenso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						
						
						?>
                       
                       	<!--- pindah halaman -->
                        
						<?php
                      	$as=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun1=b.account WHERE b.type between '5' AND '6' AND substr(akun1,1,3)='500' group by akun1","*");
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak2[description]))?></td>
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak3[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]' group by a.akun4","*");
						foreach($as4 as $ak4){
						?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak4[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as5=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5","*");
						foreach($as5 as $ak5){
						?>
                      	<!-- <tr>
                             <td><?=$ak5[akun5]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=$ak5[description]?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr> -->
                        <?php
						
						$as6=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun6=b.account AND akun5='$ak5[akun5]'","*");
						foreach($as6 as $ak6){
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND a.account= '$ak6[account]' $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							
							$sa=$db->select($tbl,$f);
							//echo"select $f from $tbl<br><br>";
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
                             <td><?=$ak6[akun6]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak6[description]))?></td>
                             <td align="right"><?=$db->minus($awal)?></td>
                             <td align="right"><?=$db->minus($mut)?></td>
                             <td align="right"><?=$db->minus($akhir)?></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                         
                        <?php 
							$msa+=$awal;
							$mmut+=$mut;
							$mso+=$akhir;
							
							
							
						}}}
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($msa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mso)?>
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
						}}
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
						$grossconsa=$tpensa-($tcpensa+$thppsa);
						$grossconmut=$tpenmut-($tcpenmut+$thppmut);
						$grossconso=$tpenso-($tcpenso+$thppso);
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak2[description]))?></td>
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak3[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]' group by a.akun4","*");
						foreach($as4 as $ak4){
						?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak4[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as5=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5","*");
						//echo"select * from v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5 <br>";
						foreach($as5 as $ak5){
							//echo"$ak5[account]<br>";
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND a.account= '$ak5[account]' $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							$sa=$db->select($tbl,$f);
							//echo"select $f from $tbl<br><br>";
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
                             <td><?=$ak5[akun5]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak5[description]))?></td>
                             <td align="right"><?=$db->minus($awal)?></td>
                             <td align="right"><?=$db->minus($mut)?></td>
                             <td align="right"><?=$db->minus($akhir)?></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                         
                        <?php 
							$msa+=$awal;
							$mmut+=$mut;
							$mso+=$akhir;
						}}
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
						}}
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
							$tadmsa=$m1sa;
							$tadmmut=$m1mut;
							$tadmso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						
						?>
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak2[description]))?></td>
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak3[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]' group by a.akun4","*");
						foreach($as4 as $ak4){
						?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak4[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as5=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5","*");
						//echo"select * from v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5 <br>";
						foreach($as5 as $ak5){
							//echo"$ak5[account]<br>";
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND a.account= '$ak5[account]' $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							$sa=$db->select($tbl,$f);
							//echo"select $f from $tbl<br><br>";
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
                             <td><?=$ak5[akun5]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak5[description]))?></td>
                             <td align="right"><?=$db->minus($awal)?></td>
                             <td align="right"><?=$db->minus($mut)?></td>
                             <td align="right"><?=$db->minus($akhir)?></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                         
                        <?php 
							$msa+=$awal;
							$mmut+=$mut;
							$mso+=$akhir;
							
							
							
						}}
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($msa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mso)?>
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
						}}
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
							$tpasarsa=$m1sa;
							$tpasarmut=$m1mut;
							$tpasarso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						
						
						?>
                        <!--- pindah halaman -->

						<tr>
                          <td></td>
                             <td><strong>TOTAL PENDAPATAN & BEBAN DILUAR USAHA</strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tpasarsa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tpasarmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($tpasarso)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						$lrb4taxsa=$grossconsa+$tpasarsa;
						$lrb4taxmut=$grossconmut+$tpasarmut;
						$lrb4taxso=$grossconso+$tpasarso;
						?>
                        <tr>
                          <td></td>
                             <td><strong>LABA RUGI SEBELUM PAJAK</strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lrb4taxsa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lrb4taxmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($lrb4taxso)?>
                          </strong></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <!----- --->
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak2[description]))?></td>
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak3[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]' group by a.akun4","*");
						foreach($as4 as $ak4){
						?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak4[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as5=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5","*");
						//echo"select * from v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5 <br>";
						foreach($as5 as $ak5){
							//echo"$ak5[account]<br>";
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND a.account= '$ak5[account]' $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							$sa=$db->select($tbl,$f);
							//echo"select $f from $tbl<br><br>";
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
                             <td><?=$ak5[akun5]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak5[description]))?></td>
                             <td align="right"><?=$db->minus($awal)?></td>
                             <td align="right"><?=$db->minus($mut)?></td>
                             <td align="right"><?=$db->minus($akhir)?></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                         
                        <?php 
							$msa+=$awal;
							$mmut+=$mut;
							$mso+=$akhir;
							
							
							
						}}
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($msa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mso)?>
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
						}}
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
							$tplainsa=$m1sa;
							$tplainmut=$m1mut;
							$tplainso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						
						?>
						
						
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
						
                      	$as2=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun2=b.account AND akun1='$ak1[akun1]' group by a.akun2","*");
						foreach($as2 as $ak2){
                     	?>
                      	<tr>
                             <td><?=$ak2[akun2]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak2[description]))?></td>
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
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak3[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as4=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun4=b.account AND akun3='$ak3[akun3]' group by a.akun4","*");
						foreach($as4 as $ak4){
						?>
                      	<tr>
                             <td><?=$ak4[akun4]?></td>
                             <td>&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak4[description]))?></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                        </tr>
                        <?php
						
                      	$as5=$db->select("v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5","*");
						//echo"select * from v_parent_akun a JOIN ak_acc b ON a.akun5=b.account AND akun4='$ak4[akun4]' group by a.akun5 <br>";
						foreach($as5 as $ak5){
							//echo"$ak5[account]<br>";
							$tbl="ak_acc a JOIN ak_acc_group d ON a.type = d.id_group LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($_GET['tahun']-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$_GET[tahun]'
													where a.post_flag<>'0' AND a.account= '$ak5[account]' $b";
							$f="a.description as desk, 
														   sum($awald) as DAWAL, 
														   sum($awalk) as KAWAL, 
														   sum($mutd) as mutd, 
														   sum($mutk) as mutk, `status` ";						
							$sa=$db->select($tbl,$f);
							//echo"select $f from $tbl<br><br>";
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
                             <td><?=$ak5[akun5]?></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=ucwords(strtolower($ak5[description]))?></td>
                             <td align="right"><?=$db->minus($awal)?></td>
                             <td align="right"><?=$db->minus($mut)?></td>
                             <td align="right"><?=$db->minus($akhir)?></td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                         
                        <?php 
							$msa+=$awal;
							$mmut+=$mut;
							$mso+=$akhir;
							
							
							
						}}
						?>
                        <tr>
                          <td></td>
                             <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?=$ak3[description]?>
                             </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($msa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($mso)?>
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
						}}
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
							$ttaxsa=$m1sa;
							$ttaxmut=$m1mut;
							$ttaxsaso=$m1so;
							$m1sa=0;
							$m1mut=0;
							$m1so=0;
						}
						$taftertaxsa= $lrb4taxsa-$ttaxsa;
						$taftertaxmut=$lrb4taxmut-$ttaxmut;
						$taftertaxso=$lrb4taxso-$ttaxso;
						
						
						?>
						
                        <!--- pindah halaman -->
						
						<tr>
                          <td></td>
                             <td><strong>LABA RUGI SETELAH PAJAK</strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($taftertaxsa)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($taftertaxmut)?>
                          </strong></td>
                          <td align="right"><strong>
                          <?=$db->minus($taftertaxso)?>
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

>>>>>>>>>>>>>>>>>>>>>>>>