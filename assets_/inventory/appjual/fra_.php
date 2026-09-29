<div class="form-group">
  <label class="control-label col-lg-2">Pengiriman</label>
	<div class="col-lg-3">
                <select class="select-search" name="jenisken" id="jenisken"  onChange="kenda(cust.value,jenisken.value)">
                  <option value="">--Kendaraan--</option>
                  <?php
                      $query=$db->select("m_jenis_kendaraan","*");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['id_jenis']?>"  <?php if($sel['id_jenis']==$val['id_jenis']){echo "selected";}?>>
                    <?=$sel['nama']?>
                  </option>
                  <?php } ?>
              </select>
              </div>
    <div class="col-lg-3">
                <select class="select-search" name="supirr" id="supirr"  onChange="supi(cust.value,supirr.value)">
                  <option value="">--Supir--</option>
                  <?php
                      $query=$db->select("m_pegawai","*","id_jabatan='8'");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['id_pegawai']?>">
                    <?=$sel['nama_pegawai']?>
                  </option>
                  <?php } ?>
              </select>
              </div>
    <div class="col-lg-3">
                <select class="select-search" name="nopol" id="nopol"  >
                  <option value="">--nopol--</option>
                  <?php
                      $query=$db->select("m_kendaraan","*");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['nopol']?>">
                    <?=$sel['nopol']?>
                  </option>
                  <?php } ?>
              </select>
              </div>
</div>          
                   				
                     <input type="hidden" name="aksi" id="aksi"  value=""  required>			<input type="hidden" name="id2" id="id2"  value=""  required>                   
                     <input type="hidden" name="cust_old" id="cust_old"  value="" required>  
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value="<?=$konval['id_sales']?>"  required>
            		<input type="hidden" name="stain" id="stain"  value="<?=$konval['status_so']?>"  required>
                    <input type="hidden" name="no_orderin" id="no_orderin"  value="<?=$konval['no_sales']?>"  required>
                    <input type="hidden" name="id_cus" id="id_cus"  value="<?=$konval['id_cus']?>"  required>
                    <input type="hidden" name="jenis_jual" id="jenis_jual"  value="<?=$konval['jenis_jual']?>"  required>
                    <input type="hidden" name="id_gudang" id="id_gudang"  value="<?=$konval['id_gudang']?>"  required>
                    <input type="hidden" name="id_cabang" id="id_cabang"  value="<?=$konval['id_cabang']?>"  required>
                  
                   				<div class="form-group">
                               			 <?php
											
											include("keranjang_v2.php");
										  
										  ?> 
  </div>
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                               			<?php
											//if($konval['status_so']==1 && $konval['jenis']=='FRA'){
												include("keranjang_poa.php");
											//}elseif($konval['status_so']==2 && $konval['jenis']=='FRA'){
												//nclude("keranjang_poa2.php");
											//}
										?> 
                                </div>
</div>