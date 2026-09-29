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
    <script src="assets/js/plugins/tables/datatables/extensions/fixed_columns.min.js"></script>
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10">
		<form action="index.php?x=pensut_s" id="form_index" method="post">
   		  <div class="panel panel-flat" >
		    <div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                     </div>
            		<div class="dataTables_wrapper">
                    </div>
                   <div class="panel-body scrolls">
                   
                   <div class="form-group">
					<?php 
                        include("v_jenis.php");	
                    ?>
				  </div><br>
				  
<br>

				

				  <div class="form-group">
									<label class="control-label col-lg-3"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
									</div>
						</div>     
				  
                </div>
                </div>
                </form>
                </div>

