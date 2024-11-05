<?php
    //Instancia un objeto Finca y obtiene los datos
    include_once "../model/Finca_model.php";
    $dni=$_SESSION["user"];
    $finca = new Finca_model();
    $fincas_usuario = $finca->get_datos_finca_usuario($dni);
    $fincas = $finca->get_datos_finca();
?>