<script>
 
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
			
		try{
			x = document.formku;
			if (x.nama.value.length == 0)
			{
				alert('Nama tidak boleh kosong!');
				x.nama.focus();
				return(false);
			}
			return(true);
			}catch(e){
				alert('Error '+ e.description);
			}
		}
</script>