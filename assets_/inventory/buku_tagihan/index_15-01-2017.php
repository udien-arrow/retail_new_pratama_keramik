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
<?php
if($_POST[simpan]){
	include("assets/inventory/buku_tagihan/simpan2.php");	
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_buku_tagihan_tmp",$where);
	echo "<script>window.location='index.php?x=bukta&cus=$_POST[cos]&jenis=$_POST[jenisnya]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_buku_tagihan_tmp",$where);
	echo "<script>window.location='index.php?x=bukta'</script>";

}else{
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=bukta_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View <?=$title?>" onClick="window.location='index.php?x=bukta_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
                     <table  class="table datatable-basic" >
                        <thead>
                      
                      
                        <tr>
                        		<th colspan="8">
                                 <div class="form-group" >
                                 <label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Pelanggan </label>
                                 <div class="col-lg-4">
                              	 
                                  	<select name="cus" id="cus" class="select-minimum" onChange="pindahdatapel()">
                                   	    <?php if($_GET[cus]!=''){
										$expl=explode("_",$_GET[cus]);
										?>
                                    <option value="<?=$_GET[cus]?>" selected><?=$expl[2]?></option>
                                    <?php }?>
                               	   </select>
                                   <input type="hidden" value="<?=$_GET['cus']?>" name="cusa" id="cusa">
                                   </div>
                                    
                                 <div class="col-lg-3">
                                  	<select name="jenis" id="jenis" class="select-search" onChange="pindahjen()">
                                    <option value="">--- Jenis ---</option>
                                    <option value="A" <?php if($_GET['jenis']=='A'){echo "selected"; } ?>>All</option>
                                    <option value="1" <?php if($_GET['jenis']=='1'){echo "selected"; } ?>>Semen</option>
                                    <option value="2" <?php if($_GET['jenis']=='2'){echo "selected"; } ?>>Non Semen</option>
                               	   </select>
                                    </div>
                                    </div>
					
                                </th>
                        </tr>
                            <tr>
                              	<th width="20%">Pelanggan</th>
                                <th width="20%">NO FJ</th>
                                <th width="20%">NO SPJ</th>
                                <th width="10%">Tgl Faktur</th>
                                <th width="10%">Tempo</th>
                                <th width="5%">Umur(H)</th>
                              	<th width="5%">Total Piutang</th>
                                <th width="4%" align="center"> <a href='javascript:void(0)'  onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead
><?php 

if($_GET['cus']!=''){
	
if($_GET['jenis']=="A"){
$jen="";	
}else{
$jen="a.jenis_jual='$_GET[jenis]' and";	
}
$tablee="tx_piutang a
LEFT JOIN m_customer b ON a.id_cus = b.id_cus";
$isi="a.*, b.nama_usaha,
	concat(
		ifnull(a.id_piutang,0),
		'_',
		a.total_piutang-ifnull((select sum(g.total_dibayar) from tx_pembayaran_sales g
		where a.no_faktur_jual=g.no_faktur and a.jenis_piutang=g.jenis_piutang GROUP BY g.no_faktur),0)-ifnull((select sum(cc.dibayar) from tx_tagihan_kembali_dtl cc where a.no_faktur_jual=cc.no_fj and cc.jenis_pem='3' and cc.status='0' GROUP BY cc.no_fj),0),
		'_',
		ifnull(a.id_cus,0),
		'_',
		ifnull(a.tempo_normal,0),
		'_',
		ifnull(a.tempo_tambahan,0)
	) AS gab";
	$expl=explode("_",$_GET['cus']);
/*$where="a.no_faktur_jual=g.no_faktur and a.jenis_piutang=g.jenis_piutang GROUP BY g.no_faktur),0)-ifnull((select sum(cc.dibayar) from tx_tagihan_kembali_dtl cc where a.no_faktur_jual=cc.no_fj 
and cc.jenis_pem='3' and cc.status='0' GROUP BY cc.no_fj),0)>0 and a.status=1 and a.status_bayar=0 AND
a.id_cabang='$_SESSION[ID_CABANG]' and a.status='1' and a.no_faktur_jual NOT IN 
(SELECT no_fj FROM tx_buku_tagihan_tmp WHERE id_user = '$_SESSION[ID_LOGIN]') 
and status_bayar='0' and (no_faktur_jual NOT IN (select no_fj from tx_tagihan_kembali_dtl 
where status='0' and jenis_pem<>'3' and ifnull(jenis_bg,0)<>'0')  and ifnull(no_faktur_jual,'') 
not in(select ifnull(no_fj,'') from tx_buku_tagihan_dtl where ifnull(no_fj,'') 
not in (select ifnull(no_fj,'') from tx_tagihan_kembali_dtl where status=1 and jenis_pem<>'3' 
and ifnull(jenis_bg,0)<>'0'))) and a.id_cus='$expl[0]'
";*/
$where="$jen a.total_piutang-ifnull((select sum(g.total_dibayar) from tx_pembayaran_sales g where a.no_faktur_jual=g.no_faktur and a.jenis_piutang=g.jenis_piutang GROUP BY g.no_faktur),0)-ifnull((select sum(cc.dibayar) from tx_tagihan_kembali_dtl cc where a.no_faktur_jual=cc.no_fj 
and cc.jenis_pem='3' and cc.status='0' GROUP BY cc.no_fj),0)>0 and a.status=1 and a.status_bayar=0 AND
a.id_cabang='$_SESSION[ID_CABANG]' and a.status='1' and a.no_faktur_jual NOT IN 
(SELECT no_fj FROM tx_buku_tagihan_tmp WHERE id_user = '$_SESSION[ID_LOGIN]') 
and status_bayar='0' and (no_faktur_jual NOT IN (select no_fj from tx_tagihan_kembali_dtl 
where status='0' and jenis_pem<>'3' and ifnull(jenis_bg,0)<>'0')  ) and a.id_cus='$expl[0]'
";	
//echo "select ".$isi." "."from ".$tablee." ".$where;
	
$ak=$db->select($tablee,$isi,$where);
}
foreach($ak as $dat){
/**$jh=$db->select("tx_buku_tagihan a
LEFT JOIN tx_buku_tagihan_dtl b on a.no=b.no
LEFT JOIN tx_tagihan_kembali c ON a.no = c.no_ref
LEFT JOIN tx_tagihan_kembali_dtl d ON c.no_ta = d.no_ta","a.*,b.status as sta,d.jenis_pem","d.no_fj='$dat[no_faktur_jual]' and (a.status='1' or a.status='0') or d.status='1'");
echo $jahat['no_fj'];
foreach($jh as $jahat){}
if($jahat['no_fj']!=$dat['no_faktur_jual']){
	**/
?>

                             <tr>
                              <th><?=$dat['nama_usaha']?></th>
                              <th><?=$dat['no_faktur_jual']?></th>
                              <th><?=$dat['no_ref']?></th>
                              <th><?=date("d-m-Y",strtotime($dat['tgl']))?></th>
                              <th><?=date("d-m-Y",strtotime($dat['tempo_normal']))?></th>
                              <th><?php
                                $selisih = ((abs(strtotime (date("Y-m-d")) - strtotime ($dat['tgl'])))/(60*60*24));
			 echo $selisih;
							  ?></th>
                              <th><?php
                $g=explode("_",$dat['gab']);
				$ad=number_format($g[1],2);
				echo "<input type='text' name='totalpiutang[]' style='height:27px; width:90px;' id='totalpiutang$g[0]' class='form-control' autocomplete='off' value='$ad' required readonly>
				<input type='hidden' name='idcus[]' style='height:27px; width:90px;' id='idcus$g[0]' class='form-control' autocomplete='off' value='$g[2]' required readonly>
				<input type='hidden' name='idp[]' style='height:27px; width:90px;' id='idp$g[0]' class='form-control' autocomplete='off' value='$g[0]' required readonly>
				<input type='hidden' name='tempo_normal[]' style='height:27px; width:90px;' id='tempo_normal$g[0]' class='form-control' autocomplete='off' value='$g[3]' required readonly>
				<input type='hidden' name='tempo_tambahan[]' style='height:27px; width:90px;' id='tempo_tambahan$g[0]' class='form-control' autocomplete='off' value='$g[4]' required readonly>"
							  ?></th>
                              <th align="center"><li class='text-primary-200'><input type='checkbox' name='idpi[]' id='idpi$d' value='<?=$dat['id_piutang']?>'></li></th>
                            </tr>
                            <?php } }?>
                           
                        

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="totalpiutang2" id="totalpiutang2"  value=""  placeholder='piutang' required>
                    <input type="hidden" name="idcus2" id="idcus2"  value=""  placeholder='cus2' required>
                    <input type="hidden" name="tempo_normal2" id="tempo_normal2"  value=""  placeholder='tempo nor' required>
                    <input type="hidden" name="tempo_tambahan2" id="tempo_tambahan2"  value=""  placeholder='tempo tam' required>
   		  </div>
			</form>
		</div>
         			
	 <div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang <?=$title?>
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=bukta" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>

<div id="databg" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Buku BG</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>
<?php // }?>
