<?php
session_start();
include_once("inc/funciones.php");
include_once("plantilla/cabezera.inc.php");
if($_SESSION['log'] == false){

    $mensajeNombre = "su nombre";
    $alertaNombre = "";
    $mensajeUsuario = "su usuario";
    $alertaUsuario = "";
    $mensajeClave = "su contraseña";
    $alertaClave = "";

    if(isset($_SESSION['validacion'])){
        if(isset($_SESSION['validacion'][0])){
            $mensajeNombre = $_SESSION['validacion'][0]['mensaje'];
            $alertaNombre = 'class="validacion_error"';
        }
        if(isset($_SESSION['validacion'][1])){
            $mensajeUsuario = $_SESSION['validacion'][1]['mensaje'];
            $alertaUsuario = 'class="validacion_error"';
        }
        if(isset($_SESSION['validacion'][2])){
            $mensajeClave = $_SESSION['validacion'][2]['mensaje'];
            $alertaClave = 'class="validacion_error"';
        }
    }

    ?>

    <div class="formulario formulario_usuarios">
        <h2>Registrarse</h2>
        <form action="modulos/registrar_usuario.php" method="POST">
            <div>
                <input type="text" name="nombre" id="nombre" <?= $alertaNombre; ?>
                placeholder="<?= $mensajeNombre; ?>" required="required">
            </div>
            <div>
                <input type="text" name="usuario" id="usuario" <?= $alertaUsuario; ?>
                placeholder="<?= $mensajeUsuario; ?>" required="required">
            </div>
            <div>
                <input type="password" name="clave" id="clave" <?= $alertaClave; ?>
                placeholder="<?= $mensajeClave; ?>" required="required">
            </div>
            <div>
                <input type="submit" value="Registrarse" class="boton_primario">
            </div>
        </form>
    </div>

    <?php
    mostrarMensaje();
}else{
    echo '<p>Ya se encuentra iniciada la sesion de <strong>' . $_SESSION['usuario'] . '</strong></p>';
}
include_once("plantilla/pie.inc.php");
?>