<?php
	error_reporting(0);
	
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
  <table  class="" border="0">
    <thead>
         
          <tr bgcolor="#28343a">
            <th width="5%" align="center"><font style="color:#FFF"><b>No Ref</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Customer</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Nama User</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl Input</b></font></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="5" bgcolor="#EBEBEB" align="left">Branch Manager (BM)</td>
          </tr>
          <?php 
		  $info=$db->select("tx_buku_tmp a join m_customer b on a.id_cus=b.id_cus join r_user_login c on a.id_user=c.id join m_pegawai d on c.id_pegawai=d.id_pegawai","a.*,b.nama_usaha,d.nama_pegawai","a.id_cabang='$_SESSION[ID_CABANG]'");
		  $no=1;
		  $tgl=date("Y-m-d");
		  foreach($info as $infoval){
		  ?>
         
          <tr>
            <td align="left"><?php echo $infoval['no'];?></td>
            <td align="left" ><?php echo strtolower($infoval['nama_usaha']);?></td>
            <td align="left" ><?php echo $infoval['no_fj'];?></td>
            <td align="left" ><?php echo strtolower($infoval['nama_pegawai']);?></td>
            <td align="left" ><?php echo date("d-m-Y",strtotime($infoval['stampdate']));?></td>
          </tr>
          <?php 
		  		
				
			  $no++;
			  }
			  ?>
          <tr>
            <td colspan="5" bgcolor="#EBEBEB" align="left">Branch Administration Officer (BAO)</td>
          </tr>
               <?php 
		  $info=$db->select("tx_tagihan_kembali_dtl a join tx_tagihan_kembali aa on a.no_ta=aa.no_ta  join m_customer b on a.id_cus=b.id_cus join r_user_login c on a.id_user=c.id join m_pegawai d on c.id_pegawai=d.id_pegawai","a.*,b.nama_usaha,d.nama_pegawai,aa.tgl","a.status='0' and b.id_cabang='$_SESSION[ID_CABANG]'");
		  $no=1;
		  $tgl=date("Y-m-d");
		  foreach($info as $infoval){
		  ?>
          
          <tr>
            <td align="left"><?php echo $infoval['no_ta'];?></td>
            <td align="left" ><?php echo strtolower($infoval['nama_usaha']);?></td>
            <td align="left" ><?php echo $infoval['no_fj'];?></td>
            <td align="left" ><?php echo strtolower($infoval['nama_pegawai']);?></td>
            <td align="left" ><?php echo date("d-m-Y",strtotime($infoval['tgl']));?></td>
          </tr>
          <?php 
		  		
				
			  $no++;
			  }?>
        </tbody>
         <tr>
            <td colspan="5" align="left">&nbsp;</td>
            </tr>
      </table>
</div>
<p>&nbsp;</p>
</div>
