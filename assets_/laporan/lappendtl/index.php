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
                        Laporan Detil Penjualan
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
                                <li><a target="_blank" href="cetak.php?cab=<?=$_GET['cab']?>&a=<?=$gg?>&b=<?=$wp?>&jenis=<?=$_GET['jenis']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>
                              <!--  <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>-->
                             <li> <input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel v2"  onclick="javascript:window.open('assets/laporan/lappendtl/lap.php?cab=<?=$_GET['cab']?>&a=<?=$_GET['a']?>&b=<?=$_GET['b']?>&jenju=<?=$_GET['jenju']?>&aksi=xls','blank')"></li>
						  </ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
                    <div class="col-lg-12">
                                <div class="form-group">     
                              	<div class="col-lg-3">
                              	  <select name="cab" id="cab" class="select-search">
                                  <option value="">---Cabang---</option>
                                  <?php if($_SESSION['ID_CABANG']=='0' OR $_SESSION['ID_CABANG']=='99'){ ?>
                                  <option value="A" <?php if($_GET['cab']=='A'){echo "selected";}?>>---All Cabang---</option>
                                   <?php } ?>
                                  <?php
								  			if($_SESSION['ID_CABANG']==0 OR $_SESSION['ID_CABANG']==99){
												$query=$db->select("m_cabang","id_cabang,nama_cabang","status='1'");
												} else {
													$query=$db->select("m_cabang","id_cabang,nama_cabang","status='1' AND id_cabang='$_SESSION[ID_CABANG]'");
												}
											foreach($query as $sel){	
			                            ?>
                                  <option value="<?=$sel['id_cabang']?>" <?php if($sel['id_cabang']==$_GET['cab']){echo "selected";}?>>
                                    <?=$sel['nama_cabang']?>
                                  </option>
                                  <?php }?>
                                </select>
                               </div>
                               <div class="col-lg-2">
                              	  <select name="jenju" id="jenju" class="select-search">
                                  <option value="">---Jenis Jual---</option>
                                  <option value="A" <?php if($_GET['jenju']=='A'){echo "selected";}?>>---All---</option>
                                  <option value="1" <?php if($_GET['jenju']=='1'){echo "selected";}?>>Semen</option>
                                  <option value="2" <?php if($_GET['jenju']=='2'){echo "selected";}?>>Non Semen</option>
                                </select>
                               </div>
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
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(cab.value,tg.value,tgsd.value,jenju.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
                    <div class="table-responsive pre-scrollable">
					<table id="example5" class="tableku  " >
                        <thead>
                            <tr>
                              <th colspan="16" style="text-align:center" ><h5>LAPORAN DETIL PENJUALAN CABANG 
                              <?php foreach($db->select("m_cabang","nama_cabang","id_cabang='$_GET[cab]'")as $cb); echo $cb['nama_cabang'];?><br>PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="10%">Customer</th>
                                <th width="10%">Cabang</th>
                                <th width="5%">Sales</th>
                                <th width="5%">#</th>
                              	<th width="10%">No SPJ</th>
                                <th width="10%">Nopol</th>
                                <th width="10%">Tanggal SPJ</th>
                                <th width="10%">No Ref</th>
                                <th width="15%">Nama Barang</th>
                                <th width="5%">Jenis</th>
                                <th width="5%">Qty</th>
                                <th width="5%">Harga</th>
                                <th width="5%">Jumlah</th>
                                <th width="5%">DPP</th>  
                                <th width="5%">HPP</th>  
                                <th width="5%">NIHPP</th>  
                          </tr> 
                      </thead>
                      <?php
                      $table="tx_do_dtl a
JOIN tx_do b ON a.no_spj = b.no_spj
JOIN m_customer c on b.id_cus=c.id_cus 
JOIN m_barang d on a.id_barang=d.id_barang 
LEFT JOIN (select id_cus,max(tgl_berlaku)as tgl_berlaku,id_cro from m_customer_cro GROUP BY id_cus) e on b.id_cus=e.id_cus and b.tgl_spj>=e.tgl_berlaku
LEFT JOIN m_pegawai f on e.id_cro=f.id_pegawai
LEFT JOIN tx_sales_biaya_dtl g on b.no_ref=g.no_so 
LEFT JOIN m_cabang h on b.id_cabang=h.id_cabang
LEFT JOIN tx_sales_order i on b.no_ref=i.no_sales
 ";
					  $isi="b.id_spj,b.id_cabang,b.id_gudang,b.no_ref,a.id_barang,
	c.nama_usaha,
	b.id_cus,
	b.no_spj,
	b.jenis_kirim,
	b.tgl_spj,
	d.nama_barang,
	a.qty,
	a.harga,
	a.hpp_akhir,
	a.qty * a.harga AS total,b.jenis_jual,
	concat(a.id_spj,'_',a.qty * a.harga)as gab,
	IFNULL(e.id_cro,'')as id_cro,IFNULL(f.nama_pegawai,'')as nama_pegawai,
	ifnull(g.nopol,'') as nopol,
	nama_cabang,i.no_spj_rilis";
				if($_GET['cab']=='A'){
					$cab="";
				}else{
					$cab="b.id_cabang='$_GET[cab]' AND";
				}
				if($_GET['jenju']=='A'){
					$jenju="";
				}else{
					$jenju="and b.jenis_jual='$_GET[jenju]'";
				}
				$tgl=date("Y-m-d",strtotime($_GET['a']));
				$tglsd=date("Y-m-d",strtotime($_GET['b']));
				
				$where="$cab date(b.tgl_spj) BETWEEN '$tgl' AND '$tglsd' $jenju";
				$haha=$db->select($table,$isi,$where);
				foreach($haha as $dta){
					  ?>
                      <tr>
                              <th><?php echo $dta['nama_usaha']?></th>
                              <th><?php echo $dta['nama_cabang']?></th>
                              <th><?php echo $dta['nama_pegawai']?></th>
                              <th><?php echo $dta['jenis_kirim']?></th>
                              <th><?php echo $dta['no_spj']?></th>
                              <th><?php echo $dta['nopol']?></th>
                              <th><?php echo $dta['tgl_spj']?></th>
                              <th><?php 
							  if($dta['jenis_kirim']=='SWC'){
									echo $dta['no_spj_rilis'];
							  }else{
							  		echo $dta['no_ref'];
							  }
							  ?></th>
                              <th><?php echo $dta['nama_barang']?></th>
                              <th><?php 
							  if($dta['jenis_jual']=="1"){
								$a="Semen";	
								}else{
								$a="Non Semen";	
								}
							  	echo $a?></th>
                              <th><?php echo $dta['qty']?></th>
                              <th><?php echo $dta['harga']?></th>
                              <th><?php 
							 	 $a=explode('_',$dta['gab']);
								 $s=number_format($a[1],2);
							 		 echo $s?></th>
                              <th><?php echo number_format($jdp=($dta['qty']*$dta['harga'])/1.1,2);?></th>
                              <th><?php echo number_format($dta['hpp_akhir'],2);?></th>
                              <th><?php echo number_format($dta['qty']*$dta['hpp_akhir'],2)?></th>
                            </tr>
                       <?php 
					   $jumi=$jumi+$a[1];
					   $jumd=$jumd+$jdp;
					   }?> 
                      <tfoot>
                       <tr>
                              <th colspan="12">Total</th>
                              <th><?php echo number_format($jumi,2)?></th>
                              <th><?php echo number_format($jumd,2)?></th>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                            </tr>
                      </tfoot>
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


</script>        

