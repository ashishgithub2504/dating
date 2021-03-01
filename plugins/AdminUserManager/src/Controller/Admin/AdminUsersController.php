<?php namespace AdminUserManager\Controller\Admin;

use AdminUserManager\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
/**
 * AdminUsers Controller
 *
 * @property \AdminUserManager\Model\Table\AdminUsersTable $AdminUsers
 *
 * @method \AdminUserManager\Model\Entity\AdminUser[] paginate($object = null, array $settings = [])
 */
class AdminUsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Cookie');
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null
     */
    public function login()
    {

        if ($this->request->getQuery('status')) {
            $this->Auth->logout();
        }
        if ($this->Auth->user('id')) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['is_verified'] != 1) {
                    $this->Flash->error(__('Your account is not verified. Please check your email and verify them.'));
                } else if ($user['status'] != 1) {
                    $this->Flash->error(__('Your account has been deactivated. Please contact ' . $this->ConfigSettings['SYSTEM_APPLICATION_NAME'] . ' Support for assistance'));
                } else {
                    $this->Auth->setUser($user);
                    $incQuery = $this->AdminUsers->query();
                    $incQuery->update()->set($incQuery->newExpr('login_count = login_count + 1'))->where(['id' => $user['id']])->execute();
                    $this->_setCookie();
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->error(__('Invalid credentials, try again'));
            }
        } else {
            $logincookie = $this->Cookie->read('adminremember_me');
            if (!empty($logincookie)){
                $this->request = $this->request->withParsedBody($logincookie);
            }
        }
    }

    protected function _setCookie()
    {
        if ($this->request->getData('adminremember_me') == 1) {
            $readCoook = ($this->Cookie->read('adminremember_me'));
            if (!empty($readCoook) && $readCoook['email'] != $this->request->getData('email')) {
                $this->Cookie->write('adminremember_me', $this->request->getData());
            } else if (empty($readCoook)) {
                $this->Cookie->write('adminremember_me', $this->request->getData());
            }
        } else {
            $this->Cookie->delete('adminremember_me');
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $query = $this->AdminUsers->find();
        $query->contain(['Roles']);
        $options['order'] = ['AdminUsers.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $adminUsers = $this->paginate($query);


        $this->set(compact('adminUsers'));
        $this->set('_serialize', ['adminUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminUser = $this->AdminUsers->get($id, [
            'contain' => ['Roles']
        ]);

        $this->set('adminUser', $adminUser);
        $this->set('_serialize', ['adminUser']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if ($id) {
            $adminUser = $this->AdminUsers->get($id, [
                'contain' => ['Roles']
            ]);
        } else {
            $adminUser = $this->AdminUsers->newEntity();
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            //pr($adminUser->getErrors());die;
            if ($this->AdminUsers->save($adminUser)) {
                $this->Flash->success(__('The admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin user could not be saved. Please, try again.'));
        }

        $roles = $this->AdminUsers->Roles->find('list', ['limit' => 200]);
        $this->set(compact('adminUser', 'roles'));
        $this->set('_serialize', ['adminUser']);
    }

    /**
     * profile method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function profile()
    {
        $adminUser = $this->AdminUsers->get($this->Auth->user("id"), [
            'contain' => ['Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->data['password'] == "") {
                unset($this->request->data['confirm_password']);
            }
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->data, ['validate' => 'update']);
            if ($this->request->data['password'] == "") {
                unset($adminUser->password);
            }
            if ($this->AdminUsers->save($adminUser)) {
                $this->request->session()->write('Auth.Admin', $adminUser->toArray());
                $this->Flash->success(__('Your account detail has been updated.'));
                return $this->redirect(['action' => 'profile']);
            } else {
                $this->Flash->error(__('The admin user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->AdminUsers->Roles->find('list');
        $this->set(compact('adminUser', 'roles'));
        $this->set('_serialize', ['adminUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminUser = $this->AdminUsers->get($id);
        if ($this->AdminUsers->delete($adminUser) && $this->AdminUsers->deleteImage($adminUser->profile_photo)) {
            $this->Flash->success(__('The admin user has been deleted.'));
        } else {
            $this->Flash->error(__('The admin user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * deleteimg method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null Redirects to referer url.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteimg($id = null)
    {
        $record = $this->AdminUsers->get($id);
        if ($this->AdminUsers->deleteImage($record->profile_photo, $record)) {
            $this->Flash->success(__('The profile photo has been deleted.'));
        } else {
            $this->Flash->error(__('The profile photo could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * ChangeFlag method
     *
     * @param string|null &id Admin User id.
     * @param string|null &id field those update table field.
     * @param string|null &status Admin status.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->AdminUsers->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->AdminUsers->save($status)) {
                if($field == "is_verified"){
                    $msg = $status->$field == 1 ? __("Your verification has verified") : __("Your verification has un verified");
                }else{
                    $msg = $this->request->getData($field) == 1 ? __("Your {$field} has activated") : __("Your {$field} has deactivated");
                }
                $response = ["success" => true, "err_msg" => $msg];
            } else {
                $response = ["success" => false, "err_msg" => __("Your Process faild. please try again!!")];
            }
            $this->set([
                'success' => $response['success'],
                'responce' => 200,
                'message' => $response['err_msg'],
                '_jsonOptions' => JSON_FORCE_OBJECT,
                '_serialize' => ['success', 'responce', 'message']
            ]);
        }
    }

    /**
     * Verifyaccount method
     *
     * @param string|null token Adminuser token.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function verifyaccount($token = null)
    {
        if (!$token) {
            return $this->redirect(['action' => 'login']);
        }

        $UserTokens = TableRegistry::get('UserTokens');
        $query = $UserTokens->find('token', ['token' => $token, 'user_type' => 'admin_user', 'token_type' => 'account_confirmation']);
        $res = $query->first();
        if (empty($res)) {
            $this->Flash->error(__('Your token has expired.!'));
            return $this->redirect(['action' => 'login']);
        }
        $adminUser = $this->AdminUsers->get($res->user_id);
        if ($this->request->is(['post', 'put'])) {
            $adminUser->password = $this->request->data['password'];
            $adminUser->is_verified = 1;
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData(), ['validate' => 'resetpassword']);
            if ($this->AdminUsers->save($adminUser)) {
                $this->Auth->logout();
                $tokenq = $UserTokens->query()->delete()->where(['id' => $res->id])->execute();
                $this->Flash->success(__('Your password created successfully.'));
                return $this->redirect(['action' => 'login', '?' => ['status' => 1]]);
            }
        }
        $this->set(compact('adminUser', 'roles'));
        $this->set('_serialize', ['adminUser']);
    }

    /**
     * forgot method
     *
     * @param post string|null email Adminuser email.
     * @return \Cake\Http\Response|null Redirects to login.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function forgot()
    {
        if ($this->request->is('post')) {
            $result = $this->AdminUsers->find()->where(['email' => $this->request->data['email'], 'AdminUsers.status' => 1, 'AdminUsers.is_verified' => 1])->first();
            if (!empty($result)) {
                $uid = \Cake\Utility\Text::uuid();
                $data = $result->toArray();
                $uinfo = $data;
                $uinfo['USER_NAME'] = $data['name'];
                $uinfo['USER_RESET_LINK'] = \Cake\Routing\Router::url(['controller' => 'AdminUsers', 'action' => 'passwordreset','plugin'=>'AdminUserManager',$uid], true);
                $_usertoken = TableRegistry::get('UserTokens')->newEntity(['user_id'=>$data['id'], 'user_type'=> 'admin_user','token_type'=> 'forgot','token'=> $uid]);
                TableRegistry::get('UserTokens')->save($_usertoken);
                //\EmailQueue\EmailQueue::enqueue([$data['email']], $uinfo, ['template'=>'forgot-password-email']);
                TableRegistry::get('Queue.QueuedJobs')->createJob('Email', ['settings' => ['setTo' => $data['email']],'hooks' => 'forgot-password-email','hooksVars' => $uinfo]);
                $this->Flash->success(__('Your password reset link has been sent to your email!'));
                return $this->redirect(['action' => 'forgot']);
            } else {
                $this->Flash->error(__('This email address does not exist in database.!'));
            }
        }
    }

    public function passwordreset($token = null)
    {
        if (!$token) {
            return $this->redirect(['action' => 'login']);
        }
        $UserTokens = TableRegistry::get('UserTokens');
        $query = $UserTokens->find('token', ['token' => $token, 'user_type' => 'admin_user', 'token_type' => 'forgot']);
        $res = $query->first();
        if (empty($res)) {
            $this->Flash->error(__('Your token has expired.!'));
            return $this->redirect(['action' => 'forgot']);
        }
        $adminUser = $this->AdminUsers->get($res->user_id);
        if ($this->request->is(['post', 'put'])) {
            $adminUser->id = $res->user_id;
            $adminUser->password = $this->request->getData('password');
            $adminUser->confirm_password = $this->request->getData('confirm_password');
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData(), ['validate' => 'resetpassword']);
            if ($this->AdminUsers->save($adminUser)) {
                $tokenq = $UserTokens->query()->delete()->where(['id' => $res->id])->execute();
                $this->Flash->success(__('Your password has changed.'));
                return $this->redirect(['action' => 'login', '?' => ['status' => 1]]);
            }
        }
        $this->set(compact('adminUser', 'roles'));
        $this->set('_serialize', ['adminUser']);
    }
    /*

     * Reset email
     * $id user id
     **/
    public function resend($id = null)
    {
            $adminUser = $this->AdminUsers->get($id, [
             'contain' => ['Roles']
            ]);
            
            $uid = \Cake\Utility\Text::uuid();
            $data = $adminUser->toArray();
            $uinfo = $data;
            $uinfo['USER_NAME'] = $data['name'];
            $uinfo['USER_INFO'] = "";
            $uinfo['verify_n_password'] = \Cake\Routing\Router::url(['controller' => 'AdminUsers', 'action' => 'verifyaccount','plugin'=>'AdminUserManager',$uid], true);
            $user_type = "admin_user";
            $token_type = "account_confirmation";
            $_usertoken = TableRegistry::get('UserTokens')->newEntity();
            $_usertoken->user_id = $data['id'];
            $_usertoken->user_type = $user_type;
            $_usertoken->token_type = $token_type;
            $_usertoken->token = $uid;
            TableRegistry::get('UserTokens')->save($_usertoken);
            \EmailQueue\EmailQueue::enqueue([$data['email']], $uinfo, ['template'=>'welcome-email']);
            $this->Flash->success(__('Verification email has resend successfully.'));
            return $this->redirect($this->referer());
    }
}
