<?php

declare(strict_types=1);

namespace LEPAFF\SiteMonitorClient\Controller;

use MCStreetguy\ComposerParser\Factory as ComposerParser;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Install\Service\CoreUpdateService;
use TYPO3\CMS\Install\Service\CoreVersionService;

/**
 * This file is part of the "Website monitor client" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Michael Paffrath <michael.paffrath@gmail.com>, Antwerpes AG
 */

/**
 * ClientController
 */
class ClientController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var JsonView
     */
    protected $view;

    /**
     * @var string
     */
    protected $defaultViewObjectName = \TYPO3\CMS\Extbase\Mvc\View\JsonView::class;

    /**
     * action list
     *
     * @return string|object|null|void
     */
    public function renderJsonAction()
    {
        $coreUpdateService = GeneralUtility::makeInstance(CoreUpdateService::class);
        $coreVersionService = GeneralUtility::makeInstance(CoreVersionService::class);

        $coreUpdateEnabled = $coreUpdateService->isCoreUpdateEnabled();
        $coreUpdateComposerMode = Environment::isComposerMode();

        // Check if update is available
        $installedTYPO3Version = $coreVersionService->getInstalledVersion();
        $youngestPatch = $coreVersionService->getYoungestPatchRelease();
        $patchAvailable = false;
        if (is_object($youngestPatch)) {
            $youngestPatch = $youngestPatch->getVersion();
        }
        if ($youngestPatch && version_compare($installedTYPO3Version, $youngestPatch, '<')) {
            $patchAvailable = $youngestPatch;
        }

        // Collect installed packages/extensions - if in composer mode
        if ($coreUpdateComposerMode === true) {
            $composerFilePath = Environment::getProjectPath() . '/composer.json';
            $lockFilePath = Environment::getProjectPath() . '/composer.lock';
            $composerfile = ComposerParser::parseComposerJson($composerFilePath);
            $composerPackages = $composerfile->getRequire();
            $lockfile = ComposerParser::parseLockfile($lockFilePath);
            $lockPackages = $lockfile->getPackages();
        }

        // find current page uid
        $siteFinder = GeneralUtility::makeInstance(SiteFinder::class);
        $site = $siteFinder->getSiteByPageId($GLOBALS['TSFE']->id);

        // Using JsonView for JSON output - see:
        // https://docs.typo3.org/m/typo3/book-extbasefluid/main/en-us/8-Fluid/2-using-different-output-formats.html#using-built-in-jsonview
        // https://gist.github.com/arnekolja/ee9152e15e8f440773ad
        // $jsonView = GeneralUtility::makeInstance(MonitorClientJsonView::class);
        // $jsonView->setControllerContext($this->controllerContext);

        $this->view->assignMultiple([
            'websiteTitle' => $site->getConfiguration()['websiteTitle'],
            'phpVersion' => phpversion(),
            'typo3Version' => $installedTYPO3Version,
            'typo3Context' => Environment::getContext(),
            'composerPackages' => $composerPackages,
            'lockPackages' => $lockPackages,
            'patchAvailable' => $patchAvailable,
        ]);
        $this->view->setVariablesToRender([
            'phpVersion',
            'typo3Version',
            'patchAvailable',
            'typo3Context',
            'composerPackages',
            'lockPackages',
        ]);

        // return $jsonView->render();
    }
}
