<?php
require_once "./config/app.php";
require_once "./controladores/usuariocontrolador.php";

$controlador = new UsuarioModelo();

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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Planes</title>
    <link href="index.css" rel="stylesheet" />
</head>

<body class="bg-primary">

    <nav>
        <ul>
            <li>
                <form action="login.php" method="post">
                    <input type="submit" value="Iniciar sesión">
                </form>
            </li>
            <li>
                <form action="registro.php" method="post">
                    <input type="submit" value="Registrarse">
                </form>
            </li>
        </ul>
    </nav>

    <div class="planes">

        <h1>Planes</h1>

        <!-- Barra de búsqueda -->
        <form method="GET" action="">
            <label for="search">Buscar planes:</label>
            <input type="text" name="search" id="search" placeholder="Buscar por nombre, categoría o precio..."
                value="<?php echo htmlspecialchars($busqueda); ?>">
            <button type="submit">Buscar</button>
        </form>

        <br>

        <!-- Contenedor de tarjetas -->
        <div class="planes-container">
            <?php if (!empty($planes)): ?>
                <?php foreach ($planes as $plan): ?>
                    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
                        <h2><?php echo htmlspecialchars($plan['nombre']); ?></h2>
                        <p>Categoría: <?php echo htmlspecialchars($plan['categoria']); ?></p>
                        <p>Descripción: <?php echo htmlspecialchars($plan['descripcion']); ?></p>
                        <p>Precio: $<?php echo htmlspecialchars($plan['precio']); ?></p>
                       <?php echo "</ul>";
                echo "<form action='login.php' method='post'><input type='submit' value='Suscribirse'></form>";
                echo "</div>";?>
                    </div> 
                    
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron planes con los criterios seleccionados.</p>
            <?php endif; ?>
        </div>

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
    </div>
</body>

</html>