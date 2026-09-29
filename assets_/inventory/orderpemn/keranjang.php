<div class="table-responsive pre-scrollable">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="30%"><strong>Nama Barang</strong></td>
          <td width="10%"align="center"><strong># </strong></td>
          <td width="10%" align="center"><strong>Qty Minta</strong></td>
          <td width="10%" align="center"><strong>Harga/Per</strong></td>
          <td width="10%" align="center"><strong>Aksi</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_order_tmp a join m_barang b on a.id_barang=b.id_barang join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.id_user='$_SESSION[ID_LOGIN]' and a.ke_gudang='$valtmp[ke_gudang]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtoupper($d['kode_barang']." - ".$d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;<?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?></td>
          <td align="right"><?=number_format($d['harga'])?></td>
          <td align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_tmp'];?>)">hapus</a>&nbsp;</td>
     </tr>
        <?php $no++;} ?>
</table>	
</div><br>
<div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Batal 
                                        </button>
                                        <input type="hidden" name="aksi" id="aksi"    required>
								      <input type="hidden" name="id2" id="id2"  value=""  required>
									  <input type="hidden" name="jenis" id="jenis"  value="<?php echo $_GET[jenis]?>"  required>
                               		  
                                       
							</div>
                         </div>  