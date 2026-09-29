<style>
.te{
background-color: green;
padding:5px;
border-radius: 10px;
}
.te1{
background-color: red;
padding:5px;
border-radius: 10px;
}
</style>
<table class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
	<thead>
    <tr height="30px" bgcolor="#EBEBEB">
          <th width="1%"align="center" ><b>No</b></th>
          <th width="8%" align="center" ><b>Nama Asset & NIA</b></th>
          <th width="8%" align="center" ><b>Tgl Penyusutan</b></th>
          <th width="8%" align="center" ><b>Harga Beli</b></th>
          <th width="8%" align="center" ><b>Nilai Residu</b></th>
          <th width="8%" align="center" ><b>Masa Ekonomis</b></th>
          <th width="8%" align="center" ><b>Biaya Penyusutan</b></th>
          <th width="8%" align="center" ><b>Depresiasi Ke</b></th>
          <th width="8%" align="center" ><b>Akum. Penyusutan</b></th>
          <th width="8%" align="center" ><b>Status</b></th>
          </tr>
    </thead> 
    <tbody> 
      <?php 
	  $tgls=date("Y-m-d");
	  $m=date("m");
	  $y=date("Y");
	  $hr=$db->select("am_asset a
JOIN am_deployed b ON a.ID_AMASSET = b.ID_AMASSET","a.*,b.DEPLOY_DATE","a.MASA_EKONOMIS<>a.DEPRESIASI_KE GROUP BY a.ID_AMASSET ORDER BY b.DEPLOY_DATE ASC");
		$no=1;
		$as=0;
		$sa['tot']='0';
	  foreach($hr as $val){ 
	  $ss=$db->select("am_depresiasi_in","sum(BIAYA_PENYUSUTAN)as tot","ID_ASSET='$val[ID_AMASSET]'");
	  foreach($ss as $sa){}
	  $kj=$db->select("am_depresiasi_in","*","ID_ASSET='$val[ID_AMASSET]' and MONTH(STAMPDATE)='$m' and YEAR(STAMPDATE)='$y'");
	  foreach($kj as $ll){}
	  ?>    
  <tr>
  <td align="center"><?=$no?></td>
  <td align="left"><?=$val['ASSET_NAME']." - ".$val['ID_NIA']?></td>
  <td align="right"><?=date("d-m-Y",strtotime($val['DEPLOY_DATE']))?></td>
  <td align="right"><?=number_format($val['ASSET_HARGABELI'])?></td>
  <td align="right"><?=number_format($val['NILAI_RESIDU'])?></td>
  <td align="right"><?=$val['MASA_EKONOMIS']?></td>
  <td align="right"><?=number_format($val['BIAYA_PENYUSUTAN'])?></td>
  <td align="right"><?=$val['DEPRESIASI_KE']?></td>
  <td align="right"><?=number_format($sa['tot'])?></td>
  <td align="right"><?php 
  if(count($kj)=='1'){
	    ?>
  <font color="white" class="te">Sudah</font>
  <?php
  }else
  {?>
  <font color="white" class="te1">Belum</font>
  <?php 
  }
  ?></td>
  </tr>
  <?php 
  $no++;}  ?>
  </tbody>
</table>