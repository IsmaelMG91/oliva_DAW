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
    <div class="contenedor-finca">
        <!--Filtros-->
        <div class="filter">
            <h3>Filtros</h3>
            <form action = "<?php echo $_SERVER['PHP_SELF']?>" method = "GET">
                <table>
                    <th>Propietario</th>
                    <tr>
                        <td class = "td_select">
                            <select name="dni" id="filter">
                                <option value="4552323K">4552323K</option>
                                <option value="5002354R">5002354R</option>
                            </select>
                        </td>
                        <td>
                            <input class="buttons" type = "submit" name = "filtro" value = "Filtrar"/>
                        </td>
                        <td>
                            <a href = "<?php echo $_SERVER['PHP_SELF'];?>"><input class="buttons" type = "button" value = "Eliminar filtro"/></a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="finca">
            <h3>Fincas registradas</h3>
            <?php
                include_once "../controller/Finca_controller.php";

                echo "<table class='table-data'><th>Propietario</th><th>Referencia Catastral</th><th>Tipo de Cultivo</th>";
                if($fincas){
                    //Si hay registros de fincas, muestra las que coincidan con el parámetro elegido en los filtros
                    if (isset($_GET["filtro"])){
                        $dni_usuario = $_GET["dni"];
                        $finca_filtrada = new Finca_model();
                        $fincas_usuario_filtrada = $finca_filtrada->filtra_datos_finca($dni_usuario);
                        if($fincas_usuario_filtrada){
                            foreach($fincas_usuario_filtrada as $fila){
                                echo "<tr><td>";
                                echo $fila["nombre"] . " " . $fila["apellidos"] . "</td><td>";
                                echo $fila["referencia"] . "</td><td>";
                                echo $fila["cultivo"] . "</td><td>";
                                echo "<a href='admin_cosecha_view.php?id=" . $fila["id"] ."'><input class='buttons' type='button' name=\"select\" value=\"Seleccionar\"/></a></td></tr>";
                            }
                            echo "</table>";
                        }else{
                            echo "<tr><td colspan='3'>No hay registros con ese filtro</td></tr></table>";
                        }
                    } else {
                        //Si hay registros de fincas, las muestra todas
                        foreach($fincas as $fila){
                            echo "<tr><td>";
                            echo $fila["nombre"] . " " . $fila["apellidos"] . "</td><td>";
                            echo $fila["referencia"] . "</td><td>";
                            echo $fila["cultivo"] . "</td><td>";
                            echo "<a href='admin_cosecha_view.php?id=" . $fila["id"] ."'><input class='buttons' type='button' name=\"select\" value=\"Seleccionar\"/></a></td></tr>";
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