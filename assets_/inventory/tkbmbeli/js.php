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
	function kenda(i){
		$("#kenda"+i).load("assets/inventory/tkbmbeli/kenda.php");	
	}
	<?php 
	if($_GET['id']!=''){
	?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/tkbmbeli/data.php?id=<?=$_GET['id']?>&jenis=<?=$_GET['jenis']?>",
				"dataType": "jsonp"
				}
	} );
	<?php } ?>
	function com(id){
		
		
	}
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#gabung').val($('#gab'+id).val());
		$('#qty').val($('#qty_bongkar'+id).val());
		$('#kendara').val($('#kenda'+id).val());
		//alert('a');
		if($('#qty').val()=='' || $('#jenis').val()==''){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function pindahData(id,jen){
		window.location="index.php?x=tkbmbeli&id="+id+"&jenis="+jen;
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

function cak(tgls,skr){
	$.get('assets/inventory/brg_masuk/mode.php?tgls='+tgls+'&skr='+skr, function(data) {
				if(data=='salah'){
					$("#tgl").val($("#tgl2").val());	
				}	  
		});

}

</script>