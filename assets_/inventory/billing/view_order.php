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
    <div class="col-lg-6">
		<form action="index.php?x=billing_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Billing</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Billing" onClick="window.location='index.php?x=billing'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>  
                            <tr>
                                <td width="15%">No Billing</td>
                              	<td width="5%">Tgl</td>
                                <td width="20%">No Faktur Pajak</td>
                                <td width="30%">Supplier</td>
                              	<td width="15%">Total</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
		   			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Billing</h5>
					</div>
                    
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
                   
				   
						$kon=$db->select("tx_billing_dtl a 
										  left join m_barang b on a.id_barang=b.id_barang
										  left join m_satuan c on a.id_satuan=c.id_satuan
										  left join tx_brg_masuk d on a.no_so=d.no_ref and a.no_spj=d.surat_jalan","a.*,b.nama_barang,c.nama_satuan,d.no_masuk as nomas,d.tgl","a.no_billing='$_GET[id]'");				
					?>
				  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Billing</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                  
                                </div>
                                
                               
                                <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>No SPJ</strong></td>
                                            <td align="center"><strong>Item</strong></td>
                                            <td align="center"><strong>Qty</strong></td>
                                            <td align="center"><strong>Harga</strong></td>
                                            <td align="center"><strong>Total</strong></td>
                                          </tr>
                                          <?php
										  
                                          
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td align="left">&nbsp;
                                            <?=$d['no_spj']?></td>
                                            <td align="left">&nbsp;
                                            <?=ucfirst(strtolower($d['nama_barang']))?></td>
                                            <td align="right">&nbsp;
                                            <?=number_format($d['qty'])?>&nbsp;</td>
                                            <td align="right">&nbsp;<?=number_format($d['harga'])?>&nbsp;</td>
                                            <td align="right">&nbsp;<?=number_format($d['total'])?>&nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                           
                                        
                                      
                                     
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
