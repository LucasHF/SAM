<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Curso de Front-end com Twitter Bootstrap" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>SAM - Sistema Administrativo do Memorial da UFC</title>
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

		    <!-- Menu Sidebar-->
        <div class="col-md-2  col-sm-2 col-xs-2 sidebar">
            
                            <ul class ="sidebarlist"> <!--class="nav nav-pills nav-stacked"-->
                                <li class="logoImg"><img src="imgSys/logo_sam.jpg" width="115" height="45" class="adjustLogo img-responsive" /></li>
                                <li role="presentation"><a href="inicio.php"><span class="glyphicon glyphicon-home" style="font-size:20px"></span> &nbsp; Início</a></li>

                                <!--Teste-->
                                 <li role="presentation" class="dropdown"><a href="acervo.php" data-toggle="dropdown" class="dropdown-toggle disabled">
                                    <span class="glyphicon glyphicon-book" style="font-size:20px"></span> &nbsp; Acervo </a>
                                     
                                        <!-- Teste de permissao para habilitar ediçao de acervo -->
                                        <?php
                                            if($_SESSION['user_permission'] == 2)
                                            {
                                                echo '<ul style="margin:0 auto;" class="dropdown-menu active">
                                                        <li><center><a href="gerenciar-acervo.php"><span class="glyphicon glyphicon-wrench" style="font-size:20px"></span>&nbsp;Gerenciar Acervo</a></center></li>
                                                    </ul>';
                                            }
                                        ?>
                                 </li>


                                <li role="presentation" class="dropdown"> 
                                    <a href="ver-noticia.php" data-toggle="dropdown" class="dropdown-toggle disabled"><span class="glyphicon glyphicon-list-alt" style="font-size:20px"></span> &nbsp; Notícias</a>
                                        <ul style=" margin:0 auto;" class="dropdown-menu">
                                            <li><center><a href="nova-noticia.php"><span class="glyphicon glyphicon-pencil" style="font-size:20px"></span>&nbsp;Cadastrar Notícia</a></center></li>
                                        </ul>
                                </li>
                                <li role="presentation" class="dropdown">
                                    <a href="evento-interno.php" data-toggle="dropdown" class="dropdown-toggle disabled"><span class="glyphicon glyphicon-calendar" style="font-size:20px"></span> &nbsp; Eventos</a>
                                        
                                        <!-- Teste de permissao para habilitar criação de eventos -->
                                        <?php
                                            if($_SESSION['user_permission'] == 2)
                                            {
                                                echo '
                                                    <ul style="margin:0 auto;" class="dropdown-menu">
                                                        <li><center><a href="criar-evento.php"><span class="glyphicon glyphicon-plus-sign" style="font-size:20px"></span>&nbsp;Criar evento</a></center></li>
                                                    </ul>';
                                            }
                                        ?>
                                </li>


                                <?php
                                    if($_SESSION['user_permission'] == 2)
                                    {
                                        echo '
                                            <li role="presentation"><a href="ger-usuarios.php">
                                                <span class="glyphicon glyphicon-user" style="font-size:20px"></span> &nbsp; Gerenciar Usuários
                                                </a></li>';
                                    }
                                ?>

                                <li role="presentation"><a href="index.php?logout" class="logout"><span class="glyphicon glyphicon glyphicon-log-out" style="font-size:20px"></span> &nbsp; Logout</a></li>

                            </ul>     
                       
        </div> <!--Fim da Sidebar-->



			<!--Corpo do Site-->
			<div class="col-md-10 col-sm-10 col-xs-10 
						col-md-offset-2 col-sm-offset-2 col-xs-offset-2 contentPart">
				
				<div class="row">

					<div class="col-md-10 col-sm-10 col-xs-10
								col-md-offset-1 col-sm-offset-1 col-xs-offset-1 noboxstyle">

						<legend><center><span class="glyphicon glyphicon-wrench bigicon"></span><br> Gerenciar Acervo</center></legend>

						<div id="accordion" class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Acervo</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in">
									<div class="panel-body">
									   
										<!-- Valores contidos nas tabelas -->
										<div class="col-md-6">
											<?php
												echo'<table class="table table-hover table-striped table-responsive" border="2" width="100%" cellspacing="10" align="center"> <tr><th><center>Id</center></th><th><center>Nome</center></th></tr>';

												if($gerenciarAcervo->numAcervosOp > 0)
												{
													foreach($gerenciarAcervo->listaAcervosOp as $rows2):
														echo '
														<tr><td><center>'.$rows2['id'].'</center></td>
														<td><center>'.$rows2['nome'].'</center></td></tr>';
													endforeach;

													echo '</table>';
												}

											?>

										</div>

										<!-- Formularios para inserir e editar -->
										<div class="col-md-6">
											<form action="" id="form1" name="form1" method="POST" enctype="multipart/form-data">
												<fieldset>
													<legend><center>Inserir Novo acervo</center></legend>          
												
													<div class="form-group">
														<label for="acervo">Nome do Acervo:</label><br/>
														<input class="form-control" type="text" id="acervo" name="acervo" size="92"/><br />    
													</div>
										
													<center>
														<input type="button" class="btn btn-primary btnSize1" value="Inserir" onclick="document.form1.action='gerenciar-acervo.php?op=1'; document.form1.submit();" />
													</center>

												</fieldset>

												<br /><br /><br />

												<fieldset>
													<legend><center>Editar Acervo</center></legend>          
												
													<div class="col-md-3">
														<div class="form-group">
															<label for="acervoid">Id do Acervo:</label><br/>
															<input class="form-control" type="text" id="acervoid" name="acervoid" size="92"/><br />
														</div>
													</div>

													<div class="col-md-9">
														<div class="form-group">
															<label for="acervoedit">Novo Nome do Acervo:</label><br/>
															<input class="form-control" type="text" id="acervoedit" name="acervoedit" size="92"/><br />
														</div>
													</div>
										
													<center>
														<input type="button" class="btn btn-primary btnSize1" value="Editar" onclick="document.form1.action='gerenciar-acervo.php?op=1'; document.form1.submit();" />
													</center>

												</fieldset>
											
											</form>
										</div>

		  
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Tipo</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse">
									<div class="panel-body">
										
										   
										<!-- Valores contidos nas tabelas -->
										<div class="col-md-6">
											<?php
												echo'<table class="table table-hover table-striped table-responsive" border="2" width="100%" cellspacing="10" align="center"> <tr><th><center>Id</center></th><th><center>Nome</center></th></tr>';

												if($gerenciarAcervo->numTiposOp > 0)
												{
													foreach($gerenciarAcervo->listaTiposOp as $rows2):
														echo '
														<tr><td><center>'.$rows2['id'].'</center></td>
														<td><center>'.$rows2['nome'].'</center></td></tr>';
													endforeach;

													echo '</table>';
												}

											?>

										</div>

										<!-- Formularios para inserir e editar -->
										<div class="col-md-6">
											<form action="" id="form2" name="form2" method="POST" enctype="multipart/form-data">
												<fieldset>
													<legend><center>Inserir Novo Tipo</center></legend>          
												
													<div class="form-group">
														<label for="tipo">Nome do Tipo:</label><br/>
														<input class="form-control" type="text" id="tipo" name="tipo" size="92"/><br />    
													</div>
										
													<center>
														<input type="button" class="btn btn-primary btnSize1" value="Inserir" onclick="document.form2.action='gerenciar-acervo.php?op=2'; document.form2.submit();" />
													</center>

												</fieldset>

												<br /><br /><br />

												<fieldset>
													<legend><center>Editar Tipo</center></legend>          
												
													<div class="col-md-3">
														<div class="form-group">
															<label for="tipoid">Id do Tipo:</label><br/>
															<input class="form-control" type="text" id="tipoid" name="tipoid" size="92"/><br />    
														</div>
													</div>

													<div class="col-md-9">
														<div class="form-group">
															<label for="tipoedit">Novo Nome do Tipo:</label><br/>
															<input class="form-control" type="text" id="tipoedit" name="tipoedit" size="92"/><br />
														</div>
													</div>
										
													<center>
														<input type="button" class="btn btn-primary btnSize1" value="Editar" onclick="document.form2.action='gerenciar-acervo.php?op=2'; document.form2.submit();" />
													</center>

												</fieldset>
											
											</form>
										</div>


									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Suporte</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse">
									<div class="panel-body">
										
										   
										<!-- Valores contidos nas tabelas -->
										<div class="col-md-6">
											<?php
												echo'<table class="table table-hover table-striped table-responsive" border="2" width="100%" cellspacing="10" align="center"> <tr><th><center>Id</center></th><th><center>Nome</center></th></tr>';


												if($gerenciarAcervo->numSuportesOp > 0)
												{
													foreach($gerenciarAcervo->listaSuportesOp as $rows2):
														echo '
														<tr><td><center>'.$rows2['id'].'</center></td>
														<td><center>'.$rows2['nome'].'</center></td></tr>';
													endforeach;

													echo '</table>';
												}

											?>

										</div>

										<!-- Formularios para inserir e editar -->
										<div class="col-md-6">
											<form action="" id="form3" name="form3" method="POST" enctype="multipart/form-data">
												<fieldset>
													<legend><center>Inserir novo Suporte</center></legend>          
												
													<div class="form-group">
														<label for="suporte">Nome do Suporte:</label><br/>
														<input class="form-control" type="text" id="suporte" name="suporte" size="92"/><br />    
													</div>
										
													<center>
														<input type="button" class="btn btn-primary btnSize1" value="Inserir" onclick="document.form3.action='gerenciar-acervo.php?op=3'; document.form3.submit();" />
													</center>

												</fieldset>

												<br /><br /><br />

												<fieldset>
													<legend><center>Editar Suporte</center></legend>          
												
													<div class="col-md-3">
														<div class="form-group">
															<label for="suporteid">Id Suporte:</label><br/>
															<input class="form-control" type="text" id="suporteid" name="suporteid" size="92"/><br />
														</div>
													</div>

													<div class="col-md-9">
														<div class="form-group">
															<label for="suporteedit">Novo Nome do Suporte:</label><br/>
															<input class="form-control" type="text" id="suporteedit" name="suporteedit" size="92"/><br />
														</div>
													</div>
										
													<center>
														<input type="button" class="btn btn-primary btnSize1" value="Editar" onclick="document.form3.action='gerenciar-acervo.php?op=3'; document.form3.submit();" />
													</center>

												</fieldset>
											
											</form>
										</div>

									</div>
								</div>
							</div>
						</div>
						   

					</div>
				</div>
			</div>        

		</div>

	</div>  

	
	

</body>
</html>