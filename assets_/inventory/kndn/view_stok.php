    <!-- Theme JS files -->
	<style>
			.tables, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			table, tr, td {
			border: none;
		}
	.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
	</style>
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10">
		<form action="index.php?x=apptagkem" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title;?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Buku BG" onClick="window.location='index.php?x=bukubg'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-9">
                                    
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-1">
                                    </select>
                                    </div>
                      </div>
                      </td>
                      </tr>
                            <tr>
                              	<th width="5%">No Tagihan</th>
                                <th width="15%">Nama Usaha</th>
                                <th width="10%">No SPJ</th>
                                <th width="10%">No FJ</th>
                                <th width="5%">Seri BG</th>
                              	<th width="8%">Dibayar</th>
                                <th width="10%">Bank BG</th>
                                <th width="5%">Jatuh Tempo</th>
                                <th width="5%">Jenis BG</th>
                                
                            </tr>
                        </thead>

                    </table>   
                                    
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=apptagkem" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
      
		<div class="col-lg-1">
		<!--		<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Tagihan Kembali
                        <?php if($valsupp['status']==0){?><button style="float:right" class="btn btn-primary" type="submit" name="simpan" value="simpan">Approve</button>
                        <?php }else{} ?>
                        </h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body scrolls">
                                      <div class="form-group">
                                              <table width=300px" cellspacing="0" cellpadding="0">
                        <tr>
                                             <td><b>NO</b></td>
                                             <td><b>: <?=$valsupp['no_ta']?></b></td>
                                        
                                      
                        </tr>
                        <tr>
                                             <td><b>Nama Pegawai</b></td>
                                             <td><b>: <?=$valsupp['nama_pegawai']?></b></td>
                                        
                                      
                        </tr>
                        <tr>
                                             <td><b>Tgl</b></td>
                                             <td><b>: <?=$valsupp['tgl']?></b></td>
                                        
                                      
                          </tr>
                                            <td><b>Keterangan </b></td>
                                            <td> <b>: <?=$valsupp['ket']?></b></td>
                          </tr>
                          </table>
                                  
                                </div>
                                <div class="form-group">
                                <input type="hidden" name="link" value="<?=$_GET['id']?>">
                               			 <?php
											include("keranjang_v.php");
											?> 
                                
                                </div>
                                  
					
				  </div>	
                    
				</div>					-->
		</div>
</form>
