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
                          <td width="31%" class="td2"><b>PT.Taurus Gemilang</b></td>
                          <td width="62%" class="td2"><font size="4px"><b>EKSPEDISI PENAGIHAN</b></font></td>
                        </tr>
                        <tr>
                        <?php 
								$tglso=$db->select("tx_do","*","no_ref='$_GET[id]'");
							  foreach($tglso as $tglspj){}
								?>
                        <td></td>
                          <td class="td2"><b></b></td>
                          <td width="62%" class="td2" align="center"><font size="2px"><b><?=$_GET['id']?></b></font></td>
                        </tr>
                         <tr>
                        <td></td>
                          <td class="td2"><b></b></td>
                          <td width="62%" class="td2" align="center">&nbsp;</td>
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
                          <td colspan="2" rowspan="2" align="center" class="td">Pelanggan</td>
                          <td colspan="4" align="center" class="td">Faktur</td>
                          <td width="16%" rowspan="2" align="center" class="td" >Paraf Penyerahan</td>
                          <td width="21%" rowspan="2" align="center" class="td" >Nama Pelanggan</td> 
                        </tr>
                        <tr>
                          <td width="15%" align="center" class="td">No faktur</td>
                          <td width="8%" align="center" class="td">Tgl Tempo</td>
                          <td width="7%" align="center" class="td">Umur</td>
                          <td width="14%" align="center" class="td">Jumlah</td>
                        </tr>
                        <?php 
								$supp=$db->select("tx_buku_tagihan_dtl a join m_customer b on a.id_cus=b.id_cus","a.*,kode_cus,nama_usaha,nama_cus","a.no='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                        <tr>
                          <td width="7%" align="left" class="td"><?=$valsupp['kode_cus']?></td>
                          <td width="12%" align="left" class="td"><?=$valsupp['nama_usaha']?></td>
                          <td class="td"><?=$valsupp['no_fj']?></td>
                          <td class="td"><?=$valsupp['tempo_tambahan']?></td>
                          <td class="td"><?=$valsupp['nama_barang']?></td>
                          <td class="td"><?=$valsupp['total_piutang']?></td>
                          <td class="td" align="center">&nbsp;</td>
                          <td align="left" class="td"><?=$valsupp['nama_cus']?></td>  
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
                                        <td align="center">Sales</td>
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
                                        <td align="center">Kepala Cabang</td>
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
       