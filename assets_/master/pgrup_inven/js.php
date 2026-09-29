<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<script src="assets/js/js/jquery-ui.js"></script>
<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 2 ]
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
	$( "#persediaan" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2, 
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }
    }
  
	});
	$( "#riject" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2, 
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }
    }
  
	});

	$( "#cogs" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#intransit" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#intransit" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#intransitcabang" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#sales" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#bongkar" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#muat" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#pok" ).autocomplete({
		source: "assets/master/pgrup_inven/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});

	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/pgrup_inven/data.php",
				"dataType": "jsonp"
				}
	} );
	function edit(id){
		$('#id').val(id);
		javascript: document.getElementById('form_index').submit();
		
	}
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
	function validate_frm()
	{
			
		
		}
</script>