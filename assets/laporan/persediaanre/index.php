  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		  <?php if($_GET[id]==''){?>
          <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                		<?php
                                $dt=$db->select("v_notif","gab_kon","id_gudang='$_GET[gud]'");
								foreach($dt as $vdt){
									$exp=explode("_",$vdt['gab_kon']);	
									$a=$a+$exp[0];
									$b=$b+$exp[1];
								}
								$pe=$a/$b;
								$d=number_format($pe*100,2);
								if($d>70){
									$war="#FF2020";		
								}elseif($d>65 && $d<70){
									$war="#FFFF37";
								}elseif($d>20 && $d<65){
									$war="#0C6";
								}elseif($d<=20){
									$war="#F0F";
								}
								
								?>
                               
                                <li><input type="button" class="btn text-primary-200 btn" style="background-color:  <?=$war?>; height:25px;  font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif" value="LEVEL STOK <?=$d." %"?>" ></button></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button></li>
							</ul>
                            </div>
					</div>
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
					<table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="10%">Kode </th>
                              	<th width="50%">Nama Barang</th>
                                <th width="15%">Satuan</th>
                                <th width="10%">Min</th>
                                <th width="10%">Max</th>  
                                <th width="15%">Akhir</th>
                                <th width="5%">Status</th>
                                <th width="5%">HPP</th>                              
                                <th width="5%">Persediaan</th>
                                <th width="5%">Mutasi</th>                              
                                
                            </tr>
                            
                        </thead>
                    	</table>
                    
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
          <?php }else{?>
           <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">
                        Mutasi Barang Reject
                        <?php 
						$bar=$db->select("m_barang","nama_barang","id_barang='$_GET[id]'");
						foreach($bar as $barv){}
						
						$gud=$db->select("m_gudang","nama_gudang","id_gudang='$_GET[gud]'");
						foreach($gud as $gudv){}
						echo "( ".$barv['nama_barang']." -  ".$gudv['nama_gudang']." ) ";
						?>
                        </h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-warning" value="Back" onClick="window.location='index.php?x=lappersediaan&gud=<?=$_GET[gud]?>'"></button></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>
							</ul>
                            
                        </div>
					</div>
					<table id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="7">
                              <div class="col-lg-8">
                                <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Tanggal </label>
                              <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[tg]?>">
                                  </div>
                               </div>
                               
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgsd" id="tgsd" value="<?php echo $_GET[tgsd]?>">
                                  </div>
                                  
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="go" onClick="pindah('<?=$_GET[gud]?>','<?=$_GET[id]?>',tg.value,tgsd.value)">
                               </div>
                               
                    </div>
                              </div>
                             </th>
                            </tr>
                            <tr>
                                <th width="20%">Jenis Mutasi </th>
                              	<th width="20%">No Ref</th>
                                <th width="20%">Tanggal</th>
                                <th width="10%">Awal</th>
                                <th width="10%">Masuk</th>  
                                <th width="10%">Keluar</th>
                                <th width="10%">Akhir</th>                              
                                <th width="10%">Hpp</th>                              
                                
                            </tr>
                        </thead>
                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
          
          <?php }?>
			
		</div>
<script>


	var tableToExcel = (function() {
		
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))

  }
})()


</script>  
