<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_buku_tagihan';
$primaryKey = 'id_piutang';
$jenis = 'view';
//$where2="status='1' and no_faktur_jual NOT IN (SELECT no_fj FROM tx_buku_tagihan_tmp WHERE id_user = '$_SESSION[ID_LOGIN]') and status_bayar='0'";
$where2="id_cabang='$_SESSION[ID_CABANG]' and status='1' and no_faktur_jual NOT IN (SELECT no_fj FROM tx_buku_tagihan_tmp WHERE id_user = '$_SESSION[ID_LOGIN]') and status_bayar='0' and no_faktur_jual not in(select no_fj from tx_buku_tagihan_dtl where no_fj not in (select no_fj from tx_tagihan_kembali_dtl))";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'nama_usaha',     'dt' => 0 ),
	array( 'db' => 'no_faktur_jual',     'dt' => 1 ),
	array( 'db' => 'no_ref',     'dt' => 2 ),
	array( 'db' => 'tempo_normal',     'dt' => 3 ),
	array( 'db' => 'tempo_tambahan',     'dt' => 4 ),
	array(
			'db'        => 'gab',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				$g=explode("_",$d);
				$ad=number_format($g[1]);
				return "<input type='text' name='totalpiutang[]' style='height:27px; width:90px;' id='totalpiutang$g[0]' class='form-control' autocomplete='off' value='$ad' required readonly>
				<input type='hidden' name='idcus[]' style='height:27px; width:90px;' id='idcus$g[0]' class='form-control' autocomplete='off' value='$g[2]' required readonly>
				<input type='hidden' name='idp[]' style='height:27px; width:90px;' id='idp$g[0]' class='form-control' autocomplete='off' value='$g[0]' required readonly>
				<input type='hidden' name='tempo_normal[]' style='height:27px; width:90px;' id='tempo_normal$g[0]' class='form-control' autocomplete='off' value='$g[3]' required readonly>
				<input type='hidden' name='tempo_tambahan[]' style='height:27px; width:90px;' id='tempo_tambahan$g[0]' class='form-control' autocomplete='off' value='$g[4]' required readonly>
				";
			}
		),
	array(
		'db'        => 'id_piutang',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li id='bukubg$d' style='display:none'  data-toggle='modal' data-target='#databg' class='text-primary-200'><a title='Buku BG' href='javascript:void(0)' onclick='show($d)' class='icon-magazine' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
			</ul>
			<script>ambilbg($d)</script>
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



