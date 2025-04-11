-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2025 a las 22:20:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bar-ber-go`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'Shampoo y Acondicionador'),
(2, 'geles y ceras'),
(3, 'barba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `idMetodo_pago` int(11) NOT NULL,
  `Metodo_pago` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`idMetodo_pago`, `Metodo_pago`) VALUES
(1, 'Efectivo'),
(2, 'Nequi'),
(3, 'Daviplata'),
(4, 'Transferencia Bancaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `Nombre`, `Cantidad`, `Precio`, `imagen`, `id_categoria`) VALUES
(1, 'Gel para el cabello', 50, 1500, NULL, 2),
(2, 'Cera de peinado', 30, 2000, NULL, 2),
(3, 'Champú volumizante', 40, 1200, NULL, 1),
(4, 'Acondicionador suave', 20, 1300, NULL, 1),
(5, 'Espuma fijadora', 25, 1700, NULL, 3),
(6, 'Aceite para barba', 15, 2500, NULL, 3),
(7, 'Crema para afeitar', 35, 2200, NULL, 3),
(8, 'Loción post-afeitado', 45, 1800, NULL, 3),
(9, 'Pasta para el cabello', 60, 1600, NULL, 2),
(10, 'Mascarilla capilar', 50, 2400, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE `recibo` (
  `idRecibo` int(11) NOT NULL,
  `Fecha` varchar(45) NOT NULL,
  `Hora` varchar(45) NOT NULL,
  `Total` int(11) NOT NULL,
  `Producto_idProducto` int(11) NOT NULL,
  `Metodo_pago_idMetodo_pago` int(11) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `recibo`
--

INSERT INTO `recibo` (`idRecibo`, `Fecha`, `Hora`, `Total`, `Producto_idProducto`, `Metodo_pago_idMetodo_pago`, `Usuarios_idUsuario`) VALUES
(1, '2025-02-19', '10:00:00', 500, 1, 1, 1),
(2, '2025-02-19', '11:00:00', 750, 2, 2, 2),
(3, '2025-02-19', '12:00:00', 1000, 3, 3, 3),
(4, '2025-02-19', '13:30:00', 300, 1, 2, 1),
(5, '2025-02-19', '14:00:00', 1200, 2, 3, 2),
(6, '2025-02-19', '14:30:00', 1500, 3, 1, 3),
(7, '2025-02-19', '15:00:00', 250, 1, 3, 1),
(8, '2025-02-19', '15:30:00', 900, 2, 1, 2),
(9, '2025-02-19', '16:00:00', 1100, 3, 2, 3),
(10, '2025-02-19', '16:30:00', 600, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_ingreso`
--

CREATE TABLE `recibo_ingreso` (
  `idRecibo_ingreso` int(11) NOT NULL,
  `Hora` varchar(45) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL,
  `Roles_id` int(11) NOT NULL,
  `Producto_idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `recibo_ingreso`
--

INSERT INTO `recibo_ingreso` (`idRecibo_ingreso`, `Hora`, `Total`, `Roles_id`, `Producto_idProducto`) VALUES
(1, '09:00', 3000, 1, 1),
(2, '10:00', 4500, 2, 2),
(3, '11:00', 2700, 3, 5),
(4, '12:00', 2200, 3, 6),
(5, '13:00', 3200, 1, 4),
(6, '14:00', 3600, 2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'barbero'),
(3, 'Vendedor'),
(4, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `Recibo_idRecibo` int(11) NOT NULL,
  `Producto_idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`Recibo_idRecibo`, `Producto_idProducto`) VALUES
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `P_apellido` varchar(45) NOT NULL,
  `S_apellido` varchar(45) NOT NULL,
  `Pass` varchar(255) DEFAULT NULL,
  `Correo` varchar(45) NOT NULL,
  `id_roles` int(11) DEFAULT NULL,
  `userState` tinyint(1) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`, `P_apellido`, `S_apellido`, `Pass`, `Correo`, `id_roles`, `userState`, `reset_token`, `reset_expiration`) VALUES
(1, 'Juan', 'Pérez', 'Gómez', '$2y$10$6H8lMF67gxQclwpCrEduXuyu5v6q7/Va6GK1ZaOV/KGX21Ym2koXm', 'juan.perez@email.com', 1, 0, NULL, NULL),
(2, 'Ana', 'Rodríguez', 'Lopez', '$2y$10$3qBN/K6JOvPNWMU8r97.kOBK7NoQB21BGABoH5/zHP.akWwgz8jbG', 'ana.rodriguez@email.com', 2, 0, NULL, NULL),
(3, 'Carlos', 'Martínez', 'Hernández', '$2y$10$QZiUl8lmHUfoUyYLnSlkQeV8mCkIzz0u6DrrSx6RhmCJtCNZ3yERK', 'carlos.martinez@email.com', 3, 0, NULL, NULL),
(4, 'Laura', 'García', 'Fernández', '$2y$10$JeDa9w77vmfMO4ZLdW4D4eO9wXqBSW9EnprkQP.f3rcbyDw5IXpfG', 'laura.garcia@email.com', 2, 0, NULL, NULL),
(5, 'Pedro', 'Sánchez', 'Jiménez', '$2y$10$g4GymRS5eZwQD3Ht9GsdquR05Dx0moH9A7jvPFdXiu.8X9CHJ9Ou6', 'pedro.sanchez@email.com', 1, 0, NULL, NULL),
(6, 'María', 'López', 'Martínez', '$2y$10$WAjNtnY3jSMKywiDSLMCeOriEHMX1Bq6/NFRehy57dycwUJtEzdd.', 'maria.lopez@email.com', 2, 0, NULL, NULL),
(7, 'David', 'Fernández', 'Rodríguez', '$2y$10$rD6oTy3q0MWkWJmShsnk9eXsT4PmfQf/t/ruOBUJha2Cpu8zjVADC', 'david.fernandez@email.com', 3, 0, NULL, NULL),
(8, 'Isabel', 'Vázquez', 'Castro', '$2y$10$ylbd2G8Azc015mz1UwEYCOmliA7BY/hOQg8aqGeih9hLPX7JsA81O', 'isabel.vazquez@email.com', 1, 0, NULL, NULL),
(9, 'Fernando', 'Díaz', 'Cordero', '$2y$10$MpP9kXiTS8o242NWjPG7xumQ0HQhFmehOm8LY.O.3uv3CX1szW6QG', 'fernando.diaz@email.com', 2, 0, NULL, NULL),
(10, 'Lucía', 'Jiménez', 'Serrano', '$2y$10$aKm/6Q.9bLqv8anPg4mzbuTziybb1UjEzNfJFh3gDB8b/Hq7GWa4G', 'lucia.jimenez@email.com', 3, 0, NULL, NULL),
(12, 'sb', 'ab', 'ab', '$2y$10$0fG35fNJfuEqFUBkDagP0.ge8HfCqlkegWn9c8rKBh9SeNt517dRe', 'ab@gmail.com', 4, 0, NULL, NULL),
(15, 'jose', 'perez', 'rojas', '$2y$10$tZCtJfxyt.zu.SZH3IHPoeOX6spwG2y2NvYaMwCSPLtBdKKHlgeFi', 'Juanito.Perez@gmail.com', 1, 0, NULL, NULL),
(16, 'rubor ', 'Ramos', 'Sierra', '$2y$10$c3vP07GfexVq3k1hSWt.m.Qv0bdCWE0/7u.dbXarnZY0iQZthrCtS', 'vegetalesjose@gmail.com', 1, 0, NULL, NULL),
(17, 'Alejandro', 'Fernandez', 'garcia', '$2y$10$ZaOT1G4Hkf4wUBUX1JS2wOQUq59uxMIc0aykbdgkrkFGAVbIxSqbK', 'dafa@gmail.com', 2, 1, NULL, NULL),
(18, 'lyahn ', 'vargas', 'rozo ', '$2y$10$HcssKu0NHud82.rm/axnDOkdG6isb.JqhV7nwH.BytHComyimKAj6', 'trolgame@gmail.com', 4, 0, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`idMetodo_pago`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fk_Producto_Categoria1_idx` (`id_categoria`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`idRecibo`),
  ADD KEY `fk_Recibo_Producto_idx` (`Producto_idProducto`),
  ADD KEY `fk_Recibo_Metodo_pago_idx` (`Metodo_pago_idMetodo_pago`),
  ADD KEY `fk_Recibo_Usuario_idx` (`Usuarios_idUsuario`);

--
-- Indices de la tabla `recibo_ingreso`
--
ALTER TABLE `recibo_ingreso`
  ADD PRIMARY KEY (`idRecibo_ingreso`),
  ADD KEY `fk_Recibo_ingreso_Roles1_idx` (`Roles_id`),
  ADD KEY `fk_Recibo_ingreso_Producto1_idx` (`Producto_idProducto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`Recibo_idRecibo`,`Producto_idProducto`),
  ADD KEY `fk_Recibo_has_Producto_Producto1_idx` (`Producto_idProducto`),
  ADD KEY `fk_Recibo_has_Producto_Recibo1_idx` (`Recibo_idRecibo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_Usuarios_Roles1_idx` (`id_roles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `idMetodo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `recibo`
--
ALTER TABLE `recibo`
  MODIFY `idRecibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `recibo_ingreso`
--
ALTER TABLE `recibo_ingreso`
  MODIFY `idRecibo_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Producto_Categoria1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD CONSTRAINT `fk_Recibo_Metodo_pago` FOREIGN KEY (`Metodo_pago_idMetodo_pago`) REFERENCES `metodo_pago` (`idMetodo_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Recibo_Producto` FOREIGN KEY (`Producto_idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Recibo_Usuario` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recibo_ingreso`
--
ALTER TABLE `recibo_ingreso`
  ADD CONSTRAINT `fk_Recibo_ingreso_Producto1` FOREIGN KEY (`Producto_idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Recibo_ingreso_Roles1` FOREIGN KEY (`Roles_id`) REFERENCES `roles` (`id_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_Recibo_has_Producto_Producto1` FOREIGN KEY (`Producto_idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Recibo_has_Producto_Recibo1` FOREIGN KEY (`Recibo_idRecibo`) REFERENCES `recibo` (`idRecibo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Usuarios_Roles1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
