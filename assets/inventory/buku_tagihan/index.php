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
	 <div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Faktur <?=$title?>
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    
                    	<div class="table-responsive pre-scrollable">
                   		<div class="panel-body">
                    		<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=bukta_ss" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         	</div>	
						</div>		
                    	</div>			
					</div>
                 </div> 
       </div>  
        <div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">List <?=$title?>
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    
                    	<div class="table-responsive pre-scrollable">
                   		<div class="panel-body">
                    		<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=bukta_s" name="formku2" id="formku2" method="post">
                            <?php include("keranjang2.php"); ?>
                          </form>
                         	</div>	
						</div>		
                    	</div>			
					</div>
                 </div> 
       </div>  
       
 <?php
 if($_GET['bat']=='ok'){
	 	$where = array(  
					'id_user' => $_SESSION['ID_LOGIN'], 
				 );
							  
		$execjur= $db->delete("tx_piutang_tmp", $where);
	 	echo "<script>window.location='index.php?x=bukta';</script>";
 }
 ?>      