<?php
require_once "../inc/auth.php";
require_once "../config/app.php"; // Archivo de configuración de base de datos
require_once "../controladores/usuariocontrolador.php";

verificarAcceso(['S']);

$controlador = new UsuarioModelo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['borrar'])) {
        $controlador->borrarPlanes($_POST['id']);
    }
    if (isset($_POST['editar'])) {
        header("Location: actualizarPlanes.php?id=" . $_POST['id']);
    }
}

// Capturar parámetros de búsqueda y paginación
$busqueda = $_GET['search'] ?? null;
$pagina = $_GET['pagina'] ?? 1;

// Llamar al método para obtener los planes
$planesPaginados = $controlador->obtenerBusquedaPlanes($pagina, 4, $busqueda);

$planes = $planesPaginados['registros'];
$paginaActual = $planesPaginados['paginaActual'];
$totalPaginas = $planesPaginados['totalPaginas'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="dashboard">
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

        <h2>Dashboard</h2>

        <!-- Barra de búsqueda -->
        <form method="GET" action="" class="barra-busqueda">
            <input type="text" name="search" id="search" placeholder="Buscar por nombre, categoría o precio..."
                value="<?php echo htmlspecialchars($busqueda); ?>">
            <button type="submit">Buscar</button>
        </form>

        <table class="controlu">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoria</th>
                    <th>Opciones</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($planes)): ?>
                    <?php foreach ($planes as $plan): ?>
                        <tr>
                            <td><?= htmlspecialchars($plan['id_Plan']) ?></td>
                            <td><?= htmlspecialchars($plan['nombre']) ?></td>
                            <td><?= htmlspecialchars($plan['descripcion']) ?></td>
                            <td><?= htmlspecialchars($plan['categoria']) ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $plan['id_Plan'] ?>">
                                    <button type="submit" name="editar">Editar</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $plan['id_Plan'] ?>">
                                    <button type="submit" name="borrar" onclick="return confirm('¿Está seguro de borrar este plan?')">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No se encontraron planes con los criterios seleccionados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="pagination">
            <?php if ($totalPaginas > 1): ?>
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a href="?pagina=<?php echo $i; ?>&search=<?php echo urlencode($busqueda); ?>"
                        style="margin: 0 5px; <?php echo $i == $paginaActual ? 'font-weight: bold;' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            <?php endif; ?>
        </div>

        <!-- Botón de agregar plan -->
        <button class="agregar-cupon-btn"><a href="agregarPlanes.php">Agregar Plan</a></button>

    </div>
</body>

</html>
