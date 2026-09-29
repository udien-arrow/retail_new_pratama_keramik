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
		<form action="index.php?x=retail" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Penjualan</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>  
                            <tr>
                                <td width="10%">No Jual</td>
                              	<td width="25%">Tanggal</td>
                                <td width="25%">Grantotal</td>
                                <td width="20%">user</td>
                              	<td width="10%">jenis</td>
                                <td width="10%">#</td>
                            </tr>
                        </thead>

                    </table>
                    
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=retail_c" name="formku" id="formku" method="post">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil  Penjualan

                        <button style="float:right" class="btn btn-danger" type="submit" name="simpan">Cetak</button>
         				<input type="hidden" name="id" id="id" value="<?=$_GET['id']?>" required>  
                        </h5>
                    </div>
                    
                    <div class="dataTables_wrapper">
                    </div>
                    
                  	<?php
                   	$kon=$db->select("pj_penjualan a 
					INNER JOIN pj_penjualan_dtl b on a.id_pj = b.id_pj 
					LEFT JOIN m_customer c on a.id_customer = c.id_cus 
					INNER JOIN m_barang_gudang d on b.id_barang = d.id_barang
					INNER JOIN m_satuan e on d.id_satuan = e.id_satuan",
					"a.id_pj,a.no_penjualan,a.tgl_penjualan,a.grantot_jual, b.id_barang,b.qty_jual,b.harga_jual,b.dtl_total,c.nama_cus,d.nama_barang,e.nama_satuan,a.jenis_jual",
					"a.id_pj = $_GET[id]");							
					//echo "select a.id_pj,a.no_penjualan,a.tgl_penjualan,a.grantot_jual, b.id_barang,b.qty_jual,b.harga_jual,b.dtl_total,c.nama_cus,d.nama_barang,e.nama_satuan,a.jenis_jual from pj_penjualan a 
					//INNER JOIN pj_penjualan_dtl b on a.id_pj = b.id_pj 
					//LEFT JOIN m_customer c on a.id_customer = c.id_cus 
					//INNER JOIN m_barang_gudang d on b.id_barang = d.id_barang
					//INNER JOIN m_satuan e on d.id_satuan = e.id_satuan where a.id_pj = $_GET[id]"
					?>

				  <div class="panel-body">
                   				
                              
                                <?php foreach($kon as $c){ } ?>
                                <div class="form-group">
	                    				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Penjualan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$c['no_penjualan']?></b>
                                  
                                </div>                                 
                               
                                <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>Nama Barang</strong></td>
                                            <td align="center"><strong>Satuan </strong></td>
                                            <td align="center"><strong>Harga</strong></td>
                                            <td align="center"><strong>Qty</strong></td>
                                            <td align="center"><strong>Total</strong></td>                                            
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
                                            <td align="left">&nbsp;<?=number_format($d['harga_jual'])?></td>
                                            <td align="right"><?=number_format($d['qty_jual'])?>&nbsp;</td>
                                            <td align="right"><?=number_format($d['qty_jual']*$d['harga_jual'])?>&nbsp;</td>                                            
                                          </tr>
                                          <?php 
										  $no++;
										  $hargatot=$hargatot+($d['qty_jual']*$d['harga_jual']); 
										  } ?>
                                            <td align="center" colspan="5"><strong>Total</strong></td>
                                            <td align="right"><strong><?=number_format($hargatot,0)?></strong></td>                                           
                                        </table>
                           
                                        
                                      
                                     
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
        
</form>

