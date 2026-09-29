<?php
 $dt=$db->select("m_customer_aset_tb","*","id_cus='$val[id_cus]'");
	  foreach($dt as $valdt3){}
?>

<table width="100%" border="0">
 <tr>
    <td colspan="5"><b>Asset  Tidak Bergerak</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td><b>A.Tanah</b></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5">
    	<table width="100%" border="1" bordercolor="#E5E5E5">
 
              <tr height="30px">
                <td width="20%">&nbsp;<b>Alamat</b></td>
                <td><b>Macam Peruntukan</b></td>
                <td width="20%" align="center"><b>Luas Tanah</b></td>
                <td align="center" width="20%" ><b>Nomor Sertifikat</b></td>
                <td align="center" width="20%" ><b>Status</b></td>
                <td align="center" width="20%" ><b>Perkiraan Asset</b></td>
              </tr>
              <?php for($i=1;$i<=3;$i++){
                  $valdt['id_asettb']="";
				  $valdt['atb_t_alamat']="";
                  $valdt['atb_t_untuk']="";
                  $valdt['atb_t_luas']="";
                  $valdt['atb_t_sertifikat']="";
				  $valdt['atb_t_status']="";
  			      $valdt['atb_t_nilai_aset']="";
                  
                  $dt=$db->select("m_customer_aset_tb","*","id_cus='$val[id_cus]' and urut='$i'");
                  foreach($dt as $valdt){
                      
                      }
                  ?>
              <tr>
                <td>
                  <input type="hidden" id="id_asettb" name="id_asettb[<?=$i?>]" value="<?=$valdt['id_asettb']?>">
                  <input type="text" name="atb_t_alamat[<?=$i?>]" id="atb_t_alamat" class="form-control " autocomplete="off" value="<?=$valdt['atb_t_alamat']?>" ></td>
                <td><input type="text" name="atb_t_untuk[<?=$i?>]" id="atb_t_untuk" class="form-control" autocomplete="off" value="<?=$valdt['atb_t_untuk']?>" ></td>
                <td><input type="text" name="atb_t_luas[<?=$i?>]" id="atb_t_luas" class="form-control" autocomplete="off" value="<?=$valdt['atb_t_luas']?>" ></td>
                <td><input type="text" name="atb_t_sertifikat[<?=$i?>]" id="atb_t_sertifikat" class="form-control" autocomplete="off" value="<?=$valdt['atb_t_sertifikat']?>" ></td>
                <td><input type="text" name="atb_t_status[<?=$i?>]" id="atb_t_status" class="form-control" autocomplete="off" value="<?=$valdt['atb_t_status']?>" ></td>
                <td><input type="text" name="atb_t_nilai_aset[<?=$i?>]" id="atb_t_nilai_aset" class="form-control" autocomplete="off" value="<?=$valdt['atb_t_nilai_aset']?>" ></td>
              </tr>
              <?php }?>
              
            </table>
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td><b>B. Gedung / Bangunan</b></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5">
    	<table width="100%" border="1" bordercolor="#E5E5E5">
 
              <tr height="30px">
                <td width="20%">&nbsp;<b>Alamat</b></td>
                <td><b>Macam Peruntukan</b></td>
                <td width="20%" align="center"><b>Luas Tanah</b></td>
                <td align="center" width="20%" ><b>Nomor Sertifikat</b></td>
                <td align="center" width="20%" ><b>Status</b></td>
                <td align="center" width="20%" ><b>Perkiraan Asset</b></td>
              </tr>
              <?php for($i=1;$i<=3;$i++){
                  $valdt['id_asettb']="";
				  $valdt['atb_g_alamat']="";
                  $valdt['atb_g_untuk']="";
                  $valdt['atb_g_luas']="";
                  $valdt['atb_g_sertifikat']="";
				  $valdt['atb_g_status']="";
  			      $valdt['atb_g_nilai_aset']="";
                  
                  $dt=$db->select("m_customer_aset_tb_g","*","id_cus='$val[id_cus]' and urut='$i'");
                  foreach($dt as $valdt){
                      
                      }
                  ?>
              <tr>
                <td>
                  <input type="hidden" id="id_asettb" name="id_asettb[<?=$i?>]" value="<?=$valdt['id_asettb']?>">
                  <input type="text" name="atb_g_alamat[<?=$i?>]" id="atb_g_alamat" class="form-control " autocomplete="off" value="<?=$valdt['atb_g_alamat']?>" ></td>
                <td><input type="text" name="atb_g_untuk[<?=$i?>]" id="atb_g_untuk" class="form-control" autocomplete="off" value="<?=$valdt['atb_g_untuk']?>" ></td>
                <td><input type="text" name="atb_g_luas[<?=$i?>]" id="atb_g_luas" class="form-control" autocomplete="off" value="<?=$valdt['atb_g_luas']?>" ></td>
                <td><input type="text" name="atb_g_sertifikat[<?=$i?>]" id="atb_g_sertifikat" class="form-control" autocomplete="off" value="<?=$valdt['atb_g_sertifikat']?>" ></td>
                <td><input type="text" name="atb_g_status[<?=$i?>]" id="atb_g_status" class="form-control" autocomplete="off" value="<?=$valdt['atb_g_status']?>" ></td>
                <td><input type="text" name="atb_g_nilai_aset[<?=$i?>]" id="atb_g_nilai_aset" class="form-control" autocomplete="off" value="<?=$valdt['atb_g_nilai_aset']?>" ></td>
              </tr>
              <?php }?>
              
            </table>
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><b>Asset  bergerak</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5">
    	<table width="100%" border="1" bordercolor="#E5E5E5">
 
              <tr height="30px">
                <td width="20%">&nbsp;<b>Jenis</b></td>
                <td><b>Tahun</b></td>
                <td align="center"><b>Nomer Mesin</b></td>
                <td align="center"><b>Nomer Rangka</b></td>
                <td align="center"><b>Status</b></td>
                <td width="20%" align="center"><b>Perkiraan Asset</b></td>
              </tr>
              <?php for($i=1;$i<=3;$i++){
                  $valdt['id']="";
				  $valdt['jenis']="";
                  $valdt['tahun']="";
                  $valdt['nilai_aset']="";
				  $valdt['no_mesin']="";
				  $valdt['no_rangka']="";
                  $valdt['dijaminkan']="";
                  
                  $dt=$db->select("m_customer_aset_b","*","id_cus='$val[id_cus]' and urut='$i'");
                  foreach($dt as $valdt){
                      
                      }
                  ?>
              <tr>
                <td>
                  <input type="hidden" id="id_dtl_ass" name="id_dtl_ass[<?=$i?>]" value="<?=$valdt['id']?>">
                  <input type="text" name="jenis[<?=$i?>]" size="8" id="jenis" class="form-control" autocomplete="off" value="<?=$valdt['jenis']?>" ></td>
                <td><input type="text" name="tahun[<?=$i?>]" id="tahun" class="form-control" autocomplete="off" value="<?=$valdt['tahun']?>" ></td>
                 <td><input type="text" name="no_mesin[<?=$i?>]" size="15" id="no_mesin" class="form-control" autocomplete="off" value="<?=$valdt['no_mesin']?>" ></td>
                 <td><input type="text" name="no_rangka[<?=$i?>]" size="15" id="no_rangka" class="form-control" autocomplete="off" value="<?=$valdt['no_rangka']?>" ></td>
                  <td><input type="text" name="status[<?=$i?>]" size="8" id="status" class="form-control" autocomplete="off" value="<?=$valdt['perkiraan']?>" ></td>
                <td><input type="text" name="nilai_aset[<?=$i?>]" size="15" id="nilai_aset" class="form-control" autocomplete="off" value="<?=$valdt['nilai_aset']?>" ></td>
              </tr>
              <?php }?>
              
            </table>
    
    </td>
  </tr>
</table>

                                <div class="form-group">
                                </div>
