<?php
session_start();

if (!isset($_SESSION['log'])) {
    $_SESSION['log'] = false;
}

include_once("inc/funciones.php");
$dbcon = include_once("inc/conexion.php");
include_once("plantilla/cabezera.inc.php");

$sql = "SELECT
            u.id_pedido,
            u.informacion_usuario,
            u.productos,
            u.precio_total,
            u.hora_de_pedido,
            u.estado,
            u.precio
        FROM usuario_admin AS u";
$result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
$pedidos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<h2>Lista de usuarios</h2>
<table>
    <thead>
        <tr>
            <th>Id Pedido</th>
            <th>Info Usuario</th>
            <th>Productos</th>
            <th>Precio Total</th>
            <th>Estado</th>
            <th>Hora de pedido</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($pedidos as $pedido) {
            ?>
            <tr>
            <td><a href="ver_pedido.php?id=<?= $pedido['id_pedido']; ?>"><?= $pedido['id_pedido']; ?></a></td>
                <td><?= $pedido['informacion_usuario']; ?></td>
                <th><?= $pedido['productos']; ?></th>
                <td><?= $pedido['precio_total']; ?></td>
                <td><a href="editar_tarea.php?id=<?= $pedido['id_pedido']; ?>"><?= $pedido['estado']; ?></a></td>
                <td><?= $pedido['hora_de_pedido']; ?></td>
                
                
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php
include_once("plantilla/pie.inc.php");
?>