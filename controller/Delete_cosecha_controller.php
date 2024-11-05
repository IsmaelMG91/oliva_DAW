<?php
    //instancia un objeto Cosecha y elimina un registro
    include_once "../model/Cosecha_model.php";
    $cosechaId = $_GET['idCosecha'];
    $cosecha = new Cosecha_model();
    $cosecha->elimina_cosecha($cosechaId);
    $fincaId = $_GET['idFinca'];
    
    header("Location:../view/admin_cosecha_view.php?id=" . "$fincaId");
?>