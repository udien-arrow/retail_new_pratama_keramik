<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<script src="assets/js/js/jquery-ui.js"></script>
<script>


function pindahdata(){
		window.location="index.php?x=lapsumpenbar&jenis="+$('#jenis').val();
	}

function pindahdata2(jenis, jenis_jual){
		window.location="index.php?x=lapsumpenbar&jenis="+jenis+"&jenis_jual="+jenis_jual;
	}

function pindahdata3(jenis, jenis_bayar){
		window.location="index.php?x=lapsumpenbar&jenis="+jenis+"&jenis_bayar="+jenis_bayar;
	}

function pindahdata4(jenis, a, b){
var jual = $('#jenis_jual').val()
var bayar = $('#jenis_bayar').val()
	if ($("#jenis").val()==="2"){
		window.location="index.php?x=lapsumpenbar&jenis="+jenis+"&jenis_jual="+jual+"&a="+a+"&b="+b;
		
	}else if ($("#jenis").val()==="3"){
		window.location="index.php?x=lapsumpenbar&jenis="+jenis+"&jenis_bayar="+bayar+"&a="+a+"&b="+b;
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
		
		if($_GET['jenis']='2') {
	
	?>	
	 $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
			"url": "assets/laporan/lappenbarang/data.php?jenis=<?=$_GET[jenis]?>&jenis_jual=<?=$_GET[jenis_jual]?>&a=<?=$_GET[a]?>&b=<?=$_GET[b]?>",
				"dataType": "jsonp"
				}
	} );
	
<?php }else if($_GET['jenis']='3') {?>

		 $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
			"url": "assets/laporan/lappenbarang/data.php?jenis=<?=$_GET[jenis]?>&jenis_bayar=<?=$_GET[jenis_bayar]?>&a=<?=$_GET[a]?>&b=<?=$_GET[b]?>",
				"dataType": "jsonp"
				}
	} );


<?php }

 } ?>
 
</script>