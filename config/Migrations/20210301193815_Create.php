<?php
use Migrations\AbstractMigration;

class Create extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('audio_call_rate', 'integer', [
            // 'default' => null,
            'limit' => 11,
        ])->update();
        $table->addColumn('video_call_rate', 'integer', [
            // 'default' => null,
            'limit' => 11,
            // 'null' => false,
        ])->update();
    }
}