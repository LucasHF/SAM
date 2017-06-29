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
    <div class="row">

        <!-- Menu Sidebar-->
        <div class="col-lg-2 col-md-2  col-sm-2 col-xs-2 sidebar">
            
            
                            <ul class ="sidebarlist"> 
                                <li class="logoImg"><img src="imgSys/logo_sam.jpg" width="115" height="45" class="adjustLogo img-responsive" /></li>
                                <li role="presentation" class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home" style="font-size:20px"></span> &nbsp; Início</a></li>

                                 <li role="presentation" class="dropdown"><a href="acervo.php" data-toggle="dropdown" class="dropdown-toggle disabled">
                                    <span class="glyphicon glyphicon-book" style="font-size:20px"></span> &nbsp; Acervo </a>
                                     
                                        <!-- Teste de permissao para habilitar ediçao de acervo -->
                                     <ul style="margin:0 auto;" class="dropdown-menu">
                                                        <li><center><a href="gerenciar-acervo.php"><span class="glyphicon glyphicon-wrench" style="font-size:20px"></span>&nbsp;Gerenciar Acervo</a></center></li>
                                    </ul>

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
                                        
                                                    <ul style="margin:0 auto;" class="dropdown-menu">
                                                        <li><center><a href="criar-evento.php"><span class="glyphicon glyphicon-plus-sign" style="font-size:20px"></span>&nbsp;Criar evento</a></center></li>
                                                    </ul>
                                        
                                </li>


                                
                                            <li role="presentation"><a href="ger-usuarios.php">
                                                <span class="glyphicon glyphicon-user" style="font-size:20px"></span> &nbsp; Gerenciar Usuários
                                                </a></li>
                                
                                

                                <li role="presentation"><a href="index.php?logout" class="logout"><span class="glyphicon glyphicon glyphicon-log-out" style="font-size:20px"></span> &nbsp; Logout</a></li>

                            </ul>     
            
            
        </div> <!--Fim da Sidebar-->

        <!-- Linha Geral-->
        <div class="col-lg-10 col-lg-offset-2
                    col-md-10 col-md-offset-2
                    col-sm-10 col-sm-offset-2
                    col-xs-10 col-xs-offset-2 contentPart">

            <!--Corpo do Site-->

            <div class="row>">

                <center>
                <div class="col-md-2 col-md-offset-5
                            col-sm-2 col-sm-offset-5
                            col-xs-2 col-xs-offset-5 
                            col-lg-2 col-lg-offset-5 boxPerfil ">
                    
                     
                            <center><img src="imgUsers/0.jpg" class="imgPerfil img-responsive" /></center>
                        

                    


                    <!--<center><h4><u>Informações</u></h4></center>-->
                    
                     
                    <strong><h4>Teste</h4></strong>
                    Cargo: Testador

                    <br /><br />
                    <a href="editar-perfil.php" ><center><span class="glyphicon glyphicon-cog" style="font-size:25px"></span></center></a>



                </div>
                </center>
            </div>

        </div> <!--Fim da Linha geral-->
        
    </div>
    </div>  

    
    

</body>
</html>