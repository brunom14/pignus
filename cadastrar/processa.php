
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php

		include '../db/conecta.php';
		require '../db/bdajax.php';

			if(isset($_POST['usuario'])){
				$usuario = $_POST['usuario'];

				if(isset($_POST['senha']) && $_POST['csenha']==$_POST['csenha']){
					$senha = $_POST['senha'];
					
					if(isset($_POST['email'])){
						$email = $_POST['email'];

						if(isset($_POST['nome'])){
							$nome = $_POST['nome'];


							//$usuario = DBEscape($usuario);
							
							$query = mysqli_query($link, "SELECT * FROM tbusers WHERE usuario = '$usuario'");
							$rows = mysqli_num_rows($query);
							$cod;
							if($rows == 1){
								
								//já tem alguém com esse user
								echo"
									<script type='text/javascript'>
										alert('Esse nome de usuário já foi utilizado, escolha outro');
										window.location.href='cadastro.html';
									</script>
								";
								//header('location: cadastro.html');
						 				
						 	}else{
						 		
						 		//encripta a senha
								$hash = password_hash($senha, PASSWORD_DEFAULT);

								$query = "INSERT INTO tbusers (usuario, senha, email, nome) VALUES ('$usuario','$hash','$email','$nome')";
								$insert = mysqli_query($link, $query);

								echo"
									<script type='text/javascript'>
										alert('CADASTRO REALIZADO!');
										window.location.href='../index.html';
									</script>
								";

						 	}


						}else{
							echo"
								<script type='text/javascript'>
									alert('email em branco');
								</script>
							";	
						}
					}else{
						echo"
							<script type='text/javascript'>
								alert('email em branco');
							</script>
						";
					}		
				}else{
					echo"
						<script type='text/javascript'>
							alert('senha errados');
						</script>
					";	
				}
			}else{
				echo"
					<script type='text/javascript'>
						alert('usuario em branco');
					</script>
				";
			}
			mysqli_close($link);

			/*
			$usuario = $_POST['usuario'];
			$senha = $_POST['senha'];
			$email = $_POST['email'];
			$nome = $_POST['nome'];
			
			$query = "INSERT INTO tbusers (usuario, senha, email, nome) VALUES ('$usuario','$senha','$email','$nome')";
			$insert = mysqli_query($link, $query);

			*/
		
	?>

	
</body>
</html>