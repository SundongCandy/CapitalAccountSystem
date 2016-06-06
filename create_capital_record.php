<?php
function createCapitalRecord($caId, $tradeVolume, $remainedCapital){
	$useTime = date("Y-m-d h:i:s");
	require 'connectDatabase.php';
	
	$sql = "insert into capitalrecord(caId, useTime, amount, remainedCapital) values($caId, '$useTime', $tradeVolume, $remainedCapital);";

	$result = mysql_query($sql, $con);

	if(!$result){
		die('Error: '.mysql_error());
	}

	// echo '<script> alert("Success! Your capital record ID is ' . mysql_insert_id() . '"); </script>';

	mysql_close($con);
}
?>