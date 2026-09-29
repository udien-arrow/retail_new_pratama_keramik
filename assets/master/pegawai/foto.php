<form method="POST" name="fotonya" id="fotonya" enctype="multipart/form-data">
<input type="hidden" name="foton" id="foton" class="form-control" value="<?=$val['id_pegawai']?>" readonly>
<div class="panel-body">
                    	<?php if($val[foto]==''){?>
                        <div class="form-group">
							<div class="col-lg-12">
									<input type="file" name="foto" id="foto" class="file-input">
							</div>
                         </div>
                         <?php }else{?>
                         <div class="form-group" >
						  <div class=" col-lg-3" >
                            </div>
                            <div class="thumbnail col-lg-6" >
							
							<img width="200" height="200" src="images/<?=$val['foto']?>">
                            </div>
                          <div class=" col-lg-3" >
                            </div>
						</div>
                     <?php }?>
</div>     
<div class="form-group">
                        <label class="control-label col-lg-4"></label>
                        <div class="col-lg-5">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savefoto(foton.value)">
                            <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pegawai'">
                             Batal 
                            </button>
                        </div>
                    </div> 
</form>