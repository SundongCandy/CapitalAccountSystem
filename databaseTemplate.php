<?php
$con = mysql_connect("localhost", "se", "se");
if(!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$sql = "";//insert, select, update, delete

//mysql_query($sql, $con);
$result = mysql_query($sql, $con);

while($row = mysql_fetch_array($result)){
	//each item of the result
}

mysql_close($con);
?>