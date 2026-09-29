    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:2px;
			}
			.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
	</style>
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10">
		<form class="form-horizontal" action="index.php?x=bonus_v" name="formku" id="formku" method="post">
   		  <div class="panel panel-flat scrolls">
		    <div class="panel-heading">
						<h5 class="panel-title">Data Bonus Karyawan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Form Bonus" onClick="window.location='index.php?x=bonus'"></button></li>
							</ul>
                            </div>
                     </div>
            <div class="dataTables_wrapper ">
                    </div><br>
                    <div class="form-group">
					</div>
                   <?php include("bulantahun.php");?><input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData2(tahun.value,jenis.value)">
				   <a href='javascript:void(0)' onClick="posting()">
                        <input value="Posting" style="width:100px;" class="btn btn-info" readonly></a>
                   <button type="button" class=" btn btn-default btn-sm hidden" data-toggle="modal" id="klik" data-target="#dataabsen" ></button>
                   <button type="button" class=" btn btn-default btn-sm hidden" data-toggle="modal" id="klikall" data-target="#dataabsenall" ></button>
                   <br><br>
    	<?php 
		if($_GET['jen']==1 || $_GET['jen']==2 || $_GET['jen']==3 || $_GET['jen']==8){
			include("l_jenis.php");	
		}
		if($_GET['jen']==4){
			include("l_jenis4.php");	
		}
		if($_GET['jen']==5){
			include("l_jenis5.php");	
		}
		if($_GET['jen']==6){
			include("l_jenis6.php");	
		}
		?>
    	
            <input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   			<input type="hidden" name="sat_in" id="sat_in" required>
            <input type="hidden" name="jenisnya" id="jenisnya" required>
            <input type="hidden" name="th" id="th" value="<?=$_GET['tahun']?>" required>
            <input type="hidden" name="jenis1" value="<?=$_GET['jen']?>" required>
   		  </div>
			</form>
		</div>
<div id="dataabsen" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h6 class="modal-title">Detil Absensi</h6>
              </div>
              <div class="modal-body" id="hahaha">
              
                                              
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                  
              </div>
          </div>
      </div>
</div>
<div id="dataabsenall" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h6 class="modal-title">Detil Absensi</h6>
              </div>
              <div class="modal-body" id="hahahaall">
              
                                              
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                  
              </div>
          </div>
      </div>
</div>
<?php 
if($_POST['jenisnya']=='posting'){
	foreach($_POST['app'] as $key => $val){
		if($val!=""){
	$data = array( 
						'status' => 1,
						);
	$db->update("hr_bonus",$data,"id_pegawai='$val' and jenis='$_POST[jenis1]'");
		}
	}
	
	echo "<script>window.location='index.php?x=bonus_v&tahun=$_POST[th]&jen=$_POST[jenis1]'</script>";
}
?>