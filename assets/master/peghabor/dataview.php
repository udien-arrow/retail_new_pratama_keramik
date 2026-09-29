<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_pegawai_habor_re';
$primaryKey = 'id_pegawai';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_pegawai',     'dt' => 0 ),
	array( 'db' => 'nama_jabatan',     'dt' => 1 ),
	array( 'db' => 'nama_kontrak',     'dt' => 2 ),
	array( 'db' => 'tgl_mulai',     'dt' => 3 ),
	array( 'db' => 'no_ktp',     'dt' => 4 ),
	array( 'db' => 'alamat',     'dt' => 5 ),
	array( 'db' => 'nama_kontrak',     'dt' => 6 ),
	array(
		'db'        => 'id_pegawai',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
				$e=date('Y-m-d');	
			return "
			<script>
			$('.datepicker').datepicker();
				 $('.datepicker-menus').datepicker({
					changeMonth: true,
					changeYear: true
				 });
			</script>

			<input type='text' name='tgl_keluar[]' style='height:27px; width:90px;' id='tgl_keluar$d' class='form-control datepicker' autocomplete='off' value='$e'>
			";
		}
	),
	array(
		'db'        => 'gab',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$expl=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='tambah($expl[0])' style='cursor:pointer' class='icon-rotate-ccw3'></a></li>
			</ul>
			<input type='hidden' name='gab[]' id='gab$expl[0]' value='$d'>
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



