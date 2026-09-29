    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #C4DAE7 ;
				padding:2px;
			}
			.scrolls {
				overflow-x: scroll;
				overflow-y: hidden;
				white-space:nowrap
			}
	</style>
    <div class="col-lg-12">
		<form action="index.php?x=payrolhabor_s" id="form_index" method="post">
   		  <div class="panel panel-flat" >
		    <div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                     </div>
            <div class="dataTables_wrapper">
                    </div><br>
                    <div class="form-group">
					</div>
                   <?php include("bulantahun.php");?><input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData(tahun.value,bulan.value)">
                   <input type="submit" class="btn btn-info" name="posting" id="posting" value="Posting" onclick="return confirm('Data akan diposting, apakah anda yakin?')">
                   <br><br>
                   <div class="panel-body scrolls">
                   <div class="form-group">
					<?php 
                        include("v_jenis.php");	
                    ?>
                    </div>
                    </div>
            <input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   			<input type="hidden" name="sat_in" id="sat_in" required>
   		  </div>
			</form>
		</div>

