<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Hayko\Mongodb\ORM\Table;
use Cake\Routing\Router;
use Cake\Core\Configure;
use CatalogManager\Model\Entity\Product;
use Cake\Utility\Text;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Http\ServerRequest;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use League\Monga;


class WebserviceController extends AppController {

    public function initialize() {
        parent::initialize();
        
        $this->RequestHandler->renderAs($this, 'json');        
        $this->Users = TableRegistry::get('UserManager.Users');
        $this->Products = TableRegistry::get('CatalogManager.Products');
        $this->Category = TableRegistry::get('Categories');
        
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $response = [
            'status' => false,
            'message' => 'List Not found',
            'code' => 404
        ];
        $users = $this->Category->find()->contain(['users'])->where(['status'=>'1'])->toArray();
        $this->userPlans = TableRegistry::get('userPlans');

        $Details = $this->userPlans->find();
        $Details = $Details->where(['status' => 'active']);
        $sumOftotal_coin =  $Details->sumOf('no_of_coin');

        // print_r($sumOftotal_downtime); die;
        $this->userPlans->find()->where(['status'=>'active']);
        $response = [
            'status' => true,
            'message' => 'List found',
            'code' => 200,
            'data' => [
                'categories' => $users,
                'total_coin' => $sumOftotal_coin
            ]
        ];
        $this->response($response);
    }

    public function profileView() {
        $response = [
            'status' => false,
            'message' => 'User Not found',
            'code' => 404
        ];
        if(!empty($this->request->getData('user_id'))) {
            $userDetails = $this->Users->find()->contain(['userPhotos','UserVideos','userGifts'])->select(['id','username','first_name','last_name','dob','profile_photo','photo_dir','eye_color','hair_color','height','audio_call_rate','video_call_rate'])->where(['status'=>'1','id'=>$this->request->getData('user_id')])->first();
        }
        $response = [
            'status' => true,
            'message' => 'List found',
            'code' => 200,
            'data' => [
               $userDetails
            ]
        ];
        $this->response($response);
    }

    public function getnavigation() {
        
        $categories = $this->Category->find()
            ->where(['status'=>1,'parent_id' => 0])
            ->contain(['Products' => function($q) {
                return $q->select(['id','title','slug']);
            }])
            ->hydrate(false)
            ->toArray();
        $category = [];
        foreach($categories as $key=>$val) {
            $category[$key]['label'] = $val['title'];
            $category[$key]['url'] = $val['slug'];
            
            if(!empty($val['products'])) {
                foreach($val['products'] as $k => $v) {
                    $cat[$k]['label'] = $v['title'];
                    $cat[$k]['url'] = 'shop/products/'.$v['slug'];
                    $cat[$k]['enabled'] = true;
                }
            }
            $category[$key]['menu'] = [
                'type'=>'menu',
                'items' => $cat
            ];
        }
        
        $response = [
            'status' => true,
            'message' => 'List found',
            'code' => 200,
            'data' => $category
            ];
        $this->response($response);
    }

    public function login(){
        $response = [
            'status' => false,
            'message' => 'Invalid credentials, try again',
            'code' => 404
        ];
        if ($this->request->is('post')) {
            // $this->request->data = $this->request->data['detail'];
            // print_r($this->request->data);
            $user = $this->Auth->identify();
            // echo Router::url('/', true);
            // print_r($user); die;
            $user['profile_photo'] = Router::url('/', true).str_replace('webroot/','',$user['photo_dir']).$user['profile_photo'];
            if ($user) {
                $user['token'] = $this->token();

                // print_r($token); die;
                if ($user['is_verified'] != 1) {
                    $response['message'] = 'Your account is not verified. Please check your email and verify them.';
                } else if ($user['status'] != 1) {
                    $response['message'] = 'Your account has been deactivated. Please contact ' . $this->ConfigSettings['SYSTEM_APPLICATION_NAME'] . ' Support for assistance';
                } else {
                    $this->Auth->setUser($user);
                    $response = [
                        'status' => true,
                        'code' => 200,
                        'data' => $user,
                        'message' => 'You have successfully login'
                    ];
                }
            }
        }
        $this->response($response);
    }

    public function signup(){
        
        $response = [
            'staus' => false,
            'message' => 'invalid registration',
            'code' => 404
        ];
        $this->request->data = $this->request->getData();
        if(!isset($this->request->data['username']) && empty($this->request->data['username'])) {
            $this->request->data['username'] = Text::uuid();
        }

        if(!isset($this->request->data['email']) && empty($this->request->data['email'])) {
            $this->request->data['email'] = $this->request->data['username'].'@dating.com';
        }
        // print_r($this->request->data); die;
        
        $this->request->data['login_count'] = 0;
        $this->request->data['is_verified'] = 1;
        $this->request->data['status'] = 1;
        $this->Users = TableRegistry::get('UserManager.Users');
        $user = $this->Users->newEntity();
        
        $user = $this->Users->patchEntity($user, $this->request->data);
        
        if ($this->Users->save($user)) {
            $userInfo = $this->_loginresponse($user->id);
            $response = ['status'=>true,'code' => 200 ,'message'=>'You have successfully registred','data' => $userInfo];
        }else{
             $response['data'] = $user->errors();
        }
        $this->response($response);
    }

    private function _loginresponse($id) {
        return $this->Users->find()->where(['id'=>$id])->first();
    }

    public function staticpage() {
        $response = ['status'=>false,'code' => 404 ,'message'=>'List Not Found'];
        //if($this->request->is(['post'])) {
            //pr(); die;
            $result = TableRegistry::get('pages')
                    ->find()
                    ->where(['slug' => $this->request->query('name')])
                    ->first();
            if(!empty($result)){
                $response = ['status'=>true,'code' => 200 ,'message'=>'List Found','data' => $result];
            }else {
                $response = ['status'=>false,'code' => 404 ,'message'=>'List Not Found'];
            }    
        //}        
     
        $this->response($response);
    }

    public function getcategories() {
        $categories = $this->Category->find('all', [
            //'spacer' => '_', 
            'conditions' => ['status' => 1,'parent_id' => 0],
            'fields' => ['id' ,'name'=> 'title','title','slug','url'=>'slug','image'],
            ]);
        
        if(!empty($categories->toArray())){
            $response = [
                'status' => true,
                'message' => 'List found',
                'code' => 200,
                'data' => $categories->toArray()
            ];
        }
        
        $this->response($response);

    }

    public function enquiry() {
        $response = [
            'staus' => false,
            'message' => 'Enquiry not submited successfully',
            'code' => 404
        ];
        $this->inquiries = TableRegistry::get('ContactManager.Inquiries');
        $inquiries = $this->inquiries->newEntity();
        $inquiries = $this->inquiries->patchEntity($inquiries, $this->request->data['detail']);
        
        if($this->inquiries->save($inquiries)) {
            $response = ['status'=>true,'code' => 200 ,'message'=>'You enquiry has been successfully saved. we will contact  you shortly.','data' => $inquiries];
        }
        $this->response($response);
        
    }

    public function createorder() {
        $response = [
            'staus' => false,
            'message' => 'Order Not created successfully',
            'code' => 404
        ];
        if(!empty($this->request->data) ) {
            $this->order = TableRegistry::get('Orders');
            $this->orderdetail = TableRegistry::get('OrderDetails');

            $entity = $this->order->newEntity();
            $entity->order_no = '1001';
            $entity->order_amount = isset($this->request->data['price'])?$this->request->data['price']:'';
            $entity->status = '2';
            if($this->order->save($entity)) {
                foreach($this->request->data['detail'] as $k=>$v) {
                    $details = $this->orderdetail->newEntity();
                    $details->order_id = $entity->id;
                    $details->product_name = $v['title'];
                    $details->product_image = $v['image'];
                    $details->qty = $v['qty'];
                    $details->price = $v['price'];
                    $details->status = '1';
                    $this->orderdetail->save($details);            
                }
                $response = ['status'=>true,'code' => 200 ,'message'=>'You order has been successfully saved.','data' => $entity];
            } else {
                pr($entity); die;
            }
        }
        
        $this->response($response);
    }

    public function completeorder() {
        $response = [
            'staus' => false,
            'message' => 'Payment not accepted',
            'code' => 404
        ];
        if(!empty($this->request->data) ) {
            $this->order = TableRegistry::get('Orders');
            $order_detail = $this->order->get($this->request->data['order_id']);
            $order_detail->payment_id = $this->request->data['payment_id'];
            $order_detail->status = '1';
            if($this->order->save($order_detail)) {
                $response = ['status'=>true,'code' => 200 ,'message'=>'Payment has been accepted.'];   
            }
        }

        $this->response($response);
    }

    public function editprofile()
    {
        $response = [
            'staus' => false,
            'message' => 'Profile not edit successfully',
            'code' => 404
        ];
        if(!empty($this->request->getData())) {
            $postData = $this->request->getData();
            $userInfo = $this->Users->get($this->Auth->user('id'));
            // if(!empty($_FILES['profile_photo_file'])) {
                $fileName =  str_replace(' ','_', $_FILES['profile_photo_file']['name']);
                $_dir = 'img' . DS . 'uploads' . DS . 'users' . DS;
                // print_r($_FILES['profile_photo_file']); die;
                move_uploaded_file($_FILES['profile_photo_file']['tmp_name'],$_dir.$fileName);
                $postData['profile_photo'] = $fileName;
                    
            // }
            $userPatch = $this->Users->patchEntity($userInfo, $postData);
            if($this->Users->save($userPatch)) {
                $response = ['status'=>true,'code' => 200 ,'message'=>'Profile edit successfully.'];  
            }
            $this->response($response);
        }
    }
    
    public function profilephotos()
    {
        $response = [
            'staus' => false,
            'message' => 'Profile images not upload',
            'code' => 404
        ];
        if(!empty($this->request->getData('images'))) {
            $this->UserPhotosTable = TableRegistry::get('UserPhotos');
            foreach ($this->request->getData('images') as $key => $value) {
                $userphoto = $this->UserPhotosTable->newEntity();
                $fileName =  time().str_replace(' ','_', $value['name']);
                $_dir = 'webroot' . DS . 'img' . DS . 'uploads' . DS . 'users' . DS . 'images' . DS;
                if (!file_exists($_dir)) {
                    mkdir($_dir, 0777, true);
                }
                move_uploaded_file($value['tmp_name'],$_dir.$fileName);
                $userphoto->user_id = $this->Auth->user('id');
                $userphoto->image = $fileName;
                $userphoto->status = 'active';
                $this->UserPhotosTable->save($userphoto);
            }
            $response = ['status'=>true,'code' => 200 ,'message'=>'Profile images uploaded successfully.'];
        }
        $this->response($response);
    }

    public function callinfo()
    {
        $response = [
            'status' => false,
            'message' => 'detail not saved',
            'code' => 404
        ];
        $postData = $this->request->getData();
        if(!empty($postData)) {
            $con = new \MongoDB\Client("mongodb://localhost:27017");  
            // Creating Database  
            $db = $con->dating;  
            // Creating Document  
            $collection = $db->user_call_info;  
            // Insering Record  
            $data = $collection->insertOne( [ 
                'user_from' =>$this->Auth->user('id'),
                'user_to' =>$postData['user_id'], 
                'type' => $postData['type'],
                'start_time'  => $postData['start_time'],
                'end_time' => $postData['end_time'],
                'status' => 'active'
            ] );  
            if($data->getInsertedCount()) {
                $response = [
                    'status' => true,
                    'message' => 'Call detail saved successfully',
                    'code' => 200,
                    'data' => $data->getInsertedId()
                ];
            }    
        }
        $this->response($response);
    }

    public function follow()
    {
        $response = [
            'status' => false,
            'message' => 'detail not saved',
            'code' => 404
        ];
        $postData = $this->request->getData();
        if(!empty($postData)) {
            $this->Followers = TableRegistry::get('Followers');
            $userfollow = $this->Followers->find()->where(['follow_from' => $this->Auth->user('id'), 'follow_to' => $postData['user_id']])->first();
            if(empty($userfollow)) {
                $userfollow = $this->Followers->newEntity();    
            }
            $userfollow->follow_from = $this->Auth->user('id');
            $userfollow->follow_to = $postData['user_id'];
            $userfollow->status = $postData['status'];
            if($this->Followers->save($userfollow)) {
                $response = [
                    'status' => true,
                    'message' => 'Follower saved successfully',
                    'code' => 200
                ];
            }    
        }
        $this->response($response);
    }

    public function token() 
    {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }
        return json_encode([
            // 'success' => true,
                'token' => JWT::encode([
                    'sub' => $user['id'],
                    'exp' =>  time() + 604800
                ],
                Security::salt())
            // '_serialize' => ['success', 'data']
        ]);
    }

    public function mongodb() 
    {
        // require 'vendor/autoload.php';  
        // Creating Connection  
        $con = new \MongoDB\Client("mongodb://localhost:27017");  
        // Creating Database  
        $db = $con->dating;  
        // Creating Document  
        $collection = $db->user_call_info;  
        // Insering Record  
        // $collection->insertOne( [ 'name' =>'Peter', 'email' =>'peter@abc.com' ] );  
        // Fetching Record  
        $record = $collection->find( [ 'status' =>'active'] );

        foreach ($record as $employe) {  
            echo $employe['user_from'], ': ', $employe['user_to']."<br>";
            echo $employe['type'], ': ', $employe['status']."<br>";  
        }  
        die;
        // $collection = $mongodb->collection('collection_name');
        // $database_list = $mongodb->listDatabases(); 
        // print_r($database);die;
        // $mongo = new Mongo('localhost:27017');
        // $db= $mongo->selectDB('dating');
        // $collection = $db->selectCollection('user_call_info');
        // $result = $collection->find();
        // $connection = ConnectionManager::get('default2','default');
        // ConnectionManager::alias('default2','default');
        // $result = $connection.collection.find();
        //$results = $connection->execute('SELECT * FROM user_call_info')->fetchAll('assoc');
        // $obj = new Table(['user_call_info']);
        // $data = $obj->find('all');
        // $data = $this->UserCallInfo->find('all')->toArray();
        // $data = $this->UserCallInfo->find()->where(['status'=>'active'])->toArray();
        print_r($result); die;
    }
}
