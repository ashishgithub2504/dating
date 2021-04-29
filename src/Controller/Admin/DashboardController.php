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
        $sdate = new \DateTime('last saturday');
        $edate = new \DateTime();

        $userLastCount = TableRegistry::getTableLocator()->get('users')
                ->find()
                ->where(function ($exp, $q) use ($sdate, $edate) {
                    return $exp->between('created', $sdate, $edate);
                })->count();

        $query = TableRegistry::getTableLocator()->get('user_plans')
                ->find();
        $userPlanSum = $query->select([
                    'sumcoin' => $query->func()->sum('amount')
                ])
                ->where(['status' => 'active'])
                ->hydrate(false)
                ->first();

         $userPlanLastWeek = TableRegistry::getTableLocator()->get('user_plans')
                ->find()
                ->select(['created','sumcoin' => $query->func()->sum('amount')])
                ->where(function ($exp, $q) use ($sdate, $edate) {
                    return $exp->between('created', $sdate, $edate);
                })
                ->group(['DAY(created)'])
                ->order('created')
                ->hydrate(false)
                ->toArray();
        // echo '<pre>';
        // print_r($userPlanLastWeek); die;
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
        $this->set(compact("users","inquiryCount","productList","userLastCount","userPlanSum","userPlanLastWeek"));
    }

}
