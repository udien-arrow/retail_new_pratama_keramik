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
	include("assets/inventory/tx_expediture/simpan2.php");	
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("ex_expediture_tmp",$where);
	echo "<script>window.location='index.php?x=txex&id=$_POST[links]&so=$_POST[nos]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("ex_expediture_tmp",$where);
	echo "<script>window.location='index.php?x=txex&id=$_POST[links]&so=$_POST[nos]'</script>";

}else{
?>	
<form class="form-horizontal" action="index.php?x=txex_ss" name="formku1" id="formku1" method="post" onSubmit="return(validate_frm())"  enctype="multipart/form-data">
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<br>
                  <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp; Supplier</label>
                            
                             <div class="col-lg-2">
                                    <select name="supp" id="supp" class="select-search" onChange="pindahData3(jenis.value,spb.value,supp.value)">
										<?php 
								  $date=date("Y-m-d");
									   $gudang=$db->select("(select * from ex_tarif_oa order by tgl_berlaku desc) as aku join m_supplier c on aku.id_supp=c.id_supp group by aku.id_supp","aku.*,nama_usaha");
									  foreach($gudang as $val){
									  ?>
                                  <option value="<?=$val['id_supp']?>" <?php if($_GET[supp]==$val['id_supp']){echo "selected";}?>>
                                    <?=$val['nama_usaha']?>
                                  </option>
                                  <?php } ?>
									</select>
                                    </div> 
                             <div class="col-lg-4">
                                 <input type="file" name="file" id="file" size="150"  class="file-input" data-show-preview="false">
                               </div>
                               
                               <div class="col-lg-3">
                                 Contoh Upload :<a href="assets/inventory/tx_expediture/up_tagihan_expediture_sem.csv" ><img id="expxls" name="expxls" src="assets/inventory/up_so/excel.png" alt="" width="22" height="22" border="0"  title="Type file Semen.csv"/></a>
                              </div>  
                    </div>
				</div>					
		</div>
</form>  
    <div class="col-lg-7">
		<form action="index.php?x=txex_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View <?=$title?>" onClick="window.location='index.php?x=txex_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-3">
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(id_stok.value)">
                                      <option value="">---Supplier ---</option>
                                      <?php 
									  $date=date("Y-m-d");
									  $gudang=$db->select("(select * from ex_tarif_oa order by tgl_berlaku desc) as aku join m_supplier c on aku.id_supp=c.id_supp group by aku.id_supp","aku.*,nama_usaha");
									 $exp=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['id']."_".$val['id_supp']?>" <?php if($exp[0]==$val['id']){echo "selected";}?>> <?=$val['nama_usaha']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    <div class="col-lg-3">
                                    <select name="so" id="so" class="select-search" onChange="pindahData2(id_stok.value,so.value)">
                                      <option value="">---NO SO---</option>
                                      <?php 
									  $s=explode("_",$_GET['id']);
									  $gudang=$db->select("v_spj_rilis","*","id_supp='$s[1]' and no_so NOT IN (select no_so from ex_expediture) group by no_so");
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_so']?>" <?php if($_GET['so']==$val['no_so']){echo "selected";}?>> <?=$val['no_so']?></option> 
                                      <?php } ?>
                                      <?php 
									  $gudang=$db->select("tx_po","no_jwa","id_supp='$s[1]' and no_jwa NOT IN (select no_so from ex_expediture) group by no_jwa");
									 // $gudang=$db->select("tx_po","no_jwa","id_supp='$s[1]'");
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_jwa']?>" <?php if($_GET['so']==$val['no_jwa']){echo "selected";}?>> <?=$val['no_jwa']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    
                                    <?php 
									$ce=$db->select("tx_po","*","no_jwa='$_GET[so]'");
									foreach($ce as $cek){}
									$gud=$db->select("m_gudang_shipto a join m_gudang b on a.id_gudang=b.id_gudang","*","a.shipto_code='$cek[shipto_code]'");
									foreach($gud as $guds){}
									?>
                                    
                                     <div class="col-lg-3">
                                    <select name="tujuan" id="tujuan" class="select-search">
                                      <option value="">--- Tujuan ---</option>
                                      <?php 
									  $s=explode("_",$_GET['id']);
									   $gudang=$db->select("(select * from ex_tarif_oa order by tgl_berlaku desc) as aku join ex_lokasi_kirim b on aku.id_lokasi=b.id","aku.*,b.lokasi_kirim,b.kota","aku.status='1' group by aku.id_supp");
									  foreach($gudang as $val){
									 
									  ?>
                                      <option value="<?=$val['id']?>" <?php if($guds['id_cabang']==$val['kota']){echo "selected";} ?>> <?=$val['lokasi_kirim']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                     <div class="col-lg-3">
                                    <select name="nopol" id="nopol" class="select-search">
                                      <option value="">--- NOPOL ---</option>
                                      <?php 
									  $gudang=$db->select("m_kendaraan","*","jenis_angkutan='1'");
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['id']?>"> <?=$val['nopol']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    
                      </div>
                      
                      </td>
                      
                      </tr>
                            <tr>
                              	<th width="5%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                              	<th width="10%">Qty</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="qty_kembali2" id="qty_kembali2"  value=""  placeholder='kembali' required>
                    <input type="hidden" name="qty_terima2" id="qty_terima2"  value=""  placeholder='diterima' required>
                    <input type="hidden" name="hpp2" id="hpp2"  value=""  placeholder='hpp' required>
                    <input type="hidden" name="satuan2" id="satuan2"  value=""  placeholder='satuan' required>
                    <input type="hidden" name="sup2" id="sup2"  value=""  placeholder='suplier' required>
                    <input type="hidden" name="hargabeli2" id="hargabeli2"  value=""  placeholder='hargabeli' required>
                    <input type="hidden" name="id_gudang" id="id_gudang"  value=""  placeholder='gudang' required>
                    <input type="hidden" name="ket" id="ket"  value=""  placeholder='keterangan' required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>

                    
   		  </div>
			</form>
		</div>
         			
	 <div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang <?=$title?>
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=txex" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
<?php 
if($_POST['delnot']){
	$where = array("status" => 1);
	$db->delete("ex_expediture_notif",$where);
}
?>
