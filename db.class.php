﻿<?php

class db {

	//host
	private $host = 'mysql.hostinger.com.br';

	//usuario
	private $usuario = 'u840845752_root';

	//senha
	private $senha = 'fbd3f721';

	//banco de dados
	private $database = 'u840845752_test';

	public function conecta_mysql(){

		//criar a conexao
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

		//ajustar o charset de comunicação entre a aplicação e o banco de dados
		mysqli_set_charset($con, 'utf8');

		//verficar se houve erro de conexão
		if(mysqli_connect_errno()){
			echo 'Erro ao tentar se conectar com o Banco de Dados MySQL: '.mysqli_connect_error();	
		}

		return $con;
	}

}

?>
