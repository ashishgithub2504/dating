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

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenDate;
use Cake\Routing\Router;
use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        FrozenDate::setToStringFormat('yyyy-MM-dd'); // For any mutable Date
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        
        switch ($this->request->getParam('prefix')) {
            case 'api':
            $this->loadComponent('Auth', [
                    'storage' => 'Memory',
                    'authenticate' => [
                        'Form' => [
                            //'userModel' => 'AdminUserManager.AdminUsers', // Added This
                            // 'finder' => 'auth',
                            'fields' => [
                                'username' => 'username',
                                'password' => 'password'
                            ]
                        ],
                         'ADmad/JwtAuth.Jwt' => [
                            'parameter' => 'token',
                            'userModel' => 'Users',
                            'scope' => ['Users.status' => 1],
                            'fields' => [
                                'username' => 'id'
                            ],
                            'queryDatasource' => true
                        ]
                    ],
                    'unauthorizedRedirect' => true,
                    'checkAuthIn' => 'Controller.initialize',
                    'loginAction' => [
                        'controller' => 'admin_users',
                        'action' => 'login',
                        'prefix' => 'admin',
                        "plugin" => false
                    ],
                    'loginRedirect' => [
                        'controller' => 'dashboard',
                        'action' => 'index',
                        'prefix' => 'admin',
                        "plugin" => false
                    ],
                    'logoutRedirect' => [
                        'controller' => 'admin_users',
                        'action' => 'login',
                        'prefix' => 'admin',
                        "plugin" => false
                    ],
                    'authError' => 'Your session is expired',
                    // 'storage' => [
                    //     'className' => 'Session',
                    //     'key' => 'Auth.Admin',
                    // ],
                ]);
                $this->Auth->allow(['signup','productdetails','createorder' ,'forgot', 'login', 'passwordreset', 'verifyaccount','index','staticpage','getcategories','getproducts','enquiry','getnavigation','completeorder','token']);
                //$this->viewBuilder()->setTheme('PriorityTheme');
                break;
            case 'admin':
                $this->loadComponent('Auth', [
                    'authenticate' => [
                        'Form' => [
                            'userModel' => 'AdminUserManager.AdminUsers', // Added This
                            'finder' => 'auth',
                            'fields' => [
                                'username' => 'email',
                                'password' => 'password'
                            ]
                        ]
                    ],
                    'loginAction' => [
                        'controller' => 'admin_users',
                        'action' => 'login',
                        'prefix' => 'admin',
                        "plugin" => 'AdminUserManager'
                    ],
                    'loginRedirect' => [
                        'controller' => 'dashboard',
                        'action' => 'index',
                        'prefix' => 'admin',
                        "plugin" => false
                    ],
                    'logoutRedirect' => [
                        'controller' => 'admin_users',
                        'action' => 'login',
                        'prefix' => 'admin',
                        "plugin" => 'AdminUserManager'
                    ],
                    'authError' => 'Your session is expired',
                    'storage' => [
                        'className' => 'Session',
                        'key' => 'Auth.Admin',
                    ],
                ]);
                $this->Auth->allow(['signup', 'forgot', 'login', 'passwordreset', 'verifyaccount']);
                //$this->viewBuilder()->setTheme('PriorityTheme');
                break;
            default :
                $this->loadComponent('Auth', [
                    'authenticate' => [
                        'Form' => [
                            //'userModel' => 'AdminUserManager.AdminUsers', // Added This
                            //'finder' => 'auth',
                            'fields' => [
                                'username' => 'email',
                                'password' => 'password'
                            ]
                        ]
                    ],
                    'loginAction' => [
                        'controller' => 'admin_users',
                        'action' => 'login',
                        'prefix' => 'admin',
                        "plugin" => false
                    ],
                    'loginRedirect' => [
                        'controller' => 'dashboard',
                        'action' => 'index',
                        'prefix' => 'admin',
                        "plugin" => false
                    ],
                    'logoutRedirect' => [
                        'controller' => 'admin_users',
                        'action' => 'login',
                        'prefix' => 'admin',
                        "plugin" => false
                    ],
                    'authError' => 'Your session is expired',
                    'storage' => [
                        'className' => 'Session',
                        'key' => 'Auth.Admin',
                    ],
                ]);
                $this->Auth->allow(['signup', 'forgot', 'login', 'passwordreset', 'verifyaccount','index','staticpage','getcategories','getproducts']);
                break;
        }
        
    }
    
    public function beforeFilter(Event $event)
    {
        
        $this->ConfigSettings = Configure::read('Setting');
        if($this->request->getSession()->read('Auth.Admin')){
            //EventManager::instance()->on(new RequestMetadata($this->request, ['id' => $this->Auth->user('id')]));
        }
    }

    public function beforeRender(Event $event)
    {
        $ConfigSettings = Configure::read('Setting');
        $prefix = $this->request->getParam('prefix');
        // $productCount = TableRegistry::getTableLocator()->get('products')
        //                     ->find()
        //                     ->where(['status' => '1'])->count();
            
        if ($prefix == "admin") {
            $userCount = TableRegistry::getTableLocator()->get('users')
                            ->find()
                            ->where(['status' => '1'])->count();
            $this->set(['authData' => $this->request->getSession()->read('Auth.Admin'), 'ConfigSettings' => $ConfigSettings,
                'productCount' => '0',
                'userCount' => $userCount
            ]);
        } else if ($prefix == "api" || $prefix == "") {

            $metaData = [];
            if ((strtolower($this->request->getParam('plugin')) != "cmsmanager")) {

                $modules = TableRegistry::getTableLocator()->get('CmsManager.Modules');

                $metaObj = $modules->find('metas', $this->request->getAttribute('params'))->cache('metaData');
                if (!$metaObj->isEmpty()) {
                    $metas = $metaObj->first();
                    $metaData = [
                        'meta_title' => $metas->meta_title,
                        'meta_keyword' => $metas->meta_keyword,
                        'meta_description' => $metas->meta_description
                    ];
                }
            }
            if ($prefix == "api") {
                $this->metaData = $metaData;
            } else {
                $this->set([
                    'metaData' => $metaData,
                    'ConfigSettings' => $ConfigSettings,
                    'productCount' => '0',
                ]);
            }
        }
    }

    public function response($response = []){ 
        $this->set([
            'response' => $response,
            '_serialize' => 'response',
        ]);
    }

}
