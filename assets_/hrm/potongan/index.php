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
					<form class="form-horizontal" action="index.php?x=potongan_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Jenis</label>
								   <div class="col-lg-5">
									 <select class="select" name="jenis" id="jenis"  required>
									    <option value="">--Jenis--</option>
									    <?php
											$query1=$db->select("hr_m_potongan_opr","*","type='1'");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_jenis']?>"  <?php if($sel1['id_jenis']==$_GET['jen']){echo "selected";}?>>
									      <?=$sel1['nama_jenis']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Pegawai</label>
									<div class="col-lg-5">
										<select class="select-search" name="pegawai" id="pegawai" required>
									    <option value="">--Pegawai--</option>
									    <?php
											$query1=$db->select("m_pegawai","*");
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
                                 
								<div class="form-group">
									<label class="control-label col-lg-4">Tgl Mulai</label>
								   <div class="col-lg-5">
										<input type="text" name="tgl_mulai" id="tgl_mulai" class="form-control datepicker" autocomplete="off" value="<?=$val['date']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tgl Akhir</label>
								   <div class="col-lg-5">
										<input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control datepicker" autocomplete="off" value="<?=$val['date_end']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nominal</label>
								   <div class="col-lg-5">
										<input type="text" name="nominal" id="nominal" class="form-control hargab" autocomplete="off" value="<?=$val['nominal']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
								    <div class="col-lg-5">
										<textarea type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="" required><?=$val['keterangan']?></textarea>
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
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=potongan'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=potongan" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                       
					</div>                  
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th width="20%">Jenis</th>
                               <th width="20%">Nama Pegawai</th>
                               <th width="7%">Tgl Mulai</th>
                               <th width="10%">Tgl Akhir</th>
                               <th width="10%">Nominal</th>
                             
                              <th width="30%">Keterangan</th>
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
		$where = array("id" => $_POST['id']);
		$db->delete("hr_potongan",$where);
		echo "<script>window.location='index.php?x=potongan'</script>";
		}
  }
  
  
 ?> 
 

    
