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
    $error = "Ocurrió un error al guardar el producto.";
}

$sql = "SELECT p.id_producto, p.nombre, p.categoria, p.precio, p.stock, p.estado, p.descripcion, u.nombre AS usuario
        FROM productos p
        LEFT JOIN usuarios u ON p.id_usuario = u.id_usuario
        ORDER BY p.id_producto DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <h2>Panel de administración</h2>
    <p>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?>. Aquí puedes registrar productos al inventario de VIDRID.</p>
</div>

<?php if (!empty($mensaje)): ?>
    <div class="mensaje-ok"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="mensaje-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="card">
    <h3>Registrar nuevo producto</h3>

    <form action="guardar_producto.php" method="POST">
        <label for="nombre">Nombre del producto</label>
        <input type="text" id="nombre" name="nombre" maxlength="100" required>

        <label for="categoria">Categoría</label>
        <select id="categoria" name="categoria" required>
            <option value="">Seleccione una categoría</option>
            <option value="Cemento">Cemento</option>
            <option value="Herramientas">Herramientas</option>
            <option value="Pinturas">Pinturas</option>
            <option value="Tuberías">Tuberías</option>
            <option value="Tornillería">Tornillería</option>
        </select>

        <label for="precio">Precio ($)</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0.01" required>

        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" min="0" required>

        <label>Estado</label>
        <div class="radio-group">
            <label><input type="radio" name="estado" value="Disponible" required> Disponible</label>
            <label><input type="radio" name="estado" value="Agotado" required> Agotado</label>
        </div>

        <label for="descripcion">Descripción (opcional)</label>
        <textarea id="descripcion" name="descripcion" maxlength="255"></textarea>

        <button type="submit">Guardar producto</button>
    </form>
</div>

<div class="card">
    <h3>Productos registrados</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Descripción</th>
                <th>Registrado por</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto["id_producto"]) ?></td>
                    <td><?= htmlspecialchars($producto["nombre"]) ?></td>
                    <td><?= htmlspecialchars($producto["categoria"]) ?></td>
                    <td>$<?= htmlspecialchars($producto["precio"]) ?></td>
                    <td><?= htmlspecialchars($producto["stock"]) ?></td>
                    <td><?= htmlspecialchars($producto["estado"]) ?></td>
                    <td><?= htmlspecialchars($producto["descripcion"]) ?></td>
                    <td><?= htmlspecialchars($producto["usuario"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>