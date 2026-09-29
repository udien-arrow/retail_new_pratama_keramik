<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	session_start();
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
<form method="POST" name="tambah" id="tambah">
   <div class="form-group">
									<label class="control-label col-lg-4">Detil Kategori</label>
									<div class="col-lg-5">
										<input type="text" name="ketr" id="ketr" class="form-control" autocomplete="off"required>
								      <input type="hidden" name="kd" id="kd" class="form-control" value="<?=$_GET['id']?>"  required>
                                      <input type="hidden" name="idreal" id="idreal" class="form-control"  required>
									</div>
								</div><br>

                                <div class="form-group">
                                 &nbsp
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<input type="button" class="btn btn-info" name="go" id="go" value="Tambah" onclick="tambah1()">
                                        
									</div>
								</div>    

<br>
<hr>
<p> &nbsp; <b>Keranjang</b></p>
<div id="datadt">
</div>
<div class="form-group">
                                 &nbsp
                                </div>
                                
<br>

</div>
</form>