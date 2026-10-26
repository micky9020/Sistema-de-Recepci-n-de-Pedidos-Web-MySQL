<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['cliente_nombre']);
    $telefono = trim($_POST['cliente_telefono']);
    $producto = trim($_POST['producto']);
    $cantidad = (int)$_POST['cantidad'];
    $precio = (float)$_POST['precio_unitario'];
    $notas = trim($_POST['notas']);
    
    $total = $cantidad * $precio;

    $sql = "INSERT INTO pedidos 
            (cliente_nombre, cliente_telefono, producto, cantidad, 
             precio_unitario, total, notas) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $telefono, $producto, $cantidad, 
                    $precio, $total, $notas]);

    header('Location: index.php?exito=1');
    exit;
}
?>