<?php

namespace PS\ExtbaseEncryptionFelogin\Hooks;

use PS\ExtbaseEncryption\Encryptor;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use SJBR\SrFeuserRegister\Utility\LocalizationUtility;

class SrFeuserRegister {

    public function evalValues($theTable, $dataArray, $theField, $cmdKey, $cmdParts, $extensionName)
    {

        $encryptor = Encryptor::init();

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($theTable);
        $queryBuilder
            ->getRestrictions()
            ->removeAll();

        $queryBuilder
            ->getRestrictions()
            ->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        if ($cmdKey === 'uniqueLocal' || $cmdKey === 'uniqueGlobal') {
            $queryBuilder
                ->getRestrictions()
                ->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        }

        $value = $dataArray[$theField];
        if ($theField == 'username' || $theField == 'email')
        {
            $value = strtolower($dataArray[$theField]);
        }

        $queryBuilder
            ->select('uid', $theField)
            ->from($theTable)
            ->where(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->eq($theField, $queryBuilder->createNamedParameter($encryptor->encrypt($value)), \PDO::PARAM_STR),
                    $queryBuilder->expr()->eq($theField, $queryBuilder->createNamedParameter($value), \PDO::PARAM_STR)
                )
            )
            ->setMaxResults(1);
        if ($dataArray['uid']) {
            $queryBuilder
                ->andWhere(
                    $queryBuilder->expr()->neq('uid', $queryBuilder->createNamedParameter((int)$dataArray['uid']), \PDO::PARAM_INT)
                );
        }

        $DBrows = $queryBuilder
            ->execute()
            ->fetchAll();

        if (
            !is_array($dataArray[$theField]) &&
            trim($dataArray[$theField]) != '' &&
            isset($DBrows) &&
            is_array($DBrows) &&
            isset($DBrows[0]) &&
            is_array($DBrows[0])
        ) {
            return [
                $theField => LocalizationUtility::translate('evalErrors_existed_already', $extensionName)
            ];
        }

        return '';
        
    }

}