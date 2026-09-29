<form id="formc" action="<?=$_SERVER['PHP_SELF']?>" method="post">
 <div class="col-lg-1">
 </div>      

 <div class="col-lg-10" style="text-align:center">
 <div class="panel panel-flat" style="height:850px">
        	<div class="form-group">
            </div>
                         <!--<select class="select" name="jenis" id="jenis">
                         	<option value="1">Pembelian</option>
                            <option value="2">Penjualan</option>
                            <option value="3">Item Inventory</option>
                            <option value="4">HRM</option>
                            <option value="5">Expediture</option>
                         </select>-->
           	             <select class="select" name="tipe" id="tipe">
                            <!--<option value="1" <?php if($_POST['tipe']==1){echo "selected";}?>>Penjualan</option>-->
                            <option value="2" <?php if($_POST['tipe']==2){echo "selected";}?>>Pembelian</option>
                            <!--<option value="3" <?php if($_POST['tipe']==3){echo "selected";}?>>Pelanggan Expired Order</option>
                            <option value="4" <?php if($_POST['tipe']==4){echo "selected";}?>>10 Besar Item Penjualan</option>-->
                            <!--<option value="5" <?php if($_POST['tipe']==5){echo "selected";}?>>10 Karyawan Sering Ijin</option>
                            <option value="6" <?php if($_POST['tipe']==6){echo "selected";}?>>10 Karyawan Sering Penghargaan</option>
                            <option value="7" <?php if($_POST['tipe']==7){echo "selected";}?>>10 Karyawan Sering Pelanggaran</option>-->
                         </select>   
                      <?php include("bulantahun.php");?>
                       <button class="" name="go" id="go" onclick="pindahData(jenis.value,tipe.value,bulan.value,tahun.value)">Go</button>
                <?php 
				if($_POST['tipe']==2){
					include('chart_po.php');	
				}
				if($_POST['tipe']==1){
					include('chart_jual1.php');	
					//include('chart_jual2.php');	
					//include('chart_item.php');	
				}
				
				?>            
            </div>
    		<b>
        </div>
 </div> 
 
 