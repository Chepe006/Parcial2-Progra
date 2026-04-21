<?php
require_once("includes/auth.php");
require_once("config/db.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: dashboard.php?error=1");
    exit();
}

$nombre = trim($_POST["nombre"] ?? "");
$categoria = trim($_POST["categoria"] ?? "");
$precio = trim($_POST["precio"] ?? "");
$stock = trim($_POST["stock"] ?? "");
$estado = trim($_POST["estado"] ?? "");
$descripcion = trim($_POST["descripcion"] ?? "");

if (
    empty($nombre) ||
    empty($categoria) ||
    empty($precio) ||
    $stock === "" ||
    empty($estado)
) {
    header("Location: dashboard.php?error=1");
    exit();
}

if (!is_numeric($precio) || $precio <= 0) {
    header("Location: dashboard.php?error=1");
    exit();
}

if (!is_numeric($stock) || $stock < 0) {
    header("Location: dashboard.php?error=1");
    exit();
}

if ($descripcion === "") {
    $descripcion = null;
}

try {
    $sql = "INSERT INTO productos (nombre, categoria, precio, stock, estado, descripcion, id_usuario)
            VALUES (:nombre, :categoria, :precio, :stock, :estado, :descripcion, :id_usuario)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->bindParam(":precio", $precio);
    $stmt->bindParam(":stock", $stock);
    $stmt->bindParam(":estado", $estado);
    $stmt->bindParam(":descripcion", $descripcion);
    $stmt->bindParam(":id_usuario", $_SESSION["id_usuario"]);
    $stmt->execute();

    header("Location: dashboard.php?ok=1");
    exit();
} catch (PDOException $e) {
    header("Location: dashboard.php?error=1");
    exit();
}
?>