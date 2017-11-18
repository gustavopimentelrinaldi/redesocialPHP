<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Projeto ~ Home</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
		
	</head>
<body>

	<div class="ui secondary pointing menu">
		<div class="ui container">
			<a class="active item">
				Home
			</a>
			<div class="right menu">
			<a class="ui item" href="procurar_pessoas.php">
					Procurar amigos
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

		//--quantidade de tweets
		$sql = " SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario ";
		$resultado_id = mysqli_query($link, $sql);
		$qtde_tweets = 0;
		if($resultado_id){
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			$qtde_tweets = $registro['qtde_tweets'];
		} else {
			echo 'Erro ao executar a query!! Consulte o ADM!!!';
		}

		//--quantidade de seguidores
		$sql = " SELECT COUNT(*) AS qtde_seguires FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario";
		$resultado_id = mysqli_query($link, $sql);
		$qtde_seguidores = 0;
		if($resultado_id){
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			$qtde_seguidores = $registro['qtde_seguires'];
		} else {
			echo 'Erro ao executar a query!! Consulte o Administrador!!!';
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
						<form id="form_tweet" class="ui form">
							<div class="ui action input thirteen wide field">
								<input type="text" id="texto_tweet" name="texto_tweet" class="form-control" placeholder="Escreva algo..." maxlength="140" />
								<button class="ui button" id="btn_tweet" type="button">Publicar</button>
							</div>
						</form>
					</div><!-- content -->
				</div><!-- ui card -->

				<div class="ui card" style="width: 100%;">
					<div class="content">
						<div id="tweets">
						</div>
					</div><!-- content -->
				</div><!-- ui card -->
			</div><!-- eight wide column -->
		</div><!-- ui grid -->
	</div><!-- container -->

		<script
			src="https://code.jquery.com/jquery-3.1.1.min.js"
			integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			crossorigin="anonymous"></script>
		<script src="semantic/semantic.min.js"></script>
		<script type="text/javascript">
			$(document).ready( function(){
				//associar o evento de click ao botão
				$('#btn_tweet').click( function(){
					if($('#texto_tweet').val().length > 0){
						$.ajax({
							url: 'inclui_tweet.php',
							method: 'post',
							data: $('#form_tweet').serialize(),
							success: function(data) {
								$('#texto_tweet').val('');
								atualizaTweet();
							}
						});
					}
				});

				function atualizaTweet(){
					//carregar os tweets 
					$.ajax({
						url: 'get_tweet.php',
						success: function(data) {
							$('#tweets').html(data);
						}
					});
				}
				atualizaTweet();
			});
		</script>
	</body>
</html>
