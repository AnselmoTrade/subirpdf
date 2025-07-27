<?php
require '../includes/auth.php';
requiereLogin();
require '../includes/conexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $archivo = $_FILES['archivo'];

    if ($archivo['type'] === 'application/pdf') {
        $nombreArchivo = uniqid() . '.pdf';
        $ruta = "../uploads/" . $nombreArchivo;

        if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
            $stmt = $conn->prepare("INSERT INTO recursos (titulo, descripcion, archivo) VALUES (?, ?, ?)");
            $stmt->execute([$titulo, $descripcion, $nombreArchivo]);
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Error al subir el archivo.";
        }
    } else {
        $error = "Solo se permiten archivos PDF.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir PDF</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Subir nuevo recurso PDF</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="titulo" placeholder="Título" required><br>
        <textarea name="descripcion" placeholder="Descripción" required></textarea><br>
        <input type="file" name="archivo" accept="application/pdf" required><br>
        <button type="submit">Subir</button>
    </form>
    <a href="dashboard.php">← Volver al panel</a>
</body>
</html>
