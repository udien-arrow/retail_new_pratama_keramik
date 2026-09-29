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
.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
</style>
  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		 
           <div class="panel panel-flat scrolls">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        Laporan <?=$title?>
                      </h5>
                        <div class="heading-elements noprint">
							<ul class="icons-list">
		                		<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table width="100%"  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
                    <div class="col-lg-9">
                                <div class="form-group">
                                <div class="col-lg-4">
                              	  <div class="input-group">
                               <select name="sup" id="sup" class="select-search">
                <option value="">---Supplier---</option>
                                  <?php 
								  $date=date("Y-m-d");
									   $gudang=$db->select("(select * from ex_tarif_oa order by tgl_berlaku desc) as aku join m_supplier c on aku.id_supp=c.id_supp group by aku.id_supp","aku.*,nama_usaha");
									  foreach($gudang as $val){
									  ?>
                                  <option value="<?=$val['id_supp']?>" <?php if($_GET['supp']==$val['id_supp']){echo "selected";}?>>
                                    <?=$val['nama_usaha']?>
                                  </option>
                                  <?php } ?>
                                </select>
                               
                               </div>
                               </div>
                                
                                  <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>

                                  <input class="form-control datepicker1" name="tgl1" id="tgl1" />
                                  </div>
                               </div>
                               
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                   <input class="form-control datepicker1" name="tgl2" id="tgl2" />

                                 </div>
                                  
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(tgl1.value,tgl2.value,sup.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
					<table width="100%" class="table-columned" id="example5" >
                        <thead>
                            <tr>
                              <th colspan="14" style="text-align:center" ><h5>LAPORAN <?=strtoupper($title)?>  
                              					<br>PERIODE <br /><?php echo date("d/m/Y", strtotime($_GET[d1]))." s.d. ".date("d/m/Y",strtotime($_GET[d2])).""; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                           	  <th width="10%">Tgl SPJ</th>
                              <th width="10%">Nomor SPJ</th>
                              <th width="10%">No Kendaraan</th>
                              <th width="10%">Sopir</th>
                              <th width="10%">Tujuan</th>
                              <th width="10%">Nama Barang</th>
                              <th width="10%">Berat (KG)</th>
                              <th width="10%">Total KG</th>
                              <th width="10%">Qty</th>
                              <th width="10%">Tarif OA</th>
                              <th width="10%">Rupiah Total</th>
                              <th width="10%">Total Tagihan</th>
                              <th width="10%">Retur</th>
                              <th width="10%">Premi</th>
                      </thead>
                      <tbody>
                      <?php 
					  $sup=$db->select("ex_order_tagihan a
JOIN ex_order_tagihan_dtl b ON a.no_pt = b.no_pt
JOIN ex_expediture c ON b.no_expediture = c.no_expediture
JOIN ex_expediture_dtl d on c.no_expediture=d.no_expediture
JOIN ex_expediture_biaya_dtl e on c.no_expediture=e.no_expediture
JOIN m_barang_gudang f on d.id_barang=f.id_barang and f.id_gudang=d.id_gudang
JOIN m_kendaraan g on c.id_kendaraan=g.id
JOIN m_pegawai h on g.id_pegawai=h.id_pegawai
JOIN ex_lokasi_kirim i on c.id_lokasi=i.id","c.no_expediture,
c.tgl,
c.id_lokasi,
c.tarif_ao,
c.total_ao,
c.ket,
d.berat,
d.nilai_ao,
f.nama_barang,
e.no_expediture,
e.stampdate,
e.id_user,
e.gaji_sopir,
e.gaji_kernet,
e.ujs,
e.kosongan,
e.premi,
g.nopol,
h.nama_pegawai,
c.no_so,
c.id_supp,i.lokasi_kirim,d.qty","c.id_supp='$_GET[supp]'");
foreach($sup as $supp){
					   ?>
                      <tr>
                      <td><?=$supp['tgl']?></td>
                      <td><?=$supp['no_so']?></td>
                      <td><?=$supp['nopol']?></td>
                      <td><?=$supp['nama_pegawai']?></td>
                      <td><?=$supp['lokasi_kirim']?></td>
                      <td><?=$supp['nama_barang']?></td>
                      <td><?=$supp['berat']?></td>
                      <td><?=$supp['berat']*$supp['qty']?></td>
                      <td><?=$supp['qty']?></td>
                      <td><?=number_format($supp['tarif_ao'])?></td>
                      <td><?=number_format($supp['nilai_ao'])?></td>
                      <td><?=number_format($supp['total_ao'])?></td>
                      <td></td>
                      <td><?=number_format($supp['premi'])?></td>
                      </tr>
                      
<?php } ?>
                      </tbody>
                      
                      
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

