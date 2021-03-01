<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class DashboardController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $inquiryCount = [];
        // TableRegistry::getTableLocator()->get('inquiries')
        //                     ->find()
        //                     ->count();
        
        $productList = []; 
        // TableRegistry::getTableLocator()->get('products')
        //                     ->find()
        //                     ->select(['id','title','image','price','short_description'])
        //                     ->where(['status'=>'1'])
        //                     ->limit(5)
        //                     ->order(['id'=>'desc'])
        //                     ->hydrate(false)
        //                     ->toArray();
        $users = [];
        $this->set(compact("users","inquiryCount","productList"));
    }

}
