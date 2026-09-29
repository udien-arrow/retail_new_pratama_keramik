<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100%',
            targets: [ 2,3,4,5,6,7,8 ]
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
				"url": "assets/inventory/prp_notif/data_notif.php?spb=<?=$_GET[spb]?>&jenis=<?=$_GET[jenis]?>&supp=<?=$_GET[supp]?>",
				"dataType": "jsonp"
				}
	} );

	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#qty_in').val($('#qty'+id).val());
		$('#sat_in').val($('#sat'+id).val());
		$('#harga_in').val($('#harga'+id).val());
		$('#bonus_in').val($('#bonus'+id).val());
		$('#disc_in').val($('#disc'+id).val());
		
		if($('#harga_in').val()=='' || $('#qty').val()=='0'){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function tambah_all(){
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
	function hapus(id){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	function batal(supp){
		$('#aksi').val('batal');
		$('#supp2').val(supp);
		javascript: document.getElementById('formku').submit();
		
	}
	function pindahData(spb){
		window.location="index.php?x=prp_notif&jenis="+spb+"&spb=";
		
	}
	function pindahData2(jen,spb){
		window.location="index.php?x=prp_notif&jenis="+jen+"&spb="+spb;
		
	}
	function pindahData3(gud,supp){
		window.location="index.php?x=prp_notif&gud="+gud+"&supp="+supp;
		
	}

	function satuan(i,sat){
		
		$("#sat"+i).load("assets/inventory/prp_notif/satuan.php?id="+i+"&jenis=<?=$_GET[jenis]?>&spb=<?=$_GET[spb]?>&supp=<?=$_GET[supp]?>&cd=b2");
	}
	function satuan2(i,sat){
		hg=$("#harga_asli"+i).val();
		
		explo=sat.split("_");
		
		harga=parseFloat(hg)*parseInt(explo[1]);
		
		$("#harga"+i).val(harga);
	}
	function hitung(idsupp){
		if($("#dg_persen"+idsupp).val()==''){
			$("#grant"+idsupp).val($("#grant2"+idsupp).val());
			$("#dg_rupiah"+idsupp).val('');
		}else{
			disc_jumlah=parseInt($("#grant2"+idsupp).val()*($("#dg_persen"+idsupp).val()/100));
			subt=parseInt($("#grant2"+idsupp).val()-disc_jumlah );
			$("#grant"+idsupp).val(subt);
			$("#dg_rupiah"+idsupp).val(disc_jumlah);
		}
	}
	function hitung2(idsupp){
			disc_jumlah=parseInt($("#grant2"+idsupp).val() - $("#dg_rupiah"+idsupp).val());
			
			total=parseInt(disc_jumlah);
			discper=($("#dg_rupiah"+idsupp).val()*100)/$("#grant2"+idsupp).val();
			$("#dg_persen"+idsupp).val(discper.toFixed(2));
			$("#grant"+idsupp).val(total);
		
	}



</script>