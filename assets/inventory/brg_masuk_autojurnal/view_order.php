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
    <div class="col-lg-7">
		<form action="index.php?x=order_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Penerimaan Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Penerimaan" onClick="window.location='index.php?x=brg_masuk'"></button></li>
							</ul>
                            </div>
					</div> 
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>                          
                            <tr>
                                <td width="10%">No Masuk</td>
                              	<td width="20%">Dari</td>
                                <td width="15%">Tanggal</td>
                                <td width="20%">No Ref</td>
                              	<td width="15%">Surat Jalan</td>
                                <td width="10%">#</td>
                            </tr>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Penerimaan Barang</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
                   
				    $exp=explode("/",$_GET['id']);
					$periode="_".intval(substr($exp[2],4,2)).substr($exp[2],0,4);
						$kon=$db->select("tx_brg_masuk a left join m_supplier b on a.id_supp=b.id_supp","a.*,b.pkp","a.no_masuk='$_GET[id]'");	
						foreach($kon as $konval){}			
					?>
				  <div class="panel-body">
                   				
                                
                               
                                <div class="form-group">
                               			 <?php
											include("keranjang_v.php");
											?> 
                                
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
