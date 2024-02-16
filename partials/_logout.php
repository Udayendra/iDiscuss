<?php
session_start();
echo 'logging you out. pleaze wait...';
session_destroy();
header("location: ../index.php")
?>