<?php 
error_reporting(0);
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('webclass.php');
$db = new kelas();

$id_kas = isset($_GET['id']) ? $_GET['id'] : '';

// 0. Ambil data Preferences Perusahaan
$pref = $db->select("preferences","*");
$nama_perusahaan = !empty($_SESSION['NAMA_PERUSAHAAN']) ? $_SESSION['NAMA_PERUSAHAAN'] : (!empty($pref[0]['nama_perusahaan']) ? $pref[0]['nama_perusahaan'] : 'PRATAMA KERAMIK');
$alamat = !empty($_SESSION['ALAMAT']) ? $_SESSION['ALAMAT'] : (!empty($pref[0]['alamat']) ? $pref[0]['alamat'] : '');
$logo = !empty($_SESSION['LOGO']) ? $_SESSION['LOGO'] : (!empty($pref[0]['logo']) ? $pref[0]['logo'] : '');
$no_telp = !empty($_SESSION['NO_TELP']) ? $_SESSION['NO_TELP'] : (!empty($pref[0]['no_telp']) ? $pref[0]['no_telp'] : '');

// 1. Ambil data Closing Kas (tm_kas)
$kas = array();
$kas_query = $db->select("tm_kas a 
    LEFT JOIN r_user_login b ON a.ID_PEG = b.ID 
    LEFT JOIN m_pegawai c ON b.id_pegawai = c.id_pegawai", 
    "a.*, b.USERNAME, c.nama_pegawai", 
    "a.id_kas = '$id_kas'");
if(!empty($kas_query)){
    $kas = $kas_query[0];
}

$kasir_name = !empty($kas['USERNAME']) ? $kas['USERNAME'] : (!empty($kas['nama_pegawai']) ? $kas['nama_pegawai'] : '-');
$tgl1_formatted = !empty($kas['TGL1']) ? date('n/j/Y g:i:s A', strtotime($kas['TGL1'])) : '-';
$tgl2_formatted = !empty($kas['TGL2']) ? date('n/j/Y g:i:s A', strtotime($kas['TGL2'])) : '-';

// 2. Ambil data Transaksi Penjualan (pj_penjualan) untuk periode closing ini
$where_sales = "a.stamp_date BETWEEN '$kas[TGL1]' AND '$kas[TGL2]' AND a.void_jual is null";
if(!empty($kas['ID_PEG'])){
    $where_sales .= " AND a.id_user = '$kas[ID_PEG]'";
} elseif(!empty($_SESSION['ID_LOGIN'])) {
    $where_sales .= " AND a.id_user = '$_SESSION[ID_LOGIN]'";
}

$sales = $db->select("pj_penjualan a", "*", $where_sales . " ORDER BY a.id_pj ASC");

// 3. Ambil data Detail Barang Penjualan
$items = $db->select("pj_penjualan a 
    JOIN pj_penjualan_dtl b ON a.id_pj = b.id_pj 
    JOIN m_barang_gudang c ON b.id_barang = c.id_barang AND c.id_gudang = a.id_gudang
    JOIN m_satuan d ON c.id_satuan = d.id_satuan",
    "a.no_penjualan, c.kode_barang, c.nama_barang, d.nama_satuan, b.qty_jual, c.hpp, b.harga_jual, b.dtl_total",
    $where_sales . " ORDER BY a.id_pj ASC, b.id_dtl_jual ASC");

// Hitung total transaksi untuk Halaman 1
$tot_total = 0;
$tot_terima = 0;
$tot_kartu = 0;
$tot_piutang = 0;
$tot_kembali = 0;

if(!empty($sales)){
    foreach($sales as $s){
        $total = $s['grantot_jual'];
        $terima = $s['bayar_tunai'];
        $kartu = !empty($s['bayar_card']) ? $s['bayar_card'] : 0;
        
        $kembali = $s['kembali_tunai'];
        $piutang = 0;
        if($kembali < 0){
            $piutang = abs($kembali);
            $kembali = 0;
        }

        $tot_total += $total;
        $tot_terima += $terima;
        $tot_kartu += $kartu;
        $tot_piutang += $piutang;
        $tot_kembali += $kembali;
    }
}

// Hitung total barang & HPP untuk Halaman 2
$tot_penjualan_barang = 0;
$tot_hpp = 0;

if(!empty($items)){
    foreach($items as $it){
        $total_item = $it['qty_jual'] * $it['harga_jual'];
        $hpp_item = $it['qty_jual'] * $it['hpp'];
        $tot_penjualan_barang += $total_item;
        $tot_hpp += $hpp_item;
    }
}
$laba_kotor = $tot_penjualan_barang - round($tot_hpp);
?>
<style type="text/css">
<!--
table {
    border-collapse: collapse;
}
.kop {
    border: 0px;
}
.table_data {
    border: 1px solid black;
    width: 100%;
}
.table_data th {
    border: 1px solid black;
    padding: 4px 2px;
    font-size: 10px;
    text-align: center;
    font-weight: bold;
    background-color: #FFFFFF;
}
.table_data td {
    border: 1px solid black;
    padding: 3px 2px;
    font-size: 9px;
    vertical-align: middle;
}
.info_table td {
    font-size: 10px;
    padding: 2px 0px;
}
.title_header {
    font-size: 13px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 12px;
}
.subtitle_header {
    font-size: 11px;
    font-weight: bold;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 10px;
}
-->
</style>

<!-- ==================== HALAMAN 1 : LAPORAN SETOR KAS & RINCIAN TRANSAKSI ==================== -->
<page backtop="8mm" backbottom="8mm" backleft="10mm" backright="10mm">
    
    <!-- KOP Header Perusahaan -->
    <table cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 4px;">
      <tr>
        <?php if(!empty($logo) && file_exists("logo/".$logo)){ ?>
        <td class="kop" style="width: 65px; vertical-align: middle;">
          <img src="logo/<?=$logo?>" width="55" height="55"/>
        </td>
        <?php } ?>
        <td class="kop" align="left" style="vertical-align: middle;">
          <span style="font-size: 13px; font-weight: bold;"><?=$nama_perusahaan?></span><br>
          <span style="font-size: 9px; color: #333;"><?=$alamat?><?php if(!empty($no_telp)){ echo " | Telp: ".$no_telp; } ?></span>
        </td>
      </tr>
    </table>
    <hr style="border: 0.5px solid #000; margin-top: 2px; margin-bottom: 8px;">

    <div class="title_header">LAPORAN SETOR KAS</div>

    <!-- Tabel Ringkasan Setor Kas -->
    <table class="table_data" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 15px;">
        <thead>
            <tr>
                <th style="width: 14%;">Kas Awal</th>
                <th style="width: 20%;">Total Penerimaan<br>Tunai</th>
                <th style="width: 18%;">Jumlah Penjualan</th>
                <th style="width: 18%;">Setor kas</th>
                <th style="width: 15%;">Sisa</th>
                <th style="width: 15%;">Piutang</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: right; padding-right: 5px;"><?=number_format(isset($kas['AWAL_KAS']) ? $kas['AWAL_KAS'] : 0)?></td>
                <td style="text-align: right; padding-right: 5px;"><?=number_format($tot_terima - $tot_kembali)?></td>
                <td style="text-align: right; padding-right: 5px;"><?=number_format($tot_total)?></td>
                <td style="text-align: right; padding-right: 5px;"><?=number_format(isset($kas['SETOR_KAS']) ? $kas['SETOR_KAS'] : 0)?></td>
                <td style="text-align: right; padding-right: 5px;"><?=number_format(isset($kas['SISA_KAS']) ? $kas['SISA_KAS'] : 0)?></td>
                <td style="text-align: right; padding-right: 5px;"><?=number_format($tot_piutang)?></td>
            </tr>
        </tbody>
    </table>

    <div class="subtitle_header">RINCIAN TRANSAKSI DAN TOTAL UANG</div>

    <!-- Informasi Kasir & Waktu -->
    <table class="info_table" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 8px;">
        <tr>
            <td style="width: 14%;">Kasir</td>
            <td style="width: 36%;">: <?=$kasir_name?></td>
            <td style="width: 10%;">&nbsp;</td>
            <td style="width: 40%;">&nbsp;</td>
        </tr>
        <tr>
            <td style="width: 14%;">No Kas</td>
            <td style="width: 36%;">: <?=!empty($kas['NO_KAS']) ? $kas['NO_KAS'] : '-'?></td>
            <td style="width: 10%;">&nbsp;</td>
            <td style="width: 40%;">&nbsp;</td>
        </tr>
        <tr>
            <td style="width: 14%;">Tgl Awal Kas</td>
            <td style="width: 36%;">: <?=$tgl1_formatted?></td>
            <td style="width: 10%; text-align: right;">Akhir :</td>
            <td style="width: 40%; padding-left: 5px;"><?=$tgl2_formatted?></td>
        </tr>
    </table>

    <!-- Tabel Rincian Nomor Transaksi -->
    <table class="table_data" cellpadding="0" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 4%;">No.</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 22%;">No Bill</th>
                <th style="width: 13%;">Total</th>
                <th style="width: 13%;">Uang Terima</th>
                <th style="width: 12%;">Bayar Kartu</th>
                <th style="width: 11%;">Piutang</th>
                <th style="width: 13%;">Kembalian</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no_trx = 1;
            if(!empty($sales)){
                foreach($sales as $s){
                    $tgl_trx = date('n/j/Y', strtotime($s['tgl_penjualan']));
                    $total = $s['grantot_jual'];
                    $terima = $s['bayar_tunai'];
                    $kartu = !empty($s['bayar_card']) ? $s['bayar_card'] : 0;
                    
                    $kembali = $s['kembali_tunai'];
                    $piutang = 0;
                    if($kembali < 0){
                        $piutang = abs($kembali);
                        $kembali = 0;
                    }
            ?>
            <tr>
                <td style="text-align: center;"><?=$no_trx?></td>
                <td style="text-align: center;"><?=$tgl_trx?></td>
                <td style="text-align: left; padding-left: 3px;"><?=$s['no_penjualan']?></td>
                <td style="text-align: right; padding-right: 3px;"><?=number_format($total, 2)?></td>
                <td style="text-align: right; padding-right: 3px;"><?=number_format($terima, 2)?></td>
                <td style="text-align: right; padding-right: 3px;"><?=number_format($kartu, 2)?></td>
                <td style="text-align: right; padding-right: 3px;"><?=number_format($piutang, 2)?></td>
                <td style="text-align: right; padding-right: 3px;"><?=number_format($kembali, 2)?></td>
            </tr>
            <?php
                    $no_trx++;
                }
            } else {
            ?>
            <tr>
                <td colspan="8" style="text-align: center; padding: 8px;">Tidak ada transaksi pada periode closing ini</td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3" style="text-align: center; font-weight: bold; font-size: 10px;">Total</td>
                <td style="text-align: right; font-weight: bold; padding-right: 3px; font-size: 10px;"><?=number_format($tot_total, 2)?></td>
                <td style="text-align: right; font-weight: bold; padding-right: 3px; font-size: 10px;"><?=number_format($tot_terima, 2)?></td>
                <td style="text-align: right; font-weight: bold; padding-right: 3px; font-size: 10px;"><?=number_format($tot_kartu, 2)?></td>
                <td style="text-align: right; font-weight: bold; padding-right: 3px; font-size: 10px;"><?=number_format($tot_piutang, 2)?></td>
                <td style="text-align: right; font-weight: bold; padding-right: 3px; font-size: 10px;"><?=number_format($tot_kembali, 2)?></td>
            </tr>
        </tbody>
    </table>

</page>

<!-- ==================== HALAMAN 2 : RINCIAN BARANG DAN TOTAL UANG ==================== -->
<page backtop="8mm" backbottom="8mm" backleft="10mm" backright="10mm">

    <!-- KOP Header Perusahaan -->
    <table cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 4px;">
      <tr>
        <?php if(!empty($logo) && file_exists("logo/".$logo)){ ?>
        <td class="kop" style="width: 65px; vertical-align: middle;">
          <img src="logo/<?=$logo?>" width="55" height="55"/>
        </td>
        <?php } ?>
        <td class="kop" align="left" style="vertical-align: middle;">
          <span style="font-size: 13px; font-weight: bold;"><?=$nama_perusahaan?></span><br>
          <span style="font-size: 9px; color: #333;"><?=$alamat?><?php if(!empty($no_telp)){ echo " | Telp: ".$no_telp; } ?></span>
        </td>
      </tr>
    </table>
    <hr style="border: 0.5px solid #000; margin-top: 2px; margin-bottom: 8px;">

    <div class="title_header">RINCIAN BARANG DAN TOTAL UANG</div>

    <!-- Informasi Kasir & Waktu -->
    <table class="info_table" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 8px;">
        <tr>
            <td style="width: 14%;">Kasir</td>
            <td style="width: 36%;">: <?=$kasir_name?></td>
            <td style="width: 10%;">&nbsp;</td>
            <td style="width: 40%;">&nbsp;</td>
        </tr>
        <tr>
            <td style="width: 14%;">No Kas</td>
            <td style="width: 36%;">: <?=!empty($kas['NO_KAS']) ? $kas['NO_KAS'] : '-'?></td>
            <td style="width: 10%;">&nbsp;</td>
            <td style="width: 40%;">&nbsp;</td>
        </tr>
        <tr>
            <td style="width: 14%;">Tgl Awal Kas</td>
            <td style="width: 36%;">: <?=$tgl1_formatted?></td>
            <td style="width: 10%; text-align: right;">Akhir :</td>
            <td style="width: 40%; padding-left: 5px;"><?=$tgl2_formatted?></td>
        </tr>
    </table>

    <!-- Tabel Rincian Barang -->
    <table class="table_data" cellpadding="0" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 11%;">Kode Barang</th>
                <th style="width: 37%;">Nama Barang</th>
                <th style="width: 7%;">Sat</th>
                <th style="width: 5%;">Qty</th>
                <th style="width: 11%;">HPP</th>
                <th style="width: 11%;">Harga</th>
                <th style="width: 14%;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no_item = 1;
            if(!empty($items)){
                foreach($items as $it){
                    $total_item = $it['qty_jual'] * $it['harga_jual'];
            ?>
            <tr>
                <td style="text-align: center;"><?=$no_item?></td>
                <td style="text-align: center;"><?=$it['kode_barang']?></td>
                <td style="text-align: left; padding-left: 3px;"><?=$it['nama_barang']?></td>
                <td style="text-align: center;"><?=$it['nama_satuan']?></td>
                <td style="text-align: right; padding-right: 4px;"><?=$it['qty_jual']?></td>
                <td style="text-align: right; padding-right: 4px;"><?=number_format($it['hpp'])?></td>
                <td style="text-align: right; padding-right: 4px;"><?=number_format($it['harga_jual'])?></td>
                <td style="text-align: right; padding-right: 4px;"><?=number_format($total_item)?></td>
            </tr>
            <?php
                    $no_item++;
                }
            } else {
            ?>
            <tr>
                <td colspan="8" style="text-align: center; padding: 8px;">Tidak ada rincian barang pada periode closing ini</td>
            </tr>
            <?php } ?>
            
            <!-- Ringkasan Total Penjualan, Piutang, HPP, Laba Kotor di bagian bawah kanan -->
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px; font-size: 10px;">Total Penjualan :</td>
                <td style="text-align: right; font-weight: bold; padding-right: 4px; font-size: 10px;">Rp. <?=number_format($tot_penjualan_barang)?></td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px; font-size: 10px;">Total Piutang :</td>
                <td style="text-align: right; font-weight: bold; padding-right: 4px; font-size: 10px;">Rp. <?=number_format($tot_piutang)?></td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px; font-size: 10px;">Total HPP :</td>
                <td style="text-align: right; font-weight: bold; padding-right: 4px; font-size: 10px;">Rp. <?=number_format(round($tot_hpp))?></td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px; font-size: 10px;">Laba Kotor :</td>
                <td style="text-align: right; font-weight: bold; padding-right: 4px; font-size: 10px;">Rp. <?=number_format($laba_kotor)?></td>
            </tr>
        </tbody>
    </table>

</page>
