<?php
use Migrations\AbstractMigration;

class CreateEmailTemplates extends AbstractMigration
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
        $table = $this->table('email_templates');
        $table->addColumn('email_hook_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('subject', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('footer_text', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('email_preference_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex([
            'email_hook_id',
        ], [
            'name' => 'BY_EMAIL_HOOK_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'email_preference_id',
        ], [
            'name' => 'BY_EMAIL_PREFERENCE_ID',
            'unique' => false,
        ]);
        
        $table->create();
    }
}
