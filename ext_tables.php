<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TCA']['fe_users']['ctrl']['label_userFunc'] =  \PS\ExtbaseEncryption\Hooks\CustomLabel::class . '->decryptLabel';