<div class="form-group">
  <label class="control-label col-lg-2">Nopol</label>
   <!-- <div class="col-lg-3">
                <select class="select-search" name="nopol" id="nopol"  >
                  <option value="">--nopol--</option>
                  <?php
                    /*  $query=$db->select("m_kendaraan","*");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['nopol']?>">
                    <?=$sel['nopol']?>
                  </option>
                  <?php }*/ ?>
              </select>
              </div>--->
               <div class="col-lg-6">
                <input type="text" class="form-control" name="nopol_manual" id="nopol_manual">   
              </div>
</div> 
 
<div class="form-group">
  <label class="control-label col-lg-2">Supir</label>
    <!--<div class="col-lg-3">
                <select class="select-search" name="supirr" id="supirr">
                  <option value="">--Supir--</option>
                  <?php
                      /*$query=$db->select("m_pegawai","*","id_jabatan='8'");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['id_pegawai']?>">
                    <?=$sel['nama_pegawai']?>
                  </option>
                  <?php }*/ ?>
              </select>
              </div>-->
    <div class="col-lg-6">
                <input type="text" class="form-control" name="nama_supir" id="nama_supir">   
              </div>
</div>   
<div class="form-group">
  <label class="control-label col-lg-2">Biaya Locco</label>
    <div class="col-lg-3">
     	<input type="text" class="form-control hargab" value="0"   name="biayasewalco" id="biayasewalco">           
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