<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GiftsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GiftsTable Test Case
 */
class GiftsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GiftsTable
     */
    public $Gifts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Gifts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Gifts') ? [] : ['className' => GiftsTable::class];
        $this->Gifts = TableRegistry::getTableLocator()->get('Gifts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Gifts);

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
