-- Crear la base de datos
CREATE SCHEMA IF NOT EXISTS `BAR-BER-GO` DEFAULT CHARACTER SET utf8 ;
USE `BAR-BER-GO` ;

-- Tabla Tipo_cita
CREATE TABLE IF NOT EXISTS `Tipo_cita` (
  `idTipo_cita` INT NOT NULL AUTO_INCREMENT,
  `tipo_cita` VARCHAR(45) NOT NULL,
  `cobro_adicional` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipo_cita`)
) ENGINE=InnoDB;

-- Tabla Cliente
CREATE TABLE IF NOT EXISTS `Cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `P_apellido` VARCHAR(45) NOT NULL,
  `S_apellido` VARCHAR(45) NOT NULL,
  `Numero` VARCHAR(12) NOT NULL,
  `Correo` VARCHAR(45) NOT NULL,
  `calle` VARCHAR(45) NOT NULL,
  `numero_calle` VARCHAR(45) NOT NULL,
  `Tipo_cita_idTipo_cita` INT NOT NULL,
  PRIMARY KEY (`idCliente`),
  INDEX `fk_Cliente_Tipo_cita1_idx` (`Tipo_cita_idTipo_cita` ASC),
  CONSTRAINT `fk_Cliente_Tipo_cita1`
    FOREIGN KEY (`Tipo_cita_idTipo_cita`)
    REFERENCES `Tipo_cita` (`idTipo_cita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabla Categoria
CREATE TABLE IF NOT EXISTS `Categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB;

-- Tabla Cargo
CREATE TABLE IF NOT EXISTS `Cargo` (
  `idCargo` INT NOT NULL AUTO_INCREMENT,
  `cargo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB;

-- Tabla Roles
CREATE TABLE IF NOT EXISTS `Roles` (
  `id_roles` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Numero` VARCHAR(45) NOT NULL,
  `Correo` VARCHAR(45) NOT NULL,
  `Cargo_idCargo` INT NOT NULL,
  PRIMARY KEY (`id_roles`),
  INDEX `fk_Roles_Cargo1_idx` (`Cargo_idCargo` ASC),
  CONSTRAINT `fk_Roles_Cargo1`
    FOREIGN KEY (`Cargo_idCargo`)
    REFERENCES `Cargo` (`idCargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabla Servicios
CREATE TABLE IF NOT EXISTS `Servicios` (
  `idServicios` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Precio` INT NOT NULL,
  `Categoria_id` INT NOT NULL,
  `Roles_id` INT NOT NULL,
  PRIMARY KEY (`idServicios`),
  INDEX `fk_Servicios_Categoria1_idx` (`Categoria_id` ASC),
  INDEX `fk_Servicios_Roles1_idx` (`Roles_id` ASC),
  CONSTRAINT `fk_Servicios_Categoria1`
    FOREIGN KEY (`Categoria_id`)
    REFERENCES `Categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servicios_Roles1`
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

-- Tabla fecha
CREATE TABLE IF NOT EXISTS `fecha` (
  `idfecha` INT NOT NULL AUTO_INCREMENT,
  `fecha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idfecha`)
) ENGINE=InnoDB;

-- Tabla Recibo
CREATE TABLE IF NOT EXISTS `Recibo` (
  `idRecibo` INT NOT NULL AUTO_INCREMENT,
  `Fecha` VARCHAR(45) NOT NULL,
  `Hora` VARCHAR(45) NOT NULL,
  `Total` INT NOT NULL,
  `Servicios_idServicios` INT NOT NULL,
  `Metodo_pago_idMetodo_pago` INT NOT NULL,
  `fecha_idfecha` INT NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`idRecibo`),
  INDEX `fk_Recibo_Servicios_idx` (`Servicios_idServicios` ASC),
  INDEX `fk_Recibo_Metodo_pago_idx` (`Metodo_pago_idMetodo_pago` ASC),
  INDEX `fk_Recibo_fecha_idx` (`fecha_idfecha` ASC),
  INDEX `fk_Recibo_Cliente_idx` (`Cliente_idCliente` ASC),
  CONSTRAINT `fk_Recibo_Servicios`
    FOREIGN KEY (`Servicios_idServicios`)
    REFERENCES `Servicios` (`idServicios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_Metodo_pago`
    FOREIGN KEY (`Metodo_pago_idMetodo_pago`)
    REFERENCES `Metodo_pago` (`idMetodo_pago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_fecha`
    FOREIGN KEY (`fecha_idfecha`)
    REFERENCES `fecha` (`idfecha`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
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
  `fecha_idfecha` INT NOT NULL,
  PRIMARY KEY (`idRecibo_ingreso`),
  INDEX `fk_Recibo_ingreso_Roles1_idx` (`Roles_id` ASC),
  INDEX `fk_Recibo_ingreso_Producto1_idx` (`Producto_idProducto` ASC),
  INDEX `fk_Recibo_ingreso_fecha1_idx` (`fecha_idfecha` ASC),
  CONSTRAINT `fk_Recibo_ingreso_Roles1`
    FOREIGN KEY (`Roles_id`)
    REFERENCES `Roles` (`id_roles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_ingreso_Producto1`
    FOREIGN KEY (`Producto_idProducto`)
    REFERENCES `Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recibo_ingreso_fecha1`
    FOREIGN KEY (`fecha_idfecha`)
    REFERENCES `fecha` (`idfecha`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabla Agendamiento
CREATE TABLE IF NOT EXISTS `Agendamiento` (
  `idCitas` INT NOT NULL AUTO_INCREMENT,
  `Hora` VARCHAR(45) NOT NULL COMMENT 'Identificador de la hora de la cita ',
  `Tipo_cita_idTipo_cita` INT NOT NULL,
  `fecha_idfecha` INT NOT NULL,
  PRIMARY KEY (`idCitas`),
  INDEX `fk_Agendamiento_Tipo_cita1_idx` (`Tipo_cita_idTipo_cita` ASC) VISIBLE,
  INDEX `fk_Agendamiento_fecha1_idx` (`fecha_idfecha` ASC) VISIBLE,
  CONSTRAINT `fk_Agendamiento_Tipo_cita1`
    FOREIGN KEY (`Tipo_cita_idTipo_cita`)
    REFERENCES `Tipo_cita` (`idTipo_cita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Agendamiento_fecha1`
    FOREIGN KEY (`fecha_idfecha`)
    REFERENCES `fecha` (`idfecha`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Tabla Cita
CREATE TABLE IF NOT EXISTS `Cita` (
  `Agendamiento_idCitas` INT NOT NULL,
  `Servicios_idServicios` INT NOT NULL,
  PRIMARY KEY (`Agendamiento_idCitas`, `Servicios_idServicios`),
  INDEX `fk_Agendamiento_has_Servicios_Servicios1_idx` (`Servicios_idServicios` ASC) VISIBLE,
  INDEX `fk_Agendamiento_has_Servicios_Agendamiento1_idx` (`Agendamiento_idCitas` ASC) VISIBLE,
  CONSTRAINT `fk_Agendamiento_has_Servicios_Agendamiento1`
    FOREIGN KEY (`Agendamiento_idCitas`)
    REFERENCES `Agendamiento` (`idCitas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Agendamiento_has_Servicios_Servicios1`
    FOREIGN KEY (`Servicios_idServicios`)
    REFERENCES `Servicios` (`idServicios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- Insertar datos en Tipo_cita 
INSERT INTO `Tipo_cita` (`idTipo_cita`, `tipo_cita`, `cobro_adicional`) VALUES
(1, 'Presencial', 'No'),
(2, 'A domicilio', 'Sí');

SELECT * FROM `bar-ber-go`.Tipo_cita;

-- Insertar datos en Cliente 
INSERT INTO `Cliente` 
(`idCliente`, `Nombre`, `P_apellido`, `S_apellido`, `Numero`, `Correo`, `calle`, `numero_calle`, `Tipo_cita_idTipo_cita`) 
VALUES
(1, 'Juan', 'Pérez', 'Gómez', '1234567890', 'juan.perez@example.com', 'Calle A', '123', 1),
(2, 'Ana', 'Martínez', 'Hernández', '0987654321', 'ana.martinez@example.com', 'Calle B', '456', 2),
(3, 'Luis', 'García', 'Torres', '1122334455', 'luis.garcia@example.com', 'Calle C', '789', 1),
(4, 'Marta', 'López', 'Ríos', '5566778899', 'marta.lopez@example.com', 'Calle D', '101', 2),
(5, 'Carlos', 'González', 'Morales', '6677889900', 'carlos.gonzalez@example.com', 'Calle E', '202', 1),
(6, 'Laura', 'Fernández', 'Vázquez', '7788990011', 'laura.fernandez@example.com', 'Calle F', '303', 2),
(7, 'David', 'Ramírez', 'Castro', '8899001122', 'david.ramirez@example.com', 'Calle G', '404', 1),
(8, 'Patricia', 'Mendoza', 'Cruz', '9900112233', 'patricia.mendoza@example.com', 'Calle H', '505', 2),
(9, 'José', 'Sánchez', 'Álvarez', '0011223344', 'jose.sanchez@example.com', 'Calle I', '606', 1),
(10, 'Isabel', 'Hernández', 'Salazar', '1122334455', 'isabel.hernandez@example.com', 'Calle J', '707', 2),
(11, 'Francisco', 'Jiménez', 'Núñez', '2233445566', 'francisco.jimenez@example.com', 'Calle K', '808', 1),
(12, 'Elena', 'Paredes', 'Gómez', '3344556677', 'elena.paredes@example.com', 'Calle L', '909', 2),
(13, 'Ricardo', 'Torres', 'Peña', '4455667788', 'ricardo.torres@example.com', 'Calle M', '101', 1),
(14, 'Verónica', 'Reyes', 'Figueroa', '5566778899', 'veronica.reyes@example.com', 'Calle N', '202', 2),
(15, 'Javier', 'Álvarez', 'Pérez', '6677889900', 'javier.alvarez@example.com', 'Calle O', '303', 1),
(16, 'Sonia', 'Valencia', 'Martínez', '7788990011', 'sonia.valencia@example.com', 'Calle P', '404', 2),
(17, 'Andrés', 'Bermúdez', 'Soto', '8899001122', 'andres.bermudez@example.com', 'Calle Q', '505', 1),
(18, 'Gabriela', 'Márquez', 'Serrano', '9900112233', 'gabriela.marquez@example.com', 'Calle R', '606', 2),
(19, 'Esteban', 'Córdoba', 'Rivera', '0011223344', 'esteban.cordoba@example.com', 'Calle S', '707', 1),
(20, 'Lorena', 'Gómez', 'Jaramillo', '1122334455', 'lorena.gomez@example.com', 'Calle T', '808', 2);

SELECT * FROM `bar-ber-go`.cliente;

-- Insertar datos en Categoria 
INSERT INTO `Categoria` (`id_categoria`, `categoria`) VALUES
(1, 'Corte de cabello'),
(2, 'Afeitado'),
(3, 'Cortes de barba y cejas'),
(4, 'Coloración'),
(5, 'tienda');

SELECT * FROM `bar-ber-go`.categoria;

-- Insertar datos en Cargo 
INSERT INTO `Cargo` (`idCargo`, `cargo`) VALUES
(1, 'Barbero'),
(2, 'Jefe de bodega'),
(3, 'Vendedor');

SELECT * FROM `bar-ber-go`.cargo;

-- Insertar datos en Roles 
INSERT INTO `Roles` (`id_roles`, `Nombre`, `Numero`, `Correo`, `Cargo_idCargo`) VALUES
(1, 'Carlos Pérez', '123456789', 'c.perez@example.com', 1),
(2, 'Ana Gómez', '987654321', 'a.gomez@example.com', 2),
(3, 'Luis Martínez', '456789123', 'l.martinez@example.com', 3),
(4, 'Marta López', '321654987', 'm.lopez@example.com', 1),
(5, 'Jorge Fernández', '654987321', 'j.fernandez@example.com', 1);

SELECT * FROM `bar-ber-go`.roles;

-- Insertar datos en Servicios 
INSERT INTO `Servicios` (`idServicios`, `Nombre`, `Precio`, `Categoria_id`, `Roles_id`) VALUES
(1, 'Corte de Cabello Presencial', 17000, 1, 1),
(2, 'Domicilios', 27000, 5, 3),
(3, 'Corte de Barba y Cejas', 10000, 2, 2),
(4, 'Corte de Cabello Presencial', 17000, 1, 2),
(5, 'Corte de Cabello a Domicilio', 27000, 1, 2);

SELECT * FROM `bar-ber-go`.servicios;

-- Insertar datos en Metodo_pago 
INSERT INTO `Metodo_pago` (`idMetodo_pago`, `Metodo_pago`) VALUES
(1, 'Efectivo'),
(2, 'Nequi'),
(3, 'Daviplata'),
(4, 'Transferencia Bancaria');

SELECT * FROM `bar-ber-go`.metodo_pago;

-- Insertar datos en fecha 
INSERT INTO `fecha` (`idfecha`, `fecha`) VALUES
(1, '2024-01-01'),
(2, '2024-01-02'),
(3, '2024-01-03'),
(4, '2024-01-04'),
(5, '2024-01-05'),
(6, '2024-01-06'),
(7, '2024-01-07'),
(8, '2024-01-08'),
(9, '2024-01-09'),
(10, '2024-01-10');

SELECT * FROM `bar-ber-go`.fecha;

-- Insertar datos en recibo 
INSERT INTO `Recibo` (`idRecibo`, `Fecha`, `Hora`, `Total`, `Servicios_idServicios`, `Metodo_pago_idMetodo_pago`, `fecha_idfecha`, `Cliente_idCliente`) VALUES
(1, '2024-09-15', '10:00', 17000, 1, 1, 1, 1),
(2, '2024-09-15', '11:00', 27000, 2, 2, 2, 2),
(3, '2024-09-16', '12:00', 17000, 1, 3, 3, 3),
(4, '2024-09-16', '13:00', 27000, 2, 4, 4, 4),
(5, '2024-09-17', '14:00', 17000, 1, 3, 5, 5),
(6, '2024-09-17', '15:00', 27000, 2, 1, 6, 6),
(7, '2024-09-18', '16:00', 17000, 1, 2, 7, 7),
(8, '2024-09-18', '17:00', 27000, 2, 3, 8, 8),
(9, '2024-09-19', '18:00', 17000, 1, 4, 9, 9),
(10, '2024-09-19', '19:00', 27000, 2, 1, 10, 10),
(11, '2024-09-20', '10:30', 17000, 1, 1, 6, 2),
(12, '2024-09-20', '11:30', 27000, 2, 2, 7, 3),
(13, '2024-09-21', '12:30', 17000, 1, 3, 8, 4),
(14, '2024-09-21', '13:30', 27000, 2, 4, 9, 5),
(15, '2024-09-22', '14:30', 17000, 1, 2, 10, 6),
(16, '2024-09-22', '15:30', 27000, 2, 1, 1, 7),
(17, '2024-09-23', '16:30', 17000, 1, 2, 2, 8),
(18, '2024-09-23', '17:30', 27000, 2, 3, 3, 9),
(19, '2024-09-24', '18:30', 17000, 1, 4, 4, 10),
(20, '2024-09-24', '19:30', 27000, 2, 4, 5, 1);

SELECT * FROM `bar-ber-go`.recibo;
-- Insertar datos en producto

INSERT INTO `Producto` (`idProducto`, `Nombre`, `Cantidad`, `Precio`, `Categoria_id`)
VALUES
(1, 'Gel para el cabello', 50, 1500, 1),  -- Asume que el id_categoria 1 es válido
(2, 'Cera de peinado', 30, 2000, 2),       -- Asume que el id_categoria 2 es válido
(3, 'Champú volumizante', 40, 1200, 3),    -- Asume que el id_categoria 3 es válido
(4, 'Acondicionador suave', 20, 1300, 4),  -- Asume que el id_categoria 4 es válido
(5, 'Espuma fijadora', 25, 1700, 5),       -- Asume que el id_categoria 5 es válido
(6, 'Aceite para barba', 15, 2500, 1),     -- Asume que el id_categoria 1 es válido
(7, 'Crema para afeitar', 35, 2200, 2),    -- Asume que el id_categoria 2 es válido
(8, 'Loción post-afeitado', 45, 1800, 3),  -- Asume que el id_categoria 3 es válido
(9, 'Pasta para el cabello', 60, 1600, 4), -- Asume que el id_categoria 4 es válido
(10, 'Mascarilla capilar', 50, 2400, 5);   -- Asume que el id_categoria 5 es válido

SELECT * FROM `bar-ber-go`.producto;


-- Insertar datos en la tabla Transaccion 
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

SELECT * FROM `bar-ber-go`.transaccion;

-- Insertar datos en la tabla Recibo_ingreso 
INSERT INTO `Recibo_ingreso` (`idRecibo_ingreso`, `Hora`, `Total`, `Roles_id`, `Producto_idProducto`, `fecha_idfecha`)
VALUES
(1, '09:00', 3000, 2, 1, 1),  
(2, '10:00', 4500, 2, 2, 2),
(3, '11:00', 2700, 2, 3, 3), 
(4, '12:00', 3200, 2, 4, 4),  
(5, '13:00', 2200, 2, 5, 5), 
(6, '14:00', 2900, 2, 6, 6),  
(7, '15:00', 3500, 2, 7, 7),  
(8, '16:00', 4000, 2, 8, 8),  
(9, '17:00', 3800, 2, 9, 9),  
(10, '18:00', 2700, 2, 10, 10);  

 SELECT * FROM `bar-ber-go`.recibo_ingreso;


-- Insertar datos en la tabla Agendamiento 
INSERT INTO `Agendamiento` (`idCitas`, `Hora`, `Tipo_cita_idTipo_cita`, `fecha_idfecha`)
VALUES
(1, '09:00', 1, 1),  
(2, '10:00', 2, 2),  
(3, '11:00', 1, 3),  
(4, '12:00', 2, 4),  
(5, '13:00', 1, 5),  
(6, '14:00', 2, 6),  
(7, '15:00', 1, 7),  
(8, '16:00', 2, 8),  
(9, '17:00', 1, 9),  
(10, '18:00', 2, 10); 

SELECT * FROM `bar-ber-go`.Agendamiento;


-- Insertar datos en la tabla Cita 
INSERT INTO `Cita` 
(`Agendamiento_idCitas`, `Servicios_idServicios`) 
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 1),
(7, 2),
(8, 3),
(9, 4),
(10, 5);

SELECT * FROM `bar-ber-go`.Cita;

SET SQL_SAFE_UPDATES = 0;

-- cambiamos el campo numero a contraseña y lo incriptamos

ALTER TABLE Cliente
CHANGE COLUMN Numero Contraseña VARCHAR(12) NOT NULL COMMENT 'Identificador de la contraseña del cliente';

-- Modificar el campo para aceptar datos encriptados
ALTER TABLE Cliente
MODIFY Contraseña VARBINARY(255);

-- seguridad de los datos

--  Definir la clave de encriptación
SET @encryption_key = 'my_secret_key'; -- Reemplaza con una clave secreta segura

-- Encriptar los datos existentes
UPDATE Cliente
SET Contraseña = AES_ENCRYPT(Contraseña, @encryption_key);

--  Verificar la encriptación
SELECT idCliente, 
       HEX(Contraseña) AS Encrypted_Contraseña
FROM Cliente;

--  Desencriptar datos (solo para verificación, si es necesario)
SELECT idCliente, 
       AES_DECRYPT(Contraseña, @encryption_key) AS Decrypted_Contraseña
FROM Cliente;

-- consultas 
-- 1. muestra los datos del recibo buscando por el nombre de la persona y el apellido 

SELECT Cliente.Nombre, Cliente.P_apellido, Recibo.idRecibo, Recibo.Fecha, Recibo.Hora, Recibo.Total, Servicios.Nombre AS Servicio, Metodo_pago.Metodo_pago
FROM Recibo
JOIN Cliente ON Recibo.Cliente_idCliente = Cliente.idCliente
JOIN Servicios ON Recibo.Servicios_idServicios = Servicios.idServicios
JOIN Metodo_pago ON Recibo.Metodo_pago_idMetodo_pago = Metodo_pago.idMetodo_pago
WHERE Cliente.Nombre = 'Juan' and Cliente.P_apellido = "perez";

-- 2 muestra el nombre, apellido y la suma de lo que ha gastado un cliente en especifico 

SELECT Cliente.Nombre, Cliente.P_apellido, SUM(Recibo.Total) AS Total_Suma
FROM Recibo
JOIN Cliente ON Recibo.Cliente_idCliente = Cliente.idCliente
WHERE Cliente.Nombre = 'Juan' AND Cliente.P_apellido = 'Pérez';

-- 3. muestra todos los recibos de ingresos realizados por el jefe de bodega

SELECT  c.cargo AS nombre_cargo, r.Nombre AS nombre_jefe_bodega, ri.idRecibo_ingreso,ri.Hora, ri.Producto_idProducto, ri.fecha_idfecha, ri.Total
FROM recibo_ingreso ri
JOIN Cargo c ON ri.Roles_id = c.idCargo
JOIN Roles r ON c.idCargo = r.id_roles
WHERE ri.idRecibo_ingreso >0;

-- 4. agrupa los campos de las tablas clientes, Tipo de cita, Servicios, Roles, Metodo de pago y fecha desde la fecha 2024-09-15 hasta 2024-09-22 
-- y que lo ordene de forma ascendente 

SELECT 
    c.Nombre AS Cliente,
    c.P_apellido AS Primer_Apellido,
    c.S_apellido AS Segundo_Apellido,
    tc.tipo_cita AS Tipo_Cita,
    s.Nombre AS Servicio,
    s.Precio AS Precio_Servicio,
    r.Nombre AS Profesional,
    mp.Metodo_pago AS Metodo_Pago,
    re.Total AS Total_Recibo,
    re.Fecha AS Fecha_Recibo,
    f.fecha AS Fecha_Servicio
FROM 
    Recibo re
    JOIN Cliente c ON re.Cliente_idCliente = c.idCliente
    JOIN Tipo_cita tc ON c.Tipo_cita_idTipo_cita = tc.idTipo_cita
    JOIN Servicios s ON re.Servicios_idServicios = s.idServicios
    JOIN Roles r ON s.Roles_id = r.id_roles
    JOIN Metodo_pago mp ON re.Metodo_pago_idMetodo_pago = mp.idMetodo_pago
    JOIN fecha f ON re.fecha_idfecha = f.idfecha
WHERE 
    re.Fecha BETWEEN '2024-09-15' AND '2024-09-22'
ORDER BY 
    re.Fecha ASC, re.Hora ASC;

--  5. relaciona los recibos de clientes con los servicios que recibieron, 
-- el método de pago utilizado y detalles adicionales sobre el cliente y el barbero que realizó el servicio

SELECT 
    c.Nombre AS ClienteNombre,
    c.P_apellido AS ClienteApellido,
    t.tipo_cita AS TipoCita,
    s.Nombre AS ServicioNombre,
    s.Precio AS PrecioServicio,
    m.Metodo_pago AS MetodoPago,
    r.Fecha AS FechaRecibo,
    r.Hora AS HoraRecibo,
    r.Total AS TotalRecibo,
    rol.Nombre AS BarberoNombre,
    rol.Correo AS BarberoCorreo
FROM 
    Recibo r
INNER JOIN 
    Cliente c ON r.Cliente_idCliente = c.idCliente
INNER JOIN 
    Tipo_cita t ON c.Tipo_cita_idTipo_cita = t.idTipo_cita
INNER JOIN 
    Servicios s ON r.Servicios_idServicios = s.idServicios
INNER JOIN 
    Metodo_pago m ON r.Metodo_pago_idMetodo_pago = m.idMetodo_pago
INNER JOIN 
    Roles rol ON s.Roles_id = rol.id_roles
WHERE 
    r.Total > 20000  -- Filtra recibos con un total mayor a 20000
ORDER BY 
    r.Fecha DESC, r.Hora DESC;
 
 -- 6. obtiene  una lista de clientes junto con el número de transacciones (recibos)
 -- que han realizado y el total pagado por cada cliente, pero solo incluye a aquellos clientes que tienen más de una transacción. 
    
SELECT 
    c.Nombre AS Cliente,
    COUNT(r.idRecibo) AS Numero_Transacciones,
    SUM(r.Total) AS Total_Pagado
FROM 
    Cliente c
INNER JOIN 
    Recibo r ON c.idCliente = r.Cliente_idCliente
GROUP BY 
    c.idCliente
HAVING 
    (SELECT COUNT(r2.idRecibo) 
     FROM Recibo r2 
     WHERE r2.Cliente_idCliente = c.idCliente) > 1;
     
	-- 7 obtiene información sobre cada cliente, incluyendo sus apellidos, tipo de cita,
    -- método de pago, servicios contratados y el total gastado,
    -- y luego ordena estos clientes en función de cuánto han gastado.

    
    SELECT 
    ClienteData.Cliente, 
    ClienteData.Primer_Apellido, 
    ClienteData.Segundo_Apellido, 
    ClienteData.Tipo_Cita, 
    ClienteData.Metodo_Pago, 
    ClienteData.Servicios_Contratados, 
    ClienteData.Total_Gastado
FROM 
    (
        SELECT 
            c.Nombre AS Cliente,
            c.P_apellido AS Primer_Apellido,
            c.S_apellido AS Segundo_Apellido,
            tc.tipo_cita AS Tipo_Cita,
            mp.Metodo_pago AS Metodo_Pago,
            (SELECT GROUP_CONCAT(DISTINCT s.Nombre)
             FROM Servicios s
             INNER JOIN Recibo r2 ON r2.Servicios_idServicios = s.idServicios
             WHERE r2.Cliente_idCliente = c.idCliente AND r2.Fecha >= '2024-09-20'
            ) AS Servicios_Contratados,
            (SELECT SUM(r1.Total)
             FROM Recibo r1
             WHERE r1.Cliente_idCliente = c.idCliente AND r1.Fecha >= '2024-09-20'
            ) AS Total_Gastado
        FROM 
            Cliente c
        INNER JOIN 
            Tipo_cita tc ON c.Tipo_cita_idTipo_cita = tc.idTipo_cita
        INNER JOIN 
            Recibo r ON c.idCliente = r.Cliente_idCliente
        INNER JOIN 
            Metodo_pago mp ON r.Metodo_pago_idMetodo_pago = mp.idMetodo_pago
        WHERE 
            r.Fecha >= '2024-09-20'
        GROUP BY 
            c.idCliente, tc.tipo_cita, mp.Metodo_pago
    ) AS ClienteData
ORDER BY 
    ClienteData.Total_Gastado DESC;

     
     


