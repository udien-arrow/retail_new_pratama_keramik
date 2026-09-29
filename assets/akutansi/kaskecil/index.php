<div class="col-lg-5">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Tambah <?=$title?></h5>
		</div>
        <div class="dataTables_wrapper"></div>
        <div class="table-responsive pre-scrollable">
			<div class="panel-body">

				<?php
				//echo "ID = $_POST[id]";
				$dat = $db->select("kas_kecil","*","ID = '$_POST[id]'");			
				foreach ($dat as $data);
				?>
				<form class="form-horizontal" action="index.php?x=kaskecil_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
					<fieldset class="content-group">
                        <div class="form-group"> </div>
                        <div class="form-group">
							<label class="control-label col-lg-4">Jumlah Kas Kecil</label>
							<div class="col-lg-5">
								<input type="text" name="jml" id="jml" class="form-control" autocomplete="off" value="<?=number_format($data['NOMINAL'],0)?>" required>
							</div>
						</div>
                         <div class="form-group">
							<label class="control-label col-lg-4">Penggunaan Untuk </label>
							<div class="col-lg-5">
								<input type="text" name="penggunaan" id="penggunaan" class="form-control" autocomplete="off" value="<?php if($_POST['id'] != ''){echo $data['PENGUNAAN'];}?>" required>
							</div>
						</div>        
                                      
                       <div class="form-group">
									<label class="control-label col-lg-4">Kas Keluar</label>
						<div class="col-lg-5">
                                    <select name="account" class="select-search">
                                    <?php
										foreach($db->select("ak_kasbank","*") as $k){
											echo "<option value=\"$k[account]\">$k[description] - $k[account]</option>";	
										}
									?>
                                    </select>
                      	</div>
                      </div>                       
                         <div class="form-group">
							<label class="control-label col-lg-4">Tanggal Dibuat</label>
							<div class="col-lg-5">
								<input type="text" name="tgl" id="tgl" readonly class="form-control datepicker" autocomplete="off" value="<?php if($_POST['id']!=''){echo "$data[TANGGAL]";}else{echo date("d-m-Y");}?>" required>
							</div>
						</div>                       
         
                                                                                      
                        <div class="form-group">
							<label class="control-label col-lg-4"></label>
							<div class="col-lg-5">
								<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
								 Simpan 
                                </button>
                                <button class="btn btn-success" type="button" onClick="window.location='index.php?x=kaskecil'">
								 Batal 
                                </button>
							</div>
						</div>  
					</fieldset>   
				</form>
			</div>	
		</div>		
    </div>			
</div>
<div class="col-lg-7">
	<form action="index.php?x=kaskecil" id="form_index" method="post">
	  	<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Master</h5>
			</div>
     
			 <table  id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                <thead>
                    <tr>
                        <th>Id </th>
                      	<th>No</th>
                        <th>Tanggal </th>
                      	<th>Tgl Setor</th>
                        <th>Nominal </th>
                      	<th>Terpakai</th>       
                      	<th>Sisa</th>         
                    	<th>Stat</th>         
                      	<th>Aksi</th>                                                                
                    </tr>
                </thead>
				<tbody>
					 <?php
                     $dat2 = $db->select("kas_kecil a left join kas_kecil_dtl b on a.ID = b.ID ","a.*,sum(b.NOMINAL) as SETOR2,ifnull(a.NOMINAL - sum(b.NOMINAL),a.NOMINAL) as SISA2","a.NO like '%' group by a.NO");
                     //echo "select a.*,sum(b.NOMINAL) as SETOR2,a.NOMINAL - sum(b.NOMINAL) as SISA2 from kas_kecil a inner join kas_kecil_dtl b on a.ID = b.ID";
					 $tot = 0;
					 $pakai = 0;
					 $no = 0;
					 foreach ($dat2 as $data2){
                     $tot = $tot + $data2['NOMINAL'];
					 $pakai = $pakai + $data2['SETOR2'];
				 	 $no = $no + 1;
                     ?>                  
                    <tr>
                        <td align="right"><?=$no?> </td>
                      	<td><?=$data2['NO']?></td>
                        <td><?=date("d-m-Y",strtotime($data2['TANGGAL']))?></td>
                      	<td>
						<?php
                        if ($data2['TANGGAL_SETOR'] != ''){
						echo date("d-m-Y",strtotime($data2['TANGGAL_SETOR']));
						}else{
						echo "-";
						}
						?>
                        </td>
                        <td align="right"><?=number_format($data2['NOMINAL'],0)?></td>
                      	<td align="right"><?=number_format($data2['SETOR2'],0)?></td>       
                      	<td align="right"><?=number_format($data2['SISA2'],0)?></td>         
                    	<td><?php 
						if ($data2['STATUS']=='1'){
							echo "<button class='btn bg-green' style='width:50px;align=center' type='button'  onclick='edit(".$data2['ID'].")'>Open</button>";
							}else{
							echo "<button class='btn bg-pink' style='width:50px;align=center' type='button' onclick='clos(".$data2['ID'].")'>Close</button>";
							}
						?>
                        </td>         
                      	<td>
                        <ul class='icons-list'>
                        <li class='text-primary-200'><a href='javascript:void(0)' onclick='edit(<?=$data2['ID']?>)' class='icon-pencil7' style='cursor:pointer'></a></li>
                        <li class='text-primary-200'><a href='javascript:void(0)' onclick='cetak(<?=$data2['ID']?>)' class='icon-printer2' style='cursor:pointer'></a></li>
                        </ul>
                        </td>                                                                
                    </tr>   
                    
                    <?php
					 }
					 ?>
                </tbody>
                <thead>
                    <tr>
                        <td colspan="4" align="center">Total </td>
                        <td align="right"><?=number_format($tot,0) ?></td>
                      	<td align="right"><?=number_format($pakai,0) ?></td>       
                      	<td align="right"><?=number_format($tot-$pakai,0) ?></td>         
                    	<td></td>         
                      	<td></td>                                                                
                    </tr>
                </thead>                
            </table>
   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
    		<input type="hidden" name="id" id="id"  value=""  required>
   		 </div>
	</form>
</div>

<?php
	
	if($_POST[aksi]=='hapus'){
    $where = array("ID_simpanan" => $_POST['id']);
    $db->delete("jenis_simpanan", $where);
    
    echo "<script>window.location='index.php?x=jsimpanan'</script>";
}	
?>