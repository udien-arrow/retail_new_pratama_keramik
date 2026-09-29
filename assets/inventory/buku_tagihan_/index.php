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
	include("assets/inventory/buku_tagihan/simpan2.php");	
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_buku_tagihan_tmp",$where);
	echo "<script>window.location='index.php?x=bukta'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_buku_tagihan_tmp",$where);
	echo "<script>window.location='index.php?x=bukta'</script>";

}else{
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=bukta_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View <?=$title?>" onClick="window.location='index.php?x=bukta_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                      </tr>
                            <tr>
                              	<th width="20%">Pelanggan</th>
                                <th width="20%">NO FJ</th>
                                <th width="20%">NO SPJ</th>
                                <th width="10%">Tempo Normal</th>
                                <th width="10%">Tempo Tambahan</th>
                              	<th width="5%">Total Piutang</th>
                                <th width="10%" align="center"> <a href='javascript:void(0)'  onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="totalpiutang2" id="totalpiutang2"  value=""  placeholder='piutang' required>
                    <input type="hidden" name="idcus2" id="idcus2"  value=""  placeholder='cus2' required>
                    <input type="hidden" name="tempo_normal2" id="tempo_normal2"  value=""  placeholder='tempo nor' required>
                    <input type="hidden" name="tempo_tambahan2" id="tempo_tambahan2"  value=""  placeholder='tempo tam' required>
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
                          <form class="form-horizontal" action="index.php?x=bukta" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>

<div id="databg" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Buku BG</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>
<?php }?>
