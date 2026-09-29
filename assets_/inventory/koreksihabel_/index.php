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
	include("assets/inventory/koreksihabel/simpan2.php"); 	
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_koreksi_habel_tmp",$where);
	echo "<script>window.location='index.php?x=korhabel&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_koreksi_habel",$where);
	echo "<script>window.location='index.php?x=korhabel&id=$_POST[links]'</script>";

}else{
?>	
	
    <div class="col-lg-6">
		<form action="index.php?x=korhabel_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Koreksi Harga Beli" onClick="window.location='index.php?x=korhabel_v'"></button></li>
							</ul>
                            </div>
					</div>
                    <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                          <div class="col-lg-8">
                            <select name="id_stok" id="id_stok" class="select-minimum" onChange="pindahData(id_stok.value)">
                                      <option value="">--- No Masuk ---</option>
                                      <?php 
									  foreach($db->select("tx_koreksi_habel_tmp group by no_im","no_im")as $cekk);
									  if($cekk['no_im']==''){
									  		$tm="";
									  }else{
										  	$tm=" and $cekk[no_im]";
									  }
									  
									  $gudang=$db->select("tx_brg_masuk a left join m_supplier b on a.id_supp=b.id_supp","*","a.jenis in ('1','2','5') and a.no_masuk not in(select no_ref from tx_koreksi_habel) and left(a.no_masuk,2)='IM' and a.surat_jalan not in (select no_spj from tx_order_tagihan_bayar) $tm order by tgl desc");
									  $s=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									 
									  ?>
                                      <option value="<?=$val['no_masuk'].'_'.$val['no_ref']?>" <?php if($s[0]==$val['no_masuk']){echo "selected";}?>> <?=$val['nama_usaha'].' - '.$val['no_masuk'].' - '.$val['tgl'].$st?></option> 
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
                                <th width="5%"><!-- <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>--></th>
                            </tr>
                        </thead>

                    </table>
					<input type="hidden" name="id" id="id"  value="" placeholder='id' required>          
                    <input type="hidden" name="qty2" id="qty2"  value=""  placeholder='qty' required>
                     <input type="hidden" name="satuan2" id="satuan2"  value=""  placeholder='satuan' required>     
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="hargaasli22" id="hargaasli22"  value=""  placeholder='' required>
                    <input type="hidden" name="ganti22" id="ganti22"  value=""  placeholder='' required>
                    <input type="hidden" name="ket2" id="ket2"  value=""  placeholder='keterangan' required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>

                    
   		  </div>
			</form>
		</div>
         			
	 <div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Koreksi Harga Beli
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=korhabel" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
