<?php
namespace CatalogManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CatalogManager\Model\Table\StockStatusesTable;

/**
 * CatalogManager\Model\Table\StockStatusesTable Test Case
 */
class StockStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CatalogManager\Model\Table\StockStatusesTable
     */
    public $StockStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.catalog_manager.stock_statuses',
        'plugin.catalog_manager.products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StockStatuses') ? [] : ['className' => StockStatusesTable::class];
        $this->StockStatuses = TableRegistry::get('StockStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StockStatuses);

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
}
