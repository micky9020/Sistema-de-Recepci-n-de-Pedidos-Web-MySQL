<?php
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepción de Pedidos</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>📦 Sistema de Recepción de Pedidos</h1>
        <nav>
            <a href="index.php" class="btn-nav">📝 Nuevo Pedido</a>
            <a href="reportes.php" class="btn-nav">📊 Reportes</a>
        </nav>
    </header>

    <main>
        <section class="form-container">
            <h2>Registrar Nuevo Pedido</h2>
            
            <?php if (isset($_GET['exito'])): ?>
                <div class="alerta exito">✅ Pedido guardado correctamente</div>
            <?php endif; ?>
            
            <form action="guardar_pedido.php" method="POST">
                <div class="campo">
                    <label for="cliente_nombre">Nombre del Cliente *</label>
                    <input type="text" id="cliente_nombre" name="cliente_nombre" required>
                </div>

                <div class="campo">
                    <label for="cliente_telefono">Teléfono</label>
                    <input type="tel" id="cliente_telefono" name="cliente_telefono">
                </div>

                <div class="campo">
                    <label for="producto">Producto *</label>
                    <input type="text" id="producto" name="producto" required>
                </div>

                <div class="fila">
                    <div class="campo">
                        <label for="cantidad">Cantidad *</label>
                        <input type="number" id="cantidad" name="cantidad" 
                               min="1" value="1" required>
                    </div>
                    <div class="campo">
                        <label for="precio_unitario">Precio Unitario *</label>
                        <input type="number" id="precio_unitario" 
                               name="precio_unitario" step="0.01" min="0" required>
                    </div>
                </div>

                <div class="campo">
                    <label for="notas">Notas adicionales</label>
                    <textarea id="notas" name="notas" rows="3"></textarea>
                </div>

                <!-- BOTÓN DE INGRESO DE INFORMACIÓN -->
                <button type="submit" class="btn-primario">
                    💾 Guardar Pedido
                </button>
            </form>
        </section>
    </main>
</body>
</html>