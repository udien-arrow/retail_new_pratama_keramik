<?php
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
				'db'        => 'id_barang',
				'dt'        => 2,
				'formatter' => function( $d, $row ) {
					if($_GET['gud']==''){
							$gud=$_SESSION['ID_GUDANG'];
					}else{
							$gud=$_GET['gud'];
					}
					
					return "
					<span class='form-control' style='height:27px; width:60px;padding: 3px 12px' id='tes$d'><script>$('#tes$d').load('assets/inventory/order/mutasi.php?id=$d&gud=$gud');</script></span>
					
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 3,
				'formatter' => function( $d, $row ) {
				$tgl25=$_GET['tahun'].'-'.$_GET['bulan'].'-25';
					return "<input type='text' name='qty1[]' style='height:27px; width:50px;' id='qty1$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
					<input type='hidden' name='tgl1[]' id='tgl1$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl25' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 4,
				'formatter' => function( $d, $row ) {
				$tgl26=$_GET['tahun'].'-'.$_GET['bulan'].'-26';
					return "<input type='text' name='qty2[]' style='height:27px; width:50px;' id='qty2$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='tgl2[]' id='tgl2$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl26' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 5,
				'formatter' => function( $d, $row ) {
					$tgl27=$_GET['tahun'].'-'.$_GET['bulan'].'-27';
					return "<input type='text' name='qty3[]' style='height:27px; width:50px;' id='qty3$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='tgl3[]' id='tgl3$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl27' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 6,
				'formatter' => function( $d, $row ) {
					$tgl28=$_GET['tahun'].'-'.$_GET['bulan'].'-28';
					return "<input type='text' name='qty4[]' style='height:27px; width:50px;' id='qty4$d' class='form-control' autocomplete='off' value='' required>
					<input type='hidden' name='tgl4[]' id='tgl4$d' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$tgl28' required>
					";
				}
			),
			array(
				'db'        => 'id_barang',
				'dt'        => 7,
				'formatter' => function( $d, $row ) {
					return "<ul class='icons-list'>
					<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
					</ul>
					";
				}
			)
		);	
?>