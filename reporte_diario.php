<?php
require_once 'config/db.php';

$sql = "SELECT * FROM pedidos 
        WHERE DATE(fecha_pedido) = CURDATE() 
        ORDER BY fecha_pedido DESC";
$pedidos = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Diario</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>📅 Pedidos del Día</h1>
        <a href="reportes.php" class="btn-nav">← Volver a Reportes</a>
    </header>

    <main>
        <?php if (empty($pedidos)): ?>
            <p class="sin-datos">No hay pedidos registrados hoy.</p>
        <?php else: ?>
            <table class="tabla-reporte">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['cliente_nombre']) ?></td>
                        <td><?= htmlspecialchars($p['producto']) ?></td>
                        <td><?= $p['cantidad'] ?></td>
                        <td>$<?= number_format($p['total'], 2) ?></td>
                        <td><span class="badge <?= $p['estado'] ?>">
                            <?= $p['estado'] ?>
                        </span></td>
                        <td><?= date('H:i', strtotime($p['fecha_pedido'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>