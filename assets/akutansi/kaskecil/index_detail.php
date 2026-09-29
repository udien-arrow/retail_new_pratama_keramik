<div class="col-lg-5">
	<div class="panel panel-flat">
		<div class="panel-heading">
        	<div class="col-lg-10">
			<h5 class="panel-title">Detail Pengunaan Kas Kecil</h5>
             </div>
        	<div class="col-lg-2">
              <button class="btn btn-success" type="button" onClick="window.location='index.php?x=kaskecil'">
             Back
            </button> 
            </div>    
		</div>
        <div class="dataTables_wrapper"></div>
        <div class="table-responsive pre-scrollable">
			<div class="panel-body">

				<?php
				//echo "ID = $_POST[id]";
				$dat = $db->select("kas_kecil_dtl","*","ID = '$_POST[id]'");			
				foreach ($dat as $data);
				?>
				<form class="form-horizontal" action="index.php?x=kaskecil_d_s&id=<?=$_GET['id']?>" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
					<fieldset class="content-group">
                        <div class="form-group"> </div>
                        
                         <div class="form-group">
							<label class="control-label col-lg-4">Penggunaan Untuk </label>
							<div class="col-lg-5">
								<input type="text" name="penggunaan" id="penggunaan" class="form-control" autocomplete="off" value="<?php if($_POST['id'] != ''){echo $data['PENGUNAAN'];}?>" required>
							</div>
						</div>    
                        
                        <div class="form-group">
							<label class="control-label col-lg-4">Nominal Biaya</label>
							<div class="col-lg-5">
								<input type="text" name="jml" id="jml" class="form-control" autocomplete="off" value="<?=number_format($data['NOMINAL'],0)?>" required>
							</div>
						</div>
    
                                      
                       <div class="form-group">
									<label class="control-label col-lg-4">Account Biaya</label>
						<div class="col-lg-8">
                                    <select name="account" class="select-search">
                                    <?php
										foreach($db->select("ak_acc","*","account like '51%' and post_flag = '1'") as $k){
											echo "<option value=\"$k[account]\">$k[description] - $k[account]</option>";	
										}
									?>
                                    </select>
                      	</div>
                      </div>                       
                         <div class="form-group">
							<label class="control-label col-lg-4">Tanggal Nota</label>
							<div class="col-lg-5">
								<input type="text" name="tgl" id="tgl"  class="form-control datepicker" autocomplete="off" value="<?php if($_POST['id']!=''){echo "$data[TANGGAL]";}else{echo date("d-m-Y");}?>" required>
							</div>
						</div>                       
         
                                                                                      
                        <div class="form-group">
							<label class="control-label col-lg-4"></label>
							<div class="col-lg-5">
								<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
								 Simpan 
                                </button>
                                <button class="btn btn-success" type="button" onClick="window.location='index.php?x=kaskecil_d'">
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
	<form action="index.php?x=kaskecil_d_a" id="form_index" method="post">
              <?php
			  $dat = $db->select("kas_kecil_dtl a inner join kas_kecil b on a.ID = b.ID inner join ak_acc c on a.ACCOUNT = c.account","a.*,b.STATUS,b.NO,b.NOMINAL as NOMINAL2,c.description,b.PENGUNAAN","a.ID = '$_GET[id]'");
				//echo "select a.*,b.STATUS,b.NO,b.NOMINAL as NOMINAL2,c.description,b.PENGUNAAN from kas_kecil_dtl a inner join kas_kecil b on a.ID = b.ID inner join ak_acc c on a.ACCOUNT = c.account where  a.ID = '$_GET[id]'";	  
			  ?>  
	  	<div class="panel panel-flat">
        <div class="panel-heading">
				<h5 class="panel-title">Detail Kas Kecil Nomor <?=$dat[0]['NO']?></h5>
			</div>
    
			 <table  class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                <thead>
                    <tr>
                        <th width="5%">No </th>
                      	<th width="30%">Ket</th>
                        <th width="30%">Account </th>
                      	<th width="15%">Nominal</th>
                        <th width="10%">Tanggal </th>
                        <th width="10%">Aksi </th>                        
                    </tr>
                </thead>
                <?php 
				$no = 0;$tot=0;
				foreach ($dat as $data){ 
				$no = $no + 1;
				$tot = $tot + $data['NOMINAL'];
				?>
                    <tr>
                        <td><?=$no?> </td>
                      	<td><?=$data['KET']?></td>
                        <td><?=$data['ACCOUNT']?>-<?=$data['description']?></td>
                      	<td align="right"><?=number_format($data['NOMINAL'],0)?></td>
                        <td><?=$data['TANGGAL']?></td>
                        <td><?php if($data[STATUS] == '1'){ echo "<a href='javascript:void(0)' onclick='hapus($data[IDX],$_GET[id])' style='cursor:pointer' class='icon-trash'></a>";} ?>
 						</td>                       
                    </tr>                
                   <?php } ?>
                <tfoot>
                    <tr>
                        <td colspan = "3">Total Biaya</td>
                      	<td align="right"><?=number_format($tot,0)?></td>
                        <td ></td>
                        <td ></td>                        
                    </tr>
                    <tr>
                        <td colspan = "3">Jml Kas Kecil </td>
                      	<td align="right"><?=number_format($data['NOMINAL2'],0)?>
                        </td>
                        <td ></td>
                        <td ></td>                        
                    </tr> 
                    <tr>
                        <td colspan = "3">Sisa </td>
                      	<td align="right"><?=number_format($data['NOMINAL2']-$tot,0)?></td>
                        <td ></td>
                        <td ></td>                        
                    </tr>                                        
                </tfoot>     
               </table>
             <input type="hidden" name="no" id="no"  value="<?=$dat[0]['NO']?>">              
             <input type="hidden" name="idku" id="idku"  value="<?=$_GET[id]?>">              
             <input type="hidden" name="pengunaan" id="pengunaan"  value="<?=$dat[0]['PENGUNAAN']?>">              

             <input type="hidden" name="total" id="total"  value="<?=$tot?>">
             <input type="hidden" name="sisa" id="sisa"  value="<?=$data['NOMINAL2']-$tot?>" >
             <input type="hidden" name="kaskecil" id="kaskecil"  value="<?=$data['NOMINAL2']?>" >
              
   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
    		<input type="hidden" name="idx" id="idx"  value=""  required>
    		<input type="hidden" name="id" id="id"  value=""  required>
						
                        <div class="form-group">     
                        		<?php
						     	$dat = $db->select("kas_kecil","*","ID = '$_GET[id]'");
								if ($dat[0]['STATUS'] == '1'){
								 echo "<p>&nbsp;&nbsp;&nbsp <button class='btn btn-primary' type='submit' onClick='return confirm('Apakah Anda yakin menyimpan data??')> Tutup Kas </button>";
                                 echo "&nbsp;&nbsp;&nbsp <button class='btn btn-success' type='button' onClick='window.location='index.php?x=kaskecil_d'> Batal </button>";
								 } ?>

						</div>              
   		 </div>
         
	</form>
</div>

<?php
	if($_GET[aksi]=='hapus'){
    $where = array("IDX" => $_GET['idx']);
    $db->delete("kas_kecil_dtl", $where);    
	echo "<script>window.location='index.php?x=kaskecil_d&id=$_GET[id]'</script>";

}	
?>