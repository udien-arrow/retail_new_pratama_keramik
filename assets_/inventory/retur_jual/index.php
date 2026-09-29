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
	include("assets/inventory/retur_jual/simpan2.php");	
}if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_retur_pen_tmp",$where);
	echo "<script>window.location='index.php?x=returpen&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_retur_pen_tmp",$where);
	echo "<script>window.location='index.php?x=returpen&id=$_POST[links]'</script>";
}else{
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=returpen_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Retur Penjualan" onClick="window.location='index.php?x=returpen_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-9">
                                    
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(id_stok.value)">
                                      <option value="">--- No SPJ - No Ref - TGL ---</option>
                                      <?php 
									  $gudang=$db->select("tx_do a left join m_customer b on a.id_cus_shipto=b.id_cus","*",
									  "no_spj NOT IN (SELECT no_ref FROM tx_retur_pen) and jenis_kirim!='DA'");
									  $exp=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_spj']."_".$val['no_ref']."_".$val['id_gudang']?>" <?php if($exp[0]==$val['no_spj']){echo "selected";}?>> <?=$val['no_spj']." - ".$val['no_ref']." - ".$val['tgl_spj']." - ".$val['nama_usaha']?></option> 
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
                            <tr>
                              	<th width="5%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                              	<th width="10%">Qty Diterima</th>
                                <th width="10%">Qty Dikembalikan</th>
                                <th width="10%">Keterangan</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="qty_kembali2" id="qty_kembali3"  value=""  placeholder='kembali' required>
                    <input type="hidden" name="qty_terima2" id="qty_terima3"  value=""  placeholder='diterima' required>
                    <input type="hidden" name="hpp2" id="hpp2"  value=""  placeholder='hpp' required>
                    <input type="hidden" name="satuan2" id="satuan2"  value=""  placeholder='satuan' required>
                    <input type="hidden" name="cus2" id="cus2"  value=""  placeholder='customer' required>
                    <input type="hidden" name="hargajual2" id="hargajual2"  value=""  placeholder='hargajual' required>
                    <input type="hidden" name="ket" id="ket"  value=""  placeholder='keterangan' required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>

                    
   		  </div>
			</form>
		</div>
         			
	 <div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Retur Penjualan
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=returpen" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
