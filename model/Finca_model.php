<?php

    class Finca_model{

        private $db;
        private $fincas_usuario;
        private $fincas_usuario_filtrada;
        private $fincas_filtrada;
        private $fincas;

        public function __construct(){

            include_once "Conexion.php";
            $this->db = Conexion::conexion();
        }
        //Consulta de datos de finca de un usuario y devuelve un array
        public function get_datos_finca_usuario($dni){

            $consulta = $this->db->query("SELECT F.id, F.referencia, F.cultivo FROM finca F JOIN usuario_finca UF ON F.id = UF.finca_id JOIN usuario U ON UF.usuario_id = U.id WHERE U.DNI = '$dni'");

            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){

                $this->fincas_usuario[]=$fila;
            };

            return $this->fincas_usuario;
        }
        
        //Consulta de datos de finca de todos los usuarios, devuelve un array
        public function get_datos_finca(){

            $consulta = $this->db->query("SELECT F.id, F.referencia, F.cultivo, U.nombre, U.apellidos FROM finca F JOIN usuario_finca UF ON F.id = UF.finca_id JOIN usuario U ON UF.usuario_id = U.id");

            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){

                $this->fincas[]=$fila;
            };

            return $this->fincas;
        }

        //Crea el registro de la nueva finca en la base de datos
        public function create_finca($ref, $cultivo){
            
            $consulta = $this->db->query("INSERT INTO finca (referencia, cultivo) VALUES ('$ref','$cultivo')");

        }

        //Asigna el último registro de finca al usuario actual
        public function asigna_finca($ref, $id){
            $fincaId = $this->db->lastInsertId();
            $consulta = $this->db->query("INSERT INTO usuario_finca (usuario_id, finca_id) VALUES ('$id','$fincaId')");
        }
        //Elimina la finca seleccionada
        public function elimina_finca($id){

            $consulta = $this->db->query("DELETE FROM finca WHERE id ='$id'");
        }
        //Filtra las fincas del usuario según un parámetro, devuelve un array
        public function filtra_finca_usuario($dni,$cultivo){
            
            $consulta = $this->db->query("SELECT F.id, F.referencia, F.cultivo FROM finca F JOIN usuario_finca UF ON F.id = UF.finca_id JOIN usuario U ON UF.usuario_id = U.id WHERE U.DNI = '$dni' AND F.cultivo = '$cultivo'");

            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){

                $this->fincas_usuario_filtrada[]=$fila;
            };

            return $this->fincas_usuario_filtrada;
        }
        //Filtra las fincas según un parámetro, devuelve un array
        public function filtra_datos_finca($dni){

            $consulta = $this->db->query("SELECT F.id, F.referencia, F.cultivo, U.DNI, U.nombre, U.apellidos FROM finca F JOIN usuario_finca UF ON F.id = UF.finca_id JOIN usuario U ON UF.usuario_id = U.id WHERE U.DNI = '$dni'" );

            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){

                $this->fincas_filtrada[]=$fila;
            };

            return $this->fincas_filtrada;
        }
    }
?>