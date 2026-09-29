  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		  <div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php
                    $cab=$db->ses_cab($_SESSION['ID_CABANG']);
					echo $title;
					?>
					</h5>
                    <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li></li>
							</ul>
                            </div>
                    <hr>
                    <input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button>
					<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0" id="example4">
    <thead> 
            <tr>
				<th colspan="7" align="left"><b>Piutang</b></th>
			</tr>
          <tr bgcolor="#28343a">
            <th width="11%" rowspan="2" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" rowspan="2" align="center"><font style="color:#FFF"><b>Tgl </b></font></th>
            <th colspan="2" align="center"><font style="color:#FFF"><b>Total Piutang</b></font></th>
            <th width="12%" colspan="2" align="center"><font style="color:#FFF"><b>Umur Piutang</b></font></th>
            <th width="50%" rowspan="2" align="center"><font style="color:#FFF"><b> BG</b></font></th>
          </tr>
          <tr bgcolor="#28343a">
            <th align="center"><font style="color:#FFF"><b>Semen</b></font></th>
            <th align="center"><font style="color:#FFF"><b>Non Semen</b></font></th>
            <th width="12%" align="center"><font style="color:#FFF"><b>Tempo</b></font></th>
            <th width="6%" align="center"><font style="color:#FFF"><b>Umur</b></font></th>
          </tr>
        </thead>
          <?php
	  $query=$db->select("m_customer","id_cus,nama_usaha,kode_cus","status='1' and head=''");
	  $totsem='';
	  $totnon='';
	  foreach($query as $sel){
	  $s=$sel['id_cus'].'_'.$sel['kode_cus'];
       $exp2=explode("_",$s);
 $jum=count($db->select("tx_piutang","*","id_cus='$exp2[0]' and status_bayar=0"));
 $totsem='';
	  $totnon='';
      if($jum>0){		  
	  ?>   
        <tbody>
          <?php 
		  	$info=$db->select("m_customer a join m_cabang b on a.id_cabang=b.id_cabang","a.id_cus,a.kode_cus,a.nama_usaha,b.nama_cabang","a.status=1 and head='' and a.id_cus='$exp2[0]'");
		  
		  $no=1;
		  $tgl=date("Y-m-d");
		  foreach($info as $infoval){
		  ?>
          <tr>
            <td colspan="7" ><b><?php echo $infoval['nama_usaha'] .'-'. $infoval['nama_cabang']?></b></td>
          </tr>
          <?php 
		  /////////////////////===========================piutang
		  
		  $dtl=$db->select("tx_piutang","*","id_cus='$infoval[id_cus]' and status=1 and status_bayar=0 ");
		  foreach($dtl as $arr){
			  $bg['dibayar']='';
			  $bg['no_seribg']='';
			  $bg['jenis_bg']='';
			  $nmb['description']='';
			  $bg['jatuh_tempo']='';
			  $bg['nama_bank']='';
			  foreach($db->select("tx_pembayaran_sales","sum(total_dibayar)as bay","no_faktur='$arr[no_faktur_jual]' and jenis_piutang='$arr[jenis_piutang]'")as $pem); 
			  
			  foreach($db->select("tx_pembayaran_sales","abs(sum(total_dibayar))as bay","no_faktur_ref='$arr[no_faktur_jual]'")as $pem2); 
			  
		  ?>
          <tr>
            <td align="left"><?php echo $arr['no_faktur_jual'];?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($arr['tgl']));?></td>
            <td width="11%" align="right"><?php
			if($arr['jenis_jual']==1){
				echo number_format($jums=$arr['total_piutang']-$pem['bay']-$pem2['bay']);
				$totsem=$totsem+$jums;
			}
			?></td>
            <td width="12%" align="right"><?php
            if($arr['jenis_jual']==2){
				echo number_format($jumn=$arr['total_piutang']-$pem['bay']-$pem2['bay'],0);
				$totnon=$totnon+$jumn;
			}
			?></td>
            <td align="right"><?php echo date("d-m-Y",strtotime($arr['tempo_tambahan']));?></td>
            <td align="right">
            <?php
             $selisih = ((abs(strtotime ($arr['tempo_tambahan']) - strtotime ($arr['tgl'])))/(60*60*24));
			 echo $selisih.' Hari';
			?>
            </td>
            <td align="right">
            <?php 
			$ak=$db->select("tx_tagihan_kembali_dtl","dibayar,no_seribg,nama_bank,jatuh_tempo","no_fj='$arr[no_faktur_jual]' and jenis_pem='3' and status=0");
			$juma=count($ak);
			if($juma>0){
			?>
            
			<table border="1" cellspacing="2" cellpadding="1" width="100%">
            	<tr bgcolor="#D2D2D2">
                	<td>Nilai BG</td>
                    <td>No BG</td>
                    <td>Bank BG</td>
                    <td>Jenis</td>
                    <td>Tgl Tempo</td>
                </tr>
                <?php 
				
				foreach($ak as $bg){
				 ?>
                <tr>
                  <td><?php echo number_format($bg['dibayar']);?></td>
                  <td><?php echo $bg['no_seribg'];?></td>
                  <td><?php  foreach($db->select("ak_acc","description","account='$bg[nama_bank]'")as $nmb);
								echo $nmb['description'];?></td>
                  <td><?php if($bg['jenis_bg']==1){
					echo 'Cair';
				}elseif($bg['jenis_bg']==2){
					echo 'blonk';
					}?></td>
                  <td><?php 
			if($bg['jatuh_tempo']!=''){
			echo date("d-m-Y",strtotime($bg['jatuh_tempo']));
			}
			?></td>
                </tr>
                <?php 
				
				}?>
            </table>
            <?php }?>
            </td>
          </tr>
          <?php 
		  	}
		  
			//===================================================================end piutang
		  ?>
          
          <?php 
		  	 $no++;
			  }?>
        </tbody>
         <tr>
            <td colspan="7" align="left">&nbsp;</td>
         </tr>
           <tr>
            <td align="left">&nbsp;</td>
            <td align="center" >&nbsp;</td>
            <td align="right"><?php
            	echo number_format($totsem,0);
			?></td>
            <td align="right"><?php
            	echo number_format($totnon,0);
			?></td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            </tr>
            <tr>
            <td colspan="7" align="left">&nbsp;</td>
         </tr>
    <?php } }?>      
          
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