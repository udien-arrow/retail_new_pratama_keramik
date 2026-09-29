<?php 

				
$s=$db->select("m_supplier","ifnull(pph,0) as pph","id_supp='$valtmp[id_supp]'");
				foreach($s as $pps){}
				if($pps['pph']==0){
				$pph2=$valtmp2['qty_terima']*$harga_beli_bm;
				}else{
				$pph2=$valtmp2['qty_terima']*$harga_beli_bm*$pps['pph']/100;
				}
				$hutang=$persedian2+$ppn2+$pph2;

?>