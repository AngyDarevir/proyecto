<?php
require_once "../inc/auth.php";
// Solo los administradores (S) pueden acceder
verificarAcceso(['A']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asignación de Suscripciones</title>
  <link href="style.css" rel="stylesheet" />
</head>

<body>
  <div class="dashboard">
    <nav>
      <ul>
        <li><a href="dashAsociado.php">Mis clientes</a></li>
        <li><a href="AsignacionSuscripcionAsociado.php">Asignación de Suscripciones</a></li>
        <li><a href="perfilAsociado.php">Perfil de Asociado</a></li>
        <li><a href="pedidoAsociado.php">Mis pedidos</a></li>
        <li><a href="AdministracionPagosAsociado.php">Administración de pagos</a></li>
        <li>
          <form action="../controladores/logout.php" method="post">
            <input type="submit" value="Cerrar sesión" class="btn">
          </form>
        </li>
      </ul>
    </nav>
    <br></br>
  </div>
</body>

</html>
