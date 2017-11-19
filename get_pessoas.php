<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$nome_pessoa = $_POST['nome_pessoa'];
	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = " SELECT u.*, us.* ";
	$sql.= " FROM usuarios AS u ";
	$sql.= " LEFT JOIN usuarios_seguidores AS us ";
	$sql.= " ON (us.id_usuario = $id_usuario AND u.id = us.seguindo_id_usuario) ";
	$sql.= " WHERE u.usuario like '%$nome_pessoa%' AND u.id <> $id_usuario ";

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){

		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			echo '<a class="ui feed" style="margin: 2em;">';
				echo '<div class="content">';
					echo '<div class="summary">';
					echo '<strong style="font-size: 17px;">'.$registro['usuario'].'</strong> <small> - '.$registro['email'].'</small>';
					$esta_seguindo_usuario_sn = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';

					$btn_seguir_display = 'block';
					$btn_deixar_seguir_display = 'block';

					if($esta_seguindo_usuario_sn == 'N'){
						$btn_deixar_seguir_display = 'none';
					} else {
						$btn_seguir_display = 'none';
					}
						echo '<button type="button" id="btn_seguir_'.$registro['id'].'" style="display: '.$btn_seguir_display.'" class="ui teal button small button btn_seguir ui right floated" data-id_usuario="'.$registro['id'].'">Seguir</button>';
						echo '<button type="button" id="btn_deixar_seguir_'.$registro['id'].'" style="display: '.$btn_deixar_seguir_display.'" class="ui primary basic button small button btn_deixar_seguir ui right floated" data-id_usuario="'.$registro['id'].'">Seguindo</button>';
					echo '</div>';
				echo '</div>';
			echo '</a>';
		}

	} else {
		echo 'Erro na consulta de usuários no banco de dados!';
	}
?>