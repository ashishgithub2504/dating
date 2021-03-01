<?php
namespace AdminUserManager\Test\TestCase\Model\Table;

use AdminUserManager\Model\Table\AdminUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminUserManager\Model\Table\AdminUsersTable Test Case
 */
class AdminUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AdminUserManager\Model\Table\AdminUsersTable
     */
    public $AdminUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.admin_user_manager.admin_users',
        'plugin.admin_user_manager.roles',
        'plugin.admin_user_manager.admin_users_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AdminUsers') ? [] : ['className' => AdminUsersTable::class];
        $this->AdminUsers = TableRegistry::get('AdminUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AdminUsers);

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

    /**
     * Test validationResetpassword method
     *
     * @return void
     */
    public function testValidationResetpassword()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationUpdate method
     *
     * @return void
     */
    public function testValidationUpdate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test beforeMarshal method
     *
     * @return void
     */
    public function testBeforeMarshal()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test afterSave method
     *
     * @return void
     */
    public function testAfterSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAuth method
     *
     * @return void
     */
    public function testFindAuth()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findFilters method
     *
     * @return void
     */
    public function testFindFilters()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test deleteImage method
     *
     * @return void
     */
    public function testDeleteImage()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
