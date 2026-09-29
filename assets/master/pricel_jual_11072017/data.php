<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_price_jual';
$primaryKey = 'id_barang';
$jenis = 'view';
$where2="id_cabang='$_GET[cab]'  and id_barang not in(select id_barang from m_pricelist_jual_tmp where id_cabang='$_GET[cab]') group by id_barang";
$limit="";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	//array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
		'db'        => 'id_barang',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "
				<select name='sat[]' id='sat$d'  style='height:27px; width:70px; border: 1px solid #DDD' onChange='hitung($d)'>
				      <option value='' selected>-pilih-</option>                	 
				</select>
				<script>satuan($d)</script>
			";
		}
	),
	array(
		'db'        => 'hpp',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$dt=explode("_",$d);
			return "<input type='text' name='hpp[]' style='height:27px; width:80px;' id='hpp$dt[1]' class='form-control' autocomplete='off' value='$dt[0]' readonly>
			<input type='hidden' name='hpp_h$d' style='height:27px; width:80px;' id='hpp_h$dt[1]' class='form-control' autocomplete='off' value='$dt[0]' readonly>
			";
		}
	),
	array(
		'db'        => 'hpp',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$dt=explode("_",$d);
			if($_GET['per']=='' || $_GET['per']==0){
				$harga=0;
			}else{
				
				$harga=($dt[0]*$_GET['per']/100);
				$harga=$dt[0]+$harga;
			}
			return "<input type='text' name='harga[]' style='height:27px; width:80px;' id='harga$dt[1]' class='form-control' autocomplete='off' value='$harga' required>
			<input type='hidden' name='harga_h$d' style='height:27px; width:80px;' id='harga_h$dt[1]' class='form-control' autocomplete='off' value='$harga' required>
			";
		}
	),
	array(
		'db'        => 'hpp',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$dt=explode("_",$d);
			if($_GET['per']=='' || $_GET['per']==0){
				$harga=$dt[2];
			}else{				
				$harga=($dt[0]*$_GET['per']/100);
				$harga=$dt[0]+$harga;
			}
			return "<input type='text' name='harga_cetak[]' style='height:27px; width:80px;' id='harga_cetak$dt[1]' class='form-control' autocomplete='off' value=''>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datapelanggan' onClick='cekPel($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			</ul>
			<input type='hidden' name='idbar[]' style='height:27px; width:80px;' id='idbar[]' class='form-control' autocomplete='off' value='$d' required>
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



