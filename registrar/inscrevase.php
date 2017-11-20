<?php
	$erro_usuario	= isset($_GET['erro_usuario'])	? $_GET['erro_usuario'] : 0;
	$erro_email		= isset($_GET['erro_email'])	? $_GET['erro_email']	: 0;
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Rede social ~ Inscreva-se</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../semantic/semantic.min.css">
</head>

<body>
	<div class="ui secondary pointing menu">
		<div class="ui container">
			<a class="active item">
				Home
			</a>
			<div class="right menu">
			<a class="ui item" href="../index.php">
					Voltar para principal
				</a>
			</div>
		</div>
	</div>

	<div class="ui container">
		<form class="ui form" method="post" action="../registra_usuario.php">
			<div class="fields">
			<div class="two wide field"></div>
				<div class="six wide field">
					<label>Nome de usuário</label>
					<input type="text" id="usuario" name="usuario" placeholder="First Name">
				</div>
				<div class="six wide field">
					<label>Email</label>
					<input type="email" id="email" name="email" placeholder="Email">
				</div>
			</div>
			
			<div class="fields">
			<div class="two wide field"></div>
				<div class="twelve wide field">
					<label>Senha</label>
					<input type="password" id="senha" name="senha" placeholder="Senha">
					<button class="ui button" type="submit" style="margin: 1em 0;">Cadastrar</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
