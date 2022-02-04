<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'MP.SiteMonitorClient',
            'Client',
            [
                'Client' => 'list'
            ],
            // non-cacheable actions
            [
                'Client' => ''
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        client {
                            iconIdentifier = site_monitor_client-plugin-client
                            title = LLL:EXT:site_monitor_client/Resources/Private/Language/locallang_db.xlf:tx_site_monitor_client_client.name
                            description = LLL:EXT:site_monitor_client/Resources/Private/Language/locallang_db.xlf:tx_site_monitor_client_client.description
                            tt_content_defValues {
                                CType = list
                                list_type = sitemonitorclient_client
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'site_monitor_client-plugin-client',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:site_monitor_client/Resources/Public/Icons/user_plugin_client.svg']
			);
		
    }
);
