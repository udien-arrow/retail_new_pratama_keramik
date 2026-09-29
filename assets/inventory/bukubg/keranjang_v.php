<table width="1000px" border="1" cellpadding="0" cellspacing="0" class="tables">
                                <tr>
                                <td align="center" class="tables" width="5%"><strong>No</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Pelangan</strong></td>
                                <td align="center" class="tables" width="15%"><strong>NO FJ</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Total</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Dibayar</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Jenis Pembayaran</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Nama Bank</strong></td>
                                <td align="center" class="tables" width="10%"><strong>No Rekening</strong></td>
                                <td align="center" class="tables" width="10%"><strong>No Seri BG</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Jatuh Tempo BG</strong></td>
                                </tr>
                                <tr>
                                </tr>
                                <?php 
								$supp=$db->select("tx_tagihan_kembali_dtl a left join m_customer b on a.id_cus=b.id_cus","a.*,b.nama_usaha","a.no_ta='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center" class="tables"><?=$no?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_usaha']?></td>
                                <td align="center" class="tables"><?=$valsupp['no_fj']?></td>
                                <td align="center" class="tables"><?=$valsupp['total_piutang']?></td>
                                <td align="center" class="tables"><?=$valsupp['dibayar']?></td>
                                <td align="center" class="tables"><?php if($valsupp['jenis_pem']==1){
									echo "Tunai";}elseif($valsupp['jenis_pem']==2){
									echo "Transfer";}elseif($valsupp['jenis_pem']==3){
									echo "BG";}elseif($valsupp['jenis_pem']==4){
									echo "Kembali Utuh"; }
									?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_bank']?></td>
                                <td align="center" class="tables"><?=$valsupp['no_rekening']?></td>
                                <td align="center" class="tables"><?=$valsupp['no_seribg']?></td>
                                <td align="center" class="tables">
								
								<?php if($valsupp['jatuh_tempo']==0000-00-00){
									echo "";}else{echo $valsupp['jatuh_tempo'];}?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table>
      
