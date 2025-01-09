<!-- Última hoja (Registro) -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link href="index.css" rel="stylesheet" />
</head>

<body>
  <div class="registro">
    <h1>Registro</h1>
    <form class="formularioAjax" autocomplete="off" method="POST" data-form="save">
      <div class="inline-group">
        <div>
          <h4>Nombre</h4>
          <input type="text" name="nombre" placeholder="Nombre" id="nombre" required>
        </div>
        <div>
          <h4>Apellidos</h4>
          <input type="text" name="apellidos" placeholder="Apellidos" id="apellidos" required>
        </div>
      </div>

      <div class="inline-group">
        <div>
          <h4>Correo Electrónico</h4>
          <input type="email" name="email" placeholder="Correo Electrónico" id="email" required>
        </div>
        <div>
          <h4>Teléfono</h4>
          <input type="text" name="telefono" placeholder="Teléfono" id="telefono" required>
        </div>
      </div>

      <div class="inline-group">
        <div>
          <h4>Contraseña</h4>
          <input type="password" name="password" placeholder="Contraseña" id="password" required>
        </div>
        <div>
          <h4>Confirmar Contraseña</h4>
          <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" id="confirm_password" required>
        </div>
      </div>

      <div class="inline-group">
        <div>
          <h4>¿Cuenta con una clave de asociado?</h4>
          <select name="mcodigodi" id="opciones">
            <option>Si</option>
            <option>No</option>
          </select>
        </div>
        <div>
          <h4>Clave Asociado</h4>
          <input type="text" name="clave_asociado" placeholder="Clave Asociado" id="clave_asociado">
        </div>
      </div>

      <button type="submit">Registrar</button>
      <a href="login.php">Volver al inicio de sesión</a>
    </form>


  </div>
</body>

</html>

<?php
require "./controladores/usuariocontrolador.php";
require_once "./config/app.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $password = sha1($_POST['password']);
  // Encriptar contraseña
  $clave_asociado = $_POST['clave_asociado'];

  // Generar valores por defecto
  $estatus = "1";
  $codigo = NULL;
  $vigencia_Codigo = NULL;
  $tipo = "C";

  $usuarioModelo = new UsuarioModelo();
  $resultado = $usuarioModelo->registrarUsuario($nombre, $apellidos, $email, $telefono, $password, $estatus, $codigo, $vigencia_Codigo, $tipo, $clave_asociado);
  if ($resultado) {
    echo "Registro exitoso.";
  } else {
    echo "Error al registrar el usuario.";
  }
}
?>