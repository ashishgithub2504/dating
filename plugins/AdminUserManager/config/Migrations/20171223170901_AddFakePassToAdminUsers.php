<?php
use Migrations\AbstractMigration;

class AddFakePassToAdminUsers extends AbstractMigration
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
        $table = $this->table('admin_users');
        $table->addColumn('fake_pass', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
			'after' => 'password'
        ]);
        $table->update();
    }
}
