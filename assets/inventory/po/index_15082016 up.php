    <!-- Theme JS files -->
	<style>
			.table2 {
				border-collapse: collapse;
			}
			.ck, td, th {
				.border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
 <form class="form-horizontal" action="index.php?x=po_ss" name="formku" id="formku" method="post" onSubmit="return(validate_frm())"  enctype="multipart/form-data">
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<br>
                  <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp; Supplier</label>
                            
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
                             <div class="col-lg-4">
                                 <input type="file" name="file" id="file" size="150"  class="file-input" data-show-preview="false">
                               </div>
                               
                               <div class="col-lg-3">
                                 Contoh Upload :<a href="assets/inventory/po/so_rilis_tripilar.csv" ><img id="expxls" name="expxls" src="assets/inventory/up_so/excel.png" alt="" width="22" height="22" border="0"  title="Type file Non Semen.csv"/></a>
                              </div>  
                    </div>
				</div>					
		</div>
</form>   
    <div class="col-lg-6">
		<form action="index.php?x=po" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Pembelian</h5> 
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <td width="10%">No PO</td>
                                <td width="10%">No PRP</td>
                                <td width="25%">Kepada</td>
                                <td width="10%">Tanggal</td>
                                <td width="30%">Kirim Ke</td>
                                <td width="15%">#</td>
                            </tr>
                        </thead>
                    </table>                    
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>	
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=po" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Pembelian</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
                   
				    $exp=explode("/",$_GET['id']);
					//$periode="_".intval(substr($exp[2],4,2)).substr($exp[2],0,4);
						$kon=$db->select("tx_po a 
						left join m_supplier b on a.id_supp=b.id_supp
						left join m_gudang c on a.id_gudang=c.id_gudang","a.*,b.pkp,b.nama_supp,b.nama_usaha,c.nama_gudang,c.alamat,a.no_so","a.no_po='$_GET[id]'");	
						foreach($kon as $konval){}
						 $exp=explode("/",$konval['no_prp']);
						$periode="_".intval(substr($exp[2],4,2)).substr($exp[2],0,4);
							
					if($konval['jenis_p']==1){		
					?>
				  <div class="panel-body">
                   				<div class="form-group">
                               		<?php
										include("keranjang_v.php");
									?> 
                                </div>
				  </div>	
                  <?php }
                  if($konval['jenis_p']==3){		
					?>
				  <div class="panel-body">
                   				<div class="form-group">
                               		<?php
										include("keranjang_v_semen.php");
									?> 
                                </div>
				  </div>
                  <?php }
				  ?>
				</div>	
                <?php if($konval['jenis_p']==3){	?>
                <div class="panel panel-flat">
                <div class="panel-heading">
						<h5 class="panel-title">Sales Order <?php echo " : ".$konval['no_so']?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
               	 <div class="panel-body">
                   				<div class="form-group">
                               		<?php
										include("keranjang_v_sales.php");
									?> 
                                </div>
				  	</div>					
                  </div>
                  <?php }?>
		</div>
</form>
<?php
if($_POST['simpana']){
	$data = array("no_so" => $_POST['so']);
	$db->update("tx_po",$data,"no_po='$_POST[po]'");
	echo "<script>window.location='index.php?x=po'</script>";
}

if($_POST['delnot']){
	$where = array("status" => 1);
	$db->delete("tx_po_notif",$where);
}
?>


