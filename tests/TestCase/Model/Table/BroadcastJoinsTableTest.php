<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BroadcastJoinsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BroadcastJoinsTable Test Case
 */
class BroadcastJoinsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BroadcastJoinsTable
     */
    public $BroadcastJoins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BroadcastJoins',
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
        $config = TableRegistry::getTableLocator()->exists('BroadcastJoins') ? [] : ['className' => BroadcastJoinsTable::class];
        $this->BroadcastJoins = TableRegistry::getTableLocator()->get('BroadcastJoins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BroadcastJoins);

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
