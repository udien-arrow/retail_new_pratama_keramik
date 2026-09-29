
<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
	$spb=explode("_",$_GET['spb']);
if($_GET['jenis']==2){
	$table = 'v_app_prp';
	$jenis = 'input';
	//$where2="id_barang in(select id_barang from tx_order_dtl where no_order='$spb[0]' and status=0) and id_barang not in(select id_barang from tx_prp_tmp where no_order='$spb[0]') and no_order='$spb[0]' and stat_ord=0 ";
	$where2="id_barang in(select id_barang from tx_order_dtl where no_order='$spb[0]' and status=0) and no_order='$spb[0]' and stat_ord=0 ";
	$limit="limit 0,10000";
	$columns = array(
	array(
		'db'        => 'kode_barang',
		'dt'        => 0,
		'formatter' => function( $d, $row ) {
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'nama_barang',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "
				$bar
			";
		}
	),
	array(
		'db'        => 'conc',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			$dx=explode("_",$d);
			
			return "
				<select name='sat[]' id='sat$d'  style='height:27px; width:50px; bprp: 1px solid #DDD' class='select-search' onChange=satuan2('$d',this.value)>
				      <option value='' selected>-pilih-</option>                	 
				</select>
				<script>satuan('$d','')</script>
			";
		}
	),
	array(
		'db'        => 'conc',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$xp=explode("_",$d);
			if($xp[1]==''){
				$e='';	
			}else{
				$e=date('d-m-Y',strtotime($xp[1]));	
			}
			return "
			<input type='text' name='tgl_kirim2[]' style='height:27px; width:70px;' id='qty_minta$d' class='form-control datepicker' autocomplete='off' value='$e' readonly>
			";
		}
	),
	array(
		'db'        => 'conc',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			
			return "
			<input type='text' name='qty[]' style='height:27px; width:40px;' id='qty$d' class='form-control' autocomplete='off' value='' required>
			<input type='hidden' name='qty_asli[]' style='height:27px; width:40px;' id='qty_asli$d' class='form-control' autocomplete='off' value='' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='bonus[]' style='height:27px; width:40px;' id='bonus$d' class='form-control' autocomplete='off' value=''>
			<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
			";
		}
	),
	array(
		'db'        => 'conc',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='harga[]' style='height:27px; width:70px;' id='harga$d' class='form-control hargab' autocomplete='off' value='' required>
			<input type='hidden' name='harga_asli[]' style='height:27px; width:80px;' id='harga_asli$d' class='form-control' autocomplete='off' value='' required>
			<script>forma()</script>
			
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='disc[]' style='height:27px; width:40px;' id='disc$d' class='form-control' autocomplete='off' value=''>
			";
		}
	),
	
	array(
		'db'        => 'conc',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list' id='hahaha$d'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick=tambah('$d') class='icon-add' style='cursor:pointer'></a></li>
			</ul>
			";
		}
	)
);

}
elseif($_GET['jenis']==4){
	$table = 'v_prp_tolakrevisi';
	$jenis = 'view';
	$where2="no_prp='$_GET[nopp]'";
	$limit="limit 0,0";
	$columns = array(
	array(
		'db'        => 'kode_barang',
		'dt'        => 0,
		'formatter' => function( $d, $row ) {
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'nama_barang',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "
				$bar
			";
		}
	),
	array(
		'db'        => 'nama_satuan',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "$d
			";
		}
	),
	array(
		'db'        => 'tgl_kirim',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==''){
				$e='';	
			}else{
				$e=date('d-m-Y',strtotime($d));	
			}
			return "
			<input type='text' name='tgl_kirim2[]' style='height:27px; width:70px;' id='qty_minta$d' class='form-control datepicker' autocomplete='off' value='$d' readonly>
			";
		}
	),
	array(
		'db'        => 'qty',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			
			return "
			<input type='text' name='qty[]' style='height:27px; width:40px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
			<input type='hidden' name='qty_asli[]' style='height:27px; width:40px;' id='qty_asli$d' class='form-control' autocomplete='off' value='' required>
			";
		}
	),
	array(
		'db'        => 'bonus',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='bonus[]' style='height:27px; width:40px;' id='bonus$d' class='form-control' autocomplete='off' value='$d'>
			<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
			";
		}
	),
	array(
		'db'        => 'harga_beli',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='harga[]' style='height:27px; width:70px;' id='harga$d' class='form-control hargab' autocomplete='off' value='$d' required>
			<input type='hidden' name='harga_asli[]' style='height:27px; width:80px;' id='harga_asli$d' class='form-control' autocomplete='off' value='' required>
			<script>forma()</script>
			
			";
		}
	),
	array(
		'db'        => 'disc_persen',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='disc[]' style='height:27px; width:40px;' id='disc$d' class='form-control' autocomplete='off' value='$d'>
			";
		}
	),
	
	array(
		'db'        => 'id_barang',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "
			";
		}
	)
);

}

elseif($_GET['jenis']==3 ){
	$table = 'v_barang_notif';
	$jenis = 'input';
	//$where2 ="id_gudang='$_GET[spb]' and id_barang not in(select id_barang from tx_prp_tmp where id_gudang='$_GET[spb]') and status=0";
	$where2 ="id_gudang='$spb[0]' and status=0";
	$limit="limit 0,10000";
	$columns = array(
	array(
		'db'        => 'kode_barang',
		'dt'        => 0,
		'formatter' => function( $d, $row ) {
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'nama_barang',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "
				$bar
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "
				<select name='sat[]' id='sat$d'  style='height:27px; width:50px; bprp: 1px solid #DDD' class='select-search' onChange='satuan2($d,this.value)'>
				      <option value='' selected>-pilih-</option>                	 
				</select>
				<script>satuann($d,'')</script>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='tgl_kirim2[]' style='height:27px; width:78px;' id='qty_minta$d' class='form-control datepicker' autocomplete='off' value='' >
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			
			return "
			<input type='text' name='qty[]' style='height:27px; width:40px;' id='qty$d' class='form-control' autocomplete='off' value='' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='bonus[]' style='height:27px; width:40px;' id='bonus$d' class='form-control' autocomplete='off' value=''>
			<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='harga[]' style='height:27px; width:70px;' id='harga$d' class='form-control hargab' autocomplete='off' value='' required>
			<input type='hidden' name='harga_asli[]' style='height:27px; width:80px;' id='harga_asli$d' class='form-control' autocomplete='off' value='' required>
			<input type='hidden' name='jen_bar[]' style='height:27px; width:80px;' id='jen_bar$d' class='form-control' autocomplete='off' value='' required>
			<script>forma()</script>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='disc[]' style='height:27px; width:40px;' id='disc$d' class='form-control' autocomplete='off' value=''>
			";
		}
	),
	
	array(
		'db'        => 'id_barang',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
			</ul>
			";
		}
	)
);
}elseif($_GET['jenis']==1){
	$expl=explode("_",$_GET['spb']);
	$table = 'v_app_da';
	$jenis = 'input';
	$where2="no_sales='$expl[0]'";
	$limit="limit 0,10000";
	$columns = array(
	array(
		'db'        => 'kode_barang',
		'dt'        => 0,
		'formatter' => function( $d, $row ) {
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'nama_barang',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "
				$bar
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "
				<select name='sat[]' id='sat$d'  style='height:27px; width:50px; bprp: 1px solid #DDD' class='select-search' onChange='satuan2($d,this.value)'>
				      <option value='' selected>-pilih-</option>                	 
				</select>
				<script>satuann($d,'')</script>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='tgl_kirim2[]' style='height:27px; width:70px;' id='qty_minta$d' class='form-control datepicker' autocomplete='off' value='' placeholder='dd-mm-yyyy'>
			";
		}
	),
	array(
		'db'        => 'conc',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);
			return "
			<input type='text' name='qty[]' style='height:27px; width:40px;' id='qty$exp[0]' class='form-control' autocomplete='off' value='$exp[2]' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='bonus[]' style='height:27px; width:40px;' id='bonus$d' class='form-control' autocomplete='off' value=''>
			<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='harga[]' style='height:27px; width:70px;' id='harga$d' class='form-control hargab' autocomplete='off' value='' required>
			<input type='hidden' name='harga_asli[]' style='height:27px; width:80px;' id='harga_asli$d' class='form-control' autocomplete='off' value='' required>
			<input type='hidden' name='jen_bar[]' style='height:27px; width:80px;' id='jen_bar$d' class='form-control' autocomplete='off' value='' required>
			<script>forma()</script>
			
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='disc[]' style='height:27px; width:40px;' id='disc$d' class='form-control' autocomplete='off' value=''>
			";
		}
	),
	
	array(
		'db'        => 'id_barang',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
			</ul>
			";
		}
	)
);

}
$primaryKey = 'id_barang';
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





