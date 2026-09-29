<div class="table-responsive pre-scrollable">

<table width="100%" class="table datatable-basic table-bordered table-striped table-hover dataTable">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="15%"><strong>Kode Barang</strong></td>
          <td align="center" width="20%"><strong>Nama Barang</strong></td>
          <td align="center" width="20%"><strong>Harga</strong></td>
          <td width="5%"align="center"><strong>Disc(%) </strong></td>
          <td width="10%" align="center"><strong>Qty </strong></td>
          <td width="20%" align="center"><strong>Total</strong></td>
          <td width="20%" align="center"><strong>Aksi</strong></td>
    </tr>
        <?php
		$kon=$db->select("pj_penjualan_dtl_tmp a join m_barang_gudang b on a.id_barang = b.id_barang AND b.id_gudang = '$_SESSION[ID_GUDANG]' ", "a.id_tmp, a.harga_jual_tmp, a.qty_tmp, a.discprs_tmp, a.total_tmp, b.kode_barang, b.nama_barang", "a.user_tmp = '$_SESSION[ID_LOGIN]' and a.jenis=2");
        $no=1; 
        foreach($kon as $d){ 
		?>
  
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['kode_barang']));?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="right" style="padding-right:10px">Rp. 
          <?=number_format($d['harga_jual_tmp'])?></td>
          <td align="right" style="padding-right:10px">&nbsp;
          <?=$d['discprs_tmp']?></td>
          <td align="right" style="padding-right:10px"><?=number_format($d['qty_tmp'])?>&nbsp;</td>
          <td align="right" style="padding-right:10px">Rp.<?=number_format($d['total_tmp'])?>&nbsp;</td>
          <td align="center"> 
          <button class="btn btn-danger" onclick="hapus(<?=$d['id_tmp']?>)" type="submit" >Hapus</button></td> 
             
        <?php $no++;
		}
 ?>
</table>

</div>