<?php
$tabel = "sales";
if($_POST[kode]==''){
		$max=$db->select("sales","max(ID_SALES)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'ID_SALES' => $id, 
				 'NAMA_SALES' => $_POST['nama'],
				 'ALAMAT_SALES' => $_POST['alamat'],
				 'TELP_SALES' => $_POST['telp'],
				 'STATUS_SALES' => '1',

                    );
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=sales'</script>";
}else{
		$data = array(  
				 'NAMA_SALES' => $_POST['nama'],
				 'ALAMAT_SALES' => $_POST['alamat'],
				 'TELP_SALES' => $_POST['telp'],
				 'STATUS_SALES' => '1',

                    );
               // var_dump ($data);
                //exit;
	$exec= $db->update($tabel, $data, "ID_SALES='$_POST[kode]'");
	
	echo "<script>window.location='index.php?x=sales'</script>";
}


?>