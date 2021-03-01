<?php

namespace EmailManager\Controller\Admin;

use EmailManager\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * EmailTemplates Controller
 *
 * @property \EmailManager\Model\Table\EmailTemplatesTable $EmailTemplates
 *
 * @method \EmailManager\Model\Entity\EmailTemplate[] paginate($object = null, array $settings = [])
 */
class EmailTemplatesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        
        $query = $this->EmailTemplates->find();
        $query->contain(['EmailHooks' , 'EmailPreferences']);
        $query->order(['EmailTemplates.id' => 'DESC']);
        $emailTemplates = $query->all();
        
        $emailHooks = $this->EmailTemplates->EmailHooks->find('list', ['limit' => 200,'conditions'=>['EmailHooks.status'=>1]]);
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('list', ['limit' => 200]);
        
        $this->set(compact('emailTemplates','emailHooks','emailPreferences'));
        $this->set('_serialize', ['emailTemplates']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => ['EmailHooks', 'EmailPreferences']
        ]);

        $this->set('emailTemplate', $emailTemplate);
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {

        if ($id) {
            $emailTemplate = $this->EmailTemplates->get($id, [
                'contain' => []
            ]);
        } else {
            $emailTemplate = $this->EmailTemplates->newEntity();
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->getData());
            if ($this->EmailTemplates->save($emailTemplate)) {
                $status = true;
                $message = __('The email template has been saved.');
                if (!$this->request->is('Ajax')) {
                    $this->Flash->success($message);
                    return $this->redirect(['action' => 'index']);
                } else {
                    $resultJ = json_encode(array('status' => $status, 'errors' => $message));
                    $this->response->type('json');
                    $this->response->body($resultJ);
                    return $this->response;
                }
            }else{
                if ($this->request->is('Ajax')){
                    $resultJ = json_encode(array('status' => false, 'errors' => $emailTemplate->errors()));
                    $this->response->type('json');
                    $this->response->body($resultJ);
                    return $this->response;
                }
            }
            if (!$this->request->is('Ajax')){
                $this->Flash->error(__('The email template could not be saved. Please, try again.'));
            }
        }
        $emailHooks = $this->EmailTemplates->EmailHooks->find('list', ['limit' => 200,'conditions'=>['EmailHooks.status'=>1]]);
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('list', ['limit' => 200]);
        $templates = $this->EmailTemplates->find()->contain(['EmailHooks'])->order(['EmailTemplates.id' => 'DESC'])->all();
        //dump($templates);die;
        $this->set(compact('emailTemplate', 'emailHooks', 'emailPreferences', 'templates'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->getData());
            if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email template could not be saved. Please, try again.'));
        }
        $emailHooks = $this->EmailTemplates->EmailHooks->find('list', ['limit' => 200]);
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('list', ['limit' => 200]);
        $this->set(compact('emailTemplate', 'emailHooks', 'emailPreferences'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $emailTemplate = $this->EmailTemplates->get($id);
        if ($this->EmailTemplates->delete($emailTemplate)) {
            $this->Flash->success(__('The email template has been deleted.'));
        } else {
            $this->Flash->error(__('The email template could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * all email logs method
     *
     * @return \Cake\Http\Response|void
     */
    public function logs()
    {
        $obj = TableRegistry::get('EmailQueue.EmailQueue');
        
        $query = $obj->find();
        $options['order'] = ['EmailQueue.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $emails = $this->paginate($query);
        $this->set(compact('emails'));
        $this->set('_serialize', ['emails']);
    }
    
    /**
     * logView method
     *
     * @param string|null $id Email Log id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function logView($id = null)
    {
        $obj = TableRegistry::get('EmailQueue.EmailQueue');
        $email = $obj->get($id, [
            'contain' => []
        ]);
        $replacement = [];
                if(!empty($email->template_vars)){
                    foreach($email->template_vars as $cons => $var){
                        $replacement['##'.$cons.'##'] = $var;
                    }
                }
        $messageTemplate = $this->buildMessage($email->template, $replacement);
        $this->set(compact('email', 'messageTemplate'));
        $this->set('_serialize', ['email']);
    }
    
    /**
     * queueLogs method
     *
     * @return \Cake\Http\Response|void
     */
    public function queueLogs()
    {
        $obj = TableRegistry::get('EmailQueue.EmailQueue');
        
        $query = $obj->find();
        $query->where(['EmailQueue.sent' => 0]);
        $options['order'] = ['EmailQueue.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $emails = $this->paginate($query);
        $this->set(compact('emails'));
        $this->set('_serialize', ['emails']);
    }
    
    public function buildMessage($email_type, $replacement = null)
    {
	
        $email_template = TableRegistry::get('EmailManager.EmailTemplates');
        $query = $email_template->find('hook', ['slug' => $email_type]);
        $template = $query->first();
        $message = [];
        if(!empty($template)){
            $fullUrl = \Cake\Routing\Router::url('/', true);
             $default_replacement = [
                '##SYSTEM_APPLICATION_NAME##' => \Cake\Core\Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
                '##BASE_URL##' => $fullUrl,
                '##SYSTEM_LOGO##' => $fullUrl . 'img/' . \Cake\Core\Configure::read('Setting.MAIN_LOGO'),
                '##COPYRIGHT_TEXT##' => "Copyright " . \Cake\Core\Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " " . date("Y"),
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

}
