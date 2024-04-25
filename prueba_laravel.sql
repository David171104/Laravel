-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2024 a las 23:50:01
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
-- Base de datos: `prueba_laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--
-- Creación: 25-03-2024 a las 00:34:00
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `categories`:
--

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
(2, 'Samsumg', '#3e5f0c', '2024-03-25 05:40:17', '2024-03-25 06:32:04'),
(3, 'Iphone', '#b71515', '2024-03-25 06:15:10', '2024-03-25 06:15:10'),
(5, 'Xiomi', '#d02f2f', '2024-03-25 06:23:31', '2024-03-25 06:23:31'),
(13, 'Infinitix', '#f4c415', '2024-04-01 23:04:58', '2024-04-18 19:06:17'),
(15, 'Vivo', '#152e7a', '2024-04-05 02:01:59', '2024-04-16 23:44:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--
-- Creación: 22-03-2024 a las 01:56:35
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

--
-- RELACIONES PARA LA TABLA `failed_jobs`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--
-- Creación: 22-03-2024 a las 01:56:34
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `migrations`:
--

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2024_03_22_024910_add_additional_columns_to_products_table', 2),
(16, '2024_03_22_024017_create_products_table', 3),
(17, '2024_03_24_193444_create_categories_table', 3),
(18, '2024_03_24_225411_add_category_id_to_products_table', 3),
(19, '2024_03_26_144630_create_usuarios_table', 4),
(22, '2024_03_27_163711_add_status_to_products_table', 5),
(23, '2024_03_27_195137_add_pdf_to_products_table', 6),
(25, '2024_04_19_160748_add_telefono_to_users_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--
-- Creación: 22-03-2024 a las 01:56:35
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `password_resets`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--
-- Creación: 22-03-2024 a las 01:56:35
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `personal_access_tokens`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--
-- Creación: 27-03-2024 a las 20:11:30
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `products`:
--   `category_id`
--       `categories` -> `id`
--

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created_at`, `updated_at`, `category_id`, `status`, `pdf`) VALUES
(3, 'Samsumg A55', 'El que enamoro a mucha gente', 70.00, '2024-03-25 06:06:31', '2024-04-19 01:01:29', 2, 1, 'products/GWhGcsLIkCHvSDqtUVr1NjbXzX6TryuK3qidXLCc.pdf'),
(4, 'Xiomi redmi 12', 'El modelo que mas le gusto a las personas', 411.00, '2024-03-25 06:24:10', '2024-04-19 01:01:45', 5, 2, 'products/p493cQ7qwknouz8jl2qyeSnDty1FjZwC9F0olNzg.pdf'),
(7, 'Iphone 14', 'Este producto ha disminuido de precio', 500.00, '2024-03-25 06:46:14', '2024-03-25 06:46:14', 3, 1, ''),
(9, 'Xiomi poco x6', 'el nuevo rey', 500.01, '2024-03-26 23:16:17', '2024-03-26 23:16:17', 5, 1, ''),
(12, 'samsumg j3', 'antiguo', 50.01, '2024-03-27 18:25:56', '2024-04-17 00:11:12', 2, 2, ''),
(13, 'Xiomi redmi 12s', 'modelo 2023', 70.01, '2024-03-27 18:31:05', '2024-03-27 18:31:05', 5, 1, ''),
(14, 'Samsung S22', 'Lo ultimo en tecnologia', 700.00, '2024-03-27 18:36:44', '2024-03-27 18:37:28', 2, 1, ''),
(38, 'Vivo Y53', 'El celular vivo mas vendido que hay', 5000.00, '2024-04-05 02:02:51', '2024-04-17 02:08:52', 15, 1, ''),
(41, 'Xiomi Poco x6 pro', 'La marca Pocophone viene evolucionando a nivel de desarrollo', 500.00, '2024-04-16 02:04:35', '2024-04-16 02:40:34', 5, 1, NULL),
(62, 'Vivo AY45', 'Ahora con tecnologia contra salpicaduras y rayones', 5000.00, '2024-04-17 23:06:38', '2024-04-18 19:11:11', 15, 1, NULL),
(64, 'Samsumg S23 Series', 'El celular mas costoso en la gama alta de Samsumg', 200000.00, '2024-04-17 23:42:50', '2024-04-18 00:26:04', 2, 1, ''),
(75, 'Infinitix 30 Pro', 'La empresa que esta sorpendiendo a todo el mundo', 150.00, '2024-04-18 02:57:53', '2024-04-18 19:05:48', 13, 1, NULL),
(76, 'Iphone 15 Pro Max', 'El ultimo modelo de la empresa Apple', 120000.00, '2024-04-18 02:58:30', '2024-04-18 19:36:15', 3, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--
-- Creación: 19-04-2024 a las 16:10:57
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

--
-- RELACIONES PARA LA TABLA `users`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
-- Creación: 19-04-2024 a las 16:16:29
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `usuarios`:
--

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `email`, `password`, `rol`, `created_at`, `updated_at`, `telefono`) VALUES
(2, 'David', 'david@gmail.com', '$2y$10$0jDtkNQjdDO8z1e29WZ0AuuNDySgvJkp28kUhQQiv86cLv/6e2jZ.', '1', '2024-03-26 20:59:39', '2024-04-25 21:36:52', 573021563262),
(6, 'Alfredo', 'alfredo@gmail.com', '$2y$10$9wOISMC3FGTg7ZHeMPpycuPImBT3J3Jlf1KNyxfywoz01kuhR451W', '2', '2024-03-26 21:06:11', '2024-04-18 19:54:25', NULL),
(38, 'Alfonso', 'alfonso@gmail.com', '$2y$10$UjQlgu90lAJgEDpMuubF5.mFJ4kswp9CZGs7GbUFk01E.VxWL5Gi.', '2', '2024-04-04 23:15:11', '2024-04-09 01:28:12', NULL),
(55, 'David Altamar', 'altamardavid8@gmail.com', '$2y$10$YmXJU298T8E8CkizwTuPte6ooBO.9tTaA3y8IqGLmUIQJvYRruPdK', '2', '2024-04-12 19:22:22', '2024-04-25 22:44:40', 573022587841),
(79, 'poeda', 'poeda@gmail.com', '$2y$10$HWBZZieNDBPPAimxvGq8MOhkTIT12F2/VQVavYxMWU2mmS395cPue', '2', '2024-04-13 01:12:49', '2024-04-25 21:37:16', 573153859621),
(80, 'prueba', 'prueba@gmail.com', '$2y$10$LjGhI5g6D9tUOW3oUmUe3OzKDPSlMGTtVf6l32epKH2sVLwvbdUb2', '2', '2024-04-16 02:51:34', '2024-04-16 02:51:34', NULL),
(87, 'Daniel Almanza', 'almanzadavid00@gmail.com', '$2y$10$kV7jiPjqJFLuhzvUNxiYU.VAXSlMix8UzUcTBFJrOTX1e.p/jATJS', '2', '2024-04-17 21:00:44', '2024-04-25 21:07:06', 573125447988),
(245, 'Santiago Altamar', 'santiagoaltamar17@gmail.com', '$2y$10$R5Hmm9QxDSgS8Y/1Lo34/OiNuQNgvQR8SbCnqu4MX10rf4Rt4OksS', '2', '2024-04-24 03:19:05', '2024-04-24 03:19:05', 573028473698);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
