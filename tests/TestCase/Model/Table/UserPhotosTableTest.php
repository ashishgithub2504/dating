<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPhotosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPhotosTable Test Case
 */
class UserPhotosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPhotosTable
     */
    public $UserPhotos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserPhotos',
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
        $config = TableRegistry::getTableLocator()->exists('UserPhotos') ? [] : ['className' => UserPhotosTable::class];
        $this->UserPhotos = TableRegistry::getTableLocator()->get('UserPhotos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPhotos);

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
