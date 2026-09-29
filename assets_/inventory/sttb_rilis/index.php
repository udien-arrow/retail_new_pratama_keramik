
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
		<div class="col-lg-1">
        </div>
        <div class="col-lg-10">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Detil SO Semen</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <br>
                  <div class="form-group">
							<div class="col-lg-8">
                                <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Tanggal </label>
                              <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET['tg']?>">
                                  </div>
                               </div>
                               
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgsd" id="tgsd" value="<?php echo $_GET['tgsd']?>">
                                  </div>
                                  
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="go" onClick="pindah(tg.value,tgsd.value)">
                               </div>
                               
                    </div>
                              </div>
                              
                    </div>
					<div class="panel-body">
                    			
                    
                                <div class="form-group">
                                <div class="table-responsive">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table datatable-scroller">
                                          <tr>
                                            <td width="1%"align="center"><strong>No</strong></td>
                                            <td align="center" width="2%"><strong>No SO</strong></td>
                                            <td align="center" width="10%"><strong>Tgl SO</strong></td>
                                            <td width="10%"align="center"><strong>Kode Distrik</strong></td>
                                            <td width="10%" align="center"><strong>Nama District</strong></td>
                                            <td width="3%" align="center"><strong>Incoterm</strong></td>
                                            <td width="10%" align="center"><strong>Shipto</strong></td>
                                            <td width="20%" align="center"><strong>Gudang Penerima / Pelanggan</strong></td>
                                            <td width="20%" align="center"><strong>Supplier</strong></td>
                                            <td width="10%" align="center"><strong>No PO</strong></td>
                                          </tr>
                                          <?php
										  $tg=date("Y-m-d",strtotime($_GET['tg']));
										  $tgsd=date("Y-m-d",strtotime($_GET['tgsd']));
                                          $kon=$db->select("tx_so a 
										  left join m_daerah b on b.kode_daerah=a.district_code
										  left join m_gudang c on a.id_gudang=c.id_gudang
										  left join m_supplier d on a.id_supp=d.id_supp
										  left join tx_po e on a.sales_order=e.no_so
										  ","a.*,b.nama_daerah,c.nama_gudang,d.nama_usaha,e.no_po","a.so_date between '$tg' and '$tgsd'");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr bgcolor="#F5F5F5">
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td><?=$d['sales_order']?></td>
                                            <td><?=$d['so_date']?></td>
                                            <td align="left"><?=$d['district_code']?></td>
                                            <td align="left"><?=$d['nama_daerah']?></td>
                                            <td align="left"><?=$d['incoterm']?></td>
                                            <td align="left"><?=$d['shipto_code']?></td>
                                            <td align="left"><?php
                                            foreach($db->select("m_gudang_shipto","*","shipto_code='$d[shipto_code]'")as $aa);
											
											echo $aa['shipto_code'];
											if($aa['shipto_code']!=''){
												echo $d['nama_gudang'];
											}else{
												foreach($db->select("m_customer_shipto a left join m_customer b on a.id_cus=b.id_cus","b.nama_usaha,b.alamat_usaha","a.shipto_code='$d[shipto_code]'")as $de);
												echo $de['nama_usaha'];  
											}
											$aa['shipto_code']='';
											?></td>
                                            <td align="left"><?=$d['nama_usaha']?></td>
                                            <td align="left"><?=$d['no_po']?></td>
                                          </tr>
                                           <tr>
                                            <td colspan="2" align="center">&nbsp;</td>
                                            <td colspan="8">
                                            	<table width="100%">
                                                	<tr >
                                                	  <td colspan="8">&nbsp;SO Detil</td>
                                               	  </tr>
                                                	<tr bgcolor="#F5F5F5">
                                                	  <td width="10%">&nbsp; Tgl Kirim</td>
                                                	  <td width="16%">&nbsp; Kode</td>
                                                	  <td width="25%">&nbsp; Item</td>
                                                    	<td width="8%">&nbsp; Qty</td>
                                                    	<td width="8%">&nbsp; Tot Rilis</td>
                                                    	<td width="8%">&nbsp;Sisa</td>
                                                    	<td width="20%">&nbsp; Price</td>
                                                    	<td width="15%">&nbsp; Line</td>
                                                    </tr>
                                                    <?php
													  $kond=$db->select("tx_so_dtl a 
													  left join m_barang b on a.id_barang=b.id_barang
													  left join m_satuan c on a.id_satuan=c.id_satuan
													  ","a.*,b.nama_barang,c.nama_satuan","sales_order='$d[sales_order]'");
													  
													  foreach($kond as $dd){  ?>
                                                    <tr>
                                                      <td>&nbsp;<?php echo $dd['delivery_date']?></td>
                                                      <td>&nbsp;<?php echo $dd['material_code']?></td>
                                                      <td>&nbsp;<?php echo ucfirst(strtolower($dd['nama_barang']))?></td>
                                                      <td>&nbsp;<?php echo $dd['so_qty']?></td>
                                                      <td>&nbsp;
													  <?php 
													  foreach($kond=$db->select("tx_rilis_dtl a 
													  left join tx_so_dtl aa on a.no_so=aa.sales_order and a.line_item=aa.line 
													  left join m_barang b on aa.id_barang=b.id_barang
													  left join m_satuan c on aa.id_satuan=c.id_satuan
													  ","sum(qty_do)as qty_do","sales_order='$d[sales_order]' and line_item='$dd[line]'")as $kk);
													  
													  
													  echo $kk['qty_do'];
													  
													  ?></td>
                                                      <td>&nbsp;<?php echo $dd['so_qty']-$kk['qty_do']?></td>
                                                      <td align="right">&nbsp;<?php echo $dd['price']?>&nbsp;</td>
                                                      <td align="center">&nbsp;<?php echo $dd['line']?></td>
                                                    </tr>
                                                    <?php }?>
                                                </table>
                                                <br>
                                                <?php 
												$kond=$db->select("tx_rilis_dtl a 
													  left join tx_so_dtl aa on a.no_so=aa.sales_order and a.line_item=aa.line 
													  left join m_barang b on aa.id_barang=b.id_barang
													  left join m_satuan c on aa.id_satuan=c.id_satuan
													  ","a.*,b.nama_barang,b.kode_barang_semen,c.nama_satuan","sales_order='$d[sales_order]'");
												$jum=count($kond);	
												if($jum>0){  
												?>
                                                
                                                <table width="100%">
                                                	<tr >
                                                	  <td colspan="9">&nbsp;SO Rilis</td>
                                               	  </tr>
                                                	<tr bgcolor="#F5F5F5">
                                                	  <td width="10%">&nbsp; Tgl Kirim</td>
                                                	  <td width="16%">&nbsp; Kode</td>
                                                	  <td width="20%">&nbsp; Item</td>
                                                    	<td width="10%">&nbsp; Qty DO</td>
                                                    	<td width="15%">&nbsp; No SPJ</td>
                                                    	<td width="10%">&nbsp;Tgl SPJ</td>
                                                    	<td width="10%">No SPPS</td>
                                                    	<td width="10%">&nbsp; Line</td>
                                                    	<td width="25%">&nbsp; Status</td>
                                                    </tr>
                                                    <?php
													  
													  foreach($kond as $dd){  ?>
                                                    <tr>
                                                      <td>&nbsp;<?php echo $dd['tgl_do']?></td>
                                                      <td>&nbsp;<?php echo $dd['kode_barang_semen']?></td>
                                                      <td>&nbsp;<?php echo ucfirst(strtolower($dd['nama_barang']))?></td>
                                                      <td>&nbsp;<?php echo $dd['qty_do']?></td>
                                                      <td>&nbsp;<?php echo $dd['no_spj']?></td>
                                                      <td>&nbsp;<?php echo $dd['tgl_spj']?></td>
                                                      <td align="left"><?php echo $dd['no_spps']?></td>
                                                      <td align="right">&nbsp;<?php echo $dd['line_item']?>&nbsp;</td>
                                                      <?php if($dd['status_tx']==1){?>
                                                      <td align="center" bgcolor="#FCFF8C">&nbsp;<b>Belum</b></td>
                                                      <?php }elseif($dd['status_tx']==2){?>
                                                      <td align="center" bgcolor="#96FCC9">&nbsp;<b>Diterima</b></td>
                                                      <?php }?>
                                                    </tr>
                                                    <?php }?>
                                                </table>
                                                <?php }?>
                                                
                                            </td>
                                          </tr>
                                          <?php 
										  $no++;
										  } 
										  ?>
                                        </table>
                                   </div>  
                                 </div>
                                  
					
					</div>	
                    
				</div>					
		</div>
        <div class="col-lg-1">
        </div>
</form>
