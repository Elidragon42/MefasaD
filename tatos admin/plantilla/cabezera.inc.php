<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div id="contenedor">
    <header>
        <h1>Tato's Admin</h1>
</header>
<nav>
    <ul>
        
        <li><a href="index.php">Lista de pedidos</a></li>
        <?php
        if(isset($_SESSION['log']) && $_SESSION['log']){
            echo '<li><a href="modulos/cerrar.php">Cerrar sesion</a></li>';
        }else{
            echo '<li><a href="iniciar_sesion.php">Iniciar sesion</a></li>';
            echo '<li><a href="registrarse.php">Registrarse</a></li>';
        }
        ?>
        </ul>
        <?php
           if(isset($_SESSION['log']) && $_SESSION['log']){
            echo '<h2>Bienvenido <strong>'.$_SESSION['nombre'].'</strong></h2>';
        }
        ?>
        <form action="index.php" method="GET">
            <input type="text" name="buscar" id="buscar" placeholder="Buscar una tarea">
            <input type="submit" value="Buscar">
    </form>
    </nav>
    <section>
        

</body>
</html>