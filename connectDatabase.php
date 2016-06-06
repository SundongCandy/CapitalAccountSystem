<?php
$con = mysql_connect("localhost", "se", "se");
if(!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);
?>