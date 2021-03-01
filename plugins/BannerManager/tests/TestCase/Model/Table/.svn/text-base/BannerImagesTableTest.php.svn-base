<?php
namespace BannerManager\Test\TestCase\Model\Table;

use BannerManager\Model\Table\BannerImagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BannerManager\Model\Table\BannerImagesTable Test Case
 */
class BannerImagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BannerManager\Model\Table\BannerImagesTable
     */
    public $BannerImages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.banner_manager.banner_images',
        'plugin.banner_manager.banners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BannerImages') ? [] : ['className' => BannerImagesTable::class];
        $this->BannerImages = TableRegistry::get('BannerImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BannerImages);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
