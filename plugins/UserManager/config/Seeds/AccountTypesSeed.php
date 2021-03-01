<?php
use Migrations\AbstractSeed;

/**
 * AccountTypes seed.
 */
class AccountTypesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];
		$data = [
            [
                'id' => '1',
                'title' => 'Normal User',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'title' => 'DS User',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];
        $table = $this->table('account_types');
        $table->insert($data)->save();
    }
}
