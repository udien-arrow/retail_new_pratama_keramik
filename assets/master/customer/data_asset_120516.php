<?php
 $dt=$db->select("m_customer_aset_tb","*","id_cus='$val[id_cus]'");
	  foreach($dt as $valdt3){}
?>

<table width="100%" border="0">
  <tr>
    <td colspan="5"><b>Asset Tidak bergerak</b></td>
  </tr>
  <tr>
    <td width="15%">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp; <b>A. Tanah </b><br></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;&nbsp; <b>B. Gedung / Bangunan</b><br></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat </td>
    <td width="24%" class="">
      <input type="text" name="atb_t_alamat" id="atb_t_alamat" class="form-control " autocomplete="off" value="<?=$valdt3['atb_t_alamat']?>" ><br>
      </td>
    <td width="15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat </td>
    <td width="24%" class=""><input type="text" name="atb_g_alamat" id="atb_g_alamat" class="form-control " autocomplete="off" value="<?=$valdt3['atb_g_alamat']?>" >
      <br></td>
    <td width="3%" class="">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Macam Peruntukan </td>
    <td>
    <input type="text" name="atb_t_untuk" id="atb_t_untuk" class="form-control" autocomplete="off" value="<?=$valdt3['atb_t_untuk']?>" ><br></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Macam Peruntukan </td>
    <td><input type="text" name="atb_g_untuk" id="atb_g_untuk" class="form-control" autocomplete="off" value="<?=$valdt3['atb_g_untuk']?>" >
      <br></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Luas Tanah</td>
    <td>
    <input type="text" name="atb_t_luas" id="atb_t_luas" class="form-control" autocomplete="off" value="<?=$valdt3['atb_t_luas']?>" ><br></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Luas Tanah</td>
    <td><input type="text" name="atb_g_luas" id="atb_g_luas" class="form-control" autocomplete="off" value="<?=$valdt3['atb_g_luas']?>" >
      <br></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor Sertifikat </td>
    <td>
    <input type="text" name="atb_t_sertifikat" id="atb_t_sertifikat" class="form-control" autocomplete="off" value="<?=$valdt3['atb_t_sertifikat']?>" ><br></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor Ijin </td>
    <td><input type="text" name="atb_g_nomor" id="atb_g_nomor" class="form-control" autocomplete="off" value="<?=$valdt3['atb_g_nomor']?>" >
      <br></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status</td>
    <td>
    <input type="text" name="atb_t_status" id="atb_t_status" class="form-control" autocomplete="off" value="<?=$valdt3['atb_t_status']?>" ><br></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status</td>
    <td><input type="text" name="atb_g_status" id="atb_g_status" class="form-control" autocomplete="off" value="<?=$valdt3['atb_g_status']?>" >
      <br></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perkiraan Nilai Asset</td>
    <td>
    <input type="text" name="atb_t_nilai_aset" id="atb_t_nilai_aset" class="form-control" autocomplete="off" value="<?=$valdt3['atb_t_nilai_aset']?>" ><br></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perkiraan Nilai Asset</td>
    <td><input type="text" name="atb_g_nilai_aset" id="atb_g_nilai_aset" class="form-control" autocomplete="off" value="<?=$valdt3['atb_g_nilai_aset']?>" >
      <br></td>
    <td>&nbsp;</td>
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
    	<table width="60%" border="1" bordercolor="#E5E5E5">
 
              <tr height="30px">
                <td width="40%">&nbsp;<b>Jenis</b></td>
                <td><b>Tahun</b></td>
                <td width="20%" align="center"><b>Nilai Aset</b></td>
                <td align="center"><b>Dijaminkan</b></td>
              </tr>
              <?php for($i=1;$i<=3;$i++){
                  $valdt['id']="";
				  $valdt['jenis']="";
                  $valdt['tahun']="";
                  $valdt['nilai_aset']="";
                  $valdt['dijaminkan']="";
                  
                  $dt=$db->select("m_customer_aset_b","*","id_cus='$val[id_cus]' and urut='$i'");
                  foreach($dt as $valdt){
                      
                      }
                  ?>
              <tr>
                <td>
                  <input type="hidden" id="id_dtl_ass" name="id_dtl_ass[<?=$i?>]" value="<?=$valdt['id']?>">
                  <input type="text" name="jenis[<?=$i?>]" size="8" id="jenis" class="form-control" autocomplete="off" value="<?=$valdt['jenis']?>" ></td>
                <td><input type="text" name="tahun[<?=$i?>]" id="tahun" class="form-control limit_plafon" autocomplete="off" value="<?=$valdt['tahun']?>" ></td>
                <td><input type="text" name="nilai_aset[<?=$i?>]" size="15" id="nilai_aset" class="form-control" autocomplete="off" value="<?=$valdt['nilai_aset']?>" ></td>
                <td><input type="text" name="dijaminkan[<?=$i?>]" size="8" id="dijaminkan" class="form-control" autocomplete="off" value="<?=$valdt['dijaminkan']?>" ></td>
              </tr>
              <?php }?>
              
            </table>
    
    </td>
  </tr>
</table>

                                <div class="form-group">
                                </div>
