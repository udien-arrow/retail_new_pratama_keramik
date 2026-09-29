<style>
.button {
  display: inline-block;
  padding: 15px 25px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>    
		<div class="col-lg-2">
        </div>
        <div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
					<form method="POST" name="tambah" id="tambah">
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">        
<span id="clock"></span>
<?php
$hari = date('l');
if ($hari=="Sunday") {
 echo "Minggu";
}elseif ($hari=="Monday") {
 echo "Senin";
}elseif ($hari=="Tuesday") {
 echo "Selasa";
}elseif ($hari=="Wednesday") {
 echo "Rabu";
}elseif ($hari=="Thursday") {
 echo("Kamis");
}elseif ($hari=="Friday") {
 echo "Jum'at";
}elseif ($hari=="Saturday") {
 echo "Sabtu";
}
?>,
<?php
$tgl =date('d');
echo $tgl;
$bulan =date('F');
if ($bulan=="January") {
 echo " Januari ";
}elseif ($bulan=="February") {
 echo " Februari ";
}elseif ($bulan=="March") {
 echo " Maret ";
}elseif ($bulan=="April") {
 echo " April ";
}elseif ($bulan=="May") {
 echo " Mei ";
}elseif ($bulan=="June") {
 echo " Juni ";
}elseif ($bulan=="July") {
 echo " Juli ";
}elseif ($bulan=="August") {
 echo " Agustus ";
}elseif ($bulan=="September") {
 echo " September ";
}elseif ($bulan=="October") {
 echo " Oktober ";
}elseif ($bulan=="November") {
 echo " November ";
}elseif ($bulan=="December") {
 echo " Desember ";
}
$tahun=date('Y');
echo $tahun;
?>


							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-4">
                                    <h4>
                                    
Shift 1 = 7:30 - 16:30<br>
Shift 2 = 9:00 - 17:00<br>
Shift 3 = 21:00 - 05:00</h4>
                                    </div>
									<div class="col-lg-4">
                                    <select name="shift" id="shift" class="select-search" >
                                      <option value="1">Shift 1</option>
                                      <option value="2">Shift 2</option> 
                                      <option value="3">Shift 3</option>
                                    </select>
									</div>
								</div>   
                                <div class="form-group">
                                    <div class="col-lg-5">
                                    </div>
                                    <div class="col-lg-5">
                                    &nbsp;
                                    </div>
                                 </div>
                                <div class="form-group">
                                <div class="col-lg-5">
                                </div>
									<div class="col-lg-5">
                                    <div id="kon">
                                    <?php 
									$tgl=date("Y-m-d");
									$ce1=$db->select("hr_absensi","*","id_pegawai='$_SESSION[ID_PEG]' order by id DESC limit 0,1");
									foreach($ce1 as $cek1){}
									if(count($ce1)==''){
									?>
                                    <input type="button" class="button" name="go" id="go" value="CLOCK IN" onclick="tambah1()">
                                    <?php	
									}else
									if($cek1['clock_out']==''){
									
									?>
                                    <input type="button" class="button" name="go" id="go" value="CLOCK OUT" onclick="tambah1()">
                                    <?php 
									}else{
									?>
                                    <input type="button" class="button" name="go" id="go" value="CLOCK IN" onclick="tambah1()">
                                    <?php } ?>
                                    </div>
									</div>
								</div>   
					</form>
					</div>	
				</div>	
                </div>				
		</div>
       
<?php
if($_POST[aksi]=='hapus'){
	$where = array("id_satuan" => $_POST['id']);
	$db->delete("m_satuan",$where);
	echo "<script>window.location='index.php?x=satuan'</script>";
}
?>