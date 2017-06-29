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

                        <div class="col-md-6 col-md-offset-3 noboxstyle" id="printable"><br />
                            <span class="fonteRelatorio2">
                                <h1><center>Relatório do Acervo Documental</center></h1><br />
                                <p><?php echo $acervoObj->pesquisa; ?></p><br />
                                <p><?php echo 'Data e Hora: '. date('H:i:s d-m-Y');; ?></p>
                            </span>
                        

                            
                                <?php
                                                
                                    if($acervoObj->numAcervos > 0) 
                                    {
                                        //class="table table-responsive" border="2"
                                        echo '<table  width="100%" cellspacing="10" align="center">
                                            <HR width="100%" align="center" class="line" noshade/>
                                        ';

                                        //do {
                                        foreach($acervoObj->listaAcervos as $rows):

                                            //Resgatar o nome correspondente ao numero de acervo, tipo e suporte
                                            include("config/conexao.php");

                                            $query2 = "SELECT nome FROM acervo_op WHERE id = '".$rows['acervo_id']."' ;";
                                            $dados2 = mysql_query($query2);
                                            $acervo = mysql_fetch_assoc($dados2);

                                            $query2 = "SELECT nome FROM tipo_op WHERE id = '".$rows['tipo_id']."' ;";
                                            $dados2 = mysql_query($query2);
                                            $tipo = mysql_fetch_assoc($dados2);

                                            $query2 = "SELECT nome FROM suporte_op WHERE id = '".$rows['suporte_id']."' ;";
                                            $dados2 = mysql_query($query2);
                                            $suporte = mysql_fetch_assoc($dados2);


                                            echo '
                                                <span class="fonteRelatorio">
                                                <div style="width: 100%;">
                                                    <div style="width: 33%; display: inline-block;"><b>Índice: </b>'.$rows['indice'].'</div>
                                                    <div style="width: 33%; display: inline-block;">Acervo: '.$acervo['nome'].'</div>
                                                    <div style="width: 30%; display: inline-block;">Tipo: '.$tipo['nome'].'</div>
                                                </div>
                                                <div style="width: 100%;">
                                                    <div style="width: 100%;">Assunto: '.$rows['assunto'].'</div>
                                                </div>
                                                <div style="width: 100%;">
                                                    <div style="width: 100%;">Observação: '.$rows['observacao'].'</div>
                                                </div>
                                                <div style="width: 100%;">
                                                    <div style="width: 49%; display: inline-block;">Ano: '.$rows['ano'].'</div>   
                                                    <div style="width: 49%; display: inline-block">Indexador: '.$rows['indexador'].'</div>
                                                </div>
                                                <div style="width: 100%;">
                                                    <div style="width: 33%; display: inline-block;">Prateleira: '.$rows['prateleira'].'</div>
                                                    <div style="width: 33%; display: inline-block;">Estante: '.$rows['estante'].'</div>
                                                    <div style="width: 30%; display: inline-block;">Pasta: '.$rows['pasta'].'</div>   
                                                </div>
                                                </span>

                                                <HR width="100%" align="center" class="line" noshade/>
                                            ';

                                        //}while($rows = mysql_fetch_assoc($dados));
                                        endforeach;

                                        echo '</table>';
                                        
                                    } 
                                    else if ($acervoObj->numAcervos == -1) {
                                        echo '
                                            <p>Nenhum filtro de busca foi selecionado.</p>';
                                    } else {
                                        echo "Nenhum resultado encontrado.";
                                    }

                                    
                                ?>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>  

    
    

</body>
</html>