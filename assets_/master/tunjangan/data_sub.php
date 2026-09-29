<?php
require( '../../../webclass.php' );
$db=new kelas;
		//$table = "m_tunjangan_dtl a left join m_dep b on a.id_dtl=b.id_dtl";
		$table = "v_tunjangan_dtl";
		//$primaryKey = "a.id_dtl='$_GET[id]'";
		$primaryKey = "id_tdtunjangan";
		$jenis = "view";
		$where2="";
		$limit="";
		$columns = array(
			array( 'db' => 'tunjangan',     'dt' => 0 ),
			array( 'db' => 'tgl_berlaku',     'dt' => 1 ),			
			array(
				'db'        => 'nominal',
				'dt'        => 2,
				'formatter' => function( $d, $row ) {
					$d=number_format($d);
					return "$d";
				}
			),

			array( 'db' => 'tingkat_golongan',     'dt' => 3 ),
			array( 'db' => 'pangkat',     'dt' => 4 ),
			array( 'db' => 'nama_cabang',     'dt' => 5 ),
			array(
		'db'        => 'id_tdtunjangan',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
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
				kelas::simple( $_POST, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
			).');';
		}

