<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_claim_pabrik';
$primaryKey = 'id_dtl';
$jenis = 'input';
$where2="no_retur='$_GET[id]'  and id_barang NOT IN (SELECT id_barang FROM ex_claim_pab_tmp WHERE id_user='$_SESSION[ID_LOGIN]')";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
			'db'        => 'gab',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$sc=explode("-",$d);
				return "<input type='text' name='qty_retur[]' style='height:27px; width:60px;' id='qty_retur$sc[0]' class='form-control' autocomplete='off' value='$sc[1]' required readonly>
				<input type='hidden' name='satuan[]' style='height:27px; width:60px;' id='satuan$sc[0]' class='form-control' autocomplete='off' value='$sc[5]' required readonly>
				<input type='hidden' name='hargabeli[]' style='height:27px; width:60px;' id='hargabeli$sc[0]' class='form-control' autocomplete='off' value='$sc[4]' required readonly>
				<input type='hidden' name='gudangs' style='height:27px; width:60px;' id='gudangs$sc[0]' class='form-control' autocomplete='off' value='$sc[3]' required readonly>
				<input type='hidden' name='supp' style='height:27px; width:60px;' id='supp$sc[0]' class='form-control' autocomplete='off' value='$sc[6]' required readonly>
				<input type='hidden' name='no_retur' style='height:27px; width:60px;' id='no_retur$sc[0]' class='form-control' autocomplete='off' value='$sc[7]' required readonly>
				";
			}
		),
	array(
			'db'        => 'id_barang',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty_claim[]' style='height:27px; width:60px;' id='qty_claim$d' class='form-control' autocomplete='off' value='' required>
				<input type='hidden' name='id_barang[]' style='height:27px; width:60px;' id='id_barang' class='form-control' autocomplete='off' value='$d' required readonly>
				
				
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
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
	).');';
}



