
<!--Genera la conexión a la base de datos-->

<?php

    class Conexion{

        public static function conexion(){

            try{
        
            $conexion=new PDO('mysql:host=localhost; dbname=proyecto_oliva', "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            }catch(Exception $e){
                die("Error" . $e->getMesagge());
                echo "Error en la línea" . $e->getLine();
            }

            return $conexion;
        }
    }
?>