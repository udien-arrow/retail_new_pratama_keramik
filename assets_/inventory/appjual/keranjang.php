<div class="form-group">
</div>

<div class="panel-body">
<div class="form-group">
              <label class="control-label col-lg-2">Customer</label>
<div class="col-lg-4">
                <select class="select" name="cust" id="cust"  onChange="kenda(cust.value,nopol.value,gudangggg.value)">
                  <?php
                      $query=$db->select("tx_sales_biaya_tmp a 
					  left join m_customer b on a.id_cus=b.id_cus
					  join tx_sales_order c on a.no_so=c.no_sales
					  ","a.id_cus,b.nama_usaha,a.jenis_kirim,a.no_so,a.id_gudang,c.ship_to","a.id_cabang='$_SESSION[ID_CABANG]'");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['id_cus'].'_'.$sel['ship_to']?>">
                    <?=$sel['nama_usaha'].'_'.$sel['ship_to']?>
                  </option>
                  <?php 
				  $jeniskir=$sel['jenis_kirim'];
				  
				  $noso=$sel['no_so'];
				  $gudangg=$sel['id_gudang'];
				  } 
				  ?>
              </select>
              <input type="hidden" id="gudangggg" value="<?=$gudangg?>">
    </div>
  </div>
<?php 
	if($jeniskir=='FRC'){
		include ('fra.php');
 	}elseif($jeniskir=='LCO'){
		include ('lco.php');
	}elseif($jeniskir=='SWC'){
		include ('swc.php');	
	}
 
 ?>