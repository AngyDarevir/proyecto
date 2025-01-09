<?php
require_once "../inc/auth.php";
// Solo los administradores (S) pueden acceder
verificarAcceso(['S']);

require_once "../controladores/usuariocontrolador.php";

$controlador = new UsuarioModelo();

// Obtiene los planes desde la base de datos
$planes = $controlador->obtenerPlanes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['borrar'])) {
        $controlador->borrarPlanes($_POST['id']);
    }
    if (isset($_POST['editar'])) {
        header("Location: actualizarPlanes.php?id=" . $_POST['id']);
        exit();
    }
} 
$controlador = new UsuarioModelo();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes Administrador</title>
    <link href="style.css" rel="stylesheet" />
</head>
<body>
<nav>
    <ul>
        <li><a href="dashboardAdmin.php">Dashboard</a></li>
        <li><a href="dashboardSuscripcionesAdmin.php">Dashboard de Suscripciones</a></li>
        <li><a href="usuariosAdmin.php">Usuarios</a></li>
        <li><a href="perfilAdministrador.php">Perfil de Administrador</a></li>
        <li><a href="cupones.php">Cupones</a></li>
        <li><a href="planesAdmin.php">Planes</a></li>
        <li>
            <form action="../controladores/logout.php" method="post">
                <input type="submit" value="Cerrar sesión" class="btn">
            </form>
        </li>
    </ul>
</nav>

<div class="planes">
    <h1>Planes</h1>
    <div class="planes-container">
        <!-- Tarjeta 1 -->
        <div class="card">
            <h4>Plan Básico</h4>
            <p>Precio: $100</p>
            <p>Vigencia: 30 días</p>
            <ul>
                <li>Categoría: Individual</li>
                <li>Descripción: Acceso limitado</li>
            </ul>
            <div class="cobo">
                <form method="POST">
                    <button type="submit" name="editar">Editar</button>
                </form>
                <form method="POST">
                    <button type="submit" name="borrar" onclick="return confirm('¿Está seguro de borrar este plan?')">Borrar</button>
                </form>
            </div>
        </div>
        <!-- Tarjeta 2 -->
        <div class="card">
            <h4>Plan Básico</h4>
            <p>Precio: $300</p>
            <p>Vigencia: 60 días</p>
            <ul>
                <li>Categoría: Individual</li>
                <li>Descripción: Acceso limitado</li>
            </ul>
            <form method="POST">
                <button type="submit" name="editar">Editar</button>
            </form>
            <form method="POST">
                <button type="submit" name="borrar" onclick="return confirm('¿Está seguro de borrar este plan?')">Borrar</button>
            </form>
        </div>
        <!-- Tarjeta 3 -->
        <div class="card">
            <h4>Plan Básico</h4>
            <p>Precio: $700</p>
            <p>Vigencia: 150 días</p>
            <ul>
                <li>Categoría: Individual</li>
                <li>Descripción: Acceso limitado</li>
            </ul>
            <form method="POST">
                <button type="submit" name="editar">Editar</button>
            </form>
            <form method="POST">
                <button type="submit" name="borrar" onclick="return confirm('¿Está seguro de borrar este plan?')">Borrar</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
