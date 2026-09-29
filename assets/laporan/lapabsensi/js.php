<script>
	 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 1,2,3,4,5,6,7,8,9,10,11 ]
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
	

 	function apes(){
		if($("#jenis").val()==1 || $("#jenis").val()==2 || $("#jenis").val()==3){
			$.get('assets/hrm/bonus/ambil.php?pegawai='+$("#pegawai").val(), function(data) {
					aa=data.split("_");
					$("#tgl_kontrak").val(aa[0]);
					$("#gaji_pokok").val(aa[1]);
					$("#tunj_tetap").val(aa[2]);
					$("#presensi").val(aa[3]);
					$("#total").val(aa[4]);
			});
		}
		if($("#jenis").val()==4){
			$.get('assets/hrm/bonus/ambil4.php?ikali='+$("#ifaktor_kali").val()+'&pegawai='+$("#pegawai").val(), function(data) {
					aa=data.split("_");
					$("#idcab").val(aa[0]);
					$("#namacab").val(aa[1]);
					$("#stpeg").val(aa[2]);
					$("#total").val(aa[3]);
					$("#faktor_kali").val(aa[4]);
					$("#jumlah_bonus").val(aa[5]);
					$("#tgl_kontrak").val(aa[6]);
			});
		}
		if($("#jenis").val()==5){
			$.get('assets/hrm/bonus/ambil5.php?ikali='+$("#ifaktor_kali").val()+'&pegawai='+$("#pegawai").val(), function(data) {
					alert(data);
					aa=data.split("_");
					$("#idpangkat").val(aa[0]);
					$("#pangkat").val(aa[1]);
					$("#total").val(aa[3]);
					$("#faktor_kali").val(aa[4]);
					$("#jumlah_bonus").val(aa[5]);
					$("#tgl_kontrak").val(aa[6]);
			});
		}
		if($("#jenis").val()==6){
			$.get('assets/hrm/bonus/ambil6.php?ikali='+$("#ifaktor_kali").val()+'&nilaiemas='+$("#nilaiemas").val()+'&pegawai='+$("#pegawai").val(), function(data) {
					aa=data.split("_");
					$("#tgl_kontrak").val(aa[0]);
					
			});
		}
	}
	function apes2(){
		$.get('assets/hrm/bonus/yearfrac.php?tgl_kontrak='+$("#tgl_kontrak").val()+'&periode='+$("#periode").val()+'&jenis='+$("#jenis").val()+'&nilaiemas='+$("#nilaiemas").val()+'&ikali='+$("#ifaktor_kali").val()+'&total='+$("#total").val(), function(data) {
				aa=data.split("_");
				$("#masa_kerja").val(aa[0]);
				$("#faktor_kali").val(aa[1]);
				$("#jumlah_bonus").val(aa[2]);
				$("#nilaitanda").val(aa[3]);
				$("#total2").val(aa[4]);
		});
	}
	$(".harga").number( true , 0 );
	$(".harga2").number( true , 1 );
	
	function pindah(j){
		location.href='index.php?x=bonus&id='+j;	
	}
	function pindahData(id,bul,cab){
		window.location="index.php?x=lapabsensi&cab="+cab+"&tahun="+id+"&bulan="+bul;
	}
	$(".dataTables_length").hide();
	$(".datatable-footer").hide();
	$(".dataTables_filter").hide();
	
</script>