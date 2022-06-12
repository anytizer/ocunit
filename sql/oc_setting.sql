/**
 * Modify the behaviour of OpenCart defaults.
 */

UPDATE `oc_setting`
SET `value` = '20'
WHERE `key` = 'config_pagination';
UPDATE `oc_setting`
SET `value` = '100'
WHERE `key` = 'config_pagination_admin';
UPDATE `oc_setting`
SET `value` = 'America/Edmonton'
WHERE `key` = 'config_timezone';

-- Display taxes separately
UPDATE `oc_setting`
SET `value`='0'
WHERE `code` = 'config'
  AND `key` = 'config_tax';

UPDATE `oc_product`
SET sku=model
WHERE sku = '';
