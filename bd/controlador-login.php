<?php
session_start();
if (!empty($_POST["btnIniciar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["contrasena"])) {
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        // Deshabilita los mensajes de error en PHP
        error_reporting(0);

        // Consulta a la tabla de usuarios para poder ingresar
        $sqlL = $con->query("SELECT * FROM usuario WHERE usuario='$usuario' AND clave='$contrasena'");
        $datos = $sqlL->fetch_object();

        // Vuelve a habilitar los mensajes de error en PHP
        error_reporting(E_ALL);
        //Si la variable datos no es NULL se ejecuta el codigo completo
        if ($datos) {
            $_SESSION["usuario"] = $datos->usuario;
            header("location: index.php");
        } else {
            echo "<div class='alert alert-danger'>Usuario o contraseña incorrectos</div>";
        }
    }
}