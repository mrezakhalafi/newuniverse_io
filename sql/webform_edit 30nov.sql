ALTER TABLE `new_nus`.`webform`   
	DROP COLUMN `FBUTTON1`, 
	DROP COLUMN `FBUTTON2`, 
	DROP COLUMN `FBUTTON3`, 
	DROP COLUMN `FBUTTON4`, 
	DROP COLUMN `FBUTTON5`, 
	ADD COLUMN `CUSTOM_BUTTON` VARCHAR(64) NULL AFTER `SHOW_FB`,
	ADD COLUMN `CUSTOM_BUTTON_ICON` TEXT NULL AFTER `CUSTOM_BUTTON`,
	ADD COLUMN `CUSTOM_BUTTON_URL` TEXT NULL AFTER `CUSTOM_BUTTON_ICON`;
