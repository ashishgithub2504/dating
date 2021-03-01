<?php
use Migrations\AbstractSeed;

/**
 * Settings seed.
 */
class SettingsSeed extends AbstractSeed
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
                'title' => 'Website Name',
                'slug' => 'SYSTEM_APPLICATION_NAME',
                'config_value' => 'Ajayco',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Admin Email',
                'slug' => 'ADMIN_EMAIL',
                'config_value' => 'jainashish2504@gmail.com',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'From Email',
                'slug' => 'FROM_EMAIL',
                'config_value' => 'jainashish2504@gmail.com',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Owner Name',
                'slug' => 'WEBSITE_OWNER',
                'config_value' => 'Ajay & Compant',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Telephone',
                'slug' => 'TELEPHONE',
                'config_value' => '+91-9928519150',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Admin Page Limit',
                'slug' => 'ADMIN_PAGE_LIMIT',
                'config_value' => '20',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Front Page Limit',
                'slug' => 'FRONT_PAGE_LIMIT',
                'config_value' => '20',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Admin Date Format',
                'slug' => 'ADMIN_DATE_FORMAT',
                'config_value' => 'd F, Y',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Admin Date Time Format',
                'slug' => 'ADMIN_DATE_TIME_FORMAT',
                'config_value' => 'd F, Y H:i A',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Front Date Format',
                'slug' => 'FRONT_DATE_FORMAT',
                'config_value' => 'd F, Y',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Front Date Time Format',
                'slug' => 'FRONT_DATE_TIME_FORMAT',
                'config_value' => 'd F, Y',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Reset URL expired in hours',
                'slug' => 'RESET_URL_EXPIRED',
                'config_value' => '24',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Development Mode',
                'slug' => 'DEVELOPMENT_MODE',
                'config_value' => '1',
                'manager' => 'general',
                'field_type' => 'checkbox',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Default currency',
                'slug' => 'DEFAULT_CURRENCY',
                'config_value' => 'USD',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Contact us text',
                'slug' => 'CONTACT_US_TEXT',
                'config_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Google Map Api Key',
                'slug' => 'GOOGLE_MAP_KEY',
                'config_value' => 'AIzaSyD9pg6_fzfgDHJFSW0wkrIcuCOw_V9qOfM',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Office Address',
                'slug' => 'ADDRESS',
                'config_value' => '6-Kha-9, Jawahar Nagar, <br> Jaipur, Rajasthan - 302004, India',
                'manager' => 'general',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Main Logo',
                'slug' => 'MAIN_LOGO',
                'config_value' => 'ds.jpg',
                'manager' => 'theme_images',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Main Favicon',
                'slug' => 'MAIN_FAVICON',
                'config_value' => 'dots-logon.png',
                'manager' => 'theme_images',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'SMTP Allow',
                'slug' => 'SMTP_ALLOW',
                'config_value' => '1',
                'manager' => 'smtp',
                'field_type' => 'checkbox',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'SMTP Email Host',
                'slug' => 'SMTP_EMAIL_HOST',
                'config_value' => 'smtp.gmail.com',
                'manager' => 'smtp',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'SMTP Username',
                'slug' => 'SMTP_USERNAME',
                'config_value' => 'jainashish2504@gmail.com',
                'manager' => 'smtp',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'SMTP Password',
                'slug' => 'SMTP_PASSWORD',
                'config_value' => 'anshu@ambia',
                'manager' => 'smtp',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'SMTP Port',
                'slug' => 'SMTP_PORT',
                'config_value' => '587',
                'manager' => 'smtp',
                'field_type' => 'text',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'SMTP Tls',
                'slug' => 'SMTP_TLS',
                'config_value' => '0',
                'manager' => 'smtp',
                'field_type' => 'checkbox',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            
            
        ];

        $table = $this->table('settings');
        $table->insert($data)->save();
    }
}
