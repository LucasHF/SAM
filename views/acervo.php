<?php
	
//session_start();

if (!isset($_SESSION['user_login_status']) OR $_SESSION['user_login_status'] != 1) 
{
   	echo "É preciso estar conectado para acessar essa página! Aguarde...";
   	header("refresh: 5; url=../index.php");
   	exit;
}


if (!isset($_GET['limpar']))
{
    $_GET['limpar'] = false;
}


?>




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
                    <li role="presentation" class="dropdown active"><a href="acervo.php" data-toggle="dropdown" class="dropdown-toggle disabled">
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

                    <!--Caixa do Formulario-->
        			<div class="col-md-10 col-sm-10 col-xs-10
        						col-md-offset-1 col-sm-offset-1 col-xs-offset-1 noboxstyle"> 
                          
                        <form action="" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
                           
                            <fieldset>
                                <legend><center><span class="glyphicon glyphicon-book bigicon"></span><br> Acervo Documental</center></legend>
                    
                                <!--Campos do lado esquerdo do form-->
                                <div class="col-md-6" >

                                    <div class="form-group">
                                    	<label for="indice">Índice:</label><br/>
            							<input class="form-control" type="text" id="indice" name="indice" value="<?php echo $_POST['indice']; ?>" size="92"/>    
                                    </div>

                                    <div class="form-group">
                                        <label for="fundo">Fundo:</label><br/>
                                        <select class="form-control" name="fundo" id="fundo">
                                            <option>UFC</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="acervo">Acervo:</label><br/>    
                                    
                                        <!--Buscando opções de acervo-->
                                        <?php
                                            include("config/conexao.php");

                                            $query2 = "SELECT nome FROM acervo_op;";
                                            $dados2 = mysql_query($query2);    
                                            $rows2 = mysql_fetch_assoc($dados2);
                                            $num_rows2 = mysql_num_rows($dados2);
                                           
                                        ?>
                                        <select class="form-control" id="acervo" name="acervo">
                                            <?php
                                                //Verificando se o campo está vazio
                                                echo '<option ';
                                                if($_POST['acervo'] == "")
                                                {
                                                    echo 'selected';
                                                    $vazio = true;
                                                }
                                                echo '>';
                                                

                                                if ($num_rows2 > 0)
                                                {
                                                    do
                                                    {
                                                        //Criando as opções e selecionando a anterior.
                                                        echo '
                                                        <option '; 
                                                        if (($vazio != true) and ($rows2['nome'] == $_POST['acervo']))
                                                        {
                                                            echo 'selected';
                                                        }  
                                                        echo '>'.$rows2['nome'];
                                                    }while ($rows2 = mysql_fetch_assoc($dados2));
                                                }
                                                $vazio = false;
                                            ?>
                                        </select>


                                    </div>

                                    <div class="form-group">
                                        <label for="tipo">Tipo:</label><br/>    
                                        
                                        <!--Buscando opções de tipo-->
                                        <?php
                                            include("config/conexao.php");

                                            $query2 = "SELECT nome FROM tipo_op;";
                                            $dados2 = mysql_query($query2);    
                                            $rows2 = mysql_fetch_assoc($dados2);
                                            $num_rows2 = mysql_num_rows($dados2);
                                           
                                        ?>
                                        <select class="form-control" id="tipo" name="tipo">
                                            <?php
                                                //Verificando se o campo está vazio
                                                echo '<option ';
                                                if($_POST['tipo'] == "")
                                                {
                                                    echo 'selected';
                                                    $vazio = true;
                                                }
                                                echo '>';

                                                if ($num_rows2 > 0)
                                                {
                                                    do
                                                    {
                                                        //Criando as opções e selecionando a anterior.
                                                        echo '
                                                        <option '; 
                                                        if (($vazio != true) and ($rows2['nome'] == $_POST['tipo']))
                                                        {
                                                            echo 'selected';
                                                        }  
                                                        echo '>'.$rows2['nome'];
                                                    }while ($rows2 = mysql_fetch_assoc($dados2));
                                                }
                                                $vazio = false;
                                            ?>
                                        </select>

                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="suporte">Suporte:</label><br/>    
                                    
                                        <!--Buscando opções de suportes-->
                                        <?php
                                            include("config/conexao.php");

                                            $query2 = "SELECT nome FROM suporte_op;";
                                            $dados2 = mysql_query($query2);    
                                            $rows2 = mysql_fetch_assoc($dados2);
                                            $num_rows2 = mysql_num_rows($dados2);
                                           
                                        ?>
                                        <select class="form-control" id="suporte" name="suporte">
                                            <?php
                                                //Verificando se o campo está vazio
                                                echo '<option ';
                                                if($_POST['suporte'] == "")
                                                {
                                                    echo 'selected';
                                                    $vazio = true;
                                                }
                                                echo '>';

                                                if ($num_rows2 > 0)
                                                {
                                                    do
                                                    {
                                                        //Criando as opções e selecionando a anterior.
                                                        echo '
                                                        <option '; 
                                                        if (($vazio != true) and ($rows2['nome'] == $_POST['suporte']))
                                                        {
                                                            echo 'selected';
                                                        }  
                                                        echo '>'.$rows2['nome'];
                                                    }while ($rows2 = mysql_fetch_assoc($dados2));
                                                }
                                                $vazio = false;
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="assunto">Assunto:</label><br/>
                                        <input class="form-control" type="text" id="assunto" name="assunto" value="<?php echo $_POST['assunto']; ?>" size="92"/><br />    
                                    </div>
                    

                                </div>


                                <!--Campos do lado direito do form-->
                                <div class="col-md-6" >

                                    <div class="form-group">
                                        <label for="dia">Data:</label><br/>

                                        <div class="row">
                                            <div class="col-md-4 date" >
                                                <input class="form-control" type="text" id="dia" name="dia" pattern="[0-9]+$" required="required" size="25" value="<?php echo $_POST['dia']; ?>" onfocus="this.value='';"/>
                                            </div>

                                            <div class="col-md-4 date" >
                                                <input class="form-control" type="text" id="mes" name="mes" pattern="[0-9]+$" required="required" size="25" value="<?php echo $_POST['mes']; ?>" onfocus="this.value='';"/>
                                            </div>

                                            <div class="col-md-4 date" >
                                                <input class="form-control" type="text" id="ano" name="ano" pattern="[0-9]+$" required="required" size="25" value="<?php echo $_POST['ano']; ?>" onfocus="this.value='';"/>
                                            </div>
                                        </div>    
                                    </div>

                                    <div class="form-group">
                                        <label for="indexador">Indexador:</label><br/>
                                        <input class="form-control" type="text" id="indexador" name="indexador" value="<?php echo $_POST['indexador']; ?>" size="92"/>    
                                    </div>

                                    <div class="form-group">
                                        <label for="estante">Estante:</label><br/>
                                        <input class="form-control" type="text" id="estante" name="estante" value="<?php echo $_POST['estante']; ?>" size="92"/>    
                                    </div>

                                    <div class="form-group">
                                        <label for="prateleira">Prateleira:</label><br/>
                                        <input class="form-control" type="text" id="prateleira" name="prateleira" value="<?php echo $_POST['prateleira']; ?>" size="92"/>    
                                    </div>

                                    <div class="form-group">
                                        <label for="pasta">Pasta/Cx:</label><br/>
                                        <input class="form-control" type="text" id="pasta" name="pasta" value="<?php echo $_POST['pasta']; ?>" size="92"/>    
                                    </div>

                                     <div class="form-group">
                                        <label for="observacao">Observação:</label><br/>
                                        <input class="form-control" type="text" id="observacao" name="observacao" value="<?php echo $_POST['observacao']; ?>" size="92"/><br />    
                                    </div>

                                </div>


                                <!--Campo dos Resultados-->
                                <div class="col-md-12 acervoResult"><br />
                                    <?php
                                        // Exibe erros e mensagens na tela
                                        if (isset($acervoObj)) {
                                            if ($acervoObj->erros) {
                                                foreach ($acervoObj->erros as $erro) {
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'. $erro .'</div>';
                                                }
                                            }

                                            if ($acervoObj->mensagens) {
                                                foreach ($acervoObj->mensagens as $mensagem) {
                                                    echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'. $mensagem .'</div>';
                                                }
                                            }
                                        }
                                    ?>

                                    <?php
                                        
                                        if($acervoObj->numAcervos > 0) 
                                        {
                                            //Cabeçalho da Tabela
                                            echo '<table class="table table-responsive" border="2" width="100%" cellspacing="10" align="center">
                                                  <tr><th><center>Editar</center></th><th><center>Índice</center></th><th><center>Estante</center></th>
                                                  <th><center>Prateleira</center></th><th><center>Pasta/Cx</center></th>
                                                  <th><center>Assunto</center></th><th><center>Observação</center></th><th><center>Fundo</center></th>
                                                  <th><center>Acervo</center></th><th><center>Tipo</center></th><th><center>Ano</center></th>
                                                  <th><center>Indexador</center></th><th><center>Código</center></th><th><center>Suporte</center></th>
                                                  <th><center>Dia</center></th><th><center>Mês</center></th></tr>';
                                            
                                            //Cria uma linha na tabela pra cada valor encontrado
                                            //do {
                                            foreach($acervoObj->listaAcervos as $rows):

                                                //Resgatar o nome correspondente ao numero de acervo, tipo e suporte
                                                include("../config/conexao.php");

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
                                                <tr><td><center><input type="radio" name="editar" value="'.$rows['id'].'" ></center></td>
                                                <td><center>'.$rows['indice'].'</center></td><td><center>'.$rows['estante'].'</center></td>
                                                <td><center>'.$rows['prateleira'].'</center></td><td><center>'.$rows['pasta'].'</center></td>
                                                <td><center>'.$rows['assunto'].'</center></td><td><center>'.$rows['observacao'].'</center></td>
                                                <td><center>'.$rows['fundo'].'</center></td><td><center>'.$acervo['nome'].'</center></td>
                                                <td><center>'.$tipo['nome'].'</center></td><td><center>'.$rows['ano'].'</center></td>
                                                <td><center>'.$rows['indexador'].'</center></td><td><center>'.$rows['codigo'].'</center></td>
                                                <td><center>'.$suporte['nome'].'</center></td><td><center>'.$rows['dia'].'</center></td>
                                                <td><center>'.$rows['mes'].'</center></td></tr>';                                    

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

                                        //echo $query;
                                    ?>
                                </div><br /><br />


                          
                                <!--Botões-->
                                <div class="col-md-12 navbarRodape">

        						    <center>
                                        <br />
                                        <div class="col-md-1" ></div>

                                        <div class="col-md-2" >
                                            <button type="button" class="btn btn-primary btnSize1" onclick="document.form1.action='acervo.php?inserir=true'; document.form1.submit();">
                                              <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Inserir
                                            </button>
                                        </div>

                                        <div class="col-md-2" >
                                            <button type="button" class="btn btn-primary btnSize1" onclick="document.form1.action='acervo.php'; document.form1.submit();">
                                              <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar
                                            </button>
                                        </div>

                                        <div class="col-md-2" >
                                            <button type="button" class="btn btn-primary btnSize1" onclick="document.form1.action='acervo.php?limpar=true'; document.form1.submit();">
                                              <span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Limpar
                                            </button>
                                        </div>

                                        <div class="col-md-2" >
                                            <button type="button" class="btn btn-primary btnSize1" onclick="document.form1.action='acervo.php'; document.form1.submit();">
                                              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
                                            </button>
                                        </div>

                                        <div class="col-md-2" >
                                            <button type="button" class="btn btn-primary btnSize1" onclick="document.form1.action='acervo.php?relatorio=true'; document.form1.submit();">
                                              <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Gerar Relatório
                                            </button>
                                        </div>

                                        <div class="col-md-1"></div>
                                    </center>

                                </div>
                                

                            </fieldset>
                        </form>
        			
                    </div>

                </div>

            </div> <!--contentPart-->

        </div>  

    </div>
<?php

if ($dados)
{
    mysql_free_result($dados);
    $rows = 0;
    $num_rows = 0;
}

?>
    
</body>
</html>
