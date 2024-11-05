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
        };
    ?>
    <!--Insertamos nueva finca-->
    <div class="insert">         
        <h3>Insertar Nueva Finca</h3>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
            <table>
                <th>Referencia Catastral</th>
                <th>Tipo de Cultivo</th>
                <tr>
                    <td id="catastro" class="td_catastro">
                        <input type="text" id="ref" name = "ref" pattern="^[0-9]{5}[A-Z]{1}[0-9]{12}[A-Z]{2}" title="Recuerda que una referencia catastral debe comenzar por cinco dígitos, seguido de una letra mayúscula, doce dígitos y dos letras mayúsculas." required/>
                    </td>
                    <td class="td_select">
                        <select name="op_cultivo" id="op_cultivo">
                            <option value="Hojiblanca">Hojiblanca</option>
                            <option value="Picual">Picual</option>
                            <option value="Arbequina">Arbequina</option>
                        </select>
                    </td>
                    <td>
                        <input id="insert_ref" class ="buttons" type="submit" name="insert" value ="Insertar"/>
                    </td>
                </tr>
            </table>
            <?php           
            //Se crea una finca nueva y se asigna al usuario actual
            if(isset($_POST["insert"])){
                include_once "../controller/Finca_controller.php";
                $ref = $_POST["ref"];
                $cultivo = $_POST["op_cultivo"];
                $id = $_SESSION["id"];
                $finca->create_finca($ref,$cultivo,$id);
                $finca->asigna_finca($ref, $id);

                header("Location:user_view.php");
            }
            ?>  
        </form>
    </div>
    <div class="contenedor-finca">
        <!--Filtros-->
        <div class="filter">
            <h3>Filtros</h3>
            <form action = "<?php echo $_SERVER['PHP_SELF']?>" method = "GET">
                <table>
                    <th>Tipo de cultivo</th>
                    <tr>
                        <td class="td_select">
                            <select name="filtro_cultivo" id="filtro_cultivo">
                                <option value="Hojiblanca">Hojiblanca</option>
                                <option value="Picual">Picual</option>
                                <option value="Arbequina">Arbequina</option>
                            </select>
                        </td>
                        <td>
                            <input class="buttons" type = "submit" name = "filtro" value = "Filtrar"/>
                        </td>
                        <td>
                            <a href = "<?php echo $_SERVER['PHP_SELF'];?>"><input class= "buttons" type = "button" value = "Eliminar filtro"/></a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="finca">            
            <div class="finca_data">
                <h3>Fincas en Propiedad</h3>
                <?php
                    include_once "../controller/Finca_controller.php";
                    echo "<table class='table-data'><th>Referencia Catastral</th><th>Tipo de Cultivo</th>";
                    if($fincas_usuario){
                        //Si existen fincas, las muestra según los parámetros seleccionados en filtros
                        if (isset($_GET["filtro_cultivo"])){
                            $cultivo = $_GET["filtro_cultivo"];
                            $finca_filtrada = new Finca_model();
                            $fincas_usuario_filtrada = $finca_filtrada->filtra_finca_usuario($dni,$cultivo);
                            if($fincas_usuario_filtrada){
                                foreach($fincas_usuario_filtrada as $fila){
                                    echo "<tr><td>";
                                    echo $fila["referencia"] . "</td><td>";
                                    echo $fila["cultivo"] . "</td><td>";
                                    echo "<a href='user_finca_view.php?id=" . $fila["id"] ."'><input class='buttons' type='button' name='select' value='Seleccionar'/></a></td><td>";
                                    echo "<a href='../controller/Delete_finca_controller.php?id=" . $fila["id"] ."'><input class='buttons' type='button' name='delete' value='Eliminar'/></a></td></tr>";                    
                                }
                                echo "</table>";
                            }else{
                                echo "<tr><td colspan='2'>No hay registros con ese filtro</td></tr></table>";
                            }
                        } else {                                
                            //Si existen fincas, muestra las pertenecientes al usuario
                            foreach($fincas_usuario as $fila){
                                echo "<tr><td>";
                                echo $fila["referencia"] . "</td><td>";
                                echo $fila["cultivo"] . "</td><td>";
                                echo "<a href='user_finca_view.php?id=" . $fila["id"] ."'><input class='buttons' type='button' name='select' value='Seleccionar'/></a></td><td>";
                                echo "<a href='../controller/Delete_finca_controller.php?id=" . $fila["id"] ."'><input class='buttons' type='button' name='delete' value='Eliminar'/></a></td></tr>";                
                            }
                            echo "</table>";
                        }
                    }else{
                        echo "<tr><td colspan='2'>No se han encontrado registros</td></tr></table>";
                    }                             
                ?>
            </div>  
        </div>
    </div>
    <script type="text/javascript" src="../js/scripts_usuario.js"></script> 
</body>
</html>