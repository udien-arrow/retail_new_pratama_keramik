<?php
require( '../../../webclass.php' );
$db=new kelas;
		//$table = "m_tunjangan_dtl a left join m_dep b on a.id_dtl=b.id_dtl";
		$table = "v_tunjangan_dtl";
		//$primaryKey = "a.id_dtl='$_GET[id]'";
		$primaryKey = "id_dtl";
		$jenis = 'view';
		$where2="id_tunjangan='$_GET[id]'";
		$limit="";
		$columns = array(
			array( 'db' => 'id_dtl',     'dt' => 0 ),
			array( 'db' => 'nama_tunjangan',     'dt' => 1 ),
			array( 'db' => 'id_golongan',     'dt' => 2 ),
			array(
				'db'        => 'nilai',
				'dt'        => 3,
				'formatter' => function( $d, $row ) {
					$d=number_format($d);
					return "$d";
				}
			),
			array( 'db' => 'tgl_berlaku',     'dt' => 4 ),
			array(
				'db'        => 'id_dtl',
				'dt'        => 5,
				'formatter' => function( $d, $row ) {
					//return date( 'jS M y', strtotime($d));
					return "<ul class='icons-list'>
					<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
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

