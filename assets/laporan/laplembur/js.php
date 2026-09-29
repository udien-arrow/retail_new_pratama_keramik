<script>
	 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 1,2,3,4,5,6,7,8 ]
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
	<?php if($_GET['cab']!=''){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/hrm/lembur/data.php?bulan=<?=$_GET['bulan']?>&tahun=<?=$_GET['tahun']?>&cab=<?=$_GET['cab']?>",
				"dataType": "jsonp"
				}
	} );
	<?php  }?>
	$('#call').click(function() {
		if($(this).is(':checked'))
			$('.split').prop('checked', true);
		else
			$('.split').prop('checked', false);
	});
	
 	$(".harga").number( true , 0 );
	$(".harga2").number( true , 1 );
	function pindah(j){
		location.href='index.php?x=bonus&id='+j;	
	}
	function pindahData(id,bul,cb){
		window.location="index.php?x=lembur&tahun="+id+"&bulan="+bul+"&cab="+cb;
	}
	function pindahData2(id,bul,cab){
		window.location="index.php?x=laplembur&tahun="+bul+"&cab="+cab+"&bulan="+id;
	}
	$(".dataTables_length").hide();
	$(".datatable-footer").hide();
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
	
</script>