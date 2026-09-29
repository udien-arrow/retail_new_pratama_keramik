<?php if($_GET[slug]==''){?>   
    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Penjualan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_penjualan_jenis","*","id_jenis_jual='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=jenis_jual_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Jenis Penjualan</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_jenis_jual']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_jenis_jual']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-7">
										<input type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="<?=$val['keterangan']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=jenis_jual'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=jenis_jual" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Jenis Penjualan</h5>
					</div>                  
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th width="3%">Kode </th>
                              <th width="25%">Nama Jenis Penjualan</th>
                              <th width="50%">Keterangan </th>
                              <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                    </table><input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
				</div>
                </form>
		</div>
       
 <?php 
 		if($_POST['aksi']!=''){
		$where = array("id_jenis_jual" => $_POST['id']);
		$db->delete("m_penjualan_jenis",$where);
		echo "<script>window.location='index.php?x=jenis_jual'</script>";
		}
  }
 ?>

    
