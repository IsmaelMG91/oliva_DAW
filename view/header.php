<!--Header para usuario registrado-->
<div class="header">
    <div class="header-inside">
        <div class="logo">
            <img class ="logo-img" src="../img/Logo_claro.svg" alt="Logo"/>
        </div>
        <div>
            <span><a href="user_view.php">Inicio</a></span>
        </div>
        <div class="welcome_user">
            <span>Bienvenido/a <?php echo $_SESSION["name"];?></span>
            <span><a href="../model/cierre.php">Cerrar sesión</a></span>
        </div>
    </div>
</div>