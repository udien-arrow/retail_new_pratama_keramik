<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_barang_so2';
$primaryKey = 'id_barang';
$jenis = 'view';
$idgudangs=$_GET['gudang'];
$where2="id_gudang='$idgudangs' and id_barang NOT IN (SELECT id_barang FROM tx_stok_opname_tmp WHERE id_gudang = '$idgudangs')";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array(
				'db'        => 'gab',
				'dt'        => 2,
				'formatter' => function( $d, $row ) {
				$ek=explode("_",$d);
				$gud=$_GET['gudang'];
					return "
				<input type='text' name='stok_sys[]' id='stok_sys$ek[0]' style='height:27px; width:80px;'  class='form-control ' autocomplete='off' required readonly>
					<script>satuan('$ek[0]','$gud')</script>
					";
				}
			),
	array(
		'db'        => 'gab',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$ek=explode("_",$d);
			$gud=$_GET['gudang'];
			if($ek[1]==0){
			$k="";	
			}else{$k="";}
			return "<input type='text' name='stokfisik[]' id='stokfisik$ek[0]' style='height:27px; width:80px;'  class='form-control ' autocomplete='off'  required $k>
			<input type='hidden' name='hpp[]' id='hpp$ek[0]' style='height:27px; width:80px;'  class='form-control ' autocomplete='off'  required $k value='$ek[1]'>
			<input type='hidden' name='id_barang[]' value='$ek[0]' id='id_barang$ek[0]' style='height:27px; width:80px;'  class='form-control ' autocomplete='off' required>
			";
		}
	),
	array(
		'db'        => 'gab',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$ek=explode("_",$d);
			if($ek[1]==0){
			$k="readonly";	
			}else{$k="";}
			return "<input type='text' name='keterangan[]' id='keterangan$ek[0]' style='height:27px; width:80px;'  class='form-control ' autocomplete='off' $k>
			";
		}
	),
	array(
		'db'        => 'gab',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$ek=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'></li>
			</ul>
			";
		}
	)
);
$sql_details = array(
	
);
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
	$_GET['callback'] :
	false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
	).');';
}



