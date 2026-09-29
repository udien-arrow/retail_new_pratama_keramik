<?php if($_GET[slug]==''){?>   
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_potongan","*","id='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=nilaipeg_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                 
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Pegawai</label>
									<div class="col-lg-5">
										<select class="select-search" name="pegawai" id="pegawai" required>
									    <option value="">--Pegawai--</option>
									    <?php
											$query1=$db->select("m_pegawai","*","id_aktif<5");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_pegawai']?>"  <?php if($sel1['id_pegawai']==$val['id_pegawai']){echo "selected";}?>>
									      <?=$sel1['nama_pegawai']?>
								        </option>
									    <?php } ?>
								    </select>
								      <input type="hidden" name="kode" id="kode2" class="form-control" value="<?=$val['id']?>"  required>
									</div>
								</div>
                                <?php include("bulantahun2.php");?>
                              
                      <div class="form-group">
									<label class="control-label col-lg-4">Nilai</label>
						 <div class="col-lg-5">
							  <input type="text" name="nilai" id="nilai" class="form-control hargab" autocomplete="off" value="<?=$val['nilai']?>" required>
									</div>
								</div>
                               <!--<div class="form-group">
									<label class="control-label col-lg-4">tes</label>
								   <div class="col-lg-5">
										<select name="aaa" id="aaa">
                                        	<option value="">--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                        
									</div>
								</div>
                                
                                <div class="form-group" style="display:none" id="coba">
									<label class="control-label col-lg-4">Keterangan</label>
								   <div class="col-lg-5" >
										<textarea type="text" name="ket11" id="ket11" class="form-control" autocomplete="off" value="" required><?=$val['ket_potongan']?></textarea>
									</div>
								</div>-->
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=nilaipeg'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=nilaipeg" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                       
					</div>                  
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th width="20%">Nama Pegawai</th>
                               <th width="7%">Periode</th>
                               <th width="10%">Nilai</th>
                             	<th width="5%">Aksi</th>
                            </tr>
                        </thead>
                    </table><input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
				</div>
                </form>
		</div>
 <?php 
 		if($_POST['aksi']!=''){
		$where = array("id" => $_POST['id']);
		$db->delete("hr_penilaian_pegawai",$where);
		echo "<script>window.location='index.php?x=nilaipeg'</script>";
		}
  }
  
  
 ?> 
 

    
