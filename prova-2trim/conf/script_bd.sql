-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema prova
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prova` DEFAULT CHARACTER SET utf8 ;
USE `prova` ;

-- -----------------------------------------------------
-- Table `prova`.`laboratorios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`laboratorios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `num` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`professores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`professores` (
  `idprof` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`idprof`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`reserva` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NULL,
  `idprof` INT NOT NULL,
  `idlab` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_reserva_professores_idx` (`idprof` ASC),
  CONSTRAINT `fk_reserva_professores`
    FOREIGN KEY (`idprof`)
    REFERENCES `prova`.`professores` (`idprof`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  INDEX `fk_reserva_laboratorios_idx` (`id` ASC),
  CONSTRAINT `fk_reserva_laboratorios`
    FOREIGN KEY (`idlab`)
    REFERENCES `prova`.`laboratorios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
