<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Http\ServerRequest;
use Cake\Routing\Router;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize() {
        parent::initialize();
        
        $this->RequestHandler->renderAs($this, 'json');        
        $this->Users = TableRegistry::get('UserManager.Users');        
    }

    public function coinhistory() {
        $response = [
            'status' => false,
            'message' => 'List Not found',
            'code' => 404
        ];
        $this->UserHistory = TableRegistry::get('UserHistory');
        $plans = $this->UserHistory->find()
        ->contain([
                'users'=> function($q) {
                    return $q->select(['username','profile_photo','photo_dir']);
                }
        ])
        ->where(['UserHistory.user_id' => $this->Auth->user('id'),'UserHistory.status' => 'active'])
        ->order(['date'=>'desc'])->hydrate(false)->toArray();
        if(!empty($plans)) {
            foreach ($plans as $key => $value) {
                $result[] = [
                    'user_id' => $value['user_id'],
                    'user_to' => $value['user_to'],
                    'type' => $value['type'],
                    'coin' => $value['coin'],
                    'username' => $value['Users']['username'],
                    'profile_photo' => !empty($value['profile_photo']) ? Router::url('/', true).str_replace('webroot/','',$value['photo_dir']).$value['profile_photo'] : Router::url('/', true).'img/user.png', 
                    'duration' => $value['duration'],
                    'date' => strtotime($value['date'])
                ];
            }
            $response = [
                'status' => true,
                'code' => 200,
                'message' => 'List found',
                'data' => $result,
            ];
        }

        $this->response($response);
    }
}
