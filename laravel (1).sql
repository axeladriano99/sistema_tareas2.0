-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2023 a las 17:35:46
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(20) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `created_at`, `updated_at`, `estado`) VALUES
(1, 'sistemas', '2023-09-20 21:26:32', '2023-10-20 20:06:17', '1'),
(2, 'soporte', '2023-09-20 21:26:32', '2023-10-20 20:05:46', '1'),
(3, 'contabilidad', '2023-09-22 20:57:36', '2023-10-20 20:25:43', '1'),
(7, 'tareAAAAAAA', '2023-10-23 14:18:42', '2023-10-23 14:20:13', '2'),
(8, 'gerencia', '2023-10-23 15:18:27', '2023-10-23 15:18:27', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editables`
--

CREATE TABLE `editables` (
  `idTarea` int(11) DEFAULT NULL,
  `campos_editado` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fecha_modificada` datetime DEFAULT NULL,
  `fecha_finalanterior` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editables`
--

INSERT INTO `editables` (`idTarea`, `campos_editado`, `fecha_modificada`, `fecha_finalanterior`) VALUES
(150, 'nombre,descripcion,Fecha_inicio,fecha_termino', '2023-10-30 11:47:21', NULL),
(148, 'descripcion', '2023-10-30 11:47:21', NULL),
(147, 'nombre,descripcion', '2023-10-30 11:47:21', NULL),
(149, 'nombre,descripcion', '2023-10-30 11:58:56', NULL),
(152, 'Fecha_inicio,fecha_termino', '2023-06-07 12:16:00', '2023-12-31 12:31:00'),
(151, 'Fecha_inicio', '2023-10-30 12:06:00', '2023-10-30 12:06:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(20) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `name`, `created_at`, `updated_at`, `estado`) VALUES
(1, 'sin iniciar', '2023-09-22 21:11:19', '2023-10-04 19:46:56', '1'),
(2, 'iniciado', '2023-09-22 21:11:19', '2023-10-20 20:06:35', '1'),
(3, 'terminado', '2023-09-22 21:11:19', '2023-10-09 16:08:17', '1');

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
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `idTarea` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `idUsuario`, `idTarea`, `descripcion`, `created_at`, `updated_at`) VALUES
(83, 1, 142, 'tiempo', '2023-10-26 14:34:49', '2023-10-26 14:34:49'),
(84, 1, 143, 'prueba de actualizacion', '2023-10-26 19:20:00', '2023-10-26 19:20:00'),
(86, 1, 143, 'wqeqweqe', '2023-10-26 22:18:44', '2023-10-26 22:18:44'),
(87, 1, 144, NULL, '2023-10-27 13:53:19', '2023-10-27 13:53:19'),
(88, 1, 145, 'cambio!!!', '2023-10-27 13:56:21', '2023-10-27 13:56:21'),
(89, 1, 142, 'lo cambio por motivo de tiempo', '2023-10-27 14:58:02', '2023-10-27 14:58:02'),
(90, 125, 147, 'AUTORIZADO X EE', '2023-10-27 15:08:20', '2023-10-27 15:08:20'),
(91, 126, 148, 'Por visita a EDS Santa Ana', '2023-10-27 15:29:16', '2023-10-27 15:29:16'),
(124, 1, 152, 'prueba de actualizacion', '2023-10-30 20:25:38', '2023-10-30 20:25:38'),
(125, 123, 151, 'tiempo', '2023-10-30 20:46:02', '2023-10-30 20:46:02');

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
(1, '2023_09_08_195705_create_estado_table', 1),
(2, '2023_09_08_165747_create_areas_table', 2),
(3, '2014_10_12_000000_create_users_table', 3),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 3),
(5, '2014_10_12_100000_create_password_resets_table', 3),
(6, '2019_08_19_000000_create_failed_jobs_table', 3),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(8, '2023_09_08_005312_reset', 3),
(9, '2023_09_08_194749_create_tareas_table', 3),
(10, '2023_09_12_202803_create_permission_tables', 3),
(11, '2023_09_13_005555_create_roles', 4),
(12, '2023_09_22_153910_create_historial_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 124),
(1, 'App\\Models\\User', 128),
(1, 'App\\Models\\User', 129),
(1, 'App\\Models\\User', 131),
(2, 'App\\Models\\User', 123),
(2, 'App\\Models\\User', 126),
(2, 'App\\Models\\User', 132),
(3, 'App\\Models\\User', 125),
(3, 'App\\Models\\User', 127),
(3, 'App\\Models\\User', 130);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'estados', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(2, 'estados.index', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(3, 'estados.create', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(4, 'estados.edit', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(5, 'estados.destroy', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(6, 'tareas.index', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(7, 'tareas.create', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(8, 'tareas.edit', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(9, 'tareas.destroy', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(10, 'areas.index', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(11, 'areas.create', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(12, 'areas.edit', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(13, 'areas.destroy', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(14, 'users.index', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(15, 'users.create', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(16, 'users.edit', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(17, 'users.destroy', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrador', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(2, 'tecnico', 'web', '2023-09-13 06:01:13', '2023-09-13 06:01:13'),
(3, 'superadministrador', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `Fecha_inicio` datetime NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_termino` datetime NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `idEstado` bigint(20) UNSIGNED NOT NULL,
  `idCreador` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(20) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `nombre`, `Fecha_inicio`, `fecha_creacion`, `fecha_termino`, `descripcion`, `idEstado`, `idCreador`, `idUsuario`, `created_at`, `updated_at`, `estado`) VALUES
(142, 'prueba72', '2023-10-26 09:18:00', '2023-10-26 09:33:01', '2023-10-26 09:34:00', 'PRUEBA72', 1, 1, 1, '2023-10-26 14:33:01', '2023-10-26 14:33:01', '1'),
(143, 'fddddd', '2023-10-25 14:18:00', '2023-10-26 14:18:26', '2023-10-26 14:50:00', 'prueba1', 3, 1, 1, '2023-10-26 19:18:26', '2023-10-26 22:18:58', '1'),
(144, 'dfdffdf', '2023-10-26 17:19:00', '2023-10-26 17:19:11', '2023-10-26 17:19:00', '-', 2, 1, 1, '2023-10-26 22:19:11', '2023-10-26 22:19:25', '1'),
(145, 'BRYAN MARTIN POLO GOMEZ', '2023-10-25 17:56:00', '2023-10-26 17:25:15', '2023-10-26 17:24:00', 'iiikii', 3, 132, 132, '2023-10-26 22:25:15', '2023-10-26 22:25:15', '1'),
(146, 'REVISION DE TAREAS ALEX', '2023-10-28 12:00:00', '2023-10-27 10:02:21', '2023-10-28 13:00:00', '- TAREA 1\r\n- TAREA 2', 1, 125, 124, '2023-10-27 15:02:21', '2023-10-27 15:02:21', '1'),
(147, 'TAREA 111', '2023-10-31 10:05:00', '2023-10-27 10:07:38', '2023-10-31 10:05:00', '- UNO\r\n-DOs', 2, 125, 125, '2023-10-27 15:06:03', '2023-10-27 15:07:38', '1'),
(148, 'visitar Grifo Kalpu', '2023-10-28 10:25:00', '2023-10-27 10:26:21', '2023-10-28 10:25:00', '- Cambio de Surtidor\r\n- Prrsentar factura', 2, 125, 126, '2023-10-27 15:26:21', '2023-10-27 15:26:21', '1'),
(149, 'revisar contrato de EDS REPSOLL', '2023-10-27 10:26:00', '2023-10-27 10:27:39', '2023-10-27 10:26:00', '- Auditoria el 30 de octubre', 1, 125, 126, '2023-10-27 15:27:39', '2023-10-27 15:27:39', '1'),
(150, 'pruebas', '2023-10-27 11:08:00', '2023-10-27 11:14:55', '2023-10-27 11:14:00', 'pruebass', 2, 123, 123, '2023-10-27 16:14:55', '2023-10-27 16:14:55', '1'),
(151, 'ASASAS', '2023-10-30 12:05:00', '2023-10-30 12:06:33', '2023-10-30 12:06:00', 'ADADADDAD', 1, 123, 123, '2023-10-30 17:06:33', '2023-10-30 17:06:33', '1'),
(152, 'asdadd', '2023-06-07 12:00:00', '2023-10-30 12:08:33', '2023-12-31 12:31:00', 'fasfaff', 1, 1, 1, '2023-10-30 17:08:33', '2023-10-30 17:08:33', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `apellidoPaterno` varchar(255) NOT NULL,
  `apellido_Materno` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `DNI` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) NOT NULL,
  `idArea` bigint(20) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(20) DEFAULT '1',
  `rol` varchar(255) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `apellidoPaterno`, `apellido_Materno`, `email`, `DNI`, `cargo`, `idArea`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `estado`, `rol`) VALUES
(1, 'Axel', 'marchena', 'olazabal', 'axeladriano1234@gmail.com', '60699468', 'practicante', 1, '2023-10-30 20:51:34', 'eyJpdiI6Ijd3OXpiYitMK3JsZ2YrTklIU1VublE9PSIsInZhbHVlIjoiK3ZKekNLdjc5TllHUVRsakk3Ly9NUT09IiwibWFjIjoiNzkzMTk1NzIwOTVmNmM4ZGY3MzJjMjQ1ZDBiMDQ5MzJlMDYyZjNjMzEwYWY1MzNkNjhkNTM1MmY1OTdmYTEyNiIsInRhZyI6IiJ9', NULL, '2023-10-09 17:03:51', '2023-10-30 20:51:34', '1', '1'),
(123, 'Bryan Martin', 'Polo', 'Gomez', 'polop@gmail.com', '70401296', 'adasd', 1, '2023-10-23 19:40:15', 'eyJpdiI6Ii9YSTJLRVp4ZmQvbmU1VFVSR2ZkUHc9PSIsInZhbHVlIjoicElQYlIxcExtRE1jdmhlZjVsWWZ6UT09IiwibWFjIjoiNjQxZTg4OGNhMWU4MGMzNDg3YWJmNDg5ZjEzY2QxODc4NTQyMDE0ZjU3YzNmYzQ1MGNhM2QwYTVlOTZhMWU0NyIsInRhZyI6IiJ9', NULL, '2023-10-09 17:09:22', '2023-10-23 19:40:15', '1', '2'),
(124, 'MARLON RAMOS', 'f', 'r', 'super@gmail.com', '12345678', 'dasdad', 1, '2023-10-27 15:05:08', 'eyJpdiI6Im9mWlZKeUcrWENGMnFvWFUrcFRvYVE9PSIsInZhbHVlIjoibGJ6dkFOM1ZzTXlDQzhvbzBJNjBRZz09IiwibWFjIjoiZjY2Y2Y1NjcxNjVjZTFjYTZjNjRmNTU3MzkzY2Y3YjZjMDFlNGVhZGIwMTRlZjM1YTc3OGI0NDk2ZGQxYTJmMiIsInRhZyI6IiJ9', NULL, '2023-10-09 19:01:56', '2023-10-27 15:05:08', '2', '1'),
(125, 'Marlon Raul', 'Ramos', 'Sajami', 'mramos@rcingenieros.com', '10392834', 'Jefe de Sistemas', 1, '2023-10-27 15:24:53', 'eyJpdiI6ImlZdzhQajU4VTdiSzRKV3hjZnZVcGc9PSIsInZhbHVlIjoid1hXeTNLb1B2dkJaNkNiZ01sQ3J6QT09IiwibWFjIjoiMzNiM2NjMGM5MDliNDUwOGY0NDQ2MmRmZDg1YmVmYmNkNjk1ZmFmMDM3YWJiZWUzYTA1N2ZkNjI2NjlmMjI2YSIsInRhZyI6IiJ9', NULL, '2023-10-09 20:48:07', '2023-10-27 15:24:53', '1', '3'),
(126, 'Roberto David', 'Sanchez', 'Rondan', 'rsanchez@rcingenieros.com', '44725392', 'Jefe de Soporte Tecnico', 2, '2023-10-27 15:20:52', 'eyJpdiI6Imtha3pFKzM5SnRZYmtDZU5ZZHg5Q1E9PSIsInZhbHVlIjoiTm44QjYrZy9xZWlhRnUvREVpa3ZYdz09IiwibWFjIjoiNmVlYWVkMWRkZWY5OWM1ODM0OGM1NjRlNzFlNTg3ODcxMTQ3ZmM3NjE5N2IwNTBmNzhjNjMyMjFiNTU2NTg3NyIsInRhZyI6IiJ9', NULL, '2023-10-09 20:49:57', '2023-10-27 15:20:52', '1', '2'),
(130, 'Prueba', 'llldasd', 'asdasdas', 'polopx@gmail.com', '87456121', 'dsadas', 1, '2023-10-10 20:46:27', 'eyJpdiI6ImdOWGlQWUlqNGwrTE54UWV1OUpXQ0E9PSIsInZhbHVlIjoiR2hsS2w5azFXZG1XWmtNcTRiTDVyQT09IiwibWFjIjoiYTIxZDlkYzFjZGFhODQ0MDkxN2M2MTNiN2JkMDRmZjllOWM3ZGU3YzQxODA2OWQ5ZTQ5YjUwOTg5NDc2YTcwZSIsInRhZyI6IiJ9', NULL, '2023-10-10 20:46:27', '2023-10-10 20:46:27', '1', '3'),
(131, 'fasfas', 'fasfasfa', 'sfsafas', 'sfsafas@gmail.com', '12345611', 'anbjbsfjakbjk', 1, '2023-10-23 14:21:13', 'eyJpdiI6IkFOV2hwVXZZQldldHd6SFI3Mm93b0E9PSIsInZhbHVlIjoiVjlQL2NyaTNTcWU3RWZkaGhXZnZldz09IiwibWFjIjoiYjg5NzAxYTRkNGU2YzZmNTMzYzE3MjQ0MWQ2MDEzY2Q4YTBkNGEwMWNkOWUyYjg4MTZmNTZjZjFjM2ExMjNlZSIsInRhZyI6IiJ9', NULL, '2023-10-23 14:21:13', '2023-10-23 14:21:13', '1', '1'),
(132, 'Bryan Martin', 'Polo', 'Gomez', 'bp@gmail.com', '70401294', 'tecnico', 1, '2023-10-26 22:24:03', 'eyJpdiI6InppQVRKeTFSMW10a2ttVTZ4NEtPaVE9PSIsInZhbHVlIjoiY2pFRlpnRUdOM2lGV3pRZEFOSkMxZz09IiwibWFjIjoiZGVkMmMwZjQyMmQ4YmM4ZDc1N2Q1MTgwMmZiNDgyYTQ2ZWU1Njc1YjgwMTk2MGQ2MTdiZTNlYzE4OGZjY2U3ZCIsInRhZyI6IiJ9', NULL, '2023-10-26 22:23:44', '2023-10-26 22:24:03', '1', '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historial_idusuario_foreign` (`idUsuario`),
  ADD KEY `historial_idtarea_foreign` (`idTarea`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tareas_idestado_foreign` (`idEstado`),
  ADD KEY `tareas_idcreador_foreign` (`idCreador`),
  ADD KEY `tareas_idusuario_foreign` (`idUsuario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD KEY `users_idarea_foreign` (`idArea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_idtarea_foreign` FOREIGN KEY (`idTarea`) REFERENCES `tareas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historial_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_idcreador_foreign` FOREIGN KEY (`idCreador`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tareas_idestado_foreign` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tareas_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idarea_foreign` FOREIGN KEY (`idArea`) REFERENCES `areas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
