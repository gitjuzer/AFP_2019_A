-- MySQL Script generated by MySQL Workbench
-- Sat Mar 16 14:43:20 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema DB
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DB` DEFAULT CHARACTER SET utf8 ;
USE `DB` ;

-- -----------------------------------------------------
-- Table `DB`.`answer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`answer` ;

CREATE TABLE IF NOT EXISTS `DB`.`answer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(250) NOT NULL,
  `correct` TINYINT UNSIGNED NULL,
  `pair_id` INT NULL,
  `question` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_answer_question_idx` (`question` ASC) VISIBLE,
  CONSTRAINT `FK_answer_question`
    FOREIGN KEY (`question`)
    REFERENCES `DB`.`question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`permission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`permission` ;

CREATE TABLE IF NOT EXISTS `DB`.`permission` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`question`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`question` ;

CREATE TABLE IF NOT EXISTS `DB`.`question` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(250) NOT NULL,
  `test` INT NOT NULL,
  `type` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_question_test_idx` (`test` ASC) VISIBLE,
  INDEX `FK_question_question_type_idx` (`type` ASC) VISIBLE,
  CONSTRAINT `FK_question_test`
    FOREIGN KEY (`test`)
    REFERENCES `DB`.`test` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_question_question_type`
    FOREIGN KEY (`type`)
    REFERENCES `DB`.`question_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`question_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`question_type` ;

CREATE TABLE IF NOT EXISTS `DB`.`question_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`role` ;

CREATE TABLE IF NOT EXISTS `DB`.`role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`role_permission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`role_permission` ;

CREATE TABLE IF NOT EXISTS `DB`.`role_permission` (
  `role_id` INT NOT NULL,
  `permission_id` INT NOT NULL,
  INDEX `FK_role_permission_permission_idx` (`permission_id` ASC) VISIBLE,
  PRIMARY KEY (`role_id`, `permission_id`),
  CONSTRAINT `FK_role_permission_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `DB`.`role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_role_permission_permission`
    FOREIGN KEY (`permission_id`)
    REFERENCES `DB`.`permission` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`score`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`score` ;

CREATE TABLE IF NOT EXISTS `DB`.`score` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `score` INT UNSIGNED NOT NULL,
  `test_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_score_user_idx` (`user_id` ASC) VISIBLE,
  INDEX `FK_score_test_idx` (`test_id` ASC) VISIBLE,
  CONSTRAINT `FK_score_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `DB`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_score_test`
    FOREIGN KEY (`test_id`)
    REFERENCES `DB`.`test` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`test`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`test` ;

CREATE TABLE IF NOT EXISTS `DB`.`test` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`user` ;

CREATE TABLE IF NOT EXISTS `DB`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(250) NOT NULL,
  `password` VARCHAR(250) NOT NULL,
  `email` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`user_role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB`.`user_role` ;

CREATE TABLE IF NOT EXISTS `DB`.`user_role` (
  `user_id` INT NOT NULL,
  `role_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`),
  INDEX `FK_user_role_role_idx` (`role_id` ASC) VISIBLE,
  CONSTRAINT `FK_user_role_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `DB`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_user_role_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `DB`.`role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
