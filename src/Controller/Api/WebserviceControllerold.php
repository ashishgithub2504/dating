<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Core\Configure;
use CatalogManager\Model\Entity\Product;

class WebserviceController extends AppController {

    public function initialize() {
        parent::initialize();
        
        $this->RequestHandler->renderAs($this, 'json');
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
            $category[$key]['name'] = $val['title'];
            $category[$key]['slug'] = $val['slug'];
            if(!empty($val['products'])) {
                foreach($val['products'] as $k => $v) {
                    $category[$key]['products'][$k]['title'] = $v['title'];
                    $category[$key]['products'][$k]['slug'] = $v['slug'];
                }
            }
        }
        
        $response = [
            'status' => true,
            'message' => 'List found',
            'code' => 200,
            'data' => [
                        'categories'=> $category
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
            $this->request->data = $this->request->data['detail'];
            $user = $this->Auth->identify();

            if ($user) {
                if ($user['is_verified'] != 1) {
                    $response['message'] = 'Your account is not verified. Please check your email and verify them.';
                } else if ($user['status'] != 1) {
                    $response['message'] = 'Your account has been deactivated. Please contact ' . $this->ConfigSettings['SYSTEM_APPLICATION_NAME'] . ' Support for assistance';
                } else {
                    $this->Auth->setUser($user);
                    $response = [
                        'status' => true,
                        'code' => 400,
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

        $this->request->data = $this->request->getData('detail');
        $this->request->data['login_count'] = 0;
        $this->request->data['is_verified'] = 0;
        $this->request->data['status'] = 0;
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
                    // ->select([
                    // 'full_name' => "CONCAT(Products.title, ' ', Products.slug)",
                    // 'id','title','slug','model','price','quantity','minimum_quantity','stock_status_id','short_description',
                    //     'description',
                    //     'image',
                    //     'bestselling',
                    //     'enquirystatus',
                    //     'title'
                    // ]);
                    
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
        // echo '<pre>';
        // print_r($products); die;
        
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
                        $list[$key]['images'] = [
                            'assets/images/products/product-2.jpg',
                            'assets/images/products/product-2-1.jpg',
                        ];
                    }
                    $list[$key]['badges'] = 'new';
                    $list[$key]['rating'] = 4;
                    $list[$key]['reviews'] = 12;
                    $list[$key]['availability'] = ($value['stock_status_id'] == '1') ? 'in-stock':'Out Of Stock';
                    $list[$key]['brand'] = 'brandix';
                    $list[$key]['categories'] = [];
                    $list[$key]['attributes'] = [
                        ['slug'=> 'color', 'values'=> ['silver', 'cerise']],
                        ['slug'=> 'speed','values'=> '750-rpm','featured'=> true],
                        ['slug'=> 'power-source','values'=> 'cordless-electric','featured'=> true],
                        ['slug'=> 'battery-cell-type','values'=> 'lithium','featured'=> true],
                        ['slug'=> 'voltage','values'=> '20-volts','featured'=> true],
                    ];
                }
                $response = [
                        'status'=>true,
                        'code' => 200 ,
                        'message'=>'List Found',
                        'data' => $list
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
    
}
