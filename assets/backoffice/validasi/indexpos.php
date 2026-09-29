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
                <!-- =============== Jenis 1 / Credit Card =============== -->
                <?php
				if($_GET[jenis]==1){
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
		
					  foreach($db->select("bo_validasi_tmp a JOIN tx_".(int)($etgl[1])."$etgl[0] b ON a.no_trx=b.id_tx JOIN bo_m_card c ON b.id_card=c.id_card and jenis='1' JOIN bo_m_bank d ON d.id_bank=c.id_bank","sum(b.qty) as qty, sum(b.nominal) as total, c.nama_card AS nama_card, c.id_bank AS id_bank, nama_bank","substr(a.no_trx,1,2)='CC' GROUP BY b.id_card") as $vdtl){
						 foreach($db->select("bo_spk_head","tarif as tarif","id_mitra='$vdtl[id_bank]' and jenis_mitra='1' and status='1'") as $vdtl3){
							 $tot = $vdtl[qty]*$vdtl3[tarif];
					?>	
                      <tr>
                        <td width="14%" align="center"><strong><?=$no?></strong></td>
                        <td width="44%" align="left"><strong><?=$vdtl[nama_bank]." ".$vdtl[nama_card]?></strong></td>
                        <td width="23%" align="center"><strong><?=number_format($vdtl[qty])?></strong></td>
                        <!--<td width="19%" align="right"><strong><?=number_format($vdtl[tarif])?></strong></td>-->
                        <td width="19%" align="right"><strong><?=number_format($tot)?></strong></td>
                      </tr>	  
					 <?php
						 }
						 $t+=$tot;
						 $no++;
						}
					  ?>
                    </table>
                    
                  </div>
               </div>
               
              <div class="form-group">
                    <!--<label class="control-label col-lg-3 form-group ">Penerimaan</label>-->
                    <div class="col-lg-4">
                    	<form method="post" action="index.php?x=vdasipos_s" enctype="application/x-www-form-urlencoded">
                    	<input type="hidden" name="cabang" id="cabang" value="<?=$_SESSION[ID_CABANG]?>" />
                        <input type="hidden" name="unit" id="unit" value="<?=$_GET[unit]?>" />
                        <input type="hidden" name="tgl" id="tgl" value="<?=$_GET[tgl]?>" />
                        <input type="hidden" name="jenis" id="jenis" value="<?=$_GET[jenis]?>" />
                        <input type="hidden" name="qty" id="qty" value="<?=$vdtl[qty]?>" />
                        <input type="hidden" name="total" id="total" value="<?=$t?>" />
                        <input type="hidden" name="acc" id="acc" value="0-2" />
                        
                   		<!--<select name="acc" id="acc" class="select" required>
                        	<option value="">Pilih Rekening Penerimaan</option>
                            <?php
							foreach($db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' AND kb='1'") as $vb){
								//echo"<option value=\"$vb[account]\">$vb[description]</option>";	
							?>	
							
                            <option value="<?=$vb['account']."-".$vb['kb']?>"><?=$vb['description']?></option>
							<?php
							}
							?>
                        </select>-->
                        
                   
                     </div>
                </div>
				 <?php } ?>
                 <!-- =============== End jenis 1 / Credit Card =============== -->
                
                <!-- =============== Jenis 3 / Cash =============== -->
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
                        
                   		<select name="acc" id="acc" class="select" required>
                        	<option value="">Pilih Rekening Penerimaan</option>
                            <?php
							foreach($db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' AND kb='1'") as $vb){
								//echo"<option value=\"$vb[account]\">$vb[description]</option>";	
							?>	
							
                            <option value="<?=$vb['account']."-".$vb['kb']?>"><?=$vb['description']?></option>
							<?php
							}
							?>
                        </select>
                        
                   
                     </div>
                </div>
				 <?php } ?>
                 <!-- =============== End jenis 3 / Cash =============== -->
                 
                 <!-- =============== Jenis 2 / Debit Card =============== -->
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
							foreach($db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' AND kb='2'") as $vb){
								//echo"<option value=\"$vb[account]\">$vb[description]</option>";	
							?>	
							
                            <option value="<?=$vb['account']."-".$vb['kb']?>"><?=$vb['description']?></option>
							<?php
							}
							?>
                        </select>
                        
                   
                     </div>
                </div>
				 <?php } ?>
                 <!-- =============== End jenis 2 / Debit Card =============== -->
                 
                 <!-- =============== Jenis 5 / Mitra Lain =============== -->
                 <?php
				if($_GET[jenis]==5){
				?>
                <div class="form-group">
                  <div class="col-lg-3">
                  </div> 
                  <div class="col-lg-7">
                  	
                    <table width="100%" border="1">
                      <tr>
                        <td width="14%" align="center"><strong>No</strong></td>
                        <td width="44%" align="center"><strong>Jenis Transaksi</strong></td>
                        <td width="10%" align="center"><strong>Qty</strong></td>
                        <td width="19%" align="center"><strong>Tarif</strong></td>
                        <td width="19%" align="center"><strong>Total</strong></td>
                      </tr>
                      <?php
					  $no=1;
					  $table="bo_validasi_tmp a JOIN tx_".(int)($etgl[1])."$etgl[0] b ON a.id_trx=b.id_inc
					  		JOIN bo_pkslain c ON b.id_card = c.idpks JOIN bo_spk_head d ON c.idpks=d.id_mitra and d.status='1' and jenis_mitra='2'";
					  foreach($db->select($table,"c.nama, sum(qty) as qty, tarif as tarif","substr(a.no_trx,1,2)='MT'") as $vdtl){
						 
					?>	
                      <tr>
                        <td width="14%" align="center"><strong><?=$no?></strong></td>
                        <td width="44%" align="left"><strong><?=$j." $vdtl[nama]"?></strong></td>
                        <td width="10%" align="center"><strong><?=number_format($vdtl[qty])?></strong></td>
                        <td width="19%" align="right"><strong><?=number_format($vdtl[tarif])?></strong></td>
                        <td width="19%" align="right"><strong><?=number_format($vdtl[tarif]*$vdtl[qty])?></strong></td>
                      </tr>	  
					 <?php 
					 	$t+=$vdtl[tarif]*$vdtl[qty];
						}
					  ?>
                       
                    </table>
                    
                  </div>
               </div>
               
              
              <form method="post" action="index.php?x=vdasipos_s" enctype="application/x-www-form-urlencoded">
              	<input type="hidden" name="cabang" id="cabang" value="<?=$_SESSION[ID_CABANG]?>" />
                <input type="hidden" name="unit" id="unit" value="<?=$_GET[unit]?>" />
                <input type="hidden" name="tgl" id="tgl" value="<?=$_GET[tgl]?>" />
                <input type="hidden" name="jenis" id="jenis" value="<?=$_GET[jenis]?>" />
                <input type="hidden" name="qty" id="qty" value="<?=$vdtl[qty]?>" />
                <input type="hidden" name="total" id="total" value="<?=$t?>" />
                        
                   		
                 
				 <?php } ?>
                  <!-- =============== End jenis 5 / Mitra Lain =============== -->
                 
                  <!-- =============== Jenis 6 / Reflexy =============== -->
                 <?php
				if($_GET[jenis]==6){
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
                      <!--<tr>
                      	<td colspan="4">Reflexy 1 Jam</td>
                      </tr>-->
                      <?php
					  $no=1;
					  
					  foreach($db->select("bo_validasi_tmp a JOIN tx_".(int)($etgl[1])."$etgl[0] b ON a.id_trx=b.id_inc","sum(qty) as qty, sum(nominal) as total","substr(a.no_trx,1,2)='RF' and SUBSTRING_INDEX(SUBSTRING_INDEX(ket,';',-1),'-',1)='2'") as $vdtl){
						 
					?>
                    
                      <tr>
                        <td width="14%" align="center"><strong><!--<?=$no?>--> 1</strong></td>
                        <td width="44%" align="left"><strong><?=$j."- Refleksi 1 jam"?></strong></td>
                        <td width="23%" align="center"><strong><?=number_format($vdtl[qty])?></strong></td>
                        <td width="19%" align="right"><strong><?=number_format($vdtl[total])?></strong></td>
                      </tr>	  
					 <?php 
						  }
					  ?>
                      <!--<tr>
                      	<td colspan="4">Reflexy 30 Menit</td>
                      </tr>-->
                      <?php
					  $no=1;
					  
					  foreach($db->select("bo_validasi_tmp a JOIN tx_".(int)($etgl[1])."$etgl[0] b ON a.id_trx=b.id_inc","sum(qty) as qty, sum(nominal) as total","substr(a.no_trx,1,2)='RF' and SUBSTRING_INDEX(SUBSTRING_INDEX(ket,';',-1),'-',1)='4'") as $vdtl2){
						 
					?>
                    
                      <tr>
                        <td width="14%" align="center"><strong><!--<?=$no?>--> 2</strong></td>
                        <td width="44%" align="left"><strong><?=$j."- Refleksi 30 menit"?></strong></td>
                        <td width="23%" align="center"><strong><?=number_format($vdtl2[qty])?></strong></td>
                        <td width="19%" align="right"><strong><?=number_format($vdtl2[total])?></strong></td>
                      </tr>	  
					 <?php 
					 		$grntot = $vdtl2[total] + $vdtl[total];
						  }
					  ?>
                      <tr>
                      	<td colspan="3" style="text-align:right"><strong>Grand Total</strong></td>                        
                        <td style="text-align:right"><strong><?=number_format($grntot)?></strong></td>
                      </tr>
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
                        <?php
							if($grntot!=""){
						?>
                        <input type="hidden" name="total" id="total" value="<?=$grntot?>" />
                        
                        
                        <?php
							}else{
						?>
                        <input type="hidden" name="total" id="total" value="<?=$vdtl[total]?>" />
                        <?php
							}
						?>
                        
                   		<select name="acc" id="acc" class="select">
                        	<option value="">Pilih Rekening Penerimaan</option>
                            <?php
							foreach($db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' and kb='1'") as $vb){
								
							?>	
							
                            <option value="<?=$vb['account']."-".$vb['kb']?>"><?=$vb['description']?></option>
							<?php
							}
							?>
                        </select>
                        
                   
                     </div>
                </div>
				 <?php } ?>
                  <!-- =============== End jenis 6 / Reflexy =============== -->
                 <!-- =============== Jenis 7 / Reflexy =============== -->
                 <?php
				if($_GET[jenis]==7){
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
					  
					  foreach($db->select("bo_validasi_tmp a JOIN tx_".(int)($etgl[1])."$etgl[0] b ON a.id_trx=b.id_inc","sum(qty) as qty, sum(nominal) as total","substr(a.no_trx,1,2)='VP'") as $vdtl){
						 
					?>
                    
                      <tr>
                        <td width="14%" align="center"><strong><!--<?=$no?>--> 1</strong></td>
                        <td width="44%" align="left"><strong><?=$j."- VIP Room"?></strong></td>
                        <td width="23%" align="center"><strong><?=number_format($vdtl[qty])?></strong></td>
                        <td width="19%" align="right"><strong><?=number_format($vdtl[total])?></strong></td>
                      </tr>	  
					 <?php 
						  }
					  ?>
                      <!--<tr>
                      	<td colspan="4">Reflexy 30 Menit</td>
                      </tr>-->
                      
                      <tr>
                      	<td colspan="3" style="text-align:right"><strong>Grand Total</strong></td>                        
                        <td style="text-align:right"><strong><?=number_format($grntot)?></strong></td>
                      </tr>
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
                        <?php
							if($grntot!=""){
						?>
                        <input type="hidden" name="total" id="total" value="<?=$grntot?>" />
                        
                        
                        <?php
							}else{
						?> 
                        <input type="hidden" name="total" id="total" value="<?=$vdtl[total]?>" />
                        <?php
							}
						?>
                        
                   		<select name="acc" id="acc" class="select">
                        	<option value="">Pilih Rekening Penerimaan</option>
                            <?php
							foreach($db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' and kb='1'") as $vb){
								
							?>	
							
                            <option value="<?=$vb['account']."-".$vb['kb']?>"><?=$vb['description']?></option>
							<?php
							}
							?>
                        </select>
                        
                   
                     </div>
                </div>
				 <?php } ?>
                  <!-- =============== End jenis 7 / vip =============== -->
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

