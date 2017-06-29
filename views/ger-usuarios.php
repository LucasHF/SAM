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
    <link rel="stylesheet" href="css/table.css" />
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
                                                        <li><center><a href="criar-evento.php"><span class="glyphicon glyphicon-plus-sign" style="font-size:20px"></span>&nbsp;Criar Evento</a></center></li>
                                                    </ul>';
                                            }
                                        ?>
                                </li>


                                <?php
                                    if($_SESSION['user_permission'] == 2)
                                    {
                                        echo '
                                            <li role="presentation" class="active"><a href="ger-usuarios.php">
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
                                <fieldset>
                                    <legend><center><span class="glyphicon glyphicon-user bigicon"></span><br />Gerenciar Usuários</center></legend>
                                    <br />

                                        
                                        <table class="table table-responsive" border="2" width="100%" cellspacing="10" align="center">
                                        <tr><th><center>Nome Completo</center></th><th><center>E-mail</center></th>
                                        <th><center>Permissão</center></th><th><center>Salvar</center></th></tr>
                        
                                        <?php
                                        foreach($gerUsuarios->listaUsuarios as $usuario):
                                        
                                            //Selecionar a permissão do usuário
                                            $nenhuma = "";
                                            $usuarioNorm = "";
                                            $superUsuario = "";

                                            if ($usuario['user_permission'] == 0)
                                            {
                                                $nenhuma = "selected";
                                            }
                                            else if ($usuario['user_permission'] == 1)
                                            {
                                                $usuarioNorm = "selected";
                                            }
                                            else if ($usuario['user_permission'] == 2)
                                            {
                                                $superUsuario = "selected";
                                            }


                                            ?>

                                            <!--Continuando escrevendo a tabela-->
                                            <tr>
                                                <form action="" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?php echo $usuario['user_id']; ?>" />

                                                    <td><center><?php echo $usuario['user_fullname']; ?></center></td>
                                                    <td><center><?php echo $usuario['user_email']; ?></center></td>
                                                    <td><center>
                                                        <select class="form-control" id="permissao" name="permissao">
                                                            <option value="0" <?php echo $nenhuma; ?> >Nenhuma</option>
                                                            <option value="1" <?php echo $usuarioNorm; ?> >Usuário</option>
                                                            <option value="2" <?php echo $superUsuario; ?> >Superusuário</option>                                            
                                                        </select>
                                                    </center></td>
                                                    <td><center>
                                                        <button type="submit" class="btn btn-primary btnSize3" name="salvar" onclick="document.form1.action='ger-usuarios.php'; document.form1.submit();">
                                                            <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Salvar
                                                        </button>
                                                    </center></td>

                                                </form>
                                            </tr>


                                        <?php endforeach; ?>
                            
                                        </table>
                                </fieldset>

                        </div>
                    </div>
                </div>

        </div>

    </div>  

    
    

</body>
</html>