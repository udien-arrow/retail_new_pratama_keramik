<?php
$etgl=explode("-",$_GET[tgl]);
$tbl="tx_".(int)($etgl[1])."".$etgl[0];
foreach($db->select("$tbl","*","id_inc='$_GET[idj]'") as $v){}
foreach($db->select("m_tarifcash","*","cabang='$_SESSION[ID_CABANG]' AND status='1' limit 0,1") as $vt){}
?>


        
