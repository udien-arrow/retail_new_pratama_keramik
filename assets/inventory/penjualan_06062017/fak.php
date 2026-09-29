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
            <th width="8%" align="center"><font style="color:#FFF"><b>Kode Barang</b></font></th>
            <th width="20%" align="center"><font style="color:#FFF"><b>Nama Barang</b></font></th>
            <th width="5%" align="center"><font style="color:#FFF"><b>Qty</b></font></th>
            <th width="5%" align="center"><font style="color:#FFF"><b>Harga</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl Input</b></font></th>
          </tr>
        </thead>
        <tbody>
         
         <?php 
		 $ak=$db->select("pj_penjualan_dtl_tmp_hold","*","user_tmp='$_SESSION[ID_LOGIN]' group by no_hold");
		 foreach($ak as $aka){
		 ?>
          <tr>
            <td onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;" colspan="5" bgcolor="#FFFFCC" align="left" style="cursor:pointer" onclick="balikHold('<?=$aka['no_hold']?>')"><?=$aka['no_hold']?></td>
          </tr>
          <?php 
		  $info=$db->select("pj_penjualan_dtl_tmp_hold a join m_barang b on a.id_barang=b.id_barang","a.*,b.kode_barang,b.nama_barang","a.no_hold='$aka[no_hold]'");
		  $no=1;
		  $tgl=date("Y-m-d");
		  foreach($info as $infoval){
		  ?>
          <tr>
            <td align="left"><?php echo $infoval['kode_barang'];?></td>
            <td align="left" ><?php echo $infoval['nama_barang'];?></td>
            <td align="left" ><?php echo $infoval['qty_tmp'];?></td>
            <td align="left" ><?php echo number_format($infoval['harga_jual_tmp'],2);?></td>
            <td align="left" ><?php echo date("d-m-Y",strtotime($infoval['tgl']));?></td>
          </tr>
          <?php 
			  $no++;
			  }
		 }
			  ?>
         
        </tbody>
         
      </table>
</div>
<p>&nbsp;</p>
</div>
