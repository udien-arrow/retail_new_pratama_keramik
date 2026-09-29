<?php
	require( '../../../webclass.php' );
	$db=new kelas;
	$exp=explode("/",$_GET['spb']);
	$sat=$db->select("  m_barang_gudang a 
						left join m_satuan b on a.id_satuan=b.id_satuan
						","a.id_satuan,b.nama_satuan,'1'as konv"," 
						a.id_barang='$_GET[id]' and a.id_gudang='$_GET[gud]'
					    union
					    select d.sat2 as id_satuan,b.nama_satuan,d.konv from m_konversi d 
						left join m_satuan b on d.sat2=b.id_satuan where 
					    d.id_barang='$_GET[id]' ");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['id_satuan'].'_'.$val['konv']?>"><?php echo $val['nama_satuan']?></option>
	<?php
		
		if($val['qty']!=''){
			$k=$val['sat'];
			$konvv=$val['konv'];
		}
	}//end for	
	//$mut=$db->cek_mutasi($_GET[id],$_GET[gud]);
	//$akhir=$mut['akhir'];
	//if($akhir==''){$akhir=0;}else{$akhir=$akhir;}
	
?>	
	<script>
		//$("#qty_akhir<?php echo $_GET['id'];?>").val('<?php echo $akhir;?>');
    </script>	

