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


                                <li role="presentation" class="dropdown active"> 
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
                                
                        <legend><center><span class="glyphicon glyphicon-list-alt bigicon"></span><br />Notícias</center></legend>


                        <?php
                            if ($verNoticia->numNoticias == 0)
                            {
                                echo 'Não foi encontrado nenhuma notícia.';
                            }
                            else 
                            {
                               /* echo '
                                    <table class="table table-responsive"  width="100%" cellspacing="10" align="center">
                                        <tr>
                                            <th class="tableWidth"><center>Título</center></th>
                                            <th class="tableWidth"><center>Submetedor</center></th><t/center></th>
                                            <th class="tableWidth"><center>Data e Hora</center></th>
                                        </tr>';


                                //do {
                                foreach($verNoticia->listaNoticias as $rows):
                                   echo '
                                        <tr>
                                            <td><center>'.$rows['titulo'].'</center></td>
                                            <td><center>'.$rows['autor'].'</center></td>
                                            <td><center>'.$rows['cadastro'].'</center></td>
                                        </tr>';

                                //} while ($rows = mysql_fetch_assoc($dados));
                                endforeach;

                                echo '</table>'; */
                                 
                                
                                echo '<div class="col-md-10 col-md-offset-1 noboxstyle">';

                                if ($verNoticia->numNoticias > 0)
                                {
                                    echo '
                                        <div id="accordion" class="panel-group">';
                                   // $countRow = 1;

                                  //  do {
                                  	foreach($verNoticia->listaNoticias as $rows):
                                        $id = $rows['id'];

                                        //Acordeon
                                        echo '
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <div class="row">
        	                                            <div class="col-md-10">
        		                                            <a id="noticia" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$rows['id'].'">
        		                                            <div class="row">
        			                                            <div class="col-md-10">'.$rows['titulo'].'</div>
        		                                            </div>
        		                                            </a>
        	                                            </div>
                                                	</div>
                                                </h4>
                                            </div>
                                            <div id="collapse'.$rows['id'].'" class="panel-collapse collapse">
                                                <div class="panel-body">';

        			                                //Verifica se a noticia está vazia
        			                                $vazio = true;
        			                                if ($rows['texto'] == NULL)
        			                                {
        			                                    echo '<center><h4>O autor não inseriu o texto da notícia.</h4></center>';
        			                                    
        			                                } else{

        			                                    //texto dentro do acordeon
        			                                    echo '<p class="news">'.nl2br($rows['texto']).'</p>';

                                                        /* Se a notícia tiver imagens, mostra-as depois do texto
                                                            PS: Necessário otimizar;
                                                        */
                                                        $caminho = "img/imgNoticia/".$rows['id'];
                                                        $imagens = glob("$caminho/*.*");
                                                        foreach($imagens as $imagem):
                                                                echo '<br>
                                                                    <img src= '.$imagem.' alt = "imagemNoticia" width="300" height="300" class="img-responsive"/>';
                                                        endforeach;
        			                                }
                                        
                                        echo '
                                                </div>
                                                <div class="panel-footer">
                                                	Notícia cadastrada por '. $rows['autor'].' em '. $rows['cadastro'].'
                                                </div>
                                            </div>
                                        </div>';

        								//$countRow++;
        							endforeach;	
                                   // } while ($countRow < $num_rows);

                                }

                                echo "</div>";  
                               
                            } 

                        ?>




                    </div>
                </div>
            </div>        


        </div>

    </div>  

    
    

</body>
</html>