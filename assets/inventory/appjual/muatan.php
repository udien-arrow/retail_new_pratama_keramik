<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
<div class="form-group">
	<label class="control-label col-lg-3"><b>Jenis / Jumlah</label>
	<div class="col-lg-5">
     	<?php
       foreach($db->select("m_kendaraan","id_jenis,muatan,merek","nopol='$_GET[id]' limit 0,1") as $muat2);
	   
	   foreach($db->select("m_jenis_kendaraan","nama","id_jenis='$muat2[id_jenis]' limit 0,1") as $muat);
		echo ": ".$muat['nama'].' - '.$muat2['merek'].' - ('.$muat2['muatan'].' kg)</b>';
		?>          
    </div>
</div>	



  <table class="table" border="0">
    <thead>
          <tr bgcolor="#798EF4">
            <th width="30%" align="center"><b>Nama Barang</b></th>
            <th width="10%" align="center"><b>#</b></th>
            <th width="10%" align="center"><b>Qty</b></th>
            <th width="20%" align="center"><b>Konv</b></th>
            <th width="20%" align="center"><b>Qty (kg)</b></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		  $info=$db->select("tx_sales_biaya_tmp","id_cus,no_so","id_cabang='$_SESSION[ID_CABANG]'");
		  $no=1;
		  foreach($info as $infoval){
			 ?>
          <tr>
            <td colspan="8" bgcolor="#EBEBEB" ><b><?php echo $infoval['no_so']?></b></td>
          </tr>
          <?php 
		  $dtl=$db->select("tx_sales_order_dtl a left join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.id_satuan=c.id_satuan","b.kode_barang,b.nama_barang,c.nama_satuan,a.qty,b.berat","a.no_sales='$infoval[no_so]'");
		  foreach($dtl as $arr){
			
		  ?>
          
          <tr>
            <td align="left"><?=$arr['nama_barang']?></td>
            <td align="center"><?=$arr['nama_satuan']?></td>
            <td align="center"><?=$arr['qty']?></td>
            <td align="right"><?=$arr['berat'].' kg'?></td>
            <td align="right"><?=$totmu=$arr['berat']*$arr['qty'].' kg'?></td>
          </tr>
          <?php }?>
          <?php 
		  		 $no++;
				$total=$total+ $totmu;
			  }?>
              <tr>
            <td colspan="5" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align="left"><b>Sisa Muatan</b></td>
            <td align="right"><?php
            if($muat2['muatan']==''){
				echo '<b>Belum Diset</b>';
			}else{
				echo $muat2['muatan']-$total.' kg';
			}
			?></td>
          </tr>
        </tbody>
      </table>
</div>
<p>&nbsp;</p>
</div>
