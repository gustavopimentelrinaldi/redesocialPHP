<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.usuario ";
	$sql.= " FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) ";
	$sql.= " WHERE id_usuario = $id_usuario ";
	$sql.= " OR id_usuario IN (select seguindo_id_usuario from usuarios_seguidores where id_usuario = $id_usuario) ";
	$sql.= " ORDER BY data_inclusao DESC ";

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){

		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			echo '<div class="ui feed">';
				echo '<div class="event">';
					echo '<div class="content">';
						echo '<div class="summary">';
							echo '<a style="font-size: 20px;">'.$registro['usuario'].'</a> <small style="font-size: 12px;"> - <span class="date"> '.$registro['data_inclusao_formatada'].'</span></small>';
							echo '<p style="font-weight: normal;">'.$registro['tweet'].'</p>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}

	} else {
		echo 'Erro na consulta de tweets no banco de dados!';
	}

?>