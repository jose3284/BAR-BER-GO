-- Crear la base de datos
CREATE SCHEMA IF NOT EXISTS `BAR-BER-GO` DEFAULT CHARACTER SET utf8 ;
USE `BAR-BER-GO` ;

-- Tabla Roles
CREATE TABLE IF NOT EXISTS `Roles` (
  `id_roles` INT NOT NULL AUTO_INCREMENT,
  `nombre_rol` VARCHAR(45) NOT NULL,  -- Nombre del rol
  PRIMARY KEY (`id_roles`)
) ENGINE=InnoDB;

-- Tabla Categoria
CREATE TABLE IF NOT EXISTS `Categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB;

-- Tabla Usuarios
CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `P_apellido` VARCHAR(45) NOT NULL,
  `S_apellido` VARCHAR(45) NOT NULL,
  `Numero` VARCHAR(12) NOT NULL,
  `Correo` VARCHAR(45) NOT NULL,
  `Roles_id` INT NOT NULL,  -- Nueva columna para los roles
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_Usuarios_Roles1_idx` (`Roles_id` ASC),  -- Nueva relación con Roles
  CONSTRAINT `fk_Usuarios_Roles1`
    FOREIGN KEY (`Roles_id`)
    REFERENCES `Roles` (`id_roles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabla Metodo_pago
CREATE TABLE IF NOT EXISTS `Metodo_pago` (
  `idMetodo_pago` INT NOT NULL AUTO_INCREMENT,
  `Metodo_pago` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idMetodo_pago`)
) ENGINE=InnoDB;

-- Tabla Producto
CREATE TABLE IF NOT EXISTS `Producto` (
  `idProducto` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Cantidad` INT NOT NULL,
  `Precio` INT NOT NULL,
  `Categoria_id` INT NOT NULL,
  PRIMARY KEY (`idProducto`),
  INDEX `fk_Producto_Categoria1_idx` (`Categoria_id` ASC),
  CONSTRAINT `fk_Producto_Categoria1`
    FOREIGN KEY (`Categoria_id`)
    REFERENCES `Categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabla Recibo
CREATE TABLE IF NOT EXISTS `Recibo` (
  `idRecibo` INT NOT NULL AUTO_INCREMENT,
  `Fecha` VARCHAR(45) NOT NULL,
  `Hora` VARCHAR(45) NOT NULL,
  `Total` INT NOT NULL,
  `Producto_idProducto` INT NOT NULL,
  `Metodo_pago_idMetodo_pago` INT NOT NULL,
  `Usuarios_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idRecibo`),
  INDEX `fk_Recibo_Producto_idx` (`Producto_idProducto` ASC),
  INDEX `fk_Recibo_Metodo_pago_idx` (`Metodo_pago_idMetodo_pago` ASC),
  INDEX `fk_Recibo_Usuario_idx` (`Usuarios_idUsuario` ASC),
  CONSTRAINT `fk_Recibo_Producto`
    FOREIGN KEY (`Producto_idProducto`)
    REFERENCES `Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_Metodo_pago`
    FOREIGN KEY (`Metodo_pago_idMetodo_pago`)
    REFERENCES `Metodo_pago` (`idMetodo_pago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_Usuario`
    FOREIGN KEY (`Usuarios_idUsuario`)
    REFERENCES `Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabla Transaccion
CREATE TABLE IF NOT EXISTS `Transaccion` (
  `Recibo_idRecibo` INT NOT NULL,
  `Producto_idProducto` INT NOT NULL,
  PRIMARY KEY (`Recibo_idRecibo`, `Producto_idProducto`),
  INDEX `fk_Recibo_has_Producto_Producto1_idx` (`Producto_idProducto` ASC),
  INDEX `fk_Recibo_has_Producto_Recibo1_idx` (`Recibo_idRecibo` ASC),
  CONSTRAINT `fk_Recibo_has_Producto_Recibo1`
    FOREIGN KEY (`Recibo_idRecibo`)
    REFERENCES `Recibo` (`idRecibo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_has_Producto_Producto1`
    FOREIGN KEY (`Producto_idProducto`)
    REFERENCES `Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabla Recibo_ingreso
CREATE TABLE IF NOT EXISTS `Recibo_ingreso` (
  `idRecibo_ingreso` INT NOT NULL AUTO_INCREMENT,
  `Hora` VARCHAR(45) NULL,
  `Total` INT NULL,
  `Roles_id` INT NOT NULL,
  `Producto_idProducto` INT NOT NULL,
  PRIMARY KEY (`idRecibo_ingreso`),
  INDEX `fk_Recibo_ingreso_Roles1_idx` (`Roles_id` ASC),
  INDEX `fk_Recibo_ingreso_Producto1_idx` (`Producto_idProducto` ASC),
  CONSTRAINT `fk_Recibo_ingreso_Roles1`
    FOREIGN KEY (`Roles_id`)
    REFERENCES `Roles` (`id_roles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_ingreso_Producto1`
    FOREIGN KEY (`Producto_idProducto`)
    REFERENCES `Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Insertar datos en Roles
INSERT INTO `Roles` (`nombre_rol`) VALUES
('Barbero'),
('Jefe de bodega'),
('Vendedor'),
('Cliente');

-- Insertar datos en Usuarios
INSERT INTO `Usuarios` (`Nombre`, `P_apellido`, `S_apellido`, `Numero`, `Correo`, `Roles_id`)
VALUES
  ('Juan', 'Pérez', 'Gómez', '1234567890', 'juan.perez@email.com', 1),
  ('Ana', 'Rodríguez', 'Lopez', '0987654321', 'ana.rodriguez@email.com', 2),
  ('Carlos', 'Martínez', 'Hernández', '1122334455', 'carlos.martinez@email.com', 3),
  ('Laura', 'García', 'Fernández', '2233445566', 'laura.garcia@email.com', 2),
  ('Pedro', 'Sánchez', 'Jiménez', '3344556677', 'pedro.sanchez@email.com', 1),
  ('María', 'López', 'Martínez', '4455667788', 'maria.lopez@email.com',2),
  ('David', 'Fernández', 'Rodríguez', '5566778899', 'david.fernandez@email.com', 3),
  ('Isabel', 'Vázquez', 'Castro', '6677889900', 'isabel.vazquez@email.com',1),
  ('Fernando', 'Díaz', 'Cordero', '7788990011', 'fernando.diaz@email.com',2),
  ('Lucía', 'Jiménez', 'Serrano', '8899001122', 'lucia.jimenez@email.com',3);

-- Insertar datos en Categoria
INSERT INTO `Categoria` (`categoria`) VALUES
('Shampoo y Acondicionador'),
('geles y ceras'),
('barba');

-- Insertar datos en Metodo_pago
INSERT INTO `Metodo_pago` (`Metodo_pago`) VALUES
('Efectivo'),
('Nequi'),
('Daviplata'),
('Transferencia Bancaria');

-- Insertar datos en Producto
INSERT INTO `Producto` (`Nombre`, `Cantidad`, `Precio`, `Categoria_id`)
VALUES
('Gel para el cabello', 50, 1500, 2),
('Cera de peinado', 30, 2000, 2),
('Champú volumizante', 40, 1200, 1),
('Acondicionador suave', 20, 1300, 1),
('Espuma fijadora', 25, 1700, 3),
('Aceite para barba', 15, 2500, 3),
('Crema para afeitar', 35, 2200, 3),
('Loción post-afeitado', 45, 1800, 3),
('Pasta para el cabello', 60, 1600, 2),
('Mascarilla capilar', 50, 2400, 3);

--  Insertar datos en Recibo

INSERT INTO Recibo (Fecha, Hora, Total, Producto_idProducto, Metodo_pago_idMetodo_pago, Usuarios_idUsuario)
VALUES
('2025-02-19', '10:00:00', 500, 1, 1, 1),  -- Recibo 1: Producto A, Efectivo, Juan Pérez
('2025-02-19', '11:00:00', 750, 2, 2, 2),  -- Recibo 2: Producto B, Tarjeta de crédito, María López
('2025-02-19', '12:00:00', 1000, 3, 3, 3), -- Recibo 3: Producto C, Transferencia, Carlos Gómez
('2025-02-19', '13:30:00', 300, 1, 2, 1),  -- Recibo 4: Producto A, Tarjeta de crédito, Juan Pérez
('2025-02-19', '14:00:00', 1200, 2, 3, 2), -- Recibo 5: Producto B, Transferencia, María López
('2025-02-19', '14:30:00', 1500, 3, 1, 3), -- Recibo 6: Producto C, Efectivo, Carlos Gómez
('2025-02-19', '15:00:00', 250, 1, 3, 1),  -- Recibo 7: Producto A, Transferencia, Juan Pérez
('2025-02-19', '15:30:00', 900, 2, 1, 2),  -- Recibo 8: Producto B, Efectivo, María López
('2025-02-19', '16:00:00', 1100, 3, 2, 3), -- Recibo 9: Producto C, Tarjeta de crédito, Carlos Gómez
('2025-02-19', '16:30:00', 600, 1, 1, 2);  -- Recibo 10: Producto A, Efectivo, María López


-- Insertar datos en Transaccion
INSERT INTO `Transaccion` 
(`Recibo_idRecibo`, `Producto_idProducto`) 
VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(4, 6),
(5, 7),
(6, 8),
(7, 9),
(8, 10);

-- Insertar datos en Recibo_ingreso
INSERT INTO `Recibo_ingreso` (`Hora`, `Total`, `Roles_id`, `Producto_idProducto`)
VALUES
('09:00', 3000,  1, 1),  
('10:00', 4500,  2, 2),
('11:00', 2700,   3, 5),
('12:00', 2200,  3, 6),
('13:00', 3200,  1, 4),
('14:00', 3600,   2, 7);


 SELECT * FROM `bar-ber-go`.recibo_ingreso;

-- Deshabilitar la actualización segura temporalmente
SET SQL_SAFE_UPDATES = 0;

-- Cambiar el campo 'Numero' a 'Contraseña' y agregar un comentario
ALTER TABLE Usuarios 
CHANGE COLUMN Numero Contraseña VARCHAR(255) NOT NULL COMMENT 'Identificador de la contraseña del cliente';

-- Modificar el campo 'Contraseña' en Cliente para que sea VARBINARY (para encriptación segura)
ALTER TABLE Usuarios
MODIFY Contraseña VARBINARY(255);

-- Seguridad de los datos: Definir clave de encriptación
SET @encryption_key = 'my_secret_key'; -- Reemplaza con una clave secreta segura

-- Encriptar los datos existentes en la tabla Cliente
UPDATE Usuarios
SET Contraseña = AES_ENCRYPT(Contraseña, @encryption_key);

-- Verificar la encriptación
SELECT idUsuario, 
       HEX(Contraseña) AS Encrypted_Contraseña
FROM Usuarios;

-- Desencriptar los datos (solo para verificación)
SELECT idUsuario, 
       AES_DECRYPT(Contraseña, @encryption_key) AS Decrypted_Contraseña
FROM Usuarios;

-- Consultas:
-- 1. Muestra los datos del recibo buscando por nombre y apellido del usuario
SELECT u.Nombre, u.P_apellido, r.idRecibo, r.Fecha, r.Hora, r.Total, 
       p.Nombre AS Producto, mp.Metodo_pago
FROM Recibo r
JOIN Usuarios u ON r.Usuarios_idUsuario = u.idUsuario
JOIN Producto p ON r.Producto_idProducto = p.idProducto
JOIN Metodo_pago mp ON r.Metodo_pago_idMetodo_pago = mp.idMetodo_pago
WHERE u.Nombre = 'Juan' AND u.P_apellido = 'Pérez';

-- 2. Muestra el nombre, apellido y la suma de lo que ha gastado un cliente en específico
SELECT u.Nombre, u.P_apellido, SUM(r.Total) AS Total_Suma
FROM Recibo r
JOIN Usuarios u ON r.Usuarios_idUsuario = u.idUsuario
WHERE u.Nombre = 'Juan' AND u.P_apellido = 'Pérez'
GROUP BY u.idUsuario;

-- 3. Muestra todos los recibos de ingresos realizados por el jefe de bodega
SELECT r.nombre_rol AS nombre_jefe_bodega, ri.idRecibo_ingreso, ri.Hora, 
       ri.Producto_idProducto, ri.Total
FROM Recibo_ingreso ri
JOIN Roles r ON ri.Roles_id = r.id_roles
WHERE r.nombre_rol = 'Jefe de bodega';


-- 4. Agrupa los campos de las tablas clientes, roles, productos, método de pago y recibos
SELECT u.Nombre AS Cliente, u.P_apellido AS Primer_Apellido, u.S_apellido AS Segundo_Apellido, 
       r.nombre_rol AS Rol, p.Nombre AS Producto, p.Precio AS Precio_Producto, 
       mp.Metodo_pago AS Metodo_Pago, re.Total AS Total_Recibo, 
       re.Fecha AS Fecha_Recibo
FROM Recibo re
JOIN Usuarios u ON re.Usuarios_idUsuario = u.idUsuario
JOIN Roles r ON u.Roles_id = r.id_roles
JOIN Producto p ON re.Producto_idProducto = p.idProducto
JOIN Metodo_pago mp ON re.Metodo_pago_idMetodo_pago = mp.idMetodo_pago
WHERE re.Fecha BETWEEN '2024-09-15' AND '2024-09-22'
ORDER BY re.Fecha ASC, re.Hora ASC;

-- 5. Relaciona los recibos de clientes con los productos que recibieron y el método de pago utilizado
SELECT u.Nombre AS ClienteNombre, u.P_apellido AS ClienteApellido, r.nombre_rol AS Rol, 
       p.Nombre AS ProductoNombre, p.Precio AS PrecioProducto, mp.Metodo_pago AS MetodoPago, 
       re.Fecha AS FechaRecibo, re.Hora AS HoraRecibo, re.Total AS TotalRecibo
FROM Recibo re
INNER JOIN Usuarios u ON re.Usuarios_idUsuario = u.idUsuario
INNER JOIN Roles r ON u.Roles_id = r.id_roles
INNER JOIN Producto p ON re.Producto_idProducto = p.idProducto
INNER JOIN Metodo_pago mp ON re.Metodo_pago_idMetodo_pago = mp.idMetodo_pago
WHERE re.Total > 2000
ORDER BY re.Fecha DESC, re.Hora DESC;

-- 6. Obtiene una lista de clientes junto con el número de transacciones (recibos) y el total pagado por cada cliente,
-- pero solo incluye a aquellos clientes que tienen más de una transacción
SELECT u.Nombre AS Cliente, COUNT(r.idRecibo) AS Numero_Transacciones, SUM(r.Total) AS Total_Pagado
FROM Usuarios u
INNER JOIN Recibo r ON u.idUsuario = r.Usuarios_idUsuario
GROUP BY u.idUsuario
HAVING COUNT(r.idRecibo) > 1;

-- 7. Obtiene información sobre cada cliente, incluyendo sus apellidos, tipo de cita, 
-- método de pago, productos contratados y el total gastado, y luego ordena estos clientes por cuánto han gastado.
SELECT ClienteData.Cliente, ClienteData.Primer_Apellido, ClienteData.Segundo_Apellido, 
       ClienteData.Rol, ClienteData.Metodo_Pago, ClienteData.Productos_Contratados, 
       ClienteData.Total_Gastado
FROM (
    SELECT u.Nombre AS Cliente, u.P_apellido AS Primer_Apellido, u.S_apellido AS Segundo_Apellido, 
           r2.nombre_rol AS Rol, mp.Metodo_pago AS Metodo_Pago,  -- Cambié 'r.nombre_rol' por 'r2.nombre_rol'
           (SELECT GROUP_CONCAT(DISTINCT p.Nombre)
            FROM Producto p
            INNER JOIN Recibo r2a ON r2a.Producto_idProducto = p.idProducto
            WHERE r2a.Usuarios_idUsuario = u.idUsuario AND r2a.Fecha >= '2024-09-20'
           ) AS Productos_Contratados,
           (SELECT SUM(r1.Total)
            FROM Recibo r1
            WHERE r1.Usuarios_idUsuario = u.idUsuario AND r1.Fecha >= '2024-09-20'
           ) AS Total_Gastado
    FROM Usuarios u
    INNER JOIN Recibo r ON u.idUsuario = r.Usuarios_idUsuario
    INNER JOIN Metodo_pago mp ON r.Metodo_pago_idMetodo_pago = mp.idMetodo_pago
    INNER JOIN Roles r2 ON u.Roles_id = r2.id_roles  -- Este es el JOIN correcto
    WHERE r.Fecha >= '2024-09-20'
    GROUP BY u.idUsuario, r2.nombre_rol, mp.Metodo_pago
) AS ClienteData
ORDER BY ClienteData.Total_Gastado DESC
LIMIT 0, 1000;

show databases;
