<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\Folder;
/**
 * AdminUsers seed.
 */
class AdminUsersSeed extends AbstractSeed
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
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
        $folder = new Folder(WWW_ROOT . 'img' . DS . 'uploads' . DS . 'admin_users' . DS . 'photos' . DS, true, 0755);
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $fakePass = $faker->password;
            $password = (new DefaultPasswordHasher)->hash($fakePass);
            $datetime = $faker->dateTime()->format('Y-m-d H:i:s');
            $data[] = [
                'name' => $faker->firstName . " " . $faker->lastName,
                'mobile' => $faker->e164PhoneNumber,
                'password' => $password,
                'fake_pass' => $fakePass,
                'profile_photo' => $faker->image($folder->path, $width = 640, $height = 480, 'people', false) ,
                'email' => $faker->email,
                'dob' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'status' => $faker->boolean(25),
                'is_verified' => $faker->boolean(25),
                'created' => $datetime,
                'modified' => $datetime,
			 ];
        }

        $table = $this->table('admin_users');
        $table->insert($data)->save();
    }
}
