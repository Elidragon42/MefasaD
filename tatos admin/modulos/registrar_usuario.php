<?php
session_start();
$dbcon = include_once("../inc/conexion.php");

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$nombre = $_POST['nombre'];

$usuarioOK = false;
$claveOK = false;
$nombreOK = false;

if($usuario == ""){
    $errorValidacion[0]['campo'] = "usuario";
    $errorValidacion[0]['mensaje'] = "Usuario es requerido";
}else if(strlen($usuario)<3){
    $errorValidacion[0]['campo'] = "usuario";
    $errorValidacion[0]['mensaje'] = "Usuario - mínimo 3 caracteres";
}else{
    $usuarioOK = true;
}

if($clave == ""){
    $errorValidacion[1]['campo'] = "clave";
    $errorValidacion[1]['mensaje'] = "Contraseña es requerida";
}else if(strlen($clave)<8){
    $errorValidacion[1]['campo'] = "clave";
    $errorValidacion[1]['mensaje'] = "Clave - mínimo 8 caracteres";
}else{
    $claveOK = true;
}

if($nombre == ""){
    $errorValidacion[2]['campo'] = "nombre";
    $errorValidacion[2]['mensaje'] = "Nombre es requerido";
}else{
    $nombreOK = true;
}

if(!($usuarioOK && $claveOK && $nombreOK)){
    $mensaje = "Favor de revisar tus datos";
    $_SESSION['mensaje'] = $mensaje;
    $_SESSION['validacion'] = $errorValidacion;
    header("location: ../registrarse.php");
    exit();
}

$stmt = mysqli_prepare($dbcon, "INSERT INTO usuarios_private (usuario, clave, nombre) VALUES (?,?,?)");
mysqli_stmt_bind_param($stmt, 'sss', $usuario, $clave, $nombre);

try {
    mysqli_stmt_execute($stmt);

    if($stmt->affected_rows == -1){
        $mensaje = "El usuario {$usuario} ya existe";
        $_SESSION['mensaje'] = $mensaje;
        header("location: ../registrarse.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $mensaje = "Error al registrar el usuario";
    $_SESSION['mensaje'] = $mensaje;
    header("location: ../registrarse.php");
    exit();
}

$mensaje = "El usuario se registró correctamente";
$_SESSION['mensaje'] = $mensaje;
header("location: ../iniciar_sesion.php");