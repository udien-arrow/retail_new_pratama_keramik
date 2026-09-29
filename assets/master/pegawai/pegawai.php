		
<form method="POST" name="pegawai" id="addpeg">
        <div class="form-group">
                    <label class="control-label col-lg-2">Nama</label>
                    <div class="col-lg-4">
                        <input type="text" name="nm_pegawai" id="nm_pegawai" class="form-control" autocomplete="off" value="<?=$val['nama_pegawai']?>"  >
                      
                    </div>
                   <label class="control-label col-lg-2">Agama</label>
                    <div class="col-lg-4">
                      <select class="select" name="id_agama" id="id_agama" >
                        <?php
                            $query3=$db->select("hr_m_agama","*");
                            foreach($query3 as $sel3){	
                        ?>
                        <option value="<?=$sel3['id_agama']?>"  <?php if($sel3['id_agama']==$val['id_agama']){echo "selected";}?>>
                          <?=$sel3['m_agama']?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>  
      </div>
      <div class="form-group">
                    <label class="control-label col-lg-2">No ktp</label>
                    <div class="col-lg-4">
                        <input type="text" name="no_ktp" id="no_ktp" class="form-control" autocomplete="off" value="<?=$val['no_ktp']?>" >
                    </div>
                      <label class="control-label col-lg-2">Jenis Kelamin</label>
                    <div class="col-lg-4">
                        <select class="select" name="jk" id="dk">
                             <option value="">--Jenis kelamin--</option>
                            <option value="1" <?php if ($val['jk']==1){ echo "selected"; }?>>Laki-Laki</option>
                            <option value="2" <?php if ($val['jk']==2){ echo "selected"; }?>>Perempuan</option>
                    </select>
                    </div>               
      </div>
                <div class="form-group">
                    <label class="control-label col-lg-2"> Tempat Lahir</label>
                    <div class="col-lg-4">
                      <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir"  value="<?=$val['tmp_lahir']?>">  
                   </div>
                 <label class="control-label col-lg-2"> Email</label>
                    <div class="col-lg-4">
                      <input type="text" class="form-control" name="email" id="email"  value="<?=$val['email']?>"  >
                    </div>
                   
                </div>
                <div class="form-group">
                 <label class="control-label col-lg-2"> Tgl Lahir</label>
                    <div class="col-lg-4">
                      <div class="input-group">
                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                      <input type="text" class="form-control datepicker-menus" name="tgl_lahir" id="tgl_lahir"  value="<?=$val['tgl_lahir']?>">
                      </div>
                   </div>
                   <label class="control-label col-lg-2"> Jamsostek</label>
                    <div class="col-lg-4">
                      <input type="text" class="form-control" name="jamsostek" id="jamsostek"  value="<?=$val['no_jamsostek']?>">
                    </div>
                  </div>
                <div class="form-group">
                 <label class="control-label col-lg-2"> NPWP</label>
                    <div class="col-lg-4">
                      <input type="text" class="form-control" name="npwp" id="npwp"  value="<?=$val['npwp']?>"  >
                    </div>
                     <label class="control-label col-lg-2"> No HP</label>
                    <div class="col-lg-4">
                      <input type="text" class="form-control" name="nohp" id="nohp"  value="<?=$val['nohp']?>"  >
                    </div>
                   </div> 
                <div class="form-group">
                </div>
                <div class="form-group">
                        <label class="control-label col-lg-4"></label>
                        <div class="col-lg-5">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="save(kode.value)">
                            <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pegawai'">
                             Batal 
                            </button>
                        </div>
                    </div>     
</form>