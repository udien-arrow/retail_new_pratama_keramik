<?php
require( '../../../webclass.php' );
$db=new kelas;
		//$table = "m_kat a left join m_dep b on a.id_dep=b.id_dep";
		$table = "v_kat";
		$primaryKey = "id_kat";
		$jenis = 'view';
		$where2="id_sub='$_GET[idsub]'";
		$limit="";
		$columns = array(
			array( 'db' => 'id_kat',     'dt' => 0 ),
			array( 'db' => 'nama_sub',     'dt' => 1 ),
			array( 'db' => 'nama_kat',     'dt' => 2 ),
			array(
				'db'        => 'id_kat',
				'dt'        => 3,
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
				kelas::simple( $_POST, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit )
			).');';
		}

