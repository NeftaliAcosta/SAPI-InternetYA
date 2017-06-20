<?php

session_start();
session_destroy();
unset ($_COOKIE['id']);
header("location:index.php");
?>

