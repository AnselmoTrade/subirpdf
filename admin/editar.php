<?php
require '../includes/auth.php';
requiereLogin();
require '../includes/conexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: dashboard.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM recursos WHERE id = ?");
$stmt->execute([$id]);
$recurso = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recurso) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("UPDATE recursos SET titulo = ?, descripcion = ? WHERE id = ?");
    $stmt->execute([$titulo, $descripcion, $id]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar recurso</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Editar recurso</h2>
    <form method="POST">
        <input type="text" name="titulo" value="<?= htmlspecialchars($recurso['titulo']) ?>" required><br>
        <textarea name="descripcion" required><?= htmlspecialchars($recurso['descripcion']) ?></textarea><br>
        <button type="submit">Guardar cambios</button>
    </form>
    <a href="dashboard.php">← Volver al panel</a>
</body>
</html>
