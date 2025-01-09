<?php
require_once "../inc/auth.php";
require_once "../config/app.php";
require_once "../controladores/usuariocontrolador.php";

verificarAcceso(['S']);

if (!isset($_GET['id'])) {
    die("ID de usuario no especificado.");
}

$id = $_GET['id'];
$controlador = new UsuarioModelo();
$plan = $controlador->obtenerPlanes()[array_search($id, array_column($controlador->obtenerPlanes(), 'id_Plan'))];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan = [
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'categoria' => $_POST['categoria'],
        'vigencia' => $_POST['vigencia'],
        'precio' => $_POST['precio'],
        'impuestos' => $_POST['impuestos']
    ];
    $controlador->actualizarPlanes($id, $plan);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" />
    <title>Actualizar Planes</title>
</head>

<body>
    <div class="actualizarp">
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

        <h1>Actualizar planes</h1>
        <form method="post" class="actpl">
            <div>
                <h4>Nombre</h4>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($plan['nombre']) ?>" required>
            </div>
            <div>
                <h4>Precio</h4>
                <input type="text" id="precio" name="precio" value="<?= htmlspecialchars($plan['precio']) ?>" required>
            </div>
            <div>
                <h4>IVA</h4>
                <input type="text" id="impuestos" name="impuestos" value="<?= htmlspecialchars($plan['impuestos']) ?>" required>
            </div>
            <div>
                <h4>Duración en días</h4>
                <input type="text" id="vigencia" name="vigencia" value="<?= htmlspecialchars($plan['vigencia']) ?>" required>
            </div>
            <div>
                <h4>Descripción</h4>
                <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($plan['descripcion']) ?>" required>
            </div>
            <div>
                <h4>Categoría</h4>
                <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($plan['categoria']) ?>" required>
            </div>
            <button class="actagr">Actualizar</button>
        </form>
    </div>
</body>

</html>
