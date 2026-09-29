<script>
<?php if($_GET[jenis]==5 || $_GET[jenis]==1){?>
		$("#bank").show();
<?php } else { ?>
	$("#bank").hide();<?php } ?>
	
<?php if($_GET[jenis]==1){?>
	 	$("#kartu").show();
<?php } else { ?>
		$("#kartu").hide();<?php } ?>
		
	/*function pindahData2(cab,a,b,j){
		window.location="index.php?x=lapbm&cab="+cab+"&a="+a+"&b="+b+"&jenis="+j;
	}*/
	function pindahData(spb,tgl,unit1,spk){
		window.location="index.php?x=lapval&jenis="+spb+"&tgl="+tgl+"&unit="+unit1+"&spk="+spk;
	}
	function pindahData1(spb,tgl,unit1,spk,kartu){
		window.location="index.php?x=lapval&jenis="+spb+"&tgl="+tgl+"&unit="+unit1+"&spk="+spk+"&kartu="+kartu;
	}	
	
	function pindahData2(unit2,tgl){
		window.location="index.php?x=lapval&unit="+unit2+"&tgl="+tgl;
	}
	
	function pindahData3(tgl,unit2,jenis){
		window.location="index.php?x=lapval&unit="+unit2+"&tgl="+tgl+"&jenis="+jenis;
	}
	
	
	
	
</script>