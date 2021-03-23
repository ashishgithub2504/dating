<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Http\ServerRequest;

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
        $this->userPlan = TableRegistry::get('UserPlans');
        $plans = $this->userPlan->find()->select(['id','amount','no_of_coin','status','created'])->where(['user_id' => $this->Auth->user('id'),'status' => 'active'])->order(['created'=>'desc'])->hydrate(false)->toArray();
        if(!empty($plans)) {
            $response = [
                'status' => true,
                'code' => 200,
                'message' => 'List found',
                'data' => $plans,
            ];
        }

        $this->response($response);
    }
}
