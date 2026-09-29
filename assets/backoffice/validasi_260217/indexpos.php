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
$etgl=explode("-",$_GET[tgl]);
foreach($db->select("bo_validasi_tmp","count(*) as c","tgl_trx='$_GET[tgl]' AND unit='$_GET[unit]' and cabang='$_SESSION[ID_CABANG]'") as $vc){}
foreach($db->select("m_unit a JOIN m_cabang b ON a.id_cabang=b.id_cabang","*","a.id_unit='$_GET[unit]'") as $vc){}
switch($_GET[jenis])
{
	case 1;
	$j="Kartu Kredit";
	break;
	case 2;
	$j="Kartu Debit";
	break;
	case 3;
	$j="Cash";
	break;
	case 4;
	$j="Void";
	break;
	case 5;
	$j="Mitra Lain";
	break;
	case 6;
	$j="Reflexy";
	break;
	case 7;
	$j="VIP Room";
	break;
	
	}
	
?>	
<div class="col-lg-12">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Posting Validasi</h5>
        </div>
        <div class="dataTables_wrapper">
        <div class="table-responsive pre-scrollable">
       
        <div class="panel-body">
            <div class="tabbable">
              <form class="form-horizontal" action="index.php?x=vdasipos_s" name="formku" id="formku" method="post">
                 <div class="form-group">
                    <label class="control-label col-lg-3 form-group ">Tanggal Transaksi</label>
                    <div class="col-lg-6">
                   <!-- <input type="" value="<?=$tgls?>" name="tgls_spj" id="tgls_spj">-->
                         <div class="input-group">
                          <input type="text" class="form-control" name="tgl_trx" id="tgl_trx" value="<?=$_GET[tgl]?>" readonly="readonly">
                          
                         </div>
                     </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3 form-group ">Cabang - Unit</label>
                    <div class="col-lg-4">
                   
                          <input type="text" class="form-control" name="nama" id="nama" value="<?=$vc[nama_cabang]." - ".$vc[nama_unit]?>" readonly="readonly">
                   
                     </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3 form-group ">Jenis Transaksi</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control" name="tujuan" id="tujuan" value="<?=$j?>" required readonly="readonly"> 
                  </div>
                </div>
                <?php
				if($_GET[jenis]==3){
				?>
                <div class="form-group">
                  <div class="col-lg-3">
                  </div>
                  <div class="col-lg-7">
                  	
                    <table width="100%" border="1">
                      <tr>
                        <td width="14%" align="center"><strong>No</strong></td>
                        <td width="44%" align="center"><strong>Jenis Transaksi</strong></td>
                        <td width="23%" align="center"><strong>Qty</strong></td>
                        <td width="19%" align="center"><strong>Total</strong></td>
                      </tr>
                      <?php
					  $no=1;
					  
					  foreach($db->select("bo_validasi_tmp a JOIN tx_".(int)($etgl[1])."$etgl[0] b ON a.id_trx=b.id_inc","sum(qty) as qty, sum(nominal) as total","substr(a.no_trx,1,2)='CH'") as $vdtl){
						 
					?>	
                      <tr>
                        <td width="14%" align="center"><strong><?=$no?></strong></td>
                        <td width="44%" align="left"><strong><?=$j?></strong></td>
                        <td width="23%" align="center"><strong><?=number_format($vdtl[qty])?></strong></td>
                        <td width="19%" align="right"><strong><?=number_format($vdtl[total])?></strong></td>
                      </tr>	  
					 <?php 
						  }
					  ?>
                    </table>
                    
                  </div>
               </div>
               <div class="form-group">
                <label class="control-label col-lg-3">Jenis Arus Kas</label>
                <div class="col-lg-3">
                    <select name="aruskas" class="select-search" required>
                    <option value="">Pilih Jenis Arus Kas</option>
                    <?php
                        foreach($db->select("ak_paruskas","*") as $k){
                            echo"<option value=\"$k[id_param]\">$k[nama]</option>";	
                        }
                    ?>
                    </select>
                </div>
              </div>  
              <div class="form-group">
                    <label class="control-label col-lg-3 form-group ">Penerimaan</label>
                    <div class="col-lg-4">
                    	<form method="post" action="index.php?x=vdasipos_s" enctype="application/x-www-form-urlencoded">
                    	<input type="hidden" name="cabang" id="cabang" value="<?=$_SESSION[ID_CABANG]?>" />
                        <input type="hidden" name="unit" id="unit" value="<?=$_GET[unit]?>" />
                        <input type="hidden" name="tgl" id="tgl" value="<?=$_GET[tgl]?>" />
                        <input type="hidden" name="jenis" id="jenis" value="<?=$_GET[jenis]?>" />
                        <input type="hidden" name="qty" id="qty" value="<?=$vdtl[qty]?>" />
                        <input type="hidden" name="total" id="total" value="<?=$vdtl[total]?>" />
                        
                   		<select name="acc" id="acc" class="select">
                        	<option value="">Pilih Rekening Penerimaan</option>
                            <?php
							foreach($db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' and kb='1'") as $vb){
								echo"<option value=\"$vb[account]\">$vb[description]</option>";	
								
							}
							?>
                        </select>
                        
                   
                     </div>
                </div>
				 <?php } ?>
                 <!-- =============== End jenis 3 / Cash =============== -->
                 
                 <?php
				if($_GET[jenis]==2){
				?>
                <div class="form-group">
                  <div class="col-lg-3">
                  </div>
                  <div class="col-lg-7">
                  	
                    <table width="100%" border="1">
                      <tr>
                        <td width="14%" align="center"><strong>No</strong></td>
                        <td width="44%" align="center"><strong>Jenis Transaksi</strong></td>
                        <td width="23%" align="center"><strong>Qty</strong></td>
                        <td width="19%" align="center"><strong>Total</strong></td>
                      </tr>
                      <?php
					  $no=1;
					  
					  foreach($db->select("bo_validasi_tmp a JOIN tx_".(int)($etgl[1])."$etgl[0] b ON a.id_trx=b.id_inc","sum(qty) as qty, sum(nominal) as total","substr(a.no_trx,1,2)='DC'") as $vdtl){
						 
					?>	
                      <tr>
                        <td width="14%" align="center"><strong><?=$no?></strong></td>
                        <td width="44%" align="left"><strong><?=$j?></strong></td>
                        <td width="23%" align="center"><strong><?=number_format($vdtl[qty])?></strong></td>
                        <td width="19%" align="right"><strong><?=number_format($vdtl[total])?></strong></td>
                      </tr>	  
					 <?php 
						  }
					  ?>
                    </table>
                    
                  </div>
               </div>
               <div class="form-group">
                <label class="control-label col-lg-3">Jenis Arus Kas</label>
                <div class="col-lg-3">
                    <select name="aruskas" class="select-search" required>
                    <option value="">Pilih Jenis Arus Kas</option>
                    <?php
                        foreach($db->select("ak_paruskas","*") as $k){
                            echo"<option value=\"$k[id_param]\">$k[nama]</option>";	
                        }
                    ?>
                    </select>
                </div>
              </div>  
              <div class="form-group">
                    <label class="control-label col-lg-3 form-group ">Penerimaan</label>
                    <div class="col-lg-4">
                    	<form method="post" action="index.php?x=vdasipos_s" enctype="application/x-www-form-urlencoded">
                    	<input type="hidden" name="cabang" id="cabang" value="<?=$_SESSION[ID_CABANG]?>" />
                        <input type="hidden" name="unit" id="unit" value="<?=$_GET[unit]?>" />
                        <input type="hidden" name="tgl" id="tgl" value="<?=$_GET[tgl]?>" />
                        <input type="hidden" name="jenis" id="jenis" value="<?=$_GET[jenis]?>" />
                        <input type="hidden" name="qty" id="qty" value="<?=$vdtl[qty]?>" />
                        <input type="hidden" name="total" id="total" value="<?=$vdtl[total]?>" />
                        
                   		<select name="acc" id="acc" class="select">
                        	<option value="">Pilih Rekening Penerimaan</option>
                            <?php
							foreach($db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' and kb='1'") as $vb){
								echo"<option value=\"$vb[account]\">$vb[description]</option>";	
								
							}
							?>
                        </select>
                        
                   
                     </div>
                </div>
				 <?php } ?>
                 
                 <br />
                <div class="form-group">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-5">                        
                        <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="">
                         Simpan 
                        </button>
                        <button class="btn btn-success" type="button" onClick="batal(<?=$valtmp['id_supp']?>)">
                         Batal 
                        </button>
                    </div> 
                 </div>  
              </form>
             </div>	
        </div>		
        </div>			
</div>

