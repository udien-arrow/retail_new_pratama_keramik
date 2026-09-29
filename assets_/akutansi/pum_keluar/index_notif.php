  	<div class="col-lg-2">								
		</div>
          <div class="col-lg-8">
		 <form action="index.php?x=prp_notif_s" id="form_index" method="post">
          <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
					</div>
					<table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="7">
                              <div class="col-lg-4">
                                <select name="gud" id="gud" class="select-search" onChange="pindahData2(gud.value)">
                                  <option value="">---Gudang---</option>
                                  <?php
											$query=$db->select("m_gudang","id_gudang,nama_gudang","status='1'");
											foreach($query as $sel){	
			                            ?>
                                  <option value="<?=$sel['id_gudang']?>" <?php if($sel['id_gudang']==$_GET['gud']){echo "selected";}?>>
                                    <?=$sel['nama_gudang']?>
                                  </option>
                                  <?php }?>
                                </select>
                                </div>
                             </th>
                            </tr>
                            <tr>
                                <th width="10%">Kode </th>
                              	<th width="50%">Nama Barang</th>
                                <th width="15%">Satuan</th>
                                <th width="10%">Min</th>
                                <th width="10%">Max</th>  
                                <th width="15%">Akhir</th>
                                <th width="5%">
                                <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>
                                </th>                              
                                
                            </tr>
                        </thead>
                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
          
			  </form>
		</div>
      

