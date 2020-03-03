<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase_encryption']['fe_login'] = [
    'enable' => true,
    'properties' => ['username', 'name', 'address', 'email', 'first_name', 'last_name', 'fax', 'phone', 'company']
];

