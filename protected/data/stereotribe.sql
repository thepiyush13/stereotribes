SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `stereotribes` ;
CREATE SCHEMA IF NOT EXISTS `stereotribes` DEFAULT CHARACTER SET latin1 ;
USE `stereotribes` ;

-- -----------------------------------------------------
-- Table `stereotribes`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`category` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`category` (
  `category_id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`category_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stereotribes`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`user` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`user` (
  `id` INT NOT NULL ,
  `name` VARCHAR(55) NULL ,
  `email` VARCHAR(55) NULL ,
  `password` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stereotribes`.`project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`project` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`project` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(55) NULL ,
  `short_summary` VARCHAR(255) NULL ,
  `country` VARCHAR(100) NULL ,
  `city` VARCHAR(100) NULL ,
  `flip_image_url` VARCHAR(100) NULL ,
  `short_url` VARCHAR(55) NULL ,
  `category` INT NULL ,
  `goal` DECIMAL(10,0) NULL ,
  `currency` VARCHAR(45) NULL ,
  `funding_type` VARCHAR(45) NULL ,
  `days_run` INT NULL ,
  `end_date` DATE NULL ,
  `payment_date` DATE NULL ,
  `media_type` VARCHAR(45) NULL ,
  `video_url` VARCHAR(100) NULL ,
  `image_url` VARCHAR(100) NULL ,
  `pitch_story` TEXT NULL ,
  `main_link` VARCHAR(155) NULL ,
  `thankyou_media_type` VARCHAR(45) NULL ,
  `thankyou_media_url` VARCHAR(45) NULL ,
  `campaign_url` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NULL ,
  `social_amplifier_status` TINYINT NULL ,
  `user_id` INT NULL ,
  INDEX `p_category` (`category` ASC) ,
  PRIMARY KEY (`id`) ,
  INDEX `up_ser_id` (`user_id` ASC) ,
  CONSTRAINT `p_category`
    FOREIGN KEY (`category` )
    REFERENCES `stereotribes`.`category` (`category_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `up_ser_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `stereotribes`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `stereotribes`.`reward`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`reward` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`reward` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `serial` INT NULL ,
  `name` VARCHAR(100) NULL ,
  `fund_amount` VARCHAR(45) NULL ,
  `available` INT NULL ,
  `estimated_delivery` VARCHAR(45) NULL ,
  `description` VARCHAR(45) NULL ,
  `funders_shipping_address_required` TINYINT NULL ,
  `has_disclaimer` TINYINT NULL ,
  `project_id` INT NULL ,
  INDEX `reward_project_id` (`project_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `reward_project_id`
    FOREIGN KEY (`project_id` )
    REFERENCES `stereotribes`.`project` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stereotribes`.`links`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`links` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`links` (
  `title` VARCHAR(100) NULL ,
  `url` VARCHAR(100) NULL ,
  `type` VARCHAR(45) NULL ,
  `project_id` INT NULL ,
  INDEX `links_project_id` (`project_id` ASC) ,
  CONSTRAINT `links_project_id`
    FOREIGN KEY (`project_id` )
    REFERENCES `stereotribes`.`project` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stereotribes`.`media_links`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`media_links` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`media_links` (
  `title` VARCHAR(100) NULL ,
  `description` VARCHAR(255) NULL ,
  `type` VARCHAR(45) NULL ,
  `extra_code` VARCHAR(255) NULL ,
  `project_id` INT NULL ,
  INDEX `media_project_id` (`project_id` ASC) ,
  CONSTRAINT `media_project_id`
    FOREIGN KEY (`project_id` )
    REFERENCES `stereotribes`.`project` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stereotribes`.`tribes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`tribes` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`tribes` (
  `email` VARCHAR(100) NULL ,
  `token` VARCHAR(100) NULL ,
  `can_edit` VARCHAR(45) NULL ,
  `project_id` INT NULL ,
  INDEX `tribes_project_id` (`project_id` ASC) ,
  CONSTRAINT `tribes_project_id`
    FOREIGN KEY (`project_id` )
    REFERENCES `stereotribes`.`project` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stereotribes`.`social_amplifier`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`social_amplifier` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`social_amplifier` (
  `target` TINYINT NULL ,
  `message` TEXT NULL ,
  `post_status` TINYINT NULL ,
  `project_id` INT NULL ,
  INDEX `sa_project_id` (`project_id` ASC) ,
  CONSTRAINT `sa_project_id`
    FOREIGN KEY (`project_id` )
    REFERENCES `stereotribes`.`project` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stereotribes`.`user_fund_project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stereotribes`.`user_fund_project` ;

CREATE  TABLE IF NOT EXISTS `stereotribes`.`user_fund_project` (
  `user_id` INT NOT NULL ,
  `project_id` INT NULL ,
  `amout` VARCHAR(45) NULL ,
  `timestamp` VARCHAR(45) NULL ,
  `shipping_address` VARCHAR(45) NULL ,
  `reward_id` INT NULL ,
  `reward_received_status` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `uf_project_id` (`project_id` ASC) ,
  INDEX `uf_reward_id` (`reward_id` ASC) ,
  INDEX `uf_user_id` (`user_id` ASC) ,
  CONSTRAINT `uf_project_id`
    FOREIGN KEY (`project_id` )
    REFERENCES `stereotribes`.`project` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `uf_reward_id`
    FOREIGN KEY (`reward_id` )
    REFERENCES `stereotribes`.`reward` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `uf_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `stereotribes`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'kanchan karjee','kanchan@inkoniq.com','21232f297a57a5a743894a0e4a801fc3','','','',''),(2,'admin','admin@st.com','21232f297a57a5a743894a0e4a801fc3','','','',''),(11,'Kanchan Karjee','kanchan_karjee@rediff.com','','100001314220473','a:2:{s:2:\"id\";s:15:\"106377336067638\";s:4:\"name\";s:16:\"Bangalore,','male','en_US'),(10,'Abhishek Kumar','abhi_ekdost@rediffmail.com','','100001454874120','a:2:{s:2:\"id\";s:15:\"106377336067638\";s:4:\"name\";s:16:\"Bangalore,','male','en_US');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
