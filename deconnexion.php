<?php
session_start();
session_unset();
session_destroy();
unset($_COOKIE['PHPSESSID']);
header('Location: index.php');
?>