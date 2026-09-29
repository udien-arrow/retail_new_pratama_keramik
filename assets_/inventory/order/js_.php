<script>
<?php
$jum=$db->jumlah_hari($_GET['bulan'],$_GET['tahun']);
?>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            <?php 
			$explo=explode("_",$_GET[tahap]);
			if($_GET[jenis]!='3'){?>
            	targets: [ 1,2,3,4 ]
			<?php }elseif($_GET['jenis']==3 && $explo[0]<5){?>
				targets: [ 2,3,4,5,6,7,8,9 ]
			<?php }elseif($_GET['jenis']==3 && $explo[0]==5){
				if($jum==30){?>
				targets: [ 2,3,4,5,6,7,8,9 ]
				<?php }if($jum==31){?>
				targets: [ 1,2,3,4,5,6,7,8,9,10 ]
				<?php }if($jum==29){?>
				targets: [ 2,3,4,5,6,7,8 ]
				<?php }if($jum==28){?>
				targets: [ 2,3,4,5,6,7 ]
				<?php }?>
			<?php }?>
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
	<?php if($_GET[jenis]=='1' AND empty($_GET[unt])){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/order/data.php?gud=<?=$_GET[gud]?>&jenis=<?=$_GET[jenis]?>",
				"dataType": "jsonp"
				}
	} );
	<?php }elseif($_GET[jenis]=='1' AND !empty($_GET[unt])){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/order/data3.php?gud=<?=$_GET[gud]?>&unt=<?=$_GET[unt]?>&jenis=<?=$_GET[jenis]?>&bulan=<?=$_GET[bulan]?>&tahun=<?=$_GET[tahun]?>&tahap=<?=$_GET[tahap]?>",
				"dataType": "jsonp"
				}
	} );
	
	<?php }elseif($_GET[jenis]=='3'){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/order/data2.php?gud=<?=$_GET[gud]?>&jenis=<?=$_GET[jenis]?>&bulan=<?=$_GET[bulan]?>&tahun=<?=$_GET[tahun]?>&tahap=<?=$_GET[tahap]?>",
				"dataType": "jsonp"
				}
	} );
	
	<?php }?>
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		
		$('#sat_in').val($('#sat'+id).val());
		$('#gud_in').val($('#gud').val());
		$('#tgl1_i').val($('#tgl1'+id).val());
		$('#tgl2_i').val($('#tgl2'+id).val());
		$('#tgl3_i').val($('#tgl3'+id).val());
		$('#tgl4_i').val($('#tgl4'+id).val());
		$('#tgl5_i').val($('#tgl5'+id).val());
		$('#tgl6_i').val($('#tgl6'+id).val());
		$('#tgl7_i').val($('#tgl7'+id).val());
		$('#tglkirin').val($('#tglkir'+id).val());
		
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
	function pindahData(jen,unit){
		
		window.location="index.php?x=order&jenis="+jen+"&gud="+$('#gudori').val()+"&unt="+unit;
		
	}
	function pindahData2(jen,gud){
		window.location="index.php?x=order&jenis="+jen+"&gud="+gud;
		
	}
	
	function pindahData3(jen,gud,bulan,tahun,tahap){
		
		window.location="index.php?x=order&jenis="+jen+"&gud="+gud+"&bulan="+bulan+"&tahun="+tahun+"&tahap="+tahap;
	}

	
	function caridata(id){
		$("#shipto").load("assets/inventory/order/carishipto.php?id="+id);	
	}
	//caridata(2);
/*$(document).ready(function(){
	alert('a');
	
	
});*/
function satuan(i){
		$("#sat"+i).load("assets/inventory/order/satuan.php?id="+i);	
	}
function cek(id){
	alert('a');
}	

</script>
<script>
function haha(){
			$('.datepicker').datepicker();
				 // Month and year menu
				 $('.datepicker-menus').datepicker({
					changeMonth: true,
					changeYear: true
				 });
}
			</script>