<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Core\Configure;
use CatalogManager\Model\Entity\Product;
use Cake\Utility\Text;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Http\ServerRequest;
use Cake\I18n\Time;

class WebserviceController extends AppController {

    public function initialize() {
        parent::initialize();
        
        $this->RequestHandler->renderAs($this, 'json');        
        $this->Users = TableRegistry::get('UserManager.Users');
        $this->Products = TableRegistry::get('CatalogManager.Products');
        $this->Category = TableRegistry::get('CategoryManager.Categories');
        
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        
        $products = $this->Products->find('all',[
            'conditions' => ['status' => 1,'bestselling' => '1'],
            'fields' => [
                'full_name' => "CONCAT(title, ' ', slug)",
                "link" => "status",    
                'id',
                'title',
                'slug',
                'model',
                'price',
                'quantity',
                'minimum_quantity',
                'stock_status_id',
                'short_description',
                'description',
                'image',
                'bestselling',
                'enquirystatus',
            ]],['order' => ['sort_order','desc']]
        )
        ->toArray();
    
        $latest_products = $this->Products->find('all',[
            'conditions' => ['status' => 1],
            'fields' => [
            'full_name' => "CONCAT(title, ' ', slug)",
            "link" => "status",
            'id',
            'title',
            'slug',
            'model',
            'price',
            'quantity',
            'minimum_quantity',
            'stock_status_id',
            'short_description',
            'description',
            'image',
            'enquirystatus',

        ]],['order' => ['id','desc']])->toArray();
        // print_r($products); die;
        $banners = TableRegistry::get('BannerManager.Banners')->find()
                    ->contain(['BannerImages'=> function($q) {
                        return $q->select(['external_link','description',
                                'image','title','banner_id'
                            ]);
                    }])
                    ->where(['id' => '1', 'status' => '1'])->first();
        foreach ($banners['banner_images'] as $key => $value) {
            $banners['banner_images'][$key] = [
                'title' => $value['title'],
                'text' => $value['description'],
                'image_classic' => Router::url('/timthumb.php?src=',true).Router::url('/img/', true).$value['image'].'&w=840&h=430',
                'image_full' => Router::url('/timthumb.php?src=',true).Router::url('/img/', true).$value['image'].'&w=840&h=430',
                'image_mobile' => Router::url('/timthumb.php?src=',true).Router::url('/img/', true).$value['image'].'&w=510&h=390',
                'external_link' => $value['external_link'],
            ];
        }
        // print_r($banners); die;
        $footer = [
            'sec1' => [
                'logo' => Configure::read('Setting.MAIN_LOGO'),
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna',
            ],
            'sec2' => [
                'text' => 'Menu',

            ]
            
        ];

        $response = [
            'status' => true,
            'message' => 'List found',
            'code' => 200,
            'data' => [
                        'logo' => Router::url('/img/', true).Configure::read('Setting.MAIN_LOGO'),
                        'products' => $products,
                        'latest_products' => $latest_products,
                        'banner_images' => $banners['banner_images'],
                        'footer' => $footer,
                        'timthumb_path' => Router::url('/timthumb.php?src=',true),
                        'full_path' => Router::url('/img/', true),
                        'product_path' => Router::url('/webroot/img/uploads/products/', true)
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
            // print_r($user); die;
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
            $response = ['status'=>true,'code' => 200 ,'message'=>'You have successfully registred','data' => $user];
        }else{
             $response['data'] = $user->errors();
        }
        $this->response($response);
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

    public function getproducts() {
        $response = ['status'=>false,'code' => 404 ,'message'=>'No Product Found'];
        $article = new Product();
        
        $query = $this->Products->find()
                ->where(['Products.status' => 1]);
                    
        if(!empty($this->request->query)) {
            $query->limit($this->request->query('limit'));
            $query->order(['Products.created' => 'desc']);
        }
        if(!empty($this->request->data) && !empty($this->request->data['path'])) {
            $query->matching('Categories',function($q){
                return $q->where(['Categories.slug' => $this->request->data['path']]);
            }); 
        } else {
            $query->contain(['Categories','ProductImages']);
        }
        if(!empty($this->request->query('is_featured'))) {
            $query->andWhere(['is_featured' => '1']);
        }
        if(!empty($this->request->query('bestselling'))) {
            $query->andWhere(['bestselling' => '1']);
        }
        if(!empty($this->request->query('category'))) {
            $query->matching('Categories',function($q){
                return $q->where(['Categories.slug' => $this->request->query('category')]);
            });
        }
        $products = $query->hydrate(false)->toArray();
        
        $list = [];
        if(!empty($products)){
                foreach ($products as $key => $value) {
                    $list[$key]['id'] = $value['id'];
                    $list[$key]['name'] = $value['title'];
                    $list[$key]['slug'] = $value['slug'];
                    $list[$key]['price'] = $value['price'];
                    $list[$key]['images'][] = Router::url('/timthumb.php?src=',true).Router::url('/webroot/img/uploads/products/', true).$value['image'].'&w=700&h=700';
                    if(!empty($value['product_images'])) {
                        foreach ($value['product_images'] as $k => $val) {
                            $list[$key]['images'][] = Router::url('/timthumb.php?src=',true).Router::url('/webroot/img/uploads/products/', true).$val['image'].'&w=700&h=700';    
                        }                        
                    } else {
                        $list[$key]['images'] = [];
                    }
                    $list[$key]['compareAtPrice'] = null;
                    $list[$key]['badges'] = ['new'];
                    $list[$key]['rating'] = 4;
                    $list[$key]['reviews'] = 12;
                    $list[$key]['availability'] = ($value['stock_status_id'] == '1') ? 'in-stock':'Out Of Stock';
                    $list[$key]['brand'] = 'jenix';
                    if(!empty($value['categories'])) {
                        foreach($value['categories'] as $kk=>$vv) {
                            $list[$key]['categories'][] = $vv['title'];
                        }
                    }
                    // $list[$key]['categories'] = [];
                    $list[$key]['attributes'] = [];
                }      
        }
        
        $response = [
            'status'=>true,
            'code' => 200 ,
            'message'=>'List Found',
            'data' => $list
        ];
        $this->response($response);
    }

    public function getproductlist() {
        $response = ['status'=>false,'code' => 404 ,'message'=>'No Product Found'];
        $article = new Product();
        
        $query = $this->Products->find()
                ->where(['Products.status' => 1]);
                    
        if(!empty($this->request->query)) {
            $query->limit($this->request->query('limit'));
        }
        if(!empty($this->request->data) && !empty($this->request->data['path'])) {

            $query->matching('Categories',function($q){
                return $q->where(['Categories.slug' => $this->request->data['path']]);
            }); 
        }else {
            $query->contain(['Categories','ProductImages']);
        }
        $products = $query->hydrate(false)->toArray();
        
        $categorylist = $this->Category->find()
                        ->where(['parent_id' => '0'])
                        ->contain(['ProductsCategories'])
                        ->toArray();
        
        foreach($categorylist as $key=>$val) {
           $catList[] =  [
                'category' => [
                    'childern' => null,
                    'customFields' => [],
                    'id' => $val['id'],
                    'image' => null,
                    'items' => count($val['products_categories']),
                    'name' => $val['title'],
                    'parents' => null,
                    'path' => $val['slug'],
                    'slug' => $val['slug'],
                    'type' => 'shop'
                ],
                'type' => 'child',
                'name' => $val['title'],
                'slug' => $val['slug'],
                'count' => count($val['products_categories'])
            ];
        }

        if(!empty($products)){
                $list = [];
                foreach ($products as $key => $value) {
                    $list[$key]['id'] = $value['id'];
                    $list[$key]['name'] = $value['title'];
                    $list[$key]['slug'] = $value['slug'];
                    $list[$key]['price'] = $value['price'];
                    $list[$key]['images'][] = Router::url('/timthumb.php?src=',true).Router::url('/webroot/img/uploads/products/', true).$value['image'].'&w=700&h=700';
                    if(!empty($value['product_images'])) {
                        foreach ($value['product_images'] as $k => $val) {
                            $list[$key]['images'][] = Router::url('/timthumb.php?src=',true).Router::url('/webroot/img/uploads/products/', true).$val['image'].'&w=700&h=700';    
                        }                        
                    } else {
                        $list[$key]['images'] = [];
                    }
                    $list[$key]['compareAtPrice'] = null;
                    $list[$key]['badges'] = ['new'];
                    $list[$key]['rating'] = 4;
                    $list[$key]['reviews'] = 12;
                    $list[$key]['availability'] = ($value['stock_status_id'] == '1') ? 'in-stock':'Out Of Stock';
                    $list[$key]['brand'] = 'jenix';
                    
                    $list[$key]['attributes'] = [];
                }
                $response = [
                        'status'=>true,
                        'code' => 200 ,
                        'message'=>'List Found',
                        'data' => [
                            'filterValues' => [],
                            'filters' => [
                                [
                                    'name' => 'Categories',
                                    'root' => true,
                                    'slug' => 'categories',
                                    'type' => 'categories',
                                    'items' => $catList
                                ],
                                [
                                    'name' =>'Price',
                                    'slug' =>'price',
                                    'type' => 'range',
                                    'min' => 0,
                                    'max' => 2000,
                                    'value' => [
                                        '0',
                                        '2000'
                                        ]   
                                ],
                                // [
                                //     'name' => 'Brand',
                                //     'slug' =>'brand',
                                //     'type' => 'check',
                                //     'value' => [],
                                //     'items' => [
                                //         [
                                //             'count' => 1,
                                //             'name'=> 'Brandix',
                                //             'slug' => 'brandix'
                                //         ],
                                //         [
                                //             'count' => 4,
                                //             'name' => 'Zosch',
                                //             'slug' => 'zosch'
                                //         ]
                                //     ]
                                // ]
                            ],
                            'form' => 1,
                            'items' => $list,
                            'limit' => 12,
                            'page' => 1,
                            'pages' => round(count($list)/12),
                            'sort' => 'default',
                            'to' => 1,
                            'total' => count($list)
                        ]
                    ];
        }
        $this->response($response);
    }

    public function productdetails() {
        $response = ['status'=>false,'code' => 404 ,'message'=>'List Not Found'];
        $detail = $this->Products->find()
        ->select([
            'full_name' => "CONCAT(title, ' ', slug)",
               // "link" => "status",
                //"timthumb" => "status",
                // 'linkwrite' => $article->get('full_name'),
                'id',
                'name' => 'title',
                'slug',
                'model',
                'price',
                'quantity',
                'minimum_quantity',
                'stock_status_id',
                'short_description',
                'description',
                'images' => 'image',
                'bestselling',
                'enquirystatus',
                'status',
        ])
        ->where([
            'slug' => $this->request->query('slug'), //$this->request->data['slug'],
            'status' => 1
        ])->first();
        // print_r($detail); die;
        if(!empty($detail)){
                $response = [
                        'status'=>true,
                        'code' => 200 ,
                        'message'=>'List Found',
                        'data' => [
                            'id' => $detail['id'],
                            'name' => $detail['name'],
                            'slug'=> $detail['slug'],
                            'price'=> $detail['price'],
                            'model' => $detail['model'],
                            'description' => $detail['description'],
                            'short_description' => $detail['short_description'],
                            'compareAtPrice'=> null,
                            'images'=> [$detail['images']],
                            'badges'=> '',
                            'rating'=> '4',
                            'reviews'=> '20',
                            'availability'=> 'in-stock',
                            'brand'=> $detail['model'],
                            'categories' => [],
                            'attributes' => [],
                            'customFields'=> [],
                        ]
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
}
