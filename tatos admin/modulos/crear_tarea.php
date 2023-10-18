<?php
session_start();
$dbcon = include_once("../inc/conexion.php");


$titulo = $_POST['titulo'];
$tarea = $_POST['tarea'];

$tituloOK = false;
$tareaOK = false;

if($titulo == ""){
    $errorValidacion[0]['campo'] = 'titulo';
    $errorValidacion[0]['mensaje'] = $tarea;
}else{
    $tituloOK = true;
}

if($tarea == ""){
    $errorValidacion[1]['campo'] = 'tarea';
    $errorValidacion[1]['mensaje'] = $titulo;
}else{
    $tareaOK = true;
}

if(!($tituloOK && $tareaOK)){
    $mensaje = "Datos requeridos";
    $_SESSION['mensaje'] = $mensaje;
    $_SESSION['validacion'] = $errorValidacion;
    header("location: ../nueva_tarea.php");
    exit();
}

$stmt = mysqli_prepare($dbcon, "INSERT INTO tareas (id_usuario, titulo, tarea, id_estado)
VALUES (?,?,?,1)");
mysqli_stmt_bind_param($stmt, 'sss', $_SESSION['id_usuario'], $titulo, $tarea);
try{
    mysqli_stmt_execute($stmt);
}catch(mysqli_sql_exception $e){
    $mensaje = "Error al crear una nueva tarea";
    $_SESSION['mensaje'] = $mensaje;
    header("location: ../nueva_tarea.php");
    exit();
}

header("location: ../index.php");