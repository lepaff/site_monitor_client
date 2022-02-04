<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'LEPAFF.SiteMonitorClient',
            'Client',
            'Client'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('site_monitor_client', 'Configuration/TypoScript', 'Site monitor client');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sitemonitorclient_domain_model_client', 'EXT:site_monitor_client/Resources/Private/Language/locallang_csh_tx_sitemonitorclient_domain_model_client.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sitemonitorclient_domain_model_client');

    }
);
