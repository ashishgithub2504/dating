<?php
namespace UserManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UserManager\Model\Table\AccountTypesTable;

/**
 * UserManager\Model\Table\AccountTypesTable Test Case
 */
class AccountTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \UserManager\Model\Table\AccountTypesTable
     */
    public $AccountTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.user_manager.account_types',
        'plugin.user_manager.users',
        'plugin.user_manager.users_account_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccountTypes') ? [] : ['className' => AccountTypesTable::class];
        $this->AccountTypes = TableRegistry::get('AccountTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountTypes);

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
