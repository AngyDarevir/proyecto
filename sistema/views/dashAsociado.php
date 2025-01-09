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
  <title>Dashboard de Asociado</title>
  <link href="style.css" rel="stylesheet" />
</head>

<body>
  <div class="dashboard">
    <nav>
      <ul>
        <li><a href="dashAsociado.php">Mis clientes</a></li>
        <li><a href="AsignacionSuscripcionAsociado.php">Asignacion de Suscripciones</a></li>
        <li><a href="perfilAsociado.php">Perfil de Asociado</a></li>
        <li><a href="pedidoAsociado.php">Mis pedidos</a></l>
        <li><a href="AdministracionPagosAsociado.php">Administracion de pagos</a></li>
        <li>
          <form action="../controladores/logout.php" method="post">
            <input type="submit" value="Cerrar sesión" class="btn">
        </li>
        </form>
    </nav>
    <br></br>
    <table class="controlu">
      <h2>Dashboard</h2>
      <button>Actualizar</button>

</body>

</html>