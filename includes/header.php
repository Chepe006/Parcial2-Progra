<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIDRID Inventario</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="container">
        <div class="brand">
            <img src="https://ferreteriavidri.com/public/images/Vidri_Alt.png?1652303456" alt="Logo VIDRID" class="logo">
            <div class="brand-text">
                <h1>VIDRID Ferretería</h1>
                <p>Sistema de Inventario</p>
            </div>
        </div>

        <nav>
            <a href="index.php">Inventario</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="dashboard.php">Panel</a>
                <a href="logout.php">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar sesión</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">