<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="" />
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
                                                echo '<ul style="margin:0 auto;" class="dropdown-menu">
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
                                                        <li class="active"><center><a href="criar-evento.php"><span class="glyphicon glyphicon-plus-sign" style="font-size:20px"></span>&nbsp;Criar Evento</a></center></li>
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
            <div class="row">

                <div class="col-md-10 col-sm-10 col-xs-10 
                        col-md-offset-2 col-sm-offset-2 col-xs-offset-2 contentPart">
                
                    <div class="row">  

                        <div class="col-md-10 col-md-offset-1 noboxstyle">

                            <form action="criar-evento.php" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
                               
                                <fieldset>
                                <?php
                                    // Exibe erros e mensagens na tela
                                    if (isset($criarEvento)) {
                                        if ($criarEvento->erros) {
                                            foreach ($criarEvento->erros as $erro) {
                                                echo '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'. $erro .'</div>';
                                            }
                                        }

                                        if ($criarEvento->mensagens) {
                                            foreach ($criarEvento->mensagens as $mensagem) {
                                                echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'. $mensagem .'</div>';
                                            }
                                        }
                                    }
                                ?>

                                    <legend><center><span class="glyphicon glyphicon-plus-sign bigicon"></span><br /> Criar Evento</center></legend>
                        
                                    <div class="form-group">
                                        <label for="titulo">Titulo:</label><br/>
                                        <input class="form-control" type="text" id="titulo" name="titulo" maxlength="50" size="92" required /><br />    
                                    </div>

                                    <div class="form-group" >
                                        <label for="descricao">Descrição:</label><br/>
                                        <textarea class="form-control" id="descricao" name="descricao" rows="9" cols="80" style="resize: none" required ></textarea><br />
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="data">Data:</label><br/>
                                                <input class="form-control" type="date" id="data" name="data" required /><br />    
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hora">Horario de início:</label><br/>
                                                <input class="form-control" type="time" id="hora" name="hora" required /><br />   
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">

                                        
                                          <center>
                                            <input type="submit" class="btn btn-primary btnSize2" name="salvar" value="Salvar" />
                                          </center><br />
                                        
                                        
                                    </div>

                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>  

    
    

</body>
</html>