<?php
    //instacia un objeto Cosecha y obtiene los datos
    include_once "../model/Cosecha_model.php";
    $id=$_GET["id"];
    $cosecha = new Cosecha_model();
    $cosechas_finca = $cosecha->get_datos_cosecha_finca($id);
?>