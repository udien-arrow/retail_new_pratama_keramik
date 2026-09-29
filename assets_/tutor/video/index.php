    <div class="col-lg-4">
    <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th width="75%">Nama</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
    </div>
	    <div class="col-lg-8">
		<form action="index.php?x=agama" id="form_index" method="post">
   		  <?php
          foreach($db->select("r_tutor","*","id='$_GET[id]'") as $data);
		  
		  ?>
          <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tutorial, ( <?=$data['nama']?> )</h5>
					</div><br>
					<div class="form-group" >
                    	<div class="col-lg-10">
                        		<video controls width="700" height="400">
                                  <source src="<?=$data['link']?>" type="video/mp4">
                                  
                                  Your browser does not support the video tag.
                                </video>
                        </div>
                    </div> 
                     <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
   		  </div>
			</form>
		</div>

