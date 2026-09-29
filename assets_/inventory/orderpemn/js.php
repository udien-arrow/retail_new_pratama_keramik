<script>
<?php
$jum=$db->jumlah_hari($_GET['bulan'],$_GET['tahun']);
?>
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
				"url": "assets/inventory/orderpemn/data.php?gud=<?=$_GET[gud]?>&jenis=<?=$_GET[jenis]?>",
				"dataType": "jsonp"
				}
	} );
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		
		$('#sat_in').val($('#sat'+id).val());
		$('#harga2').val($('#harga1'+id).val());
		$('#gud_in').val($('#gud').val());
		$('#tgl1_i').val($('#tgl1'+id).val());
		$('#tgl2_i').val($('#tgl2'+id).val());
		$('#tgl3_i').val($('#tgl3'+id).val());
		$('#tgl4_i').val($('#tgl4'+id).val());
		$('#tgl5_i').val($('#tgl5'+id).val());
		$('#tgl6_i').val($('#tgl6'+id).val());
		$('#tgl7_i').val($('#tgl7'+id).val());
		
		$('#qty_in1').val($('#qty1'+id).val());
		$('#qty_in2').val($('#qty2'+id).val());
		$('#qty_in3').val($('#qty3'+id).val());
		$('#qty_in4').val($('#qty4'+id).val());
		$('#qty_in5').val($('#qty5'+id).val());
		$('#qty_in6').val($('#qty6'+id).val());
		$('#qty_in7').val($('#qty7'+id).val());
		
		//alert('as');
		if($('#harga_in').val()=='' || $('#jenis').val()=='0'|| $('#gud').val()=='0'){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function tambah_all(){
		
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
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
	function pindahData(jen){
		window.location="index.php?x=orderpemn&jenis="+jen+"&gud="+$('#gudori').val();
		
	}
	function pindahData2(jen,gud){
		window.location="index.php?x=orderpemn&jenis="+jen+"&gud="+gud;
		
	}
	
	function pindahData3(jen,gud,bulan,tahun,tahap){
		
		window.location="index.php?x=order&jenis="+jen+"&gud="+gud+"&bulan="+bulan+"&tahun="+tahun+"&tahap="+tahap;
	}

	function satuan(i){
		$("#sat"+i).load("assets/master/pricel/satuan.php?id="+i);	
	}
	function caridata(id){
		$("#shipto").load("assets/inventory/order/carishipto.php?id="+id);	
	}
	//caridata(2);
/*$(document).ready(function(){
	alert('a');
	
	
});*/
function cek(id){
	alert('a');
}	

</script>