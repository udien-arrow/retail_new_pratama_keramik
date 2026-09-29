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

  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		 <form action="index.php?x=lapbisup" id="form_index" method="post">
           <div class="panel panel-flat">
					<div class="panel-heading noprint" >
						<h5 class="panel-title">
                        Laporan Biaya Supir
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
                                
                                <li><a target="_blank" href="cetak.php?cab=<?=$_GET['cab']?>&a=<?=$gg?>&b=<?=$wp?>&jenis=<?=$_GET['jenis']?>&sopir=<?=$_GET['sopir']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>


             <table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
                    <div class="col-lg-12">
                                <div class="form-group">     
                              	<div class="col-lg-2">
                              	  <select name="cab" id="cab" class="select-search">
                                  <option value="">---Cabang---</option>
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
                               <select name="sopir" id="sopir" class="select-search">
                                  <option value="">---Sopir---</option>
                                  <?php
								 			 $sop=explode("_",$_GET['sopir']);
								  				if($_SESSION['ID_CABANG']==0 OR $_SESSION['ID_CABANG']==99){
												$query=$db->select("m_pegawai","nama_pegawai,id_pegawai");
												} else {
													$query=$db->select("m_pegawai","nama_pegawai,id_pegawai","id_cabang='$_SESSION[ID_CABANG]' and id_jabatan='8'");
												}
											foreach($query as $sel){	
			                            ?>
                                 <option value="<?=$sel['id_pegawai'].'_'.$sel['nama_pegawai']?>" <?php if($sel['id_pegawai']==$sop[0]){echo "selected";}?>>
                                    <?=$sel['nama_pegawai']?>
                                  </option>
                                  <?php }?>
                                </select>
                                </div>
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
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(cab.value,tg.value,tgsd.value,sopir.value)">
                                    
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="submit" class="btn btn-info" value="Posting" name="posting">
                                    
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>
                    <?php
                    $ep=explode("_",$_GET['sopir']);
					?>
					<table id="example5" class="tableku datatable-basic " >
                        <thead>
                            <tr>
                              <th colspan="8" style="text-align:center" ><h5>LAPORAN BIAYA SUPIR <?php echo $ep['1'];?> CABANG <?php foreach($db->select("m_cabang","nama_cabang","id_cabang='$_GET[cab]'")as $cb); echo $cb['nama_cabang'];?><br>PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="12%">No SB</th>
                                <th width="10%">Tgl</th>
                                <th width="10%">Nama Sopir</th>
                              	<th width="15%">Customer</th>
                                <th width="15%">Nama Truck</th>
                                <th width="15%">Nama Barang</th>
                                <th width="5%">Qty</th>
                                <th width="10%">Jumlah Biaya</th>  
                                <th width="2%"> <input type="checkbox" id="call"></th>  
                          </tr> 
                      </thead>
                      <tfoot>
                      <tr>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td align="right">&nbsp;</td>
                              <td align="right">
                              <!--<input type="" name="hiu" id="hiu"  value="0"  class="form-control chiu" required>--> 
                              <span id="hiu"></span>
                              </td>
                               <td align="right">&nbsp;</td>
                           </tr> 
                      </tfoot>
                       </table>    
   		  </div>
</form>
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
<?php
if($_POST['posting']){
	//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$max=$db->select("ak_jurnal","max(IDJ)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$datajur = array(  'IDJ' => $id,
			   'IDKM'=> $idgen,
			   'NO_JURNAL' => $idj,
			   'DEBET' => $_POST['total'],
			   'KREDIT' => $_POST['total'],
			   'TGL_JURNAL' => date("Y-m-d"),
			   'USER' => $_SESSION['ID_LOGIN'],
			   'ID_CAB' => $_SESSION['ID_CABANG'],
			  );
		$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
		$jum=0;
		$namasup=explode("_",$_POST['sopir']);
		$dttime=date("Y-m-d H:i:s");
	foreach($_POST['split'] as $key => $value){
			$exp=explode("_",$value);
		//=========jurnal debet===================
			$jumlah+=$exp[1];
				$jum++;
				//
				$data = array(  
							   'status_jurnal' => 1,
							   );
				$execjur= $db->update("tx_sales_biaya_supir", $data,"id='$exp[0]'");	
			//====jurnal debet===================		
	}//end foreacg
			//====jurnal kredit===================
			if($jum>0){
				//debet
				$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='17' and status='1'");
				foreach($ckpph as $ckpph2){}
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $jumlah,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Gaji Supir : ".$namasup[1]." periode ".$_POST['tg']." s/d periode ".$_POST['tgsd']."",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => '',
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//kredit
				$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='22' and status='1'");
				foreach($ckpph as $ckpph2){}
				$datajur = array(  'NO_JURNAL' => $idj, 
										   'ACC_CODE' => $ckpph2['acc_code'],
										   'DEBET' => 0,
										   'KREDIT' => $jumlah,
										   'USD' => "0",
										   'KURS' => "0",
										   'KET_DTL' => "AJ Gaji Supir periode ".$namasup[1]." periode ".$_POST['tg']." s/d periode ".$_POST['tgsd']."",
										   'TGL_JURNAL' => date("Y-m-d"),
										   'TANGGAL' => $dttime,
										   'NO_INVOICE' => '',
										   'ID_CAB' => $_SESSION['ID_CABANG'],
										  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
			}
		echo "<script>	location.href='index.php?x=lapbisup&cab=$_POST[cab]&a=$_POST[tg]&b=$_POST[tgsd]&sopir=$_POST[sopir]' </script>";
}
?>
