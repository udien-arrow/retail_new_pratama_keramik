    <!-- Theme JS files -->
	<style>
			.tables, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			table, tr, td {
			border: none;
		}
	</style>
    <div class="col-lg-6">
		<form action="index.php?x=appdo" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title;?></h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <td width="15%">No DO</td>
                                <td width="10%">Tanggal</td>
                                <td width="10%">Keterangan</td>
                                <td width="10%">#</td>
                            </tr>
                        </thead>

                    </table>   
                                    
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=appdo" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Delivery Order</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                                      <div class="form-group">
					<?php
                    $supp=$db->select("v_do_v","*","no_do='$_GET[id]'");
                    foreach($supp as $valsupp){}
					?>
                                              <table width=300px" cellspacing="0" cellpadding="0">
                        <tr>
                                             <td><b>No DO</b></td>
                                             <td><b>: <?=$valsupp['no_do']?></b></td>
                                        
                                      
                        </tr>
                        <tr>
                                             <td><b>No SPJ</b></td>
                                             <td><b>: <?=$valsupp['no_spj']?></b></td>
                                        
                                      
                        </tr>
                        <tr>
                                             <td><b>Gudang</b></td>
                                             <td><b>: <?=$valsupp['nama_gudang']?></b></td>
                                        
                                      
                          </tr>
                                            <td><b>Tgl </b></td>
                                            <td> <b>: <?=$valsupp['tgl_do']?></b></td>
                          </tr>
                          </tr>
                                            <td><b>Jenis Kendaraan </b></td>
                                            <td> <b>: <?=$valsupp['nama']?></b></td>
                          </tr>
                          </table>
                                  
                                </div>
                                <div class="form-group">
                               			 <?php
											include("keranjang_v.php");
											?> 
                                
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
<?php
if($_POST['jenis']=='setuju'){
	$tabel = "tx_do";
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 8,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	$updates = array( 
				'status_do' => 1,
				);
	$exc= $db->update($tabel,$updates,"no_do='$_POST[id]'");
	$supp=$db->select("tx_do","*","no_do='$_POST[id]'");
	foreach($supp as $valsupp){}
	$update = array( 
				'status_so' => 5,
				);
	$exc= $db->update("tx_sales_order",$update,"no_sales='$valsupp[no_reff]'");
	echo "<script>window.location='index.php?x=appdo'</script>";
}
if($_POST['jenis']=='tolak'){
	$updates = array( 
				'status_do' => 2,
				);
	$exc= $db->update("tx_do",$updates,"no_do='$_POST[id]'");
	$supp=$db->select("tx_do","*","no_do='$_POST[id]'");
	foreach($supp as $valsupp){}
	$update = array( 
				'status_so' => 8,
				);
	$exc= $db->update("tx_sales_order",$update,"no_sales='$valsupp[no_reff]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 4,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);	
	echo "<script>window.location='index.php?x=appdo'</script>";
}
?>

