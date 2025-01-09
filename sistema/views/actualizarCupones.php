<?php
require_once "../inc/auth.php";
// Solo los administradores (S) pueden acceder
verificarAcceso(['S']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cupones</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="actualizarc">
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
        <h1>Actualizar cupones</h1>
        <form action="conexionDB.php" method="post">
            <div>
                <h4>Nombre</h4>
                <input type="text" name="nombre" placeholder="Nombre" id="nombre" required>
            </div>
            <div>
                <h4>Descuento</h4>
                <input type="text" name="descuento" placeholder="descuento" id="descuento" required>
            </div>
            <div>
                <h4>Descripcion</h4>
                <input type="text" name="descripcion" placeholder="descripcion" id="descripcion" required>
            </div>
            <div>
                <h4>Vigencia</h4>
                <input type="date" name="fecha">
            </div>
            <button>Actualizar / Agregar</button>
        </form>
    </div>
</body>

</html>
