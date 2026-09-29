<?php 
if ( strtotime($_GET["tgls"]) > strtotime($_GET["skr"]) ) {
        $jadinya="salah";
   }else{
	    $jadinya="benar";
	  }
	
echo $jadinya;


?>