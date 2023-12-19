/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : medicontrol

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 19/12/2023 19:49:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ajustes
-- ----------------------------
DROP TABLE IF EXISTS `ajustes`;
CREATE TABLE `ajustes`  (
  `id_ajuste` int NOT NULL AUTO_INCREMENT,
  `id_institucion` int NULL DEFAULT NULL,
  `id_insumo` int NULL DEFAULT NULL,
  `tipo` enum('e','s') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'e',
  `fecha_vencimiento` date NULL DEFAULT NULL,
  `cantidad` decimal(12, 2) NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ajuste`) USING BTREE,
  INDEX `id_insumo`(`id_insumo`) USING BTREE,
  INDEX `id_institucion`(`id_institucion`) USING BTREE,
  CONSTRAINT `ajustes_ibfk_1` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id_insumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `ajustes_ibfk_2` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ajustes
-- ----------------------------
INSERT INTO `ajustes` VALUES (1, 1, 1, 'e', '0000-00-00', 10.00, '', '1', '2023-11-26 23:44:39');
INSERT INTO `ajustes` VALUES (2, 2, 1, 'e', '0000-00-00', 20.00, '', '1', '2023-11-27 00:09:11');
INSERT INTO `ajustes` VALUES (3, 3, 1, 'e', '0000-00-00', 100.00, 'Guantes quirugicos', '1', '2023-11-27 00:09:36');

-- ----------------------------
-- Table structure for bitacora
-- ----------------------------
DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE `bitacora`  (
  `id_bitacora` int NOT NULL AUTO_INCREMENT,
  `responsable` int NULL DEFAULT NULL,
  `tabla` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id` int NULL DEFAULT NULL,
  `bitacora` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bitacora`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 153 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bitacora
-- ----------------------------
INSERT INTO `bitacora` VALUES (1, 0, 'perfiles', 7, 'Perfil editado', '2023-11-22 20:50:57');
INSERT INTO `bitacora` VALUES (2, 0, 'perfiles', 7, 'Perfil editado', '2023-11-22 20:51:56');
INSERT INTO `bitacora` VALUES (3, 0, 'perfiles', 7, 'Perfil editado', '2023-11-22 20:53:53');
INSERT INTO `bitacora` VALUES (4, 0, 'perfiles', 7, 'Perfil editado', '2023-11-22 20:54:06');
INSERT INTO `bitacora` VALUES (5, 0, 'perfiles', 7, 'Perfil editado', '2023-11-22 20:55:15');
INSERT INTO `bitacora` VALUES (6, 0, 'perfiles', 7, 'Perfil editado', '2023-11-22 20:56:42');
INSERT INTO `bitacora` VALUES (7, 0, 'perfiles', 7, 'Perfil editado', '2023-11-22 20:58:13');
INSERT INTO `bitacora` VALUES (8, 0, 'usuarios', 2, 'Usuario registrado', '2023-11-22 21:12:20');
INSERT INTO `bitacora` VALUES (9, 0, 'pacientes', 1, 'Paciente registrado', '2023-11-22 21:12:20');
INSERT INTO `bitacora` VALUES (10, 0, 'usuarios', 3, 'Usuario registrado', '2023-11-22 21:13:49');
INSERT INTO `bitacora` VALUES (11, 0, 'personal', 1, 'Personal registrado', '2023-11-22 21:13:49');
INSERT INTO `bitacora` VALUES (12, 0, 'usuarios', 4, 'Usuario registrado', '2023-11-22 21:43:18');
INSERT INTO `bitacora` VALUES (13, 0, 'personal', 2, 'Personal registrado', '2023-11-22 21:43:18');
INSERT INTO `bitacora` VALUES (14, 0, 'personal', 2, 'Personal registrado', '2023-11-23 01:16:32');
INSERT INTO `bitacora` VALUES (15, 0, 'personal', 2, 'Personal registrado', '2023-11-23 01:16:52');
INSERT INTO `bitacora` VALUES (16, 0, 'usuarios', 4, 'Usuario editado', '2023-11-23 01:39:31');
INSERT INTO `bitacora` VALUES (17, 0, 'personal', 2, 'Personal editado', '2023-11-23 01:39:31');
INSERT INTO `bitacora` VALUES (18, 0, 'usuarios', 4, 'Usuario editado', '2023-11-23 01:40:24');
INSERT INTO `bitacora` VALUES (19, 0, 'personal', 2, 'Personal editado', '2023-11-23 01:40:24');
INSERT INTO `bitacora` VALUES (20, 0, 'usuarios', 4, 'Usuario editado', '2023-11-23 01:40:39');
INSERT INTO `bitacora` VALUES (21, 0, 'personal', 2, 'Personal editado', '2023-11-23 01:40:39');
INSERT INTO `bitacora` VALUES (22, 0, 'usuarios', 4, 'Usuario editado', '2023-11-23 01:41:54');
INSERT INTO `bitacora` VALUES (23, 0, 'personal', 2, 'Personal editado', '2023-11-23 01:41:54');
INSERT INTO `bitacora` VALUES (24, 0, 'personal', 4, 'Personal desactivado', '2023-11-23 01:48:30');
INSERT INTO `bitacora` VALUES (25, 0, 'personal', 4, 'Personal activado', '2023-11-23 01:48:35');
INSERT INTO `bitacora` VALUES (26, 0, 'personal', 4, 'Personal desactivado', '2023-11-23 01:52:15');
INSERT INTO `bitacora` VALUES (27, NULL, 'insumos', 1, 'Insumo registrado', '2023-11-23 04:29:31');
INSERT INTO `bitacora` VALUES (28, NULL, 'insumos', 2, 'Insumo registrado', '2023-11-23 04:30:44');
INSERT INTO `bitacora` VALUES (29, 1, 'insumos', 3, 'Insumo registrado', '2023-11-23 04:31:25');
INSERT INTO `bitacora` VALUES (30, NULL, 'insumos', 1, 'Insumo editado', '2023-11-23 04:31:52');
INSERT INTO `bitacora` VALUES (31, NULL, 'insumos', 1, 'Insumo editado', '2023-11-23 04:32:22');
INSERT INTO `bitacora` VALUES (32, NULL, 'insumos', 3, 'Insumo editado', '2023-11-23 04:33:34');
INSERT INTO `bitacora` VALUES (33, 1, 'insumos', 3, 'Insumo editado', '2023-11-23 04:34:44');
INSERT INTO `bitacora` VALUES (34, 1, 'insumos', 3, 'Insumo registrado', '2023-11-23 04:36:35');
INSERT INTO `bitacora` VALUES (35, 1, 'insumos', 1, 'Insumo desactivado', '2023-11-23 04:37:07');
INSERT INTO `bitacora` VALUES (36, NULL, 'ajustes', 1, 'Ajuste registrado', '2023-11-23 05:17:50');
INSERT INTO `bitacora` VALUES (37, 1, 'ajustes', 1, 'Ajuste registrado', '2023-11-23 05:18:23');
INSERT INTO `bitacora` VALUES (38, 1, 'ajustes', 3, 'Ajuste editado', '2023-11-23 05:23:55');
INSERT INTO `bitacora` VALUES (39, 1, 'ajustes', 1, 'Ajuste editado', '2023-11-23 05:24:02');
INSERT INTO `bitacora` VALUES (40, 1, 'ajustes', 1, 'Ajuste editado', '2023-11-23 05:24:09');
INSERT INTO `bitacora` VALUES (41, 1, 'ajustes', 2, 'Ajuste desactivado', '2023-11-23 05:24:23');
INSERT INTO `bitacora` VALUES (42, 1, 'ajustes', 2, 'Ajuste activado', '2023-11-23 05:24:58');
INSERT INTO `bitacora` VALUES (43, 1, 'ajustes', 2, 'Ajuste desactivado', '2023-11-23 05:25:33');
INSERT INTO `bitacora` VALUES (44, NULL, 'especialidades', 1, 'Especialidad registrada', '2023-11-24 01:05:03');
INSERT INTO `bitacora` VALUES (45, 1, 'especialidades', 2, 'Especialidad registrada', '2023-11-24 01:05:34');
INSERT INTO `bitacora` VALUES (46, 1, 'especialidades', 3, 'Especialidad registrada', '2023-11-24 01:08:27');
INSERT INTO `bitacora` VALUES (47, 1, 'especialidades', 4, 'Especialidad registrada', '2023-11-24 01:11:28');
INSERT INTO `bitacora` VALUES (48, 1, 'especialidades', 5, 'Especialidad registrada', '2023-11-24 01:13:47');
INSERT INTO `bitacora` VALUES (49, NULL, 'disponibilidad', 2, 'Disponibilidad registrada', '2023-11-24 11:58:22');
INSERT INTO `bitacora` VALUES (50, NULL, 'disponibilidad', 3, 'Disponibilidad registrada', '2023-11-24 12:00:22');
INSERT INTO `bitacora` VALUES (51, 1, 'disponibilidad', 4, 'Disponibilidad registrada', '2023-11-24 12:31:38');
INSERT INTO `bitacora` VALUES (52, NULL, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:26:01');
INSERT INTO `bitacora` VALUES (53, NULL, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:26:08');
INSERT INTO `bitacora` VALUES (54, NULL, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:27:24');
INSERT INTO `bitacora` VALUES (55, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:28:01');
INSERT INTO `bitacora` VALUES (56, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:29:21');
INSERT INTO `bitacora` VALUES (57, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:29:55');
INSERT INTO `bitacora` VALUES (58, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:30:25');
INSERT INTO `bitacora` VALUES (59, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:30:51');
INSERT INTO `bitacora` VALUES (60, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:31:12');
INSERT INTO `bitacora` VALUES (61, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 13:39:49');
INSERT INTO `bitacora` VALUES (62, 1, 'disponibilidad', 4, 'Especialidad desactivado', '2023-11-24 13:49:06');
INSERT INTO `bitacora` VALUES (63, 1, 'disponibilidad', 4, 'Especialidad activado', '2023-11-24 13:49:12');
INSERT INTO `bitacora` VALUES (64, 1, 'usuarios', 5, 'Usuario registrado', '2023-11-24 14:01:16');
INSERT INTO `bitacora` VALUES (65, 1, 'pacientes', 2, 'Paciente registrado', '2023-11-24 14:01:16');
INSERT INTO `bitacora` VALUES (66, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 14:24:02');
INSERT INTO `bitacora` VALUES (67, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 14:26:38');
INSERT INTO `bitacora` VALUES (68, 1, 'disponibilidad', 3, 'Especialidad desactivado', '2023-11-24 14:42:37');
INSERT INTO `bitacora` VALUES (69, 1, 'disponibilidad', 4, 'Especialidad editada', '2023-11-24 14:44:37');
INSERT INTO `bitacora` VALUES (70, 1, 'disponibilidad', 1, 'Especialidad editada', '2023-11-24 15:12:04');
INSERT INTO `bitacora` VALUES (71, 1, 'citas', NULL, 'Cita registrada', '2023-11-24 17:22:55');
INSERT INTO `bitacora` VALUES (72, 1, 'citas', NULL, 'Cita registrada', '2023-11-24 17:38:40');
INSERT INTO `bitacora` VALUES (73, 1, 'citas', 2, 'Cita registrada', '2023-11-24 17:40:37');
INSERT INTO `bitacora` VALUES (74, 1, 'citas', 3, 'Cita aprobada', '2023-11-25 00:00:17');
INSERT INTO `bitacora` VALUES (75, 1, 'citas', 3, 'Cita desaprobada', '2023-11-25 00:03:09');
INSERT INTO `bitacora` VALUES (76, 1, 'citas', 3, 'Cita aprobada', '2023-11-25 00:03:30');
INSERT INTO `bitacora` VALUES (77, 1, 'citas', 3, 'Cita desactivada', '2023-11-25 00:04:31');
INSERT INTO `bitacora` VALUES (78, 1, 'citas', 3, 'Cita activada', '2023-11-25 00:05:28');
INSERT INTO `bitacora` VALUES (79, 1, 'citas', 3, 'Cita desactivada', '2023-11-25 00:05:45');
INSERT INTO `bitacora` VALUES (80, 1, 'citas', 2, 'Cita editada', '2023-11-25 00:15:28');
INSERT INTO `bitacora` VALUES (81, 1, 'citas', 2, 'Cita editada', '2023-11-25 00:15:38');
INSERT INTO `bitacora` VALUES (82, 1, 'citas', 2, 'Cita editada', '2023-11-25 00:15:47');
INSERT INTO `bitacora` VALUES (83, 1, 'citas', 2, 'Cita aprobada', '2023-11-25 00:16:26');
INSERT INTO `bitacora` VALUES (84, 1, 'ajustes', 5, 'Ajuste registrado', '2023-11-25 01:03:53');
INSERT INTO `bitacora` VALUES (85, 1, 'instituciones', 3, 'Institucion registrada', '2023-11-25 06:41:41');
INSERT INTO `bitacora` VALUES (86, 1, 'instituciones', 3, 'Institucion editada', '2023-11-25 06:41:56');
INSERT INTO `bitacora` VALUES (87, 1, 'instituciones', 3, 'Institucion desactivada', '2023-11-25 06:42:26');
INSERT INTO `bitacora` VALUES (88, 1, 'usuarios', 5, 'Usuario editado', '2023-11-25 06:43:23');
INSERT INTO `bitacora` VALUES (89, 1, 'pacientes', 2, 'Paciente editado', '2023-11-25 06:43:23');
INSERT INTO `bitacora` VALUES (90, 1, 'pacientes', 2, 'Paciente desactivado', '2023-11-25 06:43:35');
INSERT INTO `bitacora` VALUES (91, 1, 'insumos', 5, 'Insumo registrado', '2023-11-25 06:44:50');
INSERT INTO `bitacora` VALUES (92, 1, 'insumos', 5, 'Insumo editado', '2023-11-25 06:45:12');
INSERT INTO `bitacora` VALUES (93, 1, 'insumos', 5, 'Insumo desactivado', '2023-11-25 06:45:19');
INSERT INTO `bitacora` VALUES (94, 1, 'insumos', 5, 'Insumo activado', '2023-11-25 06:45:28');
INSERT INTO `bitacora` VALUES (95, 1, 'ajustes', 6, 'Ajuste registrado', '2023-11-25 06:46:29');
INSERT INTO `bitacora` VALUES (96, 1, 'ajustes', 6, 'Ajuste editado', '2023-11-25 06:46:57');
INSERT INTO `bitacora` VALUES (97, 1, 'insumos', 6, 'Insumo registrado', '2023-11-25 06:52:40');
INSERT INTO `bitacora` VALUES (98, 1, 'insumos', 6, 'Insumo editado', '2023-11-25 06:52:54');
INSERT INTO `bitacora` VALUES (99, 1, 'insumos', 6, 'Insumo desactivado', '2023-11-25 06:53:04');
INSERT INTO `bitacora` VALUES (100, 1, 'insumos', 6, 'Insumo activado', '2023-11-25 06:53:12');
INSERT INTO `bitacora` VALUES (101, 1, 'ajustes', 7, 'Ajuste registrado', '2023-11-25 06:54:37');
INSERT INTO `bitacora` VALUES (102, 1, 'ajustes', 7, 'Ajuste editado', '2023-11-25 06:54:54');
INSERT INTO `bitacora` VALUES (103, 1, 'ajustes', 7, 'Ajuste desactivado', '2023-11-25 06:55:01');
INSERT INTO `bitacora` VALUES (104, 1, 'ajustes', 7, 'Ajuste activado', '2023-11-25 06:56:01');
INSERT INTO `bitacora` VALUES (105, 1, 'especialidades', 6, 'Especialidad registrada', '2023-11-25 06:57:53');
INSERT INTO `bitacora` VALUES (106, 1, 'disponibilidad', 5, 'Especialidad registrada', '2023-11-25 06:59:22');
INSERT INTO `bitacora` VALUES (107, 1, 'disponibilidad', 5, 'Especialidad editada', '2023-11-25 06:59:59');
INSERT INTO `bitacora` VALUES (108, 1, 'disponibilidad', 5, 'Especialidad editada', '2023-11-25 07:00:15');
INSERT INTO `bitacora` VALUES (109, 1, 'disponibilidad', 5, 'Especialidad editada', '2023-11-25 07:00:27');
INSERT INTO `bitacora` VALUES (110, 1, 'insumos', 7, 'Insumo registrado', '2023-11-25 07:23:13');
INSERT INTO `bitacora` VALUES (111, 1, 'insumos', 7, 'Insumo editado', '2023-11-25 07:23:34');
INSERT INTO `bitacora` VALUES (112, 1, 'insumos', 7, 'Insumo editado', '2023-11-25 07:24:20');
INSERT INTO `bitacora` VALUES (113, 1, 'insumos', 8, 'Insumo registrado', '2023-11-25 07:24:32');
INSERT INTO `bitacora` VALUES (114, 1, 'insumos', 8, 'Insumo desactivado', '2023-11-25 07:24:36');
INSERT INTO `bitacora` VALUES (115, 1, 'ajustes', 8, 'Ajuste registrado', '2023-11-25 07:25:01');
INSERT INTO `bitacora` VALUES (116, 1, 'ajustes', 9, 'Ajuste registrado', '2023-11-25 07:25:21');
INSERT INTO `bitacora` VALUES (117, 1, 'especialidades', 7, 'Especialidad registrada', '2023-11-25 07:26:10');
INSERT INTO `bitacora` VALUES (118, 1, 'disponibilidad', 6, 'Especialidad registrada', '2023-11-25 07:27:13');
INSERT INTO `bitacora` VALUES (119, 1, 'disponibilidad', 6, 'Especialidad editada', '2023-11-25 07:27:22');
INSERT INTO `bitacora` VALUES (120, 1, 'disponibilidad', 6, 'Especialidad desactivado', '2023-11-25 07:27:35');
INSERT INTO `bitacora` VALUES (121, 1, 'disponibilidad', 6, 'Especialidad activado', '2023-11-25 07:27:39');
INSERT INTO `bitacora` VALUES (122, 1, 'usuarios', 6, 'Usuario registrado', '2023-11-25 07:29:16');
INSERT INTO `bitacora` VALUES (123, 1, 'pacientes', 3, 'Paciente registrado', '2023-11-25 07:29:16');
INSERT INTO `bitacora` VALUES (124, 1, 'citas', 4, 'Cita registrada', '2023-11-25 07:29:16');
INSERT INTO `bitacora` VALUES (125, 1, 'usuarios', 7, 'Usuario registrado', '2023-11-25 07:31:50');
INSERT INTO `bitacora` VALUES (126, 1, 'pacientes', 4, 'Paciente registrado', '2023-11-25 07:31:50');
INSERT INTO `bitacora` VALUES (127, 1, 'citas', 5, 'Cita registrada', '2023-11-25 07:31:50');
INSERT INTO `bitacora` VALUES (128, 1, 'citas', 5, 'Cita registrada', '2023-11-25 07:32:22');
INSERT INTO `bitacora` VALUES (129, 1, 'citas', 5, 'Cita desaprobada', '2023-11-25 07:32:34');
INSERT INTO `bitacora` VALUES (130, 1, 'especialidades', 8, 'Especialidad registrada', '2023-11-25 07:39:37');
INSERT INTO `bitacora` VALUES (131, 1, 'disponibilidad', 7, 'Especialidad registrada', '2023-11-25 07:40:19');
INSERT INTO `bitacora` VALUES (132, 1, 'disponibilidad', 7, 'Especialidad editada', '2023-11-25 07:40:34');
INSERT INTO `bitacora` VALUES (133, 1, 'disponibilidad', 7, 'Especialidad editada', '2023-11-25 07:40:41');
INSERT INTO `bitacora` VALUES (134, 1, 'disponibilidad', 7, 'Especialidad editada', '2023-11-25 07:41:04');
INSERT INTO `bitacora` VALUES (135, 1, 'citas', 7, 'Cita registrada', '2023-11-25 07:42:17');
INSERT INTO `bitacora` VALUES (136, 1, 'citas', 7, 'Cita editada', '2023-11-25 07:42:40');
INSERT INTO `bitacora` VALUES (137, 1, 'citas', 7, 'Cita desactivada', '2023-11-25 07:42:44');
INSERT INTO `bitacora` VALUES (138, 1, 'citas', 7, 'Cita activada', '2023-11-25 07:42:49');
INSERT INTO `bitacora` VALUES (139, 1, 'citas', 7, 'Cita aprobada', '2023-11-25 07:43:34');
INSERT INTO `bitacora` VALUES (140, 1, 'insumos', 1, 'Insumo registrado', '2023-11-26 23:15:55');
INSERT INTO `bitacora` VALUES (141, 1, 'insumos', 2, 'Insumo registrado', '2023-11-26 23:16:50');
INSERT INTO `bitacora` VALUES (142, 1, 'insumos', 3, 'Insumo registrado', '2023-11-26 23:17:32');
INSERT INTO `bitacora` VALUES (143, 1, 'insumos', 4, 'Insumo registrado', '2023-11-26 23:17:54');
INSERT INTO `bitacora` VALUES (144, 1, 'insumos', 4, 'Insumo editado', '2023-11-26 23:18:17');
INSERT INTO `bitacora` VALUES (145, 1, 'insumos', 4, 'Insumo editado', '2023-11-26 23:18:35');
INSERT INTO `bitacora` VALUES (146, 1, 'insumos', 4, 'Insumo editado', '2023-11-26 23:20:50');
INSERT INTO `bitacora` VALUES (147, 1, 'insumos', 5, 'Insumo registrado', '2023-11-26 23:21:38');
INSERT INTO `bitacora` VALUES (148, 1, 'insumos', 6, 'Insumo registrado', '2023-11-26 23:22:01');
INSERT INTO `bitacora` VALUES (149, 1, 'ajustes', 1, 'Ajuste registrado', '2023-11-26 23:44:39');
INSERT INTO `bitacora` VALUES (150, 1, 'ajustes', 2, 'Ajuste registrado', '2023-11-27 00:09:11');
INSERT INTO `bitacora` VALUES (151, 1, 'ajustes', 3, 'Ajuste registrado', '2023-11-27 00:09:25');
INSERT INTO `bitacora` VALUES (152, 1, 'ajustes', 3, 'Ajuste editado', '2023-11-27 00:09:36');

-- ----------------------------
-- Table structure for cirugias
-- ----------------------------
DROP TABLE IF EXISTS `cirugias`;
CREATE TABLE `cirugias`  (
  `id_cirugia` int NOT NULL AUTO_INCREMENT,
  `cirugia` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cirugia`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cirugias
-- ----------------------------

-- ----------------------------
-- Table structure for citas
-- ----------------------------
DROP TABLE IF EXISTS `citas`;
CREATE TABLE `citas`  (
  `id_cita` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NULL DEFAULT NULL,
  `id_especialidad` int NULL DEFAULT NULL,
  `id_personal` int NULL DEFAULT NULL,
  `id_institucion` int NULL DEFAULT NULL,
  `fecha_solicitud` date NULL DEFAULT NULL,
  `hora_solicitud` time NULL DEFAULT NULL,
  `aprobacion` date NULL DEFAULT NULL,
  `fecha_asignada` date NULL DEFAULT NULL,
  `hora_asignada` time NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cita`) USING BTREE,
  INDEX `id_paciente`(`id_paciente`) USING BTREE,
  INDEX `id_especialidad`(`id_especialidad`) USING BTREE,
  INDEX `id_personal`(`id_personal`) USING BTREE,
  INDEX `id_institucion`(`id_institucion`) USING BTREE,
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `citas_ibfk_4` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of citas
-- ----------------------------
INSERT INTO `citas` VALUES (1, 1, 2, 1, 1, '2023-11-27', '10:00:00', '0000-00-00', NULL, NULL, '1', '2023-11-24 18:09:53');
INSERT INTO `citas` VALUES (2, 1, 2, 1, 1, '2023-11-29', '12:59:00', '2023-11-25', '2023-11-27', '12:00:00', '1', '2023-11-25 00:16:26');
INSERT INTO `citas` VALUES (3, 1, 2, 1, 1, '2023-11-27', '11:59:00', '2023-11-25', '2023-11-27', '10:00:00', '0', '2023-11-25 00:05:45');
INSERT INTO `citas` VALUES (4, 3, 6, 1, 2, '2023-11-27', '08:00:00', NULL, NULL, NULL, '1', '2023-11-25 07:29:16');
INSERT INTO `citas` VALUES (5, 4, 6, 1, 2, '2023-11-27', '08:30:00', '0000-00-00', '0000-00-00', '00:00:00', '1', '2023-11-25 07:32:34');
INSERT INTO `citas` VALUES (6, 4, 6, 1, 2, '2023-11-27', '08:30:00', NULL, NULL, NULL, '1', '2023-11-25 07:32:22');
INSERT INTO `citas` VALUES (7, 1, 5, 1, 1, '2023-11-27', '12:00:00', '2023-11-25', '2023-12-01', '15:00:00', '1', '2023-11-25 07:43:34');

-- ----------------------------
-- Table structure for codigos_area
-- ----------------------------
DROP TABLE IF EXISTS `codigos_area`;
CREATE TABLE `codigos_area`  (
  `id_codigo_area` int NOT NULL AUTO_INCREMENT,
  `id_estado` int NULL DEFAULT NULL,
  `codigo` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_codigo_area`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of codigos_area
-- ----------------------------
INSERT INTO `codigos_area` VALUES (1, 0, 412);
INSERT INTO `codigos_area` VALUES (2, 0, 414);
INSERT INTO `codigos_area` VALUES (3, 0, 416);
INSERT INTO `codigos_area` VALUES (4, 0, 424);
INSERT INTO `codigos_area` VALUES (5, 0, 426);
INSERT INTO `codigos_area` VALUES (6, 1, 248);
INSERT INTO `codigos_area` VALUES (7, 2, 235);
INSERT INTO `codigos_area` VALUES (8, 2, 281);
INSERT INTO `codigos_area` VALUES (9, 2, 282);
INSERT INTO `codigos_area` VALUES (10, 2, 283);
INSERT INTO `codigos_area` VALUES (11, 2, 285);
INSERT INTO `codigos_area` VALUES (12, 2, 292);
INSERT INTO `codigos_area` VALUES (13, 3, 247);
INSERT INTO `codigos_area` VALUES (14, 3, 277);
INSERT INTO `codigos_area` VALUES (15, 3, 278);
INSERT INTO `codigos_area` VALUES (16, 4, 243);
INSERT INTO `codigos_area` VALUES (17, 4, 244);
INSERT INTO `codigos_area` VALUES (18, 4, 246);
INSERT INTO `codigos_area` VALUES (19, 5, 273);
INSERT INTO `codigos_area` VALUES (20, 5, 258);
INSERT INTO `codigos_area` VALUES (22, 12, 251);
INSERT INTO `codigos_area` VALUES (23, 6, 286);
INSERT INTO `codigos_area` VALUES (24, 6, 285);
INSERT INTO `codigos_area` VALUES (25, 6, 288);
INSERT INTO `codigos_area` VALUES (26, 23, 264);
INSERT INTO `codigos_area` VALUES (27, 7, 241);
INSERT INTO `codigos_area` VALUES (28, 7, 242);
INSERT INTO `codigos_area` VALUES (29, 7, 245);
INSERT INTO `codigos_area` VALUES (30, 7, 249);
INSERT INTO `codigos_area` VALUES (31, 24, 212);
INSERT INTO `codigos_area` VALUES (32, 10, 268);
INSERT INTO `codigos_area` VALUES (33, 18, 293);
INSERT INTO `codigos_area` VALUES (34, 9, 287);
INSERT INTO `codigos_area` VALUES (35, 25, 237);
INSERT INTO `codigos_area` VALUES (36, 10, 264);
INSERT INTO `codigos_area` VALUES (37, 10, 266);
INSERT INTO `codigos_area` VALUES (39, 10, 269);
INSERT INTO `codigos_area` VALUES (40, 17, 257);
INSERT INTO `codigos_area` VALUES (41, 11, 238);
INSERT INTO `codigos_area` VALUES (42, 21, 212);
INSERT INTO `codigos_area` VALUES (44, 12, 252);
INSERT INTO `codigos_area` VALUES (45, 12, 253);
INSERT INTO `codigos_area` VALUES (46, 14, 232);
INSERT INTO `codigos_area` VALUES (47, 24, 231);
INSERT INTO `codigos_area` VALUES (48, 23, 261);
INSERT INTO `codigos_area` VALUES (50, 13, 271);
INSERT INTO `codigos_area` VALUES (51, 13, 274);
INSERT INTO `codigos_area` VALUES (52, 13, 275);
INSERT INTO `codigos_area` VALUES (53, 14, 212);
INSERT INTO `codigos_area` VALUES (54, 14, 234);
INSERT INTO `codigos_area` VALUES (55, 14, 239);
INSERT INTO `codigos_area` VALUES (56, 15, 291);
INSERT INTO `codigos_area` VALUES (57, 16, 295);
INSERT INTO `codigos_area` VALUES (58, 17, 255);
INSERT INTO `codigos_area` VALUES (59, 17, 256);
INSERT INTO `codigos_area` VALUES (61, 19, 276);
INSERT INTO `codigos_area` VALUES (62, 11, 246);
INSERT INTO `codigos_area` VALUES (63, 18, 294);
INSERT INTO `codigos_area` VALUES (64, 23, 262);
INSERT INTO `codigos_area` VALUES (65, 23, 263);
INSERT INTO `codigos_area` VALUES (66, 8, 258);
INSERT INTO `codigos_area` VALUES (67, 22, 254);
INSERT INTO `codigos_area` VALUES (68, 20, 272);

-- ----------------------------
-- Table structure for detalles_cirugias
-- ----------------------------
DROP TABLE IF EXISTS `detalles_cirugias`;
CREATE TABLE `detalles_cirugias`  (
  `id_det_cirugia` int NOT NULL AUTO_INCREMENT,
  `id_cirugia` int NULL DEFAULT NULL,
  `id_insumo` int NULL DEFAULT NULL,
  `cantidad` decimal(12, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_det_cirugia`) USING BTREE,
  INDEX `id_cirugia`(`id_cirugia`) USING BTREE,
  INDEX `id_insumo`(`id_insumo`) USING BTREE,
  CONSTRAINT `detalles_cirugias_ibfk_1` FOREIGN KEY (`id_cirugia`) REFERENCES `cirugias` (`id_cirugia`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `detalles_cirugias_ibfk_2` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id_insumo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalles_cirugias
-- ----------------------------

-- ----------------------------
-- Table structure for detalles_diagnosticos
-- ----------------------------
DROP TABLE IF EXISTS `detalles_diagnosticos`;
CREATE TABLE `detalles_diagnosticos`  (
  `id_detalle_diagnostico` int NOT NULL AUTO_INCREMENT,
  `id_diagnostico` int NULL DEFAULT NULL,
  `id_enfermedad` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_diagnostico`) USING BTREE,
  INDEX `id_diagnostico`(`id_diagnostico`) USING BTREE,
  INDEX `id_enfermedad`(`id_enfermedad`) USING BTREE,
  CONSTRAINT `detalles_diagnosticos_ibfk_1` FOREIGN KEY (`id_diagnostico`) REFERENCES `diagnosticos` (`id_diagnostico`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `detalles_diagnosticos_ibfk_2` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedades` (`id_enfermedad`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalles_diagnosticos
-- ----------------------------

-- ----------------------------
-- Table structure for detalles_enfermedades
-- ----------------------------
DROP TABLE IF EXISTS `detalles_enfermedades`;
CREATE TABLE `detalles_enfermedades`  (
  `id_detalle_enfermedad` int NOT NULL AUTO_INCREMENT,
  `id_enfermedad` int NULL DEFAULT NULL,
  `id_tratamiento` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_enfermedad`) USING BTREE,
  INDEX `id_enfermedad`(`id_enfermedad`) USING BTREE,
  INDEX `id_tratamiento`(`id_tratamiento`) USING BTREE,
  CONSTRAINT `detalles_enfermedades_ibfk_1` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedades` (`id_enfermedad`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `detalles_enfermedades_ibfk_2` FOREIGN KEY (`id_tratamiento`) REFERENCES `tratamientos` (`id_tratamiento`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalles_enfermedades
-- ----------------------------

-- ----------------------------
-- Table structure for detalles_planificacion
-- ----------------------------
DROP TABLE IF EXISTS `detalles_planificacion`;
CREATE TABLE `detalles_planificacion`  (
  `id_detalle_planificacion` int NOT NULL AUTO_INCREMENT,
  `id_planificacion` int NULL DEFAULT NULL,
  `id_personal` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_planificacion`) USING BTREE,
  INDEX `id_planificacion`(`id_planificacion`) USING BTREE,
  INDEX `id_personal`(`id_personal`) USING BTREE,
  CONSTRAINT `detalles_planificacion_ibfk_1` FOREIGN KEY (`id_planificacion`) REFERENCES `planificacion` (`id_planificacion`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `detalles_planificacion_ibfk_2` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalles_planificacion
-- ----------------------------

-- ----------------------------
-- Table structure for detalles_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `detalles_usuarios`;
CREATE TABLE `detalles_usuarios`  (
  `id_detalle_usuario` int NOT NULL AUTO_INCREMENT,
  `id_perfil` int NULL DEFAULT NULL,
  `id_usuario` int NULL DEFAULT NULL,
  `id` int NULL DEFAULT NULL,
  `id_institucion` int NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_detalle_usuario`) USING BTREE,
  INDEX `id_perfil`(`id_perfil`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `detalles_usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `detalles_usuarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalles_usuarios
-- ----------------------------
INSERT INTO `detalles_usuarios` VALUES (1, 2, 2, 1, 0, '1', '2023-11-22 21:12:20');
INSERT INTO `detalles_usuarios` VALUES (2, 6, 3, 1, 1, '1', '2023-11-22 21:13:49');
INSERT INTO `detalles_usuarios` VALUES (3, 1, 1, 0, 0, '1', '2023-11-22 21:15:52');
INSERT INTO `detalles_usuarios` VALUES (4, 5, 4, 2, 1, '0', '2023-11-23 01:52:15');
INSERT INTO `detalles_usuarios` VALUES (5, 4, 3, 1, 2, '1', '2023-11-23 01:17:54');
INSERT INTO `detalles_usuarios` VALUES (6, 7, 4, 2, 2, '1', '2023-11-23 01:41:54');
INSERT INTO `detalles_usuarios` VALUES (7, 2, 5, 2, 0, '1', '2023-11-24 14:01:16');
INSERT INTO `detalles_usuarios` VALUES (8, 2, 6, 3, 0, '1', '2023-11-25 07:29:16');
INSERT INTO `detalles_usuarios` VALUES (9, 2, 7, 4, 0, '1', '2023-11-25 07:31:50');

-- ----------------------------
-- Table structure for diagnosticos
-- ----------------------------
DROP TABLE IF EXISTS `diagnosticos`;
CREATE TABLE `diagnosticos`  (
  `id_diagnostico` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NULL DEFAULT NULL,
  `id_personal` int NULL DEFAULT NULL,
  `id_institucion` int NULL DEFAULT NULL,
  `fecha_diagnostico` date NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `id_prioridad` int NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_diagnostico`) USING BTREE,
  INDEX `id_paciente`(`id_paciente`) USING BTREE,
  INDEX `id_personal`(`id_personal`) USING BTREE,
  INDEX `id_institucion`(`id_institucion`) USING BTREE,
  CONSTRAINT `diagnosticos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `diagnosticos_ibfk_2` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `diagnosticos_ibfk_3` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of diagnosticos
-- ----------------------------

-- ----------------------------
-- Table structure for dias
-- ----------------------------
DROP TABLE IF EXISTS `dias`;
CREATE TABLE `dias`  (
  `id_dia` int NOT NULL AUTO_INCREMENT,
  `dia` varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dia`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dias
-- ----------------------------
INSERT INTO `dias` VALUES (1, 'LUNES');
INSERT INTO `dias` VALUES (2, 'MARTES');
INSERT INTO `dias` VALUES (3, 'MIERCOLES');
INSERT INTO `dias` VALUES (4, 'JUEVES');
INSERT INTO `dias` VALUES (5, 'VIERNES');
INSERT INTO `dias` VALUES (6, 'SABADOS');
INSERT INTO `dias` VALUES (7, 'DOMINGOS');

-- ----------------------------
-- Table structure for disponibilidad
-- ----------------------------
DROP TABLE IF EXISTS `disponibilidad`;
CREATE TABLE `disponibilidad`  (
  `id_disponibilidad` int NOT NULL AUTO_INCREMENT,
  `id_especialidad` int NULL DEFAULT NULL,
  `id_institucion` int NULL DEFAULT NULL,
  `id_personal` int NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_disponibilidad`) USING BTREE,
  INDEX `id_especialidad`(`id_especialidad`) USING BTREE,
  INDEX `id_institucion`(`id_institucion`) USING BTREE,
  INDEX `id_personal`(`id_personal`) USING BTREE,
  CONSTRAINT `disponibilidad_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `disponibilidad_ibfk_2` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `disponibilidad_ibfk_3` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of disponibilidad
-- ----------------------------
INSERT INTO `disponibilidad` VALUES (1, 1, 1, 2, '1', '2023-11-24 11:57:24');
INSERT INTO `disponibilidad` VALUES (2, 2, 1, 1, '1', '2023-11-24 11:58:22');
INSERT INTO `disponibilidad` VALUES (3, 3, 2, 1, '0', '2023-11-24 14:42:37');
INSERT INTO `disponibilidad` VALUES (4, 4, 1, 2, '1', '2023-11-24 13:49:12');
INSERT INTO `disponibilidad` VALUES (5, 6, 1, 2, '1', '2023-11-25 07:00:27');
INSERT INTO `disponibilidad` VALUES (6, 6, 2, 1, '1', '2023-11-25 07:27:39');
INSERT INTO `disponibilidad` VALUES (7, 5, 1, 1, '1', '2023-11-25 07:40:19');

-- ----------------------------
-- Table structure for enfermedades
-- ----------------------------
DROP TABLE IF EXISTS `enfermedades`;
CREATE TABLE `enfermedades`  (
  `id_enfermedad` int NOT NULL,
  `enfermedad` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `prevencion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_enfermedad`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enfermedades
-- ----------------------------

-- ----------------------------
-- Table structure for especialidades
-- ----------------------------
DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE `especialidades`  (
  `id_especialidad` int NOT NULL AUTO_INCREMENT,
  `especialidad` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_especialidad`) USING BTREE,
  INDEX `especialidad`(`especialidad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of especialidades
-- ----------------------------
INSERT INTO `especialidades` VALUES (1, 'Pediatria', '1', '2023-11-24 01:05:03');
INSERT INTO `especialidades` VALUES (2, 'Oftalmologia', '1', '2023-11-24 01:05:34');
INSERT INTO `especialidades` VALUES (3, 'Medicina interna', '1', '2023-11-24 01:08:27');
INSERT INTO `especialidades` VALUES (4, 'Cardiologia', '1', '2023-11-24 01:11:28');
INSERT INTO `especialidades` VALUES (5, 'Oncologia', '1', '2023-11-24 01:13:47');
INSERT INTO `especialidades` VALUES (6, 'Psicología', '1', '2023-11-25 06:57:53');
INSERT INTO `especialidades` VALUES (7, 'Especialidad de prueba', '1', '2023-11-25 07:26:10');
INSERT INTO `especialidades` VALUES (8, 'Prueba 2', '1', '2023-11-25 07:39:37');

-- ----------------------------
-- Table structure for estados
-- ----------------------------
DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados`  (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `iso_3166-2` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_estado`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of estados
-- ----------------------------
INSERT INTO `estados` VALUES (1, 'Amazonas', 'VE-X');
INSERT INTO `estados` VALUES (2, 'Anzoátegui', 'VE-B');
INSERT INTO `estados` VALUES (3, 'Apure', 'VE-C');
INSERT INTO `estados` VALUES (4, 'Aragua', 'VE-D');
INSERT INTO `estados` VALUES (5, 'Barinas', 'VE-E');
INSERT INTO `estados` VALUES (6, 'Bolívar', 'VE-F');
INSERT INTO `estados` VALUES (7, 'Carabobo', 'VE-G');
INSERT INTO `estados` VALUES (8, 'Cojedes', 'VE-H');
INSERT INTO `estados` VALUES (9, 'Delta Amacuro', 'VE-Y');
INSERT INTO `estados` VALUES (10, 'Falcón', 'VE-I');
INSERT INTO `estados` VALUES (11, 'Guárico', 'VE-J');
INSERT INTO `estados` VALUES (12, 'Lara', 'VE-K');
INSERT INTO `estados` VALUES (13, 'Mérida', 'VE-L');
INSERT INTO `estados` VALUES (14, 'Miranda', 'VE-M');
INSERT INTO `estados` VALUES (15, 'Monagas', 'VE-N');
INSERT INTO `estados` VALUES (16, 'Nueva Esparta', 'VE-O');
INSERT INTO `estados` VALUES (17, 'Portuguesa', 'VE-P');
INSERT INTO `estados` VALUES (18, 'Sucre', 'VE-R');
INSERT INTO `estados` VALUES (19, 'Táchira', 'VE-S');
INSERT INTO `estados` VALUES (20, 'Trujillo', 'VE-T');
INSERT INTO `estados` VALUES (21, 'La Guaira', 'VE-W');
INSERT INTO `estados` VALUES (22, 'Yaracuy', 'VE-U');
INSERT INTO `estados` VALUES (23, 'Zulia', 'VE-V');
INSERT INTO `estados` VALUES (24, 'Distrito Capital', 'VE-A');
INSERT INTO `estados` VALUES (25, 'Dependencias Federales', 'VE-Z');

-- ----------------------------
-- Table structure for examenes
-- ----------------------------
DROP TABLE IF EXISTS `examenes`;
CREATE TABLE `examenes`  (
  `id_examen` int NOT NULL AUTO_INCREMENT,
  `id_diagnostico` int NULL DEFAULT NULL,
  `examen` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `documento` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_examen`) USING BTREE,
  INDEX `id_diagnostico`(`id_diagnostico`) USING BTREE,
  CONSTRAINT `examenes_ibfk_1` FOREIGN KEY (`id_diagnostico`) REFERENCES `diagnosticos` (`id_diagnostico`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of examenes
-- ----------------------------

-- ----------------------------
-- Table structure for generos
-- ----------------------------
DROP TABLE IF EXISTS `generos`;
CREATE TABLE `generos`  (
  `id_genero` int NOT NULL AUTO_INCREMENT,
  `genero` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_genero`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of generos
-- ----------------------------
INSERT INTO `generos` VALUES (1, 'Femenino');
INSERT INTO `generos` VALUES (2, 'Masculino');

-- ----------------------------
-- Table structure for horarios
-- ----------------------------
DROP TABLE IF EXISTS `horarios`;
CREATE TABLE `horarios`  (
  `id_horario` int NOT NULL AUTO_INCREMENT,
  `id_disponibilidad` int NULL DEFAULT NULL,
  `dia` int NULL DEFAULT NULL,
  `hora_inicio` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hora_final` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_horario`) USING BTREE,
  INDEX `id_disponibilidad`(`id_disponibilidad`) USING BTREE,
  CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`id_disponibilidad`) REFERENCES `disponibilidad` (`id_disponibilidad`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of horarios
-- ----------------------------
INSERT INTO `horarios` VALUES (1, 2, 1, '08:00', '12:00', '1', '2023-11-24 11:58:22');
INSERT INTO `horarios` VALUES (2, 2, 3, NULL, NULL, '1', '2023-11-24 11:58:22');
INSERT INTO `horarios` VALUES (3, 3, 2, '08:00', '12:00', '1', '2023-11-24 12:00:22');
INSERT INTO `horarios` VALUES (4, 3, 4, '08:00', '12:00', '1', '2023-11-24 12:00:22');
INSERT INTO `horarios` VALUES (6, NULL, 1, '08:00', '12:00', '1', '2023-11-24 13:29:55');
INSERT INTO `horarios` VALUES (7, NULL, 1, '08:00', '12:00', '1', '2023-11-24 13:30:25');
INSERT INTO `horarios` VALUES (14, 4, 4, '06:00', '10:00', '1', '2023-11-24 14:44:37');
INSERT INTO `horarios` VALUES (15, 1, 1, '12:00', '15:00', '1', '2023-11-24 15:12:04');
INSERT INTO `horarios` VALUES (22, 5, 1, '08:00', '12:00', '1', '2023-11-25 07:00:27');
INSERT INTO `horarios` VALUES (23, 5, 3, '12:00', '15:00', '1', '2023-11-25 07:00:27');
INSERT INTO `horarios` VALUES (27, 6, 1, '08:00', '12:00', '1', '2023-11-25 07:27:22');
INSERT INTO `horarios` VALUES (28, 6, 3, '08:00', '12:00', '1', '2023-11-25 07:27:22');
INSERT INTO `horarios` VALUES (33, 7, 1, '08:00', '12:00', '1', '2023-11-25 07:41:04');
INSERT INTO `horarios` VALUES (34, 7, 3, '08:00', '12:00', '1', '2023-11-25 07:41:04');
INSERT INTO `horarios` VALUES (35, 7, 5, '12:00', '15:00', '1', '2023-11-25 07:41:04');

-- ----------------------------
-- Table structure for instituciones
-- ----------------------------
DROP TABLE IF EXISTS `instituciones`;
CREATE TABLE `instituciones`  (
  `id_institucion` int NOT NULL AUTO_INCREMENT,
  `id_tipo_persona` int NULL DEFAULT NULL,
  `rif` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `institucion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tlf` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_estado` int NULL DEFAULT NULL,
  `id_municipio` int NULL DEFAULT NULL,
  `id_parroquia` int NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `latitud` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `longitud` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `logo` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_institucion`) USING BTREE,
  INDEX `id_tipo_persona`(`id_tipo_persona`) USING BTREE,
  INDEX `id_estado`(`id_estado`) USING BTREE,
  INDEX `id_municipio`(`id_municipio`) USING BTREE,
  INDEX `id_parroquia`(`id_parroquia`) USING BTREE,
  CONSTRAINT `instituciones_ibfk_1` FOREIGN KEY (`id_tipo_persona`) REFERENCES `tipos_persona` (`id_tipo_persona`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `instituciones_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `instituciones_ibfk_3` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `instituciones_ibfk_4` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id_parroquia`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of instituciones
-- ----------------------------
INSERT INTO `instituciones` VALUES (1, 4, '20002407-0', 'Hospital Central de Maracay (HCM)', 'hcmaragua@correo.com', '0243-2427087', 4, 36, 113, 'Av. José María Vargas c/c Av. Sucre., Urb. La Floresta, Maracay', NULL, NULL, NULL, '1', '2023-11-21 07:21:14');
INSERT INTO `instituciones` VALUES (2, 4, '20002385-6', 'Hospital Dr. José María Benítez', 'jmbenitez_hospital_al_dia@hotmail.com', '0244-3210445', 4, 41, 123, 'Av. 1 de Las Mercedes, Sector 1, La Victoria', NULL, NULL, NULL, '1', '2023-11-21 07:22:23');
INSERT INTO `instituciones` VALUES (3, 3, '1234567', 'Hospital de prueba', 'Correo@corre.com', '0412-1234567', 4, 41, 122, 'La victoria ', NULL, NULL, NULL, '0', '2023-11-25 06:42:26');

-- ----------------------------
-- Table structure for insumos
-- ----------------------------
DROP TABLE IF EXISTS `insumos`;
CREATE TABLE `insumos`  (
  `id_insumo` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `insumo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_unidad_medida` int NULL DEFAULT NULL,
  `presentacion` decimal(11, 2) NULL DEFAULT NULL,
  `minimo` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `imagen` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_insumo`) USING BTREE,
  INDEX `id_unidad_medida`(`id_unidad_medida`) USING BTREE,
  CONSTRAINT `insumos_ibfk_1` FOREIGN KEY (`id_unidad_medida`) REFERENCES `unidades_medida` (`id_unidad_medida`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of insumos
-- ----------------------------
INSERT INTO `insumos` VALUES (1, 'COD-0', 'Guantes nro 7', 1, 2.00, NULL, 'Guantes quirugicos', NULL, '1', '2023-11-26 23:15:55');
INSERT INTO `insumos` VALUES (2, 'COD-1', 'Inyectadora', 5, 10.00, NULL, '', NULL, '1', '2023-11-26 23:16:50');
INSERT INTO `insumos` VALUES (3, 'COD-2', 'Solucion 0.9', 3, 100.00, NULL, '', NULL, '1', '2023-11-26 23:17:32');
INSERT INTO `insumos` VALUES (4, 'COD-3', 'Gasa esteril', 4, 1000.00, NULL, '', NULL, '1', '2023-11-26 23:20:50');
INSERT INTO `insumos` VALUES (5, 'COD-4', 'Tiras reactivas', 1, 1.00, NULL, '', NULL, '1', '2023-11-26 23:21:38');
INSERT INTO `insumos` VALUES (6, 'COD-5', 'Acetaminofen', 2, 500.00, NULL, '', NULL, '1', '2023-11-26 23:22:01');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `menu` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `orden` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Registros', 1);
INSERT INTO `menu` VALUES (2, 'Historial clínico', 2);
INSERT INTO `menu` VALUES (3, 'Citas en especialidades', 3);
INSERT INTO `menu` VALUES (4, 'Planificación de cirugías', 4);
INSERT INTO `menu` VALUES (5, 'Gestión de Insumos', 5);
INSERT INTO `menu` VALUES (6, 'Seguridad', 6);

-- ----------------------------
-- Table structure for municipios
-- ----------------------------
DROP TABLE IF EXISTS `municipios`;
CREATE TABLE `municipios`  (
  `id_municipio` int NOT NULL AUTO_INCREMENT,
  `id_estado` int NOT NULL,
  `municipio` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_municipio`) USING BTREE,
  INDEX `id_estado`(`id_estado`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 463 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of municipios
-- ----------------------------
INSERT INTO `municipios` VALUES (1, 1, 'Alto Orinoco');
INSERT INTO `municipios` VALUES (2, 1, 'Atabapo');
INSERT INTO `municipios` VALUES (3, 1, 'Atures');
INSERT INTO `municipios` VALUES (4, 1, 'Autana');
INSERT INTO `municipios` VALUES (5, 1, 'Manapiare');
INSERT INTO `municipios` VALUES (6, 1, 'Maroa');
INSERT INTO `municipios` VALUES (7, 1, 'Río Negro');
INSERT INTO `municipios` VALUES (8, 2, 'Anaco');
INSERT INTO `municipios` VALUES (9, 2, 'Aragua');
INSERT INTO `municipios` VALUES (10, 2, 'Manuel Ezequiel Bruzual');
INSERT INTO `municipios` VALUES (11, 2, 'Diego Bautista Urbaneja');
INSERT INTO `municipios` VALUES (12, 2, 'Fernando Peñalver');
INSERT INTO `municipios` VALUES (13, 2, 'Francisco Del Carmen Carvajal');
INSERT INTO `municipios` VALUES (14, 2, 'General Sir Arthur McGregor');
INSERT INTO `municipios` VALUES (15, 2, 'Guanta');
INSERT INTO `municipios` VALUES (16, 2, 'Independencia');
INSERT INTO `municipios` VALUES (17, 2, 'José Gregorio Monagas');
INSERT INTO `municipios` VALUES (18, 2, 'Juan Antonio Sotillo');
INSERT INTO `municipios` VALUES (19, 2, 'Juan Manuel Cajigal');
INSERT INTO `municipios` VALUES (20, 2, 'Libertad');
INSERT INTO `municipios` VALUES (21, 2, 'Francisco de Miranda');
INSERT INTO `municipios` VALUES (22, 2, 'Pedro María Freites');
INSERT INTO `municipios` VALUES (23, 2, 'Píritu');
INSERT INTO `municipios` VALUES (24, 2, 'San José de Guanipa');
INSERT INTO `municipios` VALUES (25, 2, 'San Juan de Capistrano');
INSERT INTO `municipios` VALUES (26, 2, 'Santa Ana');
INSERT INTO `municipios` VALUES (27, 2, 'Simón Bolívar');
INSERT INTO `municipios` VALUES (28, 2, 'Simón Rodríguez');
INSERT INTO `municipios` VALUES (29, 3, 'Achaguas');
INSERT INTO `municipios` VALUES (30, 3, 'Biruaca');
INSERT INTO `municipios` VALUES (31, 3, 'Muñóz');
INSERT INTO `municipios` VALUES (32, 3, 'Páez');
INSERT INTO `municipios` VALUES (33, 3, 'Pedro Camejo');
INSERT INTO `municipios` VALUES (34, 3, 'Rómulo Gallegos');
INSERT INTO `municipios` VALUES (35, 3, 'San Fernando');
INSERT INTO `municipios` VALUES (36, 4, 'Atanasio Girardot');
INSERT INTO `municipios` VALUES (37, 4, 'Bolívar');
INSERT INTO `municipios` VALUES (38, 4, 'Camatagua');
INSERT INTO `municipios` VALUES (39, 4, 'Francisco Linares Alcántara');
INSERT INTO `municipios` VALUES (40, 4, 'José Ángel Lamas');
INSERT INTO `municipios` VALUES (41, 4, 'José Félix Ribas');
INSERT INTO `municipios` VALUES (42, 4, 'José Rafael Revenga');
INSERT INTO `municipios` VALUES (43, 4, 'Libertador');
INSERT INTO `municipios` VALUES (44, 4, 'Mario Briceño Iragorry');
INSERT INTO `municipios` VALUES (45, 4, 'Ocumare de la Costa de Oro');
INSERT INTO `municipios` VALUES (46, 4, 'San Casimiro');
INSERT INTO `municipios` VALUES (47, 4, 'San Sebastián');
INSERT INTO `municipios` VALUES (48, 4, 'Santiago Mariño');
INSERT INTO `municipios` VALUES (49, 4, 'Santos Michelena');
INSERT INTO `municipios` VALUES (50, 4, 'Sucre');
INSERT INTO `municipios` VALUES (51, 4, 'Tovar');
INSERT INTO `municipios` VALUES (52, 4, 'Urdaneta');
INSERT INTO `municipios` VALUES (53, 4, 'Zamora');
INSERT INTO `municipios` VALUES (54, 5, 'Alberto Arvelo Torrealba');
INSERT INTO `municipios` VALUES (55, 5, 'Andrés Eloy Blanco');
INSERT INTO `municipios` VALUES (56, 5, 'Antonio José de Sucre');
INSERT INTO `municipios` VALUES (57, 5, 'Arismendi');
INSERT INTO `municipios` VALUES (58, 5, 'Barinas');
INSERT INTO `municipios` VALUES (59, 5, 'Bolívar');
INSERT INTO `municipios` VALUES (60, 5, 'Cruz Paredes');
INSERT INTO `municipios` VALUES (61, 5, 'Ezequiel Zamora');
INSERT INTO `municipios` VALUES (62, 5, 'Obispos');
INSERT INTO `municipios` VALUES (63, 5, 'Pedraza');
INSERT INTO `municipios` VALUES (64, 5, 'Rojas');
INSERT INTO `municipios` VALUES (65, 5, 'Sosa');
INSERT INTO `municipios` VALUES (66, 6, 'Caroní');
INSERT INTO `municipios` VALUES (67, 6, 'Cedeño');
INSERT INTO `municipios` VALUES (68, 6, 'El Callao');
INSERT INTO `municipios` VALUES (69, 6, 'Gran Sabana');
INSERT INTO `municipios` VALUES (70, 6, 'Heres');
INSERT INTO `municipios` VALUES (71, 6, 'Piar');
INSERT INTO `municipios` VALUES (72, 6, 'Angostura (Raúl Leoni)');
INSERT INTO `municipios` VALUES (73, 6, 'Roscio');
INSERT INTO `municipios` VALUES (74, 6, 'Sifontes');
INSERT INTO `municipios` VALUES (75, 6, 'Sucre');
INSERT INTO `municipios` VALUES (76, 6, 'Padre Pedro Chien');
INSERT INTO `municipios` VALUES (77, 7, 'Bejuma');
INSERT INTO `municipios` VALUES (78, 7, 'Carlos Arvelo');
INSERT INTO `municipios` VALUES (79, 7, 'Diego Ibarra');
INSERT INTO `municipios` VALUES (80, 7, 'Guacara');
INSERT INTO `municipios` VALUES (81, 7, 'Juan José Mora');
INSERT INTO `municipios` VALUES (82, 7, 'Libertador');
INSERT INTO `municipios` VALUES (83, 7, 'Los Guayos');
INSERT INTO `municipios` VALUES (84, 7, 'Miranda');
INSERT INTO `municipios` VALUES (85, 7, 'Montalbán');
INSERT INTO `municipios` VALUES (86, 7, 'Naguanagua');
INSERT INTO `municipios` VALUES (87, 7, 'Puerto Cabello');
INSERT INTO `municipios` VALUES (88, 7, 'San Diego');
INSERT INTO `municipios` VALUES (89, 7, 'San Joaquín');
INSERT INTO `municipios` VALUES (90, 7, 'Valencia');
INSERT INTO `municipios` VALUES (91, 8, 'Anzoátegui');
INSERT INTO `municipios` VALUES (92, 8, 'Tinaquillo');
INSERT INTO `municipios` VALUES (93, 8, 'Girardot');
INSERT INTO `municipios` VALUES (94, 8, 'Lima Blanco');
INSERT INTO `municipios` VALUES (95, 8, 'Pao de San Juan Bautista');
INSERT INTO `municipios` VALUES (96, 8, 'Ricaurte');
INSERT INTO `municipios` VALUES (97, 8, 'Rómulo Gallegos');
INSERT INTO `municipios` VALUES (98, 8, 'San Carlos');
INSERT INTO `municipios` VALUES (99, 8, 'Tinaco');
INSERT INTO `municipios` VALUES (100, 9, 'Antonio Díaz');
INSERT INTO `municipios` VALUES (101, 9, 'Casacoima');
INSERT INTO `municipios` VALUES (102, 9, 'Pedernales');
INSERT INTO `municipios` VALUES (103, 9, 'Tucupita');
INSERT INTO `municipios` VALUES (104, 10, 'Acosta');
INSERT INTO `municipios` VALUES (105, 10, 'Bolívar');
INSERT INTO `municipios` VALUES (106, 10, 'Buchivacoa');
INSERT INTO `municipios` VALUES (107, 10, 'Cacique Manaure');
INSERT INTO `municipios` VALUES (108, 10, 'Carirubana');
INSERT INTO `municipios` VALUES (109, 10, 'Colina');
INSERT INTO `municipios` VALUES (110, 10, 'Dabajuro');
INSERT INTO `municipios` VALUES (111, 10, 'Democracia');
INSERT INTO `municipios` VALUES (112, 10, 'Falcón');
INSERT INTO `municipios` VALUES (113, 10, 'Federación');
INSERT INTO `municipios` VALUES (114, 10, 'Jacura');
INSERT INTO `municipios` VALUES (115, 10, 'José Laurencio Silva');
INSERT INTO `municipios` VALUES (116, 10, 'Los Taques');
INSERT INTO `municipios` VALUES (117, 10, 'Mauroa');
INSERT INTO `municipios` VALUES (118, 10, 'Miranda');
INSERT INTO `municipios` VALUES (119, 10, 'Monseñor Iturriza');
INSERT INTO `municipios` VALUES (120, 10, 'Palmasola');
INSERT INTO `municipios` VALUES (121, 10, 'Petit');
INSERT INTO `municipios` VALUES (122, 10, 'Píritu');
INSERT INTO `municipios` VALUES (123, 10, 'San Francisco');
INSERT INTO `municipios` VALUES (124, 10, 'Sucre');
INSERT INTO `municipios` VALUES (125, 10, 'Tocópero');
INSERT INTO `municipios` VALUES (126, 10, 'Unión');
INSERT INTO `municipios` VALUES (127, 10, 'Urumaco');
INSERT INTO `municipios` VALUES (128, 10, 'Zamora');
INSERT INTO `municipios` VALUES (129, 11, 'Camaguán');
INSERT INTO `municipios` VALUES (130, 11, 'Chaguaramas');
INSERT INTO `municipios` VALUES (131, 11, 'El Socorro');
INSERT INTO `municipios` VALUES (132, 11, 'José Félix Ribas');
INSERT INTO `municipios` VALUES (133, 11, 'José Tadeo Monagas');
INSERT INTO `municipios` VALUES (134, 11, 'Juan Germán Roscio');
INSERT INTO `municipios` VALUES (135, 11, 'Julián Mellado');
INSERT INTO `municipios` VALUES (136, 11, 'Las Mercedes');
INSERT INTO `municipios` VALUES (137, 11, 'Leonardo Infante');
INSERT INTO `municipios` VALUES (138, 11, 'Pedro Zaraza');
INSERT INTO `municipios` VALUES (139, 11, 'Ortíz');
INSERT INTO `municipios` VALUES (140, 11, 'San Gerónimo de Guayabal');
INSERT INTO `municipios` VALUES (141, 11, 'San José de Guaribe');
INSERT INTO `municipios` VALUES (142, 11, 'Santa María de Ipire');
INSERT INTO `municipios` VALUES (143, 11, 'Sebastián Francisco de Miranda');
INSERT INTO `municipios` VALUES (144, 12, 'Andrés Eloy Blanco');
INSERT INTO `municipios` VALUES (145, 12, 'Crespo');
INSERT INTO `municipios` VALUES (146, 12, 'Iribarren');
INSERT INTO `municipios` VALUES (147, 12, 'Jiménez');
INSERT INTO `municipios` VALUES (148, 12, 'Morán');
INSERT INTO `municipios` VALUES (149, 12, 'Palavecino');
INSERT INTO `municipios` VALUES (150, 12, 'Simón Planas');
INSERT INTO `municipios` VALUES (151, 12, 'Torres');
INSERT INTO `municipios` VALUES (152, 12, 'Urdaneta');
INSERT INTO `municipios` VALUES (179, 13, 'Alberto Adriani');
INSERT INTO `municipios` VALUES (180, 13, 'Andrés Bello');
INSERT INTO `municipios` VALUES (181, 13, 'Antonio Pinto Salinas');
INSERT INTO `municipios` VALUES (182, 13, 'Aricagua');
INSERT INTO `municipios` VALUES (183, 13, 'Arzobispo Chacón');
INSERT INTO `municipios` VALUES (184, 13, 'Campo Elías');
INSERT INTO `municipios` VALUES (185, 13, 'Caracciolo Parra Olmedo');
INSERT INTO `municipios` VALUES (186, 13, 'Cardenal Quintero');
INSERT INTO `municipios` VALUES (187, 13, 'Guaraque');
INSERT INTO `municipios` VALUES (188, 13, 'Julio César Salas');
INSERT INTO `municipios` VALUES (189, 13, 'Justo Briceño');
INSERT INTO `municipios` VALUES (190, 13, 'Libertador');
INSERT INTO `municipios` VALUES (191, 13, 'Miranda');
INSERT INTO `municipios` VALUES (192, 13, 'Obispo Ramos de Lora');
INSERT INTO `municipios` VALUES (193, 13, 'Padre Noguera');
INSERT INTO `municipios` VALUES (194, 13, 'Pueblo Llano');
INSERT INTO `municipios` VALUES (195, 13, 'Rangel');
INSERT INTO `municipios` VALUES (196, 13, 'Rivas Dávila');
INSERT INTO `municipios` VALUES (197, 13, 'Santos Marquina');
INSERT INTO `municipios` VALUES (198, 13, 'Sucre');
INSERT INTO `municipios` VALUES (199, 13, 'Tovar');
INSERT INTO `municipios` VALUES (200, 13, 'Tulio Febres Cordero');
INSERT INTO `municipios` VALUES (201, 13, 'Zea');
INSERT INTO `municipios` VALUES (223, 14, 'Acevedo');
INSERT INTO `municipios` VALUES (224, 14, 'Andrés Bello');
INSERT INTO `municipios` VALUES (225, 14, 'Baruta');
INSERT INTO `municipios` VALUES (226, 14, 'Brión');
INSERT INTO `municipios` VALUES (227, 14, 'Buroz');
INSERT INTO `municipios` VALUES (228, 14, 'Carrizal');
INSERT INTO `municipios` VALUES (229, 14, 'Chacao');
INSERT INTO `municipios` VALUES (230, 14, 'Cristóbal Rojas');
INSERT INTO `municipios` VALUES (231, 14, 'El Hatillo');
INSERT INTO `municipios` VALUES (232, 14, 'Guaicaipuro');
INSERT INTO `municipios` VALUES (233, 14, 'Independencia');
INSERT INTO `municipios` VALUES (234, 14, 'Lander');
INSERT INTO `municipios` VALUES (235, 14, 'Los Salias');
INSERT INTO `municipios` VALUES (236, 14, 'Páez');
INSERT INTO `municipios` VALUES (237, 14, 'Paz Castillo');
INSERT INTO `municipios` VALUES (238, 14, 'Pedro Gual');
INSERT INTO `municipios` VALUES (239, 14, 'Plaza');
INSERT INTO `municipios` VALUES (240, 14, 'Simón Bolívar');
INSERT INTO `municipios` VALUES (241, 14, 'Sucre');
INSERT INTO `municipios` VALUES (242, 14, 'Urdaneta');
INSERT INTO `municipios` VALUES (243, 14, 'Zamora');
INSERT INTO `municipios` VALUES (258, 15, 'Acosta');
INSERT INTO `municipios` VALUES (259, 15, 'Aguasay');
INSERT INTO `municipios` VALUES (260, 15, 'Bolívar');
INSERT INTO `municipios` VALUES (261, 15, 'Caripe');
INSERT INTO `municipios` VALUES (262, 15, 'Cedeño');
INSERT INTO `municipios` VALUES (263, 15, 'Ezequiel Zamora');
INSERT INTO `municipios` VALUES (264, 15, 'Libertador');
INSERT INTO `municipios` VALUES (265, 15, 'Maturín');
INSERT INTO `municipios` VALUES (266, 15, 'Piar');
INSERT INTO `municipios` VALUES (267, 15, 'Punceres');
INSERT INTO `municipios` VALUES (268, 15, 'Santa Bárbara');
INSERT INTO `municipios` VALUES (269, 15, 'Sotillo');
INSERT INTO `municipios` VALUES (270, 15, 'Uracoa');
INSERT INTO `municipios` VALUES (271, 16, 'Antolín del Campo');
INSERT INTO `municipios` VALUES (272, 16, 'Arismendi');
INSERT INTO `municipios` VALUES (273, 16, 'García');
INSERT INTO `municipios` VALUES (274, 16, 'Gómez');
INSERT INTO `municipios` VALUES (275, 16, 'Maneiro');
INSERT INTO `municipios` VALUES (276, 16, 'Marcano');
INSERT INTO `municipios` VALUES (277, 16, 'Mariño');
INSERT INTO `municipios` VALUES (278, 16, 'Península de Macanao');
INSERT INTO `municipios` VALUES (279, 16, 'Tubores');
INSERT INTO `municipios` VALUES (280, 16, 'Villalba');
INSERT INTO `municipios` VALUES (281, 16, 'Díaz');
INSERT INTO `municipios` VALUES (282, 17, 'Agua Blanca');
INSERT INTO `municipios` VALUES (283, 17, 'Araure');
INSERT INTO `municipios` VALUES (284, 17, 'Esteller');
INSERT INTO `municipios` VALUES (285, 17, 'Guanare');
INSERT INTO `municipios` VALUES (286, 17, 'Guanarito');
INSERT INTO `municipios` VALUES (287, 17, 'Monseñor José Vicente de Unda');
INSERT INTO `municipios` VALUES (288, 17, 'Ospino');
INSERT INTO `municipios` VALUES (289, 17, 'Páez');
INSERT INTO `municipios` VALUES (290, 17, 'Papelón');
INSERT INTO `municipios` VALUES (291, 17, 'San Genaro de Boconoíto');
INSERT INTO `municipios` VALUES (292, 17, 'San Rafael de Onoto');
INSERT INTO `municipios` VALUES (293, 17, 'Santa Rosalía');
INSERT INTO `municipios` VALUES (294, 17, 'Sucre');
INSERT INTO `municipios` VALUES (295, 17, 'Turén');
INSERT INTO `municipios` VALUES (296, 18, 'Andrés Eloy Blanco');
INSERT INTO `municipios` VALUES (297, 18, 'Andrés Mata');
INSERT INTO `municipios` VALUES (298, 18, 'Arismendi');
INSERT INTO `municipios` VALUES (299, 18, 'Benítez');
INSERT INTO `municipios` VALUES (300, 18, 'Bermúdez');
INSERT INTO `municipios` VALUES (301, 18, 'Bolívar');
INSERT INTO `municipios` VALUES (302, 18, 'Cajigal');
INSERT INTO `municipios` VALUES (303, 18, 'Cruz Salmerón Acosta');
INSERT INTO `municipios` VALUES (304, 18, 'Libertador');
INSERT INTO `municipios` VALUES (305, 18, 'Mariño');
INSERT INTO `municipios` VALUES (306, 18, 'Mejía');
INSERT INTO `municipios` VALUES (307, 18, 'Montes');
INSERT INTO `municipios` VALUES (308, 18, 'Ribero');
INSERT INTO `municipios` VALUES (309, 18, 'Sucre');
INSERT INTO `municipios` VALUES (310, 18, 'Valdéz');
INSERT INTO `municipios` VALUES (341, 19, 'Andrés Bello');
INSERT INTO `municipios` VALUES (342, 19, 'Antonio Rómulo Costa');
INSERT INTO `municipios` VALUES (343, 19, 'Ayacucho');
INSERT INTO `municipios` VALUES (344, 19, 'Bolívar');
INSERT INTO `municipios` VALUES (345, 19, 'Cárdenas');
INSERT INTO `municipios` VALUES (346, 19, 'Córdoba');
INSERT INTO `municipios` VALUES (347, 19, 'Fernández Feo');
INSERT INTO `municipios` VALUES (348, 19, 'Francisco de Miranda');
INSERT INTO `municipios` VALUES (349, 19, 'García de Hevia');
INSERT INTO `municipios` VALUES (350, 19, 'Guásimos');
INSERT INTO `municipios` VALUES (351, 19, 'Independencia');
INSERT INTO `municipios` VALUES (352, 19, 'Jáuregui');
INSERT INTO `municipios` VALUES (353, 19, 'José María Vargas');
INSERT INTO `municipios` VALUES (354, 19, 'Junín');
INSERT INTO `municipios` VALUES (355, 19, 'Libertad');
INSERT INTO `municipios` VALUES (356, 19, 'Libertador');
INSERT INTO `municipios` VALUES (357, 19, 'Lobatera');
INSERT INTO `municipios` VALUES (358, 19, 'Michelena');
INSERT INTO `municipios` VALUES (359, 19, 'Panamericano');
INSERT INTO `municipios` VALUES (360, 19, 'Pedro María Ureña');
INSERT INTO `municipios` VALUES (361, 19, 'Rafael Urdaneta');
INSERT INTO `municipios` VALUES (362, 19, 'Samuel Darío Maldonado');
INSERT INTO `municipios` VALUES (363, 19, 'San Cristóbal');
INSERT INTO `municipios` VALUES (364, 19, 'Seboruco');
INSERT INTO `municipios` VALUES (365, 19, 'Simón Rodríguez');
INSERT INTO `municipios` VALUES (366, 19, 'Sucre');
INSERT INTO `municipios` VALUES (367, 19, 'Torbes');
INSERT INTO `municipios` VALUES (368, 19, 'Uribante');
INSERT INTO `municipios` VALUES (369, 19, 'San Judas Tadeo');
INSERT INTO `municipios` VALUES (370, 20, 'Andrés Bello');
INSERT INTO `municipios` VALUES (371, 20, 'Boconó');
INSERT INTO `municipios` VALUES (372, 20, 'Bolívar');
INSERT INTO `municipios` VALUES (373, 20, 'Candelaria');
INSERT INTO `municipios` VALUES (374, 20, 'Carache');
INSERT INTO `municipios` VALUES (375, 20, 'Escuque');
INSERT INTO `municipios` VALUES (376, 20, 'José Felipe Márquez Cañizalez');
INSERT INTO `municipios` VALUES (377, 20, 'Juan Vicente Campos Elías');
INSERT INTO `municipios` VALUES (378, 20, 'La Ceiba');
INSERT INTO `municipios` VALUES (379, 20, 'Miranda');
INSERT INTO `municipios` VALUES (380, 20, 'Monte Carmelo');
INSERT INTO `municipios` VALUES (381, 20, 'Motatán');
INSERT INTO `municipios` VALUES (382, 20, 'Pampán');
INSERT INTO `municipios` VALUES (383, 20, 'Pampanito');
INSERT INTO `municipios` VALUES (384, 20, 'Rafael Rangel');
INSERT INTO `municipios` VALUES (385, 20, 'San Rafael de Carvajal');
INSERT INTO `municipios` VALUES (386, 20, 'Sucre');
INSERT INTO `municipios` VALUES (387, 20, 'Trujillo');
INSERT INTO `municipios` VALUES (388, 20, 'Urdaneta');
INSERT INTO `municipios` VALUES (389, 20, 'Valera');
INSERT INTO `municipios` VALUES (390, 21, 'Vargas');
INSERT INTO `municipios` VALUES (391, 22, 'Arístides Bastidas');
INSERT INTO `municipios` VALUES (392, 22, 'Bolívar');
INSERT INTO `municipios` VALUES (407, 22, 'Bruzual');
INSERT INTO `municipios` VALUES (408, 22, 'Cocorote');
INSERT INTO `municipios` VALUES (409, 22, 'Independencia');
INSERT INTO `municipios` VALUES (410, 22, 'José Antonio Páez');
INSERT INTO `municipios` VALUES (411, 22, 'La Trinidad');
INSERT INTO `municipios` VALUES (412, 22, 'Manuel Monge');
INSERT INTO `municipios` VALUES (413, 22, 'Nirgua');
INSERT INTO `municipios` VALUES (414, 22, 'Peña');
INSERT INTO `municipios` VALUES (415, 22, 'San Felipe');
INSERT INTO `municipios` VALUES (416, 22, 'Sucre');
INSERT INTO `municipios` VALUES (417, 22, 'Urachiche');
INSERT INTO `municipios` VALUES (418, 22, 'José Joaquín Veroes');
INSERT INTO `municipios` VALUES (441, 23, 'Almirante Padilla');
INSERT INTO `municipios` VALUES (442, 23, 'Baralt');
INSERT INTO `municipios` VALUES (443, 23, 'Cabimas');
INSERT INTO `municipios` VALUES (444, 23, 'Catatumbo');
INSERT INTO `municipios` VALUES (445, 23, 'Colón');
INSERT INTO `municipios` VALUES (446, 23, 'Francisco Javier Pulgar');
INSERT INTO `municipios` VALUES (447, 23, 'Páez');
INSERT INTO `municipios` VALUES (448, 23, 'Jesús Enrique Losada');
INSERT INTO `municipios` VALUES (449, 23, 'Jesús María Semprún');
INSERT INTO `municipios` VALUES (450, 23, 'La Cañada de Urdaneta');
INSERT INTO `municipios` VALUES (451, 23, 'Lagunillas');
INSERT INTO `municipios` VALUES (452, 23, 'Machiques de Perijá');
INSERT INTO `municipios` VALUES (453, 23, 'Mara');
INSERT INTO `municipios` VALUES (454, 23, 'Maracaibo');
INSERT INTO `municipios` VALUES (455, 23, 'Miranda');
INSERT INTO `municipios` VALUES (456, 23, 'Rosario de Perijá');
INSERT INTO `municipios` VALUES (457, 23, 'San Francisco');
INSERT INTO `municipios` VALUES (458, 23, 'Santa Rita');
INSERT INTO `municipios` VALUES (459, 23, 'Simón Bolívar');
INSERT INTO `municipios` VALUES (460, 23, 'Sucre');
INSERT INTO `municipios` VALUES (461, 23, 'Valmore Rodríguez');
INSERT INTO `municipios` VALUES (462, 24, 'Libertador');

-- ----------------------------
-- Table structure for pacientes
-- ----------------------------
DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE `pacientes`  (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `id_tipo_persona` int NULL DEFAULT NULL,
  `cedula` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nombres` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_nacimiento` date NULL DEFAULT NULL,
  `id_genero` int NULL DEFAULT NULL,
  `id_estado` int NULL DEFAULT NULL,
  `id_municipio` int NULL DEFAULT NULL,
  `id_parroquia` int NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_paciente`) USING BTREE,
  INDEX `id_genero`(`id_genero`) USING BTREE,
  INDEX `id_estado`(`id_estado`) USING BTREE,
  INDEX `id_municipio`(`id_municipio`) USING BTREE,
  INDEX `id_parroquia`(`id_parroquia`) USING BTREE,
  INDEX `id_tipo_persona`(`id_tipo_persona`) USING BTREE,
  CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pacientes_ibfk_3` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pacientes_ibfk_4` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id_parroquia`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pacientes_ibfk_5` FOREIGN KEY (`id_tipo_persona`) REFERENCES `tipos_persona` (`id_tipo_persona`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pacientes
-- ----------------------------
INSERT INTO `pacientes` VALUES (1, 1, '25880768', 'Gabriel', 'Hernandez', '1997-04-05', 2, 4, 41, 122, 'La victoria', '1', '2023-11-22 21:12:20');
INSERT INTO `pacientes` VALUES (2, 1, '123456', 'Miguel', 'Rodriguez', '2003-11-01', 2, 4, 36, 109, 'Maracay', '0', '2023-11-25 06:43:35');
INSERT INTO `pacientes` VALUES (3, 1, '258801', 'Pablo', 'Perez', '2023-11-25', 2, 4, 40, 121, 'Santa cruz', '1', '2023-11-25 07:29:16');
INSERT INTO `pacientes` VALUES (4, 1, '1111111', 'prueba', 'prueba', '2023-11-24', 2, 4, 38, 116, 'camatagua', '1', '2023-11-25 07:31:50');

-- ----------------------------
-- Table structure for paises
-- ----------------------------
DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises`  (
  `id_pais` int NOT NULL AUTO_INCREMENT,
  `iso` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pais` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pais`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 241 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of paises
-- ----------------------------
INSERT INTO `paises` VALUES (1, 'VE', 'Venezuela');
INSERT INTO `paises` VALUES (2, 'AX', 'Islas Gland');
INSERT INTO `paises` VALUES (3, 'AL', 'Albania');
INSERT INTO `paises` VALUES (4, 'DE', 'Alemania');
INSERT INTO `paises` VALUES (5, 'AD', 'Andorra');
INSERT INTO `paises` VALUES (6, 'AO', 'Angola');
INSERT INTO `paises` VALUES (7, 'AI', 'Anguilla');
INSERT INTO `paises` VALUES (8, 'AQ', 'Antártida');
INSERT INTO `paises` VALUES (9, 'AG', 'Antigua y Barbuda');
INSERT INTO `paises` VALUES (10, 'AN', 'Antillas Holandesas');
INSERT INTO `paises` VALUES (11, 'SA', 'Arabia Saudí');
INSERT INTO `paises` VALUES (12, 'DZ', 'Argelia');
INSERT INTO `paises` VALUES (13, 'AR', 'Argentina');
INSERT INTO `paises` VALUES (14, 'AM', 'Armenia');
INSERT INTO `paises` VALUES (15, 'AW', 'Aruba');
INSERT INTO `paises` VALUES (16, 'AU', 'Australia');
INSERT INTO `paises` VALUES (17, 'AT', 'Austria');
INSERT INTO `paises` VALUES (18, 'AZ', 'Azerbaiyán');
INSERT INTO `paises` VALUES (19, 'BS', 'Bahamas');
INSERT INTO `paises` VALUES (20, 'BH', 'Bahréin');
INSERT INTO `paises` VALUES (21, 'BD', 'Bangladesh');
INSERT INTO `paises` VALUES (22, 'BB', 'Barbados');
INSERT INTO `paises` VALUES (23, 'BY', 'Bielorrusia');
INSERT INTO `paises` VALUES (24, 'BE', 'Bélgica');
INSERT INTO `paises` VALUES (25, 'BZ', 'Belice');
INSERT INTO `paises` VALUES (26, 'BJ', 'Benin');
INSERT INTO `paises` VALUES (27, 'BM', 'Bermudas');
INSERT INTO `paises` VALUES (28, 'BT', 'Bhután');
INSERT INTO `paises` VALUES (29, 'BO', 'Bolivia');
INSERT INTO `paises` VALUES (30, 'BA', 'Bosnia y Herzegovina');
INSERT INTO `paises` VALUES (31, 'BW', 'Botsuana');
INSERT INTO `paises` VALUES (32, 'BV', 'Isla Bouvet');
INSERT INTO `paises` VALUES (33, 'BR', 'Brasil');
INSERT INTO `paises` VALUES (34, 'BN', 'Brunéi');
INSERT INTO `paises` VALUES (35, 'BG', 'Bulgaria');
INSERT INTO `paises` VALUES (36, 'BF', 'Burkina Faso');
INSERT INTO `paises` VALUES (37, 'BI', 'Burundi');
INSERT INTO `paises` VALUES (38, 'CV', 'Cabo Verde');
INSERT INTO `paises` VALUES (39, 'KY', 'Islas Caimán');
INSERT INTO `paises` VALUES (40, 'KH', 'Camboya');
INSERT INTO `paises` VALUES (41, 'CM', 'Camerún');
INSERT INTO `paises` VALUES (42, 'CA', 'Canadá');
INSERT INTO `paises` VALUES (43, 'CF', 'República Centroafricana');
INSERT INTO `paises` VALUES (44, 'TD', 'Chad');
INSERT INTO `paises` VALUES (45, 'CZ', 'República Checa');
INSERT INTO `paises` VALUES (46, 'CL', 'Chile');
INSERT INTO `paises` VALUES (47, 'CN', 'China');
INSERT INTO `paises` VALUES (48, 'CY', 'Chipre');
INSERT INTO `paises` VALUES (49, 'CX', 'Isla de Navidad');
INSERT INTO `paises` VALUES (50, 'VA', 'Ciudad del Vaticano');
INSERT INTO `paises` VALUES (51, 'CC', 'Islas Cocos');
INSERT INTO `paises` VALUES (52, 'CO', 'Colombia');
INSERT INTO `paises` VALUES (53, 'KM', 'Comoras');
INSERT INTO `paises` VALUES (54, 'CD', 'República Democrática del Congo');
INSERT INTO `paises` VALUES (55, 'CG', 'Congo');
INSERT INTO `paises` VALUES (56, 'CK', 'Islas Cook');
INSERT INTO `paises` VALUES (57, 'KP', 'Corea del Norte');
INSERT INTO `paises` VALUES (58, 'KR', 'Corea del Sur');
INSERT INTO `paises` VALUES (59, 'CI', 'Costa de Marfil');
INSERT INTO `paises` VALUES (60, 'CR', 'Costa Rica');
INSERT INTO `paises` VALUES (61, 'HR', 'Croacia');
INSERT INTO `paises` VALUES (62, 'CU', 'Cuba');
INSERT INTO `paises` VALUES (63, 'DK', 'Dinamarca');
INSERT INTO `paises` VALUES (64, 'DM', 'Dominica');
INSERT INTO `paises` VALUES (65, 'DO', 'República Dominicana');
INSERT INTO `paises` VALUES (66, 'EC', 'Ecuador');
INSERT INTO `paises` VALUES (67, 'EG', 'Egipto');
INSERT INTO `paises` VALUES (68, 'SV', 'El Salvador');
INSERT INTO `paises` VALUES (69, 'AE', 'Emiratos Árabes Unidos');
INSERT INTO `paises` VALUES (70, 'ER', 'Eritrea');
INSERT INTO `paises` VALUES (71, 'SK', 'Eslovaquia');
INSERT INTO `paises` VALUES (72, 'SI', 'Eslovenia');
INSERT INTO `paises` VALUES (73, 'ES', 'España');
INSERT INTO `paises` VALUES (74, 'UM', 'Islas ultramarinas de Estados Unidos');
INSERT INTO `paises` VALUES (75, 'US', 'Estados Unidos');
INSERT INTO `paises` VALUES (76, 'EE', 'Estonia');
INSERT INTO `paises` VALUES (77, 'ET', 'Etiopía');
INSERT INTO `paises` VALUES (78, 'FO', 'Islas Feroe');
INSERT INTO `paises` VALUES (79, 'PH', 'Filipinas');
INSERT INTO `paises` VALUES (80, 'FI', 'Finlandia');
INSERT INTO `paises` VALUES (81, 'FJ', 'Fiyi');
INSERT INTO `paises` VALUES (82, 'FR', 'Francia');
INSERT INTO `paises` VALUES (83, 'GA', 'Gabón');
INSERT INTO `paises` VALUES (84, 'GM', 'Gambia');
INSERT INTO `paises` VALUES (85, 'GE', 'Georgia');
INSERT INTO `paises` VALUES (86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur');
INSERT INTO `paises` VALUES (87, 'GH', 'Ghana');
INSERT INTO `paises` VALUES (88, 'GI', 'Gibraltar');
INSERT INTO `paises` VALUES (89, 'GD', 'Granada');
INSERT INTO `paises` VALUES (90, 'GR', 'Grecia');
INSERT INTO `paises` VALUES (91, 'GL', 'Groenlandia');
INSERT INTO `paises` VALUES (92, 'GP', 'Guadalupe');
INSERT INTO `paises` VALUES (93, 'GU', 'Guam');
INSERT INTO `paises` VALUES (94, 'GT', 'Guatemala');
INSERT INTO `paises` VALUES (95, 'GF', 'Guayana Francesa');
INSERT INTO `paises` VALUES (96, 'GN', 'Guinea');
INSERT INTO `paises` VALUES (97, 'GQ', 'Guinea Ecuatorial');
INSERT INTO `paises` VALUES (98, 'GW', 'Guinea-Bissau');
INSERT INTO `paises` VALUES (99, 'GY', 'Guyana');
INSERT INTO `paises` VALUES (100, 'HT', 'Haití');
INSERT INTO `paises` VALUES (101, 'HM', 'Islas Heard y McDonald');
INSERT INTO `paises` VALUES (102, 'HN', 'Honduras');
INSERT INTO `paises` VALUES (103, 'HK', 'Hong Kong');
INSERT INTO `paises` VALUES (104, 'HU', 'Hungría');
INSERT INTO `paises` VALUES (105, 'IN', 'India');
INSERT INTO `paises` VALUES (106, 'ID', 'Indonesia');
INSERT INTO `paises` VALUES (107, 'IR', 'Irán');
INSERT INTO `paises` VALUES (108, 'IQ', 'Iraq');
INSERT INTO `paises` VALUES (109, 'IE', 'Irlanda');
INSERT INTO `paises` VALUES (110, 'IS', 'Islandia');
INSERT INTO `paises` VALUES (111, 'IL', 'Israel');
INSERT INTO `paises` VALUES (112, 'IT', 'Italia');
INSERT INTO `paises` VALUES (113, 'JM', 'Jamaica');
INSERT INTO `paises` VALUES (114, 'JP', 'Japón');
INSERT INTO `paises` VALUES (115, 'JO', 'Jordania');
INSERT INTO `paises` VALUES (116, 'KZ', 'Kazajstán');
INSERT INTO `paises` VALUES (117, 'KE', 'Kenia');
INSERT INTO `paises` VALUES (118, 'KG', 'Kirguistán');
INSERT INTO `paises` VALUES (119, 'KI', 'Kiribati');
INSERT INTO `paises` VALUES (120, 'KW', 'Kuwait');
INSERT INTO `paises` VALUES (121, 'LA', 'Laos');
INSERT INTO `paises` VALUES (122, 'LS', 'Lesotho');
INSERT INTO `paises` VALUES (123, 'LV', 'Letonia');
INSERT INTO `paises` VALUES (124, 'LB', 'Líbano');
INSERT INTO `paises` VALUES (125, 'LR', 'Liberia');
INSERT INTO `paises` VALUES (126, 'LY', 'Libia');
INSERT INTO `paises` VALUES (127, 'LI', 'Liechtenstein');
INSERT INTO `paises` VALUES (128, 'LT', 'Lituania');
INSERT INTO `paises` VALUES (129, 'LU', 'Luxemburgo');
INSERT INTO `paises` VALUES (130, 'MO', 'Macao');
INSERT INTO `paises` VALUES (131, 'MK', 'ARY Macedonia');
INSERT INTO `paises` VALUES (132, 'MG', 'Madagascar');
INSERT INTO `paises` VALUES (133, 'MY', 'Malasia');
INSERT INTO `paises` VALUES (134, 'MW', 'Malawi');
INSERT INTO `paises` VALUES (135, 'MV', 'Maldivas');
INSERT INTO `paises` VALUES (136, 'ML', 'Malí');
INSERT INTO `paises` VALUES (137, 'MT', 'Malta');
INSERT INTO `paises` VALUES (138, 'FK', 'Islas Malvinas');
INSERT INTO `paises` VALUES (139, 'MP', 'Islas Marianas del Norte');
INSERT INTO `paises` VALUES (140, 'MA', 'Marruecos');
INSERT INTO `paises` VALUES (141, 'MH', 'Islas Marshall');
INSERT INTO `paises` VALUES (142, 'MQ', 'Martinica');
INSERT INTO `paises` VALUES (143, 'MU', 'Mauricio');
INSERT INTO `paises` VALUES (144, 'MR', 'Mauritania');
INSERT INTO `paises` VALUES (145, 'YT', 'Mayotte');
INSERT INTO `paises` VALUES (146, 'MX', 'México');
INSERT INTO `paises` VALUES (147, 'FM', 'Micronesia');
INSERT INTO `paises` VALUES (148, 'MD', 'Moldavia');
INSERT INTO `paises` VALUES (149, 'MC', 'Mónaco');
INSERT INTO `paises` VALUES (150, 'MN', 'Mongolia');
INSERT INTO `paises` VALUES (151, 'MS', 'Montserrat');
INSERT INTO `paises` VALUES (152, 'MZ', 'Mozambique');
INSERT INTO `paises` VALUES (153, 'MM', 'Myanmar');
INSERT INTO `paises` VALUES (154, 'NA', 'Namibia');
INSERT INTO `paises` VALUES (155, 'NR', 'Nauru');
INSERT INTO `paises` VALUES (156, 'NP', 'Nepal');
INSERT INTO `paises` VALUES (157, 'NI', 'Nicaragua');
INSERT INTO `paises` VALUES (158, 'NE', 'Níger');
INSERT INTO `paises` VALUES (159, 'NG', 'Nigeria');
INSERT INTO `paises` VALUES (160, 'NU', 'Niue');
INSERT INTO `paises` VALUES (161, 'NF', 'Isla Norfolk');
INSERT INTO `paises` VALUES (162, 'NO', 'Noruega');
INSERT INTO `paises` VALUES (163, 'NC', 'Nueva Caledonia');
INSERT INTO `paises` VALUES (164, 'NZ', 'Nueva Zelanda');
INSERT INTO `paises` VALUES (165, 'OM', 'Omán');
INSERT INTO `paises` VALUES (166, 'NL', 'Países Bajos');
INSERT INTO `paises` VALUES (167, 'PK', 'Pakistán');
INSERT INTO `paises` VALUES (168, 'PW', 'Palau');
INSERT INTO `paises` VALUES (169, 'PS', 'Palestina');
INSERT INTO `paises` VALUES (170, 'PA', 'Panamá');
INSERT INTO `paises` VALUES (171, 'PG', 'Papúa Nueva Guinea');
INSERT INTO `paises` VALUES (172, 'PY', 'Paraguay');
INSERT INTO `paises` VALUES (173, 'PE', 'Perú');
INSERT INTO `paises` VALUES (174, 'PN', 'Islas Pitcairn');
INSERT INTO `paises` VALUES (175, 'PF', 'Polinesia Francesa');
INSERT INTO `paises` VALUES (176, 'PL', 'Polonia');
INSERT INTO `paises` VALUES (177, 'PT', 'Portugal');
INSERT INTO `paises` VALUES (178, 'PR', 'Puerto Rico');
INSERT INTO `paises` VALUES (179, 'QA', 'Qatar');
INSERT INTO `paises` VALUES (180, 'GB', 'Reino Unido');
INSERT INTO `paises` VALUES (181, 'RE', 'Reunión');
INSERT INTO `paises` VALUES (182, 'RW', 'Ruanda');
INSERT INTO `paises` VALUES (183, 'RO', 'Rumania');
INSERT INTO `paises` VALUES (184, 'RU', 'Rusia');
INSERT INTO `paises` VALUES (185, 'EH', 'Sahara Occidental');
INSERT INTO `paises` VALUES (186, 'SB', 'Islas Salomón');
INSERT INTO `paises` VALUES (187, 'WS', 'Samoa');
INSERT INTO `paises` VALUES (188, 'AS', 'Samoa Americana');
INSERT INTO `paises` VALUES (189, 'KN', 'San Cristóbal y Nevis');
INSERT INTO `paises` VALUES (190, 'SM', 'San Marino');
INSERT INTO `paises` VALUES (191, 'PM', 'San Pedro y Miquelón');
INSERT INTO `paises` VALUES (192, 'VC', 'San Vicente y las Granadinas');
INSERT INTO `paises` VALUES (193, 'SH', 'Santa Helena');
INSERT INTO `paises` VALUES (194, 'LC', 'Santa Lucía');
INSERT INTO `paises` VALUES (195, 'ST', 'Santo Tomé y Príncipe');
INSERT INTO `paises` VALUES (196, 'SN', 'Senegal');
INSERT INTO `paises` VALUES (197, 'CS', 'Serbia y Montenegro');
INSERT INTO `paises` VALUES (198, 'SC', 'Seychelles');
INSERT INTO `paises` VALUES (199, 'SL', 'Sierra Leona');
INSERT INTO `paises` VALUES (200, 'SG', 'Singapur');
INSERT INTO `paises` VALUES (201, 'SY', 'Siria');
INSERT INTO `paises` VALUES (202, 'SO', 'Somalia');
INSERT INTO `paises` VALUES (203, 'LK', 'Sri Lanka');
INSERT INTO `paises` VALUES (204, 'SZ', 'Suazilandia');
INSERT INTO `paises` VALUES (205, 'ZA', 'Sudáfrica');
INSERT INTO `paises` VALUES (206, 'SD', 'Sudán');
INSERT INTO `paises` VALUES (207, 'SE', 'Suecia');
INSERT INTO `paises` VALUES (208, 'CH', 'Suiza');
INSERT INTO `paises` VALUES (209, 'SR', 'Surinam');
INSERT INTO `paises` VALUES (210, 'SJ', 'Svalbard y Jan Mayen');
INSERT INTO `paises` VALUES (211, 'TH', 'Tailandia');
INSERT INTO `paises` VALUES (212, 'TW', 'Taiwán');
INSERT INTO `paises` VALUES (213, 'TZ', 'Tanzania');
INSERT INTO `paises` VALUES (214, 'TJ', 'Tayikistán');
INSERT INTO `paises` VALUES (215, 'IO', 'Territorio Británico del Océano Índico');
INSERT INTO `paises` VALUES (216, 'TF', 'Territorios Australes Franceses');
INSERT INTO `paises` VALUES (217, 'TL', 'Timor Oriental');
INSERT INTO `paises` VALUES (218, 'TG', 'Togo');
INSERT INTO `paises` VALUES (219, 'TK', 'Tokelau');
INSERT INTO `paises` VALUES (220, 'TO', 'Tonga');
INSERT INTO `paises` VALUES (221, 'TT', 'Trinidad y Tobago');
INSERT INTO `paises` VALUES (222, 'TN', 'Túnez');
INSERT INTO `paises` VALUES (223, 'TC', 'Islas Turcas y Caicos');
INSERT INTO `paises` VALUES (224, 'TM', 'Turkmenistán');
INSERT INTO `paises` VALUES (225, 'TR', 'Turquía');
INSERT INTO `paises` VALUES (226, 'TV', 'Tuvalu');
INSERT INTO `paises` VALUES (227, 'UA', 'Ucrania');
INSERT INTO `paises` VALUES (228, 'UG', 'Uganda');
INSERT INTO `paises` VALUES (229, 'UY', 'Uruguay');
INSERT INTO `paises` VALUES (230, 'UZ', 'Uzbekistán');
INSERT INTO `paises` VALUES (231, 'VU', 'Vanuatu');
INSERT INTO `paises` VALUES (232, 'AF', 'Afganistán');
INSERT INTO `paises` VALUES (233, 'VN', 'Vietnam');
INSERT INTO `paises` VALUES (234, 'VG', 'Islas Vírgenes Británicas');
INSERT INTO `paises` VALUES (235, 'VI', 'Islas Vírgenes de los Estados Unidos');
INSERT INTO `paises` VALUES (236, 'WF', 'Wallis y Futuna');
INSERT INTO `paises` VALUES (237, 'YE', 'Yemen');
INSERT INTO `paises` VALUES (238, 'DJ', 'Yibuti');
INSERT INTO `paises` VALUES (239, 'ZM', 'Zambia');
INSERT INTO `paises` VALUES (240, 'ZW', 'Zimbabue');

-- ----------------------------
-- Table structure for parentescos
-- ----------------------------
DROP TABLE IF EXISTS `parentescos`;
CREATE TABLE `parentescos`  (
  `id_parentesco` int NOT NULL AUTO_INCREMENT,
  `parentesco` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_parentesco`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of parentescos
-- ----------------------------
INSERT INTO `parentescos` VALUES (1, 'Madre');
INSERT INTO `parentescos` VALUES (2, 'Padre');
INSERT INTO `parentescos` VALUES (3, 'Tia');
INSERT INTO `parentescos` VALUES (4, 'Tio');
INSERT INTO `parentescos` VALUES (5, 'Hermana');
INSERT INTO `parentescos` VALUES (6, 'Hermano');
INSERT INTO `parentescos` VALUES (7, 'Prima');
INSERT INTO `parentescos` VALUES (8, 'Primo');
INSERT INTO `parentescos` VALUES (9, 'Abuela');
INSERT INTO `parentescos` VALUES (10, 'Abuelo');
INSERT INTO `parentescos` VALUES (11, 'Esposa');
INSERT INTO `parentescos` VALUES (12, 'Esposo');
INSERT INTO `parentescos` VALUES (13, 'Amiga');
INSERT INTO `parentescos` VALUES (14, 'Amigo');
INSERT INTO `parentescos` VALUES (15, 'Representante');

-- ----------------------------
-- Table structure for parroquias
-- ----------------------------
DROP TABLE IF EXISTS `parroquias`;
CREATE TABLE `parroquias`  (
  `id_parroquia` int NOT NULL AUTO_INCREMENT,
  `id_municipio` int NOT NULL,
  `parroquia` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_parroquia`) USING BTREE,
  INDEX `id_municipio`(`id_municipio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1139 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of parroquias
-- ----------------------------
INSERT INTO `parroquias` VALUES (1, 1, 'Alto Orinoco');
INSERT INTO `parroquias` VALUES (2, 1, 'Huachamacare Acanaña');
INSERT INTO `parroquias` VALUES (3, 1, 'Marawaka Toky Shamanaña');
INSERT INTO `parroquias` VALUES (4, 1, 'Mavaka Mavaka');
INSERT INTO `parroquias` VALUES (5, 1, 'Sierra Parima Parimabé');
INSERT INTO `parroquias` VALUES (6, 2, 'Ucata Laja Lisa');
INSERT INTO `parroquias` VALUES (7, 2, 'Yapacana Macuruco');
INSERT INTO `parroquias` VALUES (8, 2, 'Caname Guarinuma');
INSERT INTO `parroquias` VALUES (9, 3, 'Fernando Girón Tovar');
INSERT INTO `parroquias` VALUES (10, 3, 'Luis Alberto Gómez');
INSERT INTO `parroquias` VALUES (11, 3, 'Pahueña Limón de Parhueña');
INSERT INTO `parroquias` VALUES (12, 3, 'Platanillal Platanillal');
INSERT INTO `parroquias` VALUES (13, 4, 'Samariapo');
INSERT INTO `parroquias` VALUES (14, 4, 'Sipapo');
INSERT INTO `parroquias` VALUES (15, 4, 'Munduapo');
INSERT INTO `parroquias` VALUES (16, 4, 'Guayapo');
INSERT INTO `parroquias` VALUES (17, 5, 'Alto Ventuari');
INSERT INTO `parroquias` VALUES (18, 5, 'Medio Ventuari');
INSERT INTO `parroquias` VALUES (19, 5, 'Bajo Ventuari');
INSERT INTO `parroquias` VALUES (20, 6, 'Victorino');
INSERT INTO `parroquias` VALUES (21, 6, 'Comunidad');
INSERT INTO `parroquias` VALUES (22, 7, 'Casiquiare');
INSERT INTO `parroquias` VALUES (23, 7, 'Cocuy');
INSERT INTO `parroquias` VALUES (24, 7, 'San Carlos de Río Negro');
INSERT INTO `parroquias` VALUES (25, 7, 'Solano');
INSERT INTO `parroquias` VALUES (26, 8, 'Anaco');
INSERT INTO `parroquias` VALUES (27, 8, 'San Joaquín');
INSERT INTO `parroquias` VALUES (28, 9, 'Cachipo');
INSERT INTO `parroquias` VALUES (29, 9, 'Aragua de Barcelona');
INSERT INTO `parroquias` VALUES (30, 11, 'Lechería');
INSERT INTO `parroquias` VALUES (31, 11, 'El Morro');
INSERT INTO `parroquias` VALUES (32, 12, 'Puerto Píritu');
INSERT INTO `parroquias` VALUES (33, 12, 'San Miguel');
INSERT INTO `parroquias` VALUES (34, 12, 'Sucre');
INSERT INTO `parroquias` VALUES (35, 13, 'Valle de Guanape');
INSERT INTO `parroquias` VALUES (36, 13, 'Santa Bárbara');
INSERT INTO `parroquias` VALUES (37, 14, 'El Chaparro');
INSERT INTO `parroquias` VALUES (38, 14, 'Tomás Alfaro');
INSERT INTO `parroquias` VALUES (39, 14, 'Calatrava');
INSERT INTO `parroquias` VALUES (40, 15, 'Guanta');
INSERT INTO `parroquias` VALUES (41, 15, 'Chorrerón');
INSERT INTO `parroquias` VALUES (42, 16, 'Mamo');
INSERT INTO `parroquias` VALUES (43, 16, 'Soledad');
INSERT INTO `parroquias` VALUES (44, 17, 'Mapire');
INSERT INTO `parroquias` VALUES (45, 17, 'Piar');
INSERT INTO `parroquias` VALUES (46, 17, 'Santa Clara');
INSERT INTO `parroquias` VALUES (47, 17, 'San Diego de Cabrutica');
INSERT INTO `parroquias` VALUES (48, 17, 'Uverito');
INSERT INTO `parroquias` VALUES (49, 17, 'Zuata');
INSERT INTO `parroquias` VALUES (50, 18, 'Puerto La Cruz');
INSERT INTO `parroquias` VALUES (51, 18, 'Pozuelos');
INSERT INTO `parroquias` VALUES (52, 19, 'Onoto');
INSERT INTO `parroquias` VALUES (53, 19, 'San Pablo');
INSERT INTO `parroquias` VALUES (54, 20, 'San Mateo');
INSERT INTO `parroquias` VALUES (55, 20, 'El Carito');
INSERT INTO `parroquias` VALUES (56, 20, 'Santa Inés');
INSERT INTO `parroquias` VALUES (57, 20, 'La Romereña');
INSERT INTO `parroquias` VALUES (58, 21, 'Atapirire');
INSERT INTO `parroquias` VALUES (59, 21, 'Boca del Pao');
INSERT INTO `parroquias` VALUES (60, 21, 'El Pao');
INSERT INTO `parroquias` VALUES (61, 21, 'Pariaguán');
INSERT INTO `parroquias` VALUES (62, 22, 'Cantaura');
INSERT INTO `parroquias` VALUES (63, 22, 'Libertador');
INSERT INTO `parroquias` VALUES (64, 22, 'Santa Rosa');
INSERT INTO `parroquias` VALUES (65, 22, 'Urica');
INSERT INTO `parroquias` VALUES (66, 23, 'Píritu');
INSERT INTO `parroquias` VALUES (67, 23, 'San Francisco');
INSERT INTO `parroquias` VALUES (68, 24, 'San José de Guanipa');
INSERT INTO `parroquias` VALUES (69, 25, 'Boca de Uchire');
INSERT INTO `parroquias` VALUES (70, 25, 'Boca de Chávez');
INSERT INTO `parroquias` VALUES (71, 26, 'Pueblo Nuevo');
INSERT INTO `parroquias` VALUES (72, 26, 'Santa Ana');
INSERT INTO `parroquias` VALUES (73, 27, 'Bergantín');
INSERT INTO `parroquias` VALUES (74, 27, 'Caigua');
INSERT INTO `parroquias` VALUES (75, 27, 'El Carmen');
INSERT INTO `parroquias` VALUES (76, 27, 'El Pilar');
INSERT INTO `parroquias` VALUES (77, 27, 'Naricual');
INSERT INTO `parroquias` VALUES (78, 27, 'San Crsitóbal');
INSERT INTO `parroquias` VALUES (79, 28, 'Edmundo Barrios');
INSERT INTO `parroquias` VALUES (80, 28, 'Miguel Otero Silva');
INSERT INTO `parroquias` VALUES (81, 29, 'Achaguas');
INSERT INTO `parroquias` VALUES (82, 29, 'Apurito');
INSERT INTO `parroquias` VALUES (83, 29, 'El Yagual');
INSERT INTO `parroquias` VALUES (84, 29, 'Guachara');
INSERT INTO `parroquias` VALUES (85, 29, 'Mucuritas');
INSERT INTO `parroquias` VALUES (86, 29, 'Queseras del medio');
INSERT INTO `parroquias` VALUES (87, 30, 'Biruaca');
INSERT INTO `parroquias` VALUES (88, 31, 'Bruzual');
INSERT INTO `parroquias` VALUES (89, 31, 'Mantecal');
INSERT INTO `parroquias` VALUES (90, 31, 'Quintero');
INSERT INTO `parroquias` VALUES (91, 31, 'Rincón Hondo');
INSERT INTO `parroquias` VALUES (92, 31, 'San Vicente');
INSERT INTO `parroquias` VALUES (93, 32, 'Guasdualito');
INSERT INTO `parroquias` VALUES (94, 32, 'Aramendi');
INSERT INTO `parroquias` VALUES (95, 32, 'El Amparo');
INSERT INTO `parroquias` VALUES (96, 32, 'San Camilo');
INSERT INTO `parroquias` VALUES (97, 32, 'Urdaneta');
INSERT INTO `parroquias` VALUES (98, 33, 'San Juan de Payara');
INSERT INTO `parroquias` VALUES (99, 33, 'Codazzi');
INSERT INTO `parroquias` VALUES (100, 33, 'Cunaviche');
INSERT INTO `parroquias` VALUES (101, 34, 'Elorza');
INSERT INTO `parroquias` VALUES (102, 34, 'La Trinidad');
INSERT INTO `parroquias` VALUES (103, 35, 'San Fernando');
INSERT INTO `parroquias` VALUES (104, 35, 'El Recreo');
INSERT INTO `parroquias` VALUES (105, 35, 'Peñalver');
INSERT INTO `parroquias` VALUES (106, 35, 'San Rafael de Atamaica');
INSERT INTO `parroquias` VALUES (107, 36, 'Pedro José Ovalles');
INSERT INTO `parroquias` VALUES (108, 36, 'Joaquín Crespo');
INSERT INTO `parroquias` VALUES (109, 36, 'José Casanova Godoy');
INSERT INTO `parroquias` VALUES (110, 36, 'Madre María de San José');
INSERT INTO `parroquias` VALUES (111, 36, 'Andrés Eloy Blanco');
INSERT INTO `parroquias` VALUES (112, 36, 'Los Tacarigua');
INSERT INTO `parroquias` VALUES (113, 36, 'Las Delicias');
INSERT INTO `parroquias` VALUES (114, 36, 'Choroní');
INSERT INTO `parroquias` VALUES (115, 37, 'Bolívar');
INSERT INTO `parroquias` VALUES (116, 38, 'Camatagua');
INSERT INTO `parroquias` VALUES (117, 38, 'Carmen de Cura');
INSERT INTO `parroquias` VALUES (118, 39, 'Santa Rita');
INSERT INTO `parroquias` VALUES (119, 39, 'Francisco de Miranda');
INSERT INTO `parroquias` VALUES (120, 39, 'Moseñor Feliciano González');
INSERT INTO `parroquias` VALUES (121, 40, 'Santa Cruz');
INSERT INTO `parroquias` VALUES (122, 41, 'José Félix Ribas');
INSERT INTO `parroquias` VALUES (123, 41, 'Castor Nieves Ríos');
INSERT INTO `parroquias` VALUES (124, 41, 'Las Guacamayas');
INSERT INTO `parroquias` VALUES (125, 41, 'Pao de Zárate');
INSERT INTO `parroquias` VALUES (126, 41, 'Zuata');
INSERT INTO `parroquias` VALUES (127, 42, 'José Rafael Revenga');
INSERT INTO `parroquias` VALUES (128, 43, 'Palo Negro');
INSERT INTO `parroquias` VALUES (129, 43, 'San Martín de Porres');
INSERT INTO `parroquias` VALUES (130, 44, 'El Limón');
INSERT INTO `parroquias` VALUES (131, 44, 'Caña de Azúcar');
INSERT INTO `parroquias` VALUES (132, 45, 'Ocumare de la Costa');
INSERT INTO `parroquias` VALUES (133, 46, 'San Casimiro');
INSERT INTO `parroquias` VALUES (134, 46, 'Güiripa');
INSERT INTO `parroquias` VALUES (135, 46, 'Ollas de Caramacate');
INSERT INTO `parroquias` VALUES (136, 46, 'Valle Morín');
INSERT INTO `parroquias` VALUES (137, 47, 'San Sebastían');
INSERT INTO `parroquias` VALUES (138, 48, 'Turmero');
INSERT INTO `parroquias` VALUES (139, 48, 'Arevalo Aponte');
INSERT INTO `parroquias` VALUES (140, 48, 'Chuao');
INSERT INTO `parroquias` VALUES (141, 48, 'Samán de Güere');
INSERT INTO `parroquias` VALUES (142, 48, 'Alfredo Pacheco Miranda');
INSERT INTO `parroquias` VALUES (143, 49, 'Santos Michelena');
INSERT INTO `parroquias` VALUES (144, 49, 'Tiara');
INSERT INTO `parroquias` VALUES (145, 50, 'Cagua');
INSERT INTO `parroquias` VALUES (146, 50, 'Bella Vista');
INSERT INTO `parroquias` VALUES (147, 51, 'Tovar');
INSERT INTO `parroquias` VALUES (148, 52, 'Urdaneta');
INSERT INTO `parroquias` VALUES (149, 52, 'Las Peñitas');
INSERT INTO `parroquias` VALUES (150, 52, 'San Francisco de Cara');
INSERT INTO `parroquias` VALUES (151, 52, 'Taguay');
INSERT INTO `parroquias` VALUES (152, 53, 'Zamora');
INSERT INTO `parroquias` VALUES (153, 53, 'Magdaleno');
INSERT INTO `parroquias` VALUES (154, 53, 'San Francisco de Asís');
INSERT INTO `parroquias` VALUES (155, 53, 'Valles de Tucutunemo');
INSERT INTO `parroquias` VALUES (156, 53, 'Augusto Mijares');
INSERT INTO `parroquias` VALUES (157, 54, 'Sabaneta');
INSERT INTO `parroquias` VALUES (158, 54, 'Juan Antonio Rodríguez Domínguez');
INSERT INTO `parroquias` VALUES (159, 55, 'El Cantón');
INSERT INTO `parroquias` VALUES (160, 55, 'Santa Cruz de Guacas');
INSERT INTO `parroquias` VALUES (161, 55, 'Puerto Vivas');
INSERT INTO `parroquias` VALUES (162, 56, 'Ticoporo');
INSERT INTO `parroquias` VALUES (163, 56, 'Nicolás Pulido');
INSERT INTO `parroquias` VALUES (164, 56, 'Andrés Bello');
INSERT INTO `parroquias` VALUES (165, 57, 'Arismendi');
INSERT INTO `parroquias` VALUES (166, 57, 'Guadarrama');
INSERT INTO `parroquias` VALUES (167, 57, 'La Unión');
INSERT INTO `parroquias` VALUES (168, 57, 'San Antonio');
INSERT INTO `parroquias` VALUES (169, 58, 'Barinas');
INSERT INTO `parroquias` VALUES (170, 58, 'Alberto Arvelo Larriva');
INSERT INTO `parroquias` VALUES (171, 58, 'San Silvestre');
INSERT INTO `parroquias` VALUES (172, 58, 'Santa Inés');
INSERT INTO `parroquias` VALUES (173, 58, 'Santa Lucía');
INSERT INTO `parroquias` VALUES (174, 58, 'Torumos');
INSERT INTO `parroquias` VALUES (175, 58, 'El Carmen');
INSERT INTO `parroquias` VALUES (176, 58, 'Rómulo Betancourt');
INSERT INTO `parroquias` VALUES (177, 58, 'Corazón de Jesús');
INSERT INTO `parroquias` VALUES (178, 58, 'Ramón Ignacio Méndez');
INSERT INTO `parroquias` VALUES (179, 58, 'Alto Barinas');
INSERT INTO `parroquias` VALUES (180, 58, 'Manuel Palacio Fajardo');
INSERT INTO `parroquias` VALUES (181, 58, 'Juan Antonio Rodríguez Domínguez');
INSERT INTO `parroquias` VALUES (182, 58, 'Dominga Ortiz de Páez');
INSERT INTO `parroquias` VALUES (183, 59, 'Barinitas');
INSERT INTO `parroquias` VALUES (184, 59, 'Altamira de Cáceres');
INSERT INTO `parroquias` VALUES (185, 59, 'Calderas');
INSERT INTO `parroquias` VALUES (186, 60, 'Barrancas');
INSERT INTO `parroquias` VALUES (187, 60, 'El Socorro');
INSERT INTO `parroquias` VALUES (188, 60, 'Mazparrito');
INSERT INTO `parroquias` VALUES (189, 61, 'Santa Bárbara');
INSERT INTO `parroquias` VALUES (190, 61, 'Pedro Briceño Méndez');
INSERT INTO `parroquias` VALUES (191, 61, 'Ramón Ignacio Méndez');
INSERT INTO `parroquias` VALUES (192, 61, 'José Ignacio del Pumar');
INSERT INTO `parroquias` VALUES (193, 62, 'Obispos');
INSERT INTO `parroquias` VALUES (194, 62, 'Guasimitos');
INSERT INTO `parroquias` VALUES (195, 62, 'El Real');
INSERT INTO `parroquias` VALUES (196, 62, 'La Luz');
INSERT INTO `parroquias` VALUES (197, 63, 'Ciudad Bolívia');
INSERT INTO `parroquias` VALUES (198, 63, 'José Ignacio Briceño');
INSERT INTO `parroquias` VALUES (199, 63, 'José Félix Ribas');
INSERT INTO `parroquias` VALUES (200, 63, 'Páez');
INSERT INTO `parroquias` VALUES (201, 64, 'Libertad');
INSERT INTO `parroquias` VALUES (202, 64, 'Dolores');
INSERT INTO `parroquias` VALUES (203, 64, 'Santa Rosa');
INSERT INTO `parroquias` VALUES (204, 64, 'Palacio Fajardo');
INSERT INTO `parroquias` VALUES (205, 65, 'Ciudad de Nutrias');
INSERT INTO `parroquias` VALUES (206, 65, 'El Regalo');
INSERT INTO `parroquias` VALUES (207, 65, 'Puerto Nutrias');
INSERT INTO `parroquias` VALUES (208, 65, 'Santa Catalina');
INSERT INTO `parroquias` VALUES (209, 66, 'Cachamay');
INSERT INTO `parroquias` VALUES (210, 66, 'Chirica');
INSERT INTO `parroquias` VALUES (211, 66, 'Dalla Costa');
INSERT INTO `parroquias` VALUES (212, 66, 'Once de Abril');
INSERT INTO `parroquias` VALUES (213, 66, 'Simón Bolívar');
INSERT INTO `parroquias` VALUES (214, 66, 'Unare');
INSERT INTO `parroquias` VALUES (215, 66, 'Universidad');
INSERT INTO `parroquias` VALUES (216, 66, 'Vista al Sol');
INSERT INTO `parroquias` VALUES (217, 66, 'Pozo Verde');
INSERT INTO `parroquias` VALUES (218, 66, 'Yocoima');
INSERT INTO `parroquias` VALUES (219, 66, '5 de Julio');
INSERT INTO `parroquias` VALUES (220, 67, 'Cedeño');
INSERT INTO `parroquias` VALUES (221, 67, 'Altagracia');
INSERT INTO `parroquias` VALUES (222, 67, 'Ascensión Farreras');
INSERT INTO `parroquias` VALUES (223, 67, 'Guaniamo');
INSERT INTO `parroquias` VALUES (224, 67, 'La Urbana');
INSERT INTO `parroquias` VALUES (225, 67, 'Pijiguaos');
INSERT INTO `parroquias` VALUES (226, 68, 'El Callao');
INSERT INTO `parroquias` VALUES (227, 69, 'Gran Sabana');
INSERT INTO `parroquias` VALUES (228, 69, 'Ikabarú');
INSERT INTO `parroquias` VALUES (229, 70, 'Catedral');
INSERT INTO `parroquias` VALUES (230, 70, 'Zea');
INSERT INTO `parroquias` VALUES (231, 70, 'Orinoco');
INSERT INTO `parroquias` VALUES (232, 70, 'José Antonio Páez');
INSERT INTO `parroquias` VALUES (233, 70, 'Marhuanta');
INSERT INTO `parroquias` VALUES (234, 70, 'Agua Salada');
INSERT INTO `parroquias` VALUES (235, 70, 'Vista Hermosa');
INSERT INTO `parroquias` VALUES (236, 70, 'La Sabanita');
INSERT INTO `parroquias` VALUES (237, 70, 'Panapana');
INSERT INTO `parroquias` VALUES (238, 71, 'Andrés Eloy Blanco');
INSERT INTO `parroquias` VALUES (239, 71, 'Pedro Cova');
INSERT INTO `parroquias` VALUES (240, 72, 'Raúl Leoni');
INSERT INTO `parroquias` VALUES (241, 72, 'Barceloneta');
INSERT INTO `parroquias` VALUES (242, 72, 'Santa Bárbara');
INSERT INTO `parroquias` VALUES (243, 72, 'San Francisco');
INSERT INTO `parroquias` VALUES (244, 73, 'Roscio');
INSERT INTO `parroquias` VALUES (245, 73, 'Salóm');
INSERT INTO `parroquias` VALUES (246, 74, 'Sifontes');
INSERT INTO `parroquias` VALUES (247, 74, 'Dalla Costa');
INSERT INTO `parroquias` VALUES (248, 74, 'San Isidro');
INSERT INTO `parroquias` VALUES (249, 75, 'Sucre');
INSERT INTO `parroquias` VALUES (250, 75, 'Aripao');
INSERT INTO `parroquias` VALUES (251, 75, 'Guarataro');
INSERT INTO `parroquias` VALUES (252, 75, 'Las Majadas');
INSERT INTO `parroquias` VALUES (253, 75, 'Moitaco');
INSERT INTO `parroquias` VALUES (254, 76, 'Padre Pedro Chien');
INSERT INTO `parroquias` VALUES (255, 76, 'Río Grande');
INSERT INTO `parroquias` VALUES (256, 77, 'Bejuma');
INSERT INTO `parroquias` VALUES (257, 77, 'Canoabo');
INSERT INTO `parroquias` VALUES (258, 77, 'Simón Bolívar');
INSERT INTO `parroquias` VALUES (259, 78, 'Güigüe');
INSERT INTO `parroquias` VALUES (260, 78, 'Carabobo');
INSERT INTO `parroquias` VALUES (261, 78, 'Tacarigua');
INSERT INTO `parroquias` VALUES (262, 79, 'Mariara');
INSERT INTO `parroquias` VALUES (263, 79, 'Aguas Calientes');
INSERT INTO `parroquias` VALUES (264, 80, 'Ciudad Alianza');
INSERT INTO `parroquias` VALUES (265, 80, 'Guacara');
INSERT INTO `parroquias` VALUES (266, 80, 'Yagua');
INSERT INTO `parroquias` VALUES (267, 81, 'Morón');
INSERT INTO `parroquias` VALUES (268, 81, 'Yagua');
INSERT INTO `parroquias` VALUES (269, 82, 'Tocuyito');
INSERT INTO `parroquias` VALUES (270, 82, 'Independencia');
INSERT INTO `parroquias` VALUES (271, 83, 'Los Guayos');
INSERT INTO `parroquias` VALUES (272, 84, 'Miranda');
INSERT INTO `parroquias` VALUES (273, 85, 'Montalbán');
INSERT INTO `parroquias` VALUES (274, 86, 'Naguanagua');
INSERT INTO `parroquias` VALUES (275, 87, 'Bartolomé Salóm');
INSERT INTO `parroquias` VALUES (276, 87, 'Democracia');
INSERT INTO `parroquias` VALUES (277, 87, 'Fraternidad');
INSERT INTO `parroquias` VALUES (278, 87, 'Goaigoaza');
INSERT INTO `parroquias` VALUES (279, 87, 'Juan José Flores');
INSERT INTO `parroquias` VALUES (280, 87, 'Unión');
INSERT INTO `parroquias` VALUES (281, 87, 'Borburata');
INSERT INTO `parroquias` VALUES (282, 87, 'Patanemo');
INSERT INTO `parroquias` VALUES (283, 88, 'San Diego');
INSERT INTO `parroquias` VALUES (284, 89, 'San Joaquín');
INSERT INTO `parroquias` VALUES (285, 90, 'Candelaria');
INSERT INTO `parroquias` VALUES (286, 90, 'Catedral');
INSERT INTO `parroquias` VALUES (287, 90, 'El Socorro');
INSERT INTO `parroquias` VALUES (288, 90, 'Miguel Peña');
INSERT INTO `parroquias` VALUES (289, 90, 'Rafael Urdaneta');
INSERT INTO `parroquias` VALUES (290, 90, 'San Blas');
INSERT INTO `parroquias` VALUES (291, 90, 'San José');
INSERT INTO `parroquias` VALUES (292, 90, 'Santa Rosa');
INSERT INTO `parroquias` VALUES (293, 90, 'Negro Primero');
INSERT INTO `parroquias` VALUES (294, 91, 'Cojedes');
INSERT INTO `parroquias` VALUES (295, 91, 'Juan de Mata Suárez');
INSERT INTO `parroquias` VALUES (296, 92, 'Tinaquillo');
INSERT INTO `parroquias` VALUES (297, 93, 'El Baúl');
INSERT INTO `parroquias` VALUES (298, 93, 'Sucre');
INSERT INTO `parroquias` VALUES (299, 94, 'La Aguadita');
INSERT INTO `parroquias` VALUES (300, 94, 'Macapo');
INSERT INTO `parroquias` VALUES (301, 95, 'El Pao');
INSERT INTO `parroquias` VALUES (302, 96, 'El Amparo');
INSERT INTO `parroquias` VALUES (303, 96, 'Libertad de Cojedes');
INSERT INTO `parroquias` VALUES (304, 97, 'Rómulo Gallegos');
INSERT INTO `parroquias` VALUES (305, 98, 'San Carlos de Austria');
INSERT INTO `parroquias` VALUES (306, 98, 'Juan Ángel Bravo');
INSERT INTO `parroquias` VALUES (307, 98, 'Manuel Manrique');
INSERT INTO `parroquias` VALUES (308, 99, 'General en Jefe José Laurencio Silva');
INSERT INTO `parroquias` VALUES (309, 100, 'Curiapo');
INSERT INTO `parroquias` VALUES (310, 100, 'Almirante Luis Brión');
INSERT INTO `parroquias` VALUES (311, 100, 'Francisco Aniceto Lugo');
INSERT INTO `parroquias` VALUES (312, 100, 'Manuel Renaud');
INSERT INTO `parroquias` VALUES (313, 100, 'Padre Barral');
INSERT INTO `parroquias` VALUES (314, 100, 'Santos de Abelgas');
INSERT INTO `parroquias` VALUES (315, 101, 'Imataca');
INSERT INTO `parroquias` VALUES (316, 101, 'Cinco de Julio');
INSERT INTO `parroquias` VALUES (317, 101, 'Juan Bautista Arismendi');
INSERT INTO `parroquias` VALUES (318, 101, 'Manuel Piar');
INSERT INTO `parroquias` VALUES (319, 101, 'Rómulo Gallegos');
INSERT INTO `parroquias` VALUES (320, 102, 'Pedernales');
INSERT INTO `parroquias` VALUES (321, 102, 'Luis Beltrán Prieto Figueroa');
INSERT INTO `parroquias` VALUES (322, 103, 'San José (Delta Amacuro)');
INSERT INTO `parroquias` VALUES (323, 103, 'José Vidal Marcano');
INSERT INTO `parroquias` VALUES (324, 103, 'Juan Millán');
INSERT INTO `parroquias` VALUES (325, 103, 'Leonardo Ruíz Pineda');
INSERT INTO `parroquias` VALUES (326, 103, 'Mariscal Antonio José de Sucre');
INSERT INTO `parroquias` VALUES (327, 103, 'Monseñor Argimiro García');
INSERT INTO `parroquias` VALUES (328, 103, 'San Rafael (Delta Amacuro)');
INSERT INTO `parroquias` VALUES (329, 103, 'Virgen del Valle');
INSERT INTO `parroquias` VALUES (330, 10, 'Clarines');
INSERT INTO `parroquias` VALUES (331, 10, 'Guanape');
INSERT INTO `parroquias` VALUES (332, 10, 'Sabana de Uchire');
INSERT INTO `parroquias` VALUES (333, 104, 'Capadare');
INSERT INTO `parroquias` VALUES (334, 104, 'La Pastora');
INSERT INTO `parroquias` VALUES (335, 104, 'Libertador');
INSERT INTO `parroquias` VALUES (336, 104, 'San Juan de los Cayos');
INSERT INTO `parroquias` VALUES (337, 105, 'Aracua');
INSERT INTO `parroquias` VALUES (338, 105, 'La Peña');
INSERT INTO `parroquias` VALUES (339, 105, 'San Luis');
INSERT INTO `parroquias` VALUES (340, 106, 'Bariro');
INSERT INTO `parroquias` VALUES (341, 106, 'Borojó');
INSERT INTO `parroquias` VALUES (342, 106, 'Capatárida');
INSERT INTO `parroquias` VALUES (343, 106, 'Guajiro');
INSERT INTO `parroquias` VALUES (344, 106, 'Seque');
INSERT INTO `parroquias` VALUES (345, 106, 'Zazárida');
INSERT INTO `parroquias` VALUES (346, 106, 'Valle de Eroa');
INSERT INTO `parroquias` VALUES (347, 107, 'Cacique Manaure');
INSERT INTO `parroquias` VALUES (348, 108, 'Norte');
INSERT INTO `parroquias` VALUES (349, 108, 'Carirubana');
INSERT INTO `parroquias` VALUES (350, 108, 'Santa Ana');
INSERT INTO `parroquias` VALUES (351, 108, 'Urbana Punta Cardón');
INSERT INTO `parroquias` VALUES (352, 109, 'La Vela de Coro');
INSERT INTO `parroquias` VALUES (353, 109, 'Acurigua');
INSERT INTO `parroquias` VALUES (354, 109, 'Guaibacoa');
INSERT INTO `parroquias` VALUES (355, 109, 'Las Calderas');
INSERT INTO `parroquias` VALUES (356, 109, 'Macoruca');
INSERT INTO `parroquias` VALUES (357, 110, 'Dabajuro');
INSERT INTO `parroquias` VALUES (358, 111, 'Agua Clara');
INSERT INTO `parroquias` VALUES (359, 111, 'Avaria');
INSERT INTO `parroquias` VALUES (360, 111, 'Pedregal');
INSERT INTO `parroquias` VALUES (361, 111, 'Piedra Grande');
INSERT INTO `parroquias` VALUES (362, 111, 'Purureche');
INSERT INTO `parroquias` VALUES (363, 112, 'Adaure');
INSERT INTO `parroquias` VALUES (364, 112, 'Adícora');
INSERT INTO `parroquias` VALUES (365, 112, 'Baraived');
INSERT INTO `parroquias` VALUES (366, 112, 'Buena Vista');
INSERT INTO `parroquias` VALUES (367, 112, 'Jadacaquiva');
INSERT INTO `parroquias` VALUES (368, 112, 'El Vínculo');
INSERT INTO `parroquias` VALUES (369, 112, 'El Hato');
INSERT INTO `parroquias` VALUES (370, 112, 'Moruy');
INSERT INTO `parroquias` VALUES (371, 112, 'Pueblo Nuevo');
INSERT INTO `parroquias` VALUES (372, 113, 'Agua Larga');
INSERT INTO `parroquias` VALUES (373, 113, 'El Paují');
INSERT INTO `parroquias` VALUES (374, 113, 'Independencia');
INSERT INTO `parroquias` VALUES (375, 113, 'Mapararí');
INSERT INTO `parroquias` VALUES (376, 114, 'Agua Linda');
INSERT INTO `parroquias` VALUES (377, 114, 'Araurima');
INSERT INTO `parroquias` VALUES (378, 114, 'Jacura');
INSERT INTO `parroquias` VALUES (379, 115, 'Tucacas');
INSERT INTO `parroquias` VALUES (380, 115, 'Boca de Aroa');
INSERT INTO `parroquias` VALUES (381, 116, 'Los Taques');
INSERT INTO `parroquias` VALUES (382, 116, 'Judibana');
INSERT INTO `parroquias` VALUES (383, 117, 'Mene de Mauroa');
INSERT INTO `parroquias` VALUES (384, 117, 'San Félix');
INSERT INTO `parroquias` VALUES (385, 117, 'Casigua');
INSERT INTO `parroquias` VALUES (386, 118, 'Guzmán Guillermo');
INSERT INTO `parroquias` VALUES (387, 118, 'Mitare');
INSERT INTO `parroquias` VALUES (388, 118, 'Río Seco');
INSERT INTO `parroquias` VALUES (389, 118, 'Sabaneta');
INSERT INTO `parroquias` VALUES (390, 118, 'San Antonio');
INSERT INTO `parroquias` VALUES (391, 118, 'San Gabriel');
INSERT INTO `parroquias` VALUES (392, 118, 'Santa Ana');
INSERT INTO `parroquias` VALUES (393, 119, 'Boca del Tocuyo');
INSERT INTO `parroquias` VALUES (394, 119, 'Chichiriviche');
INSERT INTO `parroquias` VALUES (395, 119, 'Tocuyo de la Costa');
INSERT INTO `parroquias` VALUES (396, 120, 'Palmasola');
INSERT INTO `parroquias` VALUES (397, 121, 'Cabure');
INSERT INTO `parroquias` VALUES (398, 121, 'Colina');
INSERT INTO `parroquias` VALUES (399, 121, 'Curimagua');
INSERT INTO `parroquias` VALUES (400, 122, 'San José de la Costa');
INSERT INTO `parroquias` VALUES (401, 122, 'Píritu');
INSERT INTO `parroquias` VALUES (402, 123, 'San Francisco');
INSERT INTO `parroquias` VALUES (403, 124, 'Sucre');
INSERT INTO `parroquias` VALUES (404, 124, 'Pecaya');
INSERT INTO `parroquias` VALUES (405, 125, 'Tocópero');
INSERT INTO `parroquias` VALUES (406, 126, 'El Charal');
INSERT INTO `parroquias` VALUES (407, 126, 'Las Vegas del Tuy');
INSERT INTO `parroquias` VALUES (408, 126, 'Santa Cruz de Bucaral');
INSERT INTO `parroquias` VALUES (409, 127, 'Bruzual');
INSERT INTO `parroquias` VALUES (410, 127, 'Urumaco');
INSERT INTO `parroquias` VALUES (411, 128, 'Puerto Cumarebo');
INSERT INTO `parroquias` VALUES (412, 128, 'La Ciénaga');
INSERT INTO `parroquias` VALUES (413, 128, 'La Soledad');
INSERT INTO `parroquias` VALUES (414, 128, 'Pueblo Cumarebo');
INSERT INTO `parroquias` VALUES (415, 128, 'Zazárida');
INSERT INTO `parroquias` VALUES (416, 113, 'Churuguara');
INSERT INTO `parroquias` VALUES (417, 129, 'Camaguán');
INSERT INTO `parroquias` VALUES (418, 129, 'Puerto Miranda');
INSERT INTO `parroquias` VALUES (419, 129, 'Uverito');
INSERT INTO `parroquias` VALUES (420, 130, 'Chaguaramas');
INSERT INTO `parroquias` VALUES (421, 131, 'El Socorro');
INSERT INTO `parroquias` VALUES (422, 132, 'Tucupido');
INSERT INTO `parroquias` VALUES (423, 132, 'San Rafael de Laya');
INSERT INTO `parroquias` VALUES (424, 133, 'Altagracia de Orituco');
INSERT INTO `parroquias` VALUES (425, 133, 'San Rafael de Orituco');
INSERT INTO `parroquias` VALUES (426, 133, 'San Francisco Javier de Lezama');
INSERT INTO `parroquias` VALUES (427, 133, 'Paso Real de Macaira');
INSERT INTO `parroquias` VALUES (428, 133, 'Carlos Soublette');
INSERT INTO `parroquias` VALUES (429, 133, 'San Francisco de Macaira');
INSERT INTO `parroquias` VALUES (430, 133, 'Libertad de Orituco');
INSERT INTO `parroquias` VALUES (431, 134, 'Cantaclaro');
INSERT INTO `parroquias` VALUES (432, 134, 'San Juan de los Morros');
INSERT INTO `parroquias` VALUES (433, 134, 'Parapara');
INSERT INTO `parroquias` VALUES (434, 135, 'El Sombrero');
INSERT INTO `parroquias` VALUES (435, 135, 'Sosa');
INSERT INTO `parroquias` VALUES (436, 136, 'Las Mercedes');
INSERT INTO `parroquias` VALUES (437, 136, 'Cabruta');
INSERT INTO `parroquias` VALUES (438, 136, 'Santa Rita de Manapire');
INSERT INTO `parroquias` VALUES (439, 137, 'Valle de la Pascua');
INSERT INTO `parroquias` VALUES (440, 137, 'Espino');
INSERT INTO `parroquias` VALUES (441, 138, 'San José de Unare');
INSERT INTO `parroquias` VALUES (442, 138, 'Zaraza');
INSERT INTO `parroquias` VALUES (443, 139, 'San José de Tiznados');
INSERT INTO `parroquias` VALUES (444, 139, 'San Francisco de Tiznados');
INSERT INTO `parroquias` VALUES (445, 139, 'San Lorenzo de Tiznados');
INSERT INTO `parroquias` VALUES (446, 139, 'Ortiz');
INSERT INTO `parroquias` VALUES (447, 140, 'Guayabal');
INSERT INTO `parroquias` VALUES (448, 140, 'Cazorla');
INSERT INTO `parroquias` VALUES (449, 141, 'San José de Guaribe');
INSERT INTO `parroquias` VALUES (450, 141, 'Uveral');
INSERT INTO `parroquias` VALUES (451, 142, 'Santa María de Ipire');
INSERT INTO `parroquias` VALUES (452, 142, 'Altamira');
INSERT INTO `parroquias` VALUES (453, 143, 'El Calvario');
INSERT INTO `parroquias` VALUES (454, 143, 'El Rastro');
INSERT INTO `parroquias` VALUES (455, 143, 'Guardatinajas');
INSERT INTO `parroquias` VALUES (456, 143, 'Capital Urbana Calabozo');
INSERT INTO `parroquias` VALUES (457, 144, 'Quebrada Honda de Guache');
INSERT INTO `parroquias` VALUES (458, 144, 'Pío Tamayo');
INSERT INTO `parroquias` VALUES (459, 144, 'Yacambú');
INSERT INTO `parroquias` VALUES (460, 145, 'Fréitez');
INSERT INTO `parroquias` VALUES (461, 145, 'José María Blanco');
INSERT INTO `parroquias` VALUES (462, 146, 'Catedral');
INSERT INTO `parroquias` VALUES (463, 146, 'Concepción');
INSERT INTO `parroquias` VALUES (464, 146, 'El Cují');
INSERT INTO `parroquias` VALUES (465, 146, 'Juan de Villegas');
INSERT INTO `parroquias` VALUES (466, 146, 'Santa Rosa');
INSERT INTO `parroquias` VALUES (467, 146, 'Tamaca');
INSERT INTO `parroquias` VALUES (468, 146, 'Unión');
INSERT INTO `parroquias` VALUES (469, 146, 'Aguedo Felipe Alvarado');
INSERT INTO `parroquias` VALUES (470, 146, 'Buena Vista');
INSERT INTO `parroquias` VALUES (471, 146, 'Juárez');
INSERT INTO `parroquias` VALUES (472, 147, 'Juan Bautista Rodríguez');
INSERT INTO `parroquias` VALUES (473, 147, 'Cuara');
INSERT INTO `parroquias` VALUES (474, 147, 'Diego de Lozada');
INSERT INTO `parroquias` VALUES (475, 147, 'Paraíso de San José');
INSERT INTO `parroquias` VALUES (476, 147, 'San Miguel');
INSERT INTO `parroquias` VALUES (477, 147, 'Tintorero');
INSERT INTO `parroquias` VALUES (478, 147, 'José Bernardo Dorante');
INSERT INTO `parroquias` VALUES (479, 147, 'Coronel Mariano Peraza ');
INSERT INTO `parroquias` VALUES (480, 148, 'Bolívar');
INSERT INTO `parroquias` VALUES (481, 148, 'Anzoátegui');
INSERT INTO `parroquias` VALUES (482, 148, 'Guarico');
INSERT INTO `parroquias` VALUES (483, 148, 'Hilario Luna y Luna');
INSERT INTO `parroquias` VALUES (484, 148, 'Humocaro Alto');
INSERT INTO `parroquias` VALUES (485, 148, 'Humocaro Bajo');
INSERT INTO `parroquias` VALUES (486, 148, 'La Candelaria');
INSERT INTO `parroquias` VALUES (487, 148, 'Morán');
INSERT INTO `parroquias` VALUES (488, 149, 'Cabudare');
INSERT INTO `parroquias` VALUES (489, 149, 'José Gregorio Bastidas');
INSERT INTO `parroquias` VALUES (490, 149, 'Agua Viva');
INSERT INTO `parroquias` VALUES (491, 150, 'Sarare');
INSERT INTO `parroquias` VALUES (492, 150, 'Buría');
INSERT INTO `parroquias` VALUES (493, 150, 'Gustavo Vegas León');
INSERT INTO `parroquias` VALUES (494, 151, 'Trinidad Samuel');
INSERT INTO `parroquias` VALUES (495, 151, 'Antonio Díaz');
INSERT INTO `parroquias` VALUES (496, 151, 'Camacaro');
INSERT INTO `parroquias` VALUES (497, 151, 'Castañeda');
INSERT INTO `parroquias` VALUES (498, 151, 'Cecilio Zubillaga');
INSERT INTO `parroquias` VALUES (499, 151, 'Chiquinquirá');
INSERT INTO `parroquias` VALUES (500, 151, 'El Blanco');
INSERT INTO `parroquias` VALUES (501, 151, 'Espinoza de los Monteros');
INSERT INTO `parroquias` VALUES (502, 151, 'Lara');
INSERT INTO `parroquias` VALUES (503, 151, 'Las Mercedes');
INSERT INTO `parroquias` VALUES (504, 151, 'Manuel Morillo');
INSERT INTO `parroquias` VALUES (505, 151, 'Montaña Verde');
INSERT INTO `parroquias` VALUES (506, 151, 'Montes de Oca');
INSERT INTO `parroquias` VALUES (507, 151, 'Torres');
INSERT INTO `parroquias` VALUES (508, 151, 'Heriberto Arroyo');
INSERT INTO `parroquias` VALUES (509, 151, 'Reyes Vargas');
INSERT INTO `parroquias` VALUES (510, 151, 'Altagracia');
INSERT INTO `parroquias` VALUES (511, 152, 'Siquisique');
INSERT INTO `parroquias` VALUES (512, 152, 'Moroturo');
INSERT INTO `parroquias` VALUES (513, 152, 'San Miguel');
INSERT INTO `parroquias` VALUES (514, 152, 'Xaguas');
INSERT INTO `parroquias` VALUES (515, 179, 'Presidente Betancourt');
INSERT INTO `parroquias` VALUES (516, 179, 'Presidente Páez');
INSERT INTO `parroquias` VALUES (517, 179, 'Presidente Rómulo Gallegos');
INSERT INTO `parroquias` VALUES (518, 179, 'Gabriel Picón González');
INSERT INTO `parroquias` VALUES (519, 179, 'Héctor Amable Mora');
INSERT INTO `parroquias` VALUES (520, 179, 'José Nucete Sardi');
INSERT INTO `parroquias` VALUES (521, 179, 'Pulido Méndez');
INSERT INTO `parroquias` VALUES (522, 180, 'La Azulita');
INSERT INTO `parroquias` VALUES (523, 181, 'Santa Cruz de Mora');
INSERT INTO `parroquias` VALUES (524, 181, 'Mesa Bolívar');
INSERT INTO `parroquias` VALUES (525, 181, 'Mesa de Las Palmas');
INSERT INTO `parroquias` VALUES (526, 182, 'Aricagua');
INSERT INTO `parroquias` VALUES (527, 182, 'San Antonio');
INSERT INTO `parroquias` VALUES (528, 183, 'Canagua');
INSERT INTO `parroquias` VALUES (529, 183, 'Capurí');
INSERT INTO `parroquias` VALUES (530, 183, 'Chacantá');
INSERT INTO `parroquias` VALUES (531, 183, 'El Molino');
INSERT INTO `parroquias` VALUES (532, 183, 'Guaimaral');
INSERT INTO `parroquias` VALUES (533, 183, 'Mucutuy');
INSERT INTO `parroquias` VALUES (534, 183, 'Mucuchachí');
INSERT INTO `parroquias` VALUES (535, 184, 'Fernández Peña');
INSERT INTO `parroquias` VALUES (536, 184, 'Matriz');
INSERT INTO `parroquias` VALUES (537, 184, 'Montalbán');
INSERT INTO `parroquias` VALUES (538, 184, 'Acequias');
INSERT INTO `parroquias` VALUES (539, 184, 'Jají');
INSERT INTO `parroquias` VALUES (540, 184, 'La Mesa');
INSERT INTO `parroquias` VALUES (541, 184, 'San José del Sur');
INSERT INTO `parroquias` VALUES (542, 185, 'Tucaní');
INSERT INTO `parroquias` VALUES (543, 185, 'Florencio Ramírez');
INSERT INTO `parroquias` VALUES (544, 186, 'Santo Domingo');
INSERT INTO `parroquias` VALUES (545, 186, 'Las Piedras');
INSERT INTO `parroquias` VALUES (546, 187, 'Guaraque');
INSERT INTO `parroquias` VALUES (547, 187, 'Mesa de Quintero');
INSERT INTO `parroquias` VALUES (548, 187, 'Río Negro');
INSERT INTO `parroquias` VALUES (549, 188, 'Arapuey');
INSERT INTO `parroquias` VALUES (550, 188, 'Palmira');
INSERT INTO `parroquias` VALUES (551, 189, 'San Cristóbal de Torondoy');
INSERT INTO `parroquias` VALUES (552, 189, 'Torondoy');
INSERT INTO `parroquias` VALUES (553, 190, 'Antonio Spinetti Dini');
INSERT INTO `parroquias` VALUES (554, 190, 'Arias');
INSERT INTO `parroquias` VALUES (555, 190, 'Caracciolo Parra Pérez');
INSERT INTO `parroquias` VALUES (556, 190, 'Domingo Peña');
INSERT INTO `parroquias` VALUES (557, 190, 'El Llano');
INSERT INTO `parroquias` VALUES (558, 190, 'Gonzalo Picón Febres');
INSERT INTO `parroquias` VALUES (559, 190, 'Jacinto Plaza');
INSERT INTO `parroquias` VALUES (560, 190, 'Juan Rodríguez Suárez');
INSERT INTO `parroquias` VALUES (561, 190, 'Lasso de la Vega');
INSERT INTO `parroquias` VALUES (562, 190, 'Mariano Picón Salas');
INSERT INTO `parroquias` VALUES (563, 190, 'Milla');
INSERT INTO `parroquias` VALUES (564, 190, 'Osuna Rodríguez');
INSERT INTO `parroquias` VALUES (565, 190, 'Sagrario');
INSERT INTO `parroquias` VALUES (566, 190, 'El Morro');
INSERT INTO `parroquias` VALUES (567, 190, 'Los Nevados');
INSERT INTO `parroquias` VALUES (568, 191, 'Andrés Eloy Blanco');
INSERT INTO `parroquias` VALUES (569, 191, 'La Venta');
INSERT INTO `parroquias` VALUES (570, 191, 'Piñango');
INSERT INTO `parroquias` VALUES (571, 191, 'Timotes');
INSERT INTO `parroquias` VALUES (572, 192, 'Eloy Paredes');
INSERT INTO `parroquias` VALUES (573, 192, 'San Rafael de Alcázar');
INSERT INTO `parroquias` VALUES (574, 192, 'Santa Elena de Arenales');
INSERT INTO `parroquias` VALUES (575, 193, 'Santa María de Caparo');
INSERT INTO `parroquias` VALUES (576, 194, 'Pueblo Llano');
INSERT INTO `parroquias` VALUES (577, 195, 'Cacute');
INSERT INTO `parroquias` VALUES (578, 195, 'La Toma');
INSERT INTO `parroquias` VALUES (579, 195, 'Mucuchíes');
INSERT INTO `parroquias` VALUES (580, 195, 'Mucurubá');
INSERT INTO `parroquias` VALUES (581, 195, 'San Rafael');
INSERT INTO `parroquias` VALUES (582, 196, 'Gerónimo Maldonado');
INSERT INTO `parroquias` VALUES (583, 196, 'Bailadores');
INSERT INTO `parroquias` VALUES (584, 197, 'Tabay');
INSERT INTO `parroquias` VALUES (585, 198, 'Chiguará');
INSERT INTO `parroquias` VALUES (586, 198, 'Estánquez');
INSERT INTO `parroquias` VALUES (587, 198, 'Lagunillas');
INSERT INTO `parroquias` VALUES (588, 198, 'La Trampa');
INSERT INTO `parroquias` VALUES (589, 198, 'Pueblo Nuevo del Sur');
INSERT INTO `parroquias` VALUES (590, 198, 'San Juan');
INSERT INTO `parroquias` VALUES (591, 199, 'El Amparo');
INSERT INTO `parroquias` VALUES (592, 199, 'El Llano');
INSERT INTO `parroquias` VALUES (593, 199, 'San Francisco');
INSERT INTO `parroquias` VALUES (594, 199, 'Tovar');
INSERT INTO `parroquias` VALUES (595, 200, 'Independencia');
INSERT INTO `parroquias` VALUES (596, 200, 'María de la Concepción Palacios Blanco');
INSERT INTO `parroquias` VALUES (597, 200, 'Nueva Bolivia');
INSERT INTO `parroquias` VALUES (598, 200, 'Santa Apolonia');
INSERT INTO `parroquias` VALUES (599, 201, 'Caño El Tigre');
INSERT INTO `parroquias` VALUES (600, 201, 'Zea');
INSERT INTO `parroquias` VALUES (601, 223, 'Aragüita');
INSERT INTO `parroquias` VALUES (602, 223, 'Arévalo González');
INSERT INTO `parroquias` VALUES (603, 223, 'Capaya');
INSERT INTO `parroquias` VALUES (604, 223, 'Caucagua');
INSERT INTO `parroquias` VALUES (605, 223, 'Panaquire');
INSERT INTO `parroquias` VALUES (606, 223, 'Ribas');
INSERT INTO `parroquias` VALUES (607, 223, 'El Café');
INSERT INTO `parroquias` VALUES (608, 223, 'Marizapa');
INSERT INTO `parroquias` VALUES (609, 224, 'Cumbo');
INSERT INTO `parroquias` VALUES (610, 224, 'San José de Barlovento');
INSERT INTO `parroquias` VALUES (611, 225, 'El Cafetal');
INSERT INTO `parroquias` VALUES (612, 225, 'Las Minas');
INSERT INTO `parroquias` VALUES (613, 225, 'Nuestra Señora del Rosario');
INSERT INTO `parroquias` VALUES (614, 226, 'Higuerote');
INSERT INTO `parroquias` VALUES (615, 226, 'Curiepe');
INSERT INTO `parroquias` VALUES (616, 226, 'Tacarigua de Brión');
INSERT INTO `parroquias` VALUES (617, 227, 'Mamporal');
INSERT INTO `parroquias` VALUES (618, 228, 'Carrizal');
INSERT INTO `parroquias` VALUES (619, 229, 'Chacao');
INSERT INTO `parroquias` VALUES (620, 230, 'Charallave');
INSERT INTO `parroquias` VALUES (621, 230, 'Las Brisas');
INSERT INTO `parroquias` VALUES (622, 231, 'El Hatillo');
INSERT INTO `parroquias` VALUES (623, 232, 'Altagracia de la Montaña');
INSERT INTO `parroquias` VALUES (624, 232, 'Cecilio Acosta');
INSERT INTO `parroquias` VALUES (625, 232, 'Los Teques');
INSERT INTO `parroquias` VALUES (626, 232, 'El Jarillo');
INSERT INTO `parroquias` VALUES (627, 232, 'San Pedro');
INSERT INTO `parroquias` VALUES (628, 232, 'Tácata');
INSERT INTO `parroquias` VALUES (629, 232, 'Paracotos');
INSERT INTO `parroquias` VALUES (630, 233, 'Cartanal');
INSERT INTO `parroquias` VALUES (631, 233, 'Santa Teresa del Tuy');
INSERT INTO `parroquias` VALUES (632, 234, 'La Democracia');
INSERT INTO `parroquias` VALUES (633, 234, 'Ocumare del Tuy');
INSERT INTO `parroquias` VALUES (634, 234, 'Santa Bárbara');
INSERT INTO `parroquias` VALUES (635, 235, 'San Antonio de los Altos');
INSERT INTO `parroquias` VALUES (636, 236, 'Río Chico');
INSERT INTO `parroquias` VALUES (637, 236, 'El Guapo');
INSERT INTO `parroquias` VALUES (638, 236, 'Tacarigua de la Laguna');
INSERT INTO `parroquias` VALUES (639, 236, 'Paparo');
INSERT INTO `parroquias` VALUES (640, 236, 'San Fernando del Guapo');
INSERT INTO `parroquias` VALUES (641, 237, 'Santa Lucía del Tuy');
INSERT INTO `parroquias` VALUES (642, 238, 'Cúpira');
INSERT INTO `parroquias` VALUES (643, 238, 'Machurucuto');
INSERT INTO `parroquias` VALUES (644, 239, 'Guarenas');
INSERT INTO `parroquias` VALUES (645, 240, 'San Antonio de Yare');
INSERT INTO `parroquias` VALUES (646, 240, 'San Francisco de Yare');
INSERT INTO `parroquias` VALUES (647, 241, 'Leoncio Martínez');
INSERT INTO `parroquias` VALUES (648, 241, 'Petare');
INSERT INTO `parroquias` VALUES (649, 241, 'Caucagüita');
INSERT INTO `parroquias` VALUES (650, 241, 'Filas de Mariche');
INSERT INTO `parroquias` VALUES (651, 241, 'La Dolorita');
INSERT INTO `parroquias` VALUES (652, 242, 'Cúa');
INSERT INTO `parroquias` VALUES (653, 242, 'Nueva Cúa');
INSERT INTO `parroquias` VALUES (654, 243, 'Guatire');
INSERT INTO `parroquias` VALUES (655, 243, 'Bolívar');
INSERT INTO `parroquias` VALUES (656, 258, 'San Antonio de Maturín');
INSERT INTO `parroquias` VALUES (657, 258, 'San Francisco de Maturín');
INSERT INTO `parroquias` VALUES (658, 259, 'Aguasay');
INSERT INTO `parroquias` VALUES (659, 260, 'Caripito');
INSERT INTO `parroquias` VALUES (660, 261, 'El Guácharo');
INSERT INTO `parroquias` VALUES (661, 261, 'La Guanota');
INSERT INTO `parroquias` VALUES (662, 261, 'Sabana de Piedra');
INSERT INTO `parroquias` VALUES (663, 261, 'San Agustín');
INSERT INTO `parroquias` VALUES (664, 261, 'Teresen');
INSERT INTO `parroquias` VALUES (665, 261, 'Caripe');
INSERT INTO `parroquias` VALUES (666, 262, 'Areo');
INSERT INTO `parroquias` VALUES (667, 262, 'Capital Cedeño');
INSERT INTO `parroquias` VALUES (668, 262, 'San Félix de Cantalicio');
INSERT INTO `parroquias` VALUES (669, 262, 'Viento Fresco');
INSERT INTO `parroquias` VALUES (670, 263, 'El Tejero');
INSERT INTO `parroquias` VALUES (671, 263, 'Punta de Mata');
INSERT INTO `parroquias` VALUES (672, 264, 'Chaguaramas');
INSERT INTO `parroquias` VALUES (673, 264, 'Las Alhuacas');
INSERT INTO `parroquias` VALUES (674, 264, 'Tabasca');
INSERT INTO `parroquias` VALUES (675, 264, 'Temblador');
INSERT INTO `parroquias` VALUES (676, 265, 'Alto de los Godos');
INSERT INTO `parroquias` VALUES (677, 265, 'Boquerón');
INSERT INTO `parroquias` VALUES (678, 265, 'Las Cocuizas');
INSERT INTO `parroquias` VALUES (679, 265, 'La Cruz');
INSERT INTO `parroquias` VALUES (680, 265, 'San Simón');
INSERT INTO `parroquias` VALUES (681, 265, 'El Corozo');
INSERT INTO `parroquias` VALUES (682, 265, 'El Furrial');
INSERT INTO `parroquias` VALUES (683, 265, 'Jusepín');
INSERT INTO `parroquias` VALUES (684, 265, 'La Pica');
INSERT INTO `parroquias` VALUES (685, 265, 'San Vicente');
INSERT INTO `parroquias` VALUES (686, 266, 'Aparicio');
INSERT INTO `parroquias` VALUES (687, 266, 'Aragua de Maturín');
INSERT INTO `parroquias` VALUES (688, 266, 'Chaguamal');
INSERT INTO `parroquias` VALUES (689, 266, 'El Pinto');
INSERT INTO `parroquias` VALUES (690, 266, 'Guanaguana');
INSERT INTO `parroquias` VALUES (691, 266, 'La Toscana');
INSERT INTO `parroquias` VALUES (692, 266, 'Taguaya');
INSERT INTO `parroquias` VALUES (693, 267, 'Cachipo');
INSERT INTO `parroquias` VALUES (694, 267, 'Quiriquire');
INSERT INTO `parroquias` VALUES (695, 268, 'Santa Bárbara');
INSERT INTO `parroquias` VALUES (696, 269, 'Barrancas');
INSERT INTO `parroquias` VALUES (697, 269, 'Los Barrancos de Fajardo');
INSERT INTO `parroquias` VALUES (698, 270, 'Uracoa');
INSERT INTO `parroquias` VALUES (699, 271, 'Antolín del Campo');
INSERT INTO `parroquias` VALUES (700, 272, 'Arismendi');
INSERT INTO `parroquias` VALUES (701, 273, 'García');
INSERT INTO `parroquias` VALUES (702, 273, 'Francisco Fajardo');
INSERT INTO `parroquias` VALUES (703, 274, 'Bolívar');
INSERT INTO `parroquias` VALUES (704, 274, 'Guevara');
INSERT INTO `parroquias` VALUES (705, 274, 'Matasiete');
INSERT INTO `parroquias` VALUES (706, 274, 'Santa Ana');
INSERT INTO `parroquias` VALUES (707, 274, 'Sucre');
INSERT INTO `parroquias` VALUES (708, 275, 'Aguirre');
INSERT INTO `parroquias` VALUES (709, 275, 'Maneiro');
INSERT INTO `parroquias` VALUES (710, 276, 'Adrián');
INSERT INTO `parroquias` VALUES (711, 276, 'Juan Griego');
INSERT INTO `parroquias` VALUES (712, 276, 'Yaguaraparo');
INSERT INTO `parroquias` VALUES (713, 277, 'Porlamar');
INSERT INTO `parroquias` VALUES (714, 278, 'San Francisco de Macanao');
INSERT INTO `parroquias` VALUES (715, 278, 'Boca de Río');
INSERT INTO `parroquias` VALUES (716, 279, 'Tubores');
INSERT INTO `parroquias` VALUES (717, 279, 'Los Baleales');
INSERT INTO `parroquias` VALUES (718, 280, 'Vicente Fuentes');
INSERT INTO `parroquias` VALUES (719, 280, 'Villalba');
INSERT INTO `parroquias` VALUES (720, 281, 'San Juan Bautista');
INSERT INTO `parroquias` VALUES (721, 281, 'Zabala');
INSERT INTO `parroquias` VALUES (722, 283, 'Capital Araure');
INSERT INTO `parroquias` VALUES (723, 283, 'Río Acarigua');
INSERT INTO `parroquias` VALUES (724, 284, 'Capital Esteller');
INSERT INTO `parroquias` VALUES (725, 284, 'Uveral');
INSERT INTO `parroquias` VALUES (726, 285, 'Guanare');
INSERT INTO `parroquias` VALUES (727, 285, 'Córdoba');
INSERT INTO `parroquias` VALUES (728, 285, 'San José de la Montaña');
INSERT INTO `parroquias` VALUES (729, 285, 'San Juan de Guanaguanare');
INSERT INTO `parroquias` VALUES (730, 285, 'Virgen de la Coromoto');
INSERT INTO `parroquias` VALUES (731, 286, 'Guanarito');
INSERT INTO `parroquias` VALUES (732, 286, 'Trinidad de la Capilla');
INSERT INTO `parroquias` VALUES (733, 286, 'Divina Pastora');
INSERT INTO `parroquias` VALUES (734, 287, 'Monseñor José Vicente de Unda');
INSERT INTO `parroquias` VALUES (735, 287, 'Peña Blanca');
INSERT INTO `parroquias` VALUES (736, 288, 'Capital Ospino');
INSERT INTO `parroquias` VALUES (737, 288, 'Aparición');
INSERT INTO `parroquias` VALUES (738, 288, 'La Estación');
INSERT INTO `parroquias` VALUES (739, 289, 'Páez');
INSERT INTO `parroquias` VALUES (740, 289, 'Payara');
INSERT INTO `parroquias` VALUES (741, 289, 'Pimpinela');
INSERT INTO `parroquias` VALUES (742, 289, 'Ramón Peraza');
INSERT INTO `parroquias` VALUES (743, 290, 'Papelón');
INSERT INTO `parroquias` VALUES (744, 290, 'Caño Delgadito');
INSERT INTO `parroquias` VALUES (745, 291, 'San Genaro de Boconoito');
INSERT INTO `parroquias` VALUES (746, 291, 'Antolín Tovar');
INSERT INTO `parroquias` VALUES (747, 292, 'San Rafael de Onoto');
INSERT INTO `parroquias` VALUES (748, 292, 'Santa Fe');
INSERT INTO `parroquias` VALUES (749, 292, 'Thermo Morles');
INSERT INTO `parroquias` VALUES (750, 293, 'Santa Rosalía');
INSERT INTO `parroquias` VALUES (751, 293, 'Florida');
INSERT INTO `parroquias` VALUES (752, 294, 'Sucre');
INSERT INTO `parroquias` VALUES (753, 294, 'Concepción');
INSERT INTO `parroquias` VALUES (754, 294, 'San Rafael de Palo Alzado');
INSERT INTO `parroquias` VALUES (755, 294, 'Uvencio Antonio Velásquez');
INSERT INTO `parroquias` VALUES (756, 294, 'San José de Saguaz');
INSERT INTO `parroquias` VALUES (757, 294, 'Villa Rosa');
INSERT INTO `parroquias` VALUES (758, 295, 'Turén');
INSERT INTO `parroquias` VALUES (759, 295, 'Canelones');
INSERT INTO `parroquias` VALUES (760, 295, 'Santa Cruz');
INSERT INTO `parroquias` VALUES (761, 295, 'San Isidro Labrador');
INSERT INTO `parroquias` VALUES (762, 296, 'Mariño');
INSERT INTO `parroquias` VALUES (763, 296, 'Rómulo Gallegos');
INSERT INTO `parroquias` VALUES (764, 297, 'San José de Aerocuar');
INSERT INTO `parroquias` VALUES (765, 297, 'Tavera Acosta');
INSERT INTO `parroquias` VALUES (766, 298, 'Río Caribe');
INSERT INTO `parroquias` VALUES (767, 298, 'Antonio José de Sucre');
INSERT INTO `parroquias` VALUES (768, 298, 'El Morro de Puerto Santo');
INSERT INTO `parroquias` VALUES (769, 298, 'Puerto Santo');
INSERT INTO `parroquias` VALUES (770, 298, 'San Juan de las Galdonas');
INSERT INTO `parroquias` VALUES (771, 299, 'El Pilar');
INSERT INTO `parroquias` VALUES (772, 299, 'El Rincón');
INSERT INTO `parroquias` VALUES (773, 299, 'General Francisco Antonio Váquez');
INSERT INTO `parroquias` VALUES (774, 299, 'Guaraúnos');
INSERT INTO `parroquias` VALUES (775, 299, 'Tunapuicito');
INSERT INTO `parroquias` VALUES (776, 299, 'Unión');
INSERT INTO `parroquias` VALUES (777, 300, 'Santa Catalina');
INSERT INTO `parroquias` VALUES (778, 300, 'Santa Rosa');
INSERT INTO `parroquias` VALUES (779, 300, 'Santa Teresa');
INSERT INTO `parroquias` VALUES (780, 300, 'Bolívar');
INSERT INTO `parroquias` VALUES (781, 300, 'Maracapana');
INSERT INTO `parroquias` VALUES (782, 302, 'Libertad');
INSERT INTO `parroquias` VALUES (783, 302, 'El Paujil');
INSERT INTO `parroquias` VALUES (784, 302, 'Yaguaraparo');
INSERT INTO `parroquias` VALUES (785, 303, 'Cruz Salmerón Acosta');
INSERT INTO `parroquias` VALUES (786, 303, 'Chacopata');
INSERT INTO `parroquias` VALUES (787, 303, 'Manicuare');
INSERT INTO `parroquias` VALUES (788, 304, 'Tunapuy');
INSERT INTO `parroquias` VALUES (789, 304, 'Campo Elías');
INSERT INTO `parroquias` VALUES (790, 305, 'Irapa');
INSERT INTO `parroquias` VALUES (791, 305, 'Campo Claro');
INSERT INTO `parroquias` VALUES (792, 305, 'Maraval');
INSERT INTO `parroquias` VALUES (793, 305, 'San Antonio de Irapa');
INSERT INTO `parroquias` VALUES (794, 305, 'Soro');
INSERT INTO `parroquias` VALUES (795, 306, 'Mejía');
INSERT INTO `parroquias` VALUES (796, 307, 'Cumanacoa');
INSERT INTO `parroquias` VALUES (797, 307, 'Arenas');
INSERT INTO `parroquias` VALUES (798, 307, 'Aricagua');
INSERT INTO `parroquias` VALUES (799, 307, 'Cogollar');
INSERT INTO `parroquias` VALUES (800, 307, 'San Fernando');
INSERT INTO `parroquias` VALUES (801, 307, 'San Lorenzo');
INSERT INTO `parroquias` VALUES (802, 308, 'Villa Frontado (Muelle de Cariaco)');
INSERT INTO `parroquias` VALUES (803, 308, 'Catuaro');
INSERT INTO `parroquias` VALUES (804, 308, 'Rendón');
INSERT INTO `parroquias` VALUES (805, 308, 'San Cruz');
INSERT INTO `parroquias` VALUES (806, 308, 'Santa María');
INSERT INTO `parroquias` VALUES (807, 309, 'Altagracia');
INSERT INTO `parroquias` VALUES (808, 309, 'Santa Inés');
INSERT INTO `parroquias` VALUES (809, 309, 'Valentín Valiente');
INSERT INTO `parroquias` VALUES (810, 309, 'Ayacucho');
INSERT INTO `parroquias` VALUES (811, 309, 'San Juan');
INSERT INTO `parroquias` VALUES (812, 309, 'Raúl Leoni');
INSERT INTO `parroquias` VALUES (813, 309, 'Gran Mariscal');
INSERT INTO `parroquias` VALUES (814, 310, 'Cristóbal Colón');
INSERT INTO `parroquias` VALUES (815, 310, 'Bideau');
INSERT INTO `parroquias` VALUES (816, 310, 'Punta de Piedras');
INSERT INTO `parroquias` VALUES (817, 310, 'Güiria');
INSERT INTO `parroquias` VALUES (818, 341, 'Andrés Bello');
INSERT INTO `parroquias` VALUES (819, 342, 'Antonio Rómulo Costa');
INSERT INTO `parroquias` VALUES (820, 343, 'Ayacucho');
INSERT INTO `parroquias` VALUES (821, 343, 'Rivas Berti');
INSERT INTO `parroquias` VALUES (822, 343, 'San Pedro del Río');
INSERT INTO `parroquias` VALUES (823, 344, 'Bolívar');
INSERT INTO `parroquias` VALUES (824, 344, 'Palotal');
INSERT INTO `parroquias` VALUES (825, 344, 'General Juan Vicente Gómez');
INSERT INTO `parroquias` VALUES (826, 344, 'Isaías Medina Angarita');
INSERT INTO `parroquias` VALUES (827, 345, 'Cárdenas');
INSERT INTO `parroquias` VALUES (828, 345, 'Amenodoro Ángel Lamus');
INSERT INTO `parroquias` VALUES (829, 345, 'La Florida');
INSERT INTO `parroquias` VALUES (830, 346, 'Córdoba');
INSERT INTO `parroquias` VALUES (831, 347, 'Fernández Feo');
INSERT INTO `parroquias` VALUES (832, 347, 'Alberto Adriani');
INSERT INTO `parroquias` VALUES (833, 347, 'Santo Domingo');
INSERT INTO `parroquias` VALUES (834, 348, 'Francisco de Miranda');
INSERT INTO `parroquias` VALUES (835, 349, 'García de Hevia');
INSERT INTO `parroquias` VALUES (836, 349, 'Boca de Grita');
INSERT INTO `parroquias` VALUES (837, 349, 'José Antonio Páez');
INSERT INTO `parroquias` VALUES (838, 350, 'Guásimos');
INSERT INTO `parroquias` VALUES (839, 351, 'Independencia');
INSERT INTO `parroquias` VALUES (840, 351, 'Juan Germán Roscio');
INSERT INTO `parroquias` VALUES (841, 351, 'Román Cárdenas');
INSERT INTO `parroquias` VALUES (842, 352, 'Jáuregui');
INSERT INTO `parroquias` VALUES (843, 352, 'Emilio Constantino Guerrero');
INSERT INTO `parroquias` VALUES (844, 352, 'Monseñor Miguel Antonio Salas');
INSERT INTO `parroquias` VALUES (845, 353, 'José María Vargas');
INSERT INTO `parroquias` VALUES (846, 354, 'Junín');
INSERT INTO `parroquias` VALUES (847, 354, 'La Petrólea');
INSERT INTO `parroquias` VALUES (848, 354, 'Quinimarí');
INSERT INTO `parroquias` VALUES (849, 354, 'Bramón');
INSERT INTO `parroquias` VALUES (850, 355, 'Libertad');
INSERT INTO `parroquias` VALUES (851, 355, 'Cipriano Castro');
INSERT INTO `parroquias` VALUES (852, 355, 'Manuel Felipe Rugeles');
INSERT INTO `parroquias` VALUES (853, 356, 'Libertador');
INSERT INTO `parroquias` VALUES (854, 356, 'Doradas');
INSERT INTO `parroquias` VALUES (855, 356, 'Emeterio Ochoa');
INSERT INTO `parroquias` VALUES (856, 356, 'San Joaquín de Navay');
INSERT INTO `parroquias` VALUES (857, 357, 'Lobatera');
INSERT INTO `parroquias` VALUES (858, 357, 'Constitución');
INSERT INTO `parroquias` VALUES (859, 358, 'Michelena');
INSERT INTO `parroquias` VALUES (860, 359, 'Panamericano');
INSERT INTO `parroquias` VALUES (861, 359, 'La Palmita');
INSERT INTO `parroquias` VALUES (862, 360, 'Pedro María Ureña');
INSERT INTO `parroquias` VALUES (863, 360, 'Nueva Arcadia');
INSERT INTO `parroquias` VALUES (864, 361, 'Delicias');
INSERT INTO `parroquias` VALUES (865, 361, 'Pecaya');
INSERT INTO `parroquias` VALUES (866, 362, 'Samuel Darío Maldonado');
INSERT INTO `parroquias` VALUES (867, 362, 'Boconó');
INSERT INTO `parroquias` VALUES (868, 362, 'Hernández');
INSERT INTO `parroquias` VALUES (869, 363, 'La Concordia');
INSERT INTO `parroquias` VALUES (870, 363, 'San Juan Bautista');
INSERT INTO `parroquias` VALUES (871, 363, 'Pedro María Morantes');
INSERT INTO `parroquias` VALUES (872, 363, 'San Sebastián');
INSERT INTO `parroquias` VALUES (873, 363, 'Dr. Francisco Romero Lobo');
INSERT INTO `parroquias` VALUES (874, 364, 'Seboruco');
INSERT INTO `parroquias` VALUES (875, 365, 'Simón Rodríguez');
INSERT INTO `parroquias` VALUES (876, 366, 'Sucre');
INSERT INTO `parroquias` VALUES (877, 366, 'Eleazar López Contreras');
INSERT INTO `parroquias` VALUES (878, 366, 'San Pablo');
INSERT INTO `parroquias` VALUES (879, 367, 'Torbes');
INSERT INTO `parroquias` VALUES (880, 368, 'Uribante');
INSERT INTO `parroquias` VALUES (881, 368, 'Cárdenas');
INSERT INTO `parroquias` VALUES (882, 368, 'Juan Pablo Peñalosa');
INSERT INTO `parroquias` VALUES (883, 368, 'Potosí');
INSERT INTO `parroquias` VALUES (884, 369, 'San Judas Tadeo');
INSERT INTO `parroquias` VALUES (885, 370, 'Araguaney');
INSERT INTO `parroquias` VALUES (886, 370, 'El Jaguito');
INSERT INTO `parroquias` VALUES (887, 370, 'La Esperanza');
INSERT INTO `parroquias` VALUES (888, 370, 'Santa Isabel');
INSERT INTO `parroquias` VALUES (889, 371, 'Boconó');
INSERT INTO `parroquias` VALUES (890, 371, 'El Carmen');
INSERT INTO `parroquias` VALUES (891, 371, 'Mosquey');
INSERT INTO `parroquias` VALUES (892, 371, 'Ayacucho');
INSERT INTO `parroquias` VALUES (893, 371, 'Burbusay');
INSERT INTO `parroquias` VALUES (894, 371, 'General Ribas');
INSERT INTO `parroquias` VALUES (895, 371, 'Guaramacal');
INSERT INTO `parroquias` VALUES (896, 371, 'Vega de Guaramacal');
INSERT INTO `parroquias` VALUES (897, 371, 'Monseñor Jáuregui');
INSERT INTO `parroquias` VALUES (898, 371, 'Rafael Rangel');
INSERT INTO `parroquias` VALUES (899, 371, 'San Miguel');
INSERT INTO `parroquias` VALUES (900, 371, 'San José');
INSERT INTO `parroquias` VALUES (901, 372, 'Sabana Grande');
INSERT INTO `parroquias` VALUES (902, 372, 'Cheregüé');
INSERT INTO `parroquias` VALUES (903, 372, 'Granados');
INSERT INTO `parroquias` VALUES (904, 373, 'Arnoldo Gabaldón');
INSERT INTO `parroquias` VALUES (905, 373, 'Bolivia');
INSERT INTO `parroquias` VALUES (906, 373, 'Carrillo');
INSERT INTO `parroquias` VALUES (907, 373, 'Cegarra');
INSERT INTO `parroquias` VALUES (908, 373, 'Chejendé');
INSERT INTO `parroquias` VALUES (909, 373, 'Manuel Salvador Ulloa');
INSERT INTO `parroquias` VALUES (910, 373, 'San José');
INSERT INTO `parroquias` VALUES (911, 374, 'Carache');
INSERT INTO `parroquias` VALUES (912, 374, 'La Concepción');
INSERT INTO `parroquias` VALUES (913, 374, 'Cuicas');
INSERT INTO `parroquias` VALUES (914, 374, 'Panamericana');
INSERT INTO `parroquias` VALUES (915, 374, 'Santa Cruz');
INSERT INTO `parroquias` VALUES (916, 375, 'Escuque');
INSERT INTO `parroquias` VALUES (917, 375, 'La Unión');
INSERT INTO `parroquias` VALUES (918, 375, 'Santa Rita');
INSERT INTO `parroquias` VALUES (919, 375, 'Sabana Libre');
INSERT INTO `parroquias` VALUES (920, 376, 'El Socorro');
INSERT INTO `parroquias` VALUES (921, 376, 'Los Caprichos');
INSERT INTO `parroquias` VALUES (922, 376, 'Antonio José de Sucre');
INSERT INTO `parroquias` VALUES (923, 377, 'Campo Elías');
INSERT INTO `parroquias` VALUES (924, 377, 'Arnoldo Gabaldón');
INSERT INTO `parroquias` VALUES (925, 378, 'Santa Apolonia');
INSERT INTO `parroquias` VALUES (926, 378, 'El Progreso');
INSERT INTO `parroquias` VALUES (927, 378, 'La Ceiba');
INSERT INTO `parroquias` VALUES (928, 378, 'Tres de Febrero');
INSERT INTO `parroquias` VALUES (929, 379, 'El Dividive');
INSERT INTO `parroquias` VALUES (930, 379, 'Agua Santa');
INSERT INTO `parroquias` VALUES (931, 379, 'Agua Caliente');
INSERT INTO `parroquias` VALUES (932, 379, 'El Cenizo');
INSERT INTO `parroquias` VALUES (933, 379, 'Valerita');
INSERT INTO `parroquias` VALUES (934, 380, 'Monte Carmelo');
INSERT INTO `parroquias` VALUES (935, 380, 'Buena Vista');
INSERT INTO `parroquias` VALUES (936, 380, 'Santa María del Horcón');
INSERT INTO `parroquias` VALUES (937, 381, 'Motatán');
INSERT INTO `parroquias` VALUES (938, 381, 'El Baño');
INSERT INTO `parroquias` VALUES (939, 381, 'Jalisco');
INSERT INTO `parroquias` VALUES (940, 382, 'Pampán');
INSERT INTO `parroquias` VALUES (941, 382, 'Flor de Patria');
INSERT INTO `parroquias` VALUES (942, 382, 'La Paz');
INSERT INTO `parroquias` VALUES (943, 382, 'Santa Ana');
INSERT INTO `parroquias` VALUES (944, 383, 'Pampanito');
INSERT INTO `parroquias` VALUES (945, 383, 'La Concepción');
INSERT INTO `parroquias` VALUES (946, 383, 'Pampanito II');
INSERT INTO `parroquias` VALUES (947, 384, 'Betijoque');
INSERT INTO `parroquias` VALUES (948, 384, 'José Gregorio Hernández');
INSERT INTO `parroquias` VALUES (949, 384, 'La Pueblita');
INSERT INTO `parroquias` VALUES (950, 384, 'Los Cedros');
INSERT INTO `parroquias` VALUES (951, 385, 'Carvajal');
INSERT INTO `parroquias` VALUES (952, 385, 'Campo Alegre');
INSERT INTO `parroquias` VALUES (953, 385, 'Antonio Nicolás Briceño');
INSERT INTO `parroquias` VALUES (954, 385, 'José Leonardo Suárez');
INSERT INTO `parroquias` VALUES (955, 386, 'Sabana de Mendoza');
INSERT INTO `parroquias` VALUES (956, 386, 'Junín');
INSERT INTO `parroquias` VALUES (957, 386, 'Valmore Rodríguez');
INSERT INTO `parroquias` VALUES (958, 386, 'El Paraíso');
INSERT INTO `parroquias` VALUES (959, 387, 'Andrés Linares');
INSERT INTO `parroquias` VALUES (960, 387, 'Chiquinquirá');
INSERT INTO `parroquias` VALUES (961, 387, 'Cristóbal Mendoza');
INSERT INTO `parroquias` VALUES (962, 387, 'Cruz Carrillo');
INSERT INTO `parroquias` VALUES (963, 387, 'Matriz');
INSERT INTO `parroquias` VALUES (964, 387, 'Monseñor Carrillo');
INSERT INTO `parroquias` VALUES (965, 387, 'Tres Esquinas');
INSERT INTO `parroquias` VALUES (966, 388, 'Cabimbú');
INSERT INTO `parroquias` VALUES (967, 388, 'Jajó');
INSERT INTO `parroquias` VALUES (968, 388, 'La Mesa de Esnujaque');
INSERT INTO `parroquias` VALUES (969, 388, 'Santiago');
INSERT INTO `parroquias` VALUES (970, 388, 'Tuñame');
INSERT INTO `parroquias` VALUES (971, 388, 'La Quebrada');
INSERT INTO `parroquias` VALUES (972, 389, 'Juan Ignacio Montilla');
INSERT INTO `parroquias` VALUES (973, 389, 'La Beatriz');
INSERT INTO `parroquias` VALUES (974, 389, 'La Puerta');
INSERT INTO `parroquias` VALUES (975, 389, 'Mendoza del Valle de Momboy');
INSERT INTO `parroquias` VALUES (976, 389, 'Mercedes Díaz');
INSERT INTO `parroquias` VALUES (977, 389, 'San Luis');
INSERT INTO `parroquias` VALUES (978, 390, 'Caraballeda');
INSERT INTO `parroquias` VALUES (979, 390, 'Carayaca');
INSERT INTO `parroquias` VALUES (980, 390, 'Carlos Soublette');
INSERT INTO `parroquias` VALUES (981, 390, 'Caruao Chuspa');
INSERT INTO `parroquias` VALUES (982, 390, 'Catia La Mar');
INSERT INTO `parroquias` VALUES (983, 390, 'El Junko');
INSERT INTO `parroquias` VALUES (984, 390, 'La Guaira');
INSERT INTO `parroquias` VALUES (985, 390, 'Macuto');
INSERT INTO `parroquias` VALUES (986, 390, 'Maiquetía');
INSERT INTO `parroquias` VALUES (987, 390, 'Naiguatá');
INSERT INTO `parroquias` VALUES (988, 390, 'Urimare');
INSERT INTO `parroquias` VALUES (989, 391, 'Arístides Bastidas');
INSERT INTO `parroquias` VALUES (990, 392, 'Bolívar');
INSERT INTO `parroquias` VALUES (991, 407, 'Chivacoa');
INSERT INTO `parroquias` VALUES (992, 407, 'Campo Elías');
INSERT INTO `parroquias` VALUES (993, 408, 'Cocorote');
INSERT INTO `parroquias` VALUES (994, 409, 'Independencia');
INSERT INTO `parroquias` VALUES (995, 410, 'José Antonio Páez');
INSERT INTO `parroquias` VALUES (996, 411, 'La Trinidad');
INSERT INTO `parroquias` VALUES (997, 412, 'Manuel Monge');
INSERT INTO `parroquias` VALUES (998, 413, 'Salóm');
INSERT INTO `parroquias` VALUES (999, 413, 'Temerla');
INSERT INTO `parroquias` VALUES (1000, 413, 'Nirgua');
INSERT INTO `parroquias` VALUES (1001, 414, 'San Andrés');
INSERT INTO `parroquias` VALUES (1002, 414, 'Yaritagua');
INSERT INTO `parroquias` VALUES (1003, 415, 'San Javier');
INSERT INTO `parroquias` VALUES (1004, 415, 'Albarico');
INSERT INTO `parroquias` VALUES (1005, 415, 'San Felipe');
INSERT INTO `parroquias` VALUES (1006, 416, 'Sucre');
INSERT INTO `parroquias` VALUES (1007, 417, 'Urachiche');
INSERT INTO `parroquias` VALUES (1008, 418, 'El Guayabo');
INSERT INTO `parroquias` VALUES (1009, 418, 'Farriar');
INSERT INTO `parroquias` VALUES (1010, 441, 'Isla de Toas');
INSERT INTO `parroquias` VALUES (1011, 441, 'Monagas');
INSERT INTO `parroquias` VALUES (1012, 442, 'San Timoteo');
INSERT INTO `parroquias` VALUES (1013, 442, 'General Urdaneta');
INSERT INTO `parroquias` VALUES (1014, 442, 'Libertador');
INSERT INTO `parroquias` VALUES (1015, 442, 'Marcelino Briceño');
INSERT INTO `parroquias` VALUES (1016, 442, 'Pueblo Nuevo');
INSERT INTO `parroquias` VALUES (1017, 442, 'Manuel Guanipa Matos');
INSERT INTO `parroquias` VALUES (1018, 443, 'Ambrosio');
INSERT INTO `parroquias` VALUES (1019, 443, 'Carmen Herrera');
INSERT INTO `parroquias` VALUES (1020, 443, 'La Rosa');
INSERT INTO `parroquias` VALUES (1021, 443, 'Germán Ríos Linares');
INSERT INTO `parroquias` VALUES (1022, 443, 'San Benito');
INSERT INTO `parroquias` VALUES (1023, 443, 'Rómulo Betancourt');
INSERT INTO `parroquias` VALUES (1024, 443, 'Jorge Hernández');
INSERT INTO `parroquias` VALUES (1025, 443, 'Punta Gorda');
INSERT INTO `parroquias` VALUES (1026, 443, 'Arístides Calvani');
INSERT INTO `parroquias` VALUES (1027, 444, 'Encontrados');
INSERT INTO `parroquias` VALUES (1028, 444, 'Udón Pérez');
INSERT INTO `parroquias` VALUES (1029, 445, 'Moralito');
INSERT INTO `parroquias` VALUES (1030, 445, 'San Carlos del Zulia');
INSERT INTO `parroquias` VALUES (1031, 445, 'Santa Cruz del Zulia');
INSERT INTO `parroquias` VALUES (1032, 445, 'Santa Bárbara');
INSERT INTO `parroquias` VALUES (1033, 445, 'Urribarrí');
INSERT INTO `parroquias` VALUES (1034, 446, 'Carlos Quevedo');
INSERT INTO `parroquias` VALUES (1035, 446, 'Francisco Javier Pulgar');
INSERT INTO `parroquias` VALUES (1036, 446, 'Simón Rodríguez');
INSERT INTO `parroquias` VALUES (1037, 446, 'Guamo-Gavilanes');
INSERT INTO `parroquias` VALUES (1038, 448, 'La Concepción');
INSERT INTO `parroquias` VALUES (1039, 448, 'San José');
INSERT INTO `parroquias` VALUES (1040, 448, 'Mariano Parra León');
INSERT INTO `parroquias` VALUES (1041, 448, 'José Ramón Yépez');
INSERT INTO `parroquias` VALUES (1042, 449, 'Jesús María Semprún');
INSERT INTO `parroquias` VALUES (1043, 449, 'Barí');
INSERT INTO `parroquias` VALUES (1044, 450, 'Concepción');
INSERT INTO `parroquias` VALUES (1045, 450, 'Andrés Bello');
INSERT INTO `parroquias` VALUES (1046, 450, 'Chiquinquirá');
INSERT INTO `parroquias` VALUES (1047, 450, 'El Carmelo');
INSERT INTO `parroquias` VALUES (1048, 450, 'Potreritos');
INSERT INTO `parroquias` VALUES (1049, 451, 'Libertad');
INSERT INTO `parroquias` VALUES (1050, 451, 'Alonso de Ojeda');
INSERT INTO `parroquias` VALUES (1051, 451, 'Venezuela');
INSERT INTO `parroquias` VALUES (1052, 451, 'Eleazar López Contreras');
INSERT INTO `parroquias` VALUES (1053, 451, 'Campo Lara');
INSERT INTO `parroquias` VALUES (1054, 452, 'Bartolomé de las Casas');
INSERT INTO `parroquias` VALUES (1055, 452, 'Libertad');
INSERT INTO `parroquias` VALUES (1056, 452, 'Río Negro');
INSERT INTO `parroquias` VALUES (1057, 452, 'San José de Perijá');
INSERT INTO `parroquias` VALUES (1058, 453, 'San Rafael');
INSERT INTO `parroquias` VALUES (1059, 453, 'La Sierrita');
INSERT INTO `parroquias` VALUES (1060, 453, 'Las Parcelas');
INSERT INTO `parroquias` VALUES (1061, 453, 'Luis de Vicente');
INSERT INTO `parroquias` VALUES (1062, 453, 'Monseñor Marcos Sergio Godoy');
INSERT INTO `parroquias` VALUES (1063, 453, 'Ricaurte');
INSERT INTO `parroquias` VALUES (1064, 453, 'Tamare');
INSERT INTO `parroquias` VALUES (1065, 454, 'Antonio Borjas Romero');
INSERT INTO `parroquias` VALUES (1066, 454, 'Bolívar');
INSERT INTO `parroquias` VALUES (1067, 454, 'Cacique Mara');
INSERT INTO `parroquias` VALUES (1068, 454, 'Carracciolo Parra Pérez');
INSERT INTO `parroquias` VALUES (1069, 454, 'Cecilio Acosta');
INSERT INTO `parroquias` VALUES (1070, 454, 'Cristo de Aranza');
INSERT INTO `parroquias` VALUES (1071, 454, 'Coquivacoa');
INSERT INTO `parroquias` VALUES (1072, 454, 'Chiquinquirá');
INSERT INTO `parroquias` VALUES (1073, 454, 'Francisco Eugenio Bustamante');
INSERT INTO `parroquias` VALUES (1074, 454, 'Idelfonzo Vásquez');
INSERT INTO `parroquias` VALUES (1075, 454, 'Juana de Ávila');
INSERT INTO `parroquias` VALUES (1076, 454, 'Luis Hurtado Higuera');
INSERT INTO `parroquias` VALUES (1077, 454, 'Manuel Dagnino');
INSERT INTO `parroquias` VALUES (1078, 454, 'Olegario Villalobos');
INSERT INTO `parroquias` VALUES (1079, 454, 'Raúl Leoni');
INSERT INTO `parroquias` VALUES (1080, 454, 'Santa Lucía');
INSERT INTO `parroquias` VALUES (1081, 454, 'Venancio Pulgar');
INSERT INTO `parroquias` VALUES (1082, 454, 'San Isidro');
INSERT INTO `parroquias` VALUES (1083, 455, 'Altagracia');
INSERT INTO `parroquias` VALUES (1084, 455, 'Faría');
INSERT INTO `parroquias` VALUES (1085, 455, 'Ana María Campos');
INSERT INTO `parroquias` VALUES (1086, 455, 'San Antonio');
INSERT INTO `parroquias` VALUES (1087, 455, 'San José');
INSERT INTO `parroquias` VALUES (1088, 456, 'Donaldo García');
INSERT INTO `parroquias` VALUES (1089, 456, 'El Rosario');
INSERT INTO `parroquias` VALUES (1090, 456, 'Sixto Zambrano');
INSERT INTO `parroquias` VALUES (1091, 457, 'San Francisco');
INSERT INTO `parroquias` VALUES (1092, 457, 'El Bajo');
INSERT INTO `parroquias` VALUES (1093, 457, 'Domitila Flores');
INSERT INTO `parroquias` VALUES (1094, 457, 'Francisco Ochoa');
INSERT INTO `parroquias` VALUES (1095, 457, 'Los Cortijos');
INSERT INTO `parroquias` VALUES (1096, 457, 'Marcial Hernández');
INSERT INTO `parroquias` VALUES (1097, 458, 'Santa Rita');
INSERT INTO `parroquias` VALUES (1098, 458, 'El Mene');
INSERT INTO `parroquias` VALUES (1099, 458, 'Pedro Lucas Urribarrí');
INSERT INTO `parroquias` VALUES (1100, 458, 'José Cenobio Urribarrí');
INSERT INTO `parroquias` VALUES (1101, 459, 'Rafael Maria Baralt');
INSERT INTO `parroquias` VALUES (1102, 459, 'Manuel Manrique');
INSERT INTO `parroquias` VALUES (1103, 459, 'Rafael Urdaneta');
INSERT INTO `parroquias` VALUES (1104, 460, 'Bobures');
INSERT INTO `parroquias` VALUES (1105, 460, 'Gibraltar');
INSERT INTO `parroquias` VALUES (1106, 460, 'Heras');
INSERT INTO `parroquias` VALUES (1107, 460, 'Monseñor Arturo Álvarez');
INSERT INTO `parroquias` VALUES (1108, 460, 'Rómulo Gallegos');
INSERT INTO `parroquias` VALUES (1109, 460, 'El Batey');
INSERT INTO `parroquias` VALUES (1110, 461, 'Rafael Urdaneta');
INSERT INTO `parroquias` VALUES (1111, 461, 'La Victoria');
INSERT INTO `parroquias` VALUES (1112, 461, 'Raúl Cuenca');
INSERT INTO `parroquias` VALUES (1113, 447, 'Sinamaica');
INSERT INTO `parroquias` VALUES (1114, 447, 'Alta Guajira');
INSERT INTO `parroquias` VALUES (1115, 447, 'Elías Sánchez Rubio');
INSERT INTO `parroquias` VALUES (1116, 447, 'Guajira');
INSERT INTO `parroquias` VALUES (1117, 462, 'Altagracia');
INSERT INTO `parroquias` VALUES (1118, 462, 'Antímano');
INSERT INTO `parroquias` VALUES (1119, 462, 'Caricuao');
INSERT INTO `parroquias` VALUES (1120, 462, 'Catedral');
INSERT INTO `parroquias` VALUES (1121, 462, 'Coche');
INSERT INTO `parroquias` VALUES (1122, 462, 'El Junquito');
INSERT INTO `parroquias` VALUES (1123, 462, 'El Paraíso');
INSERT INTO `parroquias` VALUES (1124, 462, 'El Recreo');
INSERT INTO `parroquias` VALUES (1125, 462, 'El Valle');
INSERT INTO `parroquias` VALUES (1126, 462, 'La Candelaria');
INSERT INTO `parroquias` VALUES (1127, 462, 'La Pastora');
INSERT INTO `parroquias` VALUES (1128, 462, 'La Vega');
INSERT INTO `parroquias` VALUES (1129, 462, 'Macarao');
INSERT INTO `parroquias` VALUES (1130, 462, 'San Agustín');
INSERT INTO `parroquias` VALUES (1131, 462, 'San Bernardino');
INSERT INTO `parroquias` VALUES (1132, 462, 'San José');
INSERT INTO `parroquias` VALUES (1133, 462, 'San Juan');
INSERT INTO `parroquias` VALUES (1134, 462, 'San Pedro');
INSERT INTO `parroquias` VALUES (1135, 462, 'Santa Rosalía');
INSERT INTO `parroquias` VALUES (1136, 462, 'Santa Teresa');
INSERT INTO `parroquias` VALUES (1137, 462, 'Sucre (Catia)');
INSERT INTO `parroquias` VALUES (1138, 462, '23 de enero');

-- ----------------------------
-- Table structure for perfiles
-- ----------------------------
DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE `perfiles`  (
  `id_perfil` int NOT NULL AUTO_INCREMENT,
  `id_institucion` int NULL DEFAULT NULL,
  `perfil` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_perfil`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of perfiles
-- ----------------------------
INSERT INTO `perfiles` VALUES (1, 0, 'Desarrollador', '1', '2023-10-24 00:36:52');
INSERT INTO `perfiles` VALUES (2, 0, 'Paciente', '1', '2023-11-21 09:59:03');
INSERT INTO `perfiles` VALUES (3, 1, 'Medico', '1', '2023-11-21 10:52:05');
INSERT INTO `perfiles` VALUES (4, 2, 'Medico', '1', '2023-11-22 02:53:49');
INSERT INTO `perfiles` VALUES (5, 1, 'Pediatra', '1', '2023-11-22 02:59:07');
INSERT INTO `perfiles` VALUES (6, 1, 'Administrador', '1', '2023-11-22 02:59:34');
INSERT INTO `perfiles` VALUES (7, 2, 'Administrador', '1', '2023-11-22 03:00:14');

-- ----------------------------
-- Table structure for personal
-- ----------------------------
DROP TABLE IF EXISTS `personal`;
CREATE TABLE `personal`  (
  `id_personal` int NOT NULL AUTO_INCREMENT,
  `id_tipo_persona` int NULL DEFAULT NULL,
  `cedula` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nombres` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_nacimiento` date NULL DEFAULT NULL,
  `id_genero` int NULL DEFAULT NULL,
  `id_estado` int NULL DEFAULT NULL,
  `id_municipio` int NULL DEFAULT NULL,
  `id_parroquia` int NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `colegiatura` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_personal`) USING BTREE,
  INDEX `id_tipo_persona`(`id_tipo_persona`) USING BTREE,
  INDEX `id_genero`(`id_genero`) USING BTREE,
  INDEX `id_estado`(`id_estado`) USING BTREE,
  INDEX `id_municipio`(`id_municipio`) USING BTREE,
  INDEX `id_parroquia`(`id_parroquia`) USING BTREE,
  CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`id_tipo_persona`) REFERENCES `tipos_persona` (`id_tipo_persona`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `personal_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `personal_ibfk_4` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `personal_ibfk_5` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id_parroquia`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal
-- ----------------------------
INSERT INTO `personal` VALUES (1, 1, '1234', 'Jose', 'Perez', '2005-11-22', 2, 4, 36, 113, 'Maracay', '1234', '1', '2023-11-22 21:32:27');
INSERT INTO `personal` VALUES (2, 2, '4321', 'Maria', 'Mendez', '2005-11-22', 1, 4, 41, 122, 'La victoria', '4321', '1', '2023-11-22 21:43:18');

-- ----------------------------
-- Table structure for planificacion
-- ----------------------------
DROP TABLE IF EXISTS `planificacion`;
CREATE TABLE `planificacion`  (
  `id_planificacion` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NULL DEFAULT NULL,
  `id_cirugia` int NULL DEFAULT NULL,
  `id_institucion` int NULL DEFAULT NULL,
  `id_quirofano` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `observaciones` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_planificacion`) USING BTREE,
  INDEX `id_quirofano`(`id_quirofano`) USING BTREE,
  INDEX `id_institucion`(`id_institucion`) USING BTREE,
  INDEX `id_cirugia`(`id_cirugia`) USING BTREE,
  INDEX `id_paciente`(`id_paciente`) USING BTREE,
  CONSTRAINT `planificacion_ibfk_1` FOREIGN KEY (`id_quirofano`) REFERENCES `quirofanos` (`id_quirofano`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `planificacion_ibfk_2` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `planificacion_ibfk_3` FOREIGN KEY (`id_cirugia`) REFERENCES `cirugias` (`id_cirugia`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `planificacion_ibfk_4` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of planificacion
-- ----------------------------

-- ----------------------------
-- Table structure for prescripciones
-- ----------------------------
DROP TABLE IF EXISTS `prescripciones`;
CREATE TABLE `prescripciones`  (
  `id_prescripcion` int NOT NULL AUTO_INCREMENT,
  `id_diagnostico` int NULL DEFAULT NULL,
  `id_insumo` int NULL DEFAULT NULL,
  `dosis` decimal(8, 2) NULL DEFAULT NULL,
  `frecuencia` int NULL DEFAULT NULL,
  `fecha_inicio` date NULL DEFAULT NULL,
  `fecha_final` date NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_prescripcion`) USING BTREE,
  INDEX `id_diagnostico`(`id_diagnostico`) USING BTREE,
  INDEX `id_insumo`(`id_insumo`) USING BTREE,
  CONSTRAINT `prescripciones_ibfk_1` FOREIGN KEY (`id_diagnostico`) REFERENCES `diagnosticos` (`id_diagnostico`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `prescripciones_ibfk_2` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id_insumo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of prescripciones
-- ----------------------------

-- ----------------------------
-- Table structure for prioridades
-- ----------------------------
DROP TABLE IF EXISTS `prioridades`;
CREATE TABLE `prioridades`  (
  `id_prioridad` int NOT NULL AUTO_INCREMENT,
  `prioridad` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_prioridad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of prioridades
-- ----------------------------
INSERT INTO `prioridades` VALUES (1, 'Baja');
INSERT INTO `prioridades` VALUES (2, 'Media');
INSERT INTO `prioridades` VALUES (3, 'Alta');
INSERT INTO `prioridades` VALUES (4, 'Emergencia');

-- ----------------------------
-- Table structure for privilegios
-- ----------------------------
DROP TABLE IF EXISTS `privilegios`;
CREATE TABLE `privilegios`  (
  `id_privilegio` int NOT NULL AUTO_INCREMENT,
  `id_perfil` int NULL DEFAULT NULL,
  `registros_pacientes` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `registros_personal` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `registros_instituciones` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `registros_perfiles` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `citas_solicitar` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `citas_especialidades` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `planificacion_programar` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `planificacion_cirugias` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `planificacion_quirofanos` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `insumos_articulos` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `insumos_ajustes` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `historial_diagnosticos` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `historial_enfermedades` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `historial_tratamientos` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `historial_examenes` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `historial_prescripciones` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `historial_seguimientos` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `seguridad_bitacora` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `insumos_reporte` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `seguridad_bd` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_privilegio`) USING BTREE,
  INDEX `id_perfil`(`id_perfil`) USING BTREE,
  CONSTRAINT `privilegios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of privilegios
-- ----------------------------
INSERT INTO `privilegios` VALUES (1, 1, 'crud', 'crud', 'crud', 'crud', 'cruda', 'crud', 'cruda', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'r', 'r', 'cu');
INSERT INTO `privilegios` VALUES (2, 2, NULL, NULL, NULL, NULL, 'crud', NULL, NULL, NULL, NULL, NULL, NULL, 'r', 'r', 'r', 'crud', 'r', 'r', NULL, NULL, NULL);
INSERT INTO `privilegios` VALUES (3, 3, 'crud', NULL, NULL, NULL, 'cruda', NULL, 'cruda', 'crud', NULL, 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', NULL, 'r', NULL);
INSERT INTO `privilegios` VALUES (4, 4, 'crud', NULL, NULL, NULL, 'cruda', NULL, 'cruda', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', NULL, 'r', NULL);
INSERT INTO `privilegios` VALUES (5, 5, 'crud', NULL, NULL, NULL, 'cruda', NULL, 'cruda', 'crud', NULL, 'r', NULL, 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', NULL, 'r', NULL);
INSERT INTO `privilegios` VALUES (6, 6, 'crud', 'crud', 'crud', 'crud', 'cruda', 'crud', 'cruda', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'r', NULL);
INSERT INTO `privilegios` VALUES (7, 7, 'crud', 'crud', 'crud', 'crud', 'cruda', 'crud', 'cruda', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'r', NULL);

-- ----------------------------
-- Table structure for quirofanos
-- ----------------------------
DROP TABLE IF EXISTS `quirofanos`;
CREATE TABLE `quirofanos`  (
  `id_quirofano` int NOT NULL AUTO_INCREMENT,
  `id_institucion` int NULL DEFAULT NULL,
  `quirofano` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `observaciones` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ubicacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_quirofano`) USING BTREE,
  INDEX `id_institucion`(`id_institucion`) USING BTREE,
  CONSTRAINT `quirofanos_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of quirofanos
-- ----------------------------

-- ----------------------------
-- Table structure for representantes
-- ----------------------------
DROP TABLE IF EXISTS `representantes`;
CREATE TABLE `representantes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NULL DEFAULT NULL,
  `id_representante` int NULL DEFAULT NULL,
  `id_parentesco` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_paciente`(`id_paciente`) USING BTREE,
  INDEX `id_parentesco`(`id_parentesco`) USING BTREE,
  INDEX `id_representante`(`id_representante`) USING BTREE,
  CONSTRAINT `representantes_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `representantes_ibfk_2` FOREIGN KEY (`id_parentesco`) REFERENCES `parentescos` (`id_parentesco`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `representantes_ibfk_3` FOREIGN KEY (`id_representante`) REFERENCES `pacientes` (`id_paciente`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of representantes
-- ----------------------------
INSERT INTO `representantes` VALUES (1, 2, NULL, 2);
INSERT INTO `representantes` VALUES (2, 3, NULL, 6);
INSERT INTO `representantes` VALUES (3, 4, 1, 6);

-- ----------------------------
-- Table structure for seguimientos
-- ----------------------------
DROP TABLE IF EXISTS `seguimientos`;
CREATE TABLE `seguimientos`  (
  `id_seguimiento` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NULL DEFAULT NULL,
  `fecha_seguimiento` datetime NULL DEFAULT current_timestamp,
  `peso` decimal(5, 2) NULL DEFAULT NULL,
  `estatura` decimal(5, 2) NULL DEFAULT NULL,
  `temperatura` decimal(3, 1) NULL DEFAULT NULL,
  `presion_sistolica` decimal(4, 1) NULL DEFAULT NULL,
  `presion_diastolica` decimal(4, 1) NULL DEFAULT NULL,
  `frecuencia_cardiaca` decimal(4, 1) NULL DEFAULT NULL,
  `frecuencia_respiratoria` int NULL DEFAULT NULL,
  `saturacion_oxigeno` decimal(3, 1) NULL DEFAULT NULL,
  `glucemia` decimal(4, 1) NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_seguimiento`) USING BTREE,
  INDEX `id_paciente`(`id_paciente`) USING BTREE,
  CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of seguimientos
-- ----------------------------

-- ----------------------------
-- Table structure for submenu
-- ----------------------------
DROP TABLE IF EXISTS `submenu`;
CREATE TABLE `submenu`  (
  `id_submenu` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NULL DEFAULT NULL,
  `submenu` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `href` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `privilegio` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `crud` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_submenu`) USING BTREE,
  INDEX `id_menu`(`id_menu`) USING BTREE,
  CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of submenu
-- ----------------------------
INSERT INTO `submenu` VALUES (1, 1, 'Pacientes', 'registros/pacientes', 'registros_pacientes', 'crud');
INSERT INTO `submenu` VALUES (2, 1, 'Personal', 'registros/personal', 'registros_personal', 'crud');
INSERT INTO `submenu` VALUES (3, 1, 'Instituciones', 'registros/instituciones', 'registros_instituciones', 'crud');
INSERT INTO `submenu` VALUES (4, 1, 'Perfiles', 'registros/perfiles', 'registros_perfiles', 'crud');
INSERT INTO `submenu` VALUES (5, 3, 'Solicitudes de cita', 'citas/solicitar', 'citas_solicitar', 'cruda');
INSERT INTO `submenu` VALUES (6, 3, 'Especialidades', 'citas/especialidades', 'citas_especialidades', 'crud');
INSERT INTO `submenu` VALUES (7, 4, 'Programación de cirugía', 'planificacion/programar', 'planificacion_programar', 'cruda');
INSERT INTO `submenu` VALUES (8, 4, 'Cirugías', 'planificacion/cirugias', 'planificacion_cirugias', 'crud');
INSERT INTO `submenu` VALUES (9, 4, 'Quirófanos', 'planificacion/quirofanos', 'planificacion_quirofanos', 'crud');
INSERT INTO `submenu` VALUES (10, 5, 'Insumos', 'insumos/articulos', 'insumos_articulos', 'crud');
INSERT INTO `submenu` VALUES (11, 5, 'Ajustes de inventario', 'insumos/ajustes', 'insumos_ajustes', 'crud');
INSERT INTO `submenu` VALUES (12, 2, 'Diagnósticos', 'historial/diagnosticos', 'historial_diagnosticos', 'crud');
INSERT INTO `submenu` VALUES (13, 2, 'Enfermedades', 'historial/enfermedades', 'historial_enfermedades', 'crud');
INSERT INTO `submenu` VALUES (14, 2, 'Tratamientos', 'historial/tratamientos', 'historial_tratamientos', 'crud');
INSERT INTO `submenu` VALUES (15, 2, 'Examenes', 'historial/examenes', 'historial_examenes', 'crud');
INSERT INTO `submenu` VALUES (16, 2, 'Prescripciones', 'historial/prescripciones', 'historial_prescripciones', 'crud');
INSERT INTO `submenu` VALUES (17, 2, 'Seguimientos', 'historial/seguimientos', 'historial_seguimientos', 'crud');
INSERT INTO `submenu` VALUES (18, 6, 'Bitácora', 'seguridad/bitacora', 'seguridad_bitacora', 'crud');
INSERT INTO `submenu` VALUES (20, 5, 'Reporte de inventario', '', 'insumos_reporte', 'r');
INSERT INTO `submenu` VALUES (21, 6, 'Base de datos', 'seguridad/bd', 'seguridad_bd', 'c');

-- ----------------------------
-- Table structure for tipos_persona
-- ----------------------------
DROP TABLE IF EXISTS `tipos_persona`;
CREATE TABLE `tipos_persona`  (
  `id_tipo_persona` int NOT NULL AUTO_INCREMENT,
  `tipo_persona` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_persona`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipos_persona
-- ----------------------------
INSERT INTO `tipos_persona` VALUES (1, 'Venezolana');
INSERT INTO `tipos_persona` VALUES (2, 'Extranjera');
INSERT INTO `tipos_persona` VALUES (3, 'Juridica');
INSERT INTO `tipos_persona` VALUES (4, 'Gubernamental');

-- ----------------------------
-- Table structure for tratamientos
-- ----------------------------
DROP TABLE IF EXISTS `tratamientos`;
CREATE TABLE `tratamientos`  (
  `id_tratamiento` int NOT NULL AUTO_INCREMENT,
  `id_insumo` int NULL DEFAULT NULL,
  `dosis` decimal(8, 2) NULL DEFAULT NULL,
  `frecuencia` int NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_modificacion` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tratamiento`) USING BTREE,
  INDEX `id_insumo`(`id_insumo`) USING BTREE,
  CONSTRAINT `tratamientos_ibfk_1` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id_insumo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tratamientos
-- ----------------------------

-- ----------------------------
-- Table structure for unidades_medida
-- ----------------------------
DROP TABLE IF EXISTS `unidades_medida`;
CREATE TABLE `unidades_medida`  (
  `id_unidad_medida` int NOT NULL AUTO_INCREMENT,
  `medida` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `notacion` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_unidad_medida`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of unidades_medida
-- ----------------------------
INSERT INTO `unidades_medida` VALUES (1, 'Unidad', 'unid');
INSERT INTO `unidades_medida` VALUES (2, 'Miligramos', 'mg');
INSERT INTO `unidades_medida` VALUES (3, 'Mililitros', 'ml');
INSERT INTO `unidades_medida` VALUES (4, 'Centimetros', 'cm');
INSERT INTO `unidades_medida` VALUES (5, 'Centimetros cubicos', 'cm3');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `clave` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tlf` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pregunta` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `respuesta` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `avatar` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `fecha_modificacion` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'admin', '76aaa230cc0ead12b8401a1bd91fd2ed271b120fc9b6f6835fa16e4c4bc614663b37bea9204dc93bef3df487076c49ff5fb1c3c961dcad1ecc746de2b2d460dars+e3dWOpo57SeJIYictvol4a9AHLgH2HJnhHkUwNKc=', 'desarrollador@correo.com', '0412-1234567', 'e747b96f3345c772281c85ec2afff144ddf0729027ac88a96b47959bb96991fa75d6a87b2e63ddbc9f384b700514f6e40f7f67ce3934e6a4ed566ffc6b13ccd35WORS0VVCIlf4VquhM/D+9edfgaBbyCbkJJKNE9+LXg=', 'fe87283bda2bbb31403f91e782181ef7e8e6afa1e6b884bb468950b24ed42ad62aaaad3c00ecff0713379256f2b769ef9672c33f673fa9ec30ab8e987abe571aQYVQxD/Me7G7z8r+XW6NVdJ1WSjN+4p3DR8UUVPSVFM=', NULL, '1', '2023-11-22 02:59:46');
INSERT INTO `usuarios` VALUES (2, 'gabriel@correo.com', 'd3ce1305b484b747367e7eecd2e00c766a7215be9ccf433cd40355bdac9712372c20c60bcbac6c3e5c4c8d122caa29f48342fd92ae2d531f2ad64afa532bd2a0kTjo+q1oGUMF2orcL5jkWQzt9hM2iyy7eRvgHTswUjM=', 'gabriel@correo.com', '0412-1234567', '6a8570e5343d3fab009c834f1ccd4d0dd580751b065ff9d6277a9571850009de5d8f088baaeb330c9ada149d62e27a40ed99305fde22085430d1c229e4b74e1e2u8uq72rbIlYQrHdr91PamfX0fF81nUqlyUMavwA8r0/AYXYSRWzQermLppujWjN', '9e0a634c45cdc1a5e51e8bfe8d2023d9fbd72cb182e352d2d2836b0de879727845715419f9e38fb276d652faa182d59016b71e3f41f3abcab5d9847f4b6564f1DM8XwiUKtf4FzC4pPTvdayxPjDSaam+ZFGuFWfgn8E0=', NULL, '1', '2023-11-22 21:12:20');
INSERT INTO `usuarios` VALUES (3, 'hcm@correo.com', 'c77836c448cc560dee237f336a133c49e03c3bdc402a65f47f38e54364ff4ae31ac832e015be5f331dd009bd5204a7c9ebc9a8c1be5b9c684a2c31d2195c3c38J0I6hqUkW6ygDmG6+9vqENtbktFuI6v4lPN6Mh87AE8=', 'hcm@correo.com', '1111-1111111', 'caf0f7e5348359126897fd50ceec3bbfb2bf7950f3ee1cbe590d92370ffefb46ba0be0b99b5a724f126a5eca2ff61856bc20a6f933a92fc0088682df10e03ea9Z5oRMn+lQB7iA/pSIXA+BwcUDIxLaN8nmvDSE8M/0AkGBdcl/uAvFzZRDas/Bz9s', '611fdf592d3d7b34aadf5ccb21e6dddfaedf398f350052e70a0cca625e85883ffff7aae2fa0181066518e9bccdb3318c9ed73720a41b76a519607b6fc57f42e90LvYt7YKcbDyRrg9JNlClaU320n1cva1Of9TWhKVqqc=', NULL, '1', '2023-11-22 21:13:49');
INSERT INTO `usuarios` VALUES (4, 'jmb@correo.com', 'a0b833d92ccb6325f8c52637ea5496f45cc3044be19b4763fd223bbff90b7625c0ea7846970b00a2b13642216b800bbf666c503a24bbec2c0741a8eb8ac2c634Ll61OsfYh8V+fZyse0sQ3GrjTYcygSY9XTA9So4A08k=', 'jmb@correo.com', '1111-1111111', '0406c7724f5272183e82594b06d6affd959440b4a9c08bcd4a77628b53eb131c6c4202466f23d0231b015d821ea1566830982cb58fee291c0b6dd08f36a02323V/wB/wFIfXY9feFBnQmOOjy55TOVQkBkfJ8qIpB55Q6buHCHT/liIr9TRqY50jHy', '665039746d615d152c25e42571dc88835c3523368cd90584053c04daa1185941fbc807ab52c73480e0ca5631d0caba8e9d786f7bb9a5899e4f0985ccaddf3bcdnKyXluMM737Lnbqf1J649gg8Mvn89grqxAZuDI8sxfk=', NULL, '1', '2023-11-22 21:43:18');
INSERT INTO `usuarios` VALUES (5, 'miguel@correo.com', '5956ebdaefa4e36668898981181582f144a2c59cae463306abb389801737e5eecd7fb1c6cf5557040a7954e956e92c7a63bcb98985e35cabbd9a453c09d9061c0NcreF3pa9Rw3ZoTf/A04GIxIkB2SbqAPKGycL/E/Gw=', 'miguel@correo.com', '1111-1111111', 'b8041e264b4479f04ac425a67d5343fbb416c49a82eb3a46764363a1b0d3af2a6afcfeb1449cdaf86be86e88199d52e59faa74bc65e0ce1975910b477d0edff3zUKWg8N7BWvv1PgQXmwmX5+/7MciLh4+72SXCf8N9Ll5yNUa1RzS7SIi9wqs5EF4', 'fb189dc69d7a4151c0e8a652a9c3f2c72f1cdcc4f95315804cfa563b1550fb247d7271a30d5e2e5e82eb733adc261113d6d97f78d3246e0567ac0904f7e6f3a8LBGt1h5Jhn4oFmp2lOq+r6H3OMaqSzEZ3F52CTzTMCE=', NULL, '1', '2023-11-24 14:01:16');
INSERT INTO `usuarios` VALUES (6, 'pablo@correo.com', 'de638022e31b24d91b75a625ae79cecb19ccde8f3e1459e45ddacb13e9ab9500bf5691db997e65039e069810be0520417d5925ac8dc0c4c4c9ce8a7ac8a3f45ev0Z7zBs5/RCOS0QAEX/kI4zusLZPe1qzCMxAFpFuiq8=', 'pablo@correo.com', NULL, '062bb1cc4e12a14d62cf8477ca6ec3a0a75687359a1c8c7c479abe4011adb9c1a014f628a724a74311551977d831a58f57c41e37b666a2f36da855d1de7cf5428F6d3mZNenFyQelwfY1ueXO2Ns0ThlNGCdbjLp8SCy+6jKqEjpdPYpi5XvqNMYfF', 'c465a4cfd16d1b100c378cec8fab26f900c9ab24c06b2847a4b247bf2e75174d44cf4c67930dbe5db65161ee3b992ca49c46a1e0ebf1a143222a8f629851978e1yAIHmlEVIAukKY8HBZpX8AylDtEC8qyPsgiWg5z4YQ=', NULL, '1', '2023-11-25 07:29:16');
INSERT INTO `usuarios` VALUES (7, 'prueba@correo.com', '742407dbb1ce9bd528bdd5cca68a9fa5c1132dd98ee1e13521d313fecd674286e4774bc247b09466c9ac76e58ba931a26f4969b32b2b589aa8c21b4cf202a5c1LzpysX/yO2Lv+KnzEtImFbppyXJtEF1N8ND0ZEzpNb8=', 'prueba@correo.com', NULL, '0c7ed25226fac4b409bb3787fc70d72bc523f14107050f784d0e851991194bd5cbf2673c0132842ea3adc216c391f58642613c7e5525046c28b62560018ef2d69NQ+6PMBIrHNUT+ZefprgdNOeppzLY+oikPp6cyDnPdTvJ34zmeGZRuH8bZ06/SB', '9d9f2c73e46e5936f085afe0d153bb13bd02ede9bb67f0accb5e83b64b5a23c1489bb1a82277e01c3732262b061d9ae074693a3d47338d3b51129f1f427df719YxOpSCGcENWgxh70RcAh1us3PhfnuTsFMNDUAY4B/3I=', NULL, '1', '2023-11-25 07:31:50');

SET FOREIGN_KEY_CHECKS = 1;
