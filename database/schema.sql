CREATE DATABASE IF NOT EXISTS recepcion_pedidos
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE recepcion_pedidos;

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nombre VARCHAR(150) NOT NULL,
    cliente_telefono VARCHAR(20),
    producto VARCHAR(200) NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    precio_unitario DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'en_proceso', 'completado', 'cancelado') 
           DEFAULT 'pendiente',
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notas TEXT
);

CREATE INDEX idx_fecha ON pedidos(fecha_pedido);
CREATE INDEX idx_estado ON pedidos(estado);