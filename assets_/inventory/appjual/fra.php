<div class="form-group">
  <label class="control-label col-lg-2">Pengirimann</label>
				<!--
                <div class="col-lg-3">
                <select class="select-search" name="jenisken" id="jenisken"  onChange="kenda(cust.value,jenisken.value)" required>
                  <option value="">--Kendaraan--</option>
                  <?php
                      /*$query=$db->select("m_jenis_kendaraan","*");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['id_jenis']?>"  <?php if($sel['id_jenis']==$val['id_jenis']){echo "selected";}?>>
                    <?=$sel['nama']?>
                  </option>
                  <?php } */?>
              </select>
              </div>-->
              <div class="col-lg-5">
                <select class="select-search" name="nopol" id="nopol" onChange="kenda(cust.value,nopol.value,gudangggg.value)" required >
                  <option value="">--nopol--</option>
                  <?php
				  
				  
                      $query=$db->select("m_kendaraan a join m_jenis_kendaraan b on a.id_jenis=b.id_jenis","a.nopol,b.nama","a.id_cabang='$_SESSION[ID_CABANG]'");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['nopol']?>"><?=$sel['nopol'].' - '.$sel['nama']?></option>
                  <?php } ?>
              </select>
              </div>
    <div class="col-lg-3">
                <select class="select-search" name="supirr" id="supirr"  onChange="supi(supirr.value)" required>
                  <option value="">--Supir--</option>
                  <?php
                      $query=$db->select("m_pegawai","*","id_jabatan='8' and id_cabang='$_SESSION[ID_CABANG]'");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['id_pegawai']?>">
                    <?=$sel['nama_pegawai']?>
                  </option>
                  <?php } ?>
              </select>
              </div>
    
</div>             				
                     <input type="hidden" name="aksi" id="aksi"  value=""  required>			<input type="hidden" name="id2" id="id2"  value=""  required>                   
                     <input type="hidden" name="cust_old" id="cust_old"  value="" required>  
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>                  
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