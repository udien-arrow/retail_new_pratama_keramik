<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 6,5,4,3 ]
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
				"url": "assets/inventory/kndn/data.php?id=<?=$_GET['id']?>",
				"dataType": "jsonp"
				}
	} );
	function com(id){
		
		
	}
	$("#cus").load("assets/inventory/salesorder/pelanggan.php");	
	function pindahdata3(){
		window.location="index.php?x=kndn_k&cus="+$('#cus').val();
	}
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val($('#gab'+id).val());
		$('#idbuku').val($('#jenisbg'+id).val());
		
		if($('#id').val()==''){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function pindahData(id){
		//alert(id);
		window.location="index.php?x=kndn&id="+id;
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