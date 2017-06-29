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
</head>
<body>



    <div class="container-fluid fullscreen">
        
            <header class="row uptitle">
                
                <div class="login-top">
                    <center><img src="imgSys/logo_site.jpg" class="img-circle" width="179" height="151" align="middle"></center>
                </div>
                
                <center><h2 class="initialTitle">SAM - Sistema Administrativo do Memorial da UFC</h2></center>
        
            </header>
        
        
            
            <div class="row">

	            <div class="col-xs-4 col-xs-offset-4 
	            			col-sm-4 col-sm-offset-4
	            			col-md-4 col-md-offset-4
	            			col-lg-4 col-lg-offset-4
	            			boxstyle">

	                <span class="textError">
	                    <?php
	                    // show potential errors / feedback (from login object)
	                    if (isset($login)) {
	                        if ($login->errors) {
	                            foreach ($login->errors as $error) {
	                                echo $error;
	                            }
	                        }
	                        if ($login->messages) {
	                            foreach ($login->messages as $message) {
	                                echo $message;
	                            }
	                        }
	                    }
	                    ?>
	                </span>
	              
	                <form method="post" action="index.php" name="loginform">
	                    <fieldset>
	                        <legend><center><span class="glyphicon glyphicon-user bigicon"></span> Acesso</center></legend>
	            
	                        <div class="form-group">
	                            <label for="login_input_username">Usuário</label>
	                            <input id="login_input_username" class="login_input form-control" pattern="[a-zA-Z0-9]{2,64}" type="text" name="user_name" required />
	                        </div>

	                        <div class="form-group" >
	                            <label for="login_input_password">Senha</label>
	                            <input id="login_input_password" class="login_input form-control" type="password" name="user_password" autocomplete="off" required />
	                        </div>

	                        <center><a class="btn-link" href="register.php">Criar nova conta</a></center><br />
	                        <center><input type="submit" class="btn btn-primary" name="login" value="Entrar"></center>
	                    </fieldset>
	                </form>

	                

	            </div>
	        </div>    

    </div>
    

</body>
</html>