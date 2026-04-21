<?php
require_once("includes/auth.php");
require_once("config/db.php");
include("includes/header.php");

$mensaje = "";
$error = "";

if (isset($_GET["ok"])) {
    $mensaje = "Producto guardado correctamente.";
}

if (isset($_GET["error"])) {
    $error = "No se pudo guardar el producto. Verifique los datos.";
}
?>

<div class="card">
    <h2>Panel de administración</h2>
    <p>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?>. Desde aquí puedes registrar productos en el inventario de VIDRID.</p>
</div>

<div class="card">
    <h3>Registrar producto</h3>

    <?php if (!empty($mensaje)): ?>
        <div class="mensaje-ok"><?= $mensaje ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="mensaje-error"><?= $error ?></div>
    <?php endif; ?>

    <form action="guardar_producto.php" method="POST">
        <label>Nombre del producto</label>
        <input type="text" name="nombre" maxlength="100" required>

        <label>Categoría</label>
        <select name="categoria" required>
            <option value="">Seleccione una categoría</option>
            <option value="Cemento">Cemento</option>
            <option value="Herramientas">Herramientas</option>
            <option value="Pinturas">Pinturas</option>
            <option value="Tuberías">Tuberías</option>
            <option value="Tornillería">Tornillería</option>
        </select>

        <label>Precio ($)</label>
        <input type="number" name="precio" step="0.01" min="0.01" required>

        <label>Stock</label