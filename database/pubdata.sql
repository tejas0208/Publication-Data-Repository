-- MySQL Script generated by MySQL Workbench
-- Tue Jan 23 22:57:29 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pubdata
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pubdata
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pubdata` DEFAULT CHARACTER SET utf8 ;
USE `pubdata` ;

-- -----------------------------------------------------
-- Table `pubdata`.`levels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`levels` (
  `level` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`level`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`departments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`departments` (
  `department` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`department`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`branches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`branches` (
  `branch` VARCHAR(45) NOT NULL,
  `department` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`branch`, `department`),
  INDEX `department_idx` (`department` ASC),
  CONSTRAINT `department`
    FOREIGN KEY (`department`)
    REFERENCES `pubdata`.`departments` (`department`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`roles` (
  `roles` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`roles`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`users` (
  `mis` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `level` VARCHAR(45) NULL,
  `branch` VARCHAR(45) NOT NULL,
  `year` INT NULL,
  `role` VARCHAR(45) NULL,
  `department` VARCHAR(45) NULL,
  PRIMARY KEY (`mis`, `branch`),
  INDEX `user_to_level_idx` (`level` ASC),
  INDEX `user_branch_idx` (`branch` ASC),
  INDEX `user_roles_idx` (`role` ASC),
  CONSTRAINT `user_to_level`
    FOREIGN KEY (`level`)
    REFERENCES `pubdata`.`levels` (`level`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_branch`
    FOREIGN KEY (`branch`)
    REFERENCES `pubdata`.`branches` (`branch`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_roles`
    FOREIGN KEY (`role`)
    REFERENCES `pubdata`.`roles` (`roles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`record`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`record` (
  `idrecord` INT NOT NULL,
  `date` DATE NULL,
  `title` VARCHAR(1023) NULL,
  `f_tequip` VARCHAR(2) NULL,
  `f_rsa` VARCHAR(2) NULL,
  `f_isea` VARCHAR(2) NULL,
  `f_aicte` VARCHAR(2) NULL,
  `f_coep` VARCHAR(2) NULL,
  `f_others` VARCHAR(2) NULL,
  `t_tequip` VARCHAR(2) NULL,
  `t_isea` VARCHAR(2) NULL,
  `t_rsa` VARCHAR(2) NULL,
  `t_aicte` VARCHAR(2) NULL,
  `t_coep` VARCHAR(2) NULL,
  `t_others` VARCHAR(2) NULL,
  `nat_journal` VARCHAR(1023) NULL,
  `int_journal` VARCHAR(1023) NULL,
  `nat_conf` VARCHAR(1023) NULL,
  `int_conf` VARCHAR(1023) NULL,
  `volume_no` VARCHAR(45) NULL,
  `pages` VARCHAR(45) NULL,
  `citations` VARCHAR(1023) NULL,
  `approved_status` VARCHAR(2) NULL,
  `approved_by_mis` INT NULL,
  `submitted_by_mis` INT NULL,
  `department` VARCHAR(45) NULL,
  `filename` VARCHAR(1023) NULL,
  PRIMARY KEY (`idrecord`),
  INDEX `approved_by_to_mis_idx` (`approved_by_mis` ASC, `submitted_by_mis` ASC),
  CONSTRAINT `approved_by_to_mis`
    FOREIGN KEY (`approved_by_mis` , `submitted_by_mis`)
    REFERENCES `pubdata`.`users` (`mis` , `mis`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`record_id_max`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`record_id_max` (
  `id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`authors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`authors` (
  `idrecord` INT NOT NULL,
  `mis` INT NOT NULL,
  PRIMARY KEY (`idrecord`, `mis`),
  INDEX `record_to_mis_idx` (`mis` ASC),
  CONSTRAINT `author_to_mis`
    FOREIGN KEY (`mis`)
    REFERENCES `pubdata`.`users` (`mis`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `author_to_record_id`
    FOREIGN KEY (`idrecord`)
    REFERENCES `pubdata`.`record` (`idrecord`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`attended_by`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`attended_by` (
  `recordid` INT NOT NULL,
  `mis` INT NOT NULL,
  PRIMARY KEY (`recordid`, `mis`),
  INDEX `attended_to_mis_idx` (`mis` ASC),
  CONSTRAINT `attended_to_mis`
    FOREIGN KEY (`mis`)
    REFERENCES `pubdata`.`users` (`mis`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `attended_to_record_id`
    FOREIGN KEY (`recordid`)
    REFERENCES `pubdata`.`record` (`idrecord`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pubdata`.`external`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pubdata`.`external` (
  `record_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`record_id`, `name`),
  CONSTRAINT `record_id_tab`
    FOREIGN KEY (`record_id`)
    REFERENCES `pubdata`.`record` (`idrecord`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
