<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BroadcastsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BroadcastsTable Test Case
 */
class BroadcastsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BroadcastsTable
     */
    public $Broadcasts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Broadcasts',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Broadcasts') ? [] : ['className' => BroadcastsTable::class];
        $this->Broadcasts = TableRegistry::getTableLocator()->get('Broadcasts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Broadcasts);

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
