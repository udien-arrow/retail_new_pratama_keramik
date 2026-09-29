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
						<h5 class="panel-title">Input <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->				</ul>
                        </div>
					</div>
                    
<div class="panel-body">
<div  class="col-lg-12">
<form class="form-inline" action="index.php?x=penjualangro_s" id="form_index" method="post">
  
  <div class="form-group">
  <br>
    <input type="text" class="form-control" name="kode_barang" size="10" placeholder="Kode Barang" id="kode_barang"  onchange="runScript(this.value)" autofocus="autofocus">
  <input type="hidden" name="id_barang" id="id_barang"  autofocus />
  </div>
   <div class="form-group">
    <br>
    <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang"  id="nama_barang" value="">
  </div>
  <div class="form-group">
  <br>
    <input type="text" class="form-control numbformat" name="harga_barang" placeholder="Harga Barang" id="harga_barang" value="">
  </div>
  <div class="form-group">
  <br>
    <input type="text" class="form-control numbformat" name="qty_stok" size="4" placeholder="Qty Stok" id="qty_stok" value="">
  </div>
  <div class="form-group">
  <br>
    <input type="text" class="form-control" name="qty" placeholder="Qty" size="3" id="qty" value="">
  </div>
  <div class="form-group">
  <br>
    <input type="text" class="form-control" name="disc" placeholder="Disc(%)" size="3" id="disc" value="">
  </div>
  <div class="form-group">
  <br>
  <button class=" btn btn-success" id="tambah" type="submit">Tambah 
                                        </button>
  </div>
  <div class="form-group">
  <br>
  <div class="btn-group">
        <button type="button" class="btn bg-teal-300 btn-labeled " data-toggle="dropdown"><b></b>Hold &nbsp;<span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="#" onclick="hold()"><i class="icon-menu7"></i> Hold Transaksi</a></li>
            <li><a href="#" data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="cekHold()" ><i class="icon-screen-full"></i> View Hold Transaksi</a></li>
            
        </ul>
    </div>
  </div>
  
</form>
<div class="form-group">                                      
<div class="col-lg-12">
<br> 
<form action="index.php?x=penjualangro" name="keranjang" id="keranjang" method="post">
<input type="hidden" id="aksi" name="aksi" />
<input type="hidden" id="id" name="id" />
                                       	<?php
                                            include("keranjang.php");
											?>
                                            </form>
                                            </div>
</div>
</div>

<div class="col-lg-12">
<div class="col-lg-7">
<form class="form-horizontal" action="index.php?x=penjualangro_t" name="formku" id="formku" method="post">
<div class="form-group" >
<br>
<label class="control-label col-lg-3">Tanggal Jual</label>
    
 <div class="col-lg-5">
    <div class="input-group">
<span class="input-group-addon"><i class="icon-calendar22"></i></span>
<input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>">
</div>
    </div>     
</div>


<div class="form-group" >
<?php
//$ip_num = "192.168.9.17";
$kon=$db->select("tm_meja_kasir", "*", "ip='".$db->getUserIP()."'"); 
foreach($kon as $y){}
?>
      <label class="control-label col-lg-3">Meja</label>
      <div class="col-lg-1">
      <input type="text" name="meja" id="meja" class="form-control" autocomplete="off" value="<?=$y['no_meja']?>" requiered>
      </div>     
</div>
<div class="form-group" >
      <label class="control-label col-lg-3">Customer</label>
      <div class="col-lg-5">
 		<input name = "cust" id="cust" class = "form-control"/>
		<input type="hidden" class = "form-control" id="cust2" name="cust2"/>
              
      </div>     
</div>

</div>




<div class="col-lg-5 form-horizontal">
<div class="form-group" >
<br>
<?php
$kon=$db->select("pj_penjualan_dtl_tmp", "id_tmp, id_barang, harga_jual_tmp, qty_tmp, user_tmp, Sum(total_tmp) as total", "user_tmp = '$_SESSION[ID_LOGIN]'"); 
foreach($kon as $x){
?>
      <label class="control-label col-lg-4">Subtotal</label>
      <div class="col-lg-6">
      <input type="text"  name="subtot" id="subtot" class="form-control" autocomplete="off" value="<?=number_format($x['total'])?>">
<?php } ?>
      </div>     
</div>

<div class="form-group" >
      <label class="control-label col-lg-4">Disc (%)</label>
      <div class="col-lg-2">
      <input type="text" name="disc2" id="disc2" class="form-control" autocomplete="off" value="0">
      <input type="hidden" name="jenis_jual" id="jenis_jual"  value="2" />
      </div>     
</div>

<div class="form-group" >
      <label class="control-label col-lg-4">Grandtotal</label>
      <div class="col-lg-6">
      <input type="text" name="grantot" id="grantot" class="form-control numbformat" autocomplete="off" value="<?=number_format($x[total])?>" >
      </div>     
</div>


<div class="form-group" >
      
    <button class= "btn btn-primary" id="simpan"type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
    Simpan 
    </button>
    <input type="hidden" id="aksi" name="aksi" />
    <button class="btn btn-success" type="reset">
    Batal 
    </button>

</form>
</div>


</div>                                     
</div>
</div>

<div class="col-lg-1"></div>
<?php 
if($_POST['aksi']=='hapus'){
	$where = array("id_tmp" => $_POST['id']);
	$db->delete("pj_penjualan_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=penjualangro'</script>";
}

if($_GET['st']=='h'){
	$dttmp=$db->select("pj_penjualan_dtl_tmp","*","user_tmp='$_SESSION[ID_LOGIN]' and jenis=2");
	$jum=count($dttmp);
	if($jum>0){
		$idj=$db->nourut('no_hold', 'pj_penjualan_dtl_tmp_hold', 'HL', sprintf("%02s", $_SESSION['ID_GUDANG']), date("Y-m-d"));
		foreach($dttmp as $dta){
			$data = array(
				"id_barang" => $dta['id_barang'],
				"harga_jual_tmp" => $dta['harga_jual_tmp'],
				"qty_tmp" => $dta['qty_tmp'],
				"discprs_tmp" => $dta['discprs_tmp'],
				"total_tmp" => $dta['total_tmp'],
				"session_jual" => $dta['session_jual'],
				"status" => $dta['status'],
				"user_tmp" => $dta['user_tmp'],
				"no_hold" => $idj,
				"tgl" => date("Y-m-d"),
				"jenis" => 2
			);
			$db->insert("pj_penjualan_dtl_tmp_hold",$data);
			
			$data = array(
				"id_tmp" => $dta['id_tmp'],
			);
			$db->delete("pj_penjualan_dtl_tmp",$data);
		}
	}
	
	echo "<script>
	alert('No Hold : $idj');
	window.location='index.php?x=penjualangro'</script>";
}
if($_GET['st']=='b'){
	
	$dttmp=$db->select("pj_penjualan_dtl_tmp_hold","*","user_tmp='$_SESSION[ID_LOGIN]' and no_hold='$_GET[no]'");
		foreach($dttmp as $dta){
			$data = array(
				"id_barang" => $dta['id_barang'],
				"harga_jual_tmp" => $dta['harga_jual_tmp'],
				"qty_tmp" => $dta['qty_tmp'],
				"discprs_tmp" => $dta['discprs_tmp'],
				"total_tmp" => $dta['total_tmp'],
				"session_jual" => $dta['session_jual'],
				"status" => $dta['status'],
				"user_tmp" => $dta['user_tmp'],
				"jenis" => 2,
			);
			$db->insert("pj_penjualan_dtl_tmp",$data);
			
			$data = array(
				"id_tmp" => $dta['id_tmp'],
			);
			$db->delete("pj_penjualan_dtl_tmp_hold",$data);
		}
	
	echo "<script>
	window.location='index.php?x=penjualangro'</script>";
}

?>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Hold Transaksi</h6>
							</div>
							<div class="modal-body" id="hahaha2">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>
<script>
jQuery(document).ready(function($){
	$( "#nama_barang" ).autocomplete({
		source: "assets/inventory/penjualangro/data.php", 
		minLength:2,  
		select: function(event,ui){
			$("#kode_barang").val(ui.item.b);
			$("#id_barang").val(ui.item.c);
			var subexp = ui.item.d.split('*')
			$("#harga_barang").val(subexp[0]);
			$("#harga_barang_c").val(subexp[1]);
			$("#qty_stok").val(ui.item.e);
			var n = parseInt($('#harga_barang').val().replace(/\D/g,''),10);
			$('#harga_barang').val(n.toLocaleString())
			$("#qty").focus();

		}
	});
});
</script>

