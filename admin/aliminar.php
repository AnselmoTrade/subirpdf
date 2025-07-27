<?php
require '../includes/auth.php';
requiereLogin();
require '../includes/conexion.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Obtener el archivo antes de eliminarlo
    $stmt = $conn->prepare("SELECT archivo FROM recursos WHERE id = ?");
    $stmt->execute([$id]);
    $recurso = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recurso) {
        // Eliminar archivo del servidor
        $archivoPath = "../uploads/" . $recurso['archivo'];
        if (file_exists($archivoPath)) {
            unlink($archivoPath);
        }

        // Eliminar de la base de datos
        $stmt = $conn->prepare("DELETE FROM recursos WHERE id = ?");
        $stmt->execute([$id]);
    }
}

header("Location: dashboard.php");
exit;
