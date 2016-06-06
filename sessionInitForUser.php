<?php
//judge whether the user is logged in
if(!isset($_SESSION['user'])){
	header("Location: index.php");
}
?>