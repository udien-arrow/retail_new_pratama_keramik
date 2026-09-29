<?php
session_start();
	if($_POST[jenis]==1){
		foreach($_POST['tick'] as $key => $val){
			$data=array("id_trx"=>$val,
						"no_trx"=>$_POST[notx][$key],
						"tgl_trx"=>$_POST[tgl],
						"tgl_val"=>date("Y-m-d"),
						"id_user"=>$_SESSION['ID_LOGIN'],
						"unit"=>$_POST['unit'],
						"cabang"=>$_SESSION['ID_CABANG'],
						);
			$db->insert("bo_validasi_tmp",$data);
			//echo $key." - ".$_POST[notx][$key];
		}
 echo "<script>window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]&spk=".$_POST[spk]."'</script>";
	} else if($_POST[jenis]==3){
		
		foreach($_POST['tick'] as $key => $val){
			$data=array("id_trx"=>$val,
						"no_trx"=>$_POST[notx][$key],
						"tgl_trx"=>$_POST[tgl],
						"tgl_val"=>date("Y-m-d"),
						"id_user"=>$_SESSION['ID_LOGIN'],
						"unit"=>$_POST['unit'],
						"cabang"=>$_SESSION['ID_CABANG'],
						);
			$db->insert("bo_validasi_tmp",$data);
			//echo "$key - $_POST[notx]".$_POST[notx][$key];
		}
		echo "<script>window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'</script>";
	} else if($_POST[jenis]==2){
		foreach($_POST['tick'] as $key => $val){
			$data=array("id_trx"=>$val,
						"no_trx"=>$_POST[notx][$key],
						"tgl_trx"=>$_POST[tgl],
						"tgl_val"=>date("Y-m-d"),
						"id_user"=>$_SESSION['ID_LOGIN'],
						"unit"=>$_POST['unit'],
						"cabang"=>$_SESSION['ID_CABANG'],
						);
			$db->insert("bo_validasi_tmp",$data);
		}
	echo "<script>window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'</script>";			
	} else if($_POST[jenis]==5){
		foreach($_POST['tick'] as $key => $val){
			$data=array("id_trx"=>$val,
						"no_trx"=>$_POST[notx][$key],
						"tgl_trx"=>$_POST[tgl],
						"tgl_val"=>date("Y-m-d"),
						"id_user"=>$_SESSION['ID_LOGIN'],
						"unit"=>$_POST['unit'],
						"cabang"=>$_SESSION['ID_CABANG'],
						);
			$db->insert("bo_validasi_tmp",$data);
		} 
	echo "<script>window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]&spk=".$_POST[spk]."'</script>";			
	} else if($_POST[jenis]==6){
		foreach($_POST['tick'] as $key => $val){
			$data=array("id_trx"=>$val,
						"no_trx"=>$_POST[notx][$key],
						"tgl_trx"=>$_POST[tgl1][$key],
						"tgl_val"=>date("Y-m-d"),
						"id_user"=>$_SESSION['ID_LOGIN'],
						"unit"=>$_POST['unit'],
						"cabang"=>$_SESSION['ID_CABANG'],
						);
			$db->insert("bo_validasi_tmp",$data);
		}
	echo "<script>window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'</script>";			
	} else if($_POST[jenis]==7){
		foreach($_POST['tick'] as $key => $val){
			$data=array("id_trx"=>$val,
						"no_trx"=>$_POST[notx][$key],
						"tgl_trx"=>$_POST[tgl1][$key],
						"tgl_val"=>date("Y-m-d"),
						"id_user"=>$_SESSION['ID_LOGIN'],
						"unit"=>$_POST['unit'],
						"cabang"=>$_SESSION['ID_CABANG'],
						);
			$db->insert("bo_validasi_tmp",$data);
		}
	echo "<script>window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'</script>";			
	}

?>