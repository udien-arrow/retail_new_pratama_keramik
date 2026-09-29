   <?php
 if($_GET['cd']==''){
	
	echo "<script>location.href='index.php?x=pegawai&cd=k2';</script>"; 
 }
 if($_GET['cd']=='k2'){
 ?>
<style>
.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap}
</style>
		<div class="col-lg-12">
				<div class="panel panel-flat ">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Reload" onClick="window.location='index.php?x=pegawai&cd=k2'"></button></li>
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Master Pegawai" onClick="window.location='index.php?x=pegawai&cd=b2'"></button></li>
							</ul>
                            </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <!-- <div class="table-responsive pre-scrollable">-->
					<div class="panel-body form-horizontal">
                    <?php
					if($_POST['id']!=''){
                    	$sat=$db->select("m_pegawai","*","id_pegawai='$_POST[id]'");
					}
					foreach($sat as $val){}
					?>
					
					<div class="form-group  scrolls">
                   	 <div class="tabbable">
                        	<ul class="nav nav-tabs">
                            <li class="active"><a href="#pegawai" data-toggle="tab">Pegawai</a></li>
                            <li class=""><a href="#bank_acc" data-toggle="tab">Data Bank</a></li>
                           <li class=""><a href="#keluar_tdk" data-toggle="tab">Alamat</a></li>
                            <!-- <li class=""><a href="#foto" data-toggle="tab">Foto</a></li>-->
                            <li class=""><a href="#finger" data-toggle="tab">ID Finger</a></li>
                            <li class=""><a href="#keluar_rmh" data-toggle="tab">Hubungan</a></li>
                            <li class=""><a href="#pendidikan" data-toggle="tab">Pendidikan</a></li>
                             <li class=""><a href="#kontrak" data-toggle="tab">Status Kepegawaian</a></li>
                             <li class=""><a href="#jabatan" data-toggle="tab">Kedudukan</a></li>
                             <li class=""><a href="#status_kel" data-toggle="tab">Status Keluarga</a></li>
                              <li class=""><a href="#pengalaman" data-toggle="tab">Pengalaman Kerja</a></li>
                          </ul>
                          
                        <div class="tab-content">
                        	<input type="" name="kode" id="kode" class="form-control hidden" value="<?=$val['id_pegawai']?>">
                        	<div class="tab-pane active" id="pegawai"> 
								<?php include("pegawai.php");?>   
                            </div>
                            <div class="tab-pane" id="bank_acc">  
								<?php include("bank.php");?>    
                            </div>
                            <div class="tab-pane" id="keluar_rmh">  
                           		<?php include("data_keluarga_rmh.php");?>   
                            </div>	
                            <div class="tab-pane" id="keluar_tdk">  
                           		<?php include("data_keluarga_tdk.php");?>   
                            </div>
                            <div class="tab-pane" id="foto">  
                           		<?php include("foto.php");?>   
                            </div>	
                            <div class="tab-pane" id="finger">  
                           		<?php include("finger.php");?>   
                            </div>
                             <div class="tab-pane" id="pendidikan">  
                           		<?php include("pendidikan.php");?>   
                            </div>
                             <div class="tab-pane" id="kontrak">  
                           		<?php include("kontrak.php");?>   
                            </div>
                            <div class="tab-pane" id="jabatan">  
                           		<?php include("kedudukan.php");?>   
                            </div>
                            <div class="tab-pane" id="status_kel">  
                           		<?php include("status_kel.php");?>   
                            </div>	
                             <div class="tab-pane" id="pengalaman">  
                           		<?php include("pengalaman.php");?>   
                            </div>	
                         </div>
                      </div>
                    </div>		
                    
					</div>
        
        
        <?php }if($_GET['cd']=='b2'){?>
            <div class="col-lg-8">
		<form action="index.php?x=pegawai&cd=k2" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Data Pegawai</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Master Pegawai" onClick="window.location='index.php?x=pegawai&cd=k2'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="10%">NIK</th>
                               <th width="30%">Nama Pegawai</th>
                               <th width="20%">Cabang</th>
                               <th width="20%">Divisi</th>
                               <th width="20%">Jabatan</th>
                               <th width="10%">Telp</th>
                               <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  >
            		<input type="hidden" name="id" id="id"  value=""  >
   		  </div>
		</div>
        <div class="col-lg-4">
        <?php
                        $peg=$db->select("m_pegawai a 
						left join m_cabang b on a.id_cabang=b.id_cabang
						left join m_jabatan d on a.id_jabatan=d.id_jabatan
						left join hr_divisi e on d.id_divisi=e.id_divisi
						left join hr_m_kontrakpeg f on a.id_status=f.id_status
						left join hr_m_pangkat g on a.id_pangkat=g.id_pangkat
						","a.*,nama_cabang,nama_jabatan,nama_divisi,nama_kontrak,pangkat","id_pegawai='$_GET[id]'");
						foreach($peg as $pegval){}
						?>
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Detil Pegawai</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                    	<div class="form-group" >
						  <div class=" col-lg-3" >
                            </div>
                            <div class="thumbnail col-lg-6" >
							
							<img width="200" height="200" src="images/<?=$pegval['foto']?>">
                            </div>
                          <div class=" col-lg-3" >
                            </div>
						</div>	
                        
                        <div class="form-group" >
                        <div class=" col-lg-12" >
                        <div class=" table-responsive pre-scrollable">
                        
                       		<table width="100%" border="1" cellpadding="0" cellspacing="0" >
                                <tr>
                                      <td width="29%"align="left">&nbsp;Nama</td>
                                      <td width="71%" align="left">&nbsp; <b><?=$pegval['nama_pegawai']?></b></td>
                                </tr>
                                   
                                <tr>
                                      <td align="left">&nbsp;NIK</td>
                                      <td align="left">&nbsp; <b>
                                        <?=$pegval['nik']?>
                                      </b></td>
                              </tr>
                                <tr>
                                  <td align="left">&nbsp;No KTP</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['no_ktp']?>
                                  </b></td>
                                </tr>
                                <tr>
                                      <td align="left">&nbsp;Cabang</td>
                                      <td align="left">&nbsp; <b>
                                        <?=$pegval['nama_cabang']?>
                                      </b></td>
                              </tr>
                                <tr>
                                      <td align="left">&nbsp;Divisi</td>
                                      <td align="left">&nbsp; <b>
                                        <?=$pegval['nama_divisi']?>
                                      </b></td>
                              </tr>
                                <tr>
                                  <td align="left">&nbsp;Jabatan</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['nama_jabatan']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Jenis kelamin</td>
                                  <td align="left">&nbsp; <b>
                                    <?php
                                    if($pegval['jk']==1){
										echo "Pria";
									}
									if($pegval['jk']==2){
										echo "Wanita";
									}
									
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Alamat</td>
                                  <td align="left">&nbsp; <b>
                                   <?php
                                   foreach($db->select("hr_alamat","alamat_peg","id_pegawai='$pegval[id_pegawai]'")as $ala);
								   echo $ala['alamat_peg'];
								   
								   ?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;No telp</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['nohp']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Lahir</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_lahir']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Pendidikan</td>
                                  <td align="left">&nbsp;<b>
                                    <?php
                                   		echo $pegval['kode_pendidikan'];
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Status keluarga</td>
                                  <td align="left">&nbsp; <b>
                                    <?php
									foreach($db->select("hr_statuskel a join hr_m_statuskel b on a.id_statuskel=b.id_statuskel","b.statuskel","a.id_pegawai='$pegval[id_pegawai]'")as $stkel);
									
									echo $stkel['statuskel']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">Status Pegawai</td>
                                  <td align="left">&nbsp;<b>
                                    <?=$pegval['nama_kontrak']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Kontrak</td>
                                  <td align="left">&nbsp; <b>
                                     <?php
                                   foreach($db->select("hr_kontrakpeg","tglmulai","id_pegawai='$pegval[id_pegawai]' and id_status='1'")as $tglk);
								   
								   echo date("d-m-Y",strtotime($tglk['tglmulai']));
								   
								   ?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl PDMP</td>
                                  <td align="left">&nbsp; <b>
                                    <?php
                                     foreach($db->select("hr_kontrakpeg","tglmulai","id_pegawai='$pegval[id_pegawai]' and id_status='2' order by id_kontrak asc limit 1")as $tglk);
								   
								   echo date("d-m-Y",strtotime($tglk['tglmulai']));
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Tetap</td>
                                  <td align="left">&nbsp; <b>
                                    <?php
                                     foreach($db->select("hr_kontrakpeg","tglmulai","id_pegawai='$pegval[id_pegawai]' and id_status='3' order by id_kontrak asc limit 1")as $tglk);
								   
								   echo date("d-m-Y",strtotime($tglk['tglmulai']));
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Pensiun</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_pensiun']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Pangkat</td>
                                  <td align="left">&nbsp;<b>
                                    <?php
                                   echo $pegval['pangkat'];
									
									
									?>
                                  </b></td>
                                </tr>
                               
                               
                                <tr>
                                  <td align="left">&nbsp;Status Active</td>
                                  <td align="left">&nbsp;<b>
                                    <?php
                                    if($pegval['id_aktif']==1){
										echo "Aktif";
									}
									if($pegval['id_aktif']==2){
										echo "Penugasan";
									}
									if($pegval['id_aktif']==3){
										echo "PHK";
									}
									if($pegval['id_aktif']==4){
										echo "Resign";
									}
									if($pegval['id_aktif']==5){
										echo "Tidak Aktif";
									}
									
									
									?>
                                  </b></td>
                                </tr>
                                
                                <tr>
                                  <td align="left">&nbsp;Kode Bank</td>
                                  <td align="left">&nbsp; <b>
                                    <?php
                                     foreach($db->select("hr_pegawai_acc","*","id_peg='$pegval[id_pegawai]'")as $acc);
									 echo $acc['nama_bank'];
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Norek</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$acc['no_rek']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;No Jamsostek</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['no_jamsostek']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;No Bumiputera</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['no_bumiputera']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Email</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['email']?>
                                  </b></td>
                                </tr>
                                
                                 
                            </table>
                       </div>
                       </div>
                        </div>		
                                    
                  </div>
                    </div>
            	</div>   
 

<?php
 }
if($_POST[aksi]=='hapus'){
	$where = array("id_pegawai" => $_POST['id']);
	$db->delete("m_pegawai",$where);
	echo "<script>window.location='index.php?x=pegawai'</script>";
}
?>
