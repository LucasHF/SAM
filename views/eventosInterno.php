<?php

//error_reporting(0);
//session_start();

include("config/conexao.php");

$query = "SELECT evento.evento_id, evento.evnome, evento.descricao, evento.data, evento.autor, 
            eventos_cad.cad_id , eventos_cad.cadnome , eventos_cad.nasc , eventos_cad.cpf , eventos_cad.email , eventos_cad.vinculo ,
            eventos_cad.siape , eventos_cad.telefone , eventos_cad.estacionamento , eventos_cad.carro , eventos_cad.permissao
            FROM evento LEFT JOIN eventos_cad ON eventos_cad.evento_id = evento.evento_id ORDER BY evento.data DESC;";
$dados = mysql_query($query);
$rows = mysql_fetch_assoc($dados);
$num_rows = mysql_num_rows($dados);



//links da aba estao incompletos

?>



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
                                <li role="presentation" class="dropdown active">
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
            <div class="row">
                
                <div class="col-md-10 col-sm-10 col-xs-10 
                        col-md-offset-2 col-sm-offset-2 col-xs-offset-2 contentPart">
                
                    <div class="row">        
                    
                        <div class="col-md-10 col-md-offset-1 noboxstyle">
                            

                                <?php
                                    if ($num_rows > 0)
                                    {
                                        echo '
                                            <div id="accordion eventList" class="panel-group">
                                                <legend><center><span class="glyphicon glyphicon-calendar bigicon"></span><br> Eventos</center></legend>';
                                        $countRow = 1;

                                        do {
                                            $evento_id = $rows['evento_id'];

                                            //Acordeon
                                            echo '
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <div class="row">
                                                        <div class="col-md-10">
                                                        <a id="';
                                                            //setar o hover azul ou vermelho para evento ativo e inativo 
                                                            if (date('Y-m-d H:i:s') > $rows['data']){ echo 'eventoInativo';} 
                                                            else { echo 'eventoAtivo'; }

                                                            $data = date('d/m/Y', strtotime($rows['data']));
                                                            $hora = date('H:i', strtotime($rows['data']));
                                                            echo '" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$rows['evento_id'].'"><div class="row"><div class="col-md-7">'.$rows['evnome'].'</div><div class="col-md-2">'.$data.'</div><div class="col-md-2">'.$hora.' h</div></div></a></div>';
                                                            if($_SESSION['user_permission'] == 2)
                                                            {
                                                                echo '
                                                                <div class="col-md-2"><a class="btn-link editarEvento" href="evento-interno.php?id='.$rows['evento_id'].'"><span class="glyphicon glyphicon-edit"></span> Editar</a></div>';
                                                            }
                                                echo '
                                                    </div>
                                                    </h4>
                                                </div>
                                                <div id="collapse'.$rows['evento_id'].'" class="panel-collapse collapse">
                                                    <div class="panel-body">';

                                            //Verifica se o evento está vazio
                                            $vazio = true;
                                            if ($rows['cadnome'] != NULL)
                                            {
                                                $vazio = false;
                                                        echo '
                                                        <form action="evento-interno.php" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
                                            
                                                        <input type="hidden" id="eventoid" name="eventoid" value="'.$evento_id.'" >';

                                            //table
                                            echo '
                                                <table class="table table-responsive" border="2" width="100%" cellspacing="10" align="center">
                                                <tr>
                                                    <th><center>Nome Completo</center></th>
                                                    <th><center>Data de Nascimento</center></th>
                                                    <th><center>CPF</center></th>
                                                    <th><center>E-mail</center></th>
                                                    <th><center>Vinculo</center></th>
                                                    <th><center>Siape</center></th>
                                                    <th><center>Telefone</center></th>
                                                    <th><center>Estacionamento</center></th>
                                                    <th><center>Carro</center></th>
                                                    <th><center>Permissão</center></th>
                                                </tr>';
                                            } 
                                            else 
                                            {
                                                echo '<center><h4>Não há nenhum cadastro neste evento.</h4></center>';
                                            }


                                            while (($countRow <= $num_rows) && ($evento_id == $rows['evento_id']))
                                            {
                                                //Verifica se o evento está vazio
                                                if ($vazio == false)
                                                {

                                                    //Selecionar a permissão do usuário
                                                    $selec = '<option';

                                                    if ($rows['permissao'] == "pendente")
                                                    {
                                                        $selec = $selec.' selected ';
                                                    }

                                                    $selec = $selec.'> pendente <option';

                                                    if ($rows['permissao'] == "negada")
                                                    {
                                                        $selec = $selec.' selected ';
                                                    }

                                                    $selec = $selec.'> negada <option';

                                                    if ($rows['permissao'] == "aceita")
                                                    {
                                                        $selec = $selec.' selected ';
                                                    }

                                                    $selec = $selec.'> aceita <option';

                                                    if ($rows['permissao'] == "concluido")
                                                    {
                                                        $selec = $selec.' selected ';
                                                    }

                                                    $selec = $selec.'> concluido';

                                                    $nasc = date('d/m/Y', strtotime($rows['nasc']));


                                                    //linha da tabela dentro do acordeon
                                                    echo '
                                                    <tr>
                                                        <td><center>'.$rows['cadnome'].'</center></td>
                                                        <td><center>'.$nasc.'</center></td>
                                                        <td><center>'.$rows['cpf'].'</center></td>
                                                        <td><center>'.$rows['email'].'</center></td>
                                                        <td><center>'.$rows['vinculo'].'</center></td>
                                                        <td><center>'.$rows['siape'].'</center></td>
                                                        <td><center>'.$rows['telefone'].'</center></td>
                                                        <td><center>'.$rows['estacionamento'].'</center></td>
                                                        <td><center>'.$rows['carro'].'</center></td>
                                                        <td>
                                                            <center>
                                                                <select class="form-control" id="permissao'.$rows['cad_id'].'" name="permissao'.$rows['cad_id'].'">
                                                                '.$selec.'
                                                                </select>
                                                            </center>
                                                        </td>
                                                    </tr>';
                                                }


                                                $rows = mysql_fetch_assoc($dados);
                                                $countRow++;
                                            }

                                            //Verifica se o evento está vazio
                                           if ($vazio == false)
                                            {
                                                // /table
                                                echo '</table>
                                           
                                                    <center>
                                                        <input type="submit" class="btn btn-primary btnSize1" value="Salvar" />
                                                    </center>
                                            
                                                        </form>';
                                            } 
                                            

                                            echo '
                                                    </div>
                                                </div>
                                            </div>';


                                        } while ($countRow <= $num_rows);


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


<!-- Problema quando aparecem 2 eventos vazios seguidos-->