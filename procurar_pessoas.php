<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Rede social ~ Procurar amigos</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		crossorigin="anonymous"></script>
</head>

<body>
	<!-- Static navbar -->
	<div class="ui secondary pointing menu">
		<div class="ui container">
			<a class="active item">
				Projeto Rede Social
			</a>
			<div class="right menu">
			<a class="ui item" href="home.php">
					Home
				</a>
				<a class="ui item" href="sair.php">
					Sair
				</a>
			</div>
		</div>
	</div>

	<?php
		session_start();

		if(!isset($_SESSION['usuario'])){
			header('Location: index.php?erro=1');
		}

		require_once('db.class.php');

		$objDb = new db();
		$link = $objDb->conecta_mysql();

		$id_usuario = $_SESSION['id_usuario'];

		//--qtde de tweets
		$sql = " SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario ";
		$resultado_id = mysqli_query($link, $sql);
		$qtde_tweets = 0;
		if($resultado_id){
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			$qtde_tweets = $registro['qtde_tweets'];
		} else {
			echo 'Erro ao executar a query';
		}

		//--qtde de seguidores
		$sql = " SELECT COUNT(*) AS qtde_seguires FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario ";
		$resultado_id = mysqli_query($link, $sql);
		$qtde_seguidores = 0;
		if($resultado_id){
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			$qtde_seguidores = $registro['qtde_seguires'];
		} else {
			echo 'Erro ao executar a query';
		}
	?>

<div class="ui container">
	<div class="ui grid">
		<div class="four wide column" style="margin: 2em 0;">
			<div class="ui card">
				<div class="content">
					<a class="header"><?= $_SESSION['usuario'] ?></a>
					<div class="meta">
						<span class="date">Joined in 2013</span>
					</div>
					<div class="description">
						<div class="ui mini horizontal statistic">
							<div class="value">
							<?= $qtde_tweets ?>
							</div>
							<div class="label">
								Tweet's
							</div>
						</div><!-- ui mini horizontal statistic -->

						<div class="ui mini horizontal statistic">
							<div class="value">
								<?= $qtde_seguidores ?>
							</div>
							<div class="label">
								Seguidores
							</div>
						</div><!-- ui mini horizontal statistic -->
					</div><!-- description -->
				</div><!-- content -->
			</div><!-- ui card -->
		</div><!-- three wide column -->
			
		<div class="eight wide column">
			<div class="ui card" style="width: 100%;">
				<div class="content">
					<form id="form_procurar_pessoas" class="ui form">
						<div class="ui action input thirteen wide field">
							<input type="text" id="nome_pessoa" name="nome_pessoa" class="form-control" placeholder="Escreva algo..." maxlength="140" />
							<button class="ui button" id="btn_procurar_pessoa" type="button">Procurar</button>
						</div>
					</form>
				</div><!-- content -->
			</div><!-- ui card -->

			<div class="ui card" style="width: 100%;">
				<div class="content">
					<div id="pessoas" class="list-group">
					</div>
				</div><!-- content -->
			</div><!-- ui card -->
		</div><!-- eight wide column -->
	</div><!-- ui grid -->
</div><!-- container -->

<script src="semantic/semantic.min.js"></script>
<script type="text/javascript">
		$(document).ready( function(){
		//associar o evento de click ao botão
		$('#btn_procurar_pessoa').click( function(){
			if($('#nome_pessoa').val().length > 0){
				$.ajax({
					url: 'get_pessoas.php',
					method: 'post',
					data: $('#form_procurar_pessoas').serialize(),
					success: function(data) {
						$('#pessoas').html(data);

						$('.btn_seguir').click( function(){
							var id_usuario = $(this).data('id_usuario');

							$('#btn_seguir_'+id_usuario).hide();
							$('#btn_deixar_seguir_'+id_usuario).show();

							$.ajax({
								url: 'seguir.php',
								method: 'post',
								data: { seguir_id_usuario: id_usuario },
								success: function(data){
									
								}
							});
						});

						$('.btn_deixar_seguir').click( function(){
							var id_usuario = $(this).data('id_usuario');

							$('#btn_seguir_'+id_usuario).show();
							$('#btn_deixar_seguir_'+id_usuario).hide();

							$.ajax({
								url: 'deixar_seguir.php',
								method: 'post',
								data: { deixar_seguir_id_usuario: id_usuario },
								success: function(data){
									
								}
							});
							});
						}
					});
				}
			});
		});
	</script>
</body>
</html>