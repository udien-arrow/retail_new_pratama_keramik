    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
    <?php
					$supp=$db->select("tx_buku_tagihan","*","no='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
    <div class="col-lg-6">
		<form action="index.php?x=bukta_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Buku Tagihan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Buku Tagihan" onClick="window.location='index.php?x=bukta'"></button></li>
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
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
                    
						<h5 class="panel-title">View Detil Buku Tagihan</h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                <?php if($valsupp['status']==1){?>
                        <li>
                        <a href='javascript:void(0)' onClick=window.open('cetak.php?page=bukta&id=<?=$_GET['id']?>') >
                    <button style="float:right" class="btn btn-primary" type="button">Cetak Buku Tagihan</button></a></li>
                    <?php }?>
                    </ul>
                    </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Koreksi</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no']?></b>
                                  
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
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Pelangan</strong></td>
                                <td align="center"><strong>NO SPJ</strong></td>
                                <td align="center"><strong>NO FJ</strong></td>
                                <td align="center"><strong>Total</strong></td>
                                </tr>
                              <?php 
								$supp=$db->select("tx_buku_tagihan_dtl a left join m_customer b on a.id_cus=b.id_cus","*","a.no='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
							  ?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="center"><?=$valsupp['nama_usaha']?></td>
                                <td align="center"><?=$valsupp['no_spj']?></td>
                                <td align="center"><?=$valsupp['no_fj']?></td>
                                <td align="center"><?=number_format($valsupp['total_piutang'],2)?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
