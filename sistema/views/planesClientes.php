<?php
require_once "../inc/auth.php";
require_once "../config/app.php";

verificarAcceso(['C']);

require_once "../controladores/usuariocontrolador.php";

$controlador = new UsuarioModelo();

// Obtiene los planes desde la base de datos
$planes = $controlador->obtenerPlanes();


// Obtener los planes desde la base de datos
$sql = "SELECT * FROM planes";
$resultado = $mysqli->query($sql);

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar plan al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Plan'])) {
    $id_Plan = $_POST['id_Plan'];
    header("Location: planDetalles.php?id=" . $_POST['id_Plan']);
    // Evitar duplicados en el carrito
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" />
    <title>Planes Clientes</title>
</head>

<body>
    <div class="planes">
        <nav>
            <ul>
                <li><a href="menuUsuarioVerificado.php">Mis Planes</a></li>
                <li><a href="perfilCliente.php">Perfil</a></li>
                <li><a href="planesClientes.php">Catalogo</a></li>
                <li><a href="carritoCompras.php">Carrito de compras</a></li>
                <form action="../controladores/logout.php" method="post">
                    <input type="submit" value="Cerrar sesión">
                </form>
            </ul>
        </nav>
        <br></br>
        <h1>Planes</h1>
       

        <!-- Contenedor de tarjetas -->
        <div class="planes-container">
            <?php while ($plan = $resultado->fetch_assoc()): ?>
                <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
                    <h2><?php echo htmlspecialchars($plan['nombre']); ?></h2>
                    <p>Descripción: <?php echo htmlspecialchars($plan['descripcion']); ?></p>
                    <p>Precio: $<?php echo htmlspecialchars($plan['precio']); ?></p>
                    <form method="POST">
                        <input type="hidden" name="id_Plan" value="<?php echo $plan['id_Plan']; ?>">
                        <button type="submit">Agregar al Carrito</button>
                    </form>
                </div>
            <?php endwhile; ?>

</html>