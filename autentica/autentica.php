<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Error ao logar</title>
</head>
<body>

</body>
</html>
<?php
	//include '../db/*';
	require '../db/bdajax.php';	
	require '../db/conecta.php';
	
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	$query = mysqli_query($link, "SELECT * FROM tbusers WHERE usuario = '$usuario'");
	$rows = mysqli_num_rows($query);
	$cod;
	$hash;
	$nome;
	$email;
	if($rows == 1){
		$result = DBRead('tbusers',"WHERE usuario = '$usuario'","COD, senha, nome, email");
		foreach ($result as $value) {
        	$cod = $value['COD'];
        	$hash = $value['senha'];
        	$nome = $value['nome'];
        	$email = $value['email'];
        }
 		if (password_verify($senha, $hash)) {
 			$_SESSION['cod'] = $cod;
 			$_SESSION['nome'] = $nome;
 			$_SESSION['email'] = $email;
	 		
	 		echo $_SESSION['cod'];
	 		header("Location: ../logon/index.php");
	 		
		} else {
    		echo"
				<script type='text/javascript'>
					alert('Usuario ou senha incorretos');
					window.location.href='../index.html';
				</script>
			";

		}

 		
 				
 	}else{
 		//retorna a pagina inicial
 		echo"
			<script type='text/javascript'>
				alert('Usuario ou senha incorretos');
				window.location.href='../index.html';
			</script>
		";
 		//header("Location: ../index.html");
 	}
 	mysqli_close($link);
?>