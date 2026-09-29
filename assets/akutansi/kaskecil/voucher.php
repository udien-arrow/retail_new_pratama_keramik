<?php

session_start();

require( 'webclass.php' );

error_reporting(0);

$db=new kelas;

?>

<style>

table {

		  border-collapse: collapse;

	  }

.table, .td, .th {

				  border: 1px solid #DDD ;

				  padding:1px;

			  }

.th2{	

		border-top: 1px solid #ddd;	

	}

.td2 {

			   

               border: 0px solid #666; font-size:10px; 

               vertical-align:middle; padding:0px;line-height:15px;

           }

</style>
 
              <?php
			  $dat = $db->select("kas_kecil_dtl a inner join kas_kecil b on a.ID = b.ID inner join ak_acc c on a.ACCOUNT = c.account","a.*,b.STATUS,b.NO,b.NOMINAL as NOMINAL2,c.description,b.PENGUNAAN","a.ID = '$_GET[id]'");
				//echo "select a.*,b.STATUS,b.NO,b.NOMINAL as NOMINAL2,c.description,b.PENGUNAAN from kas_kecil_dtl a inner join kas_kecil b on a.ID = b.ID inner join ak_acc c on a.ACCOUNT = c.account where  a.ID = '$_GET[id]'";	  
			  ?>  
			<h5> Detail Kas Kecil Nomor <?=$dat[0]['NO']?></h5>
			
			 <table  cellpadding="0" cellspacing="0"  border="1">
                <thead>
                    <tr>
                        <th align = "center" width="10%">No </th>
                      	<th align = "center" width="30%">Ket</th>
                        <th align = "center" width="30%">Account </th>
                      	<th align = "center" width="15%">Nominal</th>
                        <th align = "center" width="15%">Tanggal </th>
                    </tr>
                </thead>
                <tbody>
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
                    </tr>                
                   <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td > &nbsp;</td>                        
                        <td > &nbsp;</td>                        
                   
                        <td >Total Biaya</td>
                      	<td align="right"><?=number_format($tot,0)?></td>
                        <td > &nbsp; </td>                      
                    </tr>
                    <tr>
                         <td > &nbsp;</td>                        
                        <td > &nbsp;</td>                     
                        <td >Jml Kas Kecil </td>
                      	<td align="right"><?=number_format($data['NOMINAL2'],0)?></td>
                        <td > &nbsp;</td>                        
                    </tr> 
                    <tr>
                        <td > &nbsp;</td>                        
                        <td > &nbsp;</td>                      
                        <td >Sisa </td>
                      	<td align="right"><?=number_format($data['NOMINAL2']-$tot,0)?></td>
                        <td > &nbsp;</td>                        
                    </tr>                                        
                </tfoot>     
               </table>