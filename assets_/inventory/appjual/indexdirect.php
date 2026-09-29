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
    <div class="col-lg-2"></div>
         <form class="form-horizontal" action="index.php?x=appjual_d" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Direct Penjualan Antar Cabang</h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                		<li>
                                <button type="button" style="height:25px; line-height: 0;" class="btn btn-info" name="setuju" onClick="appsetuju3()">Simpan</button></li>
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=appjual'"></button></li>
							</ul>
              </div>
					</div>
                    
                    <div class="dataTables_wrapper"></div>
                  	<div class="panel-body">
                   				<div class="form-group">
                                        <label class="control-label col-lg-2"><b>No Sales Order</b></label>
										<div class="col-lg-4">
                                      	 <input type="text" class="form-control" value="<?php echo $_GET['id'];?>" name="nosales" readonly>
                     			 		</div>
                                </div>  
                                      
                                        
                                <?php
                                foreach($jum=$db->select("tx_sales_order a join m_customer b on a.id_cus_shipto=b.id_cus","a.ship_to,b.nama_usaha,a.id_cus,a.id_cus_shipto","a.no_sales='$_GET[id]'")as $vsb);
								?>
                                <div class="form-group">
                                        <label class="control-label col-lg-2"><b>Customer</b></label>
										<div class="col-lg-4">
                                      	 <input type="text" class="form-control" value="<?=$vsb['nama_usaha'].'-'.$vsb['ship_to']?>" readonly>
                     			 		</div>
                                </div>
                               <div class="form-group">
                                        <label class="control-label col-lg-2"><b>Direct Ke</b></label>
										<div class="col-lg-4">
                                      	 <select class="select-search" name="cabangto" id="cabangto" onChange="kenda(cust.value,nopol.value)" required >
                                          <?php
                                              $query=$db->select("m_cabang","*","id_cabang!='$_SESSION[ID_CABANG]'");
                                              foreach($query as $sel){	
                                          ?>
                                          <option value="<?=$sel['id_cabang']?>"><?=$sel['nama_cabang']?></option>
                                          <?php } ?>
                                      </select>
                                      <input type="hidden" name="no_so" value="<?=$_GET['id']?>">
                                      <input type="hidden" name="id_cus" value="<?=$vsb['id_cus']?>">
                                      <input type="hidden" name="id_cus_shipto" value="<?=$vsb['id_cus_shipto']?>">
                                      <input type="hidden" name="ship_to" value="<?=$vsb['ship_to']?>">
                                      <input type="hidden" name="jenis" id="jenis" value="">
                     			 		</div>
                                </div>
                                 <div class="form-group">
                                        <label class="control-label col-lg-2"><b></b></label>
										
                                
                                </div>
                                </div>
				  </div>	
                    
				</div>					
		</div>
</form>
<?php
if($_POST['jenis']=='setuju'){
		$data = array( 
							'no_sales' => $_POST['no_so'],
							'id_cabang' => $_SESSION['ID_CABANG'],
							'id_cabang_to' => $_POST['cabangto'],
							'id_cus' => $_POST['id_cus'],
							'id_cus_shipto' => $_POST['id_cus_shipto'],
							'ship_to' => $_POST['ship_to'],
							'status' => 0,
							'stampdate' => date("Y-m-d H:i:s"),
							'id_user' => $_SESSION['ID_LOGIN'],
							);
		$exec= $db->insert("tx_sales_direct", $data);
		echo "<script>window.location='index.php?x=appjual'</script>";	
}

?>
