<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
 <?php
 			  $exp=explode("-",$valsupp['shipto']);
 			  foreach($db->select("tx_po a left join tx_prp b on a.id_prp=b.id_prp","a.jenis_p,a.id_daerah,b.no_order","a.no_so='$valsupp[no_so]'")as $pl2);  
			  if($pl2['jenis_p']=='1'){$jen=2;}elseif($pl2['jenis_p']=='3'){$jen=1;}
			  
				foreach($db->select("m_customer","head","id_cus='$valsupp[id_cus]'")as $cek);
				if($cek['head']!=''){
					foreach($db->select("m_customer","id_cus","kode_cus='$cek[head]'")as $cek2);
					$idcus=$cek2['id_cus'];
				}else{
					$idcus=$valsupp['id_cus'];
				}
			  foreach($db->select("m_customer_plafon a","tempo_normal,tempo_tambahan","jenis_plafon='$jen' and id_cus='$idcus'")as $pl);
			    
              $kon=$db->select("tx_do","*","id_cabang='$_SESSION[ID_CABANG]' and no_ref='$_GET[id]'");	
			  $nom=1;
			  $i=1;
              foreach($kon as $konval){}
              $tot=0;
			 // echo $idcus;
			  ?>
              <table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="59" colspan="6"align="left">
                    <?php if($konval['no_ref']=='' && $_GET['id']!=''){ ?>
                    
                    &nbsp;<b>Tempo
                    </b><input type="text" value="<?=$pl['tempo_normal']?>" name="tn" size="5">
                    <input type="hidden" value="<?=$pl['tempo_tambahan']?>" name="tt" size="5">
                    <?php
                    $jum=count($db->select("tx_switch_history","*","no_spj='$valsupp[no_spj]' and status='0'"));
					if($jum==0){
					?>
                    <button style="float:right" class="btn btn-primary" type="submit" name="simpan" value="simpan"  onClick="return confirm('Apakah Anda yakin menyimpan data??')">Barang Keluar</button>
					<?php }?>
					<?php }elseif($konval['no_ref']!='' && $_GET['id']!=''){?>
                    <a href='javascript:void(0)' onClick=window.open('cetak.php?id=<?=$konval['no_ref'].'_'.$pl2['no_order']?>&page=cetakspj&jenis=2') ><button style="float:right" class="btn btn-primary" type="button">Cetak SPJ</button></a><?php } 
					$i++?>
                    </td>
                </tr>
                  <tr>
                        <td width="4%"align="center"><strong>No</strong></td>
                        <td width="37%" align="center"><strong>Nama Barang</strong></td>
                        <td width="6%"align="center"><strong>#</strong></td>
                        <td width="4%" align="center"><strong>Qty</strong></td>
                        <td width="9%" align="center"><strong>Harga</strong></td>
                        <td width="15%" align="center"><strong>Jumlah</strong></td>
                  </tr>
                  <?php
                      $kon=$db->select("v_kirimda","*","no_spj='$_GET[id]'");
                      $no=1;
                      foreach($kon as $d){  
                  ?>
                  <tr>
                        <td align="center"><?php echo $no?>&nbsp;</td>
                        <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
                        <td align="left">&nbsp;<?=$d['nama_satuan']?></td>
                        <td align="right"><?=$d['qty_do']?>&nbsp;</td>
                        <td align="right"><?php
                       foreach($db->select("tx_sales_order_dtl","*","no_sales='$pl2[no_order]' and id_barang='$d[id_barang]'")as $isi){};
					  // echo "select * from tx_sales_order_dtl where no_sales='$pl2[no_order]' and id_barang='$d[id_barang]'";
						
						echo number_format($isi['harga'],2);
						
						?>&nbsp;</td>
                        <td align="right"><?php
                        echo number_format($sub=$isi['harga']*$d['qty_do'],2);
                        ?>&nbsp;</td>
                 </tr>
                      <?php $no++;
                      $tot=$tot+$sub;
                      } 
					  ?>
                    
                    <tr>
                        <td colspan="5" align="right"><b> Total</b>&nbsp;</td>
                        <td align="right"><b><?php echo number_format($tot,2)?></b>&nbsp;</td>
                </tr>
              </table>	
               <input type="hidden" id="idnyas" name="idnyas" value="<?php echo $_GET['id']?>">
                       
               
               
               <input type="hidden" id="ship_to" name="ship_to" value="<?php echo $valsupp['shipto']?>">
              <input type="hidden" id="no_order" name="no_order" value="<?php echo $pl2['no_order']?>">
              