<?php
namespace CatalogManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CatalogManager\Model\Table\OptionValuesTable;

/**
 * CatalogManager\Model\Table\OptionValuesTable Test Case
 */
class OptionValuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CatalogManager\Model\Table\OptionValuesTable
     */
    public $OptionValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.catalog_manager.option_values',
        'plugin.catalog_manager.options'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('OptionValues') ? [] : ['className' => OptionValuesTable::class];
        $this->OptionValues = TableRegistry::get('OptionValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OptionValues);

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
