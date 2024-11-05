<?php

    class Cosecha_model{

        private $db;
        private $cosechas_finca;
        private $cosechas_finca_order;

        //Conextamos a base de datos
        public function __construct(){

            include_once "Conexion.php";
            $this->db = Conexion::conexion();
        }
        //Obtiene los datos de la finca y devuelve un array
        public function get_datos_cosecha_finca($id){

            $consulta = $this->db->query("SELECT C. id, C.fecha_cosecha, C.peso, C.rendimiento FROM cosecha C JOIN finca_cosecha FC ON C.id = FC.cosecha_id JOIN finca F ON FC.finca_id = F.id WHERE F.id = '$id' ORDER BY C.fecha_cosecha DESC");

            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){

                $this->cosechas_finca[]=$fila;
            };

            return $this->cosechas_finca;
        }
        //Crea una cosecha y la asigna al usuario correspondiente
        public function create_cosecha($fecha, $peso, $rendimiento, $id){

            $consulta = $this->db->query("INSERT INTO cosecha (fecha_cosecha, peso, rendimiento) VALUES ('$fecha', $peso, $rendimiento)");
            $cosechaId = $this->db->lastInsertId();
            $consulta2 = $this->db->query("INSERT INTO finca_cosecha (finca_id, cosecha_id) VALUES ('$id','$cosechaId')");
        }
        //Elimina la cosecha seleccionada
        public function elimina_cosecha($id){

            $consulta = $this->db->query("DELETE FROM cosecha WHERE id ='$id'");
        }
        //Ordena las cosechas de una finca seleccionada según el orden establecido, devuelve un array
        public function cosecha_finca_order_by($id, $order){

            $consulta = $this->db->query("SELECT C. id, C.fecha_cosecha, C.peso, C.rendimiento FROM cosecha C JOIN finca_cosecha FC ON C.id = FC.cosecha_id JOIN finca F ON FC.finca_id = F.id WHERE F.id = '$id' ORDER BY C.$order DESC");

            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){

                $this->cosechas_finca_order[]=$fila;
            };

            return $this->cosechas_finca_order;
        }
    }
?>