<?php
require '../includes/auth.php';
requiereLogin();

require '../includes/conexion.php';
$recursos = $conn->query("SELECT * FROM recursos ORDER BY fecha_subida DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Administrador</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Bienvenido, <?= $_SESSION['admin'] ?> | <a href="logout.php">Cerrar sesión</a></h2>
    <a href="subir.php">+ Subir nuevo PDF</a>

    <h3>Lista de recursos</h3>
    <table border="1" cellpadding="6">
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Archivo</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($recursos as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['titulo']) ?></td>
            <td><?= htmlspecialchars($r['descripcion']) ?></td>
            <td><a href="../uploads/<?= htmlspecialchars($r['archivo']) ?>" target="_blank">Ver PDF</a></td>
            <td><?= date('d/m/Y H:i', strtotime($r['fecha_subida'])) ?></td>
            <td>
                <a href="editar.php?id=<?= $r['id'] ?>">Editar</a> |
                <a href="eliminar.php?id=<?= $r['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este recurso?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
