<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,

            targets: [ 3 ]
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
				"url": "assets/master/amkategori/data.php",
				"dataType": "jsonp"
				}
	} );
	function edit(id){
		$('#id').val(id);
		javascript: document.getElementById('form_index').submit();
		
	}
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
function viewdk(a){
	//alert(a);
		//$('#mod').click();
		$.get('assets/master/amkategori/detil.php?id='+a, function(data) {
				$('#hahaha').html(data);
			});
		setTimeout(function(){ dataajax(a); }, 500);
		setTimeout(function(){ datareal(a); }, 1000);
		//dataajax(a);
		//datareal(a);
	}
	
function tambah1(){
	//alert("asd");
	str2=$('#tambah').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/amkategori/tambah.php?jen=tambah",
			data: "&"+str2,
			cache: false,
			success: function(result){
					//alert(result);
					alert("Sukses Tambah");
					//$('#datadt').html(data);
					dataajax(result);
					//datareal(result);
					$('#ketr').val('');
			}	
	});
}  


function hapustmp(a){
	//alert(a);
	$('#idreal').val(a);
	str2=$('#tambah').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/amkategori/tambah.php?jen=hapustmp",
			data: "&"+str2,
			cache: false,
			success: function(result){
					//alert(result);
					alert("Sukses");
					//$('#datadt').html(data);
					setTimeout(function(){ dataajax(result); }, 500);
					$('#idreal').val('');
					$('#ketr').val('');
					
			}	
	});
}  

function simpantmp(){
	//alert(a);
	str2=$('#tambah').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/amkategori/tambah.php?jen=simpan",
			data: "&"+str2,
			cache: false,
			success: function(result){
					//alert(result);
					alert("Sukses Simpan");
					//$('#datadt').html(data);
					setTimeout(function(){ dataajax(result); }, 500);
					setTimeout(function(){ datareal(result); }, 1000);
					$('#ketr').val('');
			}	
	});
}  

function editreal(a,b){
	$('#idreal').val(a);
	$('#ketr').val(b);
}

function dataajax(a) {
	$.get('assets/master/amkategori/datadt.php?id='+a, function(data) {
		$('#datadt').html(data);    
	});
} 

function datareal(a) {
	$.get('assets/master/amkategori/datareal.php?id='+a, function(data) {
		$('#datareal').html(data);    
	});
}  

</script>