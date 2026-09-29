<?php
foreach($kon as $vkon){}
?>
<link rel="stylesheet" href="assets/js/jquery-ui.css">
<script src="assets/js/jquery-1.8.3.js"></script>
<script src="assets/js/jquery-ui.js"></script>

<!-- Theme JS files -->
<style>
        table {
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid #DDD ;
            padding:1px;
        }
</style>
<div class="col-lg-1"></div>
<div class="col-lg-10" >
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Kas Awal</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->				</ul>
                        </div>
					</div>
                    
<div class="panel-body">
<div  class="col-lg-12">
<form class="form-inline" action="index.php?x=penjualan_ss" id="form_index" method="post">

  <div class="form-group">
  <br>
  Kas Awal <input type="text" class="form-control numbformat" name="kas_awal" size="15" placeholder="Kas Awal" id="kas_awal"  autofocus="autofocus">
  No Meja<input type="text" class="form-control numbformat" name="meja" size="3" placeholder="Meja" id="meja" value="<?=$vkon[no_meja]?>"  autofocus="autofocus" readonly>
  </div>
  <div class="form-group">
  <br>
  <button class=" btn btn-success" id="tambah" type="submit">Tambah </button>
  </div>
  
</form>

