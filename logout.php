<?php
session_start();
$hs="index.php";
session_destroy();

echo "<script>location.href='$hs';</script>";
