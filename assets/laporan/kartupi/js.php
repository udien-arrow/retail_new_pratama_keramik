<script>
	function pindahData2(cus){
		window.location="index.php?x=kartupi&cus="+cus;
	}
	function mutas(id){
		window.location="index.php?x=lappersediaan&gud=<?=$_GET[gud]?>&id="+id;
	}
	function pindah(gud,id,tg,tgsd){
		
		window.location="index.php?x=lappersediaan&gud="+gud+"&id="+id+"&tg="+tg+"&tgsd="+tgsd;
	}
	function satuan(i){	
		$("#sat"+i).load("assets/laporan/persediaan/mutasi.php?id="+i+"&gud=<?=$_GET[gud]?>");
	}
	function hitung(i){	
		$("#tes").load("assets/laporan/persediaan/hitung.php?id="+i+"&gud=<?=$_GET[gud]?>");
	}
	function satuan2(i,sat){
		hg=$("#harga_asli"+i).val();
		
		explo=sat.split("_");
		
		harga=parseFloat(hg)*parseInt(explo[1]);
		
		$("#harga"+i).val(harga);
	}
	
</script>