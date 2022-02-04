<?php
namespace LEPAFF\SiteMonitorClient\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Michael Paffrath <michael.paffrath@gmail.com>
 */
class ClientTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \LEPAFF\SiteMonitorClient\Domain\Model\Client
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \LEPAFF\SiteMonitorClient\Domain\Model\Client();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );
    }
}
