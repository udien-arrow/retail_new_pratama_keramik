<script>

 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,

            targets: [ 2,3,4,6]
			
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
	
<?php if($_GET[jenis]==3){?>

	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/backoffice/validasi/datacash.php?tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>",
				"dataType": "jsonp"
				}
	 });
	 function hitung(){
		var harga=$('#harga').val();
		var qty=$('#qty').val();
		
		$('#total').val(harga*qty);	 
	 }
<?php } ?>
<?php if($_GET[jenis]==2){?>

	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/backoffice/validasi/datadebet.php?tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>",
				"dataType": "jsonp"
				}
	 });
<?php } ?>
<?php if($_GET[jenis]==6){?>

	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/backoffice/validasi/dataref.php?tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>",
				"dataType": "jsonp"
				}
	 });
<?php } ?>
	
	function tambah_all(){
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
	function hapus(id){
		$('#id2').val(id);
		
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	
	function checkall(){
		if($('#call').is(':checked')){
			$(':checkbox').each(function() {
				this.checked = true;                        
			});
		} else {
				$(':checkbox').each(function() {
				this.checked = false;                        
			});

		}
	}
	
	
	function batal(supp){
		$('#aksi').val('batal');
		$('#supp2').val(supp);
		javascript: document.getElementById('formku').submit();
		
	}
	function pindahData(spb,tgl,unit1){
		window.location="index.php?x=vdasi&jenis="+spb+"&tgl="+tgl+"&unit="+unit1;
	}
	

</script>