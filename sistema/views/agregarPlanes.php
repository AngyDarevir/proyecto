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
    <title>Agregar Planes</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="Agregar">
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

        <h1>Agregar Planes</h1>

        <form action="" method="post" class="actpl">
            <div>
                <h4>Nombre</h4>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            </div>
            <div>
                <h4>Precio</h4>
                <input type="text" name="precio" id="precio" placeholder="Precio" required>
            </div>
            <div>
                <h4>IVA</h4>
                <input type="text" name="impuestos" id="impuestos" placeholder="Impuestos" required>
            </div>
            <div>
                <h4>Duración en días</h4>
                <select name="mcodigodi" class="custom-select">
                    <option value="30">30</option>
                    <option value="182">182</option>
                    <option value="365">365</option>
                </select>
            </div>
            <div>
                <h4>Descripción</h4>
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" required>
            </div>
            <div>
                <h4>Categoría</h4>
                <input type="text" name="categoria" id="categoria" placeholder="Categoría" required>
            </div>

            <button type="submit">Actualizar / Agregar</button>
        </form>
    </div>
</body>

</html>


<?php
require "../controladores/usuariocontrolador.php";
require_once "../config/app.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $impuestos = $_POST['impuestos'];
    $vigencia = $_POST['vigencia'];
    $descripcion = $_POST['descripcion'];

    $usuarioModelo = new UsuarioModelo();
    $resultado = $usuarioModelo->registrarPlan($nombre, $precio, $categoria, $impuestos, $vigencia, $descripcion);
    if ($resultado) {
        echo "Registro exitoso.";
    } else {
        echo "Error al registrar el plan.";
    }
}
?>