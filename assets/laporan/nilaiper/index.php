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
               border: .1em solid #ddd;border-collapse:collapse; padding:15px; 
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
						<h5 class="panel-title"><?=$title?>
                        </h5>
                        <div class="heading-elements noprint">
                        <?php 
						  $a=explode('/',$_GET['a']);
						  $gg=$a[2]."-".$a[0]."-".$a[1];
						  $b=explode("/",$_GET['b']);
						  $wp=$b[2]."-".$b[0]."-".$b[1];
							?>
							<ul class="icons-list">
		                		<!--<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print" onclick="print()"></button></li>
                                <li><a target="_blank" href="cetak.php?cab=<?=$_GET['cab']?>&a=<?=$gg?>&b=<?=$wp?>&jenis=<?=$_GET['jenis']?>&page=<?=$_GET['x']?>"><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Print"></button></a></li>-->
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div><br>
             <div class="form-group">
						<div class="col-lg-4">
  <select name="cab" id="cab" class="select-search" onChange="pindahData2(cab.value)">
                <option value="">---Cabang---</option>
                <option value="all">All Cabang</option>
                <?php
				$query=$db->select("m_cabang","*","status='1'");
				foreach($query as $sel){	
				?>
			<option value="<?=$sel['id_cabang']?>" <?php if($sel['id_cabang']==$_GET['cab']){echo "selected";}?>>
			  <?=$sel['nama_cabang']?>
                </option>
                <?php }?>
              </select>
           
           
    </div>
                     
           			</div>
                    <table  class="table" cellpadding="3" id="example5" >
                        <thead>
                            <tr>
                              <th colspan="5" style="text-align:center" ><h5><?php 
							  echo strtoupper($title);
							  
							  if($_GET['cab']=='all'){	
							  	echo " SEMUA CABANG";
							  }else{
								 foreach($db->select("m_cabang","*","id_cabang='$_GET[cab]'")as $ca);	 							 	 echo " ".$ca['nama_cabang'];
							  }
							  ?>  <br>
                              </h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="4%">Id</th>
                                <th width="52%">Jenis</th>
                                <th width="24%">Jumlah Baik</th>
                                <th width="24%">Jumlah Jelek</th>
                                <th width="24%">Total</th>  
                          </tr> 
                          
                      </thead>
                    <?php foreach($db->select("m_grup","*")as $val){
					
					?>
                          
                           <tr height="4%">
                                <th width="4%"><?=$val['id_grup'];?></th>
                                <th width="52%" style="text-align:left"><?=$val['jenis'];?></th>
                                <th width="24%" style="text-align:right">
								<?php
                        if($_GET['cab']=='all'){		  
							foreach($db->select("v_notif","sum(akhir*hpp)as total","id_grup='$val[id_grup]'")as $jum);	  
						}else{
							foreach($db->select("v_notif","sum(akhir*hpp)as total","id_grup='$val[id_grup]' and id_cabang='$_GET[cab]'")as $jum);	  
							
						}
								echo number_format($jum['total'],2);?></th>
                                <th width="24%" style="text-align:right"> <?php
                          if($_GET['cab']=='all'){		  
							foreach($db->select("v_notif_re","sum(akhir*hpp)as total","id_grup='$val[id_grup]'")as $jum2);	  
						}else{
							foreach($db->select("v_notif_re","sum(akhir*hpp)as total","id_grup='$val[id_grup]' and id_cabang='$_GET[cab]'")as $jum2);	  
							
						}      
								echo number_format($jum2['total'],2);?></th>
                                <th width="24%" style="text-align:right">
                                <?php
                                echo number_format($jum['total']+$jum2['total'],2);
								?>
                                </th>  
                          </tr> 
                          <?php 
						  $nil=$nil+($jum['total']+$jum2['total']);
						  $nilba=$nilba+$jum['total'];
						  $nilje=$nilje+$jum2['total'];
						  }
						  ?>
                       <tr height="4%">
                             <th colspan="2">Total</th>
                             <th style="text-align:right"><?=number_format($nilba,2);?></th>
                             <th style="text-align:right"><?=number_format($nilje,2);?></th>
                             <th style="text-align:right"><?=number_format($nil,2);?></th>
                           </tr>
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

