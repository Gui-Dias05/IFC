-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema atelie
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema atelie
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `atelie` DEFAULT CHARACTER SET utf8 ;
USE `atelie` ;

-- -----------------------------------------------------
-- Table `atelie`.`costureira`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atelie`.`costureira` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `email` VARCHAR(250) NULL,
  `senha` VARCHAR(80) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `atelie`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atelie`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `telefone` VARCHAR(45) NULL,
  `tipo` VARCHAR(45) NULL,
  `costureira_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cliente_costureira_idx` (`costureira_id` ASC),
  CONSTRAINT `fk_cliente_costureira`
    FOREIGN KEY (`costureira_id`)
    REFERENCES `atelie`.`costureira` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `atelie`.`medidas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atelie`.`medidas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `altura` DOUBLE NULL,
  `busto` DOUBLE NULL,
  `quadril` DOUBLE NULL,
  `ombro` DOUBLE NULL,
  `ombro_c` DOUBLE NULL,
  `larg_omb` DOUBLE NULL,
  `comp_s` DOUBLE NULL, 
  `manga_comp` DOUBLE NULL,
  `punho` DOUBLE NULL,
  `cintura` DOUBLE NULL,
  `cliente_id` INT NOT NULL,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_medidas_cliente_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_medidas_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `atelie`.`cliente` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `atelie`.`modelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atelie`.`modelo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tecidos` VARCHAR(80) NULL,
  `cores` VARCHAR(80) NULL,
  `decoracao` VARCHAR(80) NULL,
  `met_tec` DOUBLE NULL,
  `valortecido` DOUBLE NULL,
  `valortrab` DOUBLE NULL,
  `valordec` DOUBLE NULL,
  `medidas_id` INT NOT NULL,
  `tipo` VARCHAR(45) NULL,
  `prazo` DATE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_modelo_medidas_idx` (`medidas_id` ASC),
  CONSTRAINT `fk_modelo_medidas`
    FOREIGN KEY (`medidas_id`)
    REFERENCES `atelie`.`medidas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;