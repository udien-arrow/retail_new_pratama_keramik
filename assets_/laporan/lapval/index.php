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
						  $a=explode('-',$_GET['tgl']);
						  $tgl=$a[2]."-".$a[1]."-".$a[0];
						  //$b=explode("/",$_GET['b']);
						  //$wp=$b[2]."-".$b[0]."-".$b[1];
							?>
		                		<!--<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>-->
                                <li><a target="_blank" href="cetak.php?cab=<?=$_GET['cab']?>&a=<?=$gg?>&b=<?=$wp?>&jenis=<?=$_GET['jenis']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table width="100%"  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
                    <div class="col-lg-12">
                    	<div class="form-group">
                        	<div class="form-group" >
                                   <div class="col-lg-2">
                                    <input name="tgl" id="tgl" class="form-control datepicker1" value="<?=$_GET[tgl]?>"/>
                                   </div> 
                                   <div class="col-lg-3">
                                    <select name="unit" id="unit" class="select" onchange="pindahData2(unit.value,tgl.value)">
                                    	<option value="0">---Unit---</option>
                                    	<?php
										foreach($db->select("m_unit","*","id_cabang='$_SESSION[ID_CABANG]'") as $vunit){
										?>
                                        	<option value="<?=$vunit['id_unit']?>" <?php if($vunit['id_unit']==$_GET['unit']){echo "selected";}?>><?=$vunit[nama_unit]?></option>
                                        <?php	
										}
										?>
                                    </select>
                                   </div> 
                                   <div class="col-lg-3">
                                    <!--<select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value,tgl.value,unit.value)">-->
                                    <select name="jenis" id="jenis" class="select" onChange="pindahData3(tgl.value,unit.value,this.value)">
                                      <option value="0">---Jenis---</option>
                                      <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?>>Credit Card</option>
                                      <option value="2" <?php if($_GET['jenis']==2){echo "selected";}?>>Debit Card</option>
                                      <option value="3" <?php if($_GET['jenis']==3){echo "selected";}?>>Cash</option>
                                      <option value="5" <?php if($_GET['jenis']==5){echo "selected";}?>>Mitra Lain</option>
                                      <option value="6" <?php if($_GET['jenis']==6){echo "selected";}?>>Reflexy</option>
                                      <option value="7" <?php if($_GET['jenis']==7){echo "selected";}?>>VIP Room</option> 
                                    </select>
                                  </div>
                                 
                                  
                                      <div class="col-lg-3" id="bank">
                                        <!--<select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value,tgl.value,unit.value)">-->
                                        <?php
										if($_GET[jenis]==1){
											$tabel="bo_spk_head a JOIN bo_m_bank b ON a.id_mitra=b.id_bank";
											$field="id_bank as id, nama_bank as nama";
											$where="a.status='1' AND a.id_unit='$_GET[unit]' and a.id_cabang='$_SESSION[ID_CABANG]' and jenis_mitra='1'";
											$change="pindahData(jenis.value,tgl.value,unit.value,this.value)";
											} else {
											$tabel="bo_spk_head a JOIN bo_pkslain b ON a.id_mitra=b.idpks";
											$field="idpks as id, nama as nama";
											$where="a.status='1' AND a.id_unit='$_GET[unit]' and a.id_cabang='$_SESSION[ID_CABANG]' and jenis_mitra='2'";
											$change="";
												}	
										?>
                                        <select name="spk" id="spk" class="select" onChange="<?=$change?>">
                                          <option value="0">---Pilih Mitra---</option>
                                          <?php
										  	
											//echo"select * from $tabel where $where";		
                                            foreach($db->select($tabel,$field,$where) as $mt){
                                          ?>
                                          <option value="<?=$mt['id']?>" <?php if($mt['id']==$_GET['spk']){echo "selected";}?>><?=$mt['nama']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                        
                                      </div>
                                  
                                  
                                      <div class="col-lg-3" id="kartu">
                                      
                                        <!--<select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value,tgl.value,unit.value)">-->
                                        <select name="kartu" id="kartu" class="select-search" onChange="pindahData1(jenis.value,tgl.value,unit.value,spk.value,this.value)">
                                          <option value="0">Semua Kartu</option>
                                          <?php
										  	
												$tabel="bo_m_card a JOIN bo_spk_head b ON a.id_bank=b.id_mitra";
												$field="id_card, nama_card";
												$where="id_mitra='$_GET[spk]' and b.jenis_mitra='1'";
												
                                            foreach($db->select($tabel,$field,$where) as $mt){
                                          ?>
                                          <option value="<?=$mt['id_card']?>" <?php if($mt['id_card']==$_GET['kartu']){echo "selected";}?>><?=$mt['nama_card']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                        
                                      </div>
                                 
                                 
                                    <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" id="go" value="Go" onClick="pindahData(jenis.value,tgl.value,unit.value,spk.value)">
                               	  </div>
                    	</div>
                	</div>
                    </td></tr>
             </table>
					<!--<table id="example5" class="tableku datatable-basic " >-->
                    <table id="" class="tableku " >
                        <thead>
                            <tr>
                              <th colspan="9" style="text-align:center" ><h5> 
							  LAPORAN VALIDASI
                              <br>PERIODE <?php echo $tgl; ?></h5></th>
                            </tr>
						 <?php
                            $etgl=explode("-",$_GET['tgl']);
                                if($_GET[jenis]==3){
                                    $table = "tx_".(int)($etgl[1])."".$etgl[0];
                                    $field="id_inc,id_tx,tgl,nama_pax, id_cardtx,flight, arrives, qty, nominal, case (select count(id_trx) from bo_validasi_dtl where month(tgl_trx)='$etgl[1]' and year(tgl_trx)='$etgl[0]' and id_trx=id_inc) when 0 then 'Belum Divalidasi' when 1 then 'sudah di validasi' end as status";
                                    $where="jenis='3' and unit='$_GET[unit]' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]'";
                                    
									//echo"select $field from $table where $where";
                            ?>
                            <tr height="30px" bgcolor="#EFEFEF">
                               
                                <th width="5%">No</th>
                                <th width="5%">Tanggal</th>
                                <th width="15%">Nama Pax</th>
                              	<th width="10%">Flight</th>
                                <th width="10%">Tujuan</th>
                                <th width="10%">Pax</th>
                                <th width="10%">Total Bayar</th>
                                <th width="5%">Waktu</th>
                                <th width="5%">Validate</th>
                                <!--<th>Qty Terima</th>-->
                                
                              </tr> 
                          </thead>
                      <?php
					  	
					  	foreach($db->select($table,$field,$where)as $dt){
					  ?>
                      <tbody>
                      	<tr>
                        	<td><?=$dt['id_tx']?></td>
                            <td><?=date("d/m/Y",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['nama_pax']?></td>
                            <td><?=$dt['flight']?></td>
                            <td><?=$dt['arrives']?></td>
                            <td align="center"><?=$dt['qty']?></td>
                            <td align="right"><?=number_format($dt['nominal'])?></td>
                            <td><?=date("H:i:s",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['status']?></td>                
                            
                            
							
                            
							
                        </tr>
                      </tbody>
                      <?php
							} }
							
					  ?>
                      <?php
                            $etgl=explode("-",$_GET['tgl']);
                                if($_GET[jenis]==2){
                                    $table = "tx_".(int)($etgl[1])."".$etgl[0];
                                    $field="id_inc,id_tx,id_cardtx,tgl,nama_pax, id_cardtx,flight, arrives, qty, nominal, case v when 0 then 'Belum Divalidasi' when 1 then 'sudah di validasi' end as status";
                                    $where="jenis='2' and unit='$_GET[unit]' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]' AND id_inc not in(select id_trx from bo_validasi_tmp) AND id_inc not in(select id_trx from bo_validasi_dtl where month(tgl_trx)='$etgl[1]' and year(tgl_trx)='$etgl[0]')";
                                    
                                
                            ?>
                            <tr height="30px" bgcolor="#EFEFEF">
                               
                                <th width="5%">No</th>
                                <th width="5%">Tanggal</th>
                                <th width="15%">Nomor Kartu</th>
                                <th width="15%">Nama Pemegang Kartu</th>
                              	<th width="10%">Flight</th>
                                <th width="10%">Tujuan</th>
                                <th width="10%">Pax</th>
                                <th width="10%">Total Bayar</th>
                                <th width="5%">Waktu</th>
                                <th width="5%">Validate</th>
                                <!--<th>Qty Terima</th>-->
                                
                              </tr> 
                          </thead>
                      <?php
					  	
					  	foreach($db->select($table,$field,$where)as $dt){
					  ?>
                      <tbody>
                      	<tr>
                        	<td><?=$dt['id_tx']?></td>
                            <td><?=date("d/m/Y",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['id_cardtx']?></td>
                            <td><?=$dt['nama_pax']?></td>
                            <td><?=$dt['flight']?></td>
                            <td><?=$dt['arrives']?></td>
                            <td align="center"><?=$dt['qty']?></td>
                            <td align="right"><?=number_format($dt['nominal'])?></td>
                            <td><?=date("H:i:s",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['status']?></td>                
                            
                            
							
                            
							
                        </tr>
                      </tbody>
                      <?php
							} }
							
					  ?>
                      <?php
                            $etgl=explode("-",$_GET['tgl']);
                                if($_GET[jenis]==6){
                                    $table = "tx_".(int)($etgl[1])."".$etgl[0];
                                    $field="id_inc,id_tx,id_cardtx,tgl,nama_pax, id_cardtx,flight, arrives, qty, nominal, case v when 0 then 'Belum Divalidasi' when 1 then 'sudah di validasi' end as status,ket";
                                    $where="jenis='6' and unit='$_GET[unit]' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]' AND id_inc not in(select id_trx from bo_validasi_tmp) AND id_inc not in(select id_trx from bo_validasi_dtl where month(tgl_trx)='$etgl[1]' and year(tgl_trx)='$etgl[0]')";
                                    
                                
                            ?>
                            <tr height="30px" bgcolor="#EFEFEF">
                               
                                <th width="5%">No</th>
                                <th width="5%">Tanggal</th>
                                <th width="15%">Nama Pax</th>
                              	<th width="10%">Therapist</th>
                                <th width="10%">Durasi</th>
                                <th width="10%">Pax</th>
                                <th width="10%">Total Bayar</th>
                                <th width="5%">Waktu</th>
                                <th width="5%">Validate</th>
                                <!--<th>Qty Terima</th>-->
                                
                              </tr> 
                          </thead>
                      <?php
					  	
					  	foreach($db->select($table,$field,$where)as $dt){
							$det=explode(";",$dt[ket]);
							$ther=explode("-",$det[0]);
							$pak=explode("-",$det[1]);
							
					  ?>
                      <tbody>
                      	<tr>
                        	<td><?=$dt['id_tx']?></td>
                            <td><?=date("d/m/Y",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['nama_pax']?></td>
                            <td><?=$ther[1]?></td>
                            <td><?=$pak[1]?></td>
                            <td align="center"><?=$dt['qty']?></td>
                            <td align="right"><?=number_format($dt['nominal'])?></td>
                            <td><?=date("H:i:s",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['status']?></td>                
                            
                            
							
                            
							
                        </tr>
                      </tbody>
                      <?php
							} }
							
					  ?>
                      <?php
                            $etgl=explode("-",$_GET['tgl']);
                                if($_GET[jenis]==7){
                                    $table = "tx_".(int)($etgl[1])."".$etgl[0];
                                    $field="id_inc,id_tx,tgl,nama_pax, id_cardtx,flight, arrives, qty, nominal, case v when 0 then 'Belum Divalidasi' when 1 then 'sudah di validasi' end as status";
                                    $where="jenis='7' and unit='$_GET[unit]' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]' AND id_inc not in(select id_trx from bo_validasi_tmp) AND id_inc not in(select id_trx from bo_validasi_dtl where month(tgl_trx)='$etgl[1]' and year(tgl_trx)='$etgl[0]')";
                                    
                                
                            ?>
                            <tr height="30px" bgcolor="#EFEFEF">
                               
                                <th width="5%">No</th>
                                <th width="5%">Tanggal</th>
                                <th width="15%">Nama Pax</th>
                              	<th width="10%">Flight</th>
                                <th width="10%">Tujuan</th>
                                <th width="10%">Pax</th>
                                <th width="10%">Total Bayar</th>
                                <th width="5%">Waktu</th>
                                <th width="5%">Validate</th>
                                <!--<th>Qty Terima</th>-->
                                
                              </tr> 
                          </thead>
                      <?php
					  	
					  	foreach($db->select($table,$field,$where)as $dt){
					  ?>
                      <tbody>
                      	<tr>
                        	<td><?=$dt['id_tx']?></td>
                            <td><?=date("d/m/Y",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['nama_pax']?></td>
                            <td><?=$dt['flight']?></td>
                            <td><?=$dt['arrives']?></td>
                            <td align="center"><?=$dt['qty']?></td>
                            <td align="right"><?=number_format($dt['nominal'])?></td>
                            <td><?=date("H:i:s",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['status']?></td>                
                            
                            
							
                            
							
                        </tr>
                      </tbody>
                      <?php
							} }
							
					  ?>
                      <?php
                            $etgl=explode("-",$_GET['tgl']);
                                if($_GET[jenis]==1){
									if(!empty($_GET[spk])){
										if(!empty($_GET[kartu])){
											$kartu="AND a.id_card='$_GET[kartu]'";
											}else{ $kartu="";}
                                    $table = "tx_".(int)($etgl[1])."".$etgl[0]." a JOIN bo_m_card b ON a.id_card=b.id_card JOIN bo_m_bank c ON c.id_bank=b.id_bank";
                                    $field="id_inc,id_tx,id_cardtx,tgl,nama_pax, id_cardtx,flight, arrives, qty, nominal, case v when 0 then 'Belum Divalidasi' when 1 then 'sudah di validasi' end as status, nama_bank, b.nama_card";
                                    $where="jenis='1' and unit='$_GET[unit]' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]' and c.id_bank='$_GET[spk]' $kartu";
									//echo"select $field from $table where $where";
									}
                                    
                                
                            ?>
                            <tr height="30px" bgcolor="#EFEFEF">
                               
                                <th width="5%">No</th>
                                <th width="5%">Tanggal</th>
                                <th width="15%">Nama Pax</th>
                                <th width="15%">Nomor Kartu</th>
                                <th width="15%">Jenis Kartu</th>
                              	<th width="10%">Flight</th>
                                <th width="10%">Tujuan</th>
                                <th width="10%">Pax</th>
                                <th width="5%">Waktu</th>
                                <th width="5%">Validate</th>
                                <!--<th>Qty Terima</th>-->
                                
                              </tr> 
                          </thead>
                      <?php
					  	
					  	foreach($db->select($table,$field,$where)as $dt){
					  ?>
                      <tbody>
                      	<tr>
                        	<td><?=$dt['id_tx']?></td>
                            <td><?=date("d/m/Y",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['nama_pax']?></td>
                            <td><?=$dt['id_cardtx']?></td>
                            <td><?=$dt['nama_bank']." - ".$dt['nama_card']?></td>
                            <td><?=$dt['flight']?></td>
                            <td><?=$dt['arrives']?></td>
                            <td align="center"><?=$dt['qty']?></td>
                            <td><?=date("H:i:s",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['status']?></td>                
                            
                            
							
                            
							
                        </tr>
                      </tbody>
                      <?php
							} }
							
					  ?>
                      <?php
                            $etgl=explode("-",$_GET['tgl']);
                                if($_GET[jenis]==5){
									if(!empty($_GET[spk])){
										
                                    $table = "tx_".(int)($etgl[1])."".$etgl[0]." a JOIN bo_pkslain c ON c.idpks=a.id_card";
                                    $field="id_inc,id_tx,id_cardtx,tgl,nama_pax, id_cardtx,flight, arrives, qty, nominal, case v when 0 then 'Belum Divalidasi' when 1 then 'sudah di validasi' end as status, nama";
                                    $where="jenis='5' and unit='$_GET[unit]' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]' and a.id_card='$_GET[spk]'";
									//echo"select $field from $table where $where";
									}
                                    
                                
                            ?>
                            <tr height="30px" bgcolor="#EFEFEF">
                               
                                <th width="5%">No</th>
                                <th width="5%">Tanggal</th>
                                <th width="15%">Nama Pax</th>
                                <th width="15%">Mitra</th>
                              	<th width="10%">Flight</th>
                                <th width="10%">Tujuan</th>
                                <th width="10%">Pax</th>
                                <th width="5%">Waktu</th>
                                <th width="5%">Validate</th>
                                <!--<th>Qty Terima</th>-->
                                
                              </tr> 
                          </thead>
                      <?php
					  	
					  	foreach($db->select($table,$field,$where)as $dt){
					  ?>
                      <tbody>
                      	<tr>
                        	<td><?=$dt['id_tx']?></td>
                            <td><?=date("d/m/Y",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['nama_pax']?></td>
                            <td><?=$dt['nama']?></td>
                            <td><?=$dt['flight']?></td>
                            <td><?=$dt['arrives']?></td>
                            <td align="center"><?=$dt['qty']?></td>
                            <td><?=date("H:i:s",strtotime($dt['tgl']))?></td>
                            <td><?=$dt['status']?></td>                
                            
                            
							
                            
							
                        </tr>
                      </tbody>
                      <?php
							} }
							
					  ?>
                      <tfoot>
                      <tr>
                             <td colspan="8"></td>
                             
                            
                           </tr> 
                      </tfoot>
                       </table>    
  	
   		  </div>
		</div>      

