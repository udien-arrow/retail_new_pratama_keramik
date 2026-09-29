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
          <div class="col-lg-12">
		 
           <div class="panel panel-flat">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        Laporan Poin Penjualan</h5>
                        <div class="heading-elements noprint">
							<ul class="icons-list">
		                		<?php 
						  $a=explode('/',$_GET['a']);
						  $gg=$a[2]."-".$a[0]."-".$a[1];
						  $b=explode("/",$_GET['b']);
						  $wp=$b[2]."-".$b[0]."-".$b[1];
							?>
		                		<!--<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>-->
                                <li><a target="_blank" href="cetak.php?cus=<?=$_GET['cus']?>&bar=<?=$_GET['bar']?>&bul=<?=$_GET['bul']?>&tah=<?=$_GET['tah']?>&page=lappoin"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example')"></button></li>
							</ul>
                      </div>
					</div>
                    
                     <div class="dataTables_wrapper"></div>
                     
             <table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td> 
                    <div class="col-lg-10">
                                <div class="form-group">     
                           
                               <!-- Nama Customer -->
                               <div class="col-lg-2">
                              	  <select class="form-control" name="cus" id="cus">
                                      		<option value="x">--Customer--</option>                                      		
                                            <option value="%" selected>--All Customer--</option>
                                            
											<?php
											$query=$db->select("m_customer","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_cus']?>"  <?php if($sel['id_cus']==$_GET['cus']){echo "selected";}?>><?=$sel['nama_usaha']?></option> <?php } ?>
									</select>
                               </div>

                               <!-- Jenis Barang -->
                               <div class="col-lg-2">
                              	  <select class="form-control" name="barang" id="barang">
                                      		<option value="x">--Jenis Barang--</option>
											<?php
											$query=$db->select("m_barang","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_barang']?>"  <?php if($sel['id_barang']=='1'){echo "selected";}?> <?php if($sel['id_barang']==$_GET['bar']){echo "selected";}?>><?=$sel['nama_barang']?></option> <?php } ?>
									</select>
                               </div>
                               
                               <!-- Periode -->
                               <div class="col-lg-2">
                               		<?php
									$bulan = date("m");
									?>
                              	  <select class="form-control" name="bulan" id="bulan">
                                        	<option value="1" <?php if($bulan==1){echo "selected";} ?> >Januari</option>
                                        	<option value="2" <?php if($bulan==2){echo "selected";} ?>>Februari</option>
                                        	<option value="3" <?php if($bulan==3){echo "selected";} ?>>Maret</option>
                                        	<option value="4" <?php if($bulan==4){echo "selected";} ?>>April</option>     
                                        	<option value="5" <?php if($bulan==5){echo "selected";} ?>>Mei</option>
                                        	<option value="6" <?php if($bulan==6){echo "selected";} ?>>Juni</option>
                                        	<option value="7" <?php if($bulan==7){echo "selected";} ?>>Juli</option>
                                        	<option value="8" <?php if($bulan==8){echo "selected";} ?>>Agustus</option>                                                                                    
                                        	<option value="9" <?php if($bulan==9){echo "selected";} ?>>September</option>
                                        	<option value="10" <?php if($bulan==10){echo "selected";} ?>>Oktober</option>
                                        	<option value="11" <?php if($bulan==11){echo "selected";} ?>>November</option>
                                        	<option value="12" <?php if($bulan==12){echo "selected";} ?>>Desember</option>                                                                                                                                     
									</select>
                               </div>               
                                              
                               <!-- Tahun -->
                               <div class="col-lg-2">
                               		<?php
									$tahun = date("Y");
									?>
                              	  <select class="form-control" name="tahun" id="tahun">
                                  			<?php
											for ($x = $tahun-5; $x <= $tahun; $x++) {	
											?>
                                        	<option value="<?=$x?>" <?php if($x == $tahun){echo "selected";} ?> ><?=$x?> </option>                                                                                                                                    
											<?php } ?>
                                    </select>
                               </div> 
                               
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahdata(cus.value, barang.value, bulan.value , tahun.value)">
                               </div>
                               
                   			 </div>
                             </div>
                              </td></tr>
                    </table>
                    
					<table id="example" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                            	<?php
								$bln = '';
								switch ($_GET['bul']){
								case 1 :$bln = 'Januari'; break;
								case 2 :$bln = 'Februari';break;
								case 3 :$bln = 'Maret'; break;
								case 4 :$bln = 'April';break;
								case 5 :$bln = 'Mei';break;
								case 6 : $bln = 'Juni';break;
								case 7 : $bln = 'Juli';break;
								case 8 : $bln = 'Agustus';break;
								case 9 : $bln = 'September';break;
								case 10 : $bln = 'Oktober';break;
								case 11 : $bln = 'November';break;
								case 12 : $bln = 'Desember';	break;
								}
								?>
                              <th colspan="11" style="text-align:center" ><h5>LAPORAN POIN PELANGGAN <br>Periode <?php echo "$bln  $_GET[tah]"; ?></h5></th>
                            </tr>
                            <tr bgcolor="#EFEFEF">
                                <th width="5%" >No </th>
                                <th width="10" >Kode Ship To</th>
                              	<th width="20%">Nama Pelanggan</th>
                                <th width="30%">Alamat</th>
                                <th width="10%">Telp</th>
                                <th width="20%">Total</th> 
                          </tr> 
                      </thead>
 <?php
		$kon=$db->select("pj_penjualan_dtl a inner join 
		pj_penjualan b inner join  
		m_customer c inner JOIN
		m_customer_shipto d
		on 
		a.id_pj = b.id_pj AND
		b.id_customer = c.id_cus AND
		b.id_customer = d.id_cus", "d.shipto_code,c.nama_usaha,c.alamat_usaha,c.no_telp_usaha,sum(a.qty_jual) as total_jual", 
		"a.id_barang = '$_GET[bar]' and YEAR(b.tgl_penjualan) = '$_GET[tah]' and month(b.tgl_penjualan) = '$_GET[bul]'
		and b.id_customer like '$_GET[cus]'
		GROUP BY c.nama_usaha order by total_jual desc");
        $no=1; 
        foreach($kon as $d){
		$total=$total+$d['total_jual']; 
		?>
         <tr>
         <td width="5%" align = "right" ><?php echo $no;?></td>
         <td width="10%" ><?=$d['shipto_code']?></td>
 	      <td width="20%"><?=$d['nama_usaha']?></td> 
 	      <td width="30%"><?=$d['alamat_usaha']?></td> 
 	      <td width="10%"><?=$d['no_telp_usaha']?></td>           
          <td width="20%" align="right"><?=number_format($d['total_jual'])?></td>
         </tr> 
		<?php $no++ ;} ?>     
                      <tfoot>
                      <tr >
                             <td bgcolor="#EFEFEF" colspan="5" align="center">Total Penjualan</td>
                             <td width="30%" align="right">
                              <?=number_format($total)?>
                              </td>
                           </tr>
                      </tfoot>
 
                       </table>    
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

