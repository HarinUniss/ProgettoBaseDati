
CREATE TABLE `db_progetto`.`tabella_prenotazioni` (`id_prenotazione` INT NOT NULL AUTO_INCREMENT , `id_utente` INT NOT NULL , `id_azienda` INT NOT NULL , `data` DATE NOT NULL , `ora` TIME NOT NULL , `note` VARCHAR(256) NOT NULL , PRIMARY KEY (`id_prenotazione`)) ENGINE = InnoDB;
