<?php
session_start();
//session_destroy();
if (isset($_SESSION['cod']) && $_SESSION['cod'] != ""){

}else{
	header("Location: ../index.html");
}
$cod = $_SESSION['cod'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de comentários</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/funcao.js"></script>

</head>
<body>
	<div id="geral">
		<?php 
			include "../../db/bdajax.php";
			//pegar dados da postagem por get
			$lat = $_GET['lat'];
			$lng = $_GET['lng'];
			$foto = $_GET['foto'];

			$query = 'WHERE lat = '.$lat.' and lng = '.$lng.'';
			
			$dados = DBRead('markers',$query,'id, name, address, type, creater');
			$id;
			$titulo;
			$conteudo;
			$tipo;
			$criador;
			$autor;
			foreach ($dados as $key => $value) {
				$id= $value['id'];
				$titulo= $value['name'];
				$conteudo= $value['address'];
				$idTipo= $value['type'];
				$idCriador= $value['creater']; 
			}
			
			$dados = DBRead('tbusers',"WHERE COD = '$idCriador'",'nome');
			foreach ($dados as $key => $value) {
				$autor = $value['nome'];
			}
		?>
		<div id="map"></div>
		<div class="postagem">
			<?php 
				if ($foto == "../upload/upload/") {
					
				}else{
					echo " <img src='$foto' width='580' height='300'> ";
				}
			 ?>
			
			<h2><?php echo $titulo; ?></h2>
			<p>Tipo:<?php

			 if($idTipo == "A")
			 	echo "Violência";
			 else
			 	echo "Infraestrutura";

			?></p>
			<p><?php echo $conteudo; ?></p>
			<p>Criador: <?php echo $autor; ?></p>
			
			<span><a href="../index.php">voltar</a></span><br><br>
			<span class="abre_coment">Comentários</span>
			<?php
				if (!empty($_GET['id'])) {
					
					echo "<div id='comentarios' style='display:block' >";
					
				}else{
					echo "<div id='comentarios' >";
				}
			?>
			
				<form action="reg_coment.php" method="post" name="form1" id="form_comentario">
					
					<input type="text" name="comentario" size="50" value="digite o comentario" class="campo">
					<input type="hidden" name="cod_autor" value="<?php echo $cod ?>">
					<input type="hidden" name="id_postagem" value="<?php echo $id ?>">
					<input type="hidden" name="foto" value="<?php echo $foto ?>">
					<input type="hidden" name="lat" value="<?php echo $lat ?>">
					<input type="hidden" name="lng" value="<?php echo $lng ?>">
					<input type="submit" name="botao" style="display: none">

				</form>
				<?php
					$query = 'WHERE marker = '.$id.'';
			
					$dados_comentarios = DBRead('coment',$query);

					foreach ($dados_comentarios as $key => $value) {
					$id_comentario= $value['COD'];
					$idUser= $value['user'];
					$comentario= $value['texto'];
					

					$query = 'WHERE COD = '.$idUser.'';
					$nome;
					$dados_usuario = DBRead('tbusers',$query,'nome');
					foreach ($dados_usuario as $key => $value) {
						$nome = $value['nome'];
					}

				?>
				<div class="comentarios" id="<?php echo $id_comentario ?>"><!--id=" <?php /* echo $id */ ?>" -->
					<?php
						if ($idUser == $cod or $cod == 1) {
							echo "<a href='deletarComent.php?id_comentario=$id_comentario&lat=$lat&lng=$lng&foto=$foto'>deletar</a>";
						}
					?>
					<strong><?php echo $nome ?></strong>
					<p><?php echo $comentario ?></p>
					





				</div><!-- calsse comentarios-->
				<?php 
					}//fecha foreach comentarios
				?>
			</div><!-- comentarios -->
		</div><!-- postagem-->
		<?php
			// include 'reg_coment.php';
			// include 'reg_respostas.php';
		?>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3EbXfPIIAr7rrJwBXWVGkgfG9Ue6gDWM"></script>
	</div>
</body>
</html>