<?php
require_once "../inc/auth.php";
require_once "../config/app.php";
// Solo los administradores (S) pueden acceder
verificarAcceso(['C']);

// Asegurarse de que el usuario está logueado
if (!isset($_SESSION['id_Usuario'])) {
    header("Location: ../indexx.php");
    exit;
}

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Eliminar un plan del carrito
if (isset($_POST['eliminar'])) {
    $id_plan = $_POST['eliminar'];
    if (($key = array_search($id_plan, $_SESSION['carrito'])) !== false) {
        unset($_SESSION['carrito'][$key]);
    }
}

// Obtener detalles de los planes seleccionados
$planesSeleccionados = [];
if (!empty($_SESSION['carrito'])) {
    $ids = implode(',', array_map('intval', $_SESSION['carrito']));
    $sql = "SELECT * FROM planes WHERE id_Plan IN ($ids)";
    $resultado = $mysqli->query($sql);
    $planesSeleccionados = $resultado->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compras</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="carrito">
        <nav>
            <ul>
                <li><a href="menuUsuarioVerificado.php">Mis Planes</a></li>
                <li><a href="perfilCliente.php">Perfil</a></li>
                <li><a href="planesClientes.php">Catálogo</a></li>
                <li><a href="carritoCompras.php">Carrito de compras</a></li>
                <li>
                    <form action="../controladores/logout.php" method="post">
                        <input type="submit" value="Cerrar sesión" class="btn">
                    </form>
                </li>
            </ul>
        </nav>
        <br><br>
        <h1 class="carri">Carrito de compras</h1>
        <!-- Left Section: Product Details -->
        <div class="plancp">
            <?php if (!empty($planesSeleccionados)): ?>
                <table border="1" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre del Plan</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($planesSeleccionados as $plan): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($plan['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($plan['descripcion']); ?></td>
                                <td>$<?php echo htmlspecialchars($plan['precio']); ?></td>
                                <td>
                                    <form method="POST">
                                        <button type="submit" name="eliminar" value="<?php echo $plan['id_Plan']; ?>">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form action="procesar_pago.php" method="POST">
                    <button type="submit">Pagar</button>
                </form>
            <?php else: ?>
                <p>Tu carrito está vacío.</p>
                <a href="planesClientes.php" class="elegir">Ir a elegir planes</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
