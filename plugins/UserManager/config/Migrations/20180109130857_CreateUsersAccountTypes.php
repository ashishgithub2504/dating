<?php
use Migrations\AbstractMigration;

class CreateUsersAccountTypes extends AbstractMigration
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
        $table = $this->table('users_account_types');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => false,
        ]);
        $table->addColumn('account_type_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addIndex([
            'user_id',
        ], [
            'name' => 'BY_USER_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'account_type_id',
        ], [
            'name' => 'BY_ACCOUNT_TYPE_ID',
            'unique' => false,
        ]);
        $table->create();
    }
}
