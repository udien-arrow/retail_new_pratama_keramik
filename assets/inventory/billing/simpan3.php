<?php
		$tabel = "tx_billing";
		foreach($_POST['no_billing'] as $key => $val){
			if($val!=''){
				$data = array( 
						'no_faktur' => $_POST['nofak'], 
						);
				$exec= $db->update($tabel, $data, "no_billing='".$_POST[no_billing][$key]."'");
				
			
			}
			
			
		}
		echo "<script>window.location='index.php?x=billing_vv'</script>";

?>