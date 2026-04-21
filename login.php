<?php
session_start();
require_once("config/db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"] ?? "");
    $clave = trim($_POST["clave"] ?? "");

    if (empty($correo) || empty($clave)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo AND clave = :clave LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":clave", $clave);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $_SESSION["usuario"] = $usuario["nombre"];
            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    }
}

include("includes/header.php");
?>

<div class="card">
    <h2>Iniciar sesión</h2>

    <?php if (!empty($error)): ?>
        <div class="mensaje-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" required>

        <label for="clave">Contraseña</label>
        <input type="password" id="clave" name="clave" required>

        <button type="submit">Ingresar</button>
    </form>
</div>

<?php include("includes/footer.php"); ?>