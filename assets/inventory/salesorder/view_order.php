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
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Permintaan Barang" onClick="window.location='index.php?x=salesorder'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>  
                            <tr>
                                <td width="10%">No Sales</td>
                              	<td width="5%">Tgl</td>
                                <td width="5%">Jenis</td>
                                <td width="25%">Customer</td>
                              	<td width="5%">Approve</td>
                                <td width="8%">#</td>
                            </tr>
                        </thead>

                    </table>
                   
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Barang</h5>
					</div>
                    
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
                   	$kon=$db->select("tx_sales_order az
								JOIN tx_sales_order_dtl a ON az.no_sales = a.no_sales
								JOIN m_barang_gudang b ON a.id_barang = b.id_barang
								AND az.id_gudang = b.id_gudang
								JOIN m_satuan c ON a.id_satuan = c.id_satuan
								join m_customer d on az.id_cus=d.id_cus
								","a.qty,a.tgl_kirim,
								b.nama_barang,
								a.harga,
								c.nama_satuan,
								d.nama_usaha,
								a.no_sales","az.no_sales='$_GET[id]'");				
					?>
				  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                  
                                </div>
                                <?php foreach($kon as $c){ } ?>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Customer</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$c['nama_usaha']?></b>
                                  
                                </div>
                                
                               
                                <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>Nama Barang</strong></td>
                                            <td align="center"><strong>Satuan </strong></td>
                                            <td align="center"><strong>Qty</strong></td>
                                          </tr>
                                          <?php
										  $no=1;
                                          foreach($kon as $d){
										  ?>
                                          
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['nama_barang'];?>&nbsp;</td>
                                            <td align="left">&nbsp;
                                            <?=$d['nama_satuan']?></td>
                                            <td align="right"><?=number_format($d['qty'])?>
                                            &nbsp;</td>
                                          </tr>
                                          <?php $no++;
										  $total=$total+$to;
										  } ?>
                                          <tr>
                                            <td colspan="4" align="center">&nbsp;</td>
                                          </tr>
                                        </table>
                           
                                        
                                      
                                     
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
