<?php
require_once "../inc/auth.php";
require_once "../config/app.php"; // Archivo de configuración de base de datos
require_once "../controladores/usuariocontrolador.php";

verificarAcceso(['S']);

$controlador = new UsuarioModelo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['borrar'])) {
        $controlador->borrarUsuario($_POST['id']);
    }
    if (isset($_POST['editar'])) {
        header("Location: actualizarUsuario.php?id=" . $_POST['id']);
    }
}

$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : null;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Obtener usuarios con búsqueda y paginación
$paginacion = $controlador->obtenerConPaginacion('usuarios', $pagina, 4, $busqueda);

$usuarios = $paginacion['registros'];
$totalPaginas = $paginacion['totalPaginas'];
$paginaActual = $paginacion['paginaActual'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Administrador</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="taus">
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

        <h2>Usuarios</h2>

        <form method="GET" action="usuariosAdmin.php" class="search-form">
            <input type="text" name="buscar" placeholder="Buscar por nombre o email..." value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>" class="search-input">
            <button type="submit" class="search-button">Buscar</button>
        </form>

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Detalles</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id_Usuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['telefono']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><a href="actualizarUsuario.php?id=<?= $usuario['id_Usuario'] ?>">Ver</a></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $usuario['id_Usuario'] ?>">
                                <button type="submit" name="editar">Editar</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $usuario['id_Usuario'] ?>">
                                <button type="submit" name="borrar" onclick="return confirm('¿Está seguro de borrar este usuario?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($paginaActual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?= $paginaActual - 1 ?>">Anterior</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= $i == $paginaActual ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginaActual < $totalPaginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?= $paginaActual + 1 ?>">Siguiente</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <button class="add-user-btn"><a href="agregarUsuarios.php">Agregar usuario</a></button>
    </div>
</body>

</html>
