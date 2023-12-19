/*
 Navicat Premium Data Transfer

 Source Server         : MySQL XAMPP
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : medicontrol

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 26/11/2023 17:29:45
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 140 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
-- Table structure for dias
-- ----------------------------
DROP TABLE IF EXISTS `dias`;
CREATE TABLE `dias`  (
  `id_dia` int NOT NULL AUTO_INCREMENT,
  `dia` varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dia`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
-- Table structure for generos
-- ----------------------------
DROP TABLE IF EXISTS `generos`;
CREATE TABLE `generos`  (
  `id_genero` int NOT NULL AUTO_INCREMENT,
  `genero` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_genero`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
-- Table structure for parentescos
-- ----------------------------
DROP TABLE IF EXISTS `parentescos`;
CREATE TABLE `parentescos`  (
  `id_parentesco` int NOT NULL AUTO_INCREMENT,
  `parentesco` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_parentesco`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
-- Table structure for prioridades
-- ----------------------------
DROP TABLE IF EXISTS `prioridades`;
CREATE TABLE `prioridades`  (
  `id_prioridad` int NOT NULL AUTO_INCREMENT,
  `prioridad` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_prioridad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
  PRIMARY KEY (`id_privilegio`) USING BTREE,
  INDEX `id_perfil`(`id_perfil`) USING BTREE,
  CONSTRAINT `privilegios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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

SET FOREIGN_KEY_CHECKS = 1;
