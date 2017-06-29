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
                                        <li class="active"><center><a href="gerenciar-acervo.php"><span class="glyphicon glyphicon-wrench" style="font-size:20px"></span>&nbsp;Gerenciar Acervo</a></center></li>
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
            			<div class="col-md-10 col-sm-offset-1 noboxstyle">  
                              
                            <form action="" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
                               
                                <fieldset>
                                    <legend><center><span class="glyphicon glyphicon-edit bigicon"></span><br> Editar Acervo</center></legend>
                        
                                    <!--Campos do lado esquerdo do form-->
                                    <div class="col-md-6" >

                                        <div class="form-group">
                                        	<label for="indice">Índice:</label><br/>
                							<input class="form-control" type="text" id="indice" name="indice" value="<?php echo $_POST['indice']; ?>" size="92"/>    
                                        </div>

                                        <div class="form-group">
                                            <label for="fundo">Fundo:</label><br/>
                                            <input class="form-control" type="text" id="fundo" name="fundo" value="<?php echo $_POST['fundo']; ?>" size="92"/>    
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


                                    <!--Campos do lado esquerdo do form-->
                                    <div class="col-md-6" >

                                        <div class="form-group">
                                            <label for="dia">Data:</label><br/>

                                            <div class="row">
                                                <div class="col-md-4" >
                                                    <input class="form-control" type="text" id="dia" name="dia" size="25" value="<?php echo $_POST['dia']; ?>"/>
                                                </div>

                                                <div class="col-md-4" >
                                                    <input class="form-control" type="text" id="mes" name="mes" size="25" value="<?php echo $_POST['mes']; ?>" />
                                                </div>

                                                <div class="col-md-4" >
                                                    <input class="form-control" type="text" id="ano" name="ano" size="25" value="<?php echo $_POST['ano']; ?>" />
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

                                        <input type="hidden" value="<?php echo $_POST['editar']; ?>" name="editar" />

                                        <input type="hidden" value="-1" name="statusEditar" />

                                    </div>

                              
                                    <!--Botões-->
                                    <div class="col-md-12">

            						    <center>
                                            <br />
                                            <div class="col-md-4"></div>

                                            <div class="col-md-2" >
                                            <input type="button" class="btn btn-primary btnSize1" value="Salvar" onclick="document.form1.action='acervo.php'; document.form1.submit();" />
                                            </div>

                                            <div class="col-md-2" >
            						        <input type="button" class="btn btn-warning btnSize1" value="Cancelar" onclick="document.form1.action='acervo.php?e=1'; document.form1.submit();" />
                                            </div>

                                            <div class="col-md-4"></div>
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
