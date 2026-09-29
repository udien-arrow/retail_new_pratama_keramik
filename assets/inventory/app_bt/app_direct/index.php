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
    <!--<div class="col-lg-1">
    </div>-->
    <div class="col-lg-6">
		<form action="index.php?x=app_swda" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Approve Penjualan Direct Cabang</h5>

					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                        
                          <tr>
                                <td width="15%">No Sales</td>
                                <td width="10%">Tgl</td>
                              	<td width="10%"> Pelanggan</td>
                                <td width="10%">Cabang</td>
                                <td width="20%">Cabang Direct</td>
                                <td width="25%">Shipto </td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>   
                   
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app_direct" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Penjualan</h5>
                        <?php
										  $no=1;
                                          foreach($kon as $d){
											  
											$bln=date("m");
											$thn=date("Y");
											$mutasi=$db->cek_mutasi($d['id_barang'],$_GET['gud']);
											if($mutasi['akhir']==''){
												$mutasi['akhir']=0;
											}else{
												$mutasi['akhir']=$mutasi['akhir'];
												}
										  }
										  if($d['qty']>=$mutasi['akhir']){
										  ?>
                        <button type="button" style="height:25px; line-height: 0;float:right" class="btn btn-info btn-sm" name="setuju" onClick="appsetuju()">Setuju</button>&nbsp;
                        <?php }else{ 
						echo "<p align='right'>Maaf Melebihi Stok !!!</p>";
						}?>
                   <button type="button" style="height:25px; line-height: 0;float:right" class="btn btn-danger btn-sm" name="tolak" onClick="apptolak()">Tolak</button>
					</div>
                    <div class="dataTables_wrapper"></div>
               	  <?php
                   	$kon=$db->select("tx_sales_order az
								JOIN tx_sales_order_dtl a ON az.no_sales = a.no_sales
								JOIN m_barang_gudang b ON a.id_barang = b.id_barang
								AND az.id_gudang = b.id_gudang
								JOIN m_satuan c ON a.id_satuan = c.id_satuan
								join m_customer d on az.id_cus=d.id_cus
								","a.qty,
								b.nama_barang,
								a.harga,
								c.nama_satuan,
								d.nama_usaha,
								a.no_sales,b.id_barang","az.no_sales='$_GET[id]'");				
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
                                            <td align="center"><strong>Harga</strong></td>
                                            <td align="center"><strong>Qty</strong></td>
                                            <td align="center"><strong>Stock</strong></td>
                                          </tr>
                                          <?php
										  $no=1;
                                          foreach($kon as $d){
											  
											$bln=date("m");
											$thn=date("Y");
											$mutasi=$db->cek_mutasi($d['id_barang'],$_GET['gud']);
											if($mutasi['akhir']==''){
												$mutasi['akhir']=0;
											}else{
												$mutasi['akhir']=$mutasi['akhir'];
												}
											
										  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['nama_barang'];?>&nbsp;</td>
                                            <td align="left">&nbsp;
                                            <?=$d['nama_satuan']?></td>
                                            <td align="right">&nbsp;<?=number_format($d['harga'])?></td>
                                            <td align="right"><?=number_format($d['qty'])?>                                              &nbsp;</td>
                                            <td align="right"><?=number_format($mutasi['akhir'])?>&nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                         
                               </div>
                               <div class="form-group">
                               		<label class="control-label col-lg-2"></label>
                               </div>
                               <div class="form-group">
                               <input type="hidden" id="link" value="<?=$_GET['id']?>">
                               		<label class="control-label col-lg-2">Gudang</label>
                                     <div class="col-lg-4">
                                     	<select name="gudang" id="gudang" class="select-search" onChange="gud(gudang.value)">
                                        <option value="">Pilih Gudang</option>
										<?php
											$query=$db->select("m_gudang","id_gudang,nama_gudang","id_cabang='$_SESSION[ID_CABANG]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_gudang']?>" <?php if($_GET['gud']==$sel['id_gudang']){echo "selected";} ?>><?=$sel['nama_gudang']?></option>
                                        
                                        <?php }?>    
									</select>
        <input type="hidden" name="jenisnya" id="jenisnya"  value=""  required>
        <input type="hidden" name="id" id="id"  value="<?=$_GET['id']?>"  required>
       

                                     </div>
                               
                               </div>   
					
				  </div>	
                    
				</div>					
		</div>
</form>
<?php
if($_POST['jenisnya']=='setuju'){
	//============rilis=========
	$data = array("status" => 1);
	$db->update("tx_sales_direct",$data,"no_sales='$_POST[id]'");
	
	$data = array(
			"status_so" => 1,
			"id_cabang_direct" => $_SESSION['ID_CABANG'],
			"id_gudang" => $_POST['gudang']
			);
	$db->update("tx_sales_order",$data,"no_sales='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 15,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_direct'</script>";
}
if($_POST['jenisnya']=='tolak'){
	$data = array("no_sales" => $_POST['id']);
	$db->delete("tx_sales_direct",$data);
	
	/*$data = array("status_so" => 0);
	$db->update("tx_sales_order",$data,"no_sales='$_POST[id]'");*/
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 15,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_direct'</script>";
}
?>