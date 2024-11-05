<?php
    //instancia un objeto Ficna y elimina un registro
    include_once "../model/Finca_model.php";
    $fincaId = $_GET['id'];
    $finca = new Finca_model();
    $finca->elimina_finca($fincaId);
    
    header('Location:../view/user_view.php');
?>