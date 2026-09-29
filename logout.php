<?php
session_start();
//$hs="../../tgis-upg.cloudmnm.com";
//$hs="../../tgis";
$hs="../" . basename(__DIR__);
session_destroy();

echo "<script>location.href='$hs';</script>";
