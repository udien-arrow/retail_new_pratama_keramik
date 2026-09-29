<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 0,1,2,3,4,5,6 ]
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
			
	} );
	function tambah(id){
		$('#id').val(id);
		$('#harga_in').val($('#harga'+id).val());
		$('#sat_in').val($('#sat'+id).val());
		if($('#harga_in').val()=='' || $('#sat_in').val()=='' || $('#supp').val()==''){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function hapus(id){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	function batal(){
		$('#aksi').val('batal');
		javascript: document.getElementById('formku').submit();
		
	}
	function ruwet(id,acno,dt){
		$('#klik').click();
		$.get('assets/hrm/upabsen/absensi.php?id='+id+'&acno='+acno+'&date='+dt, function(data) {
				$('#hahaha').html(data);    
		});
	}
	function ruwetall(id,tahun,bulan){
		$('#klikall').click();
		$.get('assets/hrm/upabsen/absensiall.php?id='+id+'&tahun='+tahun+'&bulan='+bulan, function(data) {
				$('#hahahaall').html(data);    
		});
	}
	function satuan(i){
		$("#sat"+i).load("assets/master/pricel/satuan.php?id="+i);	
	}
	function pindahData(b,t){
		location.href='index.php?x=upabsen&bulan='+b+'&tahun='+t;	
	}
	//$('.btn btn-default btn-icon kv-fileinput-upload').click(id);
	$(".kv-fileinput-upload").click(function(){
		alert('as');
	}); 
	

</script>