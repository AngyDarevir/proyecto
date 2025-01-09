<?php
session_start();

if (!isset($_SESSION['id_Usuario']) || !isset($_SESSION['tipo'])) {
    header("Location: ../indexx.php");
    exit;
}

// Permitir acceso solo a usuarios específicos según el tipo
function verificarAcceso($tiposPermitidos) {
    if (!in_array($_SESSION['tipo'], $tiposPermitidos)) {
        echo "No tienes permiso para acceder a esta página.";
        exit;
    }
}

// Función para obtener el ID de usuario de la sesión
function obtenerIdSesion() {
    if (isset($_SESSION['id_Usuario'])) {
        return $_SESSION['id_Usuario'];
    } else {
        return null; // Si no hay sesión iniciada, retorna null
    }
}

?>
