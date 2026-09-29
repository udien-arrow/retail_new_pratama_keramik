
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
         <form class="form-horizontal" action="index.php?x=up_rilis_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())" enctype="multipart/form-data">
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">STTB SO Rilis</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-1">&nbsp;&nbsp;&nbsp;</label>
                             	<div class="col-lg-4">
                               
                            
                            </div> 
                              
                    </div>
					<div class="panel-body">
                    			
                    
                                <div class="form-group">
                                <div class="table-responsive">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table datatable-scroller">
                                          <tr>
                                            <td width="4%"align="center"><strong>No</strong></td>
                                            <td align="center" width="50%"><strong>No PP</strong></td>
                                            <td align="center" width="50%"><strong>Tgl PP</strong></td>
                                            <td width="10%"align="center"><strong>No Kontrak</strong></td>
                                            <td width="10%" align="center"><strong>No SO</strong></td>
                                            <td width="10%" align="center"><strong>Tipe Order</strong></td>
                                            <td width="10%" align="center"><strong>Tgl SO</strong></td>
                                            <td width="10%" align="center"><strong>Incoterm</strong></td>
                                            <td width="10%" align="center"><strong>No DO</strong></td>
                                            <td width="10%" align="center"><strong>Tgl DO</strong></td>
                                            <td width="10%" align="center"><strong>Produk</strong></td>
                                            <td width="10%" align="center"><strong>Qty DO</strong></td>
                                            <td width="10%" align="center"><strong>UOM</strong></td>
                                            <td width="10%" align="center"><strong>Klp Harga</strong></td>
                                            <td width="10%" align="center"><strong>No SPJ</strong></td>
                                            <td width="10%" align="center"><strong>Tgl SPJ</strong></td>
                                            <td width="10%" align="center"><strong>Jam SPJ</strong> </td>
                                            <td width="10%" align="center"><strong>No SSPS</strong></td>
                                            <td width="10%" align="center"><strong>No Polisi</strong></td>
                                            <td width="10%" align="center"><strong>Nama Supir</strong></td>
                                            <td width="10%" align="center"><strong>Kode Dist</strong></td>
                                            <td width="10%" align="center"><strong>Nama Dist</strong></td>
                                            <td width="10%" align="center"><strong>Kode Shipto</strong></td>
                                            <td width="10%" align="center"><strong>Nama Shipto</strong></td>
                                            <td width="10%" align="center"><strong>ALamat Shipto</strong></td>
                                            <td width="10%" align="center"><strong>Kode Distrik</strong></td>
                                            <td width="10%" align="center"><strong>Nama Distrik</strong></td>
                                            <td width="10%" align="center"><strong>Kode Expediture</strong></td>
                                            <td width="10%" align="center"><strong>Expediture</strong></td>
                                            <td width="10%" align="center"><strong>Kd Plant</strong></td>
                                            <td width="10%" align="center"><strong>Nama Plant</strong></td>
                                            <td width="10%" align="center"><strong>Nama Kapal</strong></td>
                                            <td width="10%" align="center"><strong>Status</strong></td>
                                            <td width="10%" align="center"><strong>Line Item</strong></td>
                                          </tr>
                                          <?php
                                          $kon=$db->select("tx_upload_rilis","*","status_tx='2'");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td><?=$d['no_pp']?></td>
                                            <td><?=$d['tgl_pp']?></td>
                                            <td align="left"><?=$d['no_kontrak']?></td>
                                            <td align="left"><?=$d['no_so']?></td>
                                            <td align="right"><?=$d['tipe_order']?></td>
                                            <td align="right"><?=$d['tgl_so']?></td>
                                            <td align="right"><?=$d['incoterm']?></td>
                                            <td align="right"><?=$d['no_do']?></td>
                                            <td align="right"><?=$d['tgl_do']?></td>
                                            <td align="right"><?=$d['produk']?></td>
                                            <td align="right"><?=$d['qty_do']?></td>
                                            <td align="right"><?=$d['uom']?></td>
                                            <td align="right"><?=$d['klp_harga']?></td>
                                            <td align="right"><?=$d['no_spj']?></td>
                                            <td align="right"><?=$d['tgl_spj']?></td>
                                            <td align="right"><?=$d['jam_spj']?></td>
                                            <td align="right"><?=$d['no_spps']?></td>
                                            <td align="right"><?=$d['no_polisi']?>
  &nbsp;</td>
                                            <td align="center"><?=$d['nama_sopir']?></td>
                                            <td align="center"><?=$d['kode_distributor']?></td>
                                            <td align="center"><?=$d['nama_distributor']?></td>
                                            <td align="center"><?=$d['kode_shipto']?></td>
                                            <td align="center"><?=$d['nama_shipto']?></td>
                                            <td align="center"><?=$d['alamat_shipto']?></td>
                                            <td align="center"><?=$d['kode_distrik']?></td>
                                            <td align="center"><?=$d['distrik']?></td>
                                            <td align="center"><?=$d['kode_ekspeditur']?></td>
                                            <td align="center"><?=$d['ekspeditur']?></td>
                                            <td align="center"><?=$d['kd_plant']?></td>
                                            <td align="center"><?=$d['plant']?></td>
                                            <td align="center"><?=$d['nama_kapal']?></td>
                                            <td align="center"><?=$d['status']?></td>
                                            <td align="center"><?=$d['line_item']?></td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                                   </div>  
                                 </div>
                                  
					
					</div>	
                    
				</div>					
		</div>
</form>
