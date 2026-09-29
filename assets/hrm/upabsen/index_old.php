

    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
	 <form class="form-horizontal" action="index.php?x=upabsen_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())"  enctype="multipart/form-data">
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<br>
                  <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;Upload Absensi</label>
                            
                             <div class="col-lg-4">
                                 <input type="file" name="file" id="file" size="150"  class="file-input" data-show-preview="false">
                               </div>
                               <div class="col-lg-3">
                                 Contoh Upload :<a href="assets/hrm/upabsen/upload_absen.csv" ><img id="expxls" name="expxls" src="assets/hrm/upabsen/excel.png" alt="" width="22" height="22" border="0"  title="Type file .csv"/></a>
                              </div>  
                               
                    </div>
					
				</div>					
		</div>
</form>
	
    <div class="col-lg-12">
		<form action="index.php?x=order_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
		    <div class="panel-heading">
						<h5 class="panel-title">Data Absensi</h5>
                     </div>
            <div class="dataTables_wrapper">
                    </div><br>
                   <?php include("bulantahun.php");?><input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData(bulan.value,tahun.value)">
                   <button type="button" class=" btn btn-default btn-sm hidden" data-toggle="modal" id="klik" data-target="#dataabsen" ></button>
                   <button type="button" class=" btn btn-default btn-sm hidden" data-toggle="modal" id="klikall" data-target="#dataabsenall" ></button>
                   <br><br>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr height="30px">
          <td width="1%"align="center" bgcolor="#2196f3">No</td>
          <td align="center" width="10%" bgcolor="#2196f3"><b>Nama Pegawai</b></td>
          <?php
		  $per=$_GET['tahun'].'-'.$_GET['bulan'].'-1';
		  $tglakhir=date('t',strtotime($per));
		  for($i=1;$i<=$tglakhir;$i++){
		  //$dt = strtotime("".$_GET['bulan']."/$i/".$_GET['tahun']."");
          //$days =date('l',$dt);
		  include('hari.php');
		  ?>
          <td width="1%" align="center" bgcolor="#2196f3" title="<?=$hari?>" style="cursor:pointer" onMouseOut="this.style.backgroundColor='#2196f3';" onMouseOver="this.style.backgroundColor='#FFFFCC' ;"><?php echo $i?></td>
          <?php
		  }
		  ?>
          </tr>
        <?php
		
		if($_GET[bulan]!=''){
			$kon=$db->select("m_pegawai","*","id_cabang!='99'");
		}
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"  bgcolor="#2196f3"><?php echo $no?>&nbsp;</td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;<?php echo ucfirst(strtolower($d['nama_pegawai']));?>&nbsp;</td>
          <?php
		  for($i=1;$i<=$tglakhir;$i++){
			$date=$_GET['tahun'].'-'.$_GET['bulan'].'-'.sprintf("%02s", $i);  
			foreach($db->select("hr_absensi","acno,work_time,jenis","id_pegawai='$d[id_pegawai]' and date='$date'")as $vj);
		  ?>
          <td id="nm<?=$d[id_pegawai].'_'.$date?>" style="cursor:pointer" align="center"  
           <?php if($vj['acno']!='' && $vj['jenis']=='1'){?>
           bgcolor="blue"
           onMouseOut="this.style.backgroundColor='blue';" 
           onMouseOver="this.style.backgroundColor='white' ;" onClick="ruwet('<?=$d['id_pegawai']?>','<?=$vj['acno']?>','<?=$date?>')"
           <?php }elseif($vj['acno']!='' && $vj['jenis']=='2'){?>
           bgcolor="red"
           onMouseOut="this.style.backgroundColor='red';" 
           onMouseOver="this.style.backgroundColor='white' ;" onClick="ruwet('<?=$d['id_pegawai']?>','<?=$vj['acno']?>','<?=$date?>')"
           <?php }elseif($vj['acno']!='' && $vj['jenis']>='3'){?>
           bgcolor="green"
           onMouseOut="this.style.backgroundColor='green';" 
           onMouseOver="this.style.backgroundColor='white' ;" onClick="ruwet('<?=$d['id_pegawai']?>','<?=$vj['acno']?>','<?=$date?>')"
           <?php }else{?>
           bgcolor="#797979"
           onMouseOut="this.style.backgroundColor='#797979';" 
           onMouseOver="this.style.backgroundColor='white' ;" onClick="ruwet('<?=$d['id_pegawai']?>','<?=$vj['acno']?>','<?=$date?>')"
           <?php }?>
           ><?=$d['tgl_kirim']?></td>
            <?php
			 $vj['acno']='';
		  }
		  ?>
          </tr>
        <?php $no++;} ?>
</table>	
            <input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   			<input type="hidden" name="sat_in" id="sat_in" required>
   		  </div>
			</form>
		</div>
<div id="dataabsen" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h6 class="modal-title">Detil Absensi</h6>
              </div>
              <div class="modal-body" id="hahaha">
              
                                              
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                  
              </div>
          </div>
      </div>
</div>
<div id="dataabsenall" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h6 class="modal-title">Detil Absensi</h6>
              </div>
              <div class="modal-body" id="hahahaall">
              
                                              
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                  
              </div>
          </div>
      </div>
</div>

<?php
if($_POST['delnot']){
	$where = array("status" => 1);
	$db->delete("hr_absensi_notif",$where);
}
?>
