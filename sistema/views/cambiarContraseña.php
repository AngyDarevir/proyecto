<?php
require_once "../inc/auth.php";
// Solo los administradores (S) pueden acceder
verificarAcceso(['C']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet" />
    <title>Cambiar Contraseña</title>
</head>
<body>
<div class="contra">
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
        <br></br>
        <h1>Cambiar contraseña</h1>
        <form action="conexionDB.php" method="post">
            <label for="codigo">
                <i class="fas fa-cod"></i>
            </label>
            <h4>Codigo de seguridad</h4>
            <input type="text" name="codig"
                placeholder="Código de seguridad" id="codi" required>
            <button class="p"> Pedir un nuevo codigo </button>
            <br><br>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <h4>Nueva contraseña</h4>
            <input type="password" name="new password"
                placeholder="Nueva contraseña" id="npassword" required>
            <br><br>
            <label for="password">
                <i class="fas fa-elock"></i>
            </label>
            <h4><a class="ver">Verificar contraseña</a></h4>
            <input type="password" class="ver"
                placeholder="Verificar contraseña" id="vpassword" required>
            <br><br>
            <button class="act"> Actualizar Contraseña </button>
        </form>
    </div>
    </body>
</html>