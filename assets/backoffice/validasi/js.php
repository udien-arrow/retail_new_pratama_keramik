<script>
<?php if($_GET[jenis]==5 || $_GET[jenis]==1){?>
		$("#bank").show();
<?php } else { ?>
	$("#bank").hide();<?php } ?>
	
	
<?php if($_GET[jenis]==1){?>
	 	$("#kartu").show();
<?php } else { ?>
		$("#kartu").hide();<?php } ?>
		
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,

            targets: [ 2,3,4,6,7]
			
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
				},
			"columns": [ 
						{ "data": 0},
						{ 
						  "data": null,
						  "render": function(data,type,row) { return "<input type='hidden' name='notx["+data[0]+"]' id='notx' value='"+data[1]+"'><input type='hidden' name='tgl1["+data[0]+"]' id='tgl1' value='<?=$_GET[tgl]?>'>"+data[1]+"";}},
						{ "data": 2},
						{ "data": 3},
						{ "data": 4},
						{ "data": 5},
						{ 
							"data": 6 //data is null since we want to access ALL data
										  //for the sake of our calculation below
							
						},
						{data:7},
						{data:8}
						
						],
			"columnDefs": [
				{ "visible": false, "targets": 0 }
				,
				{ 
							orderable: false,
							targets: [ 2,3,4,6,7]
							
						}
			]
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
				},
			"columnDefs": [
				{ "visible": false, "targets": 0 },
				{ 
							orderable: false,
							targets: [ 2,3,4,6,7]
							
						}
			]	
	 });
<?php } ?>
<?php if($_GET[jenis]==6){?>

	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/backoffice/validasi/dataref.php?tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>",
				"dataType": "jsonp"
				},
			"columnDefs": [
				{ "visible": false, "targets": 0 }
				,
					   { 
							orderable: false,
							targets: [ 2,3,6,7,8]
							
						}
			]		
				
	 });
<?php } ?>
<?php if($_GET[jenis]==1){?>

	 $('#example4').dataTable( {
				"processing": true,
				"serverSide": true,
				"ajax": "assets/backoffice/validasi/datacredit.php?tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>&spk=<?=$_GET[spk]?>&kartu=<?=$_GET[kartu]?>",
				"columns": [ 
						{ "data": 0},
						{ 
						  "data": null,
						  "render": function(data,type,row) { return "<input type='hidden' name='notx["+data[0]+"]' value='"+data[1]+"'>"+data[1]+"";}},
						{ "data": 2},
						{ "data": 3},
						{ "data": 4},
						{ "data": 5},
						{ 
							"data": 6 //data is null since we want to access ALL data
										  //for the sake of our calculation below
							
						},
						{data:7},
						{data:null,
						 "render": function(data,type,row) { return (data[7].replace(",","")*data[6])}},
						{data:9},
						{data:10,
						 }
						
						],
					"columnDefs": [
                       { "visible": false, "targets": 0 },
					   { 
							orderable: false,
							targets: [ 2,3,6,7,8,9]
							
						}
                     ]	

	} );
<?php } ?>
<?php if($_GET[jenis]==5){?>

	 /*$('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/backoffice/validasi/datamitra.php?tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>",
				"dataType": "jsonp"
				}
	 });*/
	 //$(document).ready(function() {
			$('#example4').dataTable( {
				"processing": true,
				"serverSide": true,
				"ajax": "assets/backoffice/validasi/datamitra.php?tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>&spk=<?=$_GET[spk]?>",
				"columns": [ 
						{ "data": 0},
						{ 
						  "data": null,
						  "render": function(data,type,row) { return "<input type='hidden' name='notx["+data[0]+"]' value='"+data[1]+"'>"+data[1]+"";}},
						{ "data": 2},
						{ "data": 3},
						{ "data": 4},
						{ "data": 5},
						{ 
							"data": 6 //data is null since we want to access ALL data
										  //for the sake of our calculation below
							 
						},
						{data:null,
						 "render": function(data,type,row) { return (data[6].replace(",","")*data[5])}},
						{data:8},
						{data:9}
						
						],
					"columnDefs": [
                       { "visible": false, "targets": 0 },
					   { 
							orderable: false,
							targets: [ 2,3,4,6,7,8]
							
						}
                     ],
				
				} );
				
			
		//} );
<?php } ?>
<?php if($_GET[jenis]==7){?>

	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": { 
				"url": "assets/backoffice/validasi/datavip.php?tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>",
				"dataType": "jsonp"
				},
				
			"columns": [ 
						{ "data": 0},
						{ 
						  "data": null,
						  "render": function(data,type,row) { return "<input type='hidden' name='notx["+data[0]+"]' id='notx' value='"+data[1]+"'><input type='hidden' name='tgl1["+data[0]+"]' id='tgl1' value='<?=$_GET[tgl]?>'>"+data[1]+"";}},
						{ "data": 2},
						{ "data": 3},
						{ "data": 4},
						{ "data": 5},
						{ 
							"data": 6 //data is null since we want to access ALL data
										  //for the sake of our calculation below
							
						},
						{data:7},
						{data:8}
						
						],
			"columnDefs": [
				{ "visible": false, "targets": 0 },
					   { 
							orderable: false,
							targets: [ 2,3,4,6,7,8]
							
						}
			]
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
		//javascript: document.getElementById('formku').submit();
		window.location="index.php?x=vdasi&jenis=<?=$_GET[jenis]?>&tgl=<?=$_GET[tgl]?>&unit=<?=$_GET[unit]?>&spk=<?=$_GET[spk]?>";
		
	}
	
	function pindahData(spb,tgl,unit1,spk){
		window.location="index.php?x=vdasi&jenis="+spb+"&tgl="+tgl+"&unit="+unit1+"&spk="+spk;
	}
	function pindahData1(spb,tgl,unit1,spk,kartu){
		window.location="index.php?x=vdasi&jenis="+spb+"&tgl="+tgl+"&unit="+unit1+"&spk="+spk+"&kartu="+kartu;
	}	
	
	function pindahData2(unit2,tgl){
		window.location="index.php?x=vdasi&unit="+unit2+"&tgl="+tgl;
	}
	
	function pindahData3(tgl,unit2,jenis){
		window.location="index.php?x=vdasi&unit="+unit2+"&tgl="+tgl+"&jenis="+jenis;
	}
	
</script>