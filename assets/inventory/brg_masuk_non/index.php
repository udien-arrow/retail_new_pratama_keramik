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
<?php
if($_POST[simpan]){
	include("assets/inventory/brg_masuk_non/simpan2.php");	
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_brg_masuk_tmp",$where);
	echo "<script>window.location='index.php?x=brgmasuknon&id=$_POST[idlink]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_brg_masuk_tmp",$where);
	echo "<script>window.location='index.php?x=brgmasuknon&id=$_POST[idlink]'</script>";

}else{
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=brgmasuknon_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Penerimaan Barang Non Dagang" onClick="window.location='index.php?x=brgmasuknon_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-8">
                                    
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(id_stok.value)">
                                      <option value="">---No Order---</option>
                                      <?php 
									  $gudang=$db->select("tx_order a left join m_gudang b on a.id_gudang=b.id_gudang","*","a.status='0' and id_user='$_SESSION[ID_LOGIN]'");
									 $exp=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_order']."_".$val['id_gudang']."_".$val['jenis']?>" <?php if($exp[0]==$val['no_order']){echo "selected";}?>> <?=$val['no_order']." - ".$val['nama_gudang']." - ".$val['tgl']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-1">
                                    </select>
                                    </div>
                      </div>
                      </td>
                      </tr>
                      <?php if($exp[2]==5){ ?>
                            <tr>
                              	<th width="5%">Kode</th>
                                <th width="15%">Nama Barang</th>
                                <th width="5%">#</th>
                              	<th width="10%">Qty Order</th>
                                <th width="10%">Qty Beli</th>
                                <th width="10%">Harga Order</th>
                                <th width="10%">Harga Beli</th>
                                <th width="10%">No SN</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                            
                         <?php }else{ ?>
                         <tr>
                              	<th width="5%">Kode</th>
                                <th width="15%">Nama Barang</th>
                                <th width="5%">#</th>
                              	<th width="10%">Qty Order</th>
                                <th width="10%">Qty Beli</th>
                                <th width="10%">Harga Order</th>
                                <th width="10%">Harga Beli</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                            <?php } ?>
                         
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="qty_order2" id="qty_order2"  value=""  placeholder='order' required>
                    <input type="hidden" name="qty_terima2" id="qty_terima2"  value=""  placeholder='beli' required>
                    <input type="hidden" name="hpp2" id="hpp2"  value=""  placeholder='hpp' required>
                    <input type="hidden" name="satuan2" id="satuan2"  value=""  placeholder='satuan' required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>

                    
   		  </div>
			</form>
		</div>
         			
	 <div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Penerimaan Barang
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=brgmasuknon" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
