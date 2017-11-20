<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="UTF-8">
	<title>Logar-se</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
</head>
<body>
	
</body>
</html>
<?php
	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$usuario_existe = false;
	$email_existe = false;

	//verificar se o usuário já
	$sql = " select * from usuarios where usuario = '$usuario' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['usuario'])){
			$usuario_existe = true;
		}
	} else {
		echo 'Erro ao tentar localizar o registro de usuário';
	}

	//verificar se o e-mail já
	$sql = " select * from usuarios where email = '$email' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			$email_existe = true;
		} 
	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}


	if($usuario_existe || $email_existe){

		$retorno_get = '';

		if($usuario_existe){
			$retorno_get.= "erro_usuario=1&";
		}

		if($email_existe){
			$retorno_get.= "erro_email=1&";
		}

		header('Location: inscrevase.php?'.$retorno_get);
		die();
	}

	$sql = " insert into usuarios(usuario, email, senha) values ('$usuario', '$email', '$senha') ";

	//executar a query
	if(mysqli_query($link, $sql)){
		echo '<div class="ui container"><div class="ui cards ui grid">
		<div class="card sixteen wide column">
			<div class="content">
				<img class="right floated mini ui image" src="/images/avatar/large/elliot.jpg">
				<div class="header">
					Bem-Vindo
				</div>
				<div class="meta">
					Social Network
				</div>
				<div class="description">
					Se tudo deu certo, logue na página principal... Senão, tente novamente!
				</div>
			</div>
			<div class="extra content">
				<div class="ui two buttons">
					<a href="index.php" class="ui basic green button">Logar-se</a>
					<a href="registrar/inscrevase.php" class="ui basic red button">Tentar novamente</a>
				</div>
			</div>
		</div>
	</div></div>';
	} else {
		echo 'Erro ao registrar o usuário!';
	}
?>