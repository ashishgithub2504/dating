<?php
use Migrations\AbstractMigration;

class AddFakePassToUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('fake_pass', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => false,
            'after' => 'password'
        ]);
        $table->update();
    }
}
