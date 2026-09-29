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
                          <td width="43%" class="td2"><font size="4px"><b>SURAT PERINTAH JALAN</b></font></td>
                        </tr>
                        <tr>
                        <?php 
								$tglso=$db->select("tx_do","*","no_ref='$_GET[id]'");
							  foreach($tglso as $tglspj){}
								?>
                        <td></td>
                          <td colspan="2" class="td2"><b></b></td>
                          <td width="43%" class="td2" align="center"><font size="2px"><b><?=$tglspj['no_spj']?></b></font></td>
                        </tr>
                         <tr>
                        <td></td>
                          <td colspan="2" class="td2"><b></b></td>
                          <td width="43%" class="td2" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                        <?php 
								$nop=$db->select("tx_sales_order a
JOIN tx_sales_spb_tkbm b ON a.no_sales = b.no_so
JOIN tx_sales_biaya_dtl c on b.id_barang=c.no_sb","c.nopol","a.no_sales='$_GET[id]'");
							  foreach($nop as $pol){}
								?>
                        <td></td>
                          <td width="11%" class="td2"><b>Kepada Yth.</b></td>
                          <td width="39%" class="td2"><b><?=$val['nama_usaha']?></b></td>
                          <td class="td2"><b>Tanggal Pengiriman : <?=$tglspj['tgl_spj']?></b></td>
                        </tr>
                        <td></td>
                          <td width="11%" class="td2"></td>
                          <td class="td2"><b><?=$val['alamat_usaha']?></b></td>
                          <td class="td2"><b>Jatuh Tempo Pembayaran Normal : <?=$tglspj['tempo_normal']?></b></td>
                        </tr>
                         <td></td>
                          <td width="11%" class="td2"></td>
                          <td class="td2"></td>
                          <td class="td2"><b>Jatuh Tempo Pembayaran Tambahan : <?=$tglspj['tempo_tambahan']?></b></td>
                        </tr>
                        <td></td>
                          <td width="11%" class="td2"></td>
                          <td class="td2"><b></b></td>
                          <td class="td2"><b>Nopol : <?=$pol['nopol']?></b></td>
                        </tr>
                      </table>
                      
                      <br>
                      <table width="100%" border="0" class="table4">
                        <tr>
                            <td class="td2" width="20%"><b>Bersama ini kami kirimkan barang berupa :</b></td>
                        </tr>
                      </table>
                      <br>
                      <table width="100%" border="1" cellpadding="3" cellspacing="0"  class="table4">
                        <tr>
                          <td width="6%" class="td" align="center">Kode</td>
                          <td width="38%" class="td" align="center">Nama Barang</td>
                          <td width="10%" class="td" align="center" >Qty</td>
                          <td width="15%" class="td" align="center" >Keterangan</td> 
                        </tr>
                        <?php 
								$supp=$db->select("tx_sales_order a
								JOIN tx_sales_order_dtl b ON a.no_sales = b.no_sales
								JOIN m_barang_gudang c ON b.id_barang = c.id_barang
								AND a.id_gudang = c.id_gudang
								JOIN m_satuan e on b.id_satuan=e.id_satuan","b.*,
								c.kode_barang,
								c.nama_barang,
								e.nama_satuan","b.no_sales='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                        <tr>
                          <td class="td" align="center"><?=$valsupp['kode_barang']?></td>
                          <td class="td"><?=$valsupp['nama_barang']?></td>
                          <td class="td" align="center"><?=$valsupp['qty']?></td>
                          <td align="right" class="td"><?=$valsupp['ket']?></td>  
                        </tr>
                        <?php $no++; } ?>
                      </table>
                
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                        <?php 
								$tgln=$db->select("tx_sales_order a
								JOIN m_customer b ON a.id_cus = b.id_cus
								JOIN m_cabang c ON c.id_cabang = b.id_cabang","c.nama_cabang","a.no_sales='$_GET[id]'");
							  foreach($tgln as $ks){}
							  	if(date('m',strtotime($tglspj['tgl_spj']))==01){
									$a="January";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==02){
									$a="Februari";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==03){
									$a="Maret";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==04){
									$a="April";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==05){
									$a="Mei";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==06){
									$a="Juni";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==07){
									$a="July";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==08){
									$a="Agustus";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==09){
									$a="September";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==10){
									$a="Oktober";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==11){
									$a="November";
									}elseif(date('m',strtotime($tglspj['tgl_spj']))==12){
									$a="Desember";
									}
								?>
                          <td width="6%"><strong>Tgl.</strong></td>
                          <td width="15%">&nbsp;</td>
                          <td width="79%" align="right"><strong><?=$ks['nama_cabang']?>,<?=date('d',strtotime($tglspj['tgl_spj']))?> <?=$a?> <?=date('Y',strtotime($tglspj['tgl_spj']))?></strong></td>
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
                                        <td align="center">Pengendara</td>
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
                            <td width="21%">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center">Satpam</td>
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
       