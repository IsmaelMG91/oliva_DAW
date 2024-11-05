<?php

    class Usuario {

        public function login($login, $pass){

            try{
                //Conectamos a base de datos
                include_once "Conexion.php";
                $db = Conexion::conexion();
                //Comprobamos los datos del usuario para acceder
                $sql="SELECT * FROM usuario WHERE DNI = :DNI AND contrasenya= :pass";
                $result=$db->prepare($sql);
                $login=htmlentities(addslashes($_POST["user"]));
                $pass=htmlentities(addslashes($_POST["pass"]));

                $result->bindValue(":DNI", $login);
                $result->bindValue(":pass", $pass);
                $result->execute();
                $tipo_usuario=$result->fetch(PDO::FETCH_ASSOC);
                //Si existe el usuario, creamos una sesión con los datos que necesitaremos
                if ($result->rowCount()!=0){
                    session_start();
                    $_SESSION["user"]=$login;
                    $_SESSION["type"]=$tipo_usuario["tipo_usuario"];
                    $_SESSION["id"]=$tipo_usuario["id"];
                    $_SESSION["name"]=$tipo_usuario["nombre"];
                    return true;
                }else{
                    return false;
                }           

            }catch (Exception $e){
                //Si no consigue conectar, detiene el proceso y lanza error
                die("Error: " . $e->getMessage());
            }
        }

    }

?>