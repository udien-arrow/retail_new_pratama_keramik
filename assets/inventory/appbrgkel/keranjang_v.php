<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="20%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="9%" align="center"><strong>Qty</strong></td>
    </tr>
    <?php
		$kon=$db->select("tx_brg_keluar a
JOIN tx_brg_keluar_dtl b ON a.no_keluar = b.no_keluar
JOIN m_barang_gudang c ON b.id_barang = c.id_barang
AND a.id_gudang = c.id_gudang join m_satuan d on b.sat=d.id_satuan","a.id_keluar,
a.no_keluar,
a.id_gudang,
a.kpd_id_gudang,
a.id_user,
a.`status`,
a.ket,
a.tgl,
a.stampdate,
a.no_ref,
b.qty,
c.kode_barang,
c.nama_barang,
d.nama_satuan,c.id_barang,c.berat,b.sat","a.no_keluar='$_GET[id]'");
        $no=1;
        foreach($kon as $d){  
		
		$ces=$db->select("m_pegawai","*","id_pegawai='$_GET[supi]'");
		foreach($ces as $cas){}
		
		$sui=$db->select("m_biayasupir","*","id_cabang='$cas[id_cabang]' and id_barang='$d[id_barang]'");
		foreach($sui as $suit){}
		$gj=$d['berat']*$suit['biaya']*$d['qty'];
		
		$dtk=$db->select("m_konversi","*","id_barang='$d[id_barang]' and sat2='$d[sat]'");
		foreach($dtk as $dtkk){}
		//echo $dtkk['konv'].'a'; 
		
		if($dtkk['konv']!=''){
			$qty=$d['qty']*$dtkk['konv'];
		}else{
			$qty=$d['qty'];
		}
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><input type="hidden" size="7" style="border-color:#E2E2E2" value="<?=$qty?>" name="qty[]" id="qty" readonly>
            <input type="hidden" size="7" style="border-color:#E2E2E2" value="<?=$d['id_barang']?>" name="idbars[]" id="idbars" readonly>
          <?=number_format($d['qty'])?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
</table>
<br>	
<b>&nbsp;&nbsp;&nbsp;</b>

<br>

      
