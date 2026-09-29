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
						<h5 class="panel-title">View Pricelist Jual</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Pricelist Jual" onClick="window.location='index.php?x=pricel_jual'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="5%">Id</th>
                              	<th width="40%">Nama Cabang</th>
                                <th width="25%">Telp</th>
                              	<th width="25%">Alamat</th>
                                <th width="15%">#</th>
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
						<h5 class="panel-title">View Detil Pricelist Jual</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                              
                                <div class="form-group">
							<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
                               <?php
									$supp=$db->select("m_pricelist_jual","id_price,tgl_berlaku,tgl_update,kode_price,case when jenis=1 then 'Retail' when jenis=2 then 'Grosir' end as jenis","id_cabang='$_GET[id]' order by tgl_update desc");
									foreach($supp as $valsupp){
								?>
                                <tr>
                                	<td><span style="cursor:pointer" class='icon-diff-added' id="sli_<?=$valsupp['id_price']?>" onClick="openBo(<?=$valsupp['id_price']?>)"></span>&nbsp;&nbsp;&nbsp;
                                    	<b><?php echo "<span title='Kode Pricelist'>".$valsupp['kode_price']."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span title='Tanggal Awal Berlaku'>".date("d-m-Y",strtotime($valsupp['tgl_berlaku']))."</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span title='Tanggal Awal Berlaku'>".$valsupp['jenis']."</span>										
										";?></b>
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
                                          $kon=$db->select("m_pricelist_jual_dtl a 
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
