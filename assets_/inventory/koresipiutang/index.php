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
	include("assets/inventory/koresipiutang/simpan2.php");	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_koreksi_piutang_tmp",$where);
	echo "<script>window.location='index.php?x=korpi&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_koreksi_piutang_tmp",$where);
	echo "<script>window.location='index.php?x=korpi&id=$_POST[links]'</script>";

}else{
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=korpi_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Koreksi Harga" onClick="window.location='index.php?x=korpi_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-3">
                                  	 <select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value,id_stok.value)">
                                     	<option value="">--pilih--</option>
                                        <option value="0" <?php if($_GET['jen']==0){echo 'selected';}?>>Bulan Berjalan</option>
                                        <option value="1" <?php if($_GET['jen']==1){echo 'selected';}?>>Bulan Lalu</option>
                                     </select>
                                  </div>
                                  <div class="col-lg-7">
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(jenis.value,id_stok.value)">
                                      <option value="">--- No Faktur Jual ---</option>
                                      <?php 
									  $gudang=$db->select("tx_piutang a left join m_customer b on a.id_cus=b.id_cus","a.*,b.nama_usaha,a.status_bayar","b.id_cabang='$_SESSION[ID_CABANG]' and a.status='1' and ifnull(no_ref,'') NOT IN (SELECT ifnull(no_ref,'') FROM tx_koreksi_piutang) and a.jenis is null");
									  foreach($gudang as $val){
									  $s=explode("_",$_GET['id']);
									  if($val[status_bayar]==0){
										$st='Belum Lunas';  
									  }if($val[status_bayar]==1){
										$st='Lunas';  
									  }
									  ?>
                                      <option value="<?=$val['no_faktur_jual'].'_'.$val['no_ref']?>" <?php if($s[0]==$val['no_faktur_jual']){echo "selected";}?>> <?=$val['nama_usaha'].' - '.$val['no_faktur_jual'].' - '.$val['tgl'].' - '.$st?></option> 
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
                              	<th width="10%">Harga</th>
                                <th width="10%">Di Ganti</th>
                                <th width="10%">Keterangan</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="hargaasli2" id="hargaasli2"  value=""  placeholder='hargaasli' required>
                    <input type="hidden" name="ganti2" id="ganti2"  value=""  placeholder='ganti' required>
                    <input type="hidden" name="ket" id="ket"  value=""  placeholder='keterangan' required>
                    <input type="hidden" name="qty2" id="qty2"  value=""  placeholder='qty' required>
                    <input type="hidden" name="hpp2" id="hpp2"  value=""  placeholder='hpp' required>
                    <input type="hidden" name="sat2" id="sat2"  value=""  placeholder='satuan' required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>
     
   		  </div>
			</form>
		</div>  			
	 <div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Koreksi Harga Jual
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=korpi" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
