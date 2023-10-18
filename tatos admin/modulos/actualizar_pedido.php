<?php
session_start();
$dbcon = include_once("../inc/conexion.php");

$idTarea = $_POST['id_tarea'];
$titulo = $_POST['titulo'];
$tarea = $_POST['tarea'];
$estado = $_POST['estado'];

$tituloOK = false;
$tareaOK = false;

if($titulo == ""){
    $errorValidacion[0]['campo'] = "titulo";
    $errorValidacion[0]['mensaje'] = "Titulo es requerido"; 
}else{
    $tituloOK = true;
}

if($tarea == ""){
    $errorValidacion[1]['campo'] = "titulo";
    $errorValidacion[1]['mensaje'] = "Tarea es requerida"; 
}else{
    $tareaOK = true;
}

if(!($tituloOK && $tareaOK)){
    $mensaje = "Datos requeridos";
    $_SESSION['mensaje'] = $mensaje;
    $_SESSION['validacion'] = $errorValidacion;
    header("location: ../editar_tarea.php?id=".$idTarea);
    exit();
}

/*
var_dump($titulo);
var_dump($tarea);
var_dump($estado);
var_dump($idTarea);
exit();
*/

$stmt = mysqli_prepare($dbcon, "UPDATE tareas SET titulo = ?, tarea = ?, id_estado = ? WHERE id_tarea = ?");
mysqli_stmt_bind_param($stmt, 'ssii', $titulo, $tarea, $estado, $idTarea);
try{
    mysqli_stmt_execute($stmt);
}catch(mysqli_sql_exception $e){
    $mensaje = "Error al actualizar la tarea";
    $_SESSION['mensaje'] = $mensaje;
    header("location: ../editar_tarea.php?id=".$idTarea);
    exit();
}

header("location: ../index.php");