<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 2,3,4,5 ]
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
	<?php 
	if($_GET['id']!=''){
	?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/retur/data.php?id=<?=$_GET['id']?>",
				"dataType": "jsonp"
				}
	} );
	<?php } ?>
	function com(id){
	}
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#qty_terima2').val($('#qty_terima'+id).val());
		$('#qty_kembali2').val($('#qty_kembali'+id).val());
		$('#satuan2').val($('#satuan'+id).val());
		$('#hpp2').val($('#hpp'+id).val());
		$('#sup2').val($('#sup'+id).val());
		$('#id_gudang').val($('#gudangs'+id).val());
		$('#hargabeli2').val($('#hargabeli'+id).val());
		$('#ket').val($('#keterangan'+id).val());
		if($('#qty_terima').val()==''){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function pindahData(id){
		//alert(id);
		window.location="index.php?x=retur&id="+id;
	}
	function hapus(id){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
	}
	function tambah_all(){
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
	function batal(){
		$('#aksi').val('batal');
		javascript: document.getElementById('formku').submit();
	}
	function pindahData(b,t){
		location.href='index.php?x=ijin_v&bulan='+b+'&tahun='+t;	
	}
	/*function pindah2(){
		$( "#jenis option:selected" ).each(function() {
			 if($(this).val()=='CT'){
				$("#tglrc").show();
			 }else{
				$("#tglrc").hide();
			 }
			});
	}*/

</script>