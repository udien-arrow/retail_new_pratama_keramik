<?php
  foreach($db->select("tx_sales_order","no_spj_rilis","no_sales='$noso'")as $spj);
  foreach($db->select("v_spj_rilis","no_polisi,nama_sopir","no_spj='$spj[no_spj_rilis]'")as $rilis);
?>
<div class="form-group">
  <label class="control-label col-lg-2">No SPJ Rilis</label>
               <div class="col-lg-3">
                <input type="text" class="form-control" value="<?=$spj['no_spj_rilis']?>" name="spjril" id="spjril" readonly>   
              </div>
</div>
<div class="form-group">
  <label class="control-label col-lg-2">Nopol</label>
               <div class="col-lg-3">
                <input type="text" class="form-control" value="<?=$rilis['no_polisi']?>" name="nopol_manual" id="nopol_manual" readonly>   
              </div>
</div> 
<div class="form-group">
  <label class="control-label col-lg-2">Supir</label>
    <div class="col-lg-6">
                <input type="text" class="form-control" value="<?=$rilis['nama_sopir']?>" name="nama_supir" id="nama_supir" readonly>   
              </div>
</div>   
<div class="form-group">
  <label class="control-label col-lg-2">Biaya Switch</label>
    <div class="col-lg-3">
     	<input type="text" class="form-control hargab" value="0"   name="switch" id="switch">           
     </div>
</div>
<div class="form-group">
  <label class="control-label col-lg-2">Keterangan</label>
    <div class="col-lg-7">
     	<input type="text" class="form-control" name="keterangan" id="ket">           
     </div>
</div>
          
                   				
                     <input type="hidden" name="aksi" id="aksi"  value=""  required>			<input type="hidden" name="id2" id="id2"  value=""  required>                   
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value="<?=$konval['id_sales']?>"  required>
            		
                    
                   				<div class="form-group">
                               			 <?php
											
											include("keranjang_v3.php");
										  
										  ?> 
  </div>
                                <div class="form-group">
                                </div>
</div>