<!-- Theme JS files -->
<style>
        table {
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid #DDD ;
            padding:1px;
        }
</style>
<?php	
if($_POST[simpan]){
	include("simpan2.php");
}
if($_POST[aksi]=='hapus'){
	
}elseif($_POST[aksi]=='batal'){
	
}else{
	foreach($db->select("bo_validasi_tmp","count(*) as c","tgl_trx='$_GET[tgl]' AND unit='$_GET[unit]' and cabang='$_SESSION[ID_CABANG]'") as $vc){}

?>	
<div class="col-lg-8">
		<form action="index.php?x=vdasi_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Posting" onClick="window.location='index.php?x=brg_masuk_v'"></button>
                                	<?php
									if($vc[c]>0){
									?>
                                    <input style="height:25px; line-height: 0;" type="button" class="btn btn-warning" value="Posting" onClick="window.location='index.php?x=vdasipos&tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>&jenis=<?=$_GET[jenis]?>'"></button>
                                    <?php } ?>
                                </li>
							</ul>
                        </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="5">
                                <div class="form-group" >
                                   <div class="col-lg-2">
                                    <input name="tgl" id="tgl" class="form-control datepicker1" value="<?=$_GET[tgl]?>"/>
                                   </div> 
                                   <div class="col-lg-3">
                                    <select name="unit" id="unit" class="select">
                                    	<?php
										foreach($db->select("m_unit","*","id_cabang='$_SESSION[ID_CABANG]'") as $vunit){
										?>
                                        	<option value="<?=$vunit['id_unit']?>"><?=$vunit[nama_unit]?></option>
                                        <?php	
										}
										?>
                                    </select>
                                   </div> 
                                   <div class="col-lg-4">
                                    <select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value,tgl.value,unit.value)">
                                      <option value="0">---Jenis---</option>
                                      <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?>>Credit Card</option>
                                      <option value="2" <?php if($_GET['jenis']==2){echo "selected";}?>>Debit Card</option>
                                      <option value="3" <?php if($_GET['jenis']==3){echo "selected";}?>>Cash</option>
                                      <option value="5" <?php if($_GET['jenis']==5){echo "selected";}?>>Mitra Lain</option>
                                      <option value="6" <?php if($_GET['jenis']==6){echo "selected";}?>>Reflexy</option>
                                      <option value="7" <?php if($_GET['jenis']==7){echo "selected";}?>>VIP Room</option> 
                                    </select>
                                  </div> 
                                    <?php if($_GET['jenis']==1){?>
                                    <div class="col-lg-5">
                                    
                                    </div>
                                    <?php }elseif($_GET['jenis']==6){ ?>
                                     <div class="col-lg-7">
                                    
                                    </div>
                                    <?php }elseif($_GET['jenis']==7){ ?>
                                     <div class="col-lg-7">
                                    
                                    </div>
                                    
                                    <?php }?> 
                                </th>
                              <th>
                              <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'>&nbsp;Tambah</a>
                              
                              </th>
                            </tr>
                            <?php
							if($_GET['jenis']==3 OR $_GET['jenis']==2){
							?>
                            <tr>
                                <th width="10%">No Trans</th>
                                <th width="30%">Nama</th>
                              	<th width="5%">Tujuan</th>
                                <th width="10%">Tgl & Waktu</th>
                              	<th width="5%">Qty</th>
                                <th width="5%">Total</th>
                                <th width="3%"><input type="checkbox" name="call" id="call" onclick="checkall()"/></th>
                                <th width="5%">#</th>

                            </tr>
                            <?php } 
							if($_GET['jenis']==1){
							?>
                            <tr>
                                <th width="10%">No Trans</th>
                                <th width="30%">Nomor Kartu</th>
                                <th width="80%">Nama</th>
                              	<th width="5%">Tujuan</th>
                              	<th width="5%">Qty</th>
                                <th width="5%">Total</th>
                                <th width="3%">#</th>
                                <th width="5%">#</th>
                            </tr>
                            <?php	
								}
							?>
                               
                       </thead>
            </table>
                    <?php
					if($_GET['spb']!=''){
						$explod=explode("_",$_GET['spb']);
						$po=$db->select("tx_po","id_supp,id_valuta,kurs,id_po,id_prp,disc_persen","no_po='$explod[0]'");
						foreach($po as $valpo){}
					}if($_GET['spj']!=''){
						$explod=explode("_",$_GET['spj']);
						$po=$db->select("v_spj_rilis","id_supp","no_spj='$explod[1]'");						foreach($po as $valpo){}
					}if($_GET['spm']!=''){
						$explod=explode("_",$_GET['spm']);
						$po=$db->select("tx_bm_order","id_supp","no_order='$explod[0]'");						foreach($po as $valpo){}
					}
					
					?>
		   			<input type="hidden" name="id_supp" id="id_supp"  value="<?=$valpo[id_supp]?>"  required>
            		<input type="hidden" name="id" id="id"  value="<?php if($_GET[spb]!=''){echo $_GET[spb];}elseif($_GET[spj]!=''){echo $_GET[spj];}elseif($_GET[spm]!=''){echo $_GET[spm];}?>"  required>
           			<input type="hidden" name="id_valuta" id="id_valuta"  value="<?php if($_GET[spb]==''){echo '1';}elseif($_GET[spj]==''){echo $valpo[id_valuta];}?>"  required>
                    <input type="hidden" name="kurs" id="kurs" value="<?php if($_GET[spb]==''){echo '1';}elseif($_GET[spj]==''){echo $valpo[kurs];}?>"   required>
                    <input type="hidden" name="id_po" id="id_po" value="<?=$valpo[id_po]?>"   required>
                    <input type="hidden" name="id_prp" id="id_prp" value="<?=$valpo[id_prp]?>"   required>
                    <input type="hidden" name="jenis_in" id="jenis_in" value="<?=$_GET[jenis]?>"   required>
                    <input type="hidden" name="disc_persen" id="disc_persen" value="<?=$valpo[disc_persen]?>"   required>
                    
           			 <input type="hidden" name="tambah_in" id="tambah_in" value=""   required>
   		  </div>
			</form>
		</div>
         
		<div class="col-lg-4">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Edit Transaksi</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=vdasi" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>

<?php }?>