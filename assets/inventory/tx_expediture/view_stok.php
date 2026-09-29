    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			.tables{
				border: 0px solid #DDD ;
			}
			.table, .td, .th {
				border: 0px solid #DDD ;
				padding:0px;
			}
			.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap}
	</style>
    <div class="col-lg-7">
		<form action="index.php?x=pricel_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Expediture</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Expediture" onClick="window.location='index.php?x=txex'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="40%">Supplier</th>
                              	<th width="40%">No Expediture</th>
                                <th width="10%">Tanggal</th>
                                <th width="1%">#</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=txex_v" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Retur</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
					$supp=$db->select("ex_expediture a
JOIN ex_expediture_dtl b ON a.no_expediture = b.no_expediture
JOIN m_supplier c ON a.id_supp = c.id_supp
JOIN ex_tarif_oa d on a.id_lokasi=d.id
JOIN ex_lokasi_kirim e on d.id_lokasi=e.id
JOIN m_kendaraan f on a.id_kendaraan=f.id","a.*,
c.nama_usaha,
e.lokasi_kirim,f.nopol","a.no_expediture='$_GET[id]' GROUP BY
	a.id_expediture");
					foreach($supp as $valsupp){}

					$ww=$db->select("ex_expediture_biaya_dtl","*","no_expediture='$_GET[id]'");
					foreach($ww as $cht){}
					?>
                   
				  <div class="panel-body">
                  <table width="700px" class="tables" cellpadding="0" cellspacing="0">
                   <tr>
                   <td class="td" width="11%"><b>No Expediture</b></td>
                   <td width="38%" class="td"><b>: <?=$valsupp['no_expediture']?></b></td>
                   <td class="td" width="12%"><b>Gaji Sopir</b></td>
                   <td width="39%" class="td"><b>: <?=number_format($cht['gaji_sopir'])?></b></td>
                   </tr>
                   <tr>
                   <td class="td"><b>Tujuan</b></td>
                   <td class="td"><b>: <?=$valsupp['lokasi_kirim']?></b></td>
                   <td class="td" width="12%"><b>Gaji Kernet</b></td>
                   <td width="39%" class="td"><b>: <?=number_format($cht['gaji_kernet'])?></b></td>
                   </tr>
                   <tr>
                   <td class="td"><b>No SO</b></td>
                   <td class="td"><b>: <?=$valsupp['no_so']?></b></td>
                   <td class="td" width="12%"><b>UJS</b></td>
                   <td width="39%" class="td"><b>: <?=number_format($cht['ujs'])?></b></td>
                   </tr>
                   <tr>
                   <td class="td"><b>SPJ</b></td>
                   <td class="td"><b>: <?=$valsupp['no_spj']?></b></td>
                   <td class="td" width="12%"><b>Kosongan</b></td>
                   <td width="39%" class="td"><b>: <?=number_format($cht['kosongan'])?></b></td>
                   </tr>
                   <tr>
                   <td class="td"><b>Tarif OA</b></td>
                   <td class="td"><b>: <?=number_format($valsupp['tarif_ao'])?></b></td>
                   <td class="td" width="12%"><b>Premi</b></td>
                   <td width="39%" class="td"><b>: <?=number_format($cht['premi'])?></b></td>
                   </tr>
                   <tr>
                   <td class="td"><b>Total OA</b></td>
                   <td class="td"><b>: <?=number_format($valsupp['total_ao'])?></b></td>
                   </tr>
                   <tr>
                   <td class="td"><b>Tanggal</b></td>
                   <td class="td"><b>: <?=$valsupp['tgl']?></b></td>
                   </tr>
                   <tr>
                   <td class="td"><b>Keterangan</b></td>
                   <td class="td"><b>: <?=$valsupp['ket']?></b></td>
                   </tr>
                   <tr>
                   <td class="td"><b>Nopol</b></td>
                   <td class="td"><b>: <?=$valsupp['nopol']?></b></td>
                   </tr>
                   </table>
                                
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Nama Barang</strong></td>
                                <td align="center"><strong>Satuan</strong></td>
                                <td align="center"><strong>Qty</strong></td>
                                <td align="center"><strong>Berat ( KG )</strong></td>
                                <td align="center"><strong>Nilai OA</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("ex_expediture_dtl a
LEFT JOIN m_barang_gudang c ON a.id_barang = c.id_barang and a.id_gudang=c.id_gudang
LEFT JOIN m_satuan d ON c.id_satuan = d.id_satuan","a.nilai_ao,a.qty,
	c.kode_barang,
	c.nama_barang,
	d.nama_satuan,
	a.berat","a.no_expediture='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="center"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
                                <td align="center"><?=$valsupp['nama_satuan']?></td>
                                <td align="center"><?=number_format($valsupp['qty'])?></td>
                                <td align="center"><?=$valsupp['berat']?></td>
                                <td align="center"><?=number_format($valsupp['nilai_ao'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
