<script>
function aa(){
	//alert('a');
	$(".datepicker").datepicker();
	 // Month and year menu
     $(".datepicker-menus").datepicker({
        changeMonth: true,
        changeYear: true
     });
}
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
        orderable: false,
            	targets: [ 2,3 ]
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
	<?php if($_GET['jen']!='' && $_GET['gud']!=''){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/salesorder/data.php?gud=<?=$_GET[gud]?>&jen=<?=$_GET[jen]?>",
				"dataType": "jsonp"
				}
	} );
	<?php }?>
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#sat_in').val($('#sat'+id).val());
		$('#qty_in').val($('#qty'+id).val());
		$('#tglkir_in').val($('#tglkir'+id).val());
		$('#harga_in').val($('#harga'+id).val());
		if($('#qty_in').val()==''){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function cekPel(){
		
		//$('#mod').click();
		$.get('assets/inventory/salesorder/plaf.php?id=<?=$_GET[cus]?>', function(data) {
				$('#hahaha').html(data);    
		});
	}
	
	function pindahdata(){
		window.location="index.php?x=salesorder&gud="+$('#gud').val()+"&jen="+$('#jen').val()+"&cus="+$('#cus').val();
	}
	function pindahdata2(){
		window.location="index.php?x=salesorder&gud="+$('#gud').val()+"&jen="+$('#jen').val()+"&cus=<?=$_GET[cus]?>";
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

	function satuan(i){
		$("#sat"+i).load("assets/master/pricel/satuan.php?id="+i);	
	}
	//function pel(){
		//alert('a');
		//$("#cus").load("assets/inventory/salesorder/pelanggan.php");	
		//cekPel();
	//}
function tampilspj(spj,jen){
		//alert(jen);
		$.get('assets/inventory/salesorder/spjtam.php?id='+spj+'&jen='+jen, function(data) {
			//alert(data);
				$('#spjtamp').html(data);    
		});
	}
function forma(){
		$(".hargab").number( true , 0 );
	}
$( "#jenispen" ).change(function () {
			$( "#jenispen option:selected" ).each(function() {				
				if($(this).val()=='SWC'){
					$("#spjr").show();
				}else if($(this).val()=='DA'){
					$("#spjr").hide();
				}else{
					$("#spjr").hide();
					$('#spjtamp').html('');    
				}
			});

 	  	});
$( "#spjrilis" ).change(function () {
			$( "#spjrilis option:selected" ).each(function() {				
					tampilspj($("#spjrilis").val(),'<?=$_GET['jen']?>');
			});
 	  	});		
		
</script>