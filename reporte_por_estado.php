<?php
require_once 'config/db.php';

$estado = $_GET['estado'] ?? 'pendiente';
$estadosValidos = ['pendiente', 'en_proceso', 'completado', 'cancelado'];

if (!in_array($estado, $estadosValidos)) {
    $estado = 'pendiente';
}

$sql = "SELECT * FROM pedidos WHERE estado = ? ORDER BY fecha_pedido DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$estado]);
$pedidos = $stmt->fetchAll();

$titulos = [
    'pendiente' => '⏳ Pedidos Pendientes',
    'en_proceso' => '🔄 Pedidos en Proceso',
    'completado' => '✅ Pedidos Completados',
    'cancelado' => '❌ Pedidos Cancelados'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte por Estado</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1><?= $titulos[$estado] ?></h1>
        <a href="reportes.php" class="btn-nav">← Volver a Reportes</a>
    </header>

    <main>
        <p class="total-registros">
            Total: <strong><?= count($pedidos) ?></strong> pedidos
        </p>
        
        <?php if (empty($pedidos)): ?>
            <p class="sin-datos">No hay pedidos con este estado.</p>
        <?php else: ?>
            <table class="tabla-reporte">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Total</th>
                        <th>Fecha</th>
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
                        <td><?= date('d/m/Y H:i', strtotime($p['fecha_pedido'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>