<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;

?>
<?php  
	    $kon=$db->select("m_retribusi","*");
  		$expl=explode("_",$_GET['id']);
		$no=1;
		$skr=date("Y-m-d");
		foreach($kon as $d){  
		foreach($db->select("m_kendaraan","id_jenis","nopol='$_GET[kend]'") as $kol2);
		
		//foreach($db->select("m_biaya_retribusi a left join m_biaya_retribusi_dtl b on a.id_biaya=b.id_biaya","b.nilai","b.tgl_berlaku<='$skr' and b.id_retribusi='$d[id_retribusi]' and a.id_cus='$_GET[id]' and a.id_jenis='$kol2[id_jenis]' order by b.tgl_berlaku desc limit 0,1") as $kol);
		foreach($db->select("m_biaya_retribusi a left join m_biaya_retribusi_dtl b on a.id_biaya=b.id_biaya","b.nilai","b.tgl_berlaku<='$skr' and b.id_retribusi='$d[id_retribusi]' and a.id_cus='$expl[0]' and a.shipto_code='$expl[1]' and a.id_jenis='$kol2[id_jenis]' and a.id_gudang='$_GET[gud]' order by b.tgl_berlaku desc limit 0,1") as $kol);
		?>
		<tr>
		<td width="60%" align="left">&nbsp;<?php
			echo $d['nama_retribusi'];
		?></td>
        <td width="10%" align="right">&nbsp;<?php if($no>1){
			
			?>
        <input type="text" name="nilai[<?=$no?>]" readonly size="10" value="<?php echo number_format($kolni=$kol[nilai]);?>" style="text-align:right"><input type="hidden" name="idret[<?=$no?>]" size="10" value="<?=$d['id_retribusi']?>">
        <?php 
			$tot=$tot+$kolni;
		}else{
			echo $kolawal=$kol[nilai];
				if($kolawal>=120){
					$nilaiin=20000;
				}else{
					$nilaiin=0;
				}
			}?></td>
		</tr>
		<?php
		$no++;
		} 
		?>
		<tr>
		  <td align="right" colspan="1">Total Biaya Retribusi&nbsp;</td>
		  <td align="right"><b><?=number_format($tot)?></b>&nbsp;<input type="hidden" value="<?=$tot?>" name="jumlah_retri" id="jumlah_retri"></td>
		</tr>
        <tr>
		  <td align="right" colspan="1">Total BBM&nbsp;</td>
		  <td align="right">
          <?php 
		    foreach($db->select("m_bbm a left join m_bbm_dtl b on a.id_bbm=b.id_bbm","b.harga","b.tgl_berlaku<='$skr' and a.id_cabang='$_SESSION[ID_CABANG]' order by b.tgl_berlaku desc limit 0,1") as $bbm);
			
			foreach($db->select("m_kendaraan","id_jenis","nopol='$_GET[kend]'") as $kend2);
			
			foreach($db->select("m_jenis_kendaraan a left join m_jenis_kendaraan_dtl b on a.id_jenis=b.id_jenis","b.muatan,b.bbm"," b.id_jenis='$kend2[id_jenis]' limit 0,1") as $kend);
			
			echo '<b>'.number_format($ujs=(($kolawal*1/$kend['bbm'])*$bbm['harga']));
		  ?><input type="hidden" value="<?=$ujs?>" name="ujs" id="ujs" class="hargab"></td>
		</tr>
        <tr>
		  <td align="right" colspan="1">Biaya Lain&nbsp;</td>
		  <td align="right">
          <input type="text" value="0" name="bl" id="bl" style="text-align:right" onKeyUp="nil(bl.value)"  size="10"  autocomplete="off"></td>
		</tr>
         <tr>
		  <td align="right" colspan="1">Keterangan&nbsp;</td>
		  <td align="right">
          <input type="text" value="" name="keterangan" id="keterangan"></td>
		</tr>
        <tr>
		  <td align="right" colspan="1"><b>Total Uang Jalan Supir</b>&nbsp;</td>
		  <td align="right"><input type="text" value="<?=$tot+$ujs?>" size="10" style="text-align:right" class="hargab" name="totujs" id="totujs"><input type="hidden" value="<?=$tot+$ujs?>" id="totujs2" size="10"></td>
		</tr>
        
        <tr>
		  <td align="right" colspan="1"><b>Total Gaji Supir</b>&nbsp;</td>
		  <td align="right"><input type="text" class="hargab" value="0"  size="10" style="text-align:right" name="gajisup" id="gajisup" readonly></td>
		</tr>
        
		 <tr>
		  <td align="right" ><b>Insentif Jarak</b>&nbsp;</td>
		  <td align="right">&nbsp;<input type="text" name="insentifjarak" class="hargab" size="10" value="<?=$nilaiin?>" style="text-align:right" readonly></td>
		</tr>
        <tr>
		  <td align="right" ><b>Total Bongkar Toko</b>&nbsp;</td>
		  <td align="right">&nbsp;<input type="text" name="totbongkartoko" id="totbongkartoko" class="hargab" size="10" value="0" style="text-align:right" readonly></td>
		</tr>
<script>
$(".hargab").number( true , 0 );
</script>       