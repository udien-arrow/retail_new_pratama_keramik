<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 2 ]
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
				"url": "assets/master/satuan/data.php",
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
	 function tampilkanwaktu(){        
    var waktu = new Date();            
    var sh = waktu.getHours() + "";    
    var sm = waktu.getMinutes() + "";  
    var ss = waktu.getSeconds() + "";  
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
	
	function tambah1(){
	//alert("asd");
	str2=$('#tambah').serialize();
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
	
	$.ajax({
			type: "POST",
			url: "assets/absen/absenp/tambah.php?jen=tambah",
			data: "&"+str2+"&latitude="+latitude+"&longitude="+longitude,
			cache: false,
			success: function(result){
					//alert(result);
					alert("Sukses");
					//$('#datadt').html(data);
					//dataajax(result);
					//datareal(result);
					location.reload(); 
			}	
	});
} 

function showPosition(position) {
	latitude=position.coords.latitude;
	longitude=position.coords.longitude;
}
	
</script>