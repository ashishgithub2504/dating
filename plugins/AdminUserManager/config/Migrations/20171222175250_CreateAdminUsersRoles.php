<?php
use Migrations\AbstractMigration;

class CreateAdminUsersRoles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('admin_users_roles');
        $table->addColumn('role_id', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => false,
        ]);
        $table->addColumn('admin_user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addIndex([
            'role_id',
        ], [
            'name' => 'BY_ROLE_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'admin_user_id',
        ], [
            'name' => 'BY_ADMIN_USER_ID',
            'unique' => false,
        ]);
        $table->create();
    }
}
