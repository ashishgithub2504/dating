<?php

use Migrations\AbstractSeed;

/**
 * EmailPreferences seed.
 */
class EmailPreferencesSeed extends AbstractSeed
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
        $layout = <<<HTML
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body><div>
<table align="center" cellpadding="0" cellspacing="0" style="border:1px solid #dddddd;" width="650">
	<tbody>
		<tr>
			<td>
			<table cellpadding="0" cellspacing="0" style="background:#ffffff; border-bottom:1px solid #dddddd; padding:15px;" width="100%">
				<tbody>
					<tr>
						<td><a href="##BASE_URL##" target="_blank"><img alt="" border="0" src="##SYSTEM_LOGO##" /></a></td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td style="background:#ffffff; padding:15px;">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:#000000; font-size:16px;">
							##EMAIL_CONTENT##
						</td>
					</tr>
					<tr>
						<td style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:#043f8d; font-size:16px; vertical-align:middle; text-align:left; padding-top:20px;">
						##EMAIL_FOOTER##
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td style="background:#043f8d; border-top:1px solid #dddddd; text-align:center; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:#ffffff; padding:12px; font-size:12px; text-transform:uppercase; font-weight:normal;">##COPYRIGHT_TEXT##</td>
		</tr>
	</tbody>
</table>
</div>
</body>
</head>
</html>
HTML;
        $data = [
            [
                'id' => '1',
                'title' => 'Main Email Layout',
                'layout_html' => $layout,
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('email_preferences');
        $table->insert($data)->save();
    }
}
