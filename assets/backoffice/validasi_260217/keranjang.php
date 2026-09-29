<?php
$etgl=explode("-",$_GET[tgl]);
$tbl="tx_".(int)($etgl[1])."".$etgl[0];
foreach($db->select("$tbl","*","id_inc='$_GET[idj]'") as $v){}
foreach($db->select("m_tarifcash","*","cabang='$_SESSION[ID_CABANG]' AND status='1' limit 0,1") as $vt){}
?>

<div class="col-lg-12">
    <div class="form-group">
      <label class="control-label col-lg-4">Nomor Transaksi</label>
      <div class="col-lg-7">
        <input type="hidden" name="id" id="id" value="<?=$_GET['idj']?>" />
        <input type="hidden" name="jenis" id="jenis" value="<?=$_GET['jenis']?>" />
        <input type="hidden" name="tgl" id="tgl" value="<?=$_GET['tgl']?>" />
        <input type="hidden" name="unit" id="unit" value="<?=$_GET['unit']?>" />
        <input type="text" name="trx" id="trx" value="<?=$v['id_tx']?>" class="form-control" readonly="readonly"/>
      </div>
    </div>
    <div class="form-group" id="jen1">
      <label class="control-label col-lg-4">Nama Pax</label>
      <div class="col-lg-4">
        <input type="text" name="nama" id="nama" value="<?=$v['nama_pax']?>" class="form-control"/>
      </div>
    </div>
    <div class="form-group" id="sub1">
      <label class="control-label col-lg-4">Tujuan</label>
      <div class="col-lg-2">
        <input type="text" name="dep" id="dep" value="<?=$v['dep']?>" class="form-control"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Harga</label>
      <div class="col-lg-4">
       	<input type="text" name="harga" id="harga" value="<?=$vt['nominal']?>" class="form-control" readonly="readonly"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Qty</label>
      <div class="col-lg-2">
        <input type="text" name="qty" id="qty" value="<?=$v['qty']?>" onkeyup="hitung()" class="form-control"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Total</label>
      <div class="col-lg-5">
        <input type="text" name="total" id="total" class="form-control" autocomplete="off" value="<?=$v['nominal']?>" required="required" readonly="readonly"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4"></label>
      <div class="col-lg-8">
         <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
		 Simpan </button>
        <button class="btn btn-success" type="button" onclick="window.location='index.php?x=koder'"> Batal </button>
      </div>
    </div>
  </div>
