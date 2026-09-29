<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
//==========================jenissssssssssssssss tidak 3=======================================================================
	if($_GET['jenis']==1){$dep=2;}elseif($_GET['jenis']==3){$dep=1;}
	if($_GET['gud']==''){
		$gud=$_SESSION['ID_GUDANG'];	
	}else{
		$gud=$_GET['gud'];	
	}
	
	$table = 'v_barang_order';
	$primaryKey = 'id_barang';
	$jenis = 'input';
	$where2="id_gudang='$gud' and id_barang not in(select id_barang from tx_order_tmp where ke_gudang='$_GET[gud]' and jenis='$_GET[jenis]') and id_dep='$dep'";
	$limit="limit 0,0";
	if($_GET['tahap']<5){
		
		$columns = array(
		array(
				'db'        => 'nama_barang',
				'dt'        => 0,
				'formatter' => function( $d, $row ) {
					$bar= ucfirst(strtolower($d));
					return "
						$bar
					";
				}
			),
			array(
				'db'        => 'nama_satuan',
				'dt'        => 1,
				'formatter' => function( $d, $row ) {
					return "
						$d
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 2,
				'formatter' => function( $d, $row ) {
					if($_GET['gud']==''){
							$gud=$_SESSION['ID_GUDANG'];
					}else{
							$gud=$_GET['gud'];
					}
					
					return "
					<span class='form-control' style='height:27px; width:60px;padding: 3px 12px' id='tes$d'><script>$('#tes$d').load('assets/inventory/order/mutasi.php?id=$d&gud=$gud');</script></span>
					
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 3,
				'formatter' => function( $d, $row ) {
				$explo=explode("_",$_GET['tahap']);
					if($explo[0]==1){
						$a='-01';;	
					}
					if($explo[0]==2){
						$a='-07';	
					}
					if($explo[0]==3){
						$a='-13';
					}
					if($explo[0]==4){
						$a='-19';
					}	
				$tgl25=$_GET['tahun'].'-'.$_GET['bulan'].$a;
					return "<input type='text' name='qty1[]' style='height:27px; width:50px;' id='qty1$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
					<input type='hidden' name='tgl1[]' id='tgl1$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl25' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 4,
				'formatter' => function( $d, $row ) {
					$explo=explode("_",$_GET['tahap']);
					if($explo[0]==1){
						$b='-02';
					}
					if($explo[0]==2){
						$b='-08';
					}
					if($explo[0]==3){
						$b='-14';
					}
					if($explo[0]==4){
						$b='-20';
					}
				$tgl26=$_GET['tahun'].'-'.$_GET['bulan'].$b;
					return "<input type='text' name='qty2[]' style='height:27px; width:50px;' id='qty2$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='tgl2[]' id='tgl2$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl26' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 5,
				'formatter' => function( $d, $row ) {
					$explo=explode("_",$_GET['tahap']);
					if($explo[0]==1){
						$c='-03';
					}
					if($explo[0]==2){
						$c='-09';
					}
					if($explo[0]==3){
						$c='-15';
					}
					if($explo[0]==4){
						$c='-21';
					}
					$tgl27=$_GET['tahun'].'-'.$_GET['bulan'].$c;
					return "<input type='text' name='qty3[]' style='height:27px; width:50px;' id='qty3$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='tgl3[]' id='tgl3$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl27' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 6,
				'formatter' => function( $d, $row ) {
					$explo=explode("_",$_GET['tahap']);
					if($explo[0]==1){
						$dd='-04';
					}
					if($explo[0]==2){
						$dd='-10';
					}
					if($explo[0]==3){
						$dd='-16';
					}
					if($explo[0]==4){
						$dd='-22';
					}
					$tgl28=$_GET['tahun'].'-'.$_GET['bulan'].$dd;
					return "<input type='text' name='qty4[]' style='height:27px; width:50px;' id='qty4$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='tgl4[]' id='tgl4$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl28' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 7,
				'formatter' => function( $d, $row ) {
					$explo=explode("_",$_GET['tahap']);
					if($explo[0]==1){
						$e='-05';
					}
					if($explo[0]==2){
						$e='-11';
					}
					if($explo[0]==3){
						$e='-17';
					}
					if($explo[0]==4){
						$e='-23';
					}
					$tgl29=$_GET['tahun'].'-'.$_GET['bulan'].$e;
					return "<input type='text' name='qty5[]' style='height:27px; width:50px;' id='qty5$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='tgl5[]' id='tgl5$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl29' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 8,
				'formatter' => function( $d, $row ) {
					$explo=explode("_",$_GET['tahap']);
					if($explo[0]==1){
						$f='-06';	
					}
					if($explo[0]==2){
						$f='-12';	
					}
					if($explo[0]==3){
						$f='-18';	
					}
					if($explo[0]==4){
						$f='-24';	
					}
					$tgl30=$_GET['tahun'].'-'.$_GET['bulan'].$f;
					return "<input type='text' name='qty6[]' style='height:27px; width:50px;' id='qty6$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='tgl6[]' id='tgl6$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl30' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 9,
				'formatter' => function( $d, $row ) {
					return "<ul class='icons-list'>
					<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
					</ul>
					";
				}
			)
	);
	}else{  //======================================================tahap===================================
		$jum=$db->jumlah_hari($_GET['bulan'],$_GET['tahun']);
		$explo=explode("_",$_GET['tahap']);
		
		if($jum==31){
			include("tgl31.php");
		}
		if($jum==29){
			include("tgl29.php");
		}
		if($jum==30){
			include("tgl30.php");
		}
		if($jum==28){
			include("tgl28.php");
		}
		
		
		
		
	}


$sql_details = array(
	
);
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
	$_GET['callback'] :
	false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where2, $jenis, $limit )
	).');';
}



