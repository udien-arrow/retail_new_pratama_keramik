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
	include("assets/inventory/koresipiutang2/simpan2.php");	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_koreksi_tmp",$where);
	echo "<script>window.location='index.php?x=korpiutang&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_koreksi_tmp",$where);
	echo "<script>window.location='index.php?x=korpiutang&id=$_POST[links]'</script>";

}else{
?>	
	
    <div class="col-lg-6">
		<form action="index.php?x=korpiutang_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Koreksi Piutang" onClick="window.location='index.php?x=korpiutang_v'"></button></li>
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
                                        <option value="0" <?php if($_GET['jen']=='0'){echo 'selected';}?>>Bulan Berjalan</option>
                                        <option value="1" <?php if($_GET['jen']=='1'){echo 'selected';}?>>Bulan Lalu</option>
                                     </select>
                                  </div>
                                  <div class="col-lg-7">
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(jenis.value,id_stok.value)">
                                      <option value="">--- No Faktur Jual ---</option>
                                      <?php 
									  $ks=date("m");
									  if($_GET['jen']!=''){
									  if($_GET['jen']=='0'){
										  $k="a.jenis_kirim!='DA' and a.status='1' and no_ref NOT IN (SELECT no_ref FROM tx_koreksi) AND SUBSTR(a.tgl,6,2)='$ks' and a.jenis is null ORDER BY stampdate DESC";
									  }elseif($_GET['jen']=='1'){
										   $k="a.jenis_kirim!='DA' and a.status='1' and no_ref NOT IN (SELECT no_ref FROM tx_koreksi) AND SUBSTR(a.tgl,6,2)<>'$ks' and a.jenis is null ORDER BY stampdate DESC";
									  }
									  $gudang=$db->select("tx_piutang a left join m_customer b on a.id_cus=b.id_cus","a.*,b.nama_usaha,a.status_bayar",$k);
									  foreach($gudang as $val){
									  $s=explode("_",$_GET['id']);
									  if($val[status_bayar]==0){
										$st='Belum Lunas';  
									  }if($val[status_bayar]==1){
										$st='Lunas';  
									  }
									  ?>
                                      <option value="<?=$val['no_faktur_jual'].'_'.$val['no_ref']?>" <?php if($s[0]==$val['no_faktur_jual']){echo "selected";}?>> <?=$val['nama_usaha'].' - '.$val['no_faktur_jual'].' - '.$val['tgl'].' - '.$st?></option> 
                                     <?php } } ?>
                                     
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
                              	<th width="5%">No Faktur</th>
                                <th width="20%">No SPJ </th>
                                <th width="10%">Tgl SPJ</th>
                              	<th width="10%">Total Piutang</th>
                                <th width="10%">Di Ganti</th>
                                <th width="10%">Keterangan</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>
                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
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
						<h5 class="panel-title">Keranjang Koreksi Piutang Jual
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=korpiutang" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
