<?php
session_start();

if (!isset($_SESSION['logueado'])) {
    $_SESSION['logueado'] = false;
}

include_once("inc/funciones.php");
$dbcon = include_once("inc/conexion.php");
include_once("plantilla/cabezera.inc.php");

if (isset($_GET['id_pedido'])) {
    $idPedido = $_GET['id_pedido'];

    $sql = "SELECT
                u.id_pedido,
                u.informacion_usuario,
                u.productos,
                u.precio_total,
                u.hora_de_pedido,
                e.estado,
                u.precio
            FROM usuario_admin AS u
            INNER JOIN estados AS e ON u.estado = e.id_estado
            WHERE u.id_pedido = ?";
    
    $stmt = mysqli_prepare($dbcon, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idPedido);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $pedido = mysqli_fetch_assoc($result);
?>

    <h2>Detalles del pedido ID: <?= $pedido['id_pedido']; ?></h2>
    <p>Información del Usuario: <?= $pedido['informacion_usuario']; ?></p>
    <p>Productos: <?= $pedido['productos']; ?></p>
    <p>Precio Total: <?= $pedido['precio_total']; ?></p>
    <p>Estado: <?= $pedido['estado']; ?></p>

<?php
} else {
    echo "<p>No se ha seleccionado ningún ID de pedido.</p>";
}

include_once("plantilla/pie.inc.php");
?>
