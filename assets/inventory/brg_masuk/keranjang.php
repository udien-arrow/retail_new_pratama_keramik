<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="37%"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty</strong></td>
          <td width="4%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_brg_masuk_tmp a 
		join m_barang b on a.id_barang=b.id_barang 
		join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.id_user='$_SESSION[ID_LOGIN]' and a.id_gudang='$_SESSION[ID_GUDANG]' and jenis='$_GET[jenis]'");
        $no=1;
        foreach($kon as $d){  
		//bisup
		foreach($db->select("m_biayasupir a join m_barang b on a.id_barang=b.id_barang","a.biaya,ifnull(b.berat,0)as berat","a.id_barang='$d[id_barang]' and a.id_cabang='$_SESSION[ID_CABANG]'") as $kol);
		$bibar=$kol['biaya']*$kol['berat']*$d['qty_terima'];
		//echo $kol['biaya'].'<br>';
		$totsupir=$totsupir+$bibar;
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty_terima']?>&nbsp;</td>
          <td align="center">
          <ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $d['id_tmp'];?>)' class='icon-subtract' style='cursor:pointer'></a></li>
			</ul>
          </td>
     </tr>
        <?php $no++;
		$tot=$tot+($d['qty_terima']*$d['harga_beli']);
		$discg=$d['disc_global'];
		$ppn=$d['ppn'];
		$totton=$totton+($kol['berat']*$d['qty_terima']);
		//echo $kol['berat'].'-'.$d['qty_terima'].'<br>';
		} 
		
		if($ppn=='y'){
			$nppn=$tot/10;
			$tot=$tot+$nppn;
		}else{
			$tot=$tot;
		}
		?>
      
</table>	
<br>


<?php
if($_GET['spb']!=''){
	$sp=explode("_",$_GET['spb']);
	$jnk=$sp[2];
	$sup=$sp[3];
	$tgls=$sp[5];
}
if($_GET['spj']!=''){
	$sp=explode("_",$_GET['spj']);
	$sup=$sp[4];
	$tgls=$sp[5];
}

if($no>1 && $jnk=='LCO'){
	include("keranjang_poa.php");
}
?>

<div class="form-group">
    <label class="control-label col-lg-2 form-group ">Tgl Masuk</label>
	<div class="col-lg-4">
   <!-- <input type="" value="<?=$tgls?>" name="tgls_spj" id="tgls_spj">-->
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="hidden" class="form-control datepicker" name="tgl2" id="tgl2" value="<?php echo date('d-m-Y');?>" >
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>" onChange="cak('<?=$tgls?>',tgl.value)">
          
         </div>
     </div>
</div>
<div class="form-group">
  <label class="control-label col-lg-2 form-group ">Surat Jalan</label>
  <div class="col-lg-4">
    <input type="text" class="form-control" name="surat_jalan" id="surat_jalan" value="" required> 
    <input type="hidden" class="form-control" name="aksi" id="aksi" value="">
    <input type="hidden" class="form-control" name="jenis_in" id="jenis_in" value="<?=$_GET[jenis]?>">
    <input type="hidden" class="form-control" name="id_in" id="id_in" value="<?php if($_GET[spb]!=''){echo $_GET[spb];}elseif($_GET[spj]!=''){echo $_GET[spj];}elseif($_GET[spm]!=''){echo $_GET[spm];}?>">
    <input type="hidden" class="form-control" name="id2" id="id2" value="">
    <input type="hidden" class="form-control" name="total" id="total" value="<?=$tot?>">
    <input type="hidden" class="form-control" name="discg" id="discg" value="<?=$discg?>">
    <input type="hidden" class="form-control" name="jenk" id="jenk" value="<?=$jnk?>">
    <input type="hidden" class="form-control" name="totton" id="totton" value="<?=$totton?>">
  </div>
  <div class="col-lg-4">
       
  </div>
</div>

<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Keterangan</label>
	 <div class="col-lg-6">
           <textarea rows="2" class="form-control" name="ket" id="ket"></textarea>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group "></label>
	
</div>

<div class="form-group">
		<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>																			 
 	<div class="col-lg-5">
		
        <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
		 Simpan 
        </button>
        
        
         <button class="btn btn-success" type="button" onClick="batal(<?=$valtmp['id_supp']?>)">
		 Batal 
         </button>
  	</div> 
 </div>  

        
