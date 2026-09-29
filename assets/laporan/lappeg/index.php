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

.headcol {
            position:absolute; 
            width:5em; 
            left:0;
            top:auto;
            border-right: 0px none black; 
            border-top-width:3px; /*only relevant for first row*/
            margin-top:-3px; /*compensate for top border*/
        }
        .long { background:yellow; letter-spacing:1em; }
		
#dk { 
            width: 600px; 
            overflow-x:scroll;  
            margin-left:5em; 
            overflow-y:visible;
            padding-bottom:1px;
        }
</style>

  	<div class="col-lg-1">								
		</div>
          <div class="col-lg-10">
		 
           <div class="panel panel-flat">
					<div class="panel-heading noprint">
						<h5 class="panel-title"><?=$title?>
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
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example5')"></button></li>
							</ul>
                      </div>
					</div>
                     <div class="dataTables_wrapper"></div>
             <table  class="table table-bordered table-striped table-hover dataTable no-footer noprint">
                    <tr><td>
                    <div class="col-lg-9">
                                <div class="form-group">     
                              	<div class="col-lg-3">
                              	  <select name="cab" id="cab" class="select-search">
                                  <option value="">---Cabang---</option>
                                  <option value="all" <?php if($_GET['cab']=='all'){echo "selected";}else{}?>>---All---</option>
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
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Go" onClick="pindahData2(cab.value)">
                               </div>
                               
                    </div>
                              </div>
                              </td></tr>
                    </table>

					<table id="example5" class="stripe row-border order-column" >
                        <thead>
                            <tr>
                            <th></th>
                              <th colspan="14" style="text-align:center" ><h5><?=strtoupper($title)?> CABANG <?php foreach($db->select("m_cabang","nama_cabang","id_cabang='$_GET[cab]'")as $cb); echo $cb['nama_cabang'];?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="10%">Nama</th>
                                <th width="10%">Nik</th>
                                <th width="10%">Tanggal Lahir</th>
                                <th width="10%">Jenis Kelamin</th>
                              	<th width="10%">Nomer KTP</th>
                                <th width="10%">Tanggal Mulai</th>
                                <th width="10%">Pendidikan</th>
                                <th width="10%">NPWP</th>
                                <th width="10%">Email</th>  
                                <th width="10%">Jamsostek</th>
                                <th width="10%">Jabatan</th>
                                <th width="10%">St Jabatan</th>
                                <th width="10%">Pangkat</th>
                                <th width="10%">Cabang</th>
                          </tr> 
                      </thead>
                     
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

