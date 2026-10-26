<?php
require_once 'config/db.php';

// Estadísticas generales
$totalPedidos = $pdo->query("SELECT COUNT(*) as total FROM pedidos")
                    ->fetch()['total'];
$totalHoy = $pdo->query("SELECT COUNT(*) as total FROM pedidos 
                         WHERE DATE(fecha_pedido) = CURDATE()")
                ->fetch()['total'];
$montoTotal = $pdo->query("SELECT COALESCE(SUM(total), 0) as monto 
                           FROM pedidos WHERE estado != 'cancelado'")
                  ->fetch()['monto'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes - Recepción de Pedidos</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>📊 Panel de Reportes</h1>
        <nav>
            <a href="index.php" class="btn-nav">📝 Nuevo Pedido</a>
            <a href="reportes.php" class="btn-nav">📊 Reportes</a>
        </nav>
    </header>

    <main>
        <section class="stats-grid">
            <div class="stat-card">
                <span class="stat-numero"><?= $totalPedidos ?></span>
                <span class="stat-label">Total Pedidos</span>
            </div>
            <div class="stat-card">
                <span class="stat-numero"><?= $totalHoy ?></span>
                <span class="stat-label">Pedidos Hoy</span>
            </div>
            <div class="stat-card">
                <span class="stat-numero">$<?= number_format($montoTotal, 2) ?></span>
                <span class="stat-label">Ingresos Totales</span>
            </div>
        </section>

        <section class="reportes-botones">
            <h2>Generar Reportes</h2>
            
            <!-- BOTONES PARA REPORTES -->
            <a href="reporte_diario.php" class="btn-reporte">
                📅 Reporte de Pedidos del Día
            </a>
            
            <a href="reporte_por_estado.php?estado=pendiente" 
               class="btn-reporte">
                ⏳ Pedidos Pendientes
            </a>
            
            <a href="reporte_por_estado.php?estado=completado" 
               class="btn-reporte">
                ✅ Pedidos Completados
            </a>
            
            <a href="reporte_por_estado.php?estado=en_proceso" 
               class="btn-reporte">
                🔄 Pedidos en Proceso
            </a>
        </section>
    </main>
</body>
</html>