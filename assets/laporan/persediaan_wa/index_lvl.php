  	     <div class="col-lg-12">

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
                               
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-warning" value="Back" onClick="window.location='index.php?x=lappersediaan'"></button></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button></li>
                               
							</ul>
                            </div>
					</div>
                    <div class="col-lg-3">
                                <select name="gud" id="gud" class="select-search">
                                  <option value="">---Gudang---</option>
                                  <option value="all">---ALL---</option>
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
							 <div class="col-lg-2">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[tg]?>">
                                  </div>
                               </div>
                                <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="go" onClick="pindahData22(gud.value,tg.value)">
                               </div>
                               
                                                         
			<table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                <thead>
                           
                    <tr>
                      <th width="15%">Cabang</th>
                        <th width="10%">Kode </th>
                       	<th width="30%">Nama Barang</th>
                        <th width="10%">Satuan</th>
                        <th width="10%">Min</th>
                        <th width="10%">Max</th>
                        <th width="15%">Stok Akhir</th>
                        <th width="15%">SDP</th>
                        <th width="15%">Sales Order</th>  
                    </tr>
                </thead>
                <?php
						$tgllan=date("y-m-d",strtotime($_GET['tg']));
						
						if($_GET['gud']=='all'){
							$guda=" and a.tipe=1";
						}else{
							$guda=" and a.id_gudang='$_GET[gud]' and a.tipe=1";
						}
						
                        $row=$db->select("m_barang_gudang a 
left join m_satuan d on a.id_satuan=d.id_satuan
left join m_cabang h on a.id_cabang=h.id_cabang
LEFT JOIN m_gudang zz on a.id_gudang=zz.id_gudang
left join tx_mutasi b on a.id_gudang=b.id_gudang and a.id_barang=b.id_barang and b.id_mutasi=
( SELECT c.id_mutasi 
         FROM tx_mutasi c 
         WHERE c.id_barang = a.id_barang and c.id_gudang = a.id_gudang
		 and date(c.tgl_mutasi)<='$tgllan'
         ORDER BY c.id_mutasi DESC
         LIMIT 0,1
       )","a.*,
concat(IFnull(b.awal,0),'_',ifnull(b.masuk,0),'_',ifnull(b.keluar,0),'_',ifnull(b.akhir,0),'_',ifnull(b.hpp,0)) as persediaan,ifnull(b.hpp,0) as hpp_mutasi,d.nama_satuan,h.nama_cabang,zz.nama_gudang","a.status=1 $guda GROUP BY a.id_gudang,a.id_barang");
						foreach($row as $arrdt){
							
							
							
						$per=explode("_",$arrdt['persediaan']);
						
							
						?>
                        
              <tr>
                      <th align="left"><?php echo $arrdt['nama_gudang']?></th>
                      <th align="left"><?php echo $arrdt['kode_barang']?></th>
                      <th align="left"><?php echo $arrdt['nama_barang']?></th>
                      <th align="left"><?php echo $arrdt['nama_satuan']?></th>
                      <th align="left"><?php echo $arrdt['min']?></th>
                      <th align="left"><?php echo $arrdt['max']?></th>
                      <th align="right"><?php
						echo number_format($per[3]);
					  ?></th>
                      <th align="right"><?php 
					  
					  if($arrdt['id_dep']==1){
					  
					  foreach($db->select("v_spj_rilis","sum(qty_do)as qty","id_gudang='$arrdt[id_gudang]' and id_barang='$arrdt[id_barang]' and date(tgl_spj)<='$tgllan' and status_tx=1 and jenistra=0")as $sdp);
					 	$qtysdp=$sdp['qty'];
					  }else{
						 foreach($db->select("tx_prp_dtl a left join tx_po b on a.no_prp=b.no_prp","sum(a.qty) AS qty","b.id_gudang='$arrdt[id_gudang]' and a.id_barang='$arrdt[id_barang]' and date(b.tgl_po)<='$tgllan' and b.status=1")as $sdp);
						$qtysdp=$sdp['qty'];  
					  }
					  
					  echo number_format($qtysdp);
					  
					  ?></th>
                      <th><?php 
					  foreach($db->select("tx_sales_order_dtl a left join tx_sales_order b on a.no_sales=b.no_sales","sum(a.qty) AS qty","b.id_gudang='$arrdt[id_gudang]' and a.id_barang='$arrdt[id_barang]' and date(b.tgl_sales)<='$tgllan' and b.status_so in (1,2,3)")as $so);
					  echo number_format($so['qty'])?></th>
                    </tr>
                    <?php 
							
							}
							
							?>
               	</table>
                    
   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
        
			
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
