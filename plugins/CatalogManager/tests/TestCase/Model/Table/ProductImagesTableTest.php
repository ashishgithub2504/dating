<?php
namespace CatalogManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CatalogManager\Model\Table\ProductImagesTable;

/**
 * CatalogManager\Model\Table\ProductImagesTable Test Case
 */
class ProductImagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CatalogManager\Model\Table\ProductImagesTable
     */
    public $ProductImages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.catalog_manager.product_images',
        'plugin.catalog_manager.products',
        'plugin.catalog_manager.stock_statuses',
        'plugin.catalog_manager.product_discounts',
        'plugin.catalog_manager.product_options',
        'plugin.catalog_manager.product_specials',
        'plugin.catalog_manager.related_products',
        'plugin.catalog_manager.relateds',
        'plugin.catalog_manager.categories',
        'plugin.catalog_manager.products_categories',
        'plugin.catalog_manager.tags',
        'plugin.catalog_manager.products_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProductImages') ? [] : ['className' => ProductImagesTable::class];
        $this->ProductImages = TableRegistry::get('ProductImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductImages);

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
