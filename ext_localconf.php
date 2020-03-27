<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['extbase_encryption_felogin']);
$enable = $config['enable'] ?? '0';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase_encryption']['fe_login'] = [
    'enable' => ($enable == "1") ? true : false,
    'properties' => ['username', 'name', 'address', 'email', 'first_name', 'last_name', 'fax', 'telephone', 'company', 'zip', 'city']
];

