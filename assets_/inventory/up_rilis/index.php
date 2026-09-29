
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
	 <form class="form-horizontal" action="index.php?x=up_rilis_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())"  enctype="multipart/form-data">
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<br>
                  <div class="form-group">
							<label class="control-label col-lg-1">&nbsp;&nbsp;&nbsp;Filter</label>
                             <div class="col-lg-1">
                              <select name="st_upload" id="st_upload" class="select">
                                      <option value="1">Semen</option>
                                      <!--<option value="2">Non Semen</option>-->
                              </select>
                             </div>
                             <div class="col-lg-2">
                                    <select name="supp" id="supp" class="select-search" onChange="pindahData3(jenis.value,spb.value,supp.value)">
										<?php
											$query=$db->select("m_supplier","id_supp,nama_supp,nama_usaha,id_valuta");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_supp']?>" <?php if($sel['id_supp']==$_GET['supp']){echo "selected";}?>><?=$sel['nama_usaha']?></option>
                                        
                                        <?php 
											if($_GET['supp']==$sel['id_supp']){
												$valu=$sel['id_valuta'];
											}
										}
										
										
										?>    
									</select>
                                    
                                    </div> 
                             
                             <div class="col-lg-3">
                                 <input type="file" name="file" id="file" size="150"  class="file-input" data-show-preview="false">
                               </div>
                               
                               <div class="col-lg-3">
                                 Contoh Upload :<a href="assets/inventory/up_so/so_rilis_update.csv" ><img id="expxls" name="expxls" src="assets/inventory/up_so/excel.png" alt="" width="22" height="22" border="0"  title="Type file Semen.csv"/></a>
                                 <a href="assets/inventory/up_rilis/so_rilis_update_non.csv" ><img id="expxls" name="expxls" src="assets/inventory/up_so/excel.png" alt="" width="22" height="22" border="0"  title="Type file Non Semen.csv"/></a>
                              </div>
                               <div class="col-lg-2">
                             <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin Memposting Jurnal??')" name="posting" value="posting">
										 Posting Jurnal 
                             </button>       
                              </div>       
                               
                    </div>
					
				</div>					
		</div>
</form>
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
						<h5 class="panel-title">View Data Rilis</h5>
                     </div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <td width="10%">No Sales</td>
                              	<td width="10%">Tgl SO</td>
                                <td width="5%">Jenis Kirim</td>
                                <td width="20%">Distrik</td>
                                <td width="20%">Shipto</td>
                                <td width="15%">Supplier</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
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
						<h5 class="panel-title">View Detil Rilis</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                  	<?php
                   		$kon=$db->select("tx_rilis_dtl a 
										  left join tx_so_dtl b on b.sales_order=a.no_so and a.line_item=b.line
										  left join m_barang d on b.id_barang=d.id_barang
										  left join m_satuan c on b.id_satuan=c.id_satuan
										   ","*","a.no_so='$_GET[id]'");				
					?>
				  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No SO</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                  
                                </div>
                                
                               
                                <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>Nama Barang</strong></td>
                                            <td align="center"><strong>#</strong></td>
                                            <td align="center"><strong>Tgl Kirim</strong></td>
                                            <td align="center"><strong>Harga</strong></td>
                                            <td align="center"><strong>No SPJ</strong></td>
                                            <td align="center"><strong>Qty DO</strong></td>
                                          </tr>
                                          <?php
										  
                                          
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['nama_barang'];?>&nbsp;</td>
                                            <td align="left">&nbsp;<?=$d['nama_satuan']?>&nbsp;</td>
                                            <td align="left">&nbsp;<?=$d['tgl_do']?>&nbsp;</td>
                                            <td align="right">&nbsp;<?=number_format($d['price'])?>&nbsp;</td>
                                            <td align="right">&nbsp;<?=$d['no_spj']?>&nbsp;</td>
                                            <td align="right">&nbsp;<?=number_format($d['qty_do'])?>&nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                           
                                        
                                      
                                     
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
<?php
if($_POST['delnot']){
	$where = array("status" => 1);
	$db->delete("tx_rilis_notif",$where);
}
?>
