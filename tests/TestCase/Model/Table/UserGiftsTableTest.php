<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserGiftsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserGiftsTable Test Case
 */
class UserGiftsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserGiftsTable
     */
    public $UserGifts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserGifts',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('UserGifts') ? [] : ['className' => UserGiftsTable::class];
        $this->UserGifts = TableRegistry::getTableLocator()->get('UserGifts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserGifts);

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
