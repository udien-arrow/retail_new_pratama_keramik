
<?php
	//$bulan='05';
	//$tahun='2013';
			$dt = strtotime("".$_GET['bulan']."/$i/".$_GET['tahun']."");
       
            $days =date('l',$dt);
            $hari ="";
            switch($days){
            case "Monday" :
            $hari = "Senin";
            break;
           
            case "Tuesday" :
            $hari ="Selasa";
            break;
           
            case "Wednesday";
            $hari ="Rabu";
            break;
           
            case "Thursday";
            $hari ="Kamis";
            break;
           
            case "Friday";
            $hari ="Jumat";
            break;
           
            case "Saturday";
            $hari ="Sabtu";
            break;
           
            case "Sunday";
            $hari ="Minggu";
            break;
           
           
            }
		
			//echo $hari;
			
			?>
            