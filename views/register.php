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

        <div class="row imgback">
        <div class= "overlay">
        
            <header class="row uptitle">
                
                <div class="login-top">
                    <center><img src="imgSys/logo_site.jpg" class="img-circle" width="179" height="151" align="middle"></center>
                </div>
                
                <center><h2 class="initialTitle">SAM - Sistema Administrativo do Memorial da UFC</h2></center>
        
            </header>

            <div class="col-md-6 col-md-offset-3 boxstyle">

                <!--<div class="alert alert-info" role="alert">
                <span class="textInfo">-->
                    <?php
                        // show potential errors / feedback (from registration object)
                        if (isset($registration)) {
                            if ($registration->errors) {
                                foreach ($registration->errors as $error) {
                                    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                                }
                            }
                            if ($registration->messages) {
                                foreach ($registration->messages as $message) {
                                    echo '<div class="alert alert-info" role="alert">'.$message.'</div>';
                                }
                            }
                        }
                    ?>
                <!--</span>
                </div>-->
                    
                <form method="post" action="register.php" name="registerform">
                   
                    <fieldset>
                        <legend><center><span class="glyphicon glyphicon glyphicon-list-alt bigicon"></span> Criar nova conta</center></legend>
            
                        <div class="form-group">
                            <label for="login_input_username">Usuário Login (somente letras e numeros, 2 a 64 caracteres)</label>
                            <input id="login_input_username" class="login_input form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
                        </div>

                        <div class="form-group">
                            <label for="login_input_userfullname">Nome (Nome e Sobrenome)</label>
                            <input id="login_input_userfullname" class="login_input form-control" type="text" pattern="[a-zA-Z\s]{2,100}" name="user_fullname" required />
                        </div>

                        <div class="form-group" >
                            <label for="login_input_email">Email do Usuário</label>
                            <input id="login_input_email" class="login_input form-control" type="email" name="user_email" required />
                        </div>

                        <div class="form-group" >
                            <label for="login_input_password_new">Senha (min. 6 caracteres)</label>
                            <input id="login_input_password_new" class="login_input form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
                        </div>


                        <div class="form-group" >
                            <label for="login_input_password_repeat">Repetir senha</label>
                            <input id="login_input_password_repeat" class="login_input form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /><br />
                        </div>

                        <center><input type="submit" class="btn btn-primary" name="register" value="Registrar"></center>
                        
                        <br /><br />
                        <center><a class="btn-link" href="index.php">Voltar para página de login</a></center><br />
                  
                    </fieldset>
                </form>

                

            </div>
        </div>
        </div>  

    </div>
    

</body>
</html>