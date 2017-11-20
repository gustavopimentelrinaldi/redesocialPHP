<?php
	$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Rede social ~ Principal</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
			integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			crossorigin="anonymous"></script>
	<script src="semantic/semantic.min.js"></script>

	<script>
		$(document).ready( function(){
			//verificar se os campos de usuário e senha foram devidamente preenchidos
			$('#btn_login').click(function(){

				var campo_vazio = false;

				if($('#campo_usuario').val() == ''){
					$('#campo_usuario').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_usuario').css({'border-color': '#CCC'});
				}

				if($('#campo_senha').val() == ''){
					$('#campo_senha').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_senha').css({'border-color': '#CCC'});
				}

				if(campo_vazio) return false;
			});
		});					
	</script>
</head>

<body>
	<div class="ui secondary pointing menu">
		<div class="ui container">
			<a class="active item">
				Projeto Rede Social
			</a>
			<div class="right menu">
				<a class="ui item" href="registrar/inscrevase.php">
						Inscrever-se
				</a>
				<div class="ui dropdown">
					<a class="ui item" href="#login">
					Entrar
					</a>
					<div class="menu" style="padding: 2em 1em;">
							<form method="post" action="validar_acesso.php" id="formLogin">
								<div class="ui input" style="margin-bottom: 1em; ">
									<input id="campo_usuario" type="text" name="usuario" placeholder="Login...">
								</div><br>
								<div class="ui input" style="margin-bottom: 1em; ">
									<input id="campo_senha" type="password" name="senha" placeholder="Senha...">
								</div>
								
								<button id="btn_login" class="item">
									Entrar
								</button>
								<?php
									if($erro == 1){
										echo '<font color="#FF0000">Usuário e ou senha inválido(s)</font>';
									}
								?>
							</form>
					</div><!-- menu -->
				</div><!-- ui dropdown -->
			</div><!-- right menu -->
		</div><!-- ui container -->
	</div><!-- menu -->

	<div class="ui container">
		<div class="ui cards ui grid">
			<div class="card sixteen wide column">
					<div class="content">
						<div class="header">Bem vindo, este projeto foi feito com as seguintes tecnologias -> JavaScript(JQuery), Semantic UI, PHP &amp; MySQL...</div>
						<div class="description">
							Se consiste em uma rede social, onde o usuário cria uma conta e interage com outras pessoas... (Seguir, deixar de seguir, fazer postagens etc.)
						</div>
					</div>
					<a href="registrar/inscrevase.php" class="ui bottom attached button">
						<i class="add icon"></i>
						Criar conta
					</a>
				</div>
			</div><!-- card -->
		</div><!-- ui cards -->
	</div><!-- container -->

	<script>
		$('.ui.dropdown')
			.dropdown()
		;	
	</script>		
</body>
</html>
