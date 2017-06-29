<?php

include("config/conexao.php");

$query = "SELECT evnome FROM evento WHERE evento_id = '".$_GET['id']."';";
$dados = mysql_query($query);
$rows = mysql_fetch_assoc($dados);


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	    <meta name="description" content="" />
	    <meta name="viewport" content="width=device-width, initial-scale=1" />

	    <title>Memorial Eventos</title>
	    <link rel="stylesheet" href="css/bootstrap.css" />
	    <link rel="stylesheet" href="css/bootstrap-responsive.css" />
	    <link rel="stylesheet" href="css/style.css" />
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- Script para mostrar o campo siape apenas se for servidor -->
		<script type="text/javascript">
			function mostraDivSiape(valor)
			{
				if ((valor == "nenhum") || (valor == "bolsista") || (valor == "outro"))
				{
					document.getElementById("siape-form").style.display = "none";
				}
				
				else if(valor == "servidor")
				{
					document.getElementById("siape-form").style.display = "block";
				}
			}
		</script>


		<!-- Script para mostrar o campo carro apenas se precisar de estacionamento -->
		<script type="text/javascript">
			function mostraDivCarro(valor)
			{
				if (valor == "nao")
				{
					document.getElementById("carro-form").style.display = "none";
				}
				
				else if(valor == "sim")
				{
					document.getElementById("carro-form").style.display = "block";
				}
			}
		</script>
		
		<style type="text/css">
			#siape-form, #carro-form
			{
				display:none;
			}
		</style>



	</head>

	<body>
		<div class="container-fluid fullscreen">
			
			<!-- Linha Geral-->
        	<div class="row">

				<!-- Barra Superior -->
				<header>

					<div class="jumbotron jumboPersonalizado">
					  <h1>Eventos Memorial da UFC</h1>
					  <p>Preencha o formulario com seus dados.</p>
			
				<div class="container zeroPad">
					<div class="col-md-6">
					  <h4 align="left">
					  	<a  class="btn btn-primary btn-lg" href="eventos.php" role="button"><span class="glyphicon glyphicon-menu-left"></span><span class="glyphicon glyphicon-menu-left"></span> Voltar para menu eventos</a>
					  </h4>
					</div>

					<div class="col-md-6">					  
					  <h4 align="right">
					  	<a  class="btn btn-primary btn-lg" href="index.php" role="button">Ir para o site do memorial <span class="glyphicon glyphicon-menu-right"></span><span class="glyphicon glyphicon-menu-right"></span></a>
					  </h4>
					</div>
				</div>
					<p> </p>

					</div>

				</header>


				<!-- Corpo do site -->
				<div class="col-md-10 col-md-offset-1 noboxstyle"><br />

					<form action="evento-cadastro.php?id=<?php echo $_GET['id']; ?>" name="form1" id="form1" method="POST" enctype="multipart/form-data">
						<fieldset><br />
							<?php
                                    // Exibe erros e mensagens na tela
                                    if (isset($eventoCadastro)) {
                                        if ($eventoCadastro->erros) {
                                            foreach ($eventoCadastro->erros as $erro) {
                                                echo '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'. $erro .'</div>';
                                            }
                                        }

                                        if ($eventoCadastro->mensagens) {
                                            foreach ($eventoCadastro->mensagens as $mensagem) {
                                                echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'. $mensagem .'</div>';
                                            }
                                        }
                                    }
                                ?>
							<legend><center>Cadastro para evento</center></legend>

							<div class="form-group">
								<label for="evento">Evento:</label><br/>
								<input class="form-control" type="text" id="evento" name="evento" value="<?php echo $rows['evnome']; ?>" disabled /><br/>
							</div>

							<div class="form-group">
								<label for="nome">Nome Completo:</label><br/>
								<input class="form-control" type="text" id="nome" name="nome" pattern="[a-zA-Z0-9\s]{2,64}" required/><br/>
							</div>

							<div class="form-group">
								<label for="nasc">Data de Nascimento:</label><br />
								<input class="form-control" type="date" id="nasc" name="nasc" required/><br/>
							</div>

							<div class="form-group">
								<label for="cpf">CPF: (apenas números)</label><br />
								<input class="form-control" type="text" id="cpf" name="cpf" pattern="[0-9]{11,11}" required/><br/>
							</div>

							<div class="form-group">
								<label for="email">Email:</label><br />
								<input class="form-control" type="text" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/><br/>
							</div>

							<div class="form-group">
								<label for="vinculo">Vinculo:</label><br />
								<select class="form-control" id="vinculo" name="vinculo" onchange="mostraDivSiape(this.value)">
									<option value="nenhum">Nenhum</option>
									<option value="bolsista">Bolsista</option>
									<option value="servidor">Servidor</option>
									<option value="outro">Outro</option>
								</select><br />
							</div>

							<div class="form-group" id="siape-form">
								<label for="siape">SIAPE: (apenas números)</label><br />
								<input class="form-control" type="text" id="siape" name="siape" pattern="[0-9]{2,20}" /><br/>
							</div>

							<div class="form-group">
								<label for="telefone">Telefone:</label><br />
								<input class="form-control" type="text" id="telefone" name="telefone" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" placeholder="(XX) 9XXXX-XXXX" required/><br/>
							</div>

							<div class="form-group">
								<label for="estacionamento">Precisa de permissão para usar o estacionamento?</label><br />
								<select class="form-control" id="estacionamento" name="estacionamento" onchange="mostraDivCarro(this.value)">
									<option value="nao">Não</option>
									<option value="sim">Sim</option>
								</select><br />
							</div>

							<div class="form-group" id="carro-form">
								<label for="carro">Informações sobre o carro: (placa, modelo, cor)</label><br />
								<input class="form-control" type="text" id="carro" name="carro" pattern="[a-zA-Z0-9.-]{7,8}, [a-zA-Z0-9.-\s]{2,15}, [a-zA-Z]{2,10}$" placeholder="ABC1234, Modelo, Cor"/><br/>
							</div>

							<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>" />

							<center>
								<input class="btn btn-primary btnSize1" name="salvar" type="submit" value="Cadastrar" /><br /><br />
							</center>
						
						</fieldset>

					</form>


				</div>

        	</div>

		</div>		

	</body>
</html>