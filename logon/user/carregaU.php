<?php
			require '../../db/bdajax.php';

			session_start();

			$cod = $_SESSION['cod']; 

			$json = "[{\"cod\": \"$cod\"}]";

			echo $json;
?>