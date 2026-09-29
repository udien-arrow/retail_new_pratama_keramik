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
                                <td width="15%">Nama</td>
                                <td width="10%">No</td>
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
         <form class="form-horizontal" action="index.php?x=appbt" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
         <?php
                    $supp=$db->select("v_app_bt","*","no='$_GET[id]'");
                    foreach($supp as $valsupp){}
					?>
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Buku Tagihan
                        <?php if($_GET['id']==''){ 
						
						}else{?>
                        <?php if($valsupp['status']==0){?><button style="float:right" class="btn btn-primary" type="submit" name="simpan" value="simpan">Approve</button>
                        <?php }if($valsupp['status']==1){?>
							 <!--<a href='javascript:void(0)' onClick=window.open('cetak.php?page=appbt&id=<?=$valsupp['no']?>') ><button style="float:right" class="btn btn-primary" type="button">Cetak Expedisi Tagihan</button></a>-->
							<?php } }?>
                        </h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                                      <div class="form-group">
                                              <table width=300px" cellspacing="0" cellpadding="0">
                        <tr>
                                             <td><b>NO</b></td>
                                             <td><b>: <?=$valsupp['no']?></b></td>
                                        
                                      
                        </tr>
                        <tr>
                                             <td><b>Nama Pegawai</b></td>
                                             <td><b>: <?=$valsupp['nama_pegawai']?></b></td>
                                        
                                      
                        </tr>
                        <tr>
                                             <td><b>Tgl</b></td>
                                             <td><b>: <?=$valsupp['tgl']?></b></td>
                                        
                                      
                          </tr>
                                            <td><b>Keterangan </b></td>
                                            <td> <b>: <?=$valsupp['ket']?></b></td>
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
	include("assets/inventory/app_bt/simpan.php");
	}
?>

