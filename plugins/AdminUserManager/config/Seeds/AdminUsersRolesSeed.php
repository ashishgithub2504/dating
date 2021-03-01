<?php
use Migrations\AbstractSeed;

/**
 * AdminUsersRoles seed.
 */
class AdminUsersRolesSeed extends AbstractSeed
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
		$roles = [1,2];
		for ($i = 1; $i <= 10; $i++) {
			$data[] = ["role_id"=> $roles[array_rand($roles)], 'admin_user_id' => $i];
		}
        $table = $this->table('admin_users_roles');
        $table->insert($data)->save();
    }
}
