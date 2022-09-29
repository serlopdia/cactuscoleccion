<?php
 session_start();
   if (isset($_GET["desconectar"]) && $_GET["desconectar"]) {
	$_SESSION["login"] = null;
	header("Location: home_page.php");
}
?>