  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		  <div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php
                    $cab=$db->ses_cab($_SESSION['ID_CABANG']);
					echo $title;
					?>
					</h5>
                    <hr>
					<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
          <tr>
            <th colspan="7" align="left"><span class="icons-list"><span class="panel-title"><span class="col-lg-4">
              <select name="cus" id="cus" class="select-search" onChange="pindahData2(cus.value)">
                <option value="">---Pelanggan---</option>
                <?php
				$cab=$db->ses_cab($_SESSION['ID_CABANG']);
				
				$query=$db->select("m_supplier","*","status='1'");
				foreach($query as $sel){	
				?>
			<option value="<?=$sel['id_supp']?>" <?php if($sel['id_supp']==$_GET['supp']){echo "selected";}?>>
			  <?=$sel['nama_usaha']?>
                </option>
                <?php }?>
              </select>
            </span></span></span></th>
          </tr>
      <?php
       $exp2=explode("_",$_GET['cus']);
 	   $jum=count($db->select("tx_billing","*","id_supp='$_GET[supp]' and status=0"));
       if($jum>0){		  
	  ?>    
            <tr>
				<th colspan="7" align="left"><b>Hutang</b></th>
			</tr>
          <tr bgcolor="#28343a">
            <th width="20%" rowspan="2" align="center"><font style="color:#FFF"><b>No Billing</b></font></th>
            <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b>Tgl </b></font></th>
            <th colspan="2" align="center"><font style="color:#FFF"><b>Total Hutang</b></font></th>
          </tr>
          <tr bgcolor="#28343a">
            <th align="center"><font style="color:#FFF"><b>Semen</b></font></th>
            <th align="center"><font style="color:#FFF"><b>Non Semen</b></font></th>
          </tr>
        </thead>
        <?php 
		$bil=$db->select("tx_billing","*","id_supp='$_GET[supp]' and status='0'");
		$hit=0;
		$tam=0;
		foreach($bil as $bill){
		$ce1=$db->select("tx_order_tagihan_bayar","sum(dibayar) as dibayar","no_billing='$bill[no_billing]' and status='1'");
		foreach($ce1 as $cek1){}
		
		$kmtg=$db->select("m_klaim_ktg ORDER BY tgl_berlaku desc LIMIT 1","*");
					foreach($kmtg as $kmt){}
					
		$k=$db->select("tx_order_tagihan_kd","*","digunakan_bill='$bill[no_billing]' and status='1'");
		$hit=0;
		$tam=0;
					foreach($k as $kdn){
					
					if($kdn['jenis']==0)
					{
						$hit=($kdn['claim_utuh']*$kdn['harga'])+($kdn['claim_ktg']*$kmt['harga']);
					}elseif($kdn['jenis']==1)
					{
						$hit=$kdn['total'];
					}elseif($kdn['jenis']==2){
						$tam=$kdn['total'];
					}}
		$tot=($bill['total_bil']-$hit+$tam)-$cek1['dibayar'];
		if($tot==0){
			
		}else{
		?>
        <tr>
        <td><?=$bill['no_billing']?></td>
        <td><?=$bill['tgl']?></td>
        <td><?php if($bill['jenis']==1){
		echo number_format($tot);
		}?></td>
        <td><?php if($bill['jenis']==0){
		echo number_format($tot);
		}?></td>
        </tr>
        
        <?php } } ?>
      </table>
			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
          
          </div>
<?php } ?>

