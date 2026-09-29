<script>

 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 2,3,4,5,6 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari Data:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/pegawai/data.php",
				"dataType": "jsonp"
				}
	} );
	function edit(id){
		$('#id').val(id);
		javascript: document.getElementById('form_index').submit();
		
	}
	function detil(id){
		window.location="index.php?x=pegawai&cd=b2&id="+id;	
	}
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
function save(kode){
	str=$('#addpeg').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=pegawai",
			data: "kode="+kode+"&str="+str+"&namanya="+$('#nm_pegawai').val(),
			cache: false,
			success: function(result){
					$('#kode').val(result);
					$("#kode").click();
					alert('sukses!!');
			}
			
	});
}   
$("#kode").click(function(event){
		//alert('a');
		dataajax()
		datafinger()
		dataemer()
		dataalamat()
		datapendidikan()
		datastatuskel()
		datakedudukan()
		datakontrak()
		datapengalaman()
});
///============================================================================bank==============================
function savebank(){
	str2=$('#bankacc').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=bank",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					dataajax();
					$('#idbank').val('');
					$('#nama_bank').val('');
					$('#no_rek').val('');
					
					alert('Sukses Simpan Data Bank, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     

function dataajax() {
	$.get('assets/master/pegawai/isi.php?tp=bank&idpeg='+$('#kode').val(), function(data) {
		$('#dataacc').html(data);    
	});
}
function editbank(id,nama,rek,jen) {
	$('#idbank').val(id);
	$('#nama_bank').val(nama);
	$('#no_rek').val(rek);
		
}
function hapusbank(id) {
	$.get('assets/master/pegawai/delete.php?tp=bank&id='+id, function(data) {
		alert('Sukses');
		dataajax()
	});
}
///============================================================================finger==============================
function savefinger(){
	str2=$('#fingerform').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=finger",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					datafinger();
					$('#idfinger').val('');
					$('#acno').val('');
					alert('Sukses Simpan Data Finger, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     
function datafinger() {
	$.get('assets/master/pegawai/isi.php?tp=finger&idpeg='+$('#kode').val(), function(data) {
		$('#datafinger').html(data);    
	});
}
function editfinger(id,ac) {
	$('#idfinger').val(id);
	$('#acno').val(ac);
	
}
function hapusfinger(id) {
	$.get('assets/master/pegawai/delete.php?tp=finger&id='+id, function(data) {
		alert('Sukses');
		datafinger()
	});
}
///============================================================================emer==============================
function saveemer(){
	str2=$('#emerform').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=emer",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					dataemer();
					$('#id_hub').val('');
					$('#nama_hub').val('');
					$('#hub').val('');
					$('#no_hp').val('');
					$('#no_telp').val('');
					alert('Sukses Simpan Data Emergency, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     

function dataemer() {
	$.get('assets/master/pegawai/isi.php?tp=emer&idpeg='+$('#kode').val(), function(data) {
		$('#dataemer').html(data);    
	});
}
function editemer(id,nm_hub,hub,hp,telp) {
	$('#id_hub').val(id);
	$('#nama_hub').val(nm_hub);
	$('#hub').val(hub);
	$('#no_hp').val(hp);	
	$('#no_telp').val(telp);	
}
function hapusemer(id) {
	$.get('assets/master/pegawai/delete.php?tp=emer&id='+id, function(data) {
		alert('Sukses');
		dataemer()
	});
}
///============================================================================alamat==============================
function savealamat(){
	str2=$('#alamatform').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=alamat",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					dataalamat();
					$('#id_alamat').val('');
					$('#alamat').val('');
					$('#ket').val('');
					alert('Sukses Simpan Data Alamat, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     

function dataalamat() {
	$.get('assets/master/pegawai/isi.php?tp=alamat&idpeg='+$('#kode').val(), function(data) {
		$('#dataalamat').html(data);    
	});
}
function editalamat(id,alam,ket) {
	$('#id_alamat').val(id);
	$('#alamat').val(alam);
	$('#ket').val(ket);
}
function hapusalamat(id) {
	$.get('assets/master/pegawai/delete.php?tp=alamat&id='+id, function(data) {
		alert('Sukses');
		dataalamat()
	});
}
///============================================================================pendidikan==============================
function savependidikan(){
	str2=$('#pendidikanform').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=pendidikan",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					datapendidikan();
					$('#id_pend').val('');
					$('#nama_pend').val('');
					$('#tahun_awal').val('');
					$('#tahun_akhir').val('');
					$('#tempat').val('');
					$('#ketp').val('');
					$('#jurusan').val('');
					$('#universitas').val('');
					$('#nomor_ijazah').val('');
					$('#tgl_lulus').val('');
					$('#nilai').val('');
					alert('Sukses Simpan Data Pendidikan, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     

function datapendidikan() {
	$.get('assets/master/pegawai/isi.php?tp=pendidikan&idpeg='+$('#kode').val(), function(data) {
		$('#datapendidikan').html(data);    
	});
}
function editpendidikan(id,namap,temp,taw,tak,ket,jurs,univ,nomori,tgllu,nilai) {
	$('#id_pend').val(id);
	$('#nama_pend').val(namap);
	$('#tempat').val(temp);
	$('#tahun_awal').val(taw);
	$('#tahun_akhir').val(tak);
	$('#ketp').val(ket);
	$('#jurusan').val(jurs);
	$('#universitas').val(univ);
	$('#nomor_ijazah').val(nomori);
	$('#tgl_lulus').val(tgllu);
	$('#nilai').val(nilai);
}
function hapuspendidikan(id) {
	$.get('assets/master/pegawai/delete.php?tp=pendidikan&id='+id, function(data) {
		alert('Sukses');
		datapendidikan()
	});
}
///============================================================================statuskel==============================
function savestatuskel(){
	str2=$('#statuskelform').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=statuskel",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					datastatuskel();
					$('#statuskel').val('');
					$('#id_statuskel').val('');
					$('#anak').val('');
					alert('Sukses Simpan Data Status Keluar, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     
function datastatuskel() {
	$.get('assets/master/pegawai/isi.php?tp=statuskel&idpeg='+$('#kode').val(), function(data) {
		$('#datastatuskel').html(data);    
	});
}
function editstatuskel(id,ac,anak) {
	$('#statuskel').val(id);
	$('#id_statuskel').val(ac);
	$('#anak').val(anak);
}
function hapusstatuskel(id) {
	$.get('assets/master/pegawai/delete.php?tp=statuskel&id='+id, function(data) {
		alert('Sukses');
		datastatuskel()
	});
}
///============================================================================kedudukan==============================
function savekedudukan(){
	str2=$('#kedudukanform').serialize();
	$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: "assets/master/pegawai/simpanab.php?jen=kedudukan",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					datakedudukan();
					$('#nmjab').val('');
					$('#id_tdjab').val('');
					$('#golongan').val('');
					$('#pangkat').val('');
					$('#nosk').val('');
					$('#tglsk').val('');
					$('#tgljab').val('');
					$('#ketk').val('');
					$('#caba').val('');
					$('#stjab').val('');
					$('#uploadImage').val('');
					alert('Sukses Simpan Data Kedudukan, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     
function datakedudukan() {
	$.get('assets/master/pegawai/isi.php?tp=kedudukan&idpeg='+$('#kode').val(), function(data) {
		$('#datakedudukan').html(data);    
	});
}
function editkedudukan(id,a,b,c,d,e,f,g,h,i) {
	$('#id_tdjab').val(id);
	$('#nmjab').val(a);
	$('#golongan').val(b);
	$('#pangkat').val(c);
	$('#nosk').val(d);
	$('#tglsk').val(e);
	$('#tgljab').val(f);
	$('#ketk').val(g);
	$('#caba').val(h);
	$('#stjab').val(i);
}
function hapuskedudukan(id) {
	$.get('assets/master/pegawai/delete.php?tp=kedudukan&id='+id, function(data) {
		alert('Sukses');
		datakedudukan()
	});
}
///============================================================================kontrak==============================
function savekontrak(){
	str2=$('#kontrakform').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=kontrak",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					datakontrak();
					$('#idstatus').val('');
					$('#id_kontrak').val('');
					$('#nikhon').val('');
					$('#aktif').val('');
					$('#nosk').val('');
					$('#tglmulai').val('');
					$('#tglakhir').val('');
					$('#ketko').val('');
					alert('Sukses Simpan Data Status Kepegawaian, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     
function datakontrak() {
	$.get('assets/master/pegawai/isi.php?tp=kontrak&idpeg='+$('#kode').val(), function(data) {
		$('#datakontrak').html(data);    
	});
}
function editkontrak(id,a,b,c,d,e,f,g) {
	$('#id_kontrak').val(id);
	$('#idstatus').val(a);
	$('#aktif').val(b);
	$('#nosk').val(c);
	$('#tglmulai').val(d);
	$('#tglakhir').val(e);
	$('#ketko').val(f);
	$('#nikhon').val(g);
}
function hapuskontrak(id) {
	$.get('assets/master/pegawai/delete.php?tp=kontrak&id='+id, function(data) {
		alert('Sukses');
		datakontrak()
	});
}
///============================================================================pengalaman==============================
function savepengalaman(){
	str2=$('#pengalamanform').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/pegawai/simpanab.php?jen=pengalaman",
			data: "&"+str2+"&idpeg="+$('#kode').val(),
			cache: false,
			success: function(result){
					//alert(result);
					datapengalaman();
					$('#id_peru').val('');
					$('#nama_peru').val('');
					$('#tahun_mulai').val('');
					$('#tahun_akh').val('');
					$('#bagian').val('');
					$('#jabat').val('');
					alert('Sukses Simpan Data Pengalaman, Nama Pegawai '+$('#nm_pegawai').val());
			}	
	});
}     

function datapengalaman() {
	$.get('assets/master/pegawai/isi.php?tp=pengalaman&idpeg='+$('#kode').val(), function(data) {
		$('#datapengalaman').html(data);    
	});
}
function editpengalaman(id,namap,thm,tha,bagian,jab) {
	$('#id_peru').val(id);
	$('#nama_peru').val(namap);
	$('#tahun_mulai').val(thm);
	$('#tahun_akh').val(tha);
	$('#bagian').val(bagian);
	$('#jabat').val(jab);
}
function hapuspengalaman(id) {
	$.get('assets/master/pegawai/delete.php?tp=pengalaman&id='+id, function(data) {
		alert('Sukses');
		datapengalaman()
	});
}
$("#kode").click();
</script>