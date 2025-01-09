<!-- Segunda hoja (Login) -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="index.css" rel="stylesheet" />
  <title>Inicia Sesion</title>
</head>

<body>
  <div class="login">
    <h1>Inicio de sesion</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Usuario</label><input class="form-control py-4" id="email" name="email" type="text" placeholder="Enter email address" /></div>
      <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="password" name="password" type="password" placeholder="Enter password" /></div>

      <!-- Botones en línea -->
      <div class="buttons-container">
        <button type="submit" class="btn btn-primary">Login</button>
        <?php require_once "./controladores/login.php"; ?>
        <button type="button" class="btn btn-secondary"><a href="registro.php" style="color: white; text-decoration: none;">Registrarse</a></button>
      </div>
      <a href="recuperarContraseña.php">¿Olvidaste la contraseña?</a>
  </div>
  </form>
  </div>
</body>

</html>