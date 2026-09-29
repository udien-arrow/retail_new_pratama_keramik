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
    <div class="col-lg-7">
		<form action="index.php?x=pricel_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Pricelist</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Pricelist" onClick="window.location='index.php?x=pricel'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="5%">Id</th>
                              	<th width="70%">Nama Supplier</th>
                                <th width="5%"> Telp</th>
                              	<th width="5%">Contact</th>
                                <th width="5%">#</th>
                            </tr>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=pricel" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Pricelist</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
                    $supp=$db->select("m_supplier","kode_supp,nama_supp","id_supp='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Kode Supplier</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['kode_supp']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Nama Supplier</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['nama_supp']?></b>
                                  
                                </div>
                                <div class="form-group">
							<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
                               <?php
									$supp=$db->select("m_pricelist","id_price,tgl_berlaku,tgl_update,kode_price,status","id_supp='$_GET[id]' order by tgl_update desc");
									foreach($supp as $valsupp){
								?>
                                <tr>
                                	<td><span style="cursor:pointer" class='icon-diff-added' id="sli_<?=$valsupp['id_price']?>" onClick="openBo(<?=$valsupp['id_price']?>)"></span>&nbsp;&nbsp;&nbsp;
                                    	<b><?php echo "<span title='Kode Pricelist'>".$valsupp['kode_price']."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span title='Tanggal Awal Berlaku'>".date("d-m-Y",strtotime($valsupp['tgl_berlaku']))."</span>";?></b>
                                        <?php if($valsupp['status']==0){
echo "<input style='height:25px; line-height: 0;' type='button' class='btn btn-info' value='Belum'></button>";
										}elseif($valsupp['status']==1){
echo "<input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='Sudah'></button>";
										}elseif($valsupp['status']==2){
echo "<input style='height:25px; line-height: 0;' type='button' class='btn btn-danger' value='Tolak'></button>";
										}?>
                                     <input type="hidden" id="stat_<?=$valsupp['id_price']?>" value="0">   
                                    </td>
                                </tr>
                                <tr style="display:none" id="tr_<?=$valsupp['id_price']?>">
                                    <td>
									
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>Nama Barang</strong></td>
                                            <td align="center"><strong>Satuan </strong></td>
                                            <td align="center"><strong>Harga</strong></td>
                                          </tr>
                                          <?php
                                          $kon=$db->select("m_pricelist_dtl a 
										  left join m_barang b on a.id_barang=b.id_barang
										  left join m_satuan c on a.sat=c.id_satuan
										   ","*","id_price=$valsupp[id_price]");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['nama_barang'];?>&nbsp;</td>
                                            <td align="left">&nbsp;
                                            <?=$d['nama_satuan']?></td>
                                            <td align="right"><?=number_format($d['harga'])?>                                              &nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                                 </td>
                               </tr>
                               <?php $no++;} ?> 
                            </table>       
                                        
                                        
                                      
                                     
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
