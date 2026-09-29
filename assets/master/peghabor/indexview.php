  <style>
  .scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
  </style> 
		<div class="col-lg-1">
        </div>
        <div class="col-lg-10">
		<form action="index.php?x=peghabor_v" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">Table
						Pegawai Harian & Borongan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li>
                              <input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=peghabor'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="1%">Nama</th>
                              	<th width="10%">Jabatan</th>
                                <th width="10%">Status</th>
                                <th width="10%">Tgl Mulai</th>
                                <th width="10%">No KTP</th>
                                
                                <th width="10%">Alamat</th>
                                <th width="4%">Jenis</th>
                                <th width="4%">Tgl Keluar</th>
                                <th width="4%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
                    <input type="hidden" name="tglout" id="tglout"  value=""  required>
                    <input type="hidden" name="gabin" id="gabin"  value=""  required>
   		  </div>
			</form>
		</div>
<?php
if($_POST['aksi']=='ijen'){
				$id=$db->idurut("m_pegawai_habor","id");
				$exp=explode("_",$_POST['gabin']);
				//28_1_5_Suparno_12212_4_2016-08-27_2_Turi
				$data = array( 
				'id' => $id, 
				'id_pegawai' => $exp[0],
				'id_cabang' => $exp[1],
				'id_jabatan' => $exp[2],
				'no_ktp' => $exp[4],
				'id_status' => $exp[5],
				'tgl_mulai' => $exp[6],
				'tgl_keluar' => date("Y-m-d",strtotime($_POST['tglout'])),
				'nama_pegawai' => $exp[3],
				'jenis' => $exp[7],
				'alamat' => $exp[8],
				'status' => 0
				);
				//var_dump($data);
				//die();
				$exec= $db->insert("m_pegawai_habor", $data);

}
if($_POST[aksi]=='hapus'){
	$where = array("id" => $_POST['id']);
	$db->delete("m_pegawai_habor",$where);
	echo "<script>window.location='index.php?x=peghabor'</script>";
}
?>