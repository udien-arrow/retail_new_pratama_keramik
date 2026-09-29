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
$b=explode("-",$_GET['d1']);
if($b[1]==1){
            $awalk="ifnull(kredit,0)";
            $awald="ifnull(debet,0)";
            $mutd="ifnull(D1,0)";
            $mutk="ifnull(K1,0)";
            }else{
                for($i=1;$i<$b[1];$i++){
                    $ad.="ifnull(D".$i.",0)+";
                    $ak.="ifnull(K".$i.",0)+";
                    }
                $awald="(ifnull(debet,0)+".substr($ad,0,-1).")";
                $awalk="(ifnull(kredit,0)+".substr($ak,0,-1).")";
                $mutd="ifnull(D".$i.",0)";
                $mutk="ifnull(K".$i.",0)";
                }

?>
  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		 
           <div class="panel panel-flat">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        Laporan Buku Besar
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
                    <div class="col-lg-10">
                                <div class="form-group">
                                      <div class="col-lg-2">
                                          <div class="input-group">
                                             Kode Rekening
                                          </div>
                                   	  </div>
                                      <div class="col-lg-3">                                      
                                      	<div class="input-group">
                                      		<span class="input-group-addon"><i class="icon-list"></i></span>
                                      		<input class="form-control" name="ac1" id="ac1" />
                                      	</div>
                                   	  </div>
                                   	  <div class="col-lg-3">
                                      	<div class="input-group">
                                      		<span class="input-group-addon"><i class="icon-list"></i></span>
                                       		<input class="form-control" name="ac2" id="ac2" />
                                     	</div>
                               		  </div>
                                       
                    		  </div>
                      </div>
                      
                                      
                      <div class="col-lg-10">
  
                       </div>
                    <div class="col-lg-10">
                                <div class="form-group">
                                      <div class="col-lg-2">
                                          <div class="input-group">
                                             Periode
                                          </div>
                                   	  </div>
                                      <div class="col-lg-3">                                      
                                      	<div class="input-group">
                                      		<span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      		<input class="form-control datepicker1" name="tgl1" id="tgl1" />
                                      	</div>
                                   	  </div>
                                   	  <div class="col-lg-3">
                                      	<div class="input-group">
                                      		<span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                       		<input class="form-control datepicker1" name="tgl2" id="tgl2" />
                                      	</div>
                                   	  </div>
                                   	  <div class="col-lg-2">
                              	  <select name="cab" id="cab"  class="select-search" >
                                  <option value="">---Cabang---</option>
                                  <option value="A">Semua Cabang</option>
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
                                      <div class="col-lg-2">
                                            <input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(tgl1.value,tgl2.value,ac1.value,ac2.value,cab.value)">
                                      </div>   
                    		  </div>
                      </div>
                              </td></tr>
                    </table>
                    <?php
					if(!empty($_GET[d1])){
					
					?>
					<table width="100%" class="table-columned" id="example5" >
                        <thead>
                            <tr>
                              <th colspan="12" style="text-align:center" ><h5>LAPORAN BUKU BESAR CABANG <?php foreach($db->select("m_cabang","nama_cabang","id_cabang='$_GET[cab]'")as $cb); echo $cb['nama_cabang'];?><br>PERIODE <br /><?php echo date("d/m/Y", strtotime($_GET[d1]))." s.d. ".date("d/m/Y",strtotime($_GET[d2])).""; ?></h5></th>
                            </tr>
						<?php
						if($_GET[cab]=="A"){
							$cab="";
							$cab1="";							
							} else {$cab="AND c.id_cabang=".$_GET['cab'];
									$cab1="AND c.CABANG=".$_GET['cab'];}
                        $ak=$db->select("ak_acc","*","(account between '$_GET[a1]' AND '$_GET[a2]') AND post_flag='1'");
                        foreach($ak as $sak){
								$tbl="ak_acc a LEFT JOIN ak_closing c ON a.account = c.ACC_CODE
														 AND c.TAHUN='". ($b[0]-1) ."' 
														 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
														 AND b.TAHUN='$b[0]' 
														 JOIN ak_acc_group d ON d.id_group=a.type WHERE a.account='$sak[account]'
														 order by a.account
													";
								$f="a.account,a.description as desk, 
									sum($awald) as DAWAL, 
									sum($awalk) as KAWAL, 
									sum($mutd) as mutd, 
									sum($mutk) as mutk,
									 d.`status` as st ";						
								$sa0=$db->select($tbl,$f);
								$smu=$db->select("ak_jurnal a JOIN ak_jurnal_dtl b ON a.NO_JURNAL=b.NO_JURNAL","sum(b.DEBET) as DEBET,sum(b.KREDIT) as KREDIT,sum(b.ID_CAB)","date(b.TGL_JURNAL)<'$_GET[d1]' and month(b.tgl_jurnal)='$b[1]' and year(b.tgl_jurnal)='$b[1]' AND b.ACC_CODE='$sak[account]' $cab");
								

								foreach ( $sa0 as $sa01);
								foreach ( $smu as $smu1);
								//echo"$sa01[DAWAL] - select $f From $tbl<br><br>";
								
								if($sa01['st']=="D"){
									
									$sa=($sa01['DAWAL']+$smu1[DEBET])-($sa01[KAWAL]+$smu1[KREDIT]);
									//echo"disini";
									}else{
										
										$sa=($sa01[KAWAL]+$smu1[KREDIT])-($sa01['DAWAL']+$smu1[DEBET]);
										}
								$dtl=$db->select("ak_jurnal a JOIN ak_jurnal_dtl b ON a.NO_JURNAL=b.NO_JURNAL JOIN m_cabang c ON b.ID_CAB=c.id_cabang","b.DEBET, b.KREDIT,b.KET_DTL,b.NO_JURNAL,b.TGL_JURNAL,b.ID_CAB,NO_INVOICE, nama_cabang","date(b.tgl_jurnal) between '$_GET[d1]' AND '$_GET[d2]' AND b.acc_code='$sak[account]' $cab ");
								if(count($dtl)>0 OR $sa>0){

                     	?>

                          <tr height="30px" bgcolor="#EFEFEF">
                              <th colspan="9" align="left">Kode Rekening : <?=$sak['account']." - ".$sak['description']?></th>
                          </tr>
                          <tr>
                            <td width="3%"><strong>No</strong></td>
                            <td width="6%"><strong>Tanggal</strong></td>
                            <td width="11%"><strong>No Jurnal</strong></td>
                            <td width="14%" align="center"><strong>No Ref</strong></td>
                            <td width="11%" align="center"><strong>Cabang</strong></td>
                            <td width="32%" align="center"><strong>Keterangan</strong></td>
                            <td width="7%" align="center"><strong>Debet</strong></td>
                            <td width="7%" align="center"><strong>Kredit</strong></td>
                            <td width="9%" align="center"><strong>Saldo Akhir</strong></td>
                          </tr>  
                      </thead>
                      <tbody>
                      <tr>
                             <td colspan="6" align="right"><strong>Saldo Awal</strong></td>
                             <td align="right">&nbsp;</td>
                             <td align="right">&nbsp;</td>
                             <td align="right"><?=number_format($sa)?></td>

                        </tr>
                      	<?php
						
						$no=0;
						$so=$sa;
						
						foreach($dtl as $rdtl){
							$no++;
							if($sa01['st']=="D"){
									
									$so+=($rdtl['DEBET'])-($rdtl[KREDIT]);
									}else{
										
										$so+=($rdtl[KREDIT])-($rdtl['DEBET']);
										}

							
						?>
                      	<tr>
                             <td><?=$no?></td>
                             <td><?=date("d/m/Y",strtotime($rdtl['TGL_JURNAL']))?>&nbsp;</td>
                             <td><?=$rdtl['NO_JURNAL']?></td>
                             <td align="left"><?=$rdtl['NO_INVOICE']?></td>
                             <td align="left"><?=$rdtl['nama_cabang']?></td>
                             <td align="left"><?=$rdtl[KET_DTL]?></td>
                             <td align="right"><?=number_format($rdtl[DEBET])?></td>
                             <td align="right"><?=number_format($rdtl[KREDIT])?></td>
                             <td align="right"><?=number_format($so)?></td>

                        </tr> 
                         
							<?php 
							$mutd+=$rdtl['DEBET'];
							$mutk+=$rdtl['KREDIT'];
							}
                               
                            
                            
						?>
                        </tbody>

                        <tr>
                             <td colspan="6" align="right"><strong>Total Mutasi
                               
                             </strong></td>
                             <td align="right"><strong>
                               <?=number_format($mutd)?>
                             </strong></td>
                             <td align="right"><strong>
                               <?=number_format($mutk)?>
                             </strong></td>
                             <td align="right"><strong>
                             <?=number_format($so)?>
                             </strong></td>
                        </tr> 
						<tr>
                             <td></td>
                             <td colspan="2" align="right"><strong>

                             </strong></td>
                             <td align="right">&nbsp;</td>
                             <td align="right">&nbsp;</td>
                             <td align="right">&nbsp;</td>
                             <td align="right">&nbsp;</td>
                             <td align="right">&nbsp;</td>
                             <td align="right">&nbsp;</td>
                        </tr> 
                      <?php $mutd=0;
					  		$mutk=0;}} ?>
                      </table>    
                     <?php
					}?>
   		  </div>
          

			
		</div>
