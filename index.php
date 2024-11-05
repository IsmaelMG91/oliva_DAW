<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oliva</title>
    <link rel="icon" type="image/jpg" href="img/Logo_mini.ico"/>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="contenedor">
        <img class="logo-img" src="img/Logo_verde.svg" alt="Logo"/>
        <!--Formulario que envía la información a la misma página-->
        <form action="<?php echo $_SERVER["PHP_SELF"];  ?>" method="POST">
            <div>
                <label for="user">Usuario
                <input type="text" id="user" name="user" pattern="^[0-9]{7}[A-Z]{1}" title="Por favor, introduzca su DNI"/>
                </label>
            </div>
            <br>
            <div>
                <label for="pass">Contraseña
                <input type="password" id="pass" name="pass"/>
                </label>
            </div>
            <br>
            <div>
                <input class="submit-button" type="submit" name="login" value="Acceder"/>
            </div>
            <br>
            <!--Intentamos hacer login, dependiendo del usuario nos envía a la página de usuario o a la de administrador-->
            <?php 
                include_once "model/Usuario.php";
                $login_user = new Usuario();
                $login_state=true;

                if (isset($_POST["login"])){
                    if ($_POST["user"]!=null && $_POST["pass"]!=null){
                        $login_state=$login_user->login($_POST["user"],$_POST["pass"]);
                        $tipo_usuario;
                        
                        if ($login_state){
                            $tipo_usuario=$_SESSION["type"];
                        }
                        if ($login_state==true && $tipo_usuario==0){
                            header ("Location:view/user_view.php");
                        }elseif($login_state==true && $tipo_usuario==1){
                            header ("Location:view/admin_view.php");
                        }else{
                            echo "Usuario o contraseña incorrectos";
                        };
                    } else {
                    echo "Usuario o contraseña incorrectos";
                    }
                }
            ?>
        </form>
        <br>
    </div>
</body>
</html>