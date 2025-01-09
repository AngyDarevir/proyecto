<?php
require_once "../inc/auth.php";
require_once "../controladores/usuariocontrolador.php";
verificarAcceso(['S']);
// Obtener el ID del usuario de la sesión
$idUsuario = obtenerIdSesion();
if ($idUsuario !== null) {
  echo "El ID de la sesión es: " . $idUsuario;
} else {
  echo "No hay sesión activa.";
  exit;
}

$id = $idUsuario;
$controlador = new UsuarioModelo();
$usuario = $controlador->obtenerUsuarios()[array_search($id, array_column($controlador->obtenerUsuarios(), 'id_Usuario'))];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $datos = [
    'nombre' => $_POST['nombre'],
    'apellidos' => $_POST['apellidos'],
    'telefono' => $_POST['telefono'],
    'email' => $_POST['email'],
    'clave_Asociado' => $_POST['clave_Asociado'],
    'tipo' => $_POST['tipo'],
    'password' => sha1($_POST['password'])
  ];
  $controlador->actualizarUsuario($id, $datos);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet" />
  <title>Perfil del Administrador</title>
</head>

<body>
  <div class="perfilc">
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
        </li>
        </form>
      </ul>
    </nav>
    
    <h1>Perfil de Administrador</h1>
    
    <form action="" method="POST" class="actus">
      <div class="actuusa">
        <div class="input-group">
          <h4>Nombre</h4>
          <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </div>
        <div class="input-group">
          <h4>Apellidos</h4>
          <input type="text" name="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>" id="apellidos" required>
        </div>
      </div>

      <div class="actuusa">
        <div class="input-group">
          <h4>Contraseña</h4>
          <input type="password" id="password" name="password" value="<?= htmlspecialchars($usuario['password']) ?>" required>
        </div>
        <div class="input-group">
          <h4>Correo Electrónico</h4>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>
      </div>

      <div class="inline-group">
        <div class="input-group">
          <h4>Teléfono</h4>
          <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" required>
        </div>
        <div class="input-group">
          <h4>Tipo de Usuario</h4>
          <input type="text" name="tipo" value="<?= htmlspecialchars($usuario['tipo']) ?>" id="tipo" required>
        </div>
      </div>

      <div class="full-width">
        <div class="input-group">
          <h4>Clave de Asociado</h4>
          <input type="text" name="clave_Asociado" value="<?= htmlspecialchars($usuario['clave_Asociado']) ?>" id="clave_Asociado">
        </div>
      </div>

      <div class="button-group">
        <button type="submit">Guardar Cambios</button>
        <a href="usuariosAdmin.php">Cancelar</a>
      </div>
    </form>
  </div>
</body>

</html>
