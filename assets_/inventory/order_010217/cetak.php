 <style type="text/css" media="all">
 
 			@media print
			{
			.noprint {display:none;}
			}
          @media print{ @page {
              size: landscape;
              margin-top: 0cm;
              margin-bottom: 1cm;
              margin-left: 0cm;
              margin-right: 0cm;
           }}
		   table thead {display: table-header-group;}
           .table {
               border: .0em solid #666;border-collapse:collapse; 
               width:850; 
           }
           .table2 {
               border: .0em solid #666;border-collapse:collapse; 
               width:300; 
           }
			.table3 {
               border: .0em solid #666;border-collapse:collapse; 
               width:350; 
           }
			.table4 {
               border: .0em solid #666;border-collapse:collapse; 
              
           }
           .td {
			   
               border: 1px solid #666; font-size:12px; line-height: 20px; 
               vertical-align:middle; padding:1px; font-family:"Arial";
           }
			.td2 {
			   
               border: 0px solid #666; font-size:12px; line-height: 20px; 
               vertical-align:middle; padding:0px; font-family:"Arial";
           }
           h2 { margin-bottom: 0; }
       </style>
 <div class="col-lg-2 noprint">
 </div>      
 <div class="col-lg-8">
        <div class="panel panel-flat">
        	<div class="form-group">
            <div class="print">
            	<table width="700" border="0" cellpadding="0" cellspacing="0" class="table">
                  <tr>
                    <td align="center">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        
                        <tr>
                          <td rowspan="4">&nbsp;</td>
                          <td colspan="3" align="center" class="td2">PERMINTAAN BARANG UNIT (PU)</td>
                        </tr>
                        <tr>
                          <td colspan="3" align="center" class="td2">
                            NO : <?=$_GET[id]?>
                          </td>
                          </tr>
                      </table>
                      <br>
                      <table width="100%" border="0" class="table4">
                        <tr>
                            <td class="td2" width="20%">Gudang Peminta</td>
                            <td class="td2" width="1%">:</td>
                            <td class="td2" width="34%"><?php  
							foreach($dtpu=$db->select("tx_order a 
							left join m_gudang b on a.id_gudang=b.id_gudang
							left join m_daerah c on a.id_daerah=c.id_daerah
							","*","a.no_order='$_GET[id]'") as $dtpuv);
							
							echo $dtpuv['nama_gudang'];?></td>
                            <td class="td2" width="45%" align="right">Tanggal : <?php echo date("d-m-Y",strtotime($dtpuv[tgl]))?></td>
                        </tr>
                        <tr>
                            <td class="td2">Alamat Gudang</td>
                            <td class="td2">:</td>
                            <td class="td2"><?php  echo $dtpuv['alamat'];?></td>
                            <td class="td2"></td>
                        </tr>
                        <tr>
                            <td class="td2">District</td>
                            <td class="td2">:</td>
                            <td class="td2"><?php  echo $dtpuv['nama_daerah'];?></td>
                            <td class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="td2">Shipto Code</td>
                            <td class="td2">:</td>
                            <td class="td2"><?php  echo $dtpuv['shipto_code'];?></td>
                            <td class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="td2">Jenis Kirim</td>
                            <td class="td2">:</td>
                            <td class="td2"><?php  echo $dtpuv['jenis_kirim'];?></td>
                            <td class="td2">&nbsp;</td>
                        </tr>
                      </table>
                      <br>
                      <table width="100%" border="1" cellpadding="3" cellspacing="0"  class="table4">
                        <tr>
                          <td width="6%" class="td" align="center">No</td>
                          <td width="38%" class="td" align="center">Nama Barang</td>
                          <td width="10%" class="td" align="center" >Satuan</td>
                        <?php
                        $dtdtl=$db->select("tx_order_dtl","tgl_kirim","no_order='$_GET[id]' group by id_barang,tgl_kirim");    
                        $nom=1;
                        foreach($dtdtl as $vdtl)
                        {
                        ?>
                          <td width="8%" class="td" align="center" ><?php 
						  if($vdtl['tgl_kirim']!=''){
						  echo date("d-m-Y",strtotime($vdtl['tgl_kirim']));
						  }else{
							echo "qty";  
						  }
						  ?></td>
                        <?php }?>  
                        </tr>
                        <?php
                        $dtdtl=$db->select("tx_order_dtl a 
						join m_barang b on a.id_barang=b.id_barang
						join m_satuan c on b.id_satuan=c.id_satuan
						","a.*,b.nama_barang,c.nama_satuan","a.no_order='$_GET[id]' group by a.id_barang");    
                        $nom=1;
                        foreach($dtdtl as $vdtl)
                        {
                        ?>
                        
                        <tr>
                          <td class="td" align="center"><?php 
                                      echo"$nom";?></td>
                          <td  class="td"><?php 
                                      echo"$vdtl[nama_barang]";?></td>
                          <td align="center" class="td"><?php 
                                    echo"$vdtl[nama_satuan]";?></td>
                        <?php
                        $dtdtl=$db->select("tx_order_dtl","qty","no_order='$_GET[id]' group by id_barang,tgl_kirim");    
                        $nom=1;
                        foreach($dtdtl as $vdtl)
                        {
                        ?>
                          <td align="right" class="td"><?php echo number_format($vdtl['qty'])?></td>
                        <?php }?>  
                        </tr>
                        <?php
                        $nom++;
                            
                        }
                    ?>
                    <!-- <tr>
                          <td width="5%" class="td" align="center"><strong></strong></td>
                          <td width="25%" class="td" align="right">TOTAL</td>
                          <td width="10%" class="td" align="center" ><strong></strong></td>
                          <td width="10%" class="td" align="center" ><strong></strong></td>
                          <td width="10%" class="td" align="center" ><strong></strong></td>
                          <td width="10%" class="td" align="center" ><strong></strong></td>
                          <td width="15%" class="td" align="center" ><strong></strong></td>
                          <td width="15%" class="td" align="right" ><?php echo number_format($totalnya);?></td>
                        </tr> -->
                      </table>
                
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="td2">Keterangan:</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="td2"><p> <i>- 
                          <?php echo $dtpuv['ket'];?>
                          </i></p></td>
                        </tr>
                        
                        <tr>
                          <td width="6%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                          <td width="79%">&nbsp;</td>
                        </tr>
                      </table>
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="20%">
                                <table width="100%" border="1" cellpadding="3" cellspacing="0"  class="table2">
                                    <tr>
                                        <td class="td" align="center" colspan="2">Peminta</td>
                                    </tr>
                                    <tr>
                                        <td width="119" align="center" class="td" >Admin</td>
                                        <td width="163" align="center" class="td" >Kepala Cabang</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><br><br><br>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="50%" align="right">&nbsp;</td>
                        </tr>
                      </table>
                      </td>
                  </tr>
                </table>
                </div>
            </div>
        </div>
 </div>  
 <div class="col-lg-2 noprint">
 </div>   
 <script>
 window.print();
 window.close();
 
 </script>
       