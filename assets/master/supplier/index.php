 <?php
 if($_GET['cd']==''){
	echo "<script>location.href='index.php?x=supplier&cd=k2';</script>"; 
 }
 if($_GET['cd']=='k2'){
 ?>
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Master supplier" onClick="window.location='index.php?x=supplier&cd=b2'"></button></li>
							</ul>
                            </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <!-- <div class="table-responsive pre-scrollable">-->
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_supplier","*","id_supp='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=supplier_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())" enctype="multipart/form-data">
					<div class="form-group">
                   	 <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#data_usaha" data-toggle="tab">Data Usaha</a></li>
                            <li class=""><a href="#data_pribadi" data-toggle="tab">Data supplier</a></li>
                            <li class=""><a href="#data_account" data-toggle="tab">Data Account</a></li>
                            
                        </ul>
                        <div class="tab-content">
                        	<div class="tab-pane active" id="data_usaha"> 
                                <?php include("data_usaha.php");?>   
                            </div>
                            <div class="tab-pane" id="data_pribadi">  
                            	<?php include("data_pribadi.php");?>    
                            </div>
                            <div class="tab-pane" id="data_account">  
                           		<?php include("data_account.php");?>   
                            </div>	
                           
                         </div>
						
                    </div>		
                                
                    <div class="form-group">
                        <label class="control-label col-lg-4"></label>
                        <div class="col-lg-5">
                            <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
                             Simpan 
                            </button>
                            <button class="btn btn-success" type="button" onClick="window.location='index.php?x=supplier'">
                             Batal 
                            </button>
                        </div>
                    </div>     
					</form>
					</div>	
                    </div>
				</div>					
		</div>
        <!--<div class="col-lg-4">
        <div class="panel panel-flat">
        	<?php //include("infolimit.php");?>
        </div>-->
        
        <?php }if($_GET['cd']=='b2'){?>
          <div class="col-lg-12">
		<form action="index.php?x=supplier&cd=k2" id="form_index" method="post">
   		  <div class="panel panel-flat ">
          
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Master supplier" onClick="window.location='index.php?x=supplier&cd=k2'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="5%">Kode</th>
                                <th width="15%">Nama Pemilik</th> 
                              	<th width="15%">Nama</th>
                                <th width="10%">Alamat</th>
                                <th width="10%">Telp</th>  
                                <th width="10%">Cabang</th> 
                                <th width="10%">Status</th>                           
                                <th width="8%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                   
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
         
			</form>
		</div>
        
       <!-- <div class="col-lg-4">
        <div class="panel panel-flat">
        	<?php //include("infolimit.php");?>
        </div>-->
        <?php }?>

<?php
if($_POST[aksi]=='hapus'){
	$where = array("id_supp" => $_POST['id']);
	$db->delete("m_supplier",$where);
	echo "<script>window.location='index.php?x=supplier'</script>";
}
?>
