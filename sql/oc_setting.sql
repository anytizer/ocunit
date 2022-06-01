/**
 * Modify behaviour of OpenCart defaults.
 */

UPDATE `oc_setting` SET `value` = '20' WHERE `key` = 'config_pagination';
UPDATE `oc_setting` SET `value` = '100' WHERE `key` = 'config_pagination_admin';
