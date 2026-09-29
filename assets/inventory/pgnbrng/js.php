<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
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
	<?php 
	if($_GET['a']!=''){
	
	?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/pgnbrng/data.php?a=<?=$_GET['a']?>",
				"dataType": "jsonp"
				}
	} );
	<?php } ?>
	
	function com(id){
		
		
	}
	

	function tambah(id){
		
		$('#tambah_in').val('ijen');
		$('#id_barangku').val(id);
		$('#qty_masukku').val($('#qty_masuk'+id).val());
		$('#hppku').val($('#hpp'+id).val());
		$('#wasteku').val($('#waste'+id).val());
		$('#sisaku').val($('#sisa'+id).val());
		$('#id_satuanku').val($('#id_satuan'+id).val());
		if( $('#wasteku').val()=='' || $('#sisaku').val()==''){
			alert('Data tidak lengkap');	
		//}else if($('#sisa'+id).val()>$('#qty_masuk'+id).val()){
	//		alert("Maaf Melebihi Permintaan" + $('#sisa'+id).val());
		}else {
			javascript: document.getElementById('form_index').submit();
		}
	}
	
	function tambah_all(){
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
	
	/*function pindahData2(a){
		window.location="index.php?x=brgkeluar&jenis="+a;
	}*/
	function pindahData2(a,b){
		window.location="index.php?x=pgnbrng&a="+a+"&b="+b;
	}
	function pindahData(a,b){
		window.location="index.php?x=pgnbrng&jenis="+a+"&id="+b;
	}
	function hapus(id,tgl){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	
	function batal(){
		$('#aksi').val('batal');
		javascript: document.getElementById('formku').submit();
		
	}

	function selisih(d){
		alert($("#tes"+d).val());
		stok=$("#tes").val();
		fisik=$("#stokfisik").val();
		selisih = stok-fisik;
		$("#selisih").val(selisih);
	}

	function satuan(i,g){
		//alert(g);
		$("#stok_sys"+i).load("assets/inventory/stok_opname/mutasi.php?id="+i+"&gudang="+g);	
	}
	//$('.btn btn-default btn-icon kv-fileinput-upload').click(id);
	$(".kv-fileinput-upload").click(function(){
		alert('as');
	}); 
	function forma(){
		$(".hargab").number( true , 0 );
	}

	
$('#cek_all').click(function(event) {   
     if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});
</script>