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
    <title>Cupones</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
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

    <h2>Cupones</h2>

    <div class="barrabusqueda">
        <form class="formulariodebarra" action="#" method="POST">
            <div class="inputdebarra">
                <input class="" type="search" placeholder="Buscar cupones...">
            </div>
            <div>
                <input class="botonclick" type="submit" value="Buscar" />
            </div>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descuento</th>
                <th>Descripcion</th>
                <th>Total de usos</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2%</td>
                <td>Descuento de verano</td>
                <td>100</td>
                <td><button>Editar</button></td>
                <td><button>Borrar</button></td>
            </tr>
            <!-- Agrega más filas aquí -->
        </tbody>
    </table>

    <div class="add-button">
        <a href="actualizarCupones.php"><button>Agregar Cupón</button></a>
    </div>

</body>

</html>
