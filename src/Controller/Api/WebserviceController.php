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
        $this->userPlans = TableRegistry::get('userPlans');
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
        $cats = $this->Category->find()
                ->contain(['users'=>function($q) {
                    return $q->where(['Users.id !=' => $this->Auth->user('id')]);
                }])->where(['status'=>'1'])->toArray();
        
        $Gifts = TableRegistry::get('Gifts')->find()->where(['status'=>'active'])->toArray();
        // print_r($Gifts); die;
        if(!empty($Gifts)) {
            foreach ($Gifts as $key => $value) {
                $Gifts[$key]['image'] = Router::url('/', true).'img' . DS . 'uploads' . DS . 'gifts' . DS.$value['image'];
            }
        }

        if(!empty($cats)) {
            foreach ($cats as $key => $users) {
                foreach ($users['users'] as $k => $value) {
                    $cats[$key]['users'][$k]['profile_photo'] = !empty($value['profile_photo']) ? Router::url('/', true).str_replace('webroot/','',$value['photo_dir']).$value['profile_photo'] : Router::url('/', true).'img/user.png';
                }
            }
        }
        // print_r($sumOftotal_downtime); die;
        // $this->userPlans->find()->where(['status'=>'active']);
        $response = [
            'status' => true,
            'message' => 'List found',
            'code' => 200,
            'data' => [
                'categories' => $cats,
                'total_coin' => $this->totalCoin(),
                'Gifts' => !empty($Gifts)?$Gifts:[]
            ]
        ];
        $this->response($response);
    }

    private function totalCoin($user_id = '') {
        $userId = !empty($user_id) ? $user_id : $this->Auth->user('id');
        $Details = $this->userPlans->find();
        $Details = $Details->where(['status' => 'active', 'user_id' => $userId ]);
        return $Details->sumOf('no_of_coin');
    }

    public function profileView() {
        $response = [
            'status' => false,
            'message' => 'User Not found',
            'code' => 404
        ];
        // if(!empty($this->request->getData('user_id'))) {
            $userDetails = $this->Users->find()
                            ->contain(['userPhotos','UserVideos'
                                // ,'userGifts'=>function($q) {
                                //       return $q->contain(['Gifts']);
                                // }
                            ])
                            ->select(['id','username','first_name','last_name','dob','profile_photo','photo_dir','eye_color','hair_color','height','audio_call_rate','video_call_rate','sex','about_us','country','mobile'])
                            ->where([
                                'status'=>'1',
                                'id'=> !empty($this->request->getData('user_id')) ? $this->request->getData('user_id') : $this->Auth->user('id')
                            ])
                            ->first();
            $userDetails['profile_photo'] = !empty($userDetails['profile_photo']) ? Router::url('/', true).str_replace('webroot/','',$userDetails['photo_dir']).$userDetails['profile_photo'] : Router::url('/', true).'img/user.png';
            
            if(!empty($userDetails['user_photos'])) {
                foreach ($userDetails['user_photos'] as $key => $value) {
                    $userDetails['user_photos'][$key]['image'] = Router::url('/', true).'img' . DS . 'uploads' . DS . 'users' . DS . 'images' . DS.$value['image'];
                }
            }

            if(!empty($userDetails['user_videos'])) {
                foreach ($userDetails['user_videos'] as $key => $value) {
                    $userDetails['user_videos'][$key]['image'] = Router::url('/', true).'img' . DS . 'uploads' . DS . 'users' . DS . 'videos' . DS.$value['image'];
                }
            }
        // }
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
            if ($user) {
                $user['token'] = json_decode($this->token())->token;
                $user['profile_photo'] = !empty($user['profile_photo']) ? Router::url('/', true).str_replace('webroot/','',$user['photo_dir']).$user['profile_photo'] : Router::url('/', true).'img/user.png';
                $user['fcm_Token'] = $this->request->data['fcm_Token'];
                // print_r($token); die;
                if ($user['is_verified'] != 1) {
                    $response['message'] = 'Your account is not verified. Please check your email and verify them.';
                } else if ($user['status'] != 1) {
                    $response['message'] = 'Your account has been deactivated. Please contact ' . $this->ConfigSettings['SYSTEM_APPLICATION_NAME'] . ' Support for assistance';
                } else {
                    $resp = $this->Users->find()->where(['id' => $user['id']])->first();
                    $resp['fcm_Token'] = $this->request->data['fcm_Token'];
                    // print_r($resp); die;
                    $this->Users->save($resp);
                    $this->Auth->setUser($user);
                    $user['total_coin'] = $this->totalCoin();
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
        
        if($this->request->data['sex'] == 'male') {
            $this->request->data['is_verified'] = 1;
            $this->request->data['status'] = 1;
        } else {
            $this->request->data['is_verified'] = 0;
            $this->request->data['status'] = 0;
        }
        $this->Users = TableRegistry::get('UserManager.Users');
        $user = $this->Users->newEntity();
        
        $user = $this->Users->patchEntity($user, $this->request->data);
        
        if ($this->Users->save($user)) {
            $userInfo = $this->_loginresponse($user->id);
            $userInfo['profile_photo'] = !empty($userInfo['profile_photo']) ? Router::url('/', true).str_replace('webroot/','',$userInfo['photo_dir']).$userInfo['profile_photo'] : Router::url('/', true).'img/user.png';
            $userInfo['token'] = json_decode($this->token($user->id))->token;
            $userInfo['total_coin'] = $this->totalCoin($user->id);
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
            $userPatch = $this->Users->patchEntity($userInfo, $postData);

            if($this->Users->save($userPatch)) {
                $userPatch['profile_photo'] = !empty($userPatch['profile_photo']) ? Router::url('/', true).str_replace('webroot/','',$userPatch['photo_dir']).$userPatch['profile_photo'] : Router::url('/', true).'img/user.png';
                $response = ['status'=>true,'code' => 200 ,'message'=>'Profile edit successfully.','data'=>$userPatch];  
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

        if(!empty($this->request->getData('videos'))) {
            $this->UserPhotosTable = TableRegistry::get('UserVideos');
            foreach ($this->request->getData('videos') as $key => $value) {
                $userphoto = $this->UserPhotosTable->newEntity();
                $fileName =  time().str_replace(' ','_', $value['name']);
                $_dir = 'webroot' . DS . 'img' . DS . 'uploads' . DS . 'users' . DS . 'videos' . DS;
                if (!file_exists($_dir)) {
                    mkdir($_dir, 0777, true);
                }
                move_uploaded_file($value['tmp_name'],$_dir.$fileName);
                $userphoto->user_id = $this->Auth->user('id');
                $userphoto->image = $fileName;
                $userphoto->status = 'active';
                $this->UserPhotosTable->save($userphoto);
            }
            $response = ['status'=>true,'code' => 200 ,'message'=>'Profile videos uploaded successfully.'];
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
            $this->userCallInfo = TableRegistry::get('UserCallInfo');
            if(!empty($postData['id'])) {
                $userCallInfo = $this->userCallInfo->find()->where(['id'=>$postData['id']])->first();
            } else {
                $userCallInfo = $this->userCallInfo->newEntity();    
            }
            $userCallInfo->user_from = $this->Auth->user('id');
            $userCallInfo->user_to = $postData['user_id'];
            $userCallInfo->type = $postData['type'];
            $userCallInfo->start_time = $postData['start_time'];
            $userCallInfo->end_time = $postData['end_time'];
            $userCallInfo->status = 'active';

            if($this->userCallInfo->save($userCallInfo)) {

                $userCallInfo['total_coin'] = $this->totalCoin($this->Auth->user('id'));
                    
                $response = [
                    'status' => true,
                    'message' => 'Call detail saved successfully',
                    'code' => 200,
                    'data' => $userCallInfo
                ];
            }    
        }
        $this->response($response);
    }

    public function callinfomongo()
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

    public function planList() {
        $response = [
            'status' => false,
            'message' => 'List not found',
            'code' => 404
        ];
        $this->plan = TableRegistry::get('Plans');
        $result = $this->plan->find()->where(['status'=>'active'])->toArray();
        if(!empty($result)) {
            $response = [
                'status' => true,
                'message' => 'List found',
                'data' => $result,
                'code' => 200
            ];
        }
        $this->response($response);
    }

    public function planpurchess() {
        $response = [
            'status' => false,
            'message' => 'payment not saved',
            'code' => 404
        ];
        $postData = $this->request->getData();
        if(!empty($postData)) {
            $this->userPlans = TableRegistry::get('userPlans');
            $userPlans = $this->userPlans->newEntity();
            $userPlans->user_id = $this->Auth->user('id');
            $userPlans->plan_id = $postData['plan_id'];
            $userPlans->amount = $postData['amount'];
            $userPlans->no_of_coin = $postData['no_of_coin'];
            $userPlans->status = 'active';
            $userPlans->created = date('Y-m-d H:i:s');
            if($this->userPlans->save($userPlans)) {
                $response = [
                    'status' => true,
                    'message' => 'Payment done',
                    'code' => 200,
                    'data' => $userPlans
                ];      
            }
        }
        $this->response($response);
    }

    public function sendgift() {
        $response = [
            'status' => false,
            'message' => 'gift not send',
            'code' => 404
        ];
        $postData = $this->request->getData();
        if(!empty($postData)) {
            $this->userGifts = TableRegistry::get('userGifts');
            $userGifts = $this->userGifts->newEntity();
            $userGifts->user_from = $this->Auth->user('id');
            $userGifts->user_to = $postData['user_id'];
            $userGifts->gift_id = $postData['gift_id'];
            $userGifts->coin = $postData['coin'];
            $userGifts->status = 'active';
            if($this->userGifts->save($userGifts)) {
                $response = [
                    'status' => true,
                    'message' => 'gift sent',
                    'code' => 200,
                    'data' => $userGifts
                ];      
            }
        }
        $this->response($response);
    }

    public function couponList()
    {
        $response = [
            'status' => false,
            'message' => 'List not found',
            'code' => 404
        ];
        $this->coupons = TableRegistry::get('coupons');
        $coupons = $this->coupons->find()->where(['status'=>'active'])->toArray();
        if(!empty($coupons)) {
            $response = [
                'status' => true,
                'message' => 'List found',
                'code' => 200,
                'data' => $coupons
            ];
        }
        $this->response($response);
    }

    public function createroom() {
        $response = [
            'status' => false,
            'message' => 'Chat room not created',
            'code' => 404
        ];
        $registration_ids = '';
        $postData = $this->request->getData();
        if(!empty($postData)) {
            $users = $this->Users->find()->select(['fcm_Token'])->where([
            'id' => $postData['user_id'] , 'fcm_Token !='=>'','status'=>'1'])->hydrate(false)->toArray();
            if(!empty($users)) {
                foreach ($users as $key => $value) {
                    $registration_ids = $value['fcm_Token'];
                    if($key>0){
                        $registration_ids .= ','.$value['fcm_Token'];
                    }
                }
            }
            if(!empty($registration_ids)) {
                require_once "src/RtmTokenBuilder.php";
                $appID = "393bfd2cbde84eab968cff81028bd794";
                $appCertificate = "db997ba5c40d4894942627aea949f2e7";
                $channelName = "justu".rand(1000,100000000);
                $uid = 2882341273;
                $uidStr = "2882341273";
                $role = 0;
                $expireTimeInSeconds = 3600;
                $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
                $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
                
                $token = \RtmTokenBuilder::buildToken($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
                $title = ucfirst($this->Auth->user('first_name')).' call you';
                $message = 'Lorem ipsum 123';
                $fields = array
                (
                    'total_coin' => $this->totalCoin($postData['user_id']),
                    'registration_ids'  => [$registration_ids],
                    'body' => $message,
                    'title' => $title,
                    'token' => $token,
                    'username' => $this->Auth->user('first_name'),
                    'channelName' => $channelName,
                    'type' => isset($postData['type'])?$postData['type']:'audio',
                    'profilePhoto' =>  !empty($this->Auth->user('profile_photo')) ? Router::url('/', true).str_replace('webroot/','',$this->Auth->user('photo_dir')).$this->Auth->user('profile_photo') : Router::url('/', true).'img/user.png'
                );
                // print_r($fields); die;
                $result = $this->sendPushNotification($fields);
            
                if(json_decode($result)->success) {
                    $response = [
                        'status' => true,
                        'message' => 'Chat room created',
                        'code' => 200,
                        'token' => $result,
                        'data' => $fields
                    ];
                } else {
                    $response = [
                        'status' => false,
                        'message' => 'Chat room not created',
                        'code' => 404,
                        'data' => $fields
                    ];
                }
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Device id not found',
                    'code' => 404
                ];
            }
        }
        
        $this->response($response);
    }

    public function audiocall() {
        $response = [
            'status' => false,
            'message' => 'Data Not found',
            'code' => 404
        ];
        $postData = $this->request->getData();
        if(!empty($postData)) {
            $response = [
                'status' => true,
                'message' => 'Data found',
                'code' => 200,
                'data' => $postData
            ];  
        }

        $this->response($response);
    }

    public function createbroadcast()
    {
        $this->Broadcasts = TableRegistry::get('Broadcasts');
        $response = [
            'status' => false,
            'message' => 'Broadcast not start',
            'code' => 404
        ]; 
        require_once "src/RtmTokenBuilder.php";
        $appID = Configure::read('APPID');
        $appCertificate = Configure::read('APPCertificate');
        $channelName = "broad".rand(1000,100000000);
        $uid = 2882341273;
        $uidStr = "2882341273";
        $role = 0;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
        
        $token = \RtmTokenBuilder::buildToken($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
        if(!empty($token)) {
            $broadcasts = $this->Broadcasts->newEntity();
            $broadcasts->user_id = $this->Auth->user('id');
            $broadcasts->type = 'video';
            $broadcasts->channel_name = $channelName;
            $broadcasts->token = $token;
            $broadcasts->status = 'active';
            if ($this->Broadcasts->save($broadcasts)) {
                $response = [
                    'status' => true,
                    'message' => 'Broadcast started',
                    'code' => 200,
                    'data' => [
                        'token' => $token,
                        'channelName' => $channelName
                    ]
                ];
            }
            
        }
        $this->response($response);
    }

    public function listingbroadcast() 
    {
        $response = [
            'status' => false,
            'message' => 'Broadcast List not found',
            'code' => 404
        ];
        $this->Broadcasts = TableRegistry::get('Broadcasts');
        $result =  $this->Broadcasts->find()
                        ->contain(['Users'=>function($q) {
                            return $q->select([
                                    'first_name'=>'first_name',
                                    'last_name'=>'last_name',
                                    'profile_photo'=>'profile_photo',
                                    'photo_dir' => 'photo_dir'
                                ]);
                        }])
                        ->where(['Broadcasts.status' => 'active'])->toArray();
        if(!empty($result)) {
            foreach ($result as $key => $value) {
                $result[$key]['profile_photo'] = !empty($value['profile_photo']) ? Router::url('/', true).str_replace('webroot/','',$value['photo_dir']).$value['profile_photo'] : Router::url('/', true).'img/user.png';
            }
            $response = [
                'status' => true,
                'message' => 'Broadcast List found',
                'code' => 200,
                'data' => $result
            ];  
        }
        $this->response($response);
    }

    public function joinbroadcast() {
        $response = [
            'status' => false,
            'message' => 'Broadcast not join',
            'code' => 404
        ];
        $this->BroadcastJoins = TableRegistry::get('BroadcastJoins');
        if(!empty($this->request->getData())) {

            $postData = $this->request->getData();
            $query = $this->BroadcastJoins->query();
            $datainsert = $query->insert(['broadcast_id','user_id','status'])
                ->values([
                    'broadcast_id' => $postData['broadcast_id'],
                    'user_id' => $this->Auth->user('id'),
                    'status' => $postData['status']
                ])
                ->execute();
            if($datainsert->rowCount()) {
                $response = [
                    'status' => true,
                    'message' => 'Broadcast joined',
                    'code' => 200,
                    'data' => [
                        'broadcast_id' => $postData['broadcast_id'],
                        'user_id' => $this->Auth->user('id'),
                        'status' => $postData['status']
                    ]
                ];
            }
        }
        $this->response($response);   
    }

    public function followfollwing()
    {
        $this->Followers = TableRegistry::get('Followers');

        $response = [
            'status' => true,
            'message' => 'Data found',
            'code' => 200,
            'data' => [
                'following' => $this->Followers->find()->where(['follow_from' => $this->Auth->user('id')])->count(),
                'followers' => $this->Followers->find()->where(['follow_to' => $this->Auth->user('id')])->count()
            ]
        ];
        $this->response($response);   
    }

    public function savechat() 
    {
        $response = [
            'status' => false,
            'message' => 'Chat not save',
            'code' => 404
        ];

        if(!empty($this->request->getData())) {
            $postData = $this->request->getData();
            $_dir = 'webroot' . DS . 'img' . DS . 'uploads' . DS . 'chats' . DS . 'images' . DS;
                
            if(!empty($_FILES)) {
                $fileName =  time().str_replace(' ','_', $_FILES['message']['name']);
                if (!file_exists($_dir)) {
                    mkdir($_dir, 0777, true);
                }
                move_uploaded_file($_FILES['message']['tmp_name'],$_dir.$fileName);
                $postData['message'] = $fileName;
                $postData['type'] = 'image'; 
            } else {
                $postData['type'] = 'text';
            }

            $this->Chats = TableRegistry::get('Chats');
            $obj = $this->Chats->newEntity();
            $obj->chat_to = $this->Auth->user('id');
            $obj->type = $postData['type'];
            $obj->chat_from = $postData['user_id'];
            $obj->message = $postData['message'];
            $obj->is_read = '0';
            $obj->status = '1';
            if($this->Chats->save($obj)) {
                $obj->path = Router::url('/', true).$_dir;
                $response = [
                    'status' => true,
                    'message' => 'Chat saved',
                    'code' => 200,
                    'data' => $obj
                ];
            }
        }
        $this->response($response);
    }

    public function chatList() 
    {
        $response = [
            'status' => false,
            'message' => 'Chat list not found',
            'code' => 404
        ];
        $this->Chats = TableRegistry::get('Chats');
        $chatList = $this->Chats->find()
                    ->where(['chat_to'=>$this->Auth->user('id')])
                    ->orWhere(['chat_from'=>$this->Auth->user('id')])
                    ->contain(['users'  => function($q) {
                        return $q->select(['first_name'=>'first_name','last_name'=>'last_name','email'=>'email','profile_photo'=>'profile_photo','photo_dir'=>'photo_dir']);
                    }])
                    ->group(['chat_from'])
                    ->order(['Chats.id'=>'desc'])
                    ->hydrate(false)->toArray();
        // print_r($chatList);die;
        if(!empty($chatList)) {
            foreach ($chatList as $key => $value) {
                $chatList[$key]['profile_photo'] = !empty($value['profile_photo']) ? Router::url('/', true).$value['photo_dir'].$value['profile_photo']: Router::url('/', true).'img/user.png';
            }
            $response = [
                'status' => true,
                'message' => 'Chat list found',
                'code' => 200,
                'data' => $chatList
            ];            
        }
        $this->response($response);
    }

    public function logout() 
    {
        $this->Auth->logout();
        $this->request->session()->destroy();
        echo "string"; die;
    }

    public function token($user_id = '') 
    {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }
        return json_encode([
            // 'success' => true,
                'token' => JWT::encode([
                    'sub' => !empty($user_id) ? $user_id : $user['id'],
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

    function sendPushNotification($fields = array())
    {
        $response = [
            'status' => false,
            'message' => 'Push notification not send',
            'code' => 404
        ];
        $title = 'Whatever';
        $message = 'Lorem ipsum';
            
        if(empty($fields)) {
            $fields = array
            (
                'registration_ids'  =>['fYXUky_ZQEOv_Sa8gq5h3a:APA91bGOrXXR9Y1pv108K9UEdF9JLpBOdpYC_spRWttr4oP0dAEYJtu4jfZa_WNw28H-_18iBXIU7B2jdTPoTd0Iudh5QViuaiBXVgy4G02_Ep4MR1sLdfYPmK2nMUaEo8JN1tB4eqx4'],
                // 'data'          => '',
                'priority' => 'high',
                'notification' => array(
                    'body' => $message,
                    'title' => $title,
                    'sound' => 'default',
                    'icon' => 'icon'
                )
            );
        } else {
            //chanel name, user name , profile photo, type print_r($fields['registration_ids']); die;
            $fields = array
            (
                'registration_ids'  =>  $fields['registration_ids'],  //['fYXUky_ZQEOv_Sa8gq5h3a:APA91bGOrXXR9Y1pv108K9UEdF9JLpBOdpYC_spRWttr4oP0dAEYJtu4jfZa_WNw28H-_18iBXIU7B2jdTPoTd0Iudh5QViuaiBXVgy4G02_Ep4MR1sLdfYPmK2nMUaEo8JN1tB4eqx4'],
                'data'          => array(
                                        'username'=>$fields['username'],
                                        'token' => $fields['token'],
                                        'profilePhoto' => '',
                                        'channelName'  => $fields['channelName'],
                                        'type' => $fields['type'],
                                        'profilePhoto' => $fields['profilePhoto']
                                    ),
                'priority' => 'high',
                'notification' => array(
                    'body' => $fields['body'],
                    'title' => $fields['title'],
                    'sound' => 'default',
                    'icon' => 'icon'
                )
            );
        }

        // print_r($fields); die;
        $API_ACCESS_KEY = 'AAAAwtC853k:APA91bG1CLVNvSJbz9xtfN-N27RXW4UT-T-3ZiRJ7XS-vUIT_Jf1NRTGkyj2UauneXrfzrFWqQL5Dp-ET-SeQuqdpfJfR2Dv5-vXWsSan1uF4G1fRnPFcIcGnjICvOod_VwxnILRwkZz';
        $headers = array
        (
            'Authorization: key=' . $API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        // print_r($result); die;
        // $response = [
        //     'status' => true,
        //     'message' => 'Push notification sent',
        //     'data' => $result,
        //     'code' => 200
        // ];
        curl_close( $ch );
        return $result;
        // $this->response($response);
    }

    

    // sendPushNotification($fields);

}
