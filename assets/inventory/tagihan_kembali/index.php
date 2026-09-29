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
if($_POST[simpan]){
	include("assets/inventory/tagihan_kembali/simpan.php");	
	
}
if($_POST[simpannya]){
	include("assets/inventory/tagihan_kembali/simpan2.php");	
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_tagihan_kembali_tmp",$where);
	
	echo "<script>window.location='index.php?x=tagkem&id=$_POST[links]&jenispem=$_POST[jenis]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_tagihan_kembali_tmp",$where);
	echo "<script>window.location='index.php?x=tagkem&id=$_POST[links]&jenispem=$_POST[jenis]'</script>";

}else{
?>     			
	 <form action="index.php?x=tagkem_s" id="form_index" method="post">
		<div class="col-lg-6" >
				<div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">Input <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View <?=$title?>" onClick="window.location='index.php?x=tagkem_v'"></button></li>
							</ul>
                            </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <br>
                   <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;No</label>
                              <div>
                              	  <div class="input-group col-lg-4">
                                  <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(id_stok.value)">
                                      <option value="">--- NO TAGIHAN ---</option>
                                      <?php 
									  $gudang=$db->select("tx_buku_tagihan","*","id_user='$_SESSION[ID_LOGIN]' and status='1' and no not in (select no_ref from tx_tagihan_kembali)");
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no']?>" <?php if($_GET['id']==$val['no']){echo "selected";}?>> <?=$val['no']." - ".$val['tgl']?></option> 
                                     <?php } ?>
                                    </select>
                                  </div>
                               </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Jenis Pembayaran</label>
                              <div>
                              	  <div class="input-group col-lg-4">
                                  <select name="jenispem" id="jenispem" class="select-search" onChange="pindahData3(id_stok.value,jenispem.value)">
                                      <option value="">--- Jenis Pembayaran ---</option>
                                      <option value="1" <?php if($_GET['jenispem']==1){echo "selected";} ?>>Tunai</option>
                                      <option value="2" <?php if($_GET['jenispem']==2){echo "selected";} ?>>Transfer</option>
                                      <option value="3" <?php if($_GET['jenispem']==3){echo "selected";} ?>>BG</option>
                                      <option value="4" <?php if($_GET['jenispem']==4){echo "selected";} ?>>Kembali Utuh</option>
                                      <option value="5" <?php if($_GET['jenispem']==5){echo "selected";} ?>>Deposit Pelanggan</option>
                                  </select>
                                  </div>
                               </div>
                    </div>
                    <?php if($_GET['jenispem']==3){?>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Jenis Input BG</label>
                              <div>
                              	  <div class="input-group col-lg-4">
                                  <select name="jenisb" id="jenisb" class="select-search" onChange="pindahData4(id_stok.value,jenispem.value,jenisb.value)">
                                      <option value="">--- Jenis BG ---</option>
                                      <option value="1" <?php if($_GET['jenisb']==1){echo "selected";}?>>1 SPJ</option> 
                                      <option value="2" <?php if($_GET['jenisb']==2){echo "selected";}?>>Banyak SPJ</option> 
                                    </select>
                                  </div>
                               </div>
                    </div>
                    <?php } ?>
                    
                    <?php 
if($_GET['jenispem']==1){
include "tunai.php";
}elseif($_GET['jenispem']==2){
include "transfer.php";
 }elseif($_GET['jenispem']==3 and $_GET['jenisb']=='1'){
include "bg.php";
 }elseif($_GET['jenispem']==4){
include "kembali.php";
 }elseif($_GET['jenisb']==2){
include "bg2.php";
 }elseif($_GET['jenispem']==5){
include "depo.php"; 
}
?>


<input type="hidden" name="id" id="id"  value="" placeholder='id' required>            
<input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
<input type="hidden" name="totalpiutangx" id="totalpiutangx"  value=""  placeholder='piutang' required>
<input type="hidden" name="tempo_normalx" id="tempo_normalx"  value=""  placeholder='tempo nor' required>
<input type="hidden" name="tempo_tambahanx" id="tempo_tambahanx"  value=""  placeholder='tempo tam' required>
<input type="hidden" name="dibayarx" id="dibayarx"  value=""  placeholder='dibayar' required>
<input type="hidden" name="no_spjx" id="no_spjx"  value=""  placeholder='spj' required>
<input type="hidden" name="no_fjx" id="no_fjx"  value=""  placeholder='fj' required>
<input type="hidden" name="id_cusx" id="id_cusx"  value=""  placeholder='cus' required>
<input type="hidden" name="bankbgx" id="bankbgx"  value=""  placeholder='bankbg' required>
<input type="hidden" name="nama_bankx" id="nama_bankx"  value=""  placeholder='nama_bank' required>
<input type="hidden" name="no_seribgx" id="no_seribgx"  value=""  placeholder='noseribg' required>
<input type="hidden" name="no_rekx" id="no_rekx"  value=""  placeholder='no_rek' required>
<input type="hidden" name="jatuh_tempox" id="jatuh_tempox"  value=""  placeholder='jatuh_tempox' required>
<input type="hidden" name="links" id="links"  value="<?=$_GET['id']?>"  placeholder='jatuh_tempox' required>
<input type="hidden" name="jenis" id="jenis"  value="<?=$_GET['jenispem']?>"  placeholder='jatuh_tempox' required>
<input type="hidden" name="jenisbx" id="jenisbx"  value="<?=$_GET['jenib']?>"  placeholder='jenib' required>
<br>    


                </div>	
		</div>
        
        
</form>
  <div class="col-lg-6">
               <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Tagihan Kembali
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body scrolls">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=tagkem" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
             
