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
  <title>Agregar Usuarios</title>
  <link href="style.css" rel="stylesheet" />
</head>

<body>
  <div class="registro">
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
    <br><br>
    <h1>Agregar Usuario</h1>
    <form class="formularioAjax" autocomplete="off" method="POST" data-form="save">
      <div class="form-group">
        <div class="input-container">
          <h4>Nombre</h4>
          <input type="text" name="nombre" placeholder="Nombre" id="nombre" required>
        </div>
        <div class="input-container">
          <h4>Apellidos</h4>
          <input type="text" name="apellidos" placeholder="Apellidos" id="apellidos" required>
        </div>
      </div>

      <div class="form-group">
        <div class="input-container">
          <h4>Contraseña</h4>
          <input type="password" name="password" placeholder="Contraseña" id="password" required>
        </div>
        <div class="input-container">
          <h4>Correo Electrónico</h4>
          <input type="email" name="email" placeholder="Correo Electrónico" id="email" required>
        </div>
      </div>

      <div class="form-group">
        <div class="input-container">
          <h4>Teléfono</h4>
          <input type="text" name="telefono" placeholder="Teléfono" id="telefono" required>
        </div>
        <div class="input-container">
          <h4>Tipo de usuario</h4>
          <input type="text" name="tipo" placeholder="Tipo de usuario" id="tipo" required>
        </div>
      </div>

      <div class="input-container">
        <h4>Clave Asociado</h4>
        <input type="text" name="clave_asociado" placeholder="Clave Asociado" id="clave_asociado">
      </div>

      <button type="submit">Agregar</button>
    </form>
  </div>
</body>

</html>


<?php
require "../controladores/usuariocontrolador.php";
require_once "../config/app.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $password = sha1($_POST['password']);
  $tipo = ($_POST['tipo']);
  // Encriptar contraseña
  $clave_asociado = $_POST['clave_asociado'];

  // Generar valores por defecto
  $estatus = "1";
  $codigo = NULL;
  $vigencia_Codigo = NULL;

  $usuarioModelo = new UsuarioModelo();
  $resultado = $usuarioModelo->registrarUsuario($nombre, $apellidos, $email, $telefono, $password, $estatus, $codigo, $vigencia_Codigo, $tipo, $clave_asociado);
  if ($resultado) {
    echo "Registro exitoso.";
  } else {
    echo "Error al registrar el usuario.";
  }
}
?>