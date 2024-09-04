<?php
	
	session_start();

	if(!isset($_POST) OR empty($_POST['endereco_email']) OR empty($_POST['senha']))  {
	
		header("location: sair.php");			
	}
	else {		
		
		include('config.php');
		
		$dados = [
			'email'	=> $_POST['endereco_email'],
			'senha'		=> sha1($_POST['senha'])		
		];
		
		
		$sql = "SELECT *
					FROM pessoas
					WHERE endereco_email = :email
					and senha = :senha";
	
	
		try {
			
			$pdo->beginTransaction();
				
				$consulta = $pdo->prepare($sql);
				$consulta->execute($dados);
				
				$count = $consulta->rowCount();
				
				if($count != 0) {
					
					$linha = $consulta->fetch(PDO::FETCH_OBJ);
					
					$_SESSION['logado'] 			= true;
					$_SESSION['nomeUsuario'] 	   = $linha->nome_pessoa;
					$_SESSION['emailUsuario'] 	   = $linha->endereco_email;
					$_SESSION['permissaoUsuario']  = $linha->fk_id_permissao;
					
					if($_SESSION['permissaoUsuario'] == 3 || $_SESSION['permissaoUsuario'] == 2) {
						header('location: ../pages/home-funci.php');
					} elseif ($_SESSION['permissaoUsuario'] == 1) {
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