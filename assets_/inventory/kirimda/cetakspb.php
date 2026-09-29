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
		   .td3 {
			   
               border-bottom: 1px solid #666; font-size:12px; line-height: 20px; 
               vertical-align:middle; padding:0px; font-family:"Arial";
           }
           h2 { margin-bottom: 0; }
       </style>
 <div class="col-lg-2 noprint">
 </div>      
 <div class="col-lg-8">
 <?php 
							  $se=$db->select("v_sales_order","*","no_sales='$_GET[id]'");
							  $no=1;
							  foreach($se as $val){}
								?>
        <div class="panel panel-flat">
        	<div class="form-group">
            <div class="print">
            	<table width="700" border="0" cellpadding="0" cellspacing="0" class="table">
                  <tr>
                    <td align="center">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                       <tr>
                       	 <td width="7%"></td>
                          <td colspan="2" class="td2"><b>PT.Taurus Gemilang</b></td>
                          <td width="38%" class="td2"><font size="4px"><b>SURAT PENGAMBILAN BARANG</b></font></td>
                        </tr>
                        <tr>
                        <td></td>
                          <td colspan="2" class="td2"><b></b></td>
                          <td width="38%" class="td2" align="center"><font size="2px"><b><?php echo date("Y");?>/3061/H/0348A
                          </b></font></td>
                        </tr>
                         <tr>
                        <td></td>
                          <td colspan="2" class="td2"><b></b></td>
                          <td width="38%" class="td2" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                        <td></td>
                          <td width="11%" class="td2">&nbsp;</td>
                          <td width="44%" class="td2">&nbsp;</td>
                          <td class="td2"><b>Tanggal SPB :</b></td>
                        </tr>
                        <td></td>
                          <td width="11%" class="td2"></td>
                          <td class="td2">&nbsp;</td>
                          <td class="td2">&nbsp;</td>
                        </tr>
                        <td></td>
                          <td width="11%" class="td2"></td>
                          <td class="td2"><b></b></td>
                          <td class="td2">&nbsp;</td>
                        </tr>
                      </table>
                      
                      <br>
                      <table width="100%" border="0" class="table4">
                        <tr>
                            <td class="td2" width="20%"><b>Bersama ini kami kirimkan surat pengambilan barang berupa :</b></td>
                        </tr>
                      </table>
                      <br>
            
 <?php
 $supp=$db->select("tx_sales_spb","*","no_spb='$_GET[id]'");
                    foreach($supp as $valsupp){}
					
              $kon=$db->select("tx_sales_biaya_dtl b left join m_customer c on b.id_cus=c.id_cus","b.*,c.nama_usaha,c.kode_cus","b.id_cabang='$_SESSION[ID_CABANG]' and b.no_sb='$valsupp[no_ref]' order by b.biaya_retri asc");	
			  $nom=1;
              foreach($kon as $konval){
              $tot=0;
              ?>
              <table width="100%" border="1" cellpadding="0" cellspacing="0" class="table4">
                  <tr>
                    <td colspan="4"align="left">&nbsp;<?php echo ucfirst(strtoupper($konval['no_so'].' - '.$konval['kode_cus'].' - '.$konval['nama_usaha']));?></td>
                  </tr>
                  <tr>
                        <td width="4%"align="center"><strong>No</strong></td>
                        <td width="37%" align="center"><strong>Nama Barang</strong></td>
                        <td width="6%"align="center"><strong>#</strong></td>
                        <td width="4%" align="center"><strong>Qty</strong></td>
                  </tr>
                  <?php
                      $kon=$db->select("tx_sales_order_dtl a 
					  join m_barang b on a.id_barang=b.id_barang
					  join m_satuan c on c.id_satuan=a.id_satuan
					  ","c.nama_satuan,a.id_barang,b.kode_barang,b.nama_barang,a.qty,a.harga","a.no_sales='$konval[no_so]'");
                      $no=1;
                      foreach($kon as $d){  
                      ?>
                  <tr>
                        <td align="center"><?php echo $no?>&nbsp;</td>
                        <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
                        <td align="left">&nbsp;<?=$d['nama_satuan']?></td>
                        <td align="right"><?=$d['qty']?>&nbsp;</td>
                 </tr>
                      <?php $no++;
                      $tot=$tot+$sub;
                      } ?>
                    
                    <tr>
                        <td colspan="4" align="right"><b> Total</b>&nbsp;</td>
                </tr>
                      
              </table>	
              <?php
               $nom++;
               }
               ?>
                
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="6%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                          <td width="79%" align="right">&nbsp;</td>
                        </tr>
                      </table>
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="18%">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center">Penerima</td>
                                    </tr>
                                    <tr>
                                        <td width="242" align="center"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="18%">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center">Cheker</td>
                                    </tr>
                                    <tr>
                                        <td width="242" align="center"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center">Branch Manager</td>
                                    </tr>
                                    <tr>
                                        <td width="242" align="center"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="21%">&nbsp;</td>
                            <td width="18%">&nbsp;</td>
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
// window.print();
 //window.close();
 
 </script>
       