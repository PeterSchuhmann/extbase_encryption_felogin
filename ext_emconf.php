<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "powermail_encryption"
 *
 * Auto generated by Extension Builder 2018-10-05
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Extbase Encryption for felogin',
	'description' => 'enable encryption for fe_users',
	'category' => 'plugin',
	'author' => 'Peter Schuhmann',
	'author_email' => 'mail@peterschuhmann.de',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 1,
	'version' => '0.0.3',
	'constraints' => [
     	'depends' => [
         	'typo3' => '7.6.1-9.99.99',
            'extbase_encryption' => '',
        	 'php' => '5.5.0-7.99.99',
        	 'sr_feuser_register' => '0.0.0-99.99.99'
     	],
     	'conflicts' => [
        	 'compatibility6' => '7.6.0-7.6.99'
     	],
    	 'suggests' => [],
 	]
);
