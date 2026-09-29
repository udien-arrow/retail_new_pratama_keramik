<div class="col-lg-2"></div>
<div class="col-lg-9">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?> Tahun <?=date("Y")?></h5>
					</div>
					<div class="dataTables_wrapper"></div><br>
                    <?php include("bulantahun.php");?>
                    <select name="cabang" id="cabang" class="select-search green-gradient" style=" width:200px;">
                    <option value="">Pilih Cabang</option>
                    <?php
					$ks=$db->select("m_cabang","*");
					foreach($ks as $sk){
					?>
                    <option value="<?=$sk['id_cabang']?>" <?php if($_GET['cabang']==$sk['id_cabang']){ echo "selected";} ?>><?=$sk['nama_cabang']?></option>		
                    <?php } ?>
                    </select>
                    <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData(tahun.value,bulan.value,cabang.value)">
					<div class="panel-body">
                     <form class="form-horizontal" action="index.php?x=budget" name="formku" id="formku" method="post">
                     <?php
					if($_POST[id]!=''){
                    $sat=$db->select("ak_jurnal_dtl_tmp","*","IDX='$_POST[id]'");
					foreach($sat as $val){}
					}
					if($_GET['tahun']!='' and $_GET['bulan']!='' and $_GET['cabang']!=''){
					?>
					  
							<table width="100%" border="0" class="table table-columned">
                              <thead>
                              <tr>
                                <th width="6%" align="center">No</th>
                                <th width="25%" align="center">Kode Rekening</th>
                                <th width="40%" align="center">Deskripsi</th>
                                <th width="25%" align="center">Jumlah</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
							  $k=$db->select("ak_acc a LEFT JOIN ak_budget b ON a.account=b.acc_code AND b.tahun='".date("Y")."'","account, description, ifnull(id_budget,0) as id_budget,tahun,jumlah","post_flag='1'");
							  $no=1;
							  $jm="";
							  foreach($k as $v){
							$ks['jumlah']='';
							  $ss=$db->select("ak_budget_dtl","*","id_cabang='$_GET[cabang]' and bulan='$_GET[bulan]' and tahun='$_GET[tahun]' and acc_code='$v[account]'");
							  foreach($ss as $ks){}
							  $jm=$ks['jumlah'];
							  ?>
                              <tr>
                                <td><?=$no?>&nbsp;</td>
                                <td><?=$v[account]?>&nbsp;</td>
                                <td><?=$v[description]?>&nbsp;<a data-toggle="modal" href="javascript:void(0)" data-target="#modal_remote" id="mod" style="visibility:hidden"></a></td>
                                <td align="right">
                                <input type="hidden" name="account[]" value="<?=$v['account']?>" class="form-control" style=" width:200px;">
                                <input type="text" name="jumlahnya[]" value="<?=$jm?>" class="form-control" style=" width:200px;"></td>
                                
                              </tr>
                              <?php
							  	$no++;
							  
							  }
							  ?>
                              </tbody>
                            </table>
                            <input type="hidden" name="jenisnya" id="jenisnya" value="">
                            <input type="hidden" name="bulans" value="<?=$_GET['bulan']?>">
                            <input type="hidden" name="tahuns" value="<?=$_GET['tahun']?>">
                            <input type="hidden" name="cabangs" value="<?=$_GET['cabang']?>">
                            <a href='javascript:void(0)' onClick="appsetuju()">
                        <input style="float:right;width:70px;" value="Simpan" class="btn btn-primary" readonly></a>
				  </div>	

  </div>
</div>
</div>
</form>
<?php
}else{}
if($_POST['jenisnya']=='setuju'){
	foreach($_POST['account'] as $key => $val){
		if($val!=""){
				$ck=$db->select("ak_budget_dtl","count(acc_code) as ko,acc_code","id_cabang='$_POST[cabangs]' and bulan='$_GET[bulans]' and tahun='$_POST[tahuns]' and acc_code='$val'");
				foreach($ck as $cek){
				if(count($cek['acc_code'])=='1')
				{
		$data = array( 
						'jumlah' => $_POST['jumlahnya'][$key],
						);
		$db->update("ak_budget_dtl",$data,"cabang='$_POST[cabangs]' and bulan='$_GET[bulans]' and tahun='$_POST[tahuns]' and acc_code='$val'");
		}else{
			if($_POST['jumlahnya'][$key]!=''){
		$ks=$db->idurut("ak_budget_dtl","id_bdtl");
		$data = array( 
						'id_bdtl' => $ks,
						'acc_code' => $val,
						'id_cabang' => $_POST['cabangs'],
						'jumlah' => $_POST['jumlahnya'][$key],
						'bulan' => $_POST['bulans'],
						'tahun' => $_POST['tahuns'],
						);
		$db->insert("ak_budget_dtl",$data);
					}
				}
			}
		}
	}
echo "<script>window.location='index.php?x=budget&tahun=$_POST[tahuns]&bulan=$_POST[bulans]&cabang=$_POST[cabangs]'</script>";
}
?>