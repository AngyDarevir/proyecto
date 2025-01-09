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
    <title>Menu</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="meus">
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
        <table class="misplanes">
            <h2>Mis planes</h2>
            <tr>
                <th>Nombre</th>
                <th>Numero de serie</th>
                <th>Fecha de inicio</th>
                <th>Fecha de corte</th>
                <th>Estatus</th>
                <th>Opciones</th>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>Pendiente</td>
                <td>.</td>
            </tr>
        </table>
    </div>
</body>

</html>