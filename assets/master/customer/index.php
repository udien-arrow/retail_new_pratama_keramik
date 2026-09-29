   <?php
 if($_GET['cd']==''){
	
	echo "<script>location.href='index.php?x=customer&cd=k2';</script>"; 
 }
 if($_GET['cd']=='k2'){
 ?>
		<div class="col-lg-2">
        </div>
        <div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Master Customer" onClick="window.location='index.php?x=customer&cd=b2'"></button></li>
							</ul>
                            </div>
					</div>
                    
                    <div class="dataTables_wrapper"></div>
                   <!-- <div class="table-responsive pre-scrollable">-->
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_customer","*","id_cus='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=customer_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())" enctype="multipart/form-data">
					<div class="form-group">
                   	 <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#data_usaha" data-toggle="tab">Data Usaha</a></li>
                            <li class=""><a href="#data_pribadi" data-toggle="tab">Data Customer</a></li>
                            <?php if($_GET['head']=='' && $val['head']==''){?>
                            <!--<li class=""><a href="#data_account" data-toggle="tab">Data Account</a></li>
                            <li class=""><a href="#plafon" data-toggle="tab">Plafon</a></li>-->
                            <?php }?>
                            <!--<li class=""><a href="#keluar_rmh" data-toggle="tab">Keluarga (Serumah)</a></li>
                            <li class=""><a href="#keluar_tdk" data-toggle="tab">Keluarga (Tidak Serumah)</a></li>
                            <li class=""><a href="#asset" data-toggle="tab">Asset</a></li>-->
                            <li class=""><a href="#ship" data-toggle="tab">Ship To</a></li>
                          
                        </ul>
                        <div class="tab-content">
                        	<div class="tab-pane active" id="data_usaha"> 
                                <?php include("data_usaha.php");?>   
                            </div>
                            <div class="tab-pane" id="data_pribadi">  
                            	<?php include("data_pribadi.php");?>    
                            </div>
                            <?php if($_GET['head']=='' && $val['head']==''){?>
                            <div class="tab-pane" id="data_account">  
                           		<?php include("data_account.php");?>   
                            </div>	
                            <!--<div class="tab-pane" id="sub">  
                           		<?php //include("data_sub.php");?>   
                            </div>-->	
                            <div class="tab-pane" id="plafon">  
                           		<?php include("data_plafon.php");?>   
                            </div>	
                            <?php }?>
                            <div class="tab-pane" id="keluar_rmh">  
                           		<?php include("data_keluarga_rmh.php");?>   
                            </div>	
                            <div class="tab-pane" id="keluar_tdk">  
                           		<?php include("data_keluarga_tdk.php");?>   
                            </div>	
                            <div class="tab-pane" id="asset">  
                           		<?php include("data_asset.php");?>   
                            </div>	
                            <div class="tab-pane" id="ship">  
                           		<?php include("data_shipto.php");?>   
                            </div>	
                         </div>
                    </div>		
                    <div class="form-group">
                        <label class="control-label col-lg-4"></label>
                        <div class="col-lg-5">
                            <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
                             Simpan 
                            </button>
                            <button class="btn btn-success" type="button" onClick="window.location='index.php?x=customer'">
                             Batal 
                            </button>
                        </div>
                    </div>     
					</form>
					</div>	
                    </div>
				</div>					
		</div>
       
        <?php }if($_GET['cd']=='b2'){?>
        <div class="col-lg-1">
        </div>
          <div class="col-lg-10">
		<form action="index.php?x=customer&cd=k2" id="form_index" method="post">
   		  <div class="panel panel-flat ">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Master Customer" onClick="window.location='index.php?x=customer&cd=k2'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="5%">Kode</th>
                                <th width="10%">Nama Pemilik</th> 
                              	<th width="20%">Nama</th>
                                <th width="27%">Alamat</th>
                                <th width="5%">Telp</th>
                                <th width="5%">Fax</th>  
                                <th width="10%">Cabang</th> 
                                <th width="8%">Status</th>                           
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                    </table>    
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>
       
        <?php }?>
<?php
if($_POST[aksi]=='hapus'){
	$data1 = array("status" => '0');
	$db->update("m_customer",$data1,"id_cus='$_POST[id]'");
	echo "<script>window.location='index.php?x=customer'</script>";
}
if($_POST[aksi]=='hapush'){
	$data = array("head" => '');
	$db->update("m_customer",$data,"id_cus='$_POST[id]'");
	echo "<script>window.location='index.php?x=customer'</script>";
}
?>
