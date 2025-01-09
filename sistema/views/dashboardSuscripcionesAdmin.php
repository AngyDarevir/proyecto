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
  <title>Dashboard de Suscripciones de Administrador</title>
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

    <h2>Dashboard de Suscripciones</h2>

    <!-- Tabla -->
    <table class="controlu">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Detalles</th>
          <th>Vigencia</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Plan Básico</td>
          <td>Acceso básico a los servicios</td>
          <td><button>Ver Detalles</button></td>
          <td>2025-12-31</td>
          <td><button>Editar</button> <button>Borrar</button></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Plan Premium</td>
          <td>Acceso completo a los servicios</td>
          <td><button>Ver Detalles</button></td>
          <td>2025-12-31</td>
          <td><button>Editar</button> <button>Borrar</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Botón Agregar plan -->
    <button class="agregar-plan-btn"><a href="agregarPlanes.php">Agregar plan</a></button>
  </div>
</body>

</html>
