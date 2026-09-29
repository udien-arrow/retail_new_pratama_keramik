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
    <div class="col-lg-12">
		<form action="index.php?x=order_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
		    <div class="panel-heading">
						<h5 class="panel-title">Data Ketidakhadiran</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Form ijin" onClick="window.location='index.php?x=ijin'"></button></li>
							</ul>
              </div>
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
          <td align="center" width="8%" bgcolor="#2196f3"><b>Nama Pegawai</b></td>
          <?php
		  if($_GET['bulan']==01){
				$thn=$_GET['tahun']-1;
				$bln="01";
		  }else{
			 	$thn=$_GET['tahun'];
				$bln=$_GET['bulan']-1;
		  }
		  $per=$thn.'-'.$bln.'-1';
		  
		  $tglakhir=date('t',strtotime($per));
		  for($i=26;$i<=$tglakhir;$i++){
		  include('hari.php');
		  ?>
          <td width="1%" align="center" bgcolor="#2196f3" title="<?=$hari?>" style="cursor:pointer" onMouseOut="this.style.backgroundColor='#2196f3';" onMouseOver="this.style.backgroundColor='#FFFFCC' ;"><?php echo $i?></td>
          <?php
		  }
		  ?>
          <?php
		  for($i=1;$i<=27;$i++){
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
		  $ak1='';
		  for($i=26;$i<=$tglakhir;$i++){
			$vj['jenis']='';
			$date=$thn.'-'.$bln.'-'.sprintf("%02s", $i);  
			foreach($db->select("hr_ijin","jenis","id_pegawai='$d[id_pegawai]' and date='$date'")as $vj);
		  ?>
          <td  align="center"><?=$vj['jenis']?></td>
          <?php
		  $ak1=$ak1+$vj['jam'];
		  }
		  ?>
          <?php
		  $ak2='';
		  for($i=1;$i<=27;$i++){
			$vj['jenis']='';
			$date=$_GET['tahun'].'-'.$_GET['bulan'].'-'.sprintf("%02s", $i);  
			foreach($db->select("hr_ijin","jenis","id_pegawai='$d[id_pegawai]' and date='$date'")as $vj);
		  ?>
          <td align="center"><?=$vj['jenis']?></td>
          <?php
		   $ak2=$ak2+$vj['jam'];	
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
