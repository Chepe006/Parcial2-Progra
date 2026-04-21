CREATE DATABASE IF NOT EXISTS vidrid_db;
USE vidrid_db;

DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL DEFAULT 'admin'
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    estado VARCHAR(20) NOT NULL,
    descripcion VARCHAR(255) NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NULL,
    CONSTRAINT fk_producto_usuario
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

INSERT INTO usuarios (nombre, correo, clave, rol) VALUES
('Administrador VIDRID', 'admin@vidrid.com', 'admin123', 'admin');

INSERT INTO productos (nombre, categoria, precio, stock, estado, descripcion, id_usuario) VALUES
('Cemento Holcim 42.5 kg', 'Cemento', 9.50, 40, 'Disponible', 'Saco de cemento para construcción general', 1),
('Martillo Stanley 16 oz', 'Herramientas', 12.75, 18, 'Disponible', 'Martillo de acero con mango ergonómico', 1),
('Pintura Azul Corona 1 galón', 'Pinturas', 18.25, 12, 'Disponible', 'Pintura para interiores y exteriores', 1),
('Tubo PVC 1/2 pulgada', 'Tuberías', 3.40, 55, 'Disponible', NULL, 1),
('Caja de tornillos 2 pulgadas', 'Tornillería', 6.80, 30, 'Agotado', 'Caja con 100 unidades galvanizadas', 1);