--- aterro ---

CREATE SCHEMA IF NOT EXISTS `aterro` DEFAULT CHARACTER SET utf8 ;
USE `aterro` ;

-- -----------------------------------------------------
-- Table `aterro`.`monitor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`monitor` (
  `id_moni` INT NOT NULL AUTO_INCREMENT,
  `nome_moni` VARCHAR(45) NULL,
  `cpf_moni` VARCHAR(45) NULL,
  `login_moni` VARCHAR(45) NULL,
  `senha_moni` VARCHAR(45) NULL,
  `contato_moni` VARCHAR(45) NULL,
  PRIMARY KEY (`id_moni`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aterro`.`aguas_sup`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`aguas_sup` (
  `id_super` INT NOT NULL AUTO_INCREMENT,
  `data_coleta` DATE NULL,
  `area_coleta` LONGTEXT NULL,
  `num_amostra` INT NOT NULL,
  `resultado` LONGTEXT NULL,
  `id_monitor` INT NOT NULL,
  PRIMARY KEY (`id_super`),
  CONSTRAINT `fk_aguas_sup_monitor1`
    FOREIGN KEY (`id_monitor`)
    REFERENCES `aterro`.`monitor` (`id_moni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aterro`.`aguas_sub`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`aguas_sub` (
  `id_subt` INT NOT NULL AUTO_INCREMENT,
  `num_poco_moni` INT NULL,
  `num_amostra` INT NULL,
  `data_coleta` DATE NULL,
  `resultado` LONGTEXT NULL,
  `id_monitor` INT NOT NULL,
  PRIMARY KEY (`id_subt`),
  CONSTRAINT `fk_aguas_sub_monitor`
    FOREIGN KEY (`id_monitor`)
    REFERENCES `aterro`.`monitor` (`id_moni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aterro`.`lencol_freatico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`lencol_freatico` (
  `id_lencol` INT NOT NULL AUTO_INCREMENT,
  `data_analise` DATE NULL,
  `num_amostra` INT NULL,
  `relatorio_len` LONGTEXT NULL,
  `id_monitor` INT NOT NULL,
  PRIMARY KEY (`id_lencol`),
  CONSTRAINT `fk_lencol_freatico_monitor1`
    FOREIGN KEY (`id_monitor`)
    REFERENCES `aterro`.`monitor` (`id_moni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aterro`.`liquidos_lixiviados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`liquidos_lixiviados` (
  `id_liqui` INT NOT NULL AUTO_INCREMENT,
  `moni_chorume` LONGTEXT NULL,
  `quanti_chorume` DECIMAL NULL,
  `quanti_agua` DECIMAL NULL,
  `monitor_id_moni` INT NOT NULL,
  PRIMARY KEY (`id_liqui`),
  CONSTRAINT `fk_liquidos_lixiviados_monitor1`
    FOREIGN KEY (`monitor_id_moni`)
    REFERENCES `aterro`.`monitor` (`id_moni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aterro`.`qualidade_ar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`qualidade_ar` (
  `id_ar` INT NOT NULL AUTO_INCREMENT,
  `data_analise` DATE NULL,
  `relatorio_analise` LONGTEXT NULL,
  `id_monitor` INT NOT NULL,
  PRIMARY KEY (`id_ar`),
  CONSTRAINT `fk_qualidade_ar_monitor1`
    FOREIGN KEY (`id_monitor`)
    REFERENCES `aterro`.`monitor` (`id_moni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aterro`.`pressao_sonora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`pressao_sonora` (
  `id_pressao` INT NOT NULL AUTO_INCREMENT,
  `area_moni` LONGTEXT NULL,
  `data_amostra` DATETIME NULL,
  `hora_moni` DATETIME NULL,
  `num_deci` DECIMAL NULL,
  `relatorio` LONGTEXT NULL,
  `id_monitor` INT NOT NULL,
  PRIMARY KEY (`id_pressao`),
  CONSTRAINT `fk_pressao_sonora_monitor1`
    FOREIGN KEY (`id_monitor`)
    REFERENCES `aterro`.`monitor` (`id_moni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aterro`.`biogas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`biogas` (
  `id_biogas` INT NOT NULL AUTO_INCREMENT,
  `data_moni` DATETIME NULL,
  `relatorio` LONGTEXT NULL,
  `id_monitor` INT NOT NULL,
  PRIMARY KEY (`id_biogas`),
CONSTRAINT `fk_biogas_monitor1`
    FOREIGN KEY (`id_monitor`)
    REFERENCES `aterro`.`monitor` (`id_moni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aterro`.`geotecnico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aterro`.`geotecnico` (
  `id_geo` INT NOT NULL AUTO_INCREMENT,
  `data_moni_geo` DATETIME NULL,
  `nivel_recal` VARCHAR(255) NULL,
  `nivel_liqui` VARCHAR(255) NULL,
  `nivel_incli` VARCHAR(255) NULL,
  `num_apare` INT NULL,
  `local_apare` LONGTEXT NULL,
  PRIMARY KEY (`id_geo`))
ENGINE = InnoDB;

ALTER TABLE `aterro`.`aguas_sub` 
DROP FOREIGN KEY `fk_aguas_sub_monitor`;
ALTER TABLE `aterro`.`aguas_sub` 
ADD CONSTRAINT `fk_aguas_sub_monitor`
  FOREIGN KEY (`id_monitor`)
  REFERENCES `aterro`.`monitor` (`id_moni`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `aterro`.`aguas_sup` 
DROP FOREIGN KEY `fk_aguas_sup_monitor1`;
ALTER TABLE `aterro`.`aguas_sup` 
ADD CONSTRAINT `fk_aguas_sup_monitor1`
  FOREIGN KEY (`id_monitor`)
  REFERENCES `aterro`.`monitor` (`id_moni`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `aterro`.`biogas` 
DROP FOREIGN KEY `fk_biogas_monitor1`;
ALTER TABLE `aterro`.`biogas` 
ADD CONSTRAINT `fk_biogas_monitor1`
  FOREIGN KEY (`id_monitor`)
  REFERENCES `aterro`.`monitor` (`id_moni`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `aterro`.`lencol_freatico` 
DROP FOREIGN KEY `fk_lencol_freatico_monitor1`;
ALTER TABLE `aterro`.`lencol_freatico` 
ADD CONSTRAINT `fk_lencol_freatico_monitor1`
  FOREIGN KEY (`id_monitor`)
  REFERENCES `aterro`.`monitor` (`id_moni`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `aterro`.`liquidos_lixiviados` 
DROP FOREIGN KEY `fk_liquidos_lixiviados_monitor1`;
ALTER TABLE `aterro`.`liquidos_lixiviados` 
ADD CONSTRAINT `fk_liquidos_lixiviados_monitor1`
  FOREIGN KEY (`monitor_id_moni`)
  REFERENCES `aterro`.`monitor` (`id_moni`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `aterro`.`pressao_sonora` 
DROP FOREIGN KEY `fk_pressao_sonora_monitor1`;
ALTER TABLE `aterro`.`pressao_sonora` 
ADD CONSTRAINT `fk_pressao_sonora_monitor1`
  FOREIGN KEY (`id_monitor`)
  REFERENCES `aterro`.`monitor` (`id_moni`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `aterro`.`qualidade_ar` 
DROP FOREIGN KEY `fk_qualidade_ar_monitor1`;
ALTER TABLE `aterro`.`qualidade_ar` 
ADD CONSTRAINT `fk_qualidade_ar_monitor1`
  FOREIGN KEY (`id_monitor`)
  REFERENCES `aterro`.`monitor` (`id_moni`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;