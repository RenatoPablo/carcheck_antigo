<?php
	
	session_start();

	if(!isset($_POST) OR empty($_POST['nome']) OR empty($_POST['senha']))  {
	
		header("location: sair.php");			
	}
	else {		
		
		include('config.php');
		
		$dados = [
			'nome'	=> $_POST['nome'],
			'senha'		=> sha1($_POST['senha'])		
		];
		
		
		$sql = "SELECT *
					FROM usuarios
					WHERE nome = :nome
					and senha = :senha";
	
	
		try {
			
			$pdo->beginTransaction();
				
				$consulta = $pdo->prepare($sql);
				$consulta->execute($dados);
				
				$count = $consulta->rowCount();
				
				if($count != 0) {
					
					$linha = $consulta->fetch(PDO::FETCH_OBJ);
					
					$_SESSION['logado'] 			= true;
					$_SESSION['nomeUsuario'] 	   = $linha->nome;
					$_SESSION['emailUsuario'] 	   = $linha->email;
					$_SESSION['permissaoUsuario']  = $linha->permissao;
					
					if($_SESSION['permissaoUsuario'] == true) {
						header('location: ../pages/home-funci.php');
					} else {
						header('location: ../pages/home-cliente.php');
					}
					
										
					
				}
				else {
					
					echo "Usuário ou senha incorretos!<br>";
					echo "<a href='sair.php'>Voltar</a>";					
					
				}//Fim if($count)
			
			
			$pdo->commit();	
	
		}
		catch(PDOException $e) {
		
			$pdo->rollback();
			$erro = $e->getMessage();
		
			echo "ERRO: {$erro}";	
		}	
	
	}//Fim isset($_POST)