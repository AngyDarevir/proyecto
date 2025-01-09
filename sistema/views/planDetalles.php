<?php
require_once "../inc/auth.php";
require_once "../controladores/usuariocontrolador.php";
verificarAcceso(['C']);

$id = $_GET['id'];
$controlador = new UsuarioModelo();
$plan = $controlador->obtenerPlanes()[array_search($id, array_column($controlador->obtenerPlanes(), 'id_Plan'))];

require_once "../config/app.php";

// Asegurarse de que el usuario está logueado
if (!isset($_SESSION['id_Usuario'])) {
  header("Location: ../indexx.php");
  exit;
}

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
  $_SESSION['carrito'] = [];
}

// Agregar plan al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Plan'])) {
  $id_Plan = $_POST['id_Plan'];
  header("Location: planDetalles.php?id=" . $_POST['id_Plan']);
  // Evitar duplicados en el carrito
  if (!in_array($id_Plan, $_SESSION['carrito'])) {
    $_SESSION['carrito'][] = $id_Plan;
  }
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles de planes</title>
  <link href="style.css" rel="stylesheet" />
</head>

<body>
  <div class="planesd">
    <nav>
      <ul>
        <li><a href="menuUsuarioVerificado.php">Mis Planes</a></li>
        <li><a href="perfilCliente.php">Perfil</a></li>
        <li><a href="planesClientes.php">Catalogo</a></li>
        <li><a href="carritoCompras.php">Carrito de compras</a></li>
        <li>
          <form action="../controladores/logout.php" method="post">
            <input type="submit" value="Cerrar sesión" class="btn">
        </li>
        </form>
    </nav>
    <!-- Left Section: Plan Details -->
    <div class="planesc">
      <div class="planes-container">
        <p><strong>Nombre del plan:</strong> <?= htmlspecialchars($plan['nombre']) ?></p>

        <div class="plan-info">
          <div class="info-item">
            <h4 class="dat">Precio</h4>
            <p> <?= htmlspecialchars($plan['precio']) ?></p>
          </div>
          <div class="info-item">
            <h4 class="dat">IVA</h4>
            <p> <?= htmlspecialchars($plan['impuestos']) ?></p>
          </div>

          <div class="info-item">
            <h4 class="dat">Duración del plan en días</h4>
            <p> <?= htmlspecialchars($plan['vigencia']) ?></p>
          </div>
          <div class="info-item">
            <h4 class="dat">Descripción</h4>
            <p> <?= htmlspecialchars($plan['descripcion']) ?></p>
          </div>
        </div>

        <form method="POST">
          <input type="hidden" name="id_Plan" value="<?php echo $plan['id_Plan']; ?>">
          <button type="submit" class="add-cart-btn">Agregar al Carrito</button>
        </form>
      </div>

      <!-- Right Section: Form and Calculations -->
      <div class="mita2">
        <h3>Subtotal $$</h3>
        <h3>IVA $$</h3>
        <h3>Total $$</h3>
      </div>
    </div>
</body>

</html>
