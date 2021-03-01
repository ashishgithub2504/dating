<?php namespace UserManager\Controller;

use UserManager\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\MailerAwareTrait;

/**
 * Users Controller
 *
 * @property \UserManager\Model\Table\UsersTable $Users
 *
 * @method \UserManager\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    use MailerAwareTrait;

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
        // if ($this->Auth->user('id')) {
        //     return $this->redirect($this->Auth->redirectUrl());
        // }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['is_verified'] != 1) {
                    $this->Flash->error(__('Your account is not verified. Please check your email and verify them.'));
                } else if ($user['status'] != 1) {
                    $this->Flash->error(__('Your account has been deactivated. Please contact ' . $this->ConfigSettings['SYSTEM_APPLICATION_NAME'] . ' Support for assistance'));
                } else {
                    $this->Auth->setUser($user);
                    $incQuery = $this->Users->query()->update()->set($incQuery->newExpr('login_count = login_count + 1'))->where(['id' => $user['id']])->execute();
                    $this->_setCookie();
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->error(__('Invalid credentials, try again'));
            }
        } else {
            $logincookie = $this->Cookie->read('user_me');
            if (!empty($logincookie)) {
                $this->request = $this->request->withParsedBody($logincookie);
            }
        }
    }

    protected function _setCookie()
    {
        if ($this->request->getData('adminremember_me') == 1) {
            $readCoook = ($this->Cookie->read('adminremember_me'));
            if (!empty($readCoook) && $readCoook['email'] != $this->request->getData('email')) {
                $this->Cookie->write('user_me', $this->request->getData());
            } else if (empty($readCoook)) {
                $this->Cookie->write('user_me', $this->request->getData());
            }
        } else {
            $this->Cookie->delete('user_me');
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
        $res = $UserTokens->find('token', ['token' => $token, 'user_type' => 'users', 'token_type' => 'account_confirmation'])->first();
        if (empty($res)) {
            $this->Flash->error(__('Your token has expired.!'));
            return $this->redirect(['action' => 'login']);
        }
        $user = $this->Users->get($res->user_id);
        if ($this->request->is(['post', 'put'])) {
            $user->is_verified = 1;
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetpassword']);
            if ($this->Users->save($user, ['checkRules' => false])) {
                //$this->Auth->logout();
                $tokenq = $UserTokens->query()->delete()->where(['id' => $res->id])->execute();
                $this->Flash->success(__('Your password created successfully.'));
                return $this->redirect(['action' => 'login', '?' => ['status' => 1]]);
            }
        }
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
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
            $result = $this->Users->find()->where(['email' => $this->request->data['email']])->first();
            if (!empty($result)) {
                $this->getMailer('Manu')->send('forgot', [$result]);
                $this->Flash->success(__('Your password reset link has been sent to your email!'));
                return $this->redirect(['action' => 'forgot']);
            } else {
                $this->Flash->error(__('This email address does not exist in database.!'));
            }
        }
    }
    /**
     * signup method
     *
     * @param post string|null email Adminuser email.
     * @return \Cake\Http\Response|null Redirects to login.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function signup()
    {
       
    }

    public function passwordreset($token = null)
    {
        if (!$token) {
            return $this->redirect(['action' => 'login']);
        }
        $UserTokens = TableRegistry::get('UserTokens');
        $query = $UserTokens->find('token', ['token' => $token, 'user_type' => 'website_users', 'token_type' => 'forgot']);
        $res = $query->first();
        if (empty($res)) {
            $this->Flash->error(__('Your token has expired.!'));
            return $this->redirect(['action' => 'forgot']);
        }
        $user = $this->Users->get($res->user_id);
        if ($this->request->is(['post', 'put'])) {
            $user->id = $res->user_id;
            $user->password = $this->request->getData('password');
            $user->confirm_password = $this->request->getData('confirm_password');
            pr($this->request->getData());
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetpassword']);
            //die("tt");
            if ($this->Users->save($user)) {
                $tokenq = $UserTokens->query()->delete()->where(['id' => $res->id])->execute();
                $this->Flash->success(__('Your password has changed.'));
                return $this->redirect(['action' => 'login', '?' => ['status' => 1]]);
            }
        }
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response
     */
    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }
}
