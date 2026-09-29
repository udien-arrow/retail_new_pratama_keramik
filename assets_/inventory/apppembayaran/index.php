    <!-- Theme JS files -->
	<style>
			.tables, td, th {
				border: 1px solid #DDD ;
				padding:0px;
				padding-right:1px;
				padding-right:1px; 
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
    <div class="col-lg-1">
    </div>
   <?php 
 if($_POST[simpan]){
	include("assets/inventory/apppembayaran/simpan.php");
	}  
   
if($_GET['cd']==''){
	
	echo "<script>location.href='index.php?x=apppembayaran&cd=b2';</script>"; 
 }
if($_GET['cd']==b2){
?>  
    <div class="col-lg-10">
		<form action="index.php?x=apppembayaran" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title;?></h5>
					</div>
					 <table  id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <td width="15%">Nama</td>
                                <td width="10%">No</td>
                                <td width="10%">Tanggal</td>
                                <td width="20%">No Buku tagihan</td>
                                <td width="30%">Keterangan</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>

                    </table>              
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
        
<?php
} 
if($_GET['cd']==k2){
?>        
         <form class="form-horizontal" action="index.php?x=apppembayaran" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
         <?php
                    $supp=$db->select("v_app_tk","*","no_ta='$_GET[id]'");
                    foreach($supp as $valsupp){}
					?>
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Pembayaran
                        <?php if($valsupp['status']==0){?>
                        <button style="float:right" class="btn btn-primary" type="submit" name="simpan" onClick="return confirm('Apakah Anda yakin menyimpan data??')" value="simpan">Approve</button>
                        <?php }else{} ?>&nbsp;&nbsp;
                        <button style="float:right" class="btn btn-primary" type="button" name="back" onClick="javascript:location.href='index.php?x=apppembayaran&cd=b2'" value="Back">Back</button>
                        </h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body scrolls">
                                      <div class="form-group">
                                              <table width="500px" cellspacing="0" cellpadding="0">
                        <tr>
                                             <td width="147"><b>NO</b></td>
                                             <td width="351"><b>: <?=$valsupp['no_ta']?></b></td>
                                        
                                      
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
                          <tr>
                                              <td><b>Pelanggan</b></td>
                                              <td><select name="pelanggan" id="pelanggan" class="select-search" onChange="pindahCust('<?=$_GET['id']?>',pelanggan.value)">
                                            	<option value="">-Pilih-</option>
                                                <?php 
												   $c=$db->select("tx_tagihan_kembali_dtl a join m_customer b on a.id_cus=b.id_cus","a.id_cus,b.nama_usaha,b.kode_cus","a.no_ta='$_GET[id]' group by a.id_cus");
												   foreach($c as $dt){
												?>
                                                <option value="<?=$dt['id_cus']?>" <?php if($dt['id_cus']==$_GET['cus']){echo "selected";}?>><?=$dt['kode_cus'].' - '.$dt['nama_usaha']?></option>
                                                <?php 	
												}
												?>
                                            </select></td>
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
<?php }?>

<?php

?>

