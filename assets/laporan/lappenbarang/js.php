<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<script src="assets/js/js/jquery-ui.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel']
    } );
} );

function pindahdata(){
		window.location="index.php?x=lappenbar&jenis="+$('#jenis').val();
	}

function pindahdata2(jenis, barang){
		window.location="index.php?x=lappenbar&jenis="+jenis+"&barang="+barang;
	}

function pindahdata3(jenis, toko){
		window.location="index.php?x=lappenbar&jenis="+jenis+"&toko="+toko;
	}

function pindahdata4(jenis, a, b){
var barang = $('#barang').val()
var toko = $('#toko').val()
	if ($("#jenis").val()==="1"){
		window.location="index.php?x=lappenbar&jenis="+jenis+"&barang="+barang+"&a="+a+"&b="+b;
		
	}else if ($("#jenis").val()==="2"){
		window.location="index.php?x=lappenbar&jenis="+jenis+"&toko="+toko+"&a="+a+"&b="+b;
		}
	}
		
	
	$.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 1,2,4,5,6,7,8,9,10 ]
        }],
         dom: '<"datatable-header"f><"datatable-scroll"t>',
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
	if($_GET['a']!='' || $_GET['b']!='' ){
		
		if($_GET['jenis']='1') {
	
	?>
	
	
	
		
	 $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
			"url": "assets/laporan/lappenbarang/data.php?jenis=<?=$_GET[jenis]?>&barang=<?=$_GET[barang]?>&a=<?=$_GET[a]?>&b=<?=$_GET[b]?>",
				"dataType": "jsonp"
				}
	} );
	
<?php }else if($_GET['jenis']='2') {?>

		 $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
			"url": "assets/laporan/lappenbarang/data.php?jenis=<?=$_GET[jenis]?>&toko=<?=$_GET[toko]?>&a=<?=$_GET[a]?>&b=<?=$_GET[b]?>",
				"dataType": "jsonp"
				}
	} );


<?php }

 } ?>
 
 
</script>