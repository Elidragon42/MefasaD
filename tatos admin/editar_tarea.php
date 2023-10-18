<?php
session_start();

if (!isset($_SESSION['log'])) {
    $_SESSION['log'] = false;
}

include_once("inc/funciones.php");
$dbcon = include_once("inc/conexion.php");
include_once("plantilla/cabezera.inc.php");

if ($_SESSION['log']) {

    

    $idTarea = $_GET['id'];

    $sql = "SELECT
                t.id_pedido,
                t.informacion_usuario,
                t.productos,
                t.precio_total,
                t.hora_de_pedido,
                t.estado,
                t.precio,
                e.estado
            FROM usuario_admin AS t
            INNER JOIN estados AS e ON t.estado = e.estado
            WHERE t.id_pedido = ?";
            

    $stmt = mysqli_prepare($dbcon, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idTarea);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $tarea = mysqli_fetch_assoc($result);

    $result = mysqli_query($dbcon, "SELECT * FROM estados");
    $estados = mysqli_fetch_all($result, MYSQLI_ASSOC);

    
?>

    <div class="formulario formulario_tareas">
        <h2>Editar Pedido</h2>
        <form action="modulos/actualizar_pedido.php" method="POST">
            <input type="hidden" name="id_pedido" value="<?= $tarea['id_pedido']; ?>">
            
            <div>
                <label for="estado">Estado</label>
                <select name="estado" id="estado">
                    <?php foreach ($estados as $estado) : ?>
                        <option value="<?= $estado['id_estado']; ?>" <?= $tarea['estado'] == $estado['estado'] ? "selected" : ""; ?>>
                            <?= $estado['estado']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="tarea">Pedido</label>
                <textarea name="tarea" id="tarea" rows="10"  placeholder="Descripcion de la tarea" ><?= $tarea['productos']; ?></textarea>
            </div>
            <div>
                <input type="submit" value="Actualizar tarea" class="boton_primario">
            </div>
        </form>
    </div>

    <?php
    mostrarMensaje();
    
} else {
    echo '<p>No tiene acceso a este modulo, inicie sesion primero.</p>';
}
include_once("plantilla/pie.inc.php");
?>