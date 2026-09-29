    <!-- Theme JS files -->
	<style>
			.tables, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			table, tr, td {
			border: none;
		}
	.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
	</style>
    <div class="col-lg-5">
		<form action="index.php?x=app-price" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title;?></h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <td width="10%">No</td>
                                <td width="10%">Supplier</td>
                                <td width="10%">Tanggal</td>
                                <td width="10%">Aksi</td>
                            </tr>
                        </thead>

                    </table>   
                                    
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app-price" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
         <?php
                    $supp=$db->select("v_app_pricel","*","kode_price='$_GET[id]'");
                    foreach($supp as $valsupp){}
					?>
		<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Pricelist
                        <?php if($valsupp['status']==0){?>
                        <button style="float:right" class="btn btn-danger" type="submit" name="simpan" value="tolak">Tolak</button>
                        <button style="float:right" class="btn btn-primary" type="submit" name="simpan" value="setuju">Approve</button>
                        
                        <?php }else{} ?>
                        </h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   
                    <div class="panel-body scrolls">
                                      <div class="form-group">
                                      
                                              <table width="300px" cellspacing="0" cellpadding="0">
                        <tr>
                                             <td><b>NO</b></td>
                                             <td><b>: <?=$valsupp['kode_price']?></b></td>
                                        
                                      
                        </tr>
                        <tr>
                                             <td><b>Supplier</b></td>
                                             <td><b>: <?=$valsupp['nama_supp']?></b></td>
                                        
                                      
                        </tr>
                        <tr>
                                             <td><b>Tgl</b></td>
                                             <td><b>: <?=$valsupp['tgl_berlaku']?></b></td>
                                        
                                      
                          </tr>
                          <tr>
                          
                                            <td><b>Keterangan </b></td>
                                            <td> <input type="text" name="keter" value=""></td>
                          </tr>
                          </table>
                                  
                                </div>
                                <div class="form-group">
                                <input type="hidden" name="link" value="<?=$_GET['id']?>">
                               			 <?php
											include("keranjang_v.php");
											?> 
                                
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
<?php
if($_POST[simpan]){
	include("assets/inventory/app_pricel/simpan.php");
	}
?>

