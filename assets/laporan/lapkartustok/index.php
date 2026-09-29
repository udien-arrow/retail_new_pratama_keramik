<style type="text/css">
@media print
{
.noprint {display:none;}
.datatable-header {display:none;}
 @page {
              size: portrait;
              margin-top: 0cm;
              margin-bottom: 1cm;
              margin-left: 0cm;
              margin-right: 0cm;
 }
}
.tableku {
               border: .1em solid #ddd;border-collapse:collapse; 
               width:100%; 
        }
td {
	   
	   border: 1px solid #ddd; font-size:14px; line-height: 20px; 
	   vertical-align:middle; padding:3px; font-family:"Arial";
 	}
th {
	   
	   border: 1px solid #ddd; font-size:15px; line-height: 20px; 
	   vertical-align:middle; padding:1px; font-family:"Arial"; text-align:center
 	}
</style>


        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">		 
           <div class="panel panel-flat">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        <?=$title?>
                        </h5>
                        <div class="heading-elements noprint">
							<ul class="icons-list">
		                		<?php 
						  $a=explode('/',$_GET['a']);
						  $gg=$a[2]."-".$a[0]."-".$a[1];
						  $b=explode("/",$_GET['b']);
						  $wp=$b[2]."-".$b[0]."-".$b[1];
							?>
		                		<!--<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>
                                <li><a target="_blank" href="cetak.php?cab=<?=$_GET['cab']?>&a=<?=$gg?>&b=<?=$wp?>&jenis=<?=$_GET['jenis']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>-->
                               <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5','LapKartuStock')"></button></li>
                                                           <!--   <li> <input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel v2"  onclick="javascript:window.open('assets/laporan/lappembayaran/lap.php?cab=<?=$_GET['cab']?>&a=<?=$_GET['a']?>&b=<?=$_GET['b']?>&aksi=xls','blank')"></li>-->

							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
 <div class="col-lg-12">
                                <div class="form-group">     
                              <!--	<div class="col-lg-3">
                              	  <select name="cab" id="cab" class="select-search">
                                  <option value="">---Cabang---</option>
                                 <?php
								  			/*if($_SESSION['ID_CABANG']==0 OR $_SESSION['ID_CABANG']==99){
											echo "<option value='all'>---All---</option>";
												$query=$db->select("m_cabang","id_cabang,nama_cabang","status='1'");
												} else {
													$query=$db->select("m_cabang","id_cabang,nama_cabang","status='1' AND id_cabang='$_SESSION[ID_CABANG]'");
												}
											foreach($query as $sel){	
			                            ?>
                                  <option value="<?=$sel['id_cabang']?>" <?php if($sel['id_cabang']==$_GET['cab']){echo "selected";}?>>
                                    <?=$sel['nama_cabang']?>
                                  </option>
                                  <?php }*/?>
                                </select>
                               </div>-->
                              <div class="col-lg-3">
                              
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[a]?>">
                                  </div>
                               </div>
                               
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgsd" id="tgsd" value="<?php echo $_GET[b]?>">
                                  </div>
                                  
                               </div>
                               <div class="col-lg-4">
                                  <select name="cust" id="cust" class="select-search">

                                    <?php										
								  		$query1=$db->select("m_barang","id_barang,nama_barang","status='1'");
										foreach($query1 as $sel1){	
			                        ?>
                                    <option value="<?=$sel1['id_barang']?>" <?php if($sel1['id_barang']==$_GET['cust']){echo "selected";}?>><?=$sel1['nama_barang']?></option>                                  
                                   <?php } ?>
                                  </select>
                                  
                               </div>                               
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(tg.value,tgsd.value,cust.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table id="example5" class="tableku" >
                        <thead>
                            <tr>
                              <th colspan="7" style="text-align:center" ><h5>KARTU STOK<br>
                              PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                              <th width="20%">Tanggal</th>
                                <th width="20%">No Ref</th>
                                <th width="10%">Awal</th>
                              	<th width="10%">Masuk</th>
                                <th width="10%">Keluar</th>
                                <th width="10%">Akhir</th> 
                                <th width="20%">Ket</th>                                                              
                          </tr> 
                      </thead>
                      <?php
						  $tgl=date("Y-m-d",strtotime($_GET['a']));
						  $tglsd=date("Y-m-d",strtotime($_GET['b']));
				

						$where = "and a.id_barang='$_GET[cust]'";

					
							
                          $dbt=$db->select("tx_mutasi a left join tx_brg_masuk b on a.tgl_mutasi = b.stampdate 
							left join m_supplier c on b.id_supp = c.id_supp
							left join pj_penjualan d on d.no_penjualan = a.no_ref
							left join m_customer e on d.id_customer = e.id_cus
						  ","a.tgl_mutasi,a.no_ref,a.awal,a.masuk,a.keluar,a.akhir,ifnull(c.nama_usaha,ifnull(e.nama_usaha,'RETAIL')) as ket",
						  "date(a.tgl_mutasi) BETWEEN '$gg' AND '$wp' $where order by a.tgl_mutasi asc");
							  $masuk = 0;
							  $keluar = 0;
						  foreach($dbt as $asd){
						  ?>
                         
                          <tr>
                            <td><?=$asd['tgl_mutasi']?></td>
                              <td><?=$asd['no_ref']?></td>
                              <td class="numbx"><?=$asd['awal']?></td>
                              <td class="numbx"><?=$asd['masuk']?></td>
                              <td class="numbx"><?=$asd['keluar']?></td>
                              <td class="numbx"><?=$asd['akhir']?></td>
                              <td><?=$asd['ket']?></td>
                              
                          </tr>
                         
                            <?php
							$masuk=$masuk+$asd['masuk'];
							$keluar=$keluar+$asd['keluar'];
												 
							}?>
                            <td>Total</td>
                              <td></td>
                              <td></td>
                              <td><?=number_format($masuk,0)?></td>
                              <td><?=number_format($keluar,0)?></td>
                              <td></td>
                              <td></td>
                       </table> 
                   
                     
  	<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"   value=""  required>
            <input type="hidden" name="hiu2" id="hiu2"  value="0"  required>
             
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
$(".numbx").each(function( index ) {
  console.log( index + ": " + $( this ).text() );
  $(this).html((parseFloat($(this).text()).toLocaleString()));
});

</script>        

