<?php
session_start();
$dbcon = include_once("../inc/conexion.php");

if (isset($_POST['usuario']) && $_POST['usuario'] != "") {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
} else {
    $mensaje = "Ingrese un nombre de usuario";
    $_SESSION['mensaje'] = $mensaje;
    header("location:../iniciar_sesion.php");
    exit();
}

$stmt = mysqli_prepare($dbcon, "SELECT * FROM usuarios_private WHERE usuario = ? AND clave = ?");
mysqli_stmt_bind_param($stmt, 'ss', $usuario, $clave);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$usuario = mysqli_fetch_assoc($result);

if (!$usuario) {
    $mensaje = "Usuario y/o contraseña incorrecta";
    $_SESSION['mensaje'] = $mensaje;

    header("location: ../iniciar_sesion.php");
} else {
    $_SESSION['mensaje'] = null;
    $_SESSION['usuario'] = $usuario['usuario'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['log'] = true;

    header("location: ../index.php");
}