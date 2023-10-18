<?php
session_start();
 $dbcon = include_once("../inc/conexion.php");

 $idTarea = $_GET['id_tarea'];

 $stmt = mysqli_prepare($dbcon, "DELETE FROM tareas WHERE id_tarea = ?");
 mysqli_stmt_bind_param($stmt, 'i', $idTarea);
 mysqli_stmt_execute($stmt);

 header("location: ../index.php");