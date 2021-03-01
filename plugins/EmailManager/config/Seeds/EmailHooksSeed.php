<?php
use Migrations\AbstractSeed;

/**
 * EmailHooks seed.
 */
class EmailHooksSeed extends AbstractSeed
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
        $data = [
            [
                'title' => 'Welcome Email',
                'slug' => 'welcome-email',
                'description' => 'when user has been registered then send welcome email for verify account.',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Forgot Password Email',
                'slug' => 'forgot-password-email',
                'description' => 'when user has forgot password.',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Contact us',
                'slug' => 'contact-us',
                'description' => 'when guest user send inquiry from contact us form.',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('email_hooks');
        $table->insert($data)->save();
    }
}
