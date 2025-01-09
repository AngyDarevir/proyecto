
<?php
require_once './config/app.php'; 
require_once './controladores/usuariocontrolador.php'; 

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $codigoIngresado = $_POST['codigo'] ?? '';

    // Crear instancia del controlador
    $controlador = new UsuarioModelo();

    if (!empty($email) && empty($codigoIngresado)) {
        // Paso 1: Validar si el correo existe
        if ($controlador->verificarCorreo($email)) {
            // Generar código aleatorio
            $codigo = rand(100000, 999999);

            // Guardar el código en la base de datos (o sesión)
            $controlador->guardarCodigoRecuperacion($email, $codigo);

            // Enviar el código al correo
            $asunto = "Código de Recuperación de Contraseña";
            $mensaje = "Tu código de recuperación es: $codigo";
            $headers = "From: soporte@tusitio.com";

            if (mail($email, $asunto, $mensaje, $headers)) {
                echo "<p>Se envió un código de recuperación a tu correo.</p>";
            } else {
                echo "<p>Error al enviar el correo. Inténtalo de nuevo.</p>";
            }
        } else {
            echo "<p>El correo ingresado no está registrado.</p>";
        }
    } elseif (!empty($codigoIngresado)) {
        // Paso 2: Validar el código ingresado
        if ($controlador->verificarCodigoRecuperacion($email, $codigoIngresado)) {
            echo "<p>Código correcto. Ahora puedes restablecer tu contraseña.</p>";
            // Redirigir a una página para restablecer la contraseña
            header("Location: restablecer_contrasena.php?email=$email");
            exit;
        } else {
            echo "<p>El código ingresado es incorrecto.</p>";
        }
    } else {
        echo "<p>Por favor, completa todos los campos.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet" />
    <title>Recuperar Contraseña</title>
</head>

<body>
    <div class="recuperar">
        <h1>Recuperar contraseña</h1>
        <form action="" method="post">
            <div>
                <label for="email">
                    <i class="fas fa-email"></i>
                </label>
                <h4>Correo Electrónico</h4>
                <input type="text" name="email" placeholder="Correo electrónico" id="email" required>
            </div>

            <div>
                <label for="codigo">
                    <i class="fas fa-lock"></i>
                </label>
                <h4>Código</h4>
                <input type="text" name="codigo" placeholder="Código" id="codigo" required>
            </div>

            <input type="submit" value="Ingresar">
            <!-- Link "Volver a inicio de sesión" -->
            <a href="login.php">Regresar al inicio de sesión</a>
        </form>


    </div>
</body>

</html>