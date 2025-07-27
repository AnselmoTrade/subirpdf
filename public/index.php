<?php
require '../includes/conexion.php';
$recursos = $conn->query("SELECT * FROM recursos ORDER BY fecha_subida DESC")->fetchAll();
?>

<h2>Recursos disponibles</h2>
<ul>
<?php foreach ($recursos as $r): ?>
    <li>
        <h3><?= htmlspecialchars($r['titulo']) ?></h3>
        <p><?= htmlspecialchars($r['descripcion']) ?></p>
        <small><?= date('d/m/Y H:i', strtotime($r['fecha_subida'])) ?></small><br>
        <a href="../uploads/<?= htmlspecialchars($r['archivo']) ?>" target="_blank">Ver PDF</a>
    </li>
<?php endforeach; ?>
</ul>
