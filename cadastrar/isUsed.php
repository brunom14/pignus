<?php
	include '../db/conecta.php';
	
	$usuario = $_POST['usuario'];

	$query = mysqli_query($link, "SELECT * FROM tbusers WHERE usuario = '$usuario'");
	$rows = mysqli_num_rows($query);
	$result;
	if($rows == 1){
		$result = "t";//tem
 	}else{
 		$result = "n";//não tem
 	}

 	$json = "[{\"result\": \"$result\"}]";

	echo $json;


?>