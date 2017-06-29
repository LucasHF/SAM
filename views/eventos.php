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
	</head>

	<body>
		<div class="container-fluid fullscreen">
			
			<!-- Linha Geral-->
        	<div class="row">

				<!-- Barra Superior -->
				<header>

					<div class="jumbotron jumboPersonalizado">
					  <h1>Eventos Memorial da UFC</h1>
					  <p>Selecione um dos eventos disponíveis abaixo.</p>
					  
					  <p align="right">
					  	<a class="btn btn-primary btn-lg" href="index.php" role="button">Ir para o site do memorial <span class="glyphicon glyphicon-menu-right"></span><span class="glyphicon glyphicon-menu-right"></span></a></p>
					  
					</div>

				</header>


				<!-- Corpo do site -->
				<div class="col-md-10 col-md-offset-1 noboxstyle">
					<h3>Eventos Ativos</h3>
					<HR width="100%" align="center" class="line" noshade/>
					<?php
						if ($eventoObj->numEventosAtivos == 0)
						{
							echo '<center><h4>Não há nenhum evento ativo</h4></center>
							<HR width="100%" align="center" class="line" noshade/>';
						}
						else
						{
							//do {
							foreach($eventoObj->listaEventosAtivos as $rowsAtivos):
								$data = date('d/m/Y', strtotime($rowsAtivos['data']));
								$hora = date('H:i', strtotime($rowsAtivos['data']));
								echo '
								<a href="evento-cadastro.php?id='.$rowsAtivos['evento_id'].'"><h4>'.$rowsAtivos['evnome'].'</h4></a>
								<p class="eventoTempo">Data: '.$data.'</p>
								<p class="eventoTempo">Horário de início: '.$hora.'</p>
								<p>'.$rowsAtivos['descricao'].'</p>
								<HR width="100%" align="center" class="line" noshade/>';
							endforeach;
							//} while ($rowsAtivos = mysql_fetch_assoc($dadosAtivos));
						}
					?>

					<br /><br />
					<h3>Eventos Inativos</h3>
					<HR width="100%" align="center" class="line" noshade/>
					<?php
						if ($eventoObj->numEventosInativos == 0)
						{
							echo '<center><h4>Não há nenhum evento inativo</h4></center>
							<HR width="100%" align="center" class="line" noshade/>';
						}
						else
						{
							//do {
							foreach($eventoObj->listaEventosInativos as $rowsInativos):
								$data = date('d/m/Y', strtotime($rowsInativos['data']));
								$hora = date('H:i', strtotime($rowsInativos['data']));
								echo '
								<h4 style="color: #B22222;">'.$rowsInativos['evnome'].'</h4>
								<p class="eventoTempo">Data: '.$data.'</p>
								<p class="eventoTempo">Horário de início: '.$hora.'</p>
								<p>'.$rowsInativos['descricao'].'</p>
								<HR width="100%" align="center" class="line" noshade/>';
							endforeach;
							//} while ($rowsInativos = mysql_fetch_assoc($dadosInativos));
						}
					?>

				</div>

        	</div>

		</div>		

	</body>
</html>