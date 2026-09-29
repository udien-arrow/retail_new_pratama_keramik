    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
		.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
	</style>
<?php
if($_POST[simpannya]){
	include("assets/inventory/bukubg/simpan2.php");	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_buku_bg_tmp",$where);
	echo "<script>window.location='index.php?x=bukubg&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_buku_bg_tmp",$where);
	echo "<script>window.location='index.php?x=bukubg&id=$_POST[links]'</script>";

}else{
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=bukubg_s" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Buku BG" onClick="window.location='index.php?x=bukubg_v'"></button></li>
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
                                      <option value="">--- NO TK - TGL ---</option>
                                      <?php 
									  $gudang=$db->select("tx_tagihan_kembali","*","status='0'");
									  $exp=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_ta']?>" <?php if($_GET['id']==$val['no_ta']){echo "selected";}?>> <?=$val['no_ta']." - ".$val['tgl']?></option> 
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
                              	<th width="5%">Nama Usaha</th>
                                <th width="20%">No SPJ</th>
                                <th width="10%">No FJ</th>
                                <th width="10%">No Seri BG</th>
                              	<th width="10%">Dibayar</th>
                                <th width="10%">Bank BG</th>
                                <th width="10%">Jatuh Tempo</th>
                                <th width="5%">Jenis BG</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="jenisbg2" id="jenisbg2"  value=""  placeholder='jenisbg' required>
                    <input type="hidden" name="gab2" id="gab2"  value=""  placeholder='gab' required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>

                    
   		  </div>
			</form>
		</div>
         			
	 <div class="col-lg-5">
               <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Tagihan Kembali
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body scrolls">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=bukubg" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
