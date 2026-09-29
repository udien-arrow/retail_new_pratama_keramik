<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
//==========================jenissssssssssssssss tidak 3======================================================================
	if($_GET['jenis']==1){$dep=2;}elseif($_GET['jenis']==3){$dep=1;}
	if($_GET['gud']==''){
		$gud=$_SESSION['ID_GUDANG'];	
	}else{
		$gud=$_GET['gud'];	
	}
	$table = 'v_permintaan_pembelianunit';
	$primaryKey = 'kode_barang';
	$jenis = 'view';
	$where2="no_transit='$_GET[unt]'";
	$limit="limit 0,0";
//	echo "select * from $table where $where2";
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
			'db'        => 'id_barang',
			'dt'        => 1,
			'formatter' => function( $d, $row ) {
				return "
					<select name='sat[]' id='sat$d'  style='height:27px; width:70px; border: 1px solid #DDD'>
				      <option value='' selected>-pilih-</option>                	 
				</select>
						<script>satuan($d)</script>
				";
			}
		),
		array(
			'db'        => 'stok',
			'dt'        => 2,
			'formatter' => function( $d, $row ) {
				
				
				return "
				$d		
				";
			}
		),
		array(
			'db'        => 'qty',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty2[]' style='height:27px; width:60px;' id='qty2$d' class='form-control' autocomplete='off' value='$d' required readonly=>
				
				";
			}
		),
		
		array(
			'db'        => 'id_barang',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty1[]' style='height:27px; width:60px;' id='qty1$d' class='form-control' autocomplete='off' value='' required>
				<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
				";
			}
		),
		array(
			'db'        => 'id_barang',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				return "<ul class='icons-list'>
				<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
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
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where2, $jenis, $limit )
	).');';
}



