<?php
	foreach($_POST['no_faktur'] as $key => $val){
	  if(str_replace(",","",$_POST['dibayar'][$key]) > 0){
				$data = array( 
						'no_faktur' => $val,
						'id_cus' => $_POST['cus'],
						'total_hutang' => str_replace(",","",$_POST['total_hutang'][$key]),
						'id_user' => $_SESSION['ID_LOGIN'],
						'total_dibayar' => str_replace(",","",$_POST['dibayar'][$key]),
						'stampdate' => date("Y-m-d H:i:s"),
					);
				$exec= $db->insert("tx_hutang_tmp", $data);
			
		}//end if
	}//end for
	
	echo "<script>window.location='index.php?x=hutang&cus=$_POST[cus]'</script>";	

?>