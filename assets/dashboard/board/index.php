<?php
// Dashboard Penjualan Retail
$today = date('Y-m-d');
$cur_year = date('Y');
$cur_month = date('m');

// Auto detect latest year with data if not explicitly set
$def_year = $cur_year;
$def_month = $cur_month;
try {
    $q_max_year = $db->select("pj_penjualan", "YEAR(MAX(tgl_penjualan)) AS max_y, MONTH(MAX(tgl_penjualan)) AS max_m", "tgl_penjualan IS NOT NULL AND tgl_penjualan != '0000-00-00'");
    if (!empty($q_max_year) && !empty($q_max_year[0]['max_y'])) {
        $max_y = $q_max_year[0]['max_y'];
        $max_m = sprintf("%02d", (int)$q_max_year[0]['max_m']);
        
        // Cek apakah ada data di tahun saat ini
        $q_cur_cnt = $db->select("pj_penjualan", "COUNT(*) AS cnt", "YEAR(tgl_penjualan) = '$cur_year'");
        if (empty($q_cur_cnt) || $q_cur_cnt[0]['cnt'] == 0) {
            $def_year = $max_y;
            $def_month = $max_m;
        }
    }
} catch (Exception $e) {}

// Filter parameters
$filter_bulan  = isset($_GET['bulan']) ? $_GET['bulan'] : (isset($_POST['bulan']) ? $_POST['bulan'] : $def_month);
$filter_tahun  = isset($_GET['tahun']) ? $_GET['tahun'] : (isset($_POST['tahun']) ? $_POST['tahun'] : $def_year);
$filter_gudang = isset($_GET['gudang']) ? $_GET['gudang'] : (isset($_POST['gudang']) ? $_POST['gudang'] : 'all');

// Daftar nama bulan
$list_bulan = array(
    'all' => 'Semua Bulan (1 Tahun Penuh)',
    '01'  => 'Januari',
    '02'  => 'Februari',
    '03'  => 'Maret',
    '04'  => 'April',
    '05'  => 'Mei',
    '06'  => 'Juni',
    '07'  => 'Juli',
    '08'  => 'Agustus',
    '09'  => 'September',
    '10'  => 'Oktober',
    '11'  => 'November',
    '12'  => 'Desember'
);

// Kondisi WHERE dasar
$where_base = "(a.void_jual IS NULL OR a.void_jual = '' OR a.void_jual = '0')";
if ($filter_gudang != 'all' && !empty($filter_gudang)) {
    $where_base .= " AND a.id_gudang = '" . addslashes($filter_gudang) . "'";
}

// Kondisi untuk periode terpilih
$where_periode = $where_base . " AND YEAR(a.tgl_penjualan) = '" . addslashes($filter_tahun) . "'";
if ($filter_bulan != 'all') {
    $where_periode .= " AND MONTH(a.tgl_penjualan) = '" . addslashes($filter_bulan) . "'";
}

// 1. KPI Hari Ini (Today)
$where_today = $where_base . " AND a.tgl_penjualan = '$today'";
$q_today = $db->select("pj_penjualan a", "IFNULL(SUM(a.grantot_jual), 0) AS omset, COUNT(a.id_pj) AS total_trx, IFNULL(SUM(a.bayar_tunai), 0) AS tunai, IFNULL(SUM(a.bayar_card), 0) AS card", $where_today);
$kpi_today = !empty($q_today) ? $q_today[0] : array('omset' => 0, 'total_trx' => 0, 'tunai' => 0, 'card' => 0);

// 2. KPI Periode Terpilih (Bulan / Tahun)
$q_periode = $db->select("pj_penjualan a", "IFNULL(SUM(a.grantot_jual), 0) AS omset, COUNT(a.id_pj) AS total_trx, IFNULL(AVG(a.grantot_jual), 0) AS avg_trx, IFNULL(SUM(a.bayar_tunai), 0) AS total_tunai, IFNULL(SUM(a.bayar_card), 0) AS total_card, IFNULL(SUM(a.disc_rp), 0) AS total_disc", $where_periode);
$kpi_periode = !empty($q_periode) ? $q_periode[0] : array('omset' => 0, 'total_trx' => 0, 'avg_trx' => 0, 'total_tunai' => 0, 'total_card' => 0, 'total_disc' => 0);

// 3. KPI Total Item Qty Terjual Periode Terpilih
$q_qty = $db->select("pj_penjualan a JOIN pj_penjualan_dtl b ON a.id_pj = b.id_pj", "IFNULL(SUM(b.qty_jual), 0) AS total_qty, COUNT(DISTINCT b.id_barang) AS jenis_barang", $where_periode);
$kpi_qty = !empty($q_qty) ? $q_qty[0] : array('total_qty' => 0, 'jenis_barang' => 0);

// 4. Data untuk Grafik Tren Penjualan
$chart_categories = array();
$chart_series_omset = array();
$chart_series_trx = array();

if ($filter_bulan != 'all') {
    // Per hari dalam 1 bulan
    $total_days = date('t', strtotime("$filter_tahun-$filter_bulan-01"));
    $daily_map = array();
    for ($d = 1; $d <= $total_days; $d++) {
        $chart_categories[] = "Tgl " . $d;
        $daily_map[$d] = array('omset' => 0, 'trx' => 0);
    }
    
    $q_trend = $db->select("pj_penjualan a", "DAY(a.tgl_penjualan) AS tgl, IFNULL(SUM(a.grantot_jual), 0) AS omset, COUNT(a.id_pj) AS trx", "$where_periode GROUP BY DAY(a.tgl_penjualan)");
    if (!empty($q_trend)) {
        foreach ($q_trend as $row) {
            $tgl_idx = (int)$row['tgl'];
            if (isset($daily_map[$tgl_idx])) {
                $daily_map[$tgl_idx]['omset'] = (float)$row['omset'];
                $daily_map[$tgl_idx]['trx'] = (int)$row['trx'];
            }
        }
    }
    
    foreach ($daily_map as $val) {
        $chart_series_omset[] = $val['omset'];
        $chart_series_trx[] = $val['trx'];
    }
} else {
    // Per bulan dalam 1 tahun
    $monthly_map = array();
    for ($m = 1; $m <= 12; $m++) {
        $chart_categories[] = $list_bulan[sprintf("%02d", $m)];
        $monthly_map[$m] = array('omset' => 0, 'trx' => 0);
    }
    
    $q_trend = $db->select("pj_penjualan a", "MONTH(a.tgl_penjualan) AS bln, IFNULL(SUM(a.grantot_jual), 0) AS omset, COUNT(a.id_pj) AS trx", "$where_periode GROUP BY MONTH(a.tgl_penjualan)");
    if (!empty($q_trend)) {
        foreach ($q_trend as $row) {
            $bln_idx = (int)$row['bln'];
            if (isset($monthly_map[$bln_idx])) {
                $monthly_map[$bln_idx]['omset'] = (float)$row['omset'];
                $monthly_map[$bln_idx]['trx'] = (int)$row['trx'];
            }
        }
    }
    
    foreach ($monthly_map as $val) {
        $chart_series_omset[] = $val['omset'];
        $chart_series_trx[] = $val['trx'];
    }
}

// 5. Data Top 10 Produk Terlaris
$q_top_produk = $db->select(
    "pj_penjualan a JOIN pj_penjualan_dtl b ON a.id_pj = b.id_pj JOIN m_barang c ON b.id_barang = c.id_barang",
    "c.kode_barang, c.nama_barang, IFNULL(SUM(b.qty_jual), 0) AS total_qty, IFNULL(SUM(b.dtl_total), 0) AS total_omset",
    "$where_periode GROUP BY b.id_barang ORDER BY total_qty DESC LIMIT 10"
);

$top_item_names = array();
$top_item_qtys = array();
$top_item_omsets = array();
if (!empty($q_top_produk)) {
    foreach ($q_top_produk as $tp) {
        $top_item_names[] = addslashes($tp['nama_barang']);
        $top_item_qtys[] = (float)$tp['total_qty'];
        $top_item_omsets[] = (float)$tp['total_omset'];
    }
}

// 6. Data Transaksi Terkini (10 Terakhir)
$q_recent = $db->select(
    "pj_penjualan a 
     LEFT JOIN m_gudang g ON a.id_gudang = g.id_gudang 
     LEFT JOIN r_user_login u ON a.id_user = u.ID 
     LEFT JOIN m_pegawai p ON u.id_pegawai = p.id_pegawai",
    "a.id_pj, a.no_penjualan, a.tgl_penjualan, a.stamp_date, a.grantot_jual, a.jenis_bayar, a.pelanggan, g.nama_gudang, p.nama_pegawai",
    "$where_base ORDER BY a.id_pj DESC LIMIT 10"
);

// 7. Data Top 5 Kasir Teraktif
$q_kasir = $db->select(
    "pj_penjualan a 
     JOIN r_user_login u ON a.id_user = u.ID 
     JOIN m_pegawai p ON u.id_pegawai = p.id_pegawai",
    "p.nama_pegawai, COUNT(a.id_pj) AS total_trx, IFNULL(SUM(a.grantot_jual), 0) AS total_omset",
    "$where_periode GROUP BY a.id_user ORDER BY total_omset DESC LIMIT 5"
);

// List Gudang untuk filter
$list_gudang = $db->select("m_gudang", "id_gudang, nama_gudang", "1=1 ORDER BY nama_gudang ASC");

// Persentase Pembayaran
$total_bayar_all = $kpi_periode['total_tunai'] + $kpi_periode['total_card'];
$persen_tunai = ($total_bayar_all > 0) ? round(($kpi_periode['total_tunai'] / $total_bayar_all) * 100, 1) : 0;
$persen_card = ($total_bayar_all > 0) ? round(($kpi_periode['total_card'] / $total_bayar_all) * 100, 1) : 0;
?>

<!-- Custom CSS Dashboard -->
<style>
.dashboard-kpi-card {
    border-radius: 6px;
    padding: 18px 20px;
    margin-bottom: 20px;
    color: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.dashboard-kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.12);
}
.kpi-bg-emerald {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}
.kpi-bg-indigo {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
}
.kpi-bg-purple {
    background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
}
.kpi-bg-amber {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}
.kpi-icon-bg {
    position: absolute;
    right: 15px;
    bottom: 12px;
    font-size: 65px;
    opacity: 0.2;
    line-height: 1;
}
.kpi-label {
    font-size: 13px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.9;
    margin-bottom: 6px;
}
.kpi-value {
    font-size: 24px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 6px;
}
.kpi-desc {
    font-size: 12px;
    opacity: 0.85;
}
.filter-container {
    background: #ffffff;
    border-radius: 6px;
    padding: 15px 20px;
    margin-bottom: 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.panel-dashboard {
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    background: #fff;
}
.panel-dashboard .panel-heading {
    border-bottom: 1px solid #f1f5f9;
    padding: 15px 20px;
    background-color: #fafbfc;
    border-radius: 6px 6px 0 0;
}
.panel-dashboard .panel-title {
    font-size: 15px;
    font-weight: 600;
    color: #334155;
}
.table-dashboard th {
    background-color: #f8fafc;
    color: #475569;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    border-bottom: 1px solid #e2e8f0 !important;
}
.table-dashboard td {
    vertical-align: middle !important;
    font-size: 13px;
    color: #334155;
    border-top: 1px solid #f1f5f9 !important;
}
.badge-pay-cash {
    background-color: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 4px;
}
.badge-pay-card {
    background-color: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 4px;
}
.quick-badge {
    display: inline-block;
    padding: 4px 10px;
    font-size: 11px;
    border-radius: 20px;
    background: #f1f5f9;
    color: #475569;
    margin-right: 5px;
    font-weight: 500;
}
</style>

<div class="col-lg-12">

    <!-- Filter & Breadcrumb Bar -->
    <div class="filter-container">
        <form method="GET" action="index.php" id="formFilterDashboard">
            <input type="hidden" name="x" value="dashboard">
            <div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">
                <div class="col-md-3 col-sm-6" style="margin-bottom: 8px;">
                    <label style="font-weight: 600; font-size: 12px; color: #475569; margin-bottom: 4px;"><i class="icon-calendar52 position-left"></i> Bulan:</label>
                    <select name="bulan" id="filter_bulan" class="form-control input-sm" style="border-radius: 4px;">
                        <?php foreach ($list_bulan as $k_bln => $n_bln) { ?>
                            <option value="<?= $k_bln ?>" <?= ($filter_bulan == $k_bln) ? 'selected' : '' ?>><?= $n_bln ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col-md-2 col-sm-6" style="margin-bottom: 8px;">
                    <label style="font-weight: 600; font-size: 12px; color: #475569; margin-bottom: 4px;"><i class="icon-calendar position-left"></i> Tahun:</label>
                    <select name="tahun" id="filter_tahun" class="form-control input-sm" style="border-radius: 4px;">
                        <?php 
                        $start_y = 2015;
                        $end_y = (int)date('Y') + 1;
                        for ($y = $end_y; $y >= $start_y; $y--) { ?>
                            <option value="<?= $y ?>" <?= ($filter_tahun == $y) ? 'selected' : '' ?>><?= $y ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-3 col-sm-6" style="margin-bottom: 8px;">
                    <label style="font-weight: 600; font-size: 12px; color: #475569; margin-bottom: 4px;"><i class="icon-store2 position-left"></i> Toko / Gudang:</label>
                    <select name="gudang" id="filter_gudang" class="form-control input-sm" style="border-radius: 4px;">
                        <option value="all" <?= ($filter_gudang == 'all') ? 'selected' : '' ?>>Semua Toko / Gudang</option>
                        <?php if (!empty($list_gudang)) {
                            foreach ($list_gudang as $gud) { ?>
                                <option value="<?= $gud['id_gudang'] ?>" <?= ($filter_gudang == $gud['id_gudang']) ? 'selected' : '' ?>><?= $gud['nama_gudang'] ?></option>
                        <?php }} ?>
                    </select>
                </div>

                <div class="col-md-4 col-sm-6" style="margin-bottom: 8px; margin-top: 18px;">
                    <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 4px; font-weight: 600; padding: 6px 15px;">
                        <i class="icon-filter4 position-left"></i> Terapkan Filter
                    </button>
                    <a href="index.php?x=dashboard" class="btn btn-default btn-sm" style="border-radius: 4px; margin-left: 5px;">
                        <i class="icon-reload-alt position-left"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- 4 KPI Metrics Card Row -->
    <div class="row">
        <!-- Card 1: Hari Ini -->
        <div class="col-md-3 col-sm-6">
            <div class="dashboard-kpi-card kpi-bg-emerald">
                <i class="icon-coin-dollar kpi-icon-bg"></i>
                <div class="kpi-label">Penjualan Hari Ini</div>
                <div class="kpi-value">Rp <?= number_format($kpi_today['omset'], 0, ',', '.') ?></div>
                <div class="kpi-desc"><i class="icon-cart-check"></i> <b><?= number_format($kpi_today['total_trx'], 0, ',', '.') ?></b> Transaksi Hari Ini</div>
            </div>
        </div>

        <!-- Card 2: Omset Periode Terpilih -->
        <div class="col-md-3 col-sm-6">
            <div class="dashboard-kpi-card kpi-bg-indigo">
                <i class="icon-stats-growth kpi-icon-bg"></i>
                <div class="kpi-label">Omset Periode (<?= ($filter_bulan != 'all' ? $list_bulan[$filter_bulan] . ' ' : '') . $filter_tahun ?>)</div>
                <div class="kpi-value">Rp <?= number_format($kpi_periode['omset'], 0, ',', '.') ?></div>
                <div class="kpi-desc"><i class="icon-calculator2"></i> Rata-rata: <b>Rp <?= number_format($kpi_periode['avg_trx'], 0, ',', '.') ?></b> / struk</div>
            </div>
        </div>

        <!-- Card 3: Total Transaksi -->
        <div class="col-md-3 col-sm-6">
            <div class="dashboard-kpi-card kpi-bg-purple">
                <i class="icon-file-text2 kpi-icon-bg"></i>
                <div class="kpi-label">Total Transaksi Selesai</div>
                <div class="kpi-value"><?= number_format($kpi_periode['total_trx'], 0, ',', '.') ?> <span style="font-size: 15px; font-weight: normal;">Struk</span></div>
                <div class="kpi-desc"><i class="icon-cash3"></i> Tunai: <?= $persen_tunai ?>% | Non-Tunai: <?= $persen_card ?>%</div>
            </div>
        </div>

        <!-- Card 4: Total Qty Terjual -->
        <div class="col-md-3 col-sm-6">
            <div class="dashboard-kpi-card kpi-bg-amber">
                <i class="icon-bag kpi-icon-bg"></i>
                <div class="kpi-label">Total Item Terjual</div>
                <div class="kpi-value"><?= number_format($kpi_qty['total_qty'], 0, ',', '.') ?> <span style="font-size: 15px; font-weight: normal;">Pcs</span></div>
                <div class="kpi-desc"><i class="icon-cube4"></i> Dari <b><?= number_format($kpi_qty['jenis_barang'], 0, ',', '.') ?></b> Varian Produk</div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1: Tren Penjualan & Komposisi Pembayaran -->
    <div class="row">
        <!-- Tren Penjualan -->
        <div class="col-lg-8 col-md-7">
            <div class="panel panel-dashboard">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <i class="icon-stats-dots position-left text-primary"></i> 
                        Tren Penjualan (<?= ($filter_bulan != 'all' ? 'Harian Bulan ' . $list_bulan[$filter_bulan] . ' ' : 'Bulanan Tahun ') . $filter_tahun ?>)
                    </h5>
                </div>
                <div class="panel-body">
                    <div id="chartTrenPenjualan" style="min-width: 280px; height: 350px;"></div>
                </div>
            </div>
        </div>

        <!-- Donut Chart: Komposisi Metode Pembayaran -->
        <div class="col-lg-4 col-md-5">
            <div class="panel panel-dashboard">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <i class="icon-pie-chart5 position-left text-indigo"></i> 
                        Metode Pembayaran
                    </h5>
                </div>
                <div class="panel-body">
                    <div id="chartMetodeBayar" style="min-width: 250px; height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2: Top 10 Produk Terlaris & Top Kasir -->
    <div class="row">
        <!-- Top 10 Best Sellers -->
        <div class="col-lg-8 col-md-7">
            <div class="panel panel-dashboard">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <i class="icon-trophy3 position-left text-warning"></i> 
                        10 Produk Terlaris (Berdasarkan Qty Terjual)
                    </h5>
                </div>
                <div class="panel-body">
                    <div id="chartTopProduk" style="min-width: 280px; height: 380px;"></div>
                </div>
            </div>
        </div>

        <!-- Top 5 Kasir Performer -->
        <div class="col-lg-4 col-md-5">
            <div class="panel panel-dashboard">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <i class="icon-users2 position-left text-success"></i> 
                        Top 5 Kasir / Operator
                    </h5>
                </div>
                <div class="panel-body" style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table table-dashboard table-hover">
                            <thead>
                                <tr>
                                    <th>Kasir</th>
                                    <th class="text-center">Trx</th>
                                    <th class="text-right">Total Omset</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($q_kasir)) { 
                                    $rank = 1;
                                    foreach ($q_kasir as $kas) { ?>
                                    <tr>
                                        <td>
                                            <span class="badge badge-primary" style="margin-right: 5px;"><?= $rank++ ?></span>
                                            <b><?= htmlspecialchars($kas['nama_pegawai']) ?></b>
                                        </td>
                                        <td class="text-center">
                                            <span class="label label-info"><?= number_format($kas['total_trx'], 0, ',', '.') ?></span>
                                        </td>
                                        <td class="text-right" style="font-weight: 600; color: #047857;">
                                            Rp <?= number_format($kas['total_omset'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php }} else { ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted" style="padding: 25px;">Belum ada data transaksi pada periode ini</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Tambahan -->
            <div class="panel panel-dashboard" style="margin-top: 15px;">
                <div class="panel-heading">
                    <h5 class="panel-title"><i class="icon-info22 position-left text-info"></i> Ringkasan Diskon & Transaksi</h5>
                </div>
                <div class="panel-body" style="padding: 15px 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px dashed #e2e8f0; padding-bottom: 8px;">
                        <span style="color: #64748b;">Total Diskon Diberikan:</span>
                        <b style="color: #dc2626;">Rp <?= number_format($kpi_periode['total_disc'], 0, ',', '.') ?></b>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px dashed #e2e8f0; padding-bottom: 8px;">
                        <span style="color: #64748b;">Total Tunai:</span>
                        <b style="color: #059669;">Rp <?= number_format($kpi_periode['total_tunai'], 0, ',', '.') ?></b>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #64748b;">Total Non-Tunai/Kartu:</span>
                        <b style="color: #2563eb;">Rp <?= number_format($kpi_periode['total_card'], 0, ',', '.') ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Tabel 10 Transaksi Penjualan Terkini -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-dashboard">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <h5 class="panel-title">
                        <i class="icon-history position-left text-teal"></i> 
                        10 Transaksi Penjualan Terkini
                    </h5>
                    <a href="index.php?x=lappenbarang" class="btn btn-default btn-xs" style="border-radius: 4px;">
                        Lihat Semua Laporan <i class="icon-arrow-right13 position-right"></i>
                    </a>
                </div>
                <div class="panel-body" style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table table-dashboard table-hover">
                            <thead>
                                <tr>
                                    <th>No. Penjualan</th>
                                    <th>Tanggal & Jam</th>
                                    <th>Toko / Gudang</th>
                                    <th>Kasir</th>
                                    <th>Pelanggan</th>
                                    <th>Metode Bayar</th>
                                    <th class="text-right">Total Belanja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($q_recent)) { 
                                    foreach ($q_recent as $rc) { 
                                        $is_cash = ($rc['jenis_bayar'] == 1 || empty($rc['jenis_bayar']));
                                        $waktu = !empty($rc['stamp_date']) ? date('d/m/Y H:i', strtotime($rc['stamp_date'])) : date('d/m/Y', strtotime($rc['tgl_penjualan']));
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-family: monospace; font-weight: bold; color: #1e293b;">
                                                <i class="icon-file-text position-left text-muted"></i><?= htmlspecialchars($rc['no_penjualan']) ?>
                                            </span>
                                        </td>
                                        <td><i class="icon-alarm position-left text-muted" style="font-size: 11px;"></i><?= $waktu ?></td>
                                        <td><span class="label label-default" style="background-color: #f1f5f9; color: #334155;"><?= htmlspecialchars($rc['nama_gudang'] ? $rc['nama_gudang'] : '-') ?></span></td>
                                        <td><b><?= htmlspecialchars($rc['nama_pegawai'] ? $rc['nama_pegawai'] : 'Kasir') ?></b></td>
                                        <td><?= htmlspecialchars($rc['pelanggan'] ? $rc['pelanggan'] : 'Umum / Customer') ?></td>
                                        <td>
                                            <?php if ($is_cash) { ?>
                                                <span class="badge-pay-cash"><i class="icon-cash"></i> Tunai</span>
                                            <?php } else { ?>
                                                <span class="badge-pay-card"><i class="icon-credit-card"></i> Kartu/Non-Tunai</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right" style="font-weight: 700; font-size: 14px; color: #047857;">
                                            Rp <?= number_format($rc['grantot_jual'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php }} else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted" style="padding: 30px;">Belum ada transaksi penjualan</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Highcharts Script & Initializations -->
<script type="text/javascript" src="assets/js/js/highcharts.js"></script>
<script type="text/javascript" src="assets/js/js/exporting.js"></script>

<script type="text/javascript">
(function() {
    function initCharts() {
        if (typeof Highcharts === 'undefined') {
            setTimeout(initCharts, 100);
            return;
        }

        // Format Number Helper
        function formatRupiah(num) {
            return 'Rp ' + Number(num).toLocaleString('id-ID');
        }

        var renderChart = function(containerId, options) {
            options.chart = options.chart || {};
            options.chart.renderTo = containerId;
            if (typeof Highcharts.chart === 'function') {
                return Highcharts.chart(containerId, options);
            } else if (typeof Highcharts.Chart === 'function') {
                return new Highcharts.Chart(options);
            } else if (typeof $.fn.highcharts !== 'undefined') {
                return $('#' + containerId).highcharts(options);
            }
        };

        // 1. Chart Tren Penjualan (Area / Spline Chart)
        renderChart('chartTrenPenjualan', {
            chart: {
                type: 'areaspline',
                style: {
                    fontFamily: 'Roboto, "Helvetica Neue", Arial, sans-serif'
                }
            },
            title: {
                text: null
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: <?= json_encode($chart_categories) ?>,
                crosshair: true,
                labels: {
                    style: { color: '#64748b' }
                }
            },
            yAxis: [{
                title: {
                    text: 'Total Omset (Rp)',
                    style: { color: '#3b82f6' }
                },
                labels: {
                    formatter: function () {
                        if (this.value >= 1000000) {
                            return 'Rp ' + (this.value / 1000000).toFixed(1) + ' Jt';
                        } else if (this.value >= 1000) {
                            return 'Rp ' + (this.value / 1000).toFixed(0) + ' Rb';
                        }
                        return 'Rp ' + this.value;
                    },
                    style: { color: '#64748b' }
                }
            }, {
                title: {
                    text: 'Jumlah Transaksi',
                    style: { color: '#8b5cf6' }
                },
                opposite: true,
                labels: {
                    style: { color: '#64748b' }
                }
            }],
            tooltip: {
                shared: true,
                formatter: function () {
                    var s = '<b>' + this.x + '</b><br/>';
                    $.each(this.points, function () {
                        if (this.series.name === 'Omset Penjualan') {
                            s += '<span style="color:' + this.series.color + '">\u25CF</span> ' + this.series.name + ': <b>' + formatRupiah(this.y) + '</b><br/>';
                        } else {
                            s += '<span style="color:' + this.series.color + '">\u25CF</span> ' + this.series.name + ': <b>' + this.y + ' Trx</b><br/>';
                        }
                    });
                    return s;
                }
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.15,
                    lineWidth: 3,
                    marker: {
                        radius: 4,
                        symbol: 'circle'
                    }
                }
            },
            series: [{
                name: 'Omset Penjualan',
                data: <?= json_encode($chart_series_omset) ?>,
                color: '#3b82f6',
                yAxis: 0
            }, {
                name: 'Jumlah Transaksi',
                data: <?= json_encode($chart_series_trx) ?>,
                type: 'spline',
                dashStyle: 'ShortDot',
                color: '#8b5cf6',
                yAxis: 1
            }]
        });

        // 2. Chart Komposisi Metode Pembayaran (Donut Chart)
        renderChart('chartMetodeBayar', {
            chart: {
                type: 'pie',
                style: {
                    fontFamily: 'Roboto, "Helvetica Neue", Arial, sans-serif'
                }
            },
            title: {
                text: null
            },
            credits: {
                enabled: false
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.point.name + '</b><br/>Total: <b>' + formatRupiah(this.y) + '</b> (' + this.percentage.toFixed(1) + '%)';
                }
            },
            plotOptions: {
                pie: {
                    innerSize: '55%',
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f}%',
                        distance: -30,
                        style: {
                            fontSize: '11px',
                            color: '#fff',
                            textOutline: 'none'
                        }
                    },
                    showInLegend: true
                }
            },
            legend: {
                align: 'center',
                verticalAlign: 'bottom',
                layout: 'horizontal'
            },
            series: [{
                name: 'Pembayaran',
                colorByPoint: true,
                data: [{
                    name: 'Tunai (Cash)',
                    y: <?= (float)$kpi_periode['total_tunai'] ?>,
                    color: '#10b981'
                }, {
                    name: 'Non-Tunai / Card',
                    y: <?= (float)$kpi_periode['total_card'] ?>,
                    color: '#3b82f6'
                }]
            }]
        });

        // 3. Chart 10 Produk Terlaris (Horizontal Bar Chart)
        renderChart('chartTopProduk', {
            chart: {
                type: 'bar',
                style: {
                    fontFamily: 'Roboto, "Helvetica Neue", Arial, sans-serif'
                }
            },
            title: {
                text: null
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: <?= json_encode($top_item_names) ?>,
                labels: {
                    style: { fontSize: '11px', color: '#334155' }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Qty Terjual (Pcs)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                formatter: function () {
                    var idx = this.point.index;
                    var omsets = <?= json_encode($top_item_omsets) ?>;
                    var omset_val = (omsets && omsets[idx]) ? formatRupiah(omsets[idx]) : '-';
                    return '<b>' + this.x + '</b><br/>Qty Terjual: <b>' + this.y + ' Pcs</b><br/>Total Omset: <b>' + omset_val + '</b>';
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.y} pcs',
                        style: { fontSize: '11px', fontWeight: 'bold', color: '#334155' }
                    },
                    borderRadius: 4
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Qty Terjual',
                data: <?= json_encode($top_item_qtys) ?>,
                color: '#f59e0b'
            }]
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCharts);
    } else {
        initCharts();
    }
})();
</script>