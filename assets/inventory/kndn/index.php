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
    <div class="col-lg-1">
    </div>	
    <div class="col-lg-10">
		<form action="index.php?x=bukubg_s" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                               <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Kroscek Kredit Note" onClick="window.location='index.php?x=kndn_k'"></button></li>
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Buku BG" onClick="window.location='index.php?x=bukubg_v'"></button></li>
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
                              	<th width="5%">Nama Usaha</th>
                                <th width="5%">No Faktur</th>
                                <th width="20%">No SPJ</th>
                                <th width="10%">Tgl KnDn</th>
                                <th width="10%">Jenis Koreksi</th>
                              	<th width="10%">Jenis Trans</th>
                                <th width="10%">Total KnDn</th>
                                
                                <th width="5%"> <!--<a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>--></th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="idbuku" id="idbuku"  value="" placeholder='tambah'  required>
                    
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>

                    
   		  </div>
			</form>
		</div>
         			
	 <div class="col-lg-2">
               <!--<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Tagihan Kembali
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body scrolls">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=bukubg" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			-->
</div>

