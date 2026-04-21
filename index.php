<?php
require_once("config/db.php");
include("includes/header.php");

$sql = "SELECT id_producto, nombre, categoria, precio, stock, estado, descripcion
        FROM productos
        ORDER BY nombre ASC";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <h2>Inventario público de productos</h2>
    <p>Los visitantes pueden ver el inventario ordenado por nombre, pero solo el usuario registrado puede ingresar nuevos datos.</p>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio ($)</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['id_producto']) ?></td>
                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td><?= htmlspecialchars($producto['categoria']) ?></td>
                    <td><?= htmlspecialchars($producto['precio']) ?></td>
                    <td><?= htmlspecialchars($producto['stock']) ?></td>
                    <td><?= htmlspecialchars($producto['estado']) ?></td>
                    <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>