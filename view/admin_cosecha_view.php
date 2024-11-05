<?php

    setcookie('idFinca',$_GET['id'], time()+3600);

?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oliva Administrador</title>
    <link rel="icon" type="image/jpg" href="../img/Logo_mini.ico"/>
    <link rel="stylesheet" href="../css/estilos_usuario.css">
</head>
<body>
    <!--Comprobamos si la sesión de usuario ha sido validada-->
    <?php
        session_start();
        include_once "header_admin.php";
        if(!isset($_SESSION["user"])){
            header("location:../index.php");
        };
    ?>
    <!--Formulario de inserción de nuevas cosechas-->
    <div class="insert">
        <h3>Insertar Nueva Cosecha</h3>
        <form action ="<?php echo $_SERVER["PHP_SELF"];?>" method ="POST">
            <table>
                <th>Fecha</th>
                <th>Peso</th>
                <th>Rendimiento</th>
                <tr>
                    <td><input type ="date" id = "date" name = "date" required/></td><td><input id="peso" type = "text" id ="peso" name = "peso" pattern = "[0-9]+" required/></td>
                    <td><input id="rendimiento"type = "text" id = "rend" name = "rend" pattern = "[0-9]{1,2}" title = "Valor entre el 0 y el 99." required/></td><td><input id = "insert_cosecha" class ="buttons" type="submit" name="insert" value ="Insertar"/></td>
                </tr>
            </table>

            <!--Crea y asigna nueva cosecha-->
            <?php
                if(isset($_POST["insert"])){
                    include_once "../controller/Cosecha_controller.php";
                    $fecha = $_POST["date"];
                    $peso = $_POST["peso"];
                    $rend = $_POST["rend"];
                    $idFinca = $_COOKIE['idFinca'];
                    $cosecha->create_cosecha($fecha,$peso,$rend,$idFinca);

                    header("Location:" . $_SERVER["PHP_SELF"] . "?id=" . "$idFinca");

                }
            ?>
        </form>
    </div>

    <!--Genera la tabla donde se muestran los datos-->
    <div class="contenedor-finca">
        <h3>Cosechas registradas</h3>        
        <?php
            include_once "../controller/Cosecha_controller.php";
            echo "<table class='table-data'><th>Fecha</th><th>Peso</th><th>Rendimiento</th>";
            if($cosechas_finca){    
                foreach($cosechas_finca as $fila){
                    echo "<tr><td>";
                    echo $fila["fecha_cosecha"] . "</td><td>";
                    echo $fila["peso"] . " KG</td><td>";
                    echo $fila["rendimiento"] . "%</td><td>";
                    echo "<a href='../controller/Delete_cosecha_controller.php?idCosecha=" . $fila['id'] . "&amp;idFinca=". $id ."'><input class='buttons' type='button' name='delete' value='Eliminar'/></a></td></tr>";
                }
            }else{
                echo "<tr><td colspan='3'>No se han encontrado registros</td></tr>";
            }
            echo "</table>"
        ?>     
    </div>
    <script type="text/javascript" src="../js/scripts_admin.js"></script> 
</body>
</html>