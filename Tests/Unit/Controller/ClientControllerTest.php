<?php
namespace LEPAFF\SiteMonitorClient\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Michael Paffrath <michael.paffrath@gmail.com>
 */
class ClientControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \LEPAFF\SiteMonitorClient\Controller\ClientController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\LEPAFF\SiteMonitorClient\Controller\ClientController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllClientsFromRepositoryAndAssignsThemToView()
    {

        $allClients = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $clientRepository = $this->getMockBuilder(\LEPAFF\SiteMonitorClient\Domain\Repository\ClientRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $clientRepository->expects(self::once())->method('findAll')->will(self::returnValue($allClients));
        $this->inject($this->subject, 'clientRepository', $clientRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('clients', $allClients);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
