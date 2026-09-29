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
							  $se=$db->select("tx_koreksi_piutang a 
							  join m_customer b on a.id_cus=b.id_cus
							  left join m_cabang c on a.id_cabang=c.id_cabang
							  ","a.*,b.nama_usaha,b.alamat_usaha,c.nama_cabang","a.no_koreksi='$_GET[id]'");
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
                          <td colspan="2" class="td2"><font size="4px"><b>KOREKSI SURAT PERINTAH JALAN</b></font></td>
                        </tr>
                        <tr>
                        <td></td>
                          <td colspan="2" class="td2"><b></b></td>
                          <td colspan="2" align="center" class="td2"><font size="2px"><b><?=$tglspj['no_spj']?></b></font></td>
                        </tr>
                         <tr>
                        <td></td>
                          <td colspan="2" class="td2"><b></b></td>
                          <td colspan="2" align="center" class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                        <td></td>
                          <td width="11%" class="td2"><b>Kepada Yth.</b></td>
                          <td width="39%" class="td2"><b><?=$val['nama_usaha']?></b></td>
                          <td width="15%" class="td2"><b>No Koreksi </b></td>
                          <td width="28%" class="td2"><b>
                            : <?=$val['no_koreksi']?>
                          </b></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td width="11%" class="td2"></td>
                          <td class="td2"><b><?=$val['alamat_usaha']?></b></td>
                          <td class="td2"><b>Tanggal Koreksi 
                              
                          </b></td>
                          <td class="td2"><b>
                            : <?=date("d-m-Y",strtotime($val['tgl_koreksi']))?>
                          </b></td>
                        </tr>
                         <tr>
                           <td></td>
                          <td width="11%" class="td2"></td>
                          <td class="td2"><b></b></td>
                          <td class="td2"><b>No SPJ</b></td>
                          <td class="td2"><b> :
                            <?=$val['no_ref']?>
                          </b></td>
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
                          <td width="10%" class="td" align="center" >Harga Sebelumnya</td>
                          <td width="10%" class="td" align="center" >Harga Koreksi</td>
                          <td width="10%" class="td" align="center" >Qty</td>
                          <td width="15%" class="td" align="center" >Jumlah</td> 
                        </tr>
                        <?php 
								$supp=$db->select("tx_koreksi_piutang_dtl a 
								join m_barang b on a.id_barang=b.id_barang
								join m_satuan c on b.id_satuan=c.id_satuan
								","a.*,b.kode_barang,b.nama_barang","a.no_piutang='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                       
                        <tr>
                          <td class="td" align="center"><?=$valsupp['kode_barang']?></td>
                          <td class="td"><?=$valsupp['nama_barang']?></td>
                          <td class="td" align="right"><?=number_format($valsupp['harga_awal'])?></td>
                          <td class="td" align="right"><?=number_format($valsupp['harga_ganti'])?></td>
                          <td class="td" align="center"><?=$valsupp['qty']?></td>
                          <td align="right" class="td"><?=number_format($sub=$valsupp['harga_ganti']*$valsupp['qty'])?></td>  
                        </tr>
                        <?php $no++; }
						$tot=$tot+$sub;
						 ?>
                         <tr>
                          <td colspan="5" align="center" class="td">Total</td>
                          <td align="right" class="td"><?=number_format($tot)?></td>
                        </tr>
                      </table>
                
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                        <?php 
							
							  	if(date('m',strtotime($val['tgl_koreksi']))==01){
									$a="January";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==02){
									$a="Februari";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==03){
									$a="Maret";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==04){
									$a="April";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==05){
									$a="Mei";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==06){
									$a="Juni";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==07){
									$a="July";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==08){
									$a="Agustus";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==09){
									$a="September";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==10){
									$a="Oktober";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==11){
									$a="November";
									}elseif(date('m',strtotime($val['tgl_koreksi']))==12){
									$a="Desember";
									}
								?>
                          <td width="6%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                          <td width="39%" align="right">Tgl</td>
                          <td width="40%" align="right"><strong>
                            <?=$val['nama_cabang']?>
                            ,
                            <?=date('d',strtotime($val['tgl_koreksi']))?>
                            <?=$a?>
                            <?=date('Y',strtotime($val['tgl_koreksi']))?>
                          </strong></td>
                        </tr>
                      </table>
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="18%">&nbsp;</td>
                            <td width="18%">&nbsp;</td>
                            <td width="19%">&nbsp;</td>
                            <td width="21%">&nbsp;</td>
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
       