<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use EmailQueue\Model\Table\EmailQueueTable;
use Cake\Network\Exception\SocketException;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\Console\ShellDispatcher;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class CronsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index()
    {
        $emailQueue = TableRegistry::get('EmailQueue', ['className' => EmailQueueTable::class]);
        $emails = $emailQueue->getBatch(10);
         foreach ($emails as $inc => $e) {
            $configName = 'default' ? 'default' : $e->config;
            $template = $e->template === 'default' ? 'default' : $e->template;
            $layout = $e->layout === 'default' ? 'default' : $e->layout;
            $headers = empty($e->headers) ? array() : (array) $e->headers;
            $theme = empty($e->theme) ? '' : (string) $e->theme;

             if (Configure::read('Setting.SMTP_ALLOW') != null) {
                    $configuration = 'newconfiguration';
                } else {
                    $configuration = 'default';
                }
            
            try {
                $this->setEmailConfig();
                $email = $this->_newEmail();
               // if (!empty($e->from_email) && !empty($e->from_name)) {
                    $email->setFrom($e->from_email, "DS");
                //}

                $transport = $email->setTransport($configuration);
                if ($transport && $transport->getConfig('additionalParameters')) {
                    $from = key($email->from());
                    $transport->setConfig(['additionalParameters' => "-f $from"]);
                }
		
                if (!empty($e->attachments)) {
                    $email->attachments($e->attachments);
                }
                //pr($e->template_vars);die;
                $replacement = [];
                if(!empty($e->template_vars)){
                    foreach($e->template_vars as $cons => $var){
                        $replacement['##'.$cons.'##'] = $var;
                    }
                }
              
                $messageTemplate = $this->buildMessage($e->template, $replacement);
                $subject = $messageTemplate['subject'];
                $message = $messageTemplate['message'];
                //pr($messageTemplate);die;
                $email->viewBuilder()->setTemplate('default');
                $email->viewBuilder()->setLayout($layout);
                $email->viewBuilder()->setTheme($theme);
                $sent = $email
                    ->setTo($e->email)
                    ->setSubject($subject)
                    ->setEmailFormat($e->format)
                    ->addHeaders($headers)
                    ->setViewVars(['content' => $message])
                    ->send();
                \Cake\Mailer\TransportFactory::drop($configuration);
            } catch (SocketException $exception) {
                pr($exception->getMessage());
                //$this->err($exception->getMessage());
                $sent = false;
            }
            echo $e->email;
            echo "<br>";
         }
    }
    
    protected function _newEmail()
    {
        return new Email();
    }
    
    public function setEmailConfig()
    {
        \Cake\Mailer\TransportFactory::setConfig('newconfiguration', [
            'host' => Configure::read('Setting.SMTP_EMAIL_HOST') != null ? Configure::read('Setting.SMTP_EMAIL_HOST') : "smtp.gmail.com",
            'port' => Configure::read('Setting.SMTP_PORT') != null ? Configure::read('Setting.SMTP_PORT') : 587,
            'username' => Configure::read('Setting.SMTP_USERNAME') != null ? Configure::read('Setting.SMTP_USERNAME') : 'jainashish2504@gmail.com',
            'password' => Configure::read('Setting.SMTP_PASSWORD') != null ? Configure::read('Setting.SMTP_PASSWORD') : 'anshu@ambia',
            'className' => 'Smtp',
            'tls' => Configure::read('Setting.SMTP_TLS') != null ?  Configure::read('Setting.SMTP_TLS') : false, //'tls' => true,  useing whne then you use gmail
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ]);
    }

    public function buildMessage($email_type, $replacement = null)
    {
	
        $email_template = TableRegistry::get('EmailManager.EmailTemplates');
        $query = $email_template->find('hook', ['slug' => $email_type]);
        $template = $query->first();
        $message = [];
        if(!empty($template)){
            $fullUrl = Router::url('/', true);
             $default_replacement = [
                '##SYSTEM_APPLICATION_NAME##' => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
                '##BASE_URL##' => $fullUrl,
                '##SYSTEM_LOGO##' => $fullUrl . 'img/uploads/settings/' . Configure::read('Setting.MAIN_LOGO'),
                '##COPYRIGHT_TEXT##' => "Copyright " . Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " " . date("Y"),
            ];
            $message_body = str_replace('##EMAIL_CONTENT##', $template->description, $template->email_preference->layout_html);
            $message_body = str_replace('##EMAIL_FOOTER##', $template->footer_text, $message_body);
            $message_body = strtr($message_body, $default_replacement);
            $message_body = strtr($message_body, $replacement);
            $subject = strtr($template->subject, $default_replacement);
            $subject = strtr($subject, $replacement);
            $message = ['message' => $message_body, 'subject' => $subject];
        }
        return $message;
    }
    
    public function send(){
        $shell = new ShellDispatcher();
        $output = $shell->run(['cake', 'EmailQueue.sender']);
        dump($output);die;
    }
}
