<?php
error_reporting(0);
$nama = '';
$subnama = '';
$page = $_GET ['x'];
//echo $_GET['id'];
switch ($page) {	//==========================================master=========================================================================
	case "a" :
		$modul = "assets/dashboard/board/index.php";
		$title = "Dashboard";
		$cont = "assets/dashboard/board/js.php";
    break;
	// master satuan
	case "satuan" :
		$modul = "assets/master/satuan/index.php";
		$title = "Master Satuan";
		$cont = "assets/master/satuan/js.php";
    break;
	case "satuan_s" :
		$modul = "assets/master/satuan/simpan.php";
		$title = "Master Satuan";
		$cont = "assets/master/satuan/js.php";
    break;
	
	// master upah dekom
	case "upahdekom" :
		$modul = "assets/master/upah_dekom/index.php";
		$title = "Master Upah Dekom";
		$cont = "assets/master/upah_dekom/js.php";
    break;
	case "upahdekom_s" :
		$modul = "assets/master/upah_dekom/simpan.php";
		$title = "Master Upah Dekom";
		$cont = "assets/master/upah_dekom/js.php";
    break;
	
	case "absenp" :
		$modul = "assets/absen/absenp/index.php";
		$title = "Absensi Pegawai";
		$cont = "assets/absen/absenp/js.php";
    break;
	
	case "klaimktg" :
		$modul = "assets/master/klaimktg/index.php";
		$title = "Master Klaim Kantong";
		$cont = "assets/master/klaimktg/js.php";
    break;
	case "klaimktg_s" :
		$modul = "assets/master/klaimktg/simpan.php";
		$cont = "assets/master/klaimktg/js.php";
    break;
	
	// master plan
	case "plan" :
		$modul = "assets/master/plan/index.php";
		$title = "Master Satuan";
		$cont = "assets/master/plan/js.php";
    break;
	case "plan_s" :
		$modul = "assets/master/plan/simpan.php";
		$title = "Master Plan";
		$cont = "assets/master/plan/js.php";
    break;

	case "parjam" :
		$modul = "assets/hrm/parjam/index.php";
		$title = "Master Parameter Jamsostek";
		$cont = "assets/hrm/parjam/js.php";
    break;
	case "parjam_s" :
		$modul = "assets/hrm/parjam/simpan.php";
		$cont = "assets/hrm/parjam/js.php";
    break;
	
	case "parjab" :
		$modul = "assets/hrm/parjab/index.php";
		$title = "Master Parameter Fasilitas Jabatan";
		$cont = "assets/hrm/parjab/js.php";
    break;
	case "parjab_s" :
		$modul = "assets/hrm/parjab/simpan.php";
		$cont = "assets/hrm/parjab/js.php";
    break;
	
	case "parban" :
		$modul = "assets/hrm/parban/index.php";
		$title = "Master Parameter Ikatan Batin";
		$cont = "assets/hrm/parban/js.php";
    break;
	case "parban_s" :
		$modul = "assets/hrm/parban/simpan.php";
		$cont = "assets/hrm/parban/js.php";
    break;
	
	case "parkel" :
		$modul = "assets/hrm/parkel/index.php";
		$title = "Master Parameter Tunjangan Keluar";
		$cont = "assets/hrm/parkel/js.php";
    break;
	case "parkel_s" :
		$modul = "assets/hrm/parkel/simpan.php";
		$cont = "assets/hrm/parkel/js.php";
    break;
// ================================================= Start Expeditur ===============================================
	// master Expeditur Lokasi Kirim
	case "lokkir" :
		$modul = "assets/master/lokasi_kirim/index.php";
		$title = "Master Lokasi Kirim";
		$cont = "assets/master/lokasi_kirim/js.php";
    break;
	case "lokkir_s" :
		$modul = "assets/master/lokasi_kirim/simpan.php";
		$title = "Master Lokasi Kirim";
		$cont = "assets/master/lokasi_kirim/js.php";
    break;
	
	// master Expeditur pelanggan
	case "expelanggan" :
		$modul = "assets/master/ex_pelanggan/index.php";
		$title = "Master Pelanggan";
		$cont = "assets/master/ex_pelanggan/js.php";
    break;
	case "expelanggan_s" :
		$modul = "assets/master/ex_pelanggan/simpan.php";
		$title = "Master Pelanggan";
		$cont = "assets/master/ex_pelanggan/js.php";
    break;
	// master Expeditur Pricelist
	case "expricelist" :
		$modul = "assets/master/ex_pricelist/index.php";
		$title = "Master Pricelist";
		$cont = "assets/master/ex_pricelist/js.php";
    break;
	case "expricelist_s" :
		$modul = "assets/master/ex_pricelist/simpan.php";
		$title = "Master Pricelist";
		$cont = "assets/master/ex_pricelist/js.php";
    break;
	
	// Transaksi Expediture
	case "txex" :
		$modul = "assets/inventory/tx_expediture/index.php";
		$title = "Transaksi Expediture";
		$cont = "assets/inventory/tx_expediture/js.php";
    break;
	case "txex_s" :
		$modul = "assets/inventory/tx_expediture/simpan.php";
		$title = "Transaksi Expediture";
		$cont = "assets/inventory/tx_expediture/js.php";
    break;
	case "txex_ss" :
		$modul = "assets/inventory/tx_expediture/simpan22.php";
		$title = "Transaksi Expediture";
		$cont = "assets/inventory/tx_expediture/js.php";
    break;
	case "txex_k" :
		$modul = "assets/inventory/tx_expediture/satuan.php";
		$cont = "assets/inventory/tx_expediture/js.php";
    break;
	case "txex_v" :
		$modul = "assets/inventory/tx_expediture/view_stok.php";
		$cont = "assets/inventory/tx_expediture/js_stok.php";
    break;
// ================================================= End Expeditur ===============================================
	// master kategori
	case "asetkategori" :
		$modul = "assets/master/amkategori/index.php";
		$title = "Master Aset Kategori";
		$cont = "assets/master/amkategori/js.php";
    break;
	case "asetkategori_s" :
		$modul = "assets/master/amkategori/simpan.php";
		$title = "Master Aset Kategori";
		$cont = "assets/master/amkategori/js.php";
    break;
	
	// master aset model
	case "asetmodel" :
		$modul = "assets/master/ammodel/index.php";
		$title = "Master Aset Model";
		$cont = "assets/master/ammodel/js.php";
    break;
	case "asetmodel_s" :
		$modul = "assets/master/ammodel/simpan.php";
		$title = "Master Aset Model";
		$cont = "assets/master/ammodel/js.php";
    break;
	
	// master aset Lokasi
	case "asetlokasi" :
		$modul = "assets/master/amlokasi/index.php";
		$title = "Master Aset Lokasi";
		$cont = "assets/master/amlokasi/js.php";
    break;
	case "asetlokasi_s" :
		$modul = "assets/master/amlokasi/simpan.php";
		$title = "Master Aset Lokasi";
		$cont = "assets/master/amlokasi/js.php";
    break;
	
	// master aset Asset
	case "asset" :
		$modul = "assets/master/amasset/index.php";
		$title = "Master Aset";
		$cont = "assets/master/amasset/js.php";
    break;
	case "asset_s" :
		$modul = "assets/master/amasset/simpan.php";
		$title = "Master Aset";
		$cont = "assets/master/amasset/js.php";
    break;
	
	// master aset req
	case "reqdeploy" :
		$modul = "assets/master/amreq/index.php";
		$title = "Master Aset Request";
		$cont = "assets/master/amreq/js.php";
    break;
	case "reqdeploy_s" :
		$modul = "assets/master/amreq/simpan.php";
		$title = "Master Aset Request";
		$cont = "assets/master/amreq/js.php";
    break;
	
	// master aset req
	case "reddep" :
		$modul = "assets/master/amreddep/index.php";
		$title = "Asset Ready to Deploy";
		$cont = "assets/master/amreddep/js.php";
    break;
	case "reddep_s" :
		$modul = "assets/master/amreddep/simpan.php";
		$title = "Asset Ready to Deploy";
		$cont = "assets/master/amreq/js.php";
    break;
	
	case "voidpen" :
		$modul = "assets/inventory/voidpen/index.php";
		$title = "Void Penjualan";
		$cont = "assets/inventory/voidpen/js.php";
    break;
	
	case "voidpen_s" :
		$modul = "assets/inventory/voidpen/simpan.php";
		$title = "Void Penjualan";
		$cont = "assets/inventory/voidpen/js.php";
    break;
	
	// master approve
	case "appasset" :
		$modul = "assets/inventory/app_aset/index.php";
		$title = "Approve Permintaan Asset";
		$cont = "assets/inventory/app_aset/js.php";
    break;
	
	// master approve
	case "app-price" :
		$modul = "assets/inventory/app_pricel/index.php";
		$title = "Approve Pricelist";
		$cont = "assets/inventory/app_pricel/js.php";
    break;
	
	
	case "app_orderpemn" :
		$modul = "assets/inventory/app_orderpemn/index.php";
		$title = "Approve Permintaan Pembelian Barang Non Dagang";
		$cont = "assets/inventory/app_orderpemn/js.php";
    break;
	
	
	case "app_pemba" :
		$modul = "assets/inventory/app_pemba/index.php";
		$title = "Approve Permintaan Pembayaran";
		$cont = "assets/inventory/app_pemba/js.php";
    break;
	
	case "app_pum" :
		$modul = "assets/akutansi/app_pum/index.php";
		$title = "Approve Pengajuan Uang Muka";
		$cont = "assets/akutansi/app_pum/js.php";
    break;
	
	
	case "app_pemba2" :
		$modul = "assets/inventory/app_pemba2/index.php";
		$title = "Approve Permintaan Pembayaran";
		$cont = "assets/inventory/app_pemba2/js.php";
    break;
	case "app_priceex" :
		$modul = "assets/inventory/app_pricelistex/index.php";
		$title = "Approve Permintaan Pricelist Expediture";
		$cont = "assets/inventory/app_pricelistex/js.php";
    break;
	
	// master deployed
	case "deployin" :
		$modul = "assets/master/app_deploy/index.php";
		$title = "Penggunaan Aset";
		$cont = "assets/master/app_deploy/js.php";
    break;
	case "deployin_s" :
		$modul = "assets/master/app_deploy/simpan.php";
		$title = "Penggunaan Aset";
		$cont = "assets/master/app_deploy/js.php";
    break;
	// master undeployed
	case "undeployed" :
		$modul = "assets/master/app_undeploy/index.php";
		$title = "Pengembalian Aset";
		$cont = "assets/master/app_undeploy/js.php";
    break;
	
	// master Remove
	case "remaset" :
		$modul = "assets/master/amremasset/index.php";
		$title = "Penghapusan Aset";
		$cont = "assets/master/amremasset/js.php";
    break;
	case "remaset_v" :
		$modul = "assets/master/amremasset/index2.php";
		$title = "Penghapusan Aset";
		$cont = "assets/master/amremasset/js2.php";
    break;
	case "remaset_s" :
		$modul = "assets/master/amremasset/simpan.php";
		$title = "Penghapusan Aset";
		$cont = "assets/master/amremasset/js2.php";
    break;
	
	
	// master maintenance Asset
	case "mainasset" :
		$modul = "assets/master/ammaintenance/index.php";
		$title = "Maintenance Aset";
		$cont = "assets/master/ammaintenance/js.php";
    break;
	case "mainasset_v" :
		$modul = "assets/master/ammaintenance/index2.php";
		$title = "Maintenance Aset";
		$cont = "assets/master/ammaintenance/js2.php";
    break;
	case "mainasset_s" :
		$modul = "assets/master/ammaintenance/simpan.php";
		$title = "Maintenance Aset";
		$cont = "assets/master/ammaintenance/js2.php";
    break;
	case "mainasset_s1" :
		$modul = "assets/master/ammaintenance/simpan1.php";
		$title = "Maintenance Aset";
		$cont = "assets/master/ammaintenance/js2.php";
    break;
	
	
	// biaya supir
	case "biayasup" :
		$modul = "assets/master/biayasupir/index.php";
		$title = "Biaya Supir";
		$cont = "assets/master/biayasupir/js.php";
    break;
	case "biayasup_s" :
		$modul = "assets/master/biayasupir/simpan.php";
		$title = "Biaya Supir";
		$cont = "assets/master/biayasupir/js.php";
    break;
	case "biayasup_v" :
		$modul = "assets/master/biayasupir/view_stok.php";
		$cont = "assets/master/biayasupir/js_stok.php";
    break;
	// biaya tkbm
	case "tkbm" :
		$modul = "assets/master/tkbm/index.php";
		$title = "Biaya TKBM";
		$cont = "assets/master/tkbm/js.php";
    break;
	case "tkbm_s" :
		$modul = "assets/master/tkbm/simpan.php";
		$title = "Biaya TKBM";
		$cont = "assets/master/tkbm/js.php";
    break;
	case "tkbm_v" :
		$modul = "assets/master/tkbm/view_stok.php";
		$cont = "assets/master/tkbm/js_stok.php";
    break;
	
	// master manualbook
	case "manualb" :
		$modul = "assets/master/manualbook/index.php";
		$title = "Manual Book";
		$cont = "assets/master/manualbook/js.php";
    break;
	case "manualb_s" :
		$modul = "assets/master/manualbook/simpan.php";
		$title = "Manual Book";
		$cont = "assets/master/manualbook/js.php";
    break;
	
	//supplier
	/*case "supplier" :
		$modul = "assets/master/customer/index.php";
		$title = "Master Customer";
		$cont = "assets/master/customer/js.php";
    break;
	case "customer_s" :
		$modul = "assets/master/customer/simpan.php";
		$title = "Master Customer";
		$cont = "assets/master/customer/js.php";
    break;*/
	case "supplier" :
		$modul = "assets/master/supplier/index.php";
		$title = "Master Supplier";
		$cont = "assets/master/supplier/js.php";
    break;
	case "supplier_s" :
		$modul = "assets/master/supplier/simpan.php";
		$title = "Master Supplier";
		$cont = "assets/master/supplier/js.php";
    break;
	// master marchendise			
	case "marchandise" :
		$modul = "assets/master/marchandise/index.php";
		$title = "Master Satuan";
		$cont = "assets/master/marchandise/js.php";
    break;
	case "marchandise_s" :
		$modul = "assets/master/marchandise/simpan.php";
		$title = "Master Satuan";
		$cont = "assets/master/marchandise/js.php";
    break;
	// master barang
	case "barang" :
		$modul = "assets/master/barang/index.php";
		$title = "Master Satuan";
		$cont = "assets/master/barang/js.php";
    break;
	case "barang_s" :
		$modul = "assets/master/barang/simpan.php";
		$title = "Master Satuan";
		$cont = "assets/master/barang/js.php";
    break;
	// master barang
	case "upahhar" :
		$modul = "assets/master/upahhar/index.php";
		$title = "Master Upah Harian";
		$cont = "assets/master/upahhar/js.php";
    break;
	case "upahhar_s" :
		$modul = "assets/master/upahhar/simpan.php";
		$title = "Master Upah Harian";
		$cont = "assets/master/upahhar/js.php";
    break;
	
	// master Price List
	case "pricel" :
		$modul = "assets/master/pricel/index.php";
		$title = "Master Price List";
		$cont = "assets/master/pricel/js.php";
    break;
	case "pricel_s" :
		$modul = "assets/master/pricel/simpan.php";
		$title = "Master Pricel List";
		$cont = "assets/master/pricel/js.php";
    break;
	case "pricel_k" :
		$modul = "assets/master/pricel/satuan.php";
		$cont = "assets/master/pricel/js.php";
    break;
	case "pricel_v" :
		$modul = "assets/master/pricel/view_price.php";
		$cont = "assets/master/pricel/js_price.php";
    break;
	// master Price List jual
	case "pricel_jual" :
		$modul = "assets/master/pricel_jual/index.php";
		$title = "Master Price List Jual";
		$cont = "assets/master/pricel_jual/js.php";
    break;
	case "pricel_jual_s" :
		$modul = "assets/master/pricel_jual/simpan.php";
		$title = "Master Pricel List Jual";
		$cont = "assets/master/pricel_jual/js.php";
    break;
	case "pricel_jual_k" :
		$modul = "assets/master/pricel_jual/satuan.php";
		$cont = "assets/master/pricel_jual/js.php";
    break;
	case "pricel_jual_v" :
		$modul = "assets/master/pricel_jual/view_price.php";
		$cont = "assets/master/pricel_jual/js_price.php";
    break;
	// master upload so
	case "up_so" :
		$modul = "assets/inventory/up_so/index.php";
		$title = "Upload SO Semen";
		$cont = "assets/inventory/up_so/js.php";
    break;
	case "up_so_s" :
		$modul = "assets/inventory/up_so/simpan.php";
		$title = "Upload SO Semen";
		$cont = "assets/inventory/up_so/js.php";
    break;
	case "up_so_k" :
		$modul = "assets/inventory/up_so/satuan.php";
		$cont = "assets/inventory/up_so/js.php";
    break;
	case "up_so_v" :
		$modul = "assets/inventory/up_so/view_price.php";
		$cont = "assets/inventory/up_so/js_price.php";
    break;
	case "fakturpajak" :
		$modul = "assets/master/fakturpajak/index.php";
		$title = "Faktur Pajak";
		$cont = "assets/master/fakturpajak/js.php";
    break;
	case "fakturpajak_s" :
		$modul = "assets/master/fakturpajak/simpan.php";
		$title = "Faktur Pajak";
		$cont = "assets/master/fakturpajak/js.php";
    break;
	// master upload abs
	case "upabsen" :
		$modul = "assets/hrm/upabsen/index.php";
		$title = "Upload Absensi";
		$cont = "assets/hrm/upabsen/js.php";
    break;
	case "upabsen_s" :
		$modul = "assets/hrm/upabsen/simpan.php";
		$title = "Upload Absensi";
		$cont = "assets/hrm/upabsen/js.php";
    break;
	case "upabsen_k" :
		$modul = "assets/hrm/upabsen/satuan.php";
		$cont = "assets/hrm/upabsen/js.php";
    break;
	case "upabsen_v" :
		$modul = "assets/hrm/upabsen/view_price.php";
		$cont = "assets/hrm/upabsen/js_price.php";
    break;
	
	// master upload rilis
	case "up_rilis" :
		$modul = "assets/inventory/up_rilis/index.php";
		$title = "Upload SO Semen";
		$cont = "assets/inventory/up_rilis/js.php";
    break;
	case "up_rilis_s" :
		$modul = "assets/inventory/up_rilis/simpan.php";
		$title = "Upload SO Semen";
		$cont = "assets/inventory/up_rilis/js.php";
    break;
	case "up_rilis_k" :
		$modul = "assets/inventory/up_rilis/satuan.php";
		$cont = "assets/inventory/up_rilis/js.php";
    break;
	case "up_rilis_v" :
		$modul = "assets/inventory/up_rilis/view_price.php";
		$cont = "assets/inventory/up_rilis/js_price.php";
    break;
	case "sttb_rilis" :
		$modul = "assets/inventory/sttb_rilis/index.php";
		$title = "Detil SO Rilis";
		$cont = "assets/inventory/sttb_rilis/js.php";
    break;
	
	// master valuta			
	case "valuta" :
		$modul = "assets/master/valuta/index.php";
		$title = "Master Valuta";
		$cont = "assets/master/valuta/js.php";
    break;
	case "valuta_s" :
		$modul = "assets/master/valuta/simpan.php";
		$title = "Master Valuta";
		$cont = "assets/master/valuta/js.php";
    break;
	// master bbm			
	case "hargabbm" :
		$modul = "assets/master/hargabbm/index.php";
		$title = "Master Valuta";
		$cont = "assets/master/hargabbm/js.php";
    break;
	case "hargabbm_s" :
		$modul = "assets/master/hargabbm/simpan.php";
		$title = "Master Valuta";
		$cont = "assets/master/hargabbm/js.php";
    break;
	// master tunjangan			
	case "tunjangan" :
		$modul = "assets/master/tunjangan/index.php";
		$title = "Master Tunjangan";
		$cont = "assets/master/tunjangan/js.php";
    break;
	case "tunjangan_s" :
		$modul = "assets/master/tunjangan/simpan.php";
		$title = "Master Tunjangan";
		$cont = "assets/master/tunjangan/js.php";
    break;
	// master pelanggaran			
	case "pelanggaran" :
		$modul = "assets/hrm/pelanggaran/index.php";
		$title = "Pelanggaran Karyawan";
		$cont = "assets/hrm/pelanggaran/js.php";
    break;
	case "pelanggaran_s" :
		$modul = "assets/hrm/pelanggaran/simpan.php";
		$title = "Pelanggaran Karyawan";
		$cont = "assets/hrm/pelanggaran/js.php";
    break;
	// master penghargaan			
	case "penghargaan" :
		$modul = "assets/hrm/penghargaan/index.php";
		$title = "Penghargaan Karyawan";
		$cont = "assets/hrm/penghargaan/js.php";
    break;
	case "penghargaan_s" :
		$modul = "assets/hrm/penghargaan/simpan.php";
		$title = "Penghargaan Karyawan";
		$cont = "assets/hrm/penghargaan/js.php";
    break;
	// master potongan 			
	case "potongan" :
		$modul = "assets/hrm/potongan/index.php";
		$title = "Potongan";
		$cont = "assets/hrm/potongan/js.php";
    break;
	case "potongan_s" :
		$modul = "assets/hrm/potongan/simpan.php";
		$title = "Potongan";
		$cont = "assets/hrm/potongan/js.php";
    break;
	// master potongan 			
	case "nilaipeg" :
		$modul = "assets/hrm/nilaipeg/index.php";
		$title = "Penilaian Pegawai";
		$cont = "assets/hrm/nilaipeg/js.php";
    break;
	case "nilaipeg_s" :
		$modul = "assets/hrm/nilaipeg/simpan.php";
		$title = "Penilaian Pegawai";
		$cont = "assets/hrm/nilaipeg/js.php";
    break;
	// master potongan 			
	case "operasional" :
		$modul = "assets/hrm/operasional/index.php";
		$title = "Operasional";
		$cont = "assets/hrm/operasional/js.php";
    break;
	case "operasional_s" :
		$modul = "assets/hrm/operasional/simpan.php";
		$title = "Operasional";
		$cont = "assets/hrm/operasional/js.php";
    break;
	// master jenis jual			
	case "jenis_jual" :
		$modul = "assets/master/jenis_jual/index.php";
		$title = "Master Jenis Penjualan";
		$cont = "assets/master/jenis_jual/js.php";
    break;
	case "jenis_jual_s" :
		$modul = "assets/master/jenis_jual/simpan.php";
		$title = "Master Jenis Penjualan";
		$cont = "assets/master/jenis_jual/js.php";
    break;
	// master tarif kirim			
	case "tarif_kirim" :
		$modul = "assets/master/tarif_kirim/index.php";
		$title = "Master Tarif Pengiriman";
		$cont = "assets/master/tarif_kirim/js.php";
    break;
	case "tarif_kirim_s" :
		$modul = "assets/master/tarif_kirim/simpan.php";
		$title = "Master Tarif Pengiriman";
		$cont = "assets/master/tarif_kirim/js.php";
    break;
	
	
	// master group inven			
	case "grup_inven" :
		$modul = "assets/master/grup_inven/index.php";
		$title = "Master Group Inventory";
		$cont = "assets/master/grup_inven/js.php";
    break;
	case "grup_inven_s" :
		$modul = "assets/master/grup_inven/simpan.php";
		$title = "Master Group Inventory";
		$cont = "assets/master/grup_inven/js.php";
    break;
	
	// master cabang			
	case "cabang" :
		$modul = "assets/master/cabang/index.php";
		$title = "Master Cabang";
		$cont = "assets/master/cabang/js.php";
    break;
	case "cabang_s" :
		$modul = "assets/master/cabang/simpan.php";
		$title = "Master Cabang";
		$cont = "assets/master/cabang/js.php";
    break;
	// master perusahaan			
	case "perusahaan" :
		$modul = "assets/master/perusahaan/index.php";
		$title = "Master Perusahaan";
		$cont = "assets/master/perusahaan/js.php";
    break;
	case "perusahaan_s" :
		$modul = "assets/master/perusahaan/simpan.php";
		$title = "Master Perusahaan";
		$cont = "assets/master/perusahaan/js.php";
    break;
	// master wilyaha			
	case "wilayah" :
		$modul = "assets/master/wilayah/index.php";
		$title = "Master Wilayah";
		$cont = "assets/master/wilayah/js.php";
    break;
	case "wilayah_s" :
		$modul = "assets/master/wilayah/simpan.php";
		$title = "Master Wilayah";
		$cont = "assets/master/wilayah/js.php";
    break;
	
	// master wilyaha			
	case "negara" :
		$modul = "assets/master/negara/index.php";
		$title = "Master Negara";
		$cont = "assets/master/negara/js.php";
    break;
	case "negara_s" :
		$modul = "assets/master/negara/simpan.php";
		$title = "Master Negara";
		$cont = "assets/master/negara/js.php";
    break;
	
	// master wilayah pem			
	case "wilayahpem" :
		$modul = "assets/master/wilayahpemasaran/index.php";
		$title = "Master Wilayah Pemasaran";
		$cont = "assets/master/wilayahpemasaran/js.php";
    break;
	case "wilayahpem_s" :
		$modul = "assets/master/wilayahpemasaran/simpan.php";
		$title = "Master Wilayah Pemasaran";
		$cont = "assets/master/wilayahpemasaran/js.php";
    break;
	
	
	// master Regional AVP			
	case "regavp" :
		$modul = "assets/master/regavp/index.php";
		$title = "Master Regional AVP";
		$cont = "assets/master/regavp/js.php";
    break;
	case "regavp_s" :
		$modul = "assets/master/regavp/simpan.php";
		$cont = "assets/master/regavp/js.php";
    break;
	
	
	// master area			
	case "area" :
		$modul = "assets/master/area/index.php";
		$title = "Master Area";
		$cont = "assets/master/area/js.php";
    break;
	case "area_s" :
		$modul = "assets/master/area/simpan.php";
		$title = "Master Area";
		$cont = "assets/master/area/js.php";
    break;
	// master daerah			
	case "daerah" :
		$modul = "assets/master/daerah/index.php";
		$title = "Master Daerah";
		$cont = "assets/master/daerah/js.php";
    break;
	case "daerah_s" :
		$modul = "assets/master/daerah/simpan.php";
		$title = "Master Daerah";
		$cont = "assets/master/daerah/js.php";
    break;
	// master profit			
	case "profit" :
		$modul = "assets/master/profit/index.php";
		$title = "Master Profit";
		$cont = "assets/master/profit/js.php";
    break;
	case "profit_s" :
		$modul = "assets/master/profit/simpan.php";
		$title = "Master Profit";
		$cont = "assets/master/profit/js.php";
    break;
	// master tahap			
	case "tahap" :
		$modul = "assets/master/tahap/index.php";
		$title = "Master Tahap";
		$cont = "assets/master/tahap/js.php";
    break;
	case "tahap_s" :
		$modul = "assets/master/tahap/simpan.php";
		$title = "Master Tahap";
		$cont = "assets/master/tahap/js.php";
    break;
	case "umuraging" :
		$modul = "assets/master/umuraging/index.php";
		$title = "Master Umur Aging";
		$cont = "assets/master/umuraging/js.php";
    break;
	case "umuraging_s" :
		$modul = "assets/master/umuraging/simpan.php";
		$title = "Master Umur Aging";
		$cont = "assets/master/umuraging/js.php";
    break;
	// master retribusi			
	case "retribusi" :
		$modul = "assets/master/retribusi/index.php";
		$title = "Master Tahap";
		$cont = "assets/master/retribusi/js.php";
    break;
	case "retribusi_s" :
		$modul = "assets/master/retribusi/simpan.php";
		$title = "Master Tahap";
		$cont = "assets/master/retribusi/js.php";
    break;
	// master biaya retribusi			
	case "biayaretribusi" :
		$modul = "assets/master/biayaretribusi/index.php";
		$title = "Master Tahap";
		$cont = "assets/master/biayaretribusi/js.php";
    break;
	case "biayaretribusi_s" :
		$modul = "assets/master/biayaretribusi/simpan.php";
		$title = "Master Tahap";
		$cont = "assets/master/biayaretribusi/js.php";
    break;
	// master biaya retribusi			
	case "biayaretrisupp" :
		$modul = "assets/master/biayaretrisupp/index.php";
		$title = "Master Biaya Retribusi Supplier";
		$cont = "assets/master/biayaretrisupp/js.php";
    break;
	case "biayaretrisupp_s" :
		$modul = "assets/master/biayaretrisupp/simpan.php";
		$title = "Master Biaya Retribusi Supplier";
		$cont = "assets/master/biayaretrisupp/js.php";
    break;
	// master jenis			
	case "jen_kend" :
		$modul = "assets/master/jenis_kendaraan/index.php";
		$title = "Master Jenis Kendaraan";
		$cont = "assets/master/jenis_kendaraan/js.php";
    break;
	case "jen_kend_s" :
		$modul = "assets/master/jenis_kendaraan/simpan.php";
		$title = "Master Jenis Kendaraan";
		$cont = "assets/master/jenis_kendaraan/js.php";
    break;
	case "jen_kend_d" :
		$modul = "assets/master/jenis_kendaraan/indexsub.php";
		$title = "Master Jenis Kendaraan";
		$cont = "assets/master/jenis_kendaraan/js_sub.php";
    break;
	case "jen_kend_ds" :
		$modul = "assets/master/jenis_kendaraan/simpan2.php";
		$title = "Master Jenis Kendaraan";
		$cont = "assets/master/jenis_kendaraan/js_sub.php";
    break;
	// master user			
	case "user" :
		$modul = "assets/master/user/index.php";
		$title = "Master User";
		$cont = "assets/master/user/js.php";
    break;
	case "user_s" :
		$modul = "assets/master/user/simpan.php";
		$title = "Master User";
		$cont = "assets/master/user/js.php";
    break;
	
	// master role			
	case "role" :
		$modul = "assets/master/role/index.php";
		$title = "Master Role";
		$cont = "assets/master/role/js.php";
    break;
	case "role_s" :
		$modul = "assets/master/role/simpan.php";
		$title = "Master Role";
		$cont = "assets/master/role/js.php";
    break;
	
	// master upahbor
	case "upahbor" :
		$modul = "assets/master/upahborjenis/index.php";
		$title = "Master Upah Borongan";
		$cont = "assets/master/upahborjenis/js.php";
    break;
	case "upahbor_s" :
		$modul = "assets/master/upahborjenis/simpan.php";
		$title = "Master Upah Borongan";
		$cont = "assets/master/upahborjenis/js.php";
    break;
	
	// master divisi			
	case "divisi" :
		$modul = "assets/master/divisi/index.php";
		$title = "Master Divisi";
		$cont = "assets/master/divisi/js.php";
    break;
	case "divisi_s" :
		$modul = "assets/master/divisi/simpan.php";
		$title = "Master Divisi";
		$cont = "assets/master/divisi/js.php";
    break;
	// master jabatan			
	case "jabatan" :
		$modul = "assets/master/jabatan/index.php";
		$title = "Master Jabatan";
		$cont = "assets/master/jabatan/js.php";
    break;
	case "jabatan_s" :
		$modul = "assets/master/jabatan/simpan.php";
		$title = "Master Jabatan";
		$cont = "assets/master/jabatan/js.php";
	break;	
		// master Agama			
	case "agama" :
		$modul = "assets/master/agama/index.php";
		$title = "Master Agama";
		$cont = "assets/master/agama/js.php";
    break;
	case "agama_s" :
		$modul = "assets/master/agama/simpan.php";
		$title = "Master Agama";
		$cont = "assets/master/agama/js.php";
    break;
	
	// master Gapok			
	case "gapok" :
		$modul = "assets/master/gapok/index.php";
		$title = "Master Gaji Pokok";
		$cont = "assets/master/gapok/js.php";
    break;
	case "gapok_s" :
		$modul = "assets/master/gapok/simpan.php";
		$title = "Master Gaji Pokok";
		$cont = "assets/master/gapok/js.php";
    break;
	// master sehat			
	case "tunsehat" :
		$modul = "assets/master/tunsehat/index.php";
		$title = "Master Tunjangan Sehat";
		$cont = "assets/master/tunsehat/js.php";
    break;
	case "tunsehat_s" :
		$modul = "assets/master/tunsehat/simpan.php";
		$title = "Master Tunjangan Sehat";
		$cont = "assets/master/tunsehat/js.php";
    break;
		// master potop			
	case "potop" :
		$modul = "assets/master/potop/index.php";
		$title = "Master Potongan & Operasional";
		$cont = "assets/master/potop/js.php";
    break;
	case "potop_s" :
		$modul = "assets/master/potop/simpan.php";
		$title = "Master Potongan & Operasional";
		$cont = "assets/master/potop/js.php";
    break;
	
	// master Tigol			
	case "tigol" :
		$modul = "assets/master/tigol/index.php";
		$title = "Master Tingkat Golongan";
		$cont = "assets/master/tigol/js.php";
    break;
	case "tigol_s" :
		$modul = "assets/master/tigol/simpan.php";
		$title = "Master Tingkat Golongan";
		$cont = "assets/master/tigol/js.php";
    break;
	
	// master kopeg			
	case "kopeg" :
		$modul = "assets/master/kopeg/index.php";
		$title = "Master Pola Pembayaran";
		$cont = "assets/master/kopeg/js.php";
    break;
	case "kopeg_s" :
		$modul = "assets/master/kopeg/simpan.php";
		$title = "Master Kontrak Pegawai";
		$cont = "assets/master/kopeg/js.php";
    break;
	
	// master pangkat			
	case "pangkat" :
		$modul = "assets/master/pangkat/index.php";
		$title = "Master Pangkat";
		$cont = "assets/master/pangkat/js.php";
    break;
	case "pangkat_s" :
		$modul = "assets/master/pangkat/simpan.php";
		$title = "Master Pangkat";
		$cont = "assets/master/pangkat/js.php";
    break;
	// master stjab			
	case "stjab" :
		$modul = "assets/master/stjab/index.php";
		$title = "Master Status Jabatan";
		$cont = "assets/master/stjab/js.php";
    break;
	case "stjab_s" :
		$modul = "assets/master/stjab/simpan.php";
		$title = "Master Status Jabatan";
		$cont = "assets/master/stjab/js.php";
    break;
	
	// master stakeluarga			
	case "stakel" :
		$modul = "assets/master/stakel/index.php";
		$title = "Master Status Keluarga";
		$cont = "assets/master/stakel/js.php";
    break;
	case "stakel_s" :
		$modul = "assets/master/stakel/simpan.php";
		$title = "Master Status Keluarga";
		$cont = "assets/master/stakel/js.php";
    break;
	
	// master Nilai Dasar			
	case "nilaidasar" :
		$modul = "assets/master/nilaidasar/index.php";
		$title = "Master Nilai Dasar";
		$cont = "assets/master/nilaidasar/js.php";
    break;
	case "nilaidasar_s" :
		$modul = "assets/master/nilaidasar/simpan.php";
		$title = "Master Nilai Dasar";
		$cont = "assets/master/nilaidasar/js.php";
    break;
	
	// master golongan			
	case "golongan" :
		$modul = "assets/master/golongan/index.php";
		$title = "Master Golongan";
		$cont = "assets/master/golongan/js.php";
    break;
	case "golongan_s" :
		$modul = "assets/master/golongan/simpan.php";
		$title = "Master Golongan";
		$cont = "assets/master/golongan/js.php";
    break;
	
	// master pegawai			
	case "pegawai" :
		$modul = "assets/master/pegawai/index.php";
		$title = "Master Pegawai";
		$cont = "assets/master/pegawai/js.php";
    break;
	case "pegawai_s" :
		$modul = "assets/master/pegawai/simpan.php";
		$title = "Master Pegawai";
		$cont = "assets/master/pegawai/js.php";
    break;
	
	
	// master gudang			
	case "gudang" :
		$modul = "assets/master/gudang/index.php";
		$title = "Master Gudang";
		$cont = "assets/master/gudang/js.php";
    break;
	case "gudang_s" :
		$modul = "assets/master/gudang/simpan.php";
		$title = "Master Gudang";
		$cont = "assets/master/gudang/js.php";
    break;
	
	
	// master customer			
	case "customer" :
		$modul = "assets/master/customer/index.php";
		$title = "Master Customer";
		$cont = "assets/master/customer/js.php";
    break;
	case "customer_s" :
		$modul = "assets/master/customer/simpan.php";
		$title = "Master Customer";
		$cont = "assets/master/customer/js.php";
    break;
	
	
	// edit user			
	case "edituser" :
		$modul = "assets/master/edituser/index.php";
		$title = "Edit User";
		$cont = "assets/master/edituser/js.php";
    break;
	case "edituser_s" :
		$modul = "assets/master/edituser/simpan.php";
		$title = "Edit User";
		$cont = "assets/master/edituser/js.php";
    break;
	//==========================================master=========================================================================
	
	//==========================================transaksi=========================================================================
	// master order
	case "order" :
		$modul = "assets/inventory/order/index.php";
		$title = "Permintaan Barang";
		$cont = "assets/inventory/order/js.php";
    break;
	case "order_s" :
		$modul = "assets/inventory/order/simpan.php";
		$title = "Permintaan Barang";
		$cont = "assets/inventory/order/js.php";
    break;
	case "order_k" :
		$modul = "assets/inventory/order/satuan.php";
		$cont = "assets/inventory/order/js.php";
    break;
	case "order_v" :
		$modul = "assets/inventory/order/view_order.php";
		$cont = "assets/inventory/order/js_order.php";
    break;
	case "order_c" :
		$modul = "assets/inventory/order/cetak.php";
    break;
	
	case "orderpemn" :
		$modul = "assets/inventory/orderpemn/index.php";
		$title = "Permintaan Barang Non Semen";
		$cont = "assets/inventory/orderpemn/js.php";
    break;
	case "orderpemn_s" :
		$modul = "assets/inventory/orderpemn/simpan.php";
		$title = "Permintaan Barang Non Semen";
		$cont = "assets/inventory/orderpemn/js.php";
    break;
	case "orderpemn_k" :
		$modul = "assets/inventory/orderpemn/satuan.php";
		$cont = "assets/inventory/orderpemn/js.php";
    break;
	case "orderpemn_v" :
		$modul = "assets/inventory/orderpemn/view_order.php";
		$cont = "assets/inventory/orderpemn/js_order.php";
    break;
	//transit
	case "transit" :
		$modul = "assets/inventory/transit/index.php";
		$title = "Permintaan Transit Barang";
		$cont = "assets/inventory/transit/js.php";
    break;
	case "transit_s" :
		$modul = "assets/inventory/transit/simpan.php";
		$title = "Permintaan Transit Barang";
		$cont = "assets/inventory/ordetransitr/js.php";
    break;
	case "transit_k" :
		$modul = "assets/inventory/transit/satuan.php";
		$cont = "assets/inventory/transit/js.php";
    break;
	case "transit_v" :
		$modul = "assets/inventory/transit/view_order.php";
		$cont = "assets/inventory/transit/js_order.php";
    break;
	case "transit_c" :
		$modul = "assets/inventory/transit/cetak.php";
    break;
	
	
	case "pengbum" :
		$modul = "assets/inventory/pengbum/index.php";
		$title = "Permintaan Penggunaan Barang Umum";
		$cont = "assets/inventory/pengbum/js.php";
    break;
	case "pengbum_s" :
		$modul = "assets/inventory/pengbum/simpan.php";
		$title = "Permintaan Transit Barang";
		$cont = "assets/inventory/pengbum/js.php";
    break;
	case "pengbum_v" :
		$modul = "assets/inventory/pengbum/view_order.php";
		$title = "Permintaan Transit Barang";
		$cont = "assets/inventory/pengbum/js_order.php";
    break;
	
	case "pengbum_kel" :
		$modul = "assets/inventory/pengbum_kel/index.php";
		$title = "Permintaan Penggunaan Barang Umum";
		$cont = "assets/inventory/pengbum_kel/js.php";
    break;
	case "pengbum_kel_s" :
		$modul = "assets/inventory/pengbum_kel/simpan.php";
		$title = "Permintaan Transit Barang";
		$cont = "assets/inventory/pengbum_kel/js.php";
    break;
	case "pengbum_kel_v" :
		$modul = "assets/inventory/pengbum_kel/view_order.php";
		$title = "Permintaan Transit Barang";
		$cont = "assets/inventory/pengbum_kel/js_order.php";
    break;
	// master Stok_Opname
	case "so" :
		$modul = "assets/inventory/stok_opname/index.php";
		$title = "Master Stok Opname";
		$cont = "assets/inventory/stok_opname/js.php";
    break;
	case "so_s" :
		$modul = "assets/inventory/stok_opname/simpan.php";
		$title = "Master Stok Opname";
		$cont = "assets/inventory/stok_opname/js.php";
    break;
	case "so_k" :
		$modul = "assets/inventory/stok_opname/satuan.php";
		$cont = "assets/inventory/stok_opname/js.php";
    break;
	case "so_v" :
		$modul = "assets/inventory/stok_opname/view_stok.php";
		$cont = "assets/inventory/stok_opname/js_stok.php";
    break;
	
	// master order bm
	case "order_bm" :
		$modul = "assets/inventory/order_bm/index.php";
		$title = "Permintaan Barang";
		$cont = "assets/inventory/order_bm/js.php";
    break;
	case "order_bm_s" :
		$modul = "assets/inventory/order_bm/simpan.php";
		$title = "Permintaan Barang";
		$cont = "assets/inventory/order_bm/js.php";
    break;
	case "order_bm_k" :
		$modul = "assets/inventory/order_bm/satuan.php";
		$cont = "assets/inventory/order_bm/js.php";
    break;
	case "order_bm_v" :
		$modul = "assets/inventory/order_bm/view_order.php";
		$cont = "assets/inventory/order_bm/js_order.php";
    break;
	case "brgmasuk2" :
		$modul = "assets/inventory/brg_masuk_nonpo/index.php";
		$title = "Penerimaan Barang (Non PO)";
		$cont = "assets/inventory/brg_masuk_nonpo/js.php";
    break;
	case "brgmasuk2_s" :
		$modul = "assets/inventory/brg_masuk_nonpo/simpan.php";
		$title = "Penerimaan Barang (Non PO)";
		$cont = "assets/inventory/brg_masuk_nonpo/js.php";
    break;
	case "brgmasuk2_ss" :
		$modul = "assets/inventory/brg_masuk_nonpo/simpan2.php";
		$title = "Penerimaan Barang (Non PO)";
		$cont = "assets/inventory/brg_masuk_nonpo/js.php";
    break;
	//  order sales
	case "salesorder" :
		$modul = "assets/inventory/salesorder/index.php";
		$title = "Permintaan Barang";
		$cont = "assets/inventory/salesorder/js.php";
    break;
	case "salesorder_s" :
		$modul = "assets/inventory/salesorder/simpan.php";
		$title = "Permintaan Barang";
		$cont = "assets/inventory/salesorder/js.php";
    break;
	case "salesorder_k" :
		$modul = "assets/inventory/salesorder/satuan.php";
		$cont = "assets/inventory/salesorder/js.php";
    break;
	case "salesorder_v" :
		$modul = "assets/inventory/salesorder/view_order.php";
		$cont = "assets/inventory/salesorder/js_order.php";
    break;
	
	//pj_penjualan
	case"penjualangro":
		$modul = "assets/inventory/penjualangro/index.php";
		$title = "Penjualan Grosir";
		$cont  = "assets/inventory/penjualangro/js.php";
	break;
	case "penjualangro_s" :
		$modul = "assets/inventory/penjualangro/simpan.php";
		$title = "Penjualan Grosir";
		$cont = "assets/inventory/penjualangro/js.php";
    break;
	case "penjualangro_t" :
		$modul = "assets/inventory/penjualangro/simpan2.php";
		$title = "Penjualan Grosir";
		$cont = "assets/inventory/penjualangro/js.php";
    break;
	case "penjualangro_b" :
		$modul = "assets/inventory/penjualangro/batal.php";
		$title = "Penjualan Grosir";
		$cont = "assets/inventory/penjualangro/js.php";
    break;
	
	case"penjualan":
		$modul = "assets/inventory/penjualan/index.php";
		$title = "Penjualan Retail";
		$cont  = "assets/inventory/penjualan/js.php";
	break;
	case "penjualan_s" :
		$modul = "assets/inventory/penjualan/simpan.php";
		$title = "Penjualan Retail";
		$cont = "assets/inventory/penjualan/js.php";
    break;
    case "penjualan_ss" :
		$modul = "assets/inventory/penjualan/simpan3.php";
		$title = "Penjualan Retail";
		$cont = "assets/inventory/penjualan/js.php";
    break;
	
	case "penjualan_t" :
		$modul = "assets/inventory/penjualan/simpan2.php";
		$title = "Penjualan Retail";
		$cont = "assets/inventory/penjualan/js.php";
    break;
	case "penjualan_b" :
		$modul = "assets/inventory/penjualan/batal.php";
		$title = "Penjualan Retail";
		$cont = "assets/inventory/penjualan/js.php";
    break;

    case "setorkas" : 
		$modul = "assets/inventory/penjualan/setorkas.php";
		$title = "Setor Kas Penjualan";
		$cont = "assets/inventory/penjualan/js2.php";
    break;
    case "setorkas_s" : 
		$modul = "assets/inventory/penjualan/simpan_setor.php";
		$title = "Setor Kas Penjualan";
		$cont = "assets/inventory/penjualan/js2.php";
    break;

	//  jual riject
	case "jualriject" :
		$modul = "assets/inventory/jualriject/index.php";
		$title = "Penjualan Barang Riject";
		$cont = "assets/inventory/jualriject/js.php";
    break;
	case "jualriject_s" :
		$modul = "assets/inventory/jualriject/simpan.php";
		$title = "Penjualan Barang Riject";
		$cont = "assets/inventory/jualriject/js.php";
    break;
	case "jualriject_k" :
		$modul = "assets/inventory/jualriject/satuan.php";
		$cont = "assets/inventory/jualriject/js.php";
    break;
	case "jualriject_v" :
		$modul = "assets/inventory/jualriject/view_order.php";
		$title = "Penjualan Barang Riject";
		$cont = "assets/inventory/jualriject/js_order.php";
    break;
	// master prp
	case "prp" :
		$modul = "assets/inventory/prp/index.php";
		$title = "Permintaan Pembelian";
		$cont = "assets/inventory/prp/js.php";
    break;
	case "prp_s" :
		$modul = "assets/inventory/prp/simpan.php";
		$title = "Permintaan Pembelian";
		$cont = "assets/inventory/prp/js.php";
    break;
	case "po_ss" :
		$modul = "assets/inventory/po/simpan_up.php";
		$cont = "assets/inventory/po/js.php";
    break;
	case "prp_k" :
		$modul = "assets/inventory/prp/satuan.php";
		$cont = "assets/inventory/prp/js.php";
    break;
	case "prp_v" :
		$modul = "assets/inventory/prp/view_order.php";
		$cont = "assets/inventory/prp/js_order.php";
    break;
	case "prp_notif" :
		$modul = "assets/inventory/prp/index_notif.php";
		$title = "Notif Minimum Barang";
		$cont = "assets/inventory/prp/js_notif.php";
    break;
	case "prp_notif_s" :
		$modul = "assets/inventory/prp/simpan_notif.php";
		$cont = "assets/inventory/prp/js_notif.php";
    break;
	// Retur
	case "retur" :
		$modul = "assets/inventory/retur/index.php";
		$title = "Retur Pembelian";
		$cont = "assets/inventory/retur/js.php";
    break;
	case "retur_s" :
		$modul = "assets/inventory/retur/simpan.php";
		$title = "Retur Pembelian";
		$cont = "assets/inventory/retur/js.php";
    break;
	case "retur_k" :
		$modul = "assets/inventory/retur/satuan.php";
		$cont = "assets/inventory/retur/js.php";
    break;
	case "retur_v" :
		$modul = "assets/inventory/retur/view_stok.php";
		$cont = "assets/inventory/retur/js_stok.php";
    break;
	case "retur_c" :
		$modul = "assets/inventory/retur/cetak.php";
		$cont = "assets/inventory/retur/js_stok.php";
    break;	
	
	// claim pb
	case "claimpb" :
		$modul = "assets/inventory/claimpb/index.php";
		$title = "Claim Pabrik";
		$cont = "assets/inventory/claimpb/js.php";
    break;
	case "claimpb_s" :
		$modul = "assets/inventory/claimpb/simpan.php";
		$cont = "assets/inventory/claimpb/js.php";
    break;
	case "claimpb_k" :
		$modul = "assets/inventory/claimpb/satuan.php";
		$cont = "assets/inventory/claimpb/js.php";
    break;
	case "claimpb_v" :
		$modul = "assets/inventory/claimpb/view_stok.php";
		$cont = "assets/inventory/claimpb/js_stok.php";
    break;
	
	
	// Retur
	case "lembur" :
		$modul = "assets/hrm/lembur/index.php";
		$title = "Form Lembur";
		$cont = "assets/hrm/lembur/js.php";
    break;
	case "lembur_s" :
		$modul = "assets/hrm/lembur/simpan.php";
		$title = "Form Lembur";
		$cont = "assets/hrm/lembur/js.php";
    break;
	case "lembur_v" :
		$modul = "assets/hrm/lembur/view_stok.php";
		$cont = "assets/hrm/lembur/js.php";
    break;
	case "bonus" :
		$modul = "assets/hrm/bonus/index.php";
		$title = "Form Bonus";
		$cont = "assets/hrm/bonus/js.php";
    break;
	case "bonus_s" :
		$modul = "assets/hrm/bonus/simpan.php";
		$title = "Form Bonus";
		$cont = "assets/hrm/bonus/js.php";
    break;
	case "bonus_v" :
		$modul = "assets/hrm/bonus/view_stok.php";
		$cont = "assets/hrm/bonus/js.php";
    break;
	case "payrol" :
		$modul = "assets/hrm/payrol/view_stok.php";
		$title = "Data Gaji Karyawan";
		$cont = "assets/hrm/payrol/js.php";
    break;
	
	case "payrol_s" :
		$modul = "assets/hrm/payrol/simpan.php";
		$cont = "assets/hrm/payrol/js.php";
    break;
	
	
	case "pembgaji" :
		$modul = "assets/akutansi/pembayaran_gaji/view_stok.php";
		$title = "Pembayaran Gaji";
		$cont = "assets/akutansi/pembayaran_gaji/js.php";
    break;
	case "pembgaji_s" :
		$modul = "assets/akutansi/pembayaran_gaji/simpan.php";
		$cont = "assets/akutansi/pembayaran_gaji/js.php";
    break;
	
	
	
	case "payrolhabor" :
		$modul = "assets/hrm/payrolhabor/view_stok.php";
		$title = "Data Gaji Karyawan Harian/Borongan";
		$cont = "assets/hrm/payrolhabor/js.php";
    break;
	case "payrolhabor_s" :
		$modul = "assets/hrm/payrolhabor/simpan.php";
		$cont = "assets/hrm/payrolhabor/js.php";
    break;
	
	case "slip" :
		$modul = "assets/hrm/slip/view_stok.php";
		$title = "Slip Gaji Karyawan";
		$cont = "assets/hrm/slip/js.php";
    break;
	case "sliphabor" :
		$modul = "assets/hrm/sliphabor/view_stok.php";
		$title = "Slip Gaji Harian";
		$cont = "assets/hrm/sliphabor/js.php";
    break;
	case "ijin" :
		$modul = "assets/hrm/ijin/index.php";
		$title = "Form Ketidakhadiran";
		$cont = "assets/hrm/ijin/js.php";
    break;
	case "ijin_s" :
		$modul = "assets/hrm/ijin/simpan.php";
		$title = "Form Ketidakhadiran";
		$cont = "assets/hrm/ijin/js.php";
    break;
	case "ijin_v" :
		$modul = "assets/hrm/ijin/view_stok.php";
		$cont = "assets/hrm/ijin/js.php";
    break;
	// koreksi piutang
	case "korpi" :
		$modul = "assets/inventory/koresipiutang/index.php";
		$title = "Koreksi Harga Jual";
		$cont = "assets/inventory/koresipiutang/js.php";
    break;
	case "korpi_s" :
		$modul = "assets/inventory/koresipiutang/simpan.php";
		$title = "Koreksi Harga Jual";
		$cont = "assets/inventory/koresipiutang/js.php";
    break;
	case "korpi_v" :
		$modul = "assets/inventory/koresipiutang/view_stok.php";
		$cont = "assets/inventory/koresipiutang/js_stok.php";
    break;
	case "korpi_c1" :
		$modul = "assets/inventory/koresipiutang/cetak1.php";
    break;
	case "korpi_c2" :
		$modul = "assets/inventory/koresipiutang/cetak2.php";
    break;
	case "korpi_c3" :
		$modul = "assets/inventory/koresipiutang/cetak3.php";
    break;
	// koreksi piutang2
	case "korpiutang" :
		$modul = "assets/inventory/koresipiutang2/index.php";
		$title = "Koreksi Piutang";
		$cont = "assets/inventory/koresipiutang2/js.php";
    break;
	case "korpiutang_s" :
		$modul = "assets/inventory/koresipiutang2/simpan.php";
		$title = "Koreksi Piutang";
		$cont = "assets/inventory/koresipiutang2/js.php";
    break;
	case "korpiutang_v" :
		$modul = "assets/inventory/koresipiutang2/view_stok.php";
		$cont = "assets/inventory/koresipiutang2/js_stok.php";
    break;
	case "korpiutang_c1" :
		$modul = "assets/inventory/koresipiutang2/cetak1.php";
    break;
	case "korpiutang_c2" :
		$modul = "assets/inventory/koresipiutang2/cetak2.php";
    break;
	case "korpiutang_c3" :
		$modul = "assets/inventory/koresipiutang2/cetak3.php";
    break;
	// Buku Tagihan
	case "bukta" :
		$modul = "assets/inventory/buku_tagihan/index.php";
		$title = "Pelunasan Piutang";
		$cont = "assets/inventory/buku_tagihan/js.php";
    break;
	case "bukta_s" :
		$modul = "assets/inventory/buku_tagihan/simpan.php";
		$title = "Pelunasan Piutang";
		$cont = "assets/inventory/buku_tagihan/js.php";
    break;
	case "bukta_v" :
		$modul = "assets/inventory/buku_tagihan/view_stok.php";
		$cont = "assets/inventory/buku_tagihan/js_stok.php";
    break;
	case "bukta_c" :
		$modul = "assets/inventory/buku_tagihan/cetak.php";
		$cont = "assets/inventory/buku_tagihan/js_stok.php";
    break;
	
	
	// Retur Penjualan
	case "returpen" :
		$modul = "assets/inventory/retur_jual/index.php";
		$title = "Retur Penjualan";
		$cont = "assets/inventory/retur_jual/js.php";
    break;
	case "returpen_s" :
		$modul = "assets/inventory/retur_jual/simpan.php";
		$title = "Retur Penjualan";
		$cont = "assets/inventory/retur_jual/js.php";
    break;
	case "returpen_k" :
		$modul = "assets/inventory/retur_jual/satuan.php";
		$title = "Retur Penjualan";
		$cont = "assets/inventory/retur_jual/js.php";
    break;
	case "returpen_v" :
		$modul = "assets/inventory/retur_jual/view_stok.php";
		$title = "Retur Penjualan";
		$cont = "assets/inventory/retur_jual/js_stok.php";
    break;
	// buku bg
	case "bukubg" :
		$modul = "assets/inventory/bukubg/index.php";
		$title = "Buku BG";
		$cont = "assets/inventory/bukubg/js.php";
    break;
	case "bukubg_s" :
		$modul = "assets/inventory/bukubg/simpan.php";
		$title = "Buku BG";
		$cont = "assets/inventory/bukubg/js.php";
    break;
	case "bukubg_k" :
		$modul = "assets/inventory/bukubg/satuan.php";
		$title = "Buku BG";
		$cont = "assets/inventory/bukubg/js.php";
    break;
	case "bukubg_v" :
		$modul = "assets/inventory/bukubg/view_stok.php";
		$title = "View Buku BG";
		$cont = "assets/inventory/bukubg/js_stok.php";
    break;
	// buku bg
	case "kndn" :
		$modul = "assets/inventory/kndn/index.php";
		$title = "Debet Kredit Note";
		$cont = "assets/inventory/kndn/js.php";
    break;
	case "kndn_k" :
		$modul = "assets/inventory/kndn/index_k.php";
		$title = "Kroscek Kredit Note";
		$cont = "assets/inventory/kndn/js.php";
    break;
	case "kndn_s" :
		$modul = "assets/inventory/kndn/simpan_kndn.php";
		$title = "Buku BG";
		$cont = "assets/inventory/kndn/js.php";
    break;
	
	// master brgmasuk
	case "brg_masuk" :
		$modul = "assets/inventory/brg_masuk/index.php";
		$title = "Penerimaan Barang";
		$cont = "assets/inventory/brg_masuk/js.php";
    break;
	case "brg_masuk_s" :
		$modul = "assets/inventory/brg_masuk/simpan.php";
		$title = "Penerimaan Barang";
		$cont = "assets/inventory/brg_masuk/js.php";
    break;
	case "brg_masuk_k" :
		$modul = "assets/inventory/brg_masuk/satuan.php";
		$cont = "assets/inventory/brg_masuk/js.php";
    break;
	case "brg_masuk_v" :
		$modul = "assets/inventory/brg_masuk/view_order.php";
		$cont = "assets/inventory/brg_masuk/js_order.php";
    break;

	case "brg_masuk_c" :
		$modul = "assets/inventory/brg_masuk/cetak.php";
		$cont = "assets/inventory/brg_masuk/js_order.php";
    break;
	// master prp
	case "app_prp" :
		$modul = "assets/inventory/app_prp/index.php";
		$title = "Approve Permintaan Pembelian";
		$cont = "assets/inventory/app_prp/js.php";
    break;
	case "app_pengbum" :
		$modul = "assets/inventory/app_pengbum/index.php";
		$title = "Approve Permintaan Penggunaan Barang Umum";
		$cont = "assets/inventory/app_pengbum/js.php";
    break;
	// koreksi
	case "appkor" :
		$modul = "assets/inventory/appkor/index.php";
		$title = "Approve Koreksi Harga Bulan Berjalan";
		$cont = "assets/inventory/appkor/js.php";
    break;
	case "appkor2" :
		$modul = "assets/inventory/appkor2/index.php";
		$title = "Approve Koreksi Harga Bulan Lalu";
		$cont = "assets/inventory/appkor2/js.php";
    break;
	// koreksi
	case "appkorpiutang" :
		$modul = "assets/inventory/appkorpiutang/index.php";
		$title = "Approve Koreksi Piutang Bulan Berjalan";
		$cont = "assets/inventory/appkorpiutang/js.php";
    break;
	case "appkorpiutang2" :
		$modul = "assets/inventory/appkorpiutang2/index.php";
		$title = "Approve Koreksi Piutang Bulan Lalu";
		$cont = "assets/inventory/appkorpiutang2/js.php";
    break;
	//approve buku tagihan
	case "appbt" :
		$modul = "assets/inventory/app_bt/index.php";
		$title = "Approve Buku Tagihan";
		$cont = "assets/inventory/app_bt/js.php";
    break;
	case "appbt_c" :
		$modul = "assets/inventory/app_bt/cetak.php";
    break;
	//approve buku tagihan kembali
	case "apptagkem" :
		$modul = "assets/inventory/app_tk/index.php";
		$title = "Approve Tagihan Kembali";
		$cont = "assets/inventory/app_tk/js.php";
    break;
	//approve Pembayaran
	case "apppembayaran" :
		$modul = "assets/inventory/apppembayaran/index.php";
		$title = "Approve Pembayaran";
		$cont = "assets/inventory/apppembayaran/js.php";
    break;
	// master appjual
	case "appjual" :
		$modul = "assets/inventory/appjual/index.php";
		$title = "Approve Permintaan Penjualan";
		$cont = "assets/inventory/appjual/js.php";
    break;
	case "appjual_d" :
		$modul = "assets/inventory/appjual/indexdirect.php";
		$title = "Direct Penjualan";
		$cont = "assets/inventory/appjual/js.php";
    break;
	case "appjual_c" :
		$modul = "assets/inventory/appjual/indexcetak.php";
		$title = "Biaya Pengiriman";
		$cont = "assets/inventory/appjual/js_order.php";
    break;
	// master appjual
	case "appjualreg" :
		$modul = "assets/inventory/appjual/indexreg.php";
		$title = "Approve Permintaan Penjualan";
		$cont = "assets/inventory/appjual/jsreg.php";
    break;
	// app so
	case "appso" :
		$modul = "assets/inventory/app_so/index.php";
		$title = "Approve Permintaan Stok Opname";
		$cont = "assets/inventory/app_so/js.php";
    break;
	case "appso_s" :
		$modul = "assets/inventory/app_so/simpan.php";
		$title = "Approve Permintaan Stok Opname";
		$cont = "assets/inventory/app_so/js.php";
    break;
	case "appso_v" :
		$modul = "assets/inventory/app_so/view_stok.php";
		$cont = "assets/inventory/app_so/js_stok.php";
    break;
	
	// app retur
	case "apprt" :
		$modul = "assets/inventory/app_retur/index.php";
		$title = "Approve Retur Pembelian";
		$cont = "assets/inventory/app_retur/js.php";
    break;
	case "apprt_s" :
		$modul = "assets/inventory/app_retur/simpan.php";
		$title = "Approve Retur Pembelian";
		$cont = "assets/inventory/app_retur/js.php";
    break;
	case "apprt_v" :
		$modul = "assets/inventory/app_retur/view_stok.php";
		$cont = "assets/inventory/app_retur/js_stok.php";
    break;
	// app DO
	case "appdo" :
		$modul = "assets/inventory/app_do/index.php";
		$title = "Approve Delivery Order";
		$cont = "assets/inventory/app_do/js.php";
    break;
	case "appdo_s" :
		$modul = "assets/inventory/app_do/simpan.php";
		$title = "Approve Delivery Order";
		$cont = "assets/inventory/app_do/js.php";
    break;
	case "appdo_v" :
		$modul = "assets/inventory/app_do/view_stok.php";
		$title = "View Delivery Order";
		$cont = "assets/inventory/app_do/js_stok.php";
    break;
	// cetak spj
	case "cetakspj" :
		$modul = "assets/inventory/cetakspjpen/index.php";
		$title = "Cetak Spj";
		$cont = "assets/inventory/cetakspjpen/js.php";
    break;
	case "cetakspj_s" :
		$modul = "assets/inventory/cetakspjpen/simpan.php";
		$title = "Cetak Spj";
		$cont = "assets/inventory/cetakspjpen/js.php";
    break;
	case "cetakspj_c" :
		$modul = "assets/inventory/cetakspjpen/cetak.php";
		$title = "Cetak Spj";
		$cont = "assets/inventory/cetakspjpen/js_stok.php";
    break;
	case "cetakspb_c" :
		$modul = "assets/inventory/cetakspjpen/cetakspb.php";
		$title = "Cetak Spj";
		$cont = "assets/inventory/cetakspjpen/js_stok.php";
    break;
	// cetak spj da
	case "kirimda" :
		$modul = "assets/inventory/kirimda/index.php";
		$title = "Cetak Spj Penjualan DA";
		$cont = "assets/inventory/kirimda/js.php";
    break;
	// app brg keluar
	case "brgkeluar" :
		$modul = "assets/inventory/brgkeluar/index.php";
		$title = "Approve Pengeluaran barang";
		$cont = "assets/inventory/brgkeluar/js.php";
    break;
	case "brgkeluar_s" :
		$modul = "assets/inventory/brgkeluar/simpan.php";
		$title = "Approve Pengeluaran barang";
		$cont = "assets/inventory/brgkeluar/js.php";
    break;
	case "brgkeluar_v" :
		$modul = "assets/inventory/brgkeluar/view_stok.php";
		$cont = "assets/inventory/brgkeluar/js_stok.php";
    break;
	case "brgkeluar2_v" :
		$modul = "assets/inventory/cetakspjpen/view_stok2.php";
		$cont = "assets/inventory/cetakspjpen/js_stok.php";
    break;
	// Tagihan kembali
	case "tagkem" :
		$modul = "assets/inventory/tagihan_kembali/index.php";
		$title = "Tagihan Kembali";
		$cont = "assets/inventory/tagihan_kembali/js.php";
    break;
	case "tagkem_s" :
		$modul = "assets/inventory/tagihan_kembali/simpan.php";
		$title = "Tagihan Kembali";
		$cont = "assets/inventory/tagihan_kembali/js.php";
    break;
	case "tagkem_v" :
		$modul = "assets/inventory/tagihan_kembali/view_stok.php";
		$cont = "assets/inventory/tagihan_kembali/js_stok.php";
    break;
	
	
	// tkbm pembelian
	case "tkbmbeli" :
		$modul = "assets/inventory/tkbmbeli/index.php";
		$title = "Biaya TKBM Pembelian";
		$cont = "assets/inventory/tkbmbeli/js.php";
    break;
	case "tkbmbeli_s" :
		$modul = "assets/inventory/tkbmbeli/simpan.php";
		$title = "Biaya TKBM Pembelian";
		$cont = "assets/inventory/tkbmbeli/js.php";
    break;
	case "tkbmbeli_v" :
		$modul = "assets/inventory/tkbmbeli/view_stok.php";
		$cont = "assets/inventory/tkbmbeli/js_stok.php";
    break;
	// tkbm pembelian
	case "tkbmjual" :
		$modul = "assets/inventory/tkbmjual/index.php";
		$title = "Biaya TKBM Penjualan";
		$cont = "assets/inventory/tkbmjual/js.php";
    break;
	case "tkbmjual_s" :
		$modul = "assets/inventory/tkbmjual/simpan.php";
		$title = "Biaya TKBM Penjualan";
		$cont = "assets/inventory/tkbmjual/js.php";
    break;
	case "tkbmjual_v" :
		$modul = "assets/inventory/tkbmjual/view_stok.php";
		$cont = "assets/inventory/tkbmjual/js_stok.php";
    break;
	// delivo
	case "delivo" :
		$modul = "assets/inventory/delivo/index.php";
		$title = "Delivery Order";
		$cont = "assets/inventory/delivo/js.php";
    break;
	case "delivo_s" :
		$modul = "assets/inventory/delivo/simpan.php";
		$title = "Delivery Order";
		$cont = "assets/inventory/delivo/js.php";
    break;
	case "delivo_v" :
		$modul = "assets/inventory/delivo/view_stok.php";
		$title = "Delivery Order";
		$cont = "assets/inventory/delivo/js_stok.php";
    break;
	
	// Penerimaan Barang Transit
	case "brg_masuk_transit" :
		$modul = "assets/inventory/brg_masuk_transit/index.php";
		$title = "Penerimaan Barang Transit";
		$cont = "assets/inventory/brg_masuk_transit/js.php";
    break;
	case "brg_masuk_transit_s" :
		$modul = "assets/inventory/brg_masuk_transit/simpan.php";
		$title = "Penerimaan Barang Transit";
		$cont = "assets/inventory/brg_masuk_transit/js.php";
    break;
	case "brg_masuk_transit_v" :
		$modul = "assets/inventory/brg_masuk_transit/view_stok.php";
		$cont = "assets/inventory/brg_masuk_transit/js_stok.php";
    break;
	
	// Penerimaan Barang Non Dagang
	case "brgmasuknon" :
		$modul = "assets/inventory/brg_masuk_non/index.php";
		$title = "Penerimaan Barang Non Dagang";
		$cont = "assets/inventory/brg_masuk_non/js.php";
    break;
	case "brgmasuknon_s" :
		$modul = "assets/inventory/brg_masuk_non/simpan.php";
		$cont = "assets/inventory/brg_masuk_non/js.php";
    break;
	case "brgmasuknon_v" :
		$modul = "assets/inventory/brg_masuk_non/view_stok.php";
		$title = "Penerimaan Barang Non Dagang";
		$cont = "assets/inventory/brg_masuk_non/js_stok.php";
    break;
	
	// master app ord
	case "app_order" :
		$modul = "assets/inventory/app_order/index.php";
		$title = "Approve Permintaan barang";
		$cont = "assets/inventory/app_order/js.php";
    break;
	case "app_swda" :
		$modul = "assets/inventory/app_swda/index.php";
		$title = "Approve Switch DA";
		$cont = "assets/inventory/app_swda/js.php";
    break;
	case "app_direct" :
		$modul = "assets/inventory/app_direct/index.php";
		$title = "Approve Penjualan Direct Cabang";
		$cont = "assets/inventory/app_direct/js.php";
    break;
	case "app-transit" :
		$modul = "assets/inventory/app_transit/index.php";
		$title = "Approve Permintaan Tranist Barang";
		$cont = "assets/inventory/app_transit/js.php";
    break;
	case "app_spj" :
		$modul = "assets/inventory/app_spj/index.php";
		$title = "Approve Relokasi SPJ";
		$cont = "assets/inventory/app_spj/js.php";
    break;
	case "app_pm" :
		$modul = "assets/inventory/app_pm/index.php";
		$title = "Approve Pemintaan Penerimaan (-SO)";
		$cont = "assets/inventory/app_pm/js.php";
    break;
	case "appriject" :
		$modul = "assets/inventory/appriject/index.php";
		$title = "Approve Penjualan Barang Riject";
		$cont = "assets/inventory/appriject/js.php";
    break;
	//app barang keluar
	case "appbrgkel" :
		$modul = "assets/inventory/appbrgkel/index.php";
		$title = "Approve Barang Keluar";
		$cont = "assets/inventory/appbrgkel/js.php";
    break;
	// master po
	case "po" :
		$modul = "assets/inventory/po/index.php";
		$title = "Pembelian";
		$cont = "assets/inventory/po/js.php";
    break;
	case "po_c" :
		$modul = "assets/inventory/po/cetak.php";
		$title = "Pembelian";
		$cont = "assets/inventory/po/js.php";
    break;
	//Halaman Penggunaan Barang
	case "pgnbrng" :
		$modul = "assets/inventory/pgnbrng/index.php";
		$title = "Penggunaan Barang";
		$cont = "assets/inventory/pgnbrng/js.php";
    break;
	case "pgnbrng_s" :
		$modul = "assets/inventory/pgnbrng/simpan.php";
		$title = "Penggunaan Barang";
		$cont = "assets/inventory/pgnbrng/js.php";
    break;
	case "pgnbrng_v" :
		$modul = "assets/inventory/pgnbrng/view_penggunaan.php";
		$cont = "assets/inventory/pgnbrng/js_penggunaan.php";
    break;
	
	//kendaraan
	case "kendaraan" :
		$modul = "assets/master/kendaraan/index.php";
		$title = "Master Kendaraan";
		$cont = "assets/master/kendaraan/js.php";
    break;
	case "kendaraan_s" :
		$modul = "assets/master/kendaraan/simpan.php";
		$title = "Master Kendaraan";
		$cont = "assets/master/kendaraan/js.php";
    break;
	//kendaraan
	case "deposit" :
		$modul = "assets/master/deposit/index.php";
		$title = "Master Deposit";
		$cont = "assets/master/deposit/js.php";
    break;
	case "deposit_d" :
		$modul = "assets/master/deposit/indexd.php";
		$title = "Detil History";
		$cont = "assets/master/deposit/jsd.php";
    break;
	case "deposit_s" :
		$modul = "assets/master/deposit/simpan.php";
		$title = "Master Deposit";
		$cont = "assets/master/deposit/js.php";
    break;
	//peghabor
	case "peghabor" :
		$modul = "assets/master/peghabor/index.php";
		$title = "Input Pegawai Harian/Borongan";
		$cont = "assets/master/peghabor/js.php";
    break;
	case "peghabor_s" :
		$modul = "assets/master/peghabor/simpan.php";
		$title = "Input Pegawai Harian/Borongan";
		$cont = "assets/master/peghabor/js.php";
    break;
	case "peghabor_v" :
		$modul = "assets/master/peghabor/indexview.php";
		$title = "List Pegawai Harian/Borongan";
		$cont = "assets/master/peghabor/jsview.php";
    break;
	//peghabor
	case "apppeghabor" :
		$modul = "assets/master/apppeghabor/index.php";
		$title = "Approve Pegawai Harian/Borongan";
		$cont = "assets/master/apppeghabor/js.php";
    break;
	case "apppeghabor_s" :
		$modul = "assets/master/apppeghabor/simpan.php";
		$title = "Approve Pegawai Harian/Borongan";
		$cont = "assets/master/apppeghabor/js.php";
    break;
	// master billing
	case "billing" :
		$modul = "assets/inventory/billing/index.php";
		$title = "Billing Tagihan";
		$cont = "assets/inventory/billing/js.php";
    break;
	case "billing_s" :
		$modul = "assets/inventory/billing/simpan.php";
		$title = "Billing Tagihan";
		$cont = "assets/inventory/billing/js.php";
    break;
	case "billing_ss" :
		$modul = "assets/inventory/billing/simpan2.php";
		$title = "Billing Tagihan";
		$cont = "assets/inventory/billing/js.php";
    break;
	case "billing_sss" :
		$modul = "assets/inventory/billing/simpan3.php";
		$title = "Billing Tagihan";
		$cont = "assets/inventory/billing/js.php";
    break;
	case "billing_v" :
		$modul = "assets/inventory/billing/view_order.php";
		$cont = "assets/inventory/billing/js_order.php";
    break;
	case "billing_vn" :
		$modul = "assets/inventory/billing/view_ordern.php";
		$cont = "assets/inventory/billing/js_ordern.php";
    break;
	case "billing_vv" :
		$modul = "assets/inventory/billing/view_comp.php";
		$cont = "assets/inventory/billing/js_order.php";
    break;
	// master permintaan pemb
	case "order-pemb" :
		$modul = "assets/inventory/order_pemb/index.php";
		$title = "Billing Tagihan";
		$cont = "assets/inventory/order_pemb/js.php";
    break;
	case "order-pemb_s" :
		$modul = "assets/inventory/order_pemb/simpan.php";
		$title = "Billing Tagihan";
		$cont = "assets/inventory/order_pemb/js.php";
    break;
	
	case "order-pemb_v" :
		$modul = "assets/inventory/order_pemb/view_order.php";
		$cont = "assets/inventory/order_pemb/js_order.php";
    break;
	// master Permintaan Tagihan Expediture
	case "ordexp" :
		$modul = "assets/inventory/ordexp/index.php";
		$title = "Permintaan Tagihan Expediture";
		$cont = "assets/inventory/ordexp/js.php";
    break;
	case "ordexp_s" :
		$modul = "assets/inventory/ordexp/simpan.php";
		$title = "Permintaan Tagihan Expediture";
		$cont = "assets/inventory/ordexp/js.php";
    break;
	case "ordexp_v" :
		$modul = "assets/inventory/ordexp/view_order.php";
		$cont = "assets/inventory/ordexp/js_order.php";
    break;
	//master preferences
	case "pref":
		$modul = "assets/master/preference/index.php";
		$title = "Master Preference";
		$cont = "assets/master/preference/js.php";
		break;
	case "pref_s" :
		$modul = "assets/master/preference/simpan.php";
		$title = "Master Preference";
		$cont = "assets/master/preference/js.php";
    break;
			//==========================================end transaksi=========================================================================
	//===========================================laporan=============================================================
	case "lappersediaan" :
		$modul = "assets/laporan/persediaan/index.php";
		$title = "Persediaan Barang";
		$cont = "assets/laporan/persediaan/js.php";
    break;
	case "lappayrol" :
		$modul = "assets/laporan/lappayrol/view_stok.php";
		$title = "Laporan Upah Karyawan";
		$cont = "assets/laporan/lappayrol/js.php";
    break;
	case "lapnilaipeg" :
		$modul = "assets/laporan/lapnilaipeg/view_stok.php";
		$title = "Laporan Penilaian Pegawai";
		$cont = "assets/laporan/lapnilaipeg/js.php";
    break;
	case "lappayrolhar" :
		$modul = "assets/laporan/lappayrolhar/view_stok.php";
		$title = "Laporan Upah Harian";
		$cont = "assets/laporan/lappayrolhar/js.php";
    break;
	case "lappelanggaran" :
		$modul = "assets/laporan/lappelanggaran/index.php";
		$title = "Laporan Pelanggaran Karyawan";
		$cont = "assets/laporan/lappelanggaran/js.php";
    break;
	case "lappenghargaan" :
		$modul = "assets/laporan/lappenghargaan/index.php";
		$title = "Laporan Penghargaan Karyawan";
		$cont = "assets/laporan/lappenghargaan/js.php";
    break;
	case "laplembur" :
		$modul = "assets/laporan/laplembur/view_stok.php";
		$title = "Laporan Lembur Karyawan";
		$cont = "assets/laporan/laplembur/js.php";
    break;
	case "lapabsensi" :
		$modul = "assets/laporan/lapabsensi/view_stok.php";
		$title = "Laporan Absensi Karyawan";
		$cont = "assets/laporan/lapabsensi/js.php";
    break;
	case "postritase" :
		$modul = "assets/inventory/postritase/index.php";
		$title = "Posting Ritase Harian";
		$cont = "assets/inventory/postritase/js.php";
    break;
	
	
	case "lappersediaannon" :
		$modul = "assets/laporan/persediaannon/index.php";
		$title = "Persediaan Barang Non Dagang";
		$cont = "assets/laporan/persediaannon/js.php";
    break;
	case "lappersediaanre" :
		$modul = "assets/laporan/persediaanre/index.php";
		$title = "Persediaan Barang Reject";
		$cont = "assets/laporan/persediaanre/js.php";
    break;
	
	case "laptransit" :
		$modul = "assets/laporan/laptransit/index.php";
		$title = "Laporan Permintaan Transit Barang";
		$cont = "assets/laporan/laptransit/js.php";
    break;
	case "nilaiper" :
		$modul = "assets/laporan/nilaiper/index.php";
		$title = "Nilai Persediaan";
		$cont = "assets/laporan/nilaiper/js.php";
    break;
	
	case "lappenpel" :
		$modul = "assets/laporan/lappenpel/index.php";
		$title = "Penjualan Per Pelanggan";
		$cont = "assets/laporan/lappenpel/js.php";
    break;
	
	case "lapposemnon" :
		$modul = "assets/laporan/lapposemnon/index.php";
		$title = "Pembelian Semen / Non Semen";
		$cont = "assets/laporan/lapposemnon/js.php";
    break;
	
	case "lapposupp" :
		$modul = "assets/laporan/lapposupp/index.php";
		$title = "Pembelian Semen / Non Semen Per Supp";
		$cont = "assets/laporan/lapposupp/js.php";
    break;
	
	case "lappen" :
		$modul = "assets/laporan/lappenjualan/index.php";
		$title = "Laporan Penjualan Semen";
		$cont = "assets/laporan/lappenjualan/js.php";
    break;
	case "lappenbar" :
		$modul = "assets/laporan/lappenbarang/index.php";
		$title = "Laporan Penjualan Barang";
		$cont = "assets/laporan/lappenbarang/js.php";
    break;
	case "lapsumpenbar" :
		$modul = "assets/laporan/lapsumpenbarang/index.php";
		$title = "Laporan Penjualan Barang";
		$cont = "assets/laporan/lapsumpenbarang/js.php";
    break;
	case "lappennon" :
		$modul = "assets/laporan/lappenjualannon/index.php";
		$title = "Laporan Penjualan Non Semen";
		$cont = "assets/laporan/lappenjualannon/js.php";
    break;
	case "lappendtl" :
		$modul = "assets/laporan/lappendtl/index.php";
		$title = "Laporan Detil Penjualan";
		$cont = "assets/laporan/lappendtl/js.php";
    break;
	case "laporder" :
		$modul = "assets/laporan/laporder/index.php";
		$title = "Laporan Permintaan Barang Unit (PU)";
		$cont = "assets/laporan/laporder/js.php";
    break;
	case "lapso" :
		$modul = "assets/laporan/lapsalesorder/index.php";
		$title = "Laporan Sales Order";
		$cont = "assets/laporan/lapsalesorder/js.php";
    break;
	case "laptkbm" :
		$modul = "assets/laporan/laptkbm/index.php";
		$title = "Laporan TKBM Pembelian";
		$cont = "assets/laporan/laptkbm/js.php";
    break;
	case "laptkbmj" :
		$modul = "assets/laporan/laptkbmj/index.php";
		$title = "Laporan TKBM Penjualan";
		$cont = "assets/laporan/laptkbmj/js.php";
    break;
	case "lapbiujs" :
		$modul = "assets/laporan/lapbiujs/index.php";
		$title = "Laporan Biaya Uang Jalan Supir";
		$cont = "assets/laporan/lapbiujs/js.php";
    break;
	case "lapbisup" :
		$modul = "assets/laporan/lapbisup/index.php";
		$title = "Laporan Biaya Supir";
		$cont = "assets/laporan/lapbisup/js.php";
    break;
	case "lapbibong" :
		$modul = "assets/laporan/lapbibong/index.php";
		$title = "Laporan Biaya Bongkar Toko";
		$cont = "assets/laporan/lapbibong/js.php";
    break;
	case "lapbiret" :
		$modul = "assets/laporan/lapbiret/index.php";
		$title = "Laporan Biaya Retribusi";
		$cont = "assets/laporan/lapbiret/js.php";
    break;
	case "lapopname" :
		$modul = "assets/laporan/lapopname/index.php";
		$title = "Laporan Stok Opname";
		$cont = "assets/laporan/lapopname/js.php";
    break;
	case "laprelok" :
		$modul = "assets/laporan/laprelok/index.php";
		$title = "Laporan Permintaan Relokasi SPJ";
		$cont = "assets/laporan/laprelok/js.php";
    break;
	case "lapbm" :
		$modul = "assets/laporan/lapbm/index.php";
		$title = "Laporan Penerimaan Barang Masuk";
		$cont = "assets/laporan/lapbm/js.php";
    break;
	case "lappeg" :
		$modul = "assets/laporan/lappeg/index.php";
		$title = "Data Pegawai";
		$cont = "assets/laporan/lappeg/js.php";
    break;
	
	case "lapbon" :
		$modul = "assets/laporan/lapbon/view_stok.php";
		$title = "Laporan Bonus";
		$cont = "assets/laporan/lapbon/js.php";
    break;
	
	case "lapretpem" :
		$modul = "assets/laporan/lapretpem/index.php";
		$title = "Laporan Retur Pembelian";
		$cont = "assets/laporan/lapretpem/js.php";
    break;
	
	case "lapretpenj" :
		$modul = "assets/laporan/lapretpenj/index.php";
		$title = "Laporan Retur Penjualan";
		$cont = "assets/laporan/lapretpenj/js.php";
    break;
	case "laprekappo" :
		$modul = "assets/laporan/laprekappo/index.php";
		$title = "Laporan Rekapitulasi Pembelian";
		$cont = "assets/laporan/laprekappo/js.php";
    break;
	case "lapexp" :
		$modul = "assets/laporan/lapexp/index.php";
		$title = "Laporan Expediture";
		$cont = "assets/laporan/lapexp/js.php";
    break;
	case "laptagexp" :
		$modul = "assets/laporan/laptagexp/index.php";
		$title = "Laporan Tagihan Expediture";
		$cont = "assets/laporan/laptagexp/js.php";
    break;
	case "kartupi" :
		$modul = "assets/laporan/kartupi/index.php";
		$title = "Kartu Piutang Pelanggan";
		$cont = "assets/laporan/kartupi/js.php";
    break;
	
	case "allaging" :
		$modul = "assets/laporan/allaging/index.php";
		$title = "Laporan Piutang /Cabang";
		$cont = "assets/laporan/allaging/js.php";
    break;
	case "allaging2" :
		$modul = "assets/laporan/allaging2/index.php";
		$title = "Laporan Aging Piutang";
		$cont = "assets/laporan/allaging2/js.php";
    break;
	///LAP ASSET///
	
	case "lapperaset" :
		$modul = "assets/laporan/lapperaset/index.php";
		$title = "Laporan Permintan Penggunaan Asset";
		$cont = "assets/laporan/lapperaset/js.php";
    break;
	case "lapsiapaset" :
		$modul = "assets/laporan/lapsiapaset/index.php";
		$title = "Laporan Siap Asset";
		$cont = "assets/laporan/lapsiapaset/js.php";
    break;
	case "lapmainaset" :
		$modul = "assets/laporan/lapmainaset/index.php";
		$title = "Laporan Maintenance Asset";
		$cont = "assets/laporan/lapmainaset/js.php";
    break;
	case "laphapusaset" :
		$modul = "assets/laporan/laphapusaset/index.php";
		$title = "Laporan Penghapusan Asset";
		$cont = "assets/laporan/laphapusaset/js.php";
    break;
	case "lappengaset" :
		$modul = "assets/laporan/lappengaset/index.php";
		$title = "Laporan Penggunaan Asset";
		$cont = "assets/laporan/lappengaset/js.php";
    break;
//////cetak/////
	case "cetaklapbm" :
		$modul = "assets/laporan/lapbm/html2pdf.php";
		$title = "Laporan Penerimaan Barang";
		$cont = "assets/laporan/lapbm/js.php";
    break;
	// ================================================= Start Akutansi ===============================================
	//==========================================master=========================================================================
	// master kode rekening
	case "koder" :
		$modul = "assets/master/kode_rekening/index.php";
		$title = "Master kode rekening";
		$cont = "assets/master/kode_rekening/js.php";
    break;
	case "koder_s" :
		$modul = "assets/master/kode_rekening/simpan.php";
		$title = "Master kode rekening";
		$cont = "assets/master/kode_rekening/js.php";
    break;
	// master group inven			
	case "pbar" :
		$modul = "assets/master/pgrup_inven/index.php";
		$title = "Parameter Group Inventory";
		$cont = "assets/master/pgrup_inven/js.php";
    break;
	case "pbar_s" :
		$modul = "assets/master/pgrup_inven/simpan.php";
		$title = "Parameter Group Inventory";
		$cont = "assets/master/pgrup_inven/js.php";
    break;
	
	// master group inven			
	case "paramarus" :
		$modul = "assets/master/paruskas/index.php";
		$title = "Parameter Arus Kas";
		$cont = "assets/master/paruskas/js.php";
    break;
	case "paramarus_s" :
		$modul = "assets/master/paruskas/simpan.php";
		$title = "Parameter Arus Kas";
		$cont = "assets/master/paruskas/js.php";
    break;
	
	// master type rekening
	case "typerek" :
		$modul = "assets/master/type_rekening/index.php";
		$title = "Master type rekening";
		$cont = "assets/master/type_rekening/js.php";
    break;
	case "typerek_s" :
		$modul = "assets/master/type_rekening/simpan.php";
		$title = "Master type rekening";
		$cont = "assets/master/type_rekening/js.php";
    break;
	// master kode rekening
	case "kasbank" :
		$modul = "assets/master/kas_bank/index.php";
		$title = "Master kas bank";
		$cont = "assets/master/kas_bank/js.php";
    break;
	case "kasbank_s" :
		$modul = "assets/master/kas_bank/simpan.php";
		$title = "Master kas bank";
		$cont = "assets/master/kas_bank/js.php";
    break;
	// master parameter jurnal
	case "parju" :
		$modul = "assets/master/parju/index.php";
		$title = "Master Satuan";
		$cont = "assets/master/parju/js.php";
    break;
	case "parju_s" :
		$modul = "assets/master/parju/simpan.php";
		$title = "Master Satuan";
		$cont = "assets/master/parju/js.php";
    break;
	// master kelompok rekening
	case "kelrek" :
		$modul = "assets/master/kelompok_rekening/index.php";
		$title = "Master Satuan";
		$cont = "assets/master/kelompok_rekening/js.php";
    break;
	case "kelrek_s" :
		$modul = "assets/master/kelompok_rekening/simpan.php";
		$title = "Master kelompok rekening";
		$cont = "assets/master/kelompok_rekening/js.php";
    break;
	// master kelompok rekening
	case "profitcenter" :
		$modul = "assets/master/profitcenter/index.php";
		$title = "Master profit center";
		$cont = "assets/master/profitcenter/js.php";
    break;
	case "profitcenter_s" :
		$modul = "assets/master/profitcenter/simpan.php";
		$title = "Master profit center";
		$cont = "assets/master/profitcenter/js.php";
    break;
	// jurnal umum
	case "jurum" :
		$modul = "assets/akutansi/jurnal_umum/index.php";
		$title = "Jurnal Umum";
		$cont = "assets/akutansi/jurnal_umum/js.php";
    break;
	case "jurum_s" :
		$modul = "assets/akutansi/jurnal_umum/simpan.php";
		$title = "Jurnal Umum";
		$cont = "assets/akutansi/jurnal_umum/js.php";
    break;
	case "jurum_ss" :
		$modul = "assets/akutansi/jurnal_umum/simpan2.php";
    break;
	// kas keluar
	case "kkbk" :
		$modul = "assets/akutansi/kas_keluar/index.php";
		$title = "Kas Keluar";
		$cont = "assets/akutansi/kas_keluar/js.php";
    break;
	case "kkbk_s" :
		$modul = "assets/akutansi/kas_keluar/simpan.php";
		$title = "Kas Keluar";
		$cont = "assets/akutansi/kas_keluar/js.php";
    break;
	case "kkbk_ss" :
		$modul = "assets/akutansi/kas_keluar/simpan2.php";
		$title = "Kas Keluar";
		$cont = "assets/akutansi/kas_keluar/js.php";
    break;
	// kas masuk
	case "kmbm" :
		$modul = "assets/akutansi/kasmasuk/index.php";
		$title = "Kas/Bank masuk";
		$cont = "assets/akutansi/kasmasuk/js.php";
    break;
	case "kmbm_s" :
		$modul = "assets/akutansi/kasmasuk/simpan.php";
		$title = "Kas/Bank masuk";
		$cont = "assets/akutansi/kasmasuk/js.php";
    break;
	case "kmbm_ss" :
		$modul = "assets/akutansi/kasmasuk/simpan2.php";
		$title = "Kas/Bank masuk";
		$cont = "assets/akutansi/kasmasuk/js.php";
    break;
	// Bank Keluar
	case "bankkeluar" :
		$modul = "assets/akutansi/bank_keluar/index.php";
		$title = "Bank Keluar";
		$cont = "assets/akutansi/bank_keluar/js.php";
    break;
	case "bankkeluar_s" :
		$modul = "assets/akutansi/bank_keluar/simpan.php";
		$title = "Bank Keluar";
	break;
	case "bankkeluar_ss" :
		$modul = "assets/akutansi/bank_keluar/simpan2.php";
	break;
	// Bank Masuk  
	case "bankmasuk" :
		$modul = "assets/akutansi/bank_masuk/index.php";
		$title = "Bank Masuk";
		$cont = "assets/akutansi/bank_masuk/js.php";
    break;
	case "bankmasuk_s" :
		$modul = "assets/akutansi/bank_masuk/simpan.php";
		$title = "Bank Masuk";
	break;
	case "bankmasuk_ss" :
		$modul = "assets/akutansi/bank_masuk/simpan2.php";
	break;
	// pembayaran supplier 
	case "pembsupp" :
		$modul = "assets/akutansi/pembayaran_supplier/index.php";
		$title = "Pembayaran Supplier";
		$cont = "assets/akutansi/pembayaran_supplier/js.php";
    break;
	case "pembsupp_s" :
		$modul = "assets/akutansi/pembayaran_supplier/simpan.php";
		$title = "Pembayaran Supplier";
	break;
	case "pembsupp_ss" :
		$modul = "assets/akutansi/pembayaran_supplier/simpan2.php";
	break;
	case "pembsupp_v" :
		$modul = "assets/akutansi/pembayaran_supplier/view_stok.php";
		$title = "Pembayaran Supplier";
		$cont = "assets/akutansi/pembayaran_supplier/js_stok.php";
    break;
	
	// Pengakuan Hutang Non PO
	case "htnonpo" :
		$modul = "assets/akutansi/hutang_nonpo/index.php";
		$title = "Pengakuan Hutang Non PO";
		$cont = "assets/akutansi/hutang_nonpo/js.php";
    break;
	case "htnonpo_s" :
		$modul = "assets/akutansi/hutang_nonpo/simpan.php";
		$title = "Pengakuan Hutang Non PO";
		$cont = "assets/akutansi/hutang_nonpo/js.php";
    break;
	case "htnonpo_ss" :
		$modul = "assets/akutansi/hutang_nonpo/simpan2.php";
		$title = "Pengakuan Hutang Non PO";
		$cont = "assets/akutansi/hutang_nonpo/js.php";
    break;
	
	// master group inven			
	case "pakun" :
		$modul = "assets/master/pparamjur/index.php";
		$title = "Parameter Jurnal";
		$cont = "assets/master/pparamjur/js.php";
    break;
	case "pakun_s" :
		$modul = "assets/master/pparamjur/simpan.php";
		$title = "Parameter Jurnal";
		$cont = "assets/master/pparamjur/js.php";
    break;
	
	// master group inven			
	case "depaset" :
		$modul = "assets/master/depresiasi_jenis/index.php";
		$title = "Depresiasi Aset";
		$cont = "assets/master/depresiasi_jenis/js.php";
    break;
	case "depaset_s" :
		$modul = "assets/master/depresiasi_jenis/simpan.php";
		$title = "Depresiasi Aset";
		$cont = "assets/master/depresiasi_jenis/js.php";
    break;
	
	
	// master group inven			
	case "jum" :
		$modul = "assets/master/jenis_um/index.php";
		$title = "Jenis Uang Muka";
		$cont = "assets/master/jenis_um/js.php";
    break;
	case "jum_s" :
		$modul = "assets/master/jenis_um/simpan.php";
		$title = "Jenis Uang Muka";
		$cont = "assets/master/jenis_um/js.php";
    break;
	// master group inven			
	case "pph" :
		$modul = "assets/master/umpph/index.php";
		$title = "Uang Muka PPh";
		$cont = "assets/master/umpph/js.php";
    break;
	case "pph_s" :
		$modul = "assets/master/umpph/simpan.php";
		$title = "Uang Muka PPh";
		$cont = "assets/master/umpph/js.php";
    break;
	// budget entry
	case "budget" :
		$modul = "assets/akutansi/budget/index.php";
		$title = "Budget Entry";
		$cont = "assets/akutansi/budget/js.php";
    break;
	case "budgets" :
		$modul = "assets/akutansi/budget/simpan.php";
		//$title = "Budget Entry";
		//$cont = "assets/akutansi/budget/js.php";
    break;
	// Pengajuan Uang Muka
	case "pum" :
		$modul = "assets/akutansi/pum/index.php";
		$title = "Pengajuan Uang Muka";
		$cont = "assets/akutansi/pum/js.php";
    break;
	case "pum_s" :
		$modul = "assets/akutansi/pum/simpan.php";
		$title = "Pengajuan Uang Muka";
		$cont = "assets/akutansi/pum/js.php";
    break;
	case "pum_ss" :
		$modul = "assets/akutansi/pum/simpan2.php";
		$title = "Pengajuan Uang Muka";
		$cont = "assets/akutansi/pum/js.php";
    break;
	case "lapneraca" :
		$modul = "assets/laporan/lapneraca/index.php";
		$title = "Neraca";
		$cont = "assets/laporan/lapneraca/js.php";
    break;
	case "laparuskas" :
		$modul = "assets/laporan/laparuskas/index.php";
		$title = "Arus Kas";
		$cont = "assets/laporan/laparuskas/js.php";
    break;
	case "lapkasbank" :
		$modul = "assets/laporan/lapkasbank/index.php";
		$title = "Lap Kas/Bank";
		$cont = "assets/laporan/lapkasbank/js.php";
    break;
	
	case "lapneracasal" :
		$modul = "assets/laporan/lapneracasaldo/index.php";
		$title = "Neraca Saldo";
		$cont = "assets/laporan/lapneracasaldo/js.php";
    break;
	
	case "laplr" :
		$modul = "assets/laporan/laplabarugi/index.php";
		$title = "Laba Rugi";
		$cont = "assets/laporan/laplabarugi/js.php";
    break;
	case "lapjur" :
		$modul = "assets/laporan/lapjurnalumum/index.php";
		$title = "Jurnal Umum";
		$cont = "assets/laporan/lapjurnalumum/js.php";
    break;
	case "lapjurum" :
		$modul = "assets/laporan/lapjurum/index.php";
		$title = "Laporan Jurnal Umum";
		$cont = "assets/laporan/lapjurum/js.php";
    break;
	
	case "laptagang" :
		$modul = "assets/laporan/laptagang/index.php";
		$title = "Tagihan Angkutan";
		$cont = "assets/laporan/laptagang/js.php";
    break;
	
	case "laphutsupp" :
		$modul = "assets/laporan/laphutsupp/index.php";
		$title = "Laporan Hutang Supplier";
		$cont = "assets/laporan/laphutsupp/js.php";
    break;
	case "laphutsupp2" :
		$modul = "assets/laporan/laphutsupp2/index.php";
		$title = "Laporan Aging Hutang Supplier";
		$cont = "assets/laporan/laphutsupp2/js.php";
    break;
	case "laphutang" :
		$modul = "assets/laporan/laphutang/index.php";
		$title = "Laporan Aging Piutang Angkutan";
		$cont = "assets/laporan/laphutang/js.php";
    break;
	case "lapbph" :
		$modul = "assets/laporan/lapbph/index.php";
		$title = "Laporan Pengakuan Hutang Non PO";
		$cont = "assets/laporan/lapbph/js.php";
    break;
	case "lapgl" :
		$modul = "assets/laporan/lapbukubesar/index.php";
		$title = "Buku Besar";
		$cont = "assets/laporan/lapbukubesar/js.php";
    break;
	case "video" :
		$modul = "assets/tutor/video/index.php";
		$title = "Tutorial Video Sistem PT.Waru Abadi";
		$cont = "assets/tutor/video/js.php";
    break;
	case "buku" :
		$modul = "assets/tutor/buku/index.php";
		$title = "Tutorial Video Sistem PT.Waru Abadi";
		$cont = "assets/tutor/buku/js.php";
    break;
	case "biayaretribusitrans" :
		$modul = "assets/master/biayaretribusitrans/index.php";
		$title = "Master Retribusi Transfer";
		$cont = "assets/master/biayaretribusitrans/js.php";
    break;
	case "biayaretribusitrans_s" :
		$modul = "assets/master/biayaretribusitrans/simpan.php";
		$title = "Master Retribusi Transfer";
		$cont = "assets/master/biayaretribusitrans/js.php";
    break;
	case "pembex" :
		$modul = "assets/akutansi/pembayaran_expediture/index.php";
		$title = "Pembayaran Expediture";
		$cont = "assets/akutansi/pembayaran_expediture/js.php";
    break;
	case "pembex_s" :
		$modul = "assets/akutansi/pembayaran_expediture/simpan.php";
		$title = "Pembayaran Supplier";
	break;
	case "pembex_ss" :
		$modul = "assets/akutansi/pembayaran_expediture/simpan2.php";
	break;
	// Koreksi Harga Beli
	case "korhabel" :
		$modul = "assets/inventory/koreksihabel/index.php";
		$title = "Koreksi Harga Beli";
		$cont = "assets/inventory/koreksihabel/js.php";
    break;
	case "korhabel_s" :
		$modul = "assets/inventory/koreksihabel/simpan.php";
		$title = "Koreksi Harga Beli";
		$cont = "assets/inventory/koreksihabel/js.php";
    break;
	case "korhabel_v" :
		$modul = "assets/inventory/koreksihabel/view_stok.php";
		$cont = "assets/inventory/koreksihabel/js_stok.php";
    break;
	case "korhabel_c1" :
		$modul = "assets/inventory/koreksihabel/report.php";
    break;
	// laporan pengajuan uang muka
	case "lappum" :
		$modul = "assets/laporan/lappum/index.php";
		$title = "Laporan Pengajuan Uang Muka";
		$cont = "assets/laporan/lappum/js.php";
    break;
	// laporan penggunaan barang	
	case "lappgnbrng" :
		$modul = "assets/laporan/lappgnbrng/index.php";
		$title = "Penggunaan Barang";
		$cont = "assets/laporan/lappgnbrng/js.php";
    break;
	// Validasi
	case "vdasi" :
		$modul = "assets/backoffice/validasi/index.php";
		$title = "Validasi Pax";
		$cont = "assets/backoffice/validasi/js.php";
    break;
	case "vdasi_s" :
		$modul = "assets/backoffice/validasi/simpan.php";
		$title = "Validasi Pax";
		$cont = "assets/backoffice/validasi/js.php";
    break;
	case "vdasipos" :
		$modul = "assets/backoffice/validasi/indexpos.php";
		$title = "Posting Validasi Pax";
		$cont = "assets/backoffice/validasi/js.php";
    break;
	case "vdasipos_s" :
		$modul = "assets/backoffice/validasi/simpanposting.php";
		$title = "Posting Validasi Pax";
		$cont = "assets/backoffice/validasi/js.php";
    break;
	case "lapval" :
		$modul = "assets/laporan/lapval/index.php";
		$title = "Laporan Validasi";
		$cont = "assets/laporan/lapval/js.php";
    break;
	case "pegawai" :
		$modul = "assets/master/pegawai/index.php";
		$title = "Master Pegawai";
		$cont = "assets/master/pegawai/js.php";
    break;	
		case "brg_masuk_c" :
		$modul = "assets/inventory/brg_masuk/report.php";
		$cont = "assets/inventory/brg_masuk/js.php";
    break;
	case "lappembayaran" :
		$modul = "assets/laporan/lappembayaran/index.php";
		$title = "Laporan Detil Pembayaran Piutang";
		$cont = "assets/laporan/lappembayaran/js.php";
    break;	
}

/*$haktemp="";
$hak_a=$db->select("r_hak_menu","*","ID_USER='$_SESSION[ID_LOGIN]'");
foreach($hak_a as $hak_akses){
	$haktemp=$haktemp."".$hak_akses['ID_MENU'].",";
}
$akses_menu=rtrim($haktemp,',');
$array_akses_menu=explode(',',$akses_menu);   */

$haktemp="";
$hak_a=$db->select("m_role_dtl","*","ID_ROLE='$_SESSION[ID_ROLE]'");
foreach($hak_a as $hak_akses){
	$haktemp=$haktemp."".$hak_akses['id_menu'].",";
}
$akses_menu=rtrim($haktemp,',');
$array_akses_menu=explode(',',$akses_menu);



                
