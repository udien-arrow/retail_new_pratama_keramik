  	     <div class="col-lg-12">
		  <?php if($_GET[id]==''){?>
          
          <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                		<?php
                                $dt=$db->select("v_notif","gab_kon","id_gudang='$_GET[gud]'");
								foreach($dt as $vdt){
									$exp=explode("_",$vdt['gab_kon']);	
									$a=$a+$exp[0];
									$b=$b+$exp[1];
								}
								$pe=$a/$b;
								$d=number_format($pe*100,2);
								if($d>70){
									$war="#FF2020";		
								}elseif($d>65 && $d<70){
									$war="#FFFF37";
								}elseif($d>20 && $d<65){
									$war="#0C6";
								}elseif($d<=20){
									$war="#F0F";
								}
								
								?>
                               
                                <li><input type="button" class="btn btn-info" style="height:26px; line-height: 0;" value="Level Stok" onClick="pindahd()"></button></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button></li>
                               <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel v2"  onclick="javascript:window.open('assets/laporan/persediaan/lap.php?gud=<?=$_GET['gud']?>&tg=<?=$_GET['tg']?>&aksi=xls','blank')"></button>
							</ul>
                            </div>
					</div>
                     <div class="table-responsive pre-scrollable">
                    <div class="col-lg-3">
                                <select name="gud" id="gud" class="select-search">
                                  <option value="">---Gudang---</option>
                                  <option value="all">---ALL---</option>
                                  <?php
											$query=$db->select("m_gudang","id_gudang,nama_gudang","status='1'");
											foreach($query as $sel){	
			                            ?>
                                  <option value="<?=$sel['id_gudang']?>" <?php if($sel['id_gudang']==$_GET['gud']){echo "selected";}?>>
                                    <?=$sel['nama_gudang']?>
                                  </option>
                                  <?php }?>
                                </select>
                                </div>
							 <div class="col-lg-2">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[tg]?>">
                                  </div>
                               </div>
                                <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="go" onClick="pindahData2(gud.value,tg.value)">
                               </div>
                               
                                                        
					<table id="example4" class="table  table-bordered table-striped table-hover dataTable no-footer " >
                        <thead>
                           
                            <tr>
                              <th width="10%">Cabang</th>
                                <th width="10%">Kode </th>
                              	<th width="50%">Nama Barang</th>
                              	
                                <th width="15%">Satuan</th>
                                <th width="15%">Berat</th>
                                <th width="10%">Min</th>
                                <th width="10%">Max</th>
                                <th width="15%">Awal</th>
                                <th width="15%">Masuk</th>
                                <th width="15%">Keluar</th>  
                                <th width="15%">Akhir</th>
                                <th width="5%">Hpp</th>
                                <th width="5%">Rupiah Akhir</th>
                              <!-- <th width="5%">ITO</th>
                                <th width="5%">AIP</th>-->
                                <th width="5%">Mutasi</th>                              
                                
                            </tr>
                        </thead>
                        <?php
						$tgllan=date("y-m-d",strtotime($_GET['tg']));
						
						if($_GET['gud']=='all'){
							$guda=" and a.tipe=1";
						}else{
							$guda=" and a.id_gudang='$_GET[gud]' and a.tipe=1";
						}
						
                        $row=$db->select("m_barang_gudang a 
left join m_satuan d on a.id_satuan=d.id_satuan
left join m_cabang h on a.id_cabang=h.id_cabang
LEFT JOIN m_gudang zz on a.id_gudang=zz.id_gudang
left join tx_mutasi b on a.id_gudang=b.id_gudang and a.id_barang=b.id_barang and b.id_mutasi=
( SELECT c.id_mutasi 
         FROM tx_mutasi c 
         WHERE c.id_barang = a.id_barang and c.id_gudang = a.id_gudang
         and date(c.tgl_mutasi)<='$tgllan'
		 ORDER BY c.id_mutasi DESC
         LIMIT 0,1
       )","a.*,
concat(IFnull(b.awal,0),'_',ifnull(b.masuk,0),'_',ifnull(b.keluar,0),'_',ifnull(b.akhir,0),'_',ifnull(b.hpp,0)) as persediaan,ifnull(b.hpp,0) as hpp_mutasi,d.nama_satuan,h.nama_cabang,zz.nama_gudang,a.berat","a.status=1 $guda GROUP BY a.id_gudang,a.id_barang");
						foreach($row as $arrdt){
						foreach($db->select("tx_mutasi","ifnull(awal,0)as awal,ifnull(sum(masuk),0)as masuk,ifnull(sum(keluar),0)as keluar","id_gudang='$arrdt[id_gudang]' and id_barang='$arrdt[id_barang]' and date(tgl_mutasi)<='$tgllan'")as $dts);
						
						$per=explode("_",$arrdt['persediaan']);
						
						$awal=$dts['awal'];
						$masuk=$dts['masuk'];
						$keluar=$dts['keluar'];
						$akhir=$dts['awal']+$dts['masuk']-$dts['keluar'];
						
						/*if($akhir==0){
							$awal=$per[0];
							$masuk=$per[1];
							$keluar=$per[2];
							$akhir=$per[3];	
						}else{*/
							$awal=$dts['awal'];
							$masuk=$dts['masuk'];
							$keluar=$dts['keluar'];
							$akhir=$dts['awal']+$dts['masuk']-$dts['keluar'];	
						//}
						
						$hpp=$per[4];
						$nawal=$awal*$per[4];
						$nasuk=$masuk*$per[4];
						$nakel=$keluar*$per[4];
						$pers=($awal+$masuk-$keluar)*$per[4];
						
						?>
                        
                      
                      <tr>
                              <th align="left"><?php echo $arrdt['nama_gudang']?></th>
                              <th align="left"><?php echo $arrdt['kode_barang']?></th>
                              <th align="left"><?php echo $arrdt['nama_barang']?></th>
                               <th align="left"><?php echo $arrdt['nama_satuan']?></th>
                              <th align="left"><?php echo $arrdt['berat']?></th>
                             
                              <th align="left"><?php echo $arrdt['min']?></th>
                              <th align="left"><?php echo $arrdt['max']?></th>
                              <th><?php echo $awal?></th>
                              <th><?php echo $masuk?></th>
                              <th><?php echo $keluar?></th>
                              <th><?php echo number_format($akhir,2)?></th>
                              <th align="right"><?php echo $hpp?></th>
                        <th align="right"><?php echo number_format($pers,2)?></th>
                        <!--<th align="right">&nbsp;</th>
                        <th align="right">&nbsp;</th>-->
                              <th><ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' onclick='mutas(<?=$arrdt['id_barang']?>)' class='btn btn-info' value='Mutasi' ></button></li>
			</ul></th>
                      </tr>
                            <?php 
								$tawal+=$awal;
								$tmasuk+=$masuk;
								$tkeluar+=$keluar;
								$takhir+=$akhir;
								
								$nnhpp+=$nhpp;
								$nnawal+=$nawal;
								$nnmasuk+=$nasuk;
								$nnkeluar+=$nakel;
								$nnakhir+=$pers;
							
								$arrdt['id_barang']='';
							
							}
							
							?>
                            <tr>
                          <th colspan="7" align="center">Total</th>
                          <th><?=$tawal?></th>
                          <th><?=$tmasuk?></th>
                          <th><?=$tkeluar?></th>
                          <th><?=$takhir?></th>
                          <th align="right"><?=number_format($nnhpp,2)?></th>
                          <th align="right"><?=number_format($nnakhir,2)?></th>
                          
                          <th>&nbsp;</th>
                      </tr>
                    	</table>
                    
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
          <?php }else{?>
           <div class="panel panel-flat">
			 <div class="panel-heading">
						<h5 class="panel-title">
                        Mutasi Barang
                        <?php 
						$bar=$db->select("m_barang","nama_barang","id_barang='$_GET[id]'");
						foreach($bar as $barv){}
						
						$gud=$db->select("m_gudang","nama_gudang","id_gudang='$_GET[gud]'");
						foreach($gud as $gudv){}
						echo "( ".$barv['nama_barang']." -  ".$gudv['nama_gudang']." ) ";
						?>
                        </h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-warning" value="Back" onClick="window.location='index.php?x=lappersediaan&gud=<?=$_GET[gud]?>'"></button></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example')"></button></li>
                                <li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel v2"  onclick="javascript:window.open('assets/laporan/persediaan/lap2.php?gud=<?=$_GET['gud']?>&tg=<?=$_GET['tg']?>&tgsd=<?=$_GET['tgsd']?>&id=<?=$_GET['id']?>&aksi=xls','blank')"></button>
							</ul>
                            
                        </div>
					</div>
                    
					<table id="example" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="7">
                              <div class="col-lg-8">
                                <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Tanggal </label>
                              <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tg" id="tg" value="<?php echo $_GET[tg]?>">
                                  </div>
                               </div>
                               
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgsd" id="tgsd" value="<?php echo $_GET[tgsd]?>">
                                  </div>
                                  
                               </div>
                               <div class="col-lg-2">
                               		<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="go" onClick="pindah('<?=$_GET[gud]?>','<?=$_GET[id]?>',tg.value,tgsd.value)">
                               </div>
                               
                    </div>
                              </div>
                             </th>
                            </tr>
                           
                            <tr>
                                <th width="20%">Jenis Mutasi </th>
                              	<th width="20%">No Ref </th>
                              	<th width="20%">Tanggal Mutasi</th>
                                <th width="10%">Awal</th>
                                <th width="10%">Masuk</th>  
                                <th width="10%">Keluar</th>
                                <th width="10%">Akhir</th>
                                <th width="10%">Hpp</th>
                                                              
                                
                            </tr>
                        </thead>
                        <?php
	$tg=date("Y-m-d H:i:s",strtotime($_GET['tg']." 00:00:00"));
	$tgsd=date("Y-m-d H:i:s",strtotime($_GET['tgsd']." 23:59:00"));
	$table = "tx_mutasi a";
	$isi = "a.*,
	case 
		when (a.jenis_mutasi=0 and substr(no_ref,1,2)='IK') then (select concat(c.id_gudang,' : ',c.nama_gudang,' : ',b.no_masuk) from tx_brg_masuk b join m_gudang c on b.id_gudang=c.id_gudang where b.no_ref=a.no_ref)
		when (a.jenis_mutasi=0 and substr(no_ref,1,2)<>'IK') then (select concat(c.kode_supp,' : ',c.nama_usaha,' : ',b.no_masuk) from tx_brg_masuk b join m_supplier c on b.id_supp=c.id_supp where b.no_ref=a.no_ref)
		when a.jenis_mutasi=1 then (select concat(c.id_gudang,' : ',c.nama_gudang,' : ',b.no_keluar) from tx_brg_keluar b join m_gudang c on b.id_gudang=c.id_gudang where b.no_ref=a.no_ref)
		when a.jenis_mutasi=10 then (select concat(c.nama_usaha,' : ',date(b.tgl_retur),' : ',b.no_ref) from tx_retur_pem b join m_supplier c on b.kpd_id_supp=c.id_supp where b.no_retur=a.no_ref)
		when a.jenis_mutasi=11 then (select concat(c.kode_cus,' : ',c.nama_usaha,' : ',b.no_ref) from tx_do b join m_customer c on b.id_cus=c.id_cus where b.no_spj=a.no_ref)
		when a.jenis_mutasi=12 then (select concat(c.kode_cus,' : ',c.nama_usaha,' : ',b.no_ref) from tx_retur_pen b join m_customer c on b.id_cus=c.id_cus where b.no_retur=a.no_ref)
		when (a.jenis_mutasi=13 or a.jenis_mutasi=14) then (select concat(b.no_dokumen,' : ',b.no_dokumen,' : ',b.no_dokumen) from tx_stok_opname b where b.id_stok_opname=a.no_ref)
	end as referensi
	
	";
	$where2="a.id_gudang='$_GET[gud]' and a.id_barang='$_GET[id]' and a.tgl_mutasi between '$tg' and '$tgsd' order by a.tgl_mutasi asc";
	$haha=$db->select($table,$isi,$where2);
	foreach($haha as $arhaha){
						  ?>
                         <tr>
                           <th><?php
                                if($arhaha['jenis_mutasi']==0){
									$mutasi="Barang Masuk";
								}elseif($arhaha['jenis_mutasi']==1){
									$mutasi="Barang Keluar";
								}elseif($arhaha['jenis_mutasi']==10){
									$mutasi="Retur Pembelian";
								}elseif($arhaha['jenis_mutasi']==11){
									$mutasi="Delivery Order";			
								}elseif($arhaha['jenis_mutasi']==12){
									$mutasi="Retur Jual";			
								}elseif($arhaha['jenis_mutasi']==13 || $arhaha['jenis_mutasi']==14){
									$mutasi="Stok Opname";			
								}
								echo $mutasi;
							  ?></th>
                           <th><?=$arhaha['no_ref']?></th>
                           <th><?=$arhaha['tgl_mutasi']?></th>
                              <th><?=$arhaha['awal']?></th>
                              <th><?=$arhaha['masuk']?></th>
                              <th><?=$arhaha['keluar']?></th>
                              <th><?=$arhaha['akhir']?></th>
                              <th><?=$arhaha['hpp']?></th>
                      </tr>
                            <?php }?>
                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
          
          <?php }?>
			
		</div>
<script>
  var tableToExcel = (function() {
		
  var uri = 'data:application/vnd.ms-excel;base64,';
  var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
    var bases = function(s) { return window.btoa(unescape(encodeURIComponent(s))) };
    var format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) };
  	return function(table, name) {
    	if (!table.nodeType) table = document.getElementById(table)
    	var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    	window.location.href = uri + bases(format(template, ctx))
 	}
	
  })()

</script>    
