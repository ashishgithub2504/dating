<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\Folder;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
		$age = [12,18,22,26,10,32,38,45,23,25,27,19,20,21];
        for ($i = 0; $i < 10; $i++) {
            $fakePass = $faker->password;
            $password = (new DefaultPasswordHasher)->hash($fakePass);
            $datetime = $faker->dateTime()->format('Y-m-d H:i:s');
            $data[] = [
                'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'display_name' => $faker->firstName . " " . $faker->lastName,
                'age' => $age[array_rand($age)],
				'mobile' => $faker->e164PhoneNumber,
				'town' => $faker->city,
				'state' => $faker->state,
				'zipcode' => $faker->postcode,
				'email' => $faker->email,
                'password' => $password,
                'fake_pass' => $fakePass,
                'profile_photo' => $faker->image($folder->path, $width = 500, $height = 480, 'people', false) ,
                'profile_photo' => $faker->image($folder->path, $width = 500, $height = 480, 'people', false) ,
                'status' => $faker->boolean(25),
                'is_verified' => $faker->boolean(25),
                'created' => $datetime,
                'modified' => $datetime,
			 ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
