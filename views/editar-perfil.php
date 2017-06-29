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
                                echo '<ul style="margin:0 auto;" class="dropdown-menu">
                                            <li><center><a href="criar-evento.php"><span class="glyphicon glyphicon-plus-sign" style="font-size:20px"></span>&nbsp;Criar evento</a></center></li>
                                        </ul>';
                            }
                        ?>
                    </li>


                    <?php
                        if($_SESSION['user_permission'] == 2)
                        {
                            echo '<li role="presentation"><a href="ger-usuarios.php">
                                        <span class="glyphicon glyphicon-user" style="font-size:20px"></span> &nbsp; Gerenciar Usuários</a>
                                    </li>';
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

                        <!--Caixa do Formulario-->
                        <div class="col-md-6 col-md-offset-3 boxstyle">
                              
                            <form action="" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
                               
                                <fieldset>
                                    <legend><center><span class="glyphicon glyphicon-cog bigicon"></span><br /> Editar Perfil</center></legend>
                        
                                    <br /><p class="text-info">* Os campos em branco não serão alterados *</p><br />
                                    <?php
                                    // show potential errors / feedback (from registration object)
                                    if (isset($editarPerfil)) {
                                        if ($editarPerfil->erros) {
                                            foreach ($editarPerfil->erros as $error) {
                                                echo '<div class="alert alert-danger" role="alert">'. $error .'</div>';
                                            }
                                        }
                                        if ($editarPerfil->menssagens) {
                                            foreach ($editarPerfil->menssagens as $message) {
                                                echo '<div class="alert alert-warning" role="alert">'. $message .'</div>';
                                            }
                                        }

                                    }
                                    ?>

                                    <div class="form-group">
                                        <label for="imgPerfil">Imagem Perfil:</label><br/>
                                        <input class="form-control" type="file" id="imgPerfil" name="imgPerfil" size="92"/><br />    
                                    </div>

                                    <div class="form-group" >
                                        <label for="cargo">Cargo:</label><br/>
                                        <input type="text" class="form-control" id="cargo" name="cargo" /><br />
                                    </div>
                                    
                                    <div class="form-group" >
                                        <label for="nome">Nome:</label><br/>
                                        <input type="text" class="form-control" id="nome" name="nome" /><br />
                                    </div>

                                    <!--Botões-->
                                    <div class="col-md-12">

                                        <center>
                                            <br />
                                            <div class="col-md-2"></div>

                                            <div class="col-md-4" >
                                                <input type="button" class="btn btn-warning btnSize1" value="Cancelar" onclick="document.form1.action='inicio.php'; document.form1.submit();" />
                                            </div>

                                            <div class="col-md-4" >
                                                <input type="submit" class="btn btn-primary btnSize1" name="editar" id="editar" value="Salvar" onclick="document.form1.action='editar-perfil.php'; document.form1.submit();" />
                                            </div>

                                            <div class="col-md-2"></div>
                                        </center>

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