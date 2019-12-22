<?php
session_start();
setcookie('logged', '', time() - 3600);
setcookie('email', '', time() - 3600);
setcookie('id', '', time() - 3600);
setcookie('name', '', time() - 3600);

header("index.php");
?>