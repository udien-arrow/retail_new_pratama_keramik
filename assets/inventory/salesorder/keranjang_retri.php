<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;

?>
<?php  
									 $kon=$db->select("m_retribusi","*");
								
                                      $no=1;
									  $skr=date("Y-m-d");
                                      foreach($kon as $d){  
									  foreach($db->select("m_biaya_retribusi a left join m_biaya_retribusi_dtl b on a.id_biaya=b.id_biaya","b.nilai","b.tgl_berlaku<='$skr' and b.id_retribusi='$d[id_retribusi]' and a.id_cus='$_GET[id]' and a.id_jenis='$_GET[kend]' order by b.tgl_berlaku desc limit 0,1") as $kol);
		
									   
											$kolni=$kol[nilai];	  
										
									  ?>
                                      <tr>
                                      <td width="60%" align="left">&nbsp;<?=$d['nama_retribusi']?></td>
                                        <td width="10%" align="right">&nbsp;<?=number_format($kolni)?>&nbsp;</td>
                                      </tr>
                                      <?php
									  $no++;
									  $tot=$tot+$kolni;
									   } 
									   ?>
                                        <tr>
                                        <td align="right">Total</td>
                                        <td align="right"><b><?=number_format($tot)?></b>&nbsp;</td>
                                      </tr>
