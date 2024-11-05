<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oliva</title>
    <link rel="icon" type="image/jpg" href="../img/Logo_mini.ico"/>
    <link rel="stylesheet" href="../css/estilos_usuario.css">
</head>
<body>
    <!--Comprobamos si la sesión de usuario ha sido validada-->
    <?php
        session_start();
        include_once "header.php";
        if(!isset($_SESSION["user"])){
            header("location:../index.php");
        }
    ?>
    <div class="contenedor-finca">
        <h3>Datos de Cosecha</h3>
        <!--Filtros-->
        <div class="filter">
            <form action = "<?php echo $_SERVER['PHP_SELF']?>" method = "GET">
                <input type ="hidden" name = "id" value = "<?php echo $_GET['id']?>"/>
                <table>
                    <th>Ordenar cosechas</th>
                    <tr>
                        <td>
                            <select name="orden_cosecha" id="filter">
                                <option value="peso">Peso</option>
                                <option value="rendimiento">Rendimiento</option>
                                <option value="fecha_cosecha">Fecha</option>
                            </select>
                        </td>
                        <td>
                            <input class = "buttons" type = "submit" name = "order" value = "Ordenar"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="cosecha">
            <?php
                include_once "../controller/Cosecha_controller.php";
                echo "<table class='table-data'><th>Fecha</th><th>Peso</th><th>Rendimiento</th>";
                //Si existen registros de cosechas, los muestra ordenados según el parámetros seleccionado
                if($cosechas_finca){
                    if(isset($_GET["order"])){
                        $order = $_GET["orden_cosecha"];
                        $cosecha_order = new Cosecha_model();
                        $cosechas_finca_order = $cosecha_order->cosecha_finca_order_by($id,$order);

                        foreach($cosechas_finca_order as $fila){
                            echo "<tr><td>";
                            echo $fila["fecha_cosecha"] . "</td><td>";
                            echo $fila["peso"] . " KG</td><td>";
                            echo $fila["rendimiento"] . "%</td></tr>";
                        }
                        echo "</table>";                            
                    }else{                            
                        //Si existen registros de cosechas, muestra todos los que pertenezcan a la finca
                        foreach($cosechas_finca as $fila){
                        echo "<tr><td>";
                        echo $fila["fecha_cosecha"] . "</td><td>";
                        echo $fila["peso"] . " KG</td><td>";
                        echo $fila["rendimiento"] . "%</td></tr>";
                        }
                        echo "</table>";
                    }
                }else{
                echo "<tr><td colspan='3'>No se han encontrado registros</td></tr></table>";
                }                    
            ?>
        </div>
    </div>   
</body>
</html>