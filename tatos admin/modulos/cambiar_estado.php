<?php
session_start();
$dbcon = include_once("../inc/conexion.php");

$estado = $_POST['estado'];
$idTarea = $_POST['id_tarea'];

$stmt = mysqli_prepare($dbcon, "UPDATE tareas SET id_estado = ? WHERE id_tarea = ?");
mysqli_stmt_bind_param($stmt, 'ii', $estado, $idTarea);
mysqli_stmt_execute($stmt);

header("location: ../index.php");