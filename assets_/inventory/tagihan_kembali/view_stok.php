    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
	</style>
    <div class="col-lg-5">
		<form action="index.php?x=bukta_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Tagihan Kembali</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Tagihan Kembali" onClick="window.location='index.php?x=tagkem'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="40%">No</th>
                              	<th width="40%">Tgl</th>
                                <th width="10%">Ket</th>
                                <th width="10%">Status</th>
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
         <form class="form-horizontal" action="index.php?x=appso_v" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Buku Tagihan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
					$supp=$db->select("tx_tagihan_kembali","*","no_ta='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body scrolls">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Koreksi</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no_ta']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Tanggal</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['tgl']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Keterangan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['ket']?></b>
                                  
                                </div>
                                <div class="form-group">
								<table width="1000px" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center" width="10%"><strong>Pelangan</strong></td>
                                <td align="center" width="15%"><strong>NO FJ</strong></td>
                                <td align="center" width="10%"><strong>Total</strong></td>
                                <td align="center" width="10%"><strong>Dibayar</strong></td>
                                <td align="center" width="10%"><strong>Jenis Pembayaran</strong></td>
                                <td align="center" width="10%"><strong>Jenis BG</strong></td>
                                <td align="center" width="10%"><strong>Nama Bank</strong></td>
                                <td align="center" width="10%"><strong>jatuh Tempo</strong></td>
                                <td align="center" width="10%"><strong>No Seri BG</strong></td>
                                <td align="center" width="10%"><strong>No Rekening</strong></td>
                                <td align="center" width="10%"><strong>Status</strong></td>
                                
                                </tr>
                                <?php 
								$supp=$db->select("tx_tagihan_kembali_dtl a left join m_customer b on a.id_cus=b.id_cus","a.*,b.nama_usaha","a.no_ta='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="center"><?=$valsupp['nama_usaha']?></td>
                                <td align="center"><?=$valsupp['no_fj']?></td>
                                <td align="center"><?=number_format($valsupp['total_piutang'])?></td>
                                <td align="center"><?=number_format($valsupp['dibayar'])?></td>
                                <td align="center"><?php if($valsupp['jenis_pem']==1){
									echo "Tunai";}elseif($valsupp['jenis_pem']==2){
									echo "Transfer";}elseif($valsupp['jenis_pem']==3){
									echo "BG";}elseif($valsupp['jenis_pem']==4){
									echo "Kembali Utuh"; }
									?></td>
                                <td align="center"><?php if($valsupp['jenis_bg']==1){
									echo "Cair";}elseif($valsupp['jenis_bg']==2){
									echo "Blonk";}
									?></td>
                                <td align="center"><?=$valsupp['nama_bank']?></td>
                                <td align="center">
								<?php if($valsupp['jatuh_tempo']=="0000-00-00"){
									echo "";
								}else{ echo $valsupp['jatuh_tempo'];}?></td>
                                <td align="center"><?=$valsupp['no_seribg']?></td>
                                <td align="center"><?=$valsupp['no_rekening']?></td>
                                <td align="center"><?php if($valsupp['status']=='0'){
									echo "Belum";}elseif($valsupp['status']=='1'){
									echo "Approve";}
									?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
