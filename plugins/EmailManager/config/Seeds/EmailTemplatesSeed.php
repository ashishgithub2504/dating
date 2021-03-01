<?php
use Migrations\AbstractSeed;

/**
 * EmailTemplates seed.
 */
class EmailTemplatesSeed extends AbstractSeed
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
        
        $welcome = <<<HTML
<p>We&rsquo;re so happy to have you with us.</p>

<p>Please click on the button below to confirm we got the right email address.</p>

<p><a href="##verify_n_password##">VERIFY MY EMAIL</a></p>

<p>Or copy and paste the link below.</p>

<p>##verify_n_password##</p>

<p>##USER_INFO##</p>
HTML;
        $forgot = <<<HTML
<p>You Recently requested to reset your password for your admin account. Click the button below to reset it.</p>

<p><a href="##USER_RESET_LINK##">Reset Password</a></p>

<p>if you ignore this message, your password won&#39;t be changed.</p>
HTML;
        
$contact = <<<HTML
<p>Hello Administrator,</p>

<p>&nbsp;</p>

<p>Name :&nbsp;##USER_NAME##</p>

<p>Email :&nbsp;##USER_EMAIL##</p>

<p>Phone No. :&nbsp;##USERE_MOBILE##</p>

<p>##MESSAGE##</p>
HTML;
        $data = [
            [
                'email_hook_id' => 1,
                'subject' => '##USER_NAME##, a very warm welcome to the ##SYSTEM_APPLICATION_NAME##',
                'description' => $welcome,
                'footer_text' => '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>',
                'email_preference_id' => 1,
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'email_hook_id' => 2,
                'subject' => '##USER_NAME##, to set your new password…',
                'description' => $forgot,
                'footer_text' => '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>',
                'email_preference_id' => 1,
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'email_hook_id' => 3,
                'subject' => 'Hello Administrtor, ##USER_NAME## want\'s to contact you',
                'description' => $contact,
                'footer_text' => '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>',
                'email_preference_id' => 1,
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('email_templates');
        $table->insert($data)->save();
    }
}
