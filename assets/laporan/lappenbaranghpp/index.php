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
                        Laporan Penjualan Barang
                        </h5>
                        <div class="heading-elements noprint">
							<ul class="icons-list">
		                		<?php 
						  $a=explode('/',$_GET['a']);
						  $gg=$a[2]."-".$a[0]."-".$a[1];
						  $b=explode("/",$_GET['b']);
						  $wp=$b[2]."-".$b[0]."-".$b[1];
							?>
		                		<!--<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>-->
                                <li><a target="_blank" href="cetak.php?jenis=<?=$_GET['jenis']?>&a=<?=$gg?>&b=<?=$wp?>&barang=<?=$_GET['barang']?>&toko=<?=$_GET['toko']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example7')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table  class="table table-bordered table-striped table-hover no-footer noprint">
                    <tr><td> 
                    <div class="col-lg-10">
                                <div class="form-group">     
                              	<div class="col-lg-2">
                              	  <select name="jenis" id="jenis" class="select" onChange= "pindahdata()" >
                                  <option value="0" <?php if($_GET['jenis']==0){echo "selected";}?>> All</option>
                                  <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?> >Barang</option>
                                  <option value="2" <?php if($_GET['jenis']==2){echo "selected";}?>>Toko</option>
                                </select>
                               </div>
                               
				<?php if($_GET[jenis]=='1'){?>                           
                               
                               <div class="col-lg-2">
                              	  <select name="barang" id="barang" class="select-search" onChange= "pindahdata2(jenis.value, barang.value)" >
                                  <option value="">- Pilih Barang -</option>
                                  <option value="0"  <?php if($_GET['toko']== 0 ){echo "selected";}?>> All </option>
                                  <?php
								  $kon=$db->select("m_barang_gudang","id_cabang,
								 id,
								 id_barang,
								 nama_barang,
								 kode_barang");
								 foreach($kon as $row)
								{?>
                                   <option value="<?=$row['id_barang']?>" <?php if($_GET['barang']== $row['id_barang'] ){echo "selected";}?> ><?=$row['nama_barang']?></option>
                                   <?php } ?> 
                                </select>
                               </div>
                               
								<?php } else if($_GET[jenis]=='2'){ ?>                                                             	
                            	<div class="col-lg-2">
                              	  <select name="toko" id="toko" class="select-search" onchange="pindahdata3(jenis.value, toko.value)">
                                  <option value="">- Pilih Toko -</option>
                                  <option value="0" <?php if($_GET['toko']== 0 ){echo "selected";}?>> All </option>
                        	  <?php
								  $kon=$db->select("m_customer","id_cus, kode_cus, nama_usaha");
									 foreach($kon as $row)
									{
								  ?>
                                  <option value="<?=$row['id_cus']?>" <?php if($_GET['toko']== $row['id_cus'] ){echo "selected";}?> ><?=$row['nama_usaha']?></option>
                                  <?php } ?> 
                                </select>
                               </div>
   
<?php } ?>   

  <div class="col-lg-2">
                              
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[a]?>">
                                  </div>
                               </div>
                               
                               <div class="col-lg-2">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgsd" id="tgsd" value="<?php echo $_GET[b]?>">
                                  
                                  </div>
                               </div>
                               <div class="col-lg-1">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahdata4(jenis.value,  tg.value, tgsd.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table id = "example7">
                        <thead>
                            <tr>
                              <th colspan="12" style="text-align:center" ><h5>LAPORAN PENJUALAN <br>PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            <tr bgcolor="#EFEFEF">
                                <th width="5%" >No </th>  
                                <th width="10%" >Tgl penjualan </th>
                                <th width="10%" >No Dokumen</th>
                                <th width="10%">Nama Toko</th>
                                <th width="10%">Alamat Toko</th>
                                <th width="15%">Nama Barang</th> 
                                <th width="5%">HPP</th> 
                                <th width="5%">Qty</th>
                                <th width="5%">Harga</th>
                                <th width="10%">Total</th>
                                <th width="5%">Nama Sales</th>
                                <th width="5%">DPP</th> 
                                <th width="5%">PPN Keluaran</th> 
                          </tr> 
                      </thead>
		 <?php
         if($_GET['a']!=''){
         if($_GET['jenis']=='1'){
         if($_GET['barang'] =='0'){	
         $where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' GROUP BY id_barang, no_penjualan ORDER by no_penjualan asc"; 
        }
        else{
        $where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' and id_barang='$_GET[barang]' GROUP BY id_barang, no_penjualan ORDER by no_penjualan asc";	
            
            }
        }
        else if($_GET['jenis']=='2'){
        if($_GET['toko'] =='0'){	
         $where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' GROUP BY id_barang, no_penjualan ORDER by no_penjualan asc"; 
        }
        else{	
        $where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' and id_customer='$_GET[toko]' GROUP BY id_barang, no_penjualan ORDER by no_penjualan asc";
        }
        }


		$kon=$db->select("v_penjualan_dtl_hpp", "*", $where2);
		//echo "select * from v_penjualan_dtl where $where2";
        $no=1; 
		$total = 0;
		$totdpp = 0;
		$totppn = 0;
        foreach($kon as $d){
		$total=$total+$d['dtl_total'];
		$dpp= $d['dtl_total']/1.1;
		$ppn= $dpp*(10/100); 
		$totdpp = $totdpp + $dpp;
		$totppn = $totppn + $ppn;  
		?>
        
         <tr>
         <td><?=$no?></td>
         <td><?php echo ucfirst(strtolower($d['tgl_penjualan']));?></td>
         <td><?php echo ucfirst(strtolower($d['no_penjualan']));?></td>
         <td  align="center"><?=$d['nama_usaha']?></td>
         <td><?=$d['alamat_usaha']?></td> 
         <td align="center"><?=$d['nama_barang']?></td>
         <td align="center"><?=number_format($d['HPP'])?></td>
         <td align="right"><?=$d['qty_jual']?></td>
         <td align="center"><?=number_format($d['harga_jual'])?></td>
         <td align="right"><?=number_format($d['dtl_total'])?></td>
          <td align="center" ><?=$d['NAMA_SALES']?></td>
          <td align="right" ><?=number_format($dpp)?></td>
          <td align="right" ><?=number_format($ppn)?></td> 
         </tr> 
<?php $no = $no +1;}} ?>     
                      <tfoot>
                      <tr >
                             <td bgcolor="#EFEFEF" colspan="8" align="center">Total Penjualan</td>
                             <td bgcolor="#EFEFEF" align="right">
                              </td>
 							  <td bgcolor="#EFEFEF" align="right">
                              <?=number_format($total)?>
                              
                              </td>
                                          
                             <td bgcolor="#EFEFEF" align="right">

                              </td>      
                             <td bgcolor="#EFEFEF" align="right">
                               <?=number_format($totdpp)?>   
                              </td>           
                             <td bgcolor="#EFEFEF" align="right">
                              <?=number_format($totppn)?>                              
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

