<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 5 ]
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
				"url": "assets/akutansi/app_pum/data.php?jenis=<?=$_GET['jenis']?>",
				"dataType": "jsonp"
				}
	} );
	
	function pindahData(jen){
		window.location="index.php?x=app_pum&jenis="+jen;
		
	}
	
	function appsetuju(id){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenisnya').val('setuju');
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
	function apptolak(id){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenisnya').val('tolak');
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
function viewdk(a,b){
		$('#nobis').val($('#nobi'+a).val());
		//$('#mod').click();
		$.get('assets/inventory/app_pemba/detil.php?id='+a+'&pt='+b, function(data) {
				$('#hahaha').html(data);    });
	}

function pindah(a,b){
	$.ajax({
			type: "POST",
			url: "assets/inventory/app_pemba/simpanab.php",
			data: "spj="+a,
			cache: false,
			success: function(result){
					//alert(result);
					alert('Sukses Simpan');
					$('#datapelanggan').modal('hide');
					window.location='index.php?x=app_pemba&id='+b;
			}	
	});
}

function hapus(id){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}

</script>