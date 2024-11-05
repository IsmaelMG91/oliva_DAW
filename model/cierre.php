<!--Destruye la sesión y manda al usuario a la pantalla de login-->
<?php
    session_start();
    session_destroy();
    header("location:../index.php");
?>