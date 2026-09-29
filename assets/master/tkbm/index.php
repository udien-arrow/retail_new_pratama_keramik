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
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_brg_keluar_tmp",$where);
	
	echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_brg_keluar_tmp",$where);
	echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[links]'</script>";

}else{
?>	
	<div class="col-lg-2">
    </div>
    <div class="col-lg-8">
		<form action="index.php?x=tkbm_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="8">
                        <div class="form-group" >
                                   <div class="col-lg-4">
                                    <select name="cab" id="cab" class="select-search" onChange="pindahData2(cab.value)">
                                      <option value="">--- Cabang ---</option>
                                      <?php 
									  if($_GET['kod']!=""){
										 $gudang=$db->select("m_cabang","*");
										  }else{
									   $gudang=$db->select("m_cabang","*");
									  }
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['id_cabang']?>" <?php if($_GET['cabang']==$val['id_cabang']){echo "selected";}?>> <?=$val['nama_cabang']?></option> 
                                     <?php } ?>
                                    </select>
                                   </div>
                                   <div class="col-lg-4">
                                    <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                     
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
                                <th width="5%">Biaya Bongkar (kg)</th>
                                <th width="5%">Biaya Muat (kg)</th>
                                <th width="5%">Biaya POK (kg)</th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>
                    <input type="hidden" name="cabangs" id="cabangs"  value="<?=$_GET['cabang']?>" required>
                    <input type="hidden" name="kod" id="kod"  value="<?=$_GET['kod']?>" required>

                    
   		  </div>
			</form>
		</div>
   </form>
<?php }?>
