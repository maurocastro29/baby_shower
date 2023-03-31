-- MySQL Script generated by MySQL Workbench
-- Fri Mar 31 13:00:08 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema baby_shower
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema baby_shower
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `baby_shower` DEFAULT CHARACTER SET utf8 ;
USE `baby_shower` ;

-- -----------------------------------------------------
-- Table `baby_shower`.`tipo_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `baby_shower`.`tipo_usuarios` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `baby_shower`.`estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `baby_shower`.`estados` (
  `id_estado` INT NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id_estado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `baby_shower`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `baby_shower`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(50) NOT NULL,
  `apellidos` VARCHAR(50) NOT NULL,
  `usuario` VARCHAR(25) NOT NULL,
  `password` VARCHAR(62) NOT NULL,
  `id_tipo` INT NOT NULL,
  `id_estado` INT NOT NULL,
  `ultimo_ingreso` VARCHAR(25) NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuarios_tipo_usuarios_idx` (`id_tipo` ASC),
  INDEX `fk_usuarios_estados1_idx` (`id_estado` ASC),
  CONSTRAINT `fk_usuarios_tipo_usuarios`
    FOREIGN KEY (`id_tipo`)
    REFERENCES `baby_shower`.`tipo_usuarios` (`id_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_estados1`
    FOREIGN KEY (`id_estado`)
    REFERENCES `baby_shower`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `baby_shower`.`articulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `baby_shower`.`articulos` (
  `id_articulo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `detalle` VARCHAR(200) NULL,
  `imagen` VARCHAR(150) NULL,
  `estado` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_articulo`),
  INDEX `fk_articulos_estados1_idx` (`estado` ASC),
  INDEX `fk_articulos_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_articulos_estados1`
    FOREIGN KEY (`estado`)
    REFERENCES `baby_shower`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulos_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `baby_shower`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
