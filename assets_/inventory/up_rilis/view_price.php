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
    <div class="col-lg-4">
		<form action="index.php?x=up_so_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Upload SO</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Upload SO" onClick="window.location='index.php?x=up_so'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="5%">Id</th>
                              	<th width="50%">Kode</th>
                                <th width="20%"> Tgl Upload</th>
                              	
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
         <form class="form-horizontal" action="index.php?x=up_so" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Upload SO</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                                
                                <div class="form-group">
							<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table datatable-scroller">
                                          <tr>
                                            <td width="4%"align="center"><strong>No</strong></td>
                                            <td align="center" width="50%"><strong>No Order</strong></td>
                                            <td align="center" width="50%"><strong>Contract No</strong></td>
                                            <td width="10%"align="center"><strong>Sales Order</strong></td>
                                            <td width="10%" align="center"><strong>SO Date</strong></td>
                                            <td width="10%" align="center"><strong>Delivery Date</strong></td>
                                            <td width="10%" align="center"><strong>SO Type</strong></td>
                                            <td width="10%" align="center"><strong>Incoterm</strong></td>
                                            <td width="10%" align="center"><strong>Price Group</strong></td>
                                            <td width="10%" align="center"><strong>Sold to code</strong></td>
                                            <td width="10%" align="center"><strong>Sold to</strong></td>
                                            <td width="10%" align="center"><strong>District Code</strong></td>
                                            <td width="10%" align="center"><strong>District Name</strong></td>
                                            <td width="10%" align="center"><strong>Ship to Code</strong></td>
                                            <td width="10%" align="center"><strong>Ship To</strong></td>
                                            <td width="10%" align="center"><strong>Address</strong></td>
                                            <td width="10%" align="center"><strong>Plant</strong> </td>
                                            <td width="10%" align="center"><strong>Material Code</strong></td>
                                            <td width="10%" align="center"><strong>Materi</strong></td>
                                            <td width="10%" align="center"><strong>SO Qty</strong></td>
                                            <td width="10%" align="center"><strong>UOM</strong></td>
                                            <td width="10%" align="center"><strong>Real Qty</strong></td>
                                            <td width="10%" align="center"><strong>SO Open</strong></td>
                                            <td width="10%" align="center"><strong>Price</strong></td>
                                            <td width="10%" align="center"><strong>Ship Name</strong></td>
                                            <td width="10%" align="center"><strong>Line</strong></td>
                                          </tr>
                                          <?php
                                          $kon=$db->select("tx_upload_so_dtl","*","id_up='$_GET[id]'");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td><?=$d['no_order']?></td>
                                            <td><?=$d['contract_no']?></td>
                                            <td align="left"><?=$d['sales_order']?></td>
                                            <td align="right"><?=$d['so_date']?></td>
                                            <td align="right"><?=$d['delvery_date']?></td>
                                            <td align="right"><?=$d['so_type']?></td>
                                            <td align="right"><?=$d['incoterm']?></td>
                                            <td align="right"><?=$d['price_group']?></td>
                                            <td align="right"><?=$d['sold_to_code']?></td>
                                            <td align="right"><?=$d['sold_to']?></td>
                                            <td align="right"><?=$d['district_code']?></td>
                                            <td align="right"><?=$d['disctrict_name']?></td>
                                            <td align="right"><?=$d['shipto_code']?></td>
                                            <td align="right"><?=$d['shipto']?></td>
                                            <td align="right"><?=$d['address']?></td>
                                            <td align="right"><?=number_format($d['plant'])?>&nbsp;</td>
                                            <td align="right"><?=$d['material_code']?>                                              &nbsp;</td>
                                            <td align="center"><?=$d['material']?></td>
                                            <td align="center"><?=$d['so_qty']?></td>
                                            <td align="center"><?=$d['uom']?></td>
                                            <td align="center"><?=$d['real_qty']?></td>
                                            <td align="center"><?=$d['so_open']?></td>
                                            <td align="center"><?=$d['price']?></td>
                                            <td align="center"><?=$d['ship_name']?></td>
                                            <td align="center"><?=$d['line']?></td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>      
                                        
                                        
                                      
                                     
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
