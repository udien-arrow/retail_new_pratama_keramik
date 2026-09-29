<?php
require( '../../../webclass.php' );
$db=new kelas;
		//$table = "m_subdep a left join m_dep b on a.id_dep=b.id_dep";
		$table = "v_subdep";
		$primaryKey = "id_dep";
		$jenis = 'view';
		$where2="id_dep='$_GET[id]'";
		$limit="";
		
		$columns = array(
			array( 'db' => 'id_sub',     'dt' => 0 ),
			array( 'db' => 'nama_dep',     'dt' => 1 ),
			array( 'db' => 'nama_sub',     'dt' => 2 ),
			array(
				'db'        => 'id_sub',
				'dt'        => 3,
				'formatter' => function( $d, $row ) {
					//return date( 'jS M y', strtotime($d));
					return "<div align='center'>
					<a href='index.php?x=marchandise&slug=2&id=$_GET[id]&idsub=$d' class=' label label-primary' style='cursor:pointer'>Kategori</a>
					</div>
					";
				}
			),
			array(
				'db'        => 'id_sub',
				'dt'        => 4,
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

