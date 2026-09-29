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
		<form action="index.php?x=order_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Permintaan Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Permintaan" onClick="window.location='index.php?x=order-pemb'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <td width="10%">No Order</td>
                              	<td width="5%">Tgl</td>
                                <td width="30%">Supplier</td>
                                <td width="10%">Total</td>
                              	<td width="5%">Approve</td>
                                <td width="8%">#</td>
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
         <form class="form-horizontal" action="index.php?x=order" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan</h5>
					</div>
                    
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
                   	$kon=$db->select("tx_order_tagihan_dtl","*","no_pt='$_GET[id]'");				
					?>
				  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                  
                                </div>
                                
                               
                                <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>No billing</strong></td>
                                            <td align="center"><strong>No SPJ</strong></td>
                                            <td align="center"><strong>Total</strong></td>
                                            
                                          </tr>
                                          <?php
										  
                                          
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                         
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            
                                            <td>&nbsp;<?php echo $d['no_billing'];?>&nbsp;</td>
                                           	<td>&nbsp;<?php echo $d['no_spj'];?>&nbsp;</td>
                                            <td align="right">&nbsp;
                                            <?=number_format($d['total_bil'])?></td>
                                           
                                          </tr>
                                          <?php $no++;
										  $tot=$tot+$d['total_bil'];
										  } ?>
                                           <tr>
                                            <td colspan="3" align="center">Total</td>
                                            <td align="right"><?=number_format($tot)?></td>
                                          </tr>
                                        </table>
                            </div>
                           
				  </div>	
                    
				</div>					
		</div>
</form>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Detil</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>
