<script>
 	function apes(){
		if($("#jenis").val()==1 || $("#jenis").val()==2 || $("#jenis").val()==3){
			$.get('assets/hrm/bonus/ambil.php?pegawai='+$("#pegawai").val(), function(data) {
					aa=data.split("_");
					$("#tgl_kontrak").val(aa[0]);
					$("#gaji_pokok").val(aa[1]);
					$("#tunj_tetap").val(aa[2]);
					$("#presensi").val(aa[3]);
					$("#total").val(aa[4]);
			});
		}
		if($("#jenis").val()==4){
			$.get('assets/hrm/bonus/ambil4.php?ikali='+$("#ifaktor_kali").val()+'&pegawai='+$("#pegawai").val(), function(data) {
					aa=data.split("_");
					$("#idcab").val(aa[0]);
					$("#namacab").val(aa[1]);
					$("#stpeg").val(aa[2]);
					$("#total").val(aa[3]);
					$("#faktor_kali").val(aa[4]);
					$("#jumlah_bonus").val(aa[5]);
					$("#tgl_kontrak").val(aa[6]);
			});
		}
		if($("#jenis").val()==5){
			$.get('assets/hrm/bonus/ambil5.php?ikali='+$("#ifaktor_kali").val()+'&pegawai='+$("#pegawai").val(), function(data) {
					alert(data);
					aa=data.split("_");
					$("#idpangkat").val(aa[0]);
					$("#pangkat").val(aa[1]);
					$("#total").val(aa[3]);
					$("#faktor_kali").val(aa[4]);
					$("#jumlah_bonus").val(aa[5]);
					$("#tgl_kontrak").val(aa[6]);
			});
		}
		if($("#jenis").val()==6){
			$.get('assets/hrm/bonus/ambil6.php?ikali='+$("#ifaktor_kali").val()+'&nilaiemas='+$("#nilaiemas").val()+'&pegawai='+$("#pegawai").val(), function(data) {
					aa=data.split("_");
					$("#tgl_kontrak").val(aa[0]);
					
			});
		}
	}
	function apes2(){
		
		$.get('assets/hrm/bonus/yearfrac.php?tgl_kontrak='+$("#tgl_kontrak").val()+'&periode='+$("#periode").val()+'&jenis='+$("#jenis").val()+'&nilaiemas='+$("#nilaiemas").val()+'&ikali='+$("#ifaktor_kali").val()+'&total='+$("#total").val(), function(data) {
				//alert(data);
				aa=data.split("_");
				$("#masa_kerja").val(aa[0]);
				$("#faktor_kali").val(aa[1]);
				$("#jumlah_bonus").val(aa[2]);
				$("#nilaitanda").val(aa[3]);
				$("#total2").val(aa[4]);
		});
		
		
	}
	$(".harga").number( true , 0 );
	$(".harga2").number( true , 1 );
	
	function pindah(j){
		location.href='index.php?x=bonus&id='+j;	
	}
	function pindahData(id,per,fk,ne){
		window.location="index.php?x=bonus&id="+id+"&per="+per+"&ne="+ne+"&fk="+fk;
	}
	function pindahDataa(id,per,fk,pb){
		window.location="index.php?x=bonus&id="+id+"&per="+per+"&pb="+pb+"&fk="+fk;
	}
	function pindahData2(id,jen){
		//alert(id);
		window.location="index.php?x=bonus_v&tahun="+id+"&jen="+jen;
	}
	function checkedAll(num){
    var id= document.getElementById('call');
    	if(id.checked==true){
			for (var i =1; i <= num; i++) 
    		{
			document.getElementById('split'+i).checked=true;
			}
		}else{
			for (var i =1; i <= num; i++) 
    		{
			document.getElementById('split'+i).checked=false;
    		}			
		}
      }
	  
$('#select-all').click(function(event) {   
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


function posting(){
if (confirm("Data Disetujui, apakah anda yakin?")) {
			$('#jenisnya').val('posting');
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
	
</script>