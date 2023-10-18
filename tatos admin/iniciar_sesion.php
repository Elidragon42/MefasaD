<?php
session_start();
include_once("inc/funciones.php");
include_once("plantilla/cabezera.inc.php");

if ($_SESSION['log'] == false) {
    ?>

    <div class="formulario formulario_usuarios">
        <h2>Iniciar sesión</h2>
        <form action="modulos/procesar_usuario.php" method="POST">
            <div>
                <input type="text" name="usuario" id="usuario" placeholder="usuario" required="required">
            </div>
            <div>
                <input type="password" name="clave" id="clave" placeholder="contraseña" required="required">
            </div>
            <div>
                <input type="submit" value="Iniciar sesión" class="boton_primario">
            </div>
        </form>
    </div>

    <?php
    mostrarMensaje();
} else {
    echo '<p>Ya se encuentra iniciada la sesión de <strong>' . $_SESSION['usuario'] . '</strong></p>';
}

include_once("plantilla/pie.inc.php");
?>