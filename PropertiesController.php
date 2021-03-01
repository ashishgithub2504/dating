<?php

namespace App\Controller\Admin;
date_default_timezone_set("Asia/Jerusalem");
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;

/**
 * Properties Controller
 *
 * @property \App\Model\Table\PropertiesTable $Properties
 */
class PropertiesController extends AppController {

    function initialize() {
       
        $this->PropertyUpdates = TableRegistry::get('PropertyUpdates');
        $this->PropertyFavourites = TableRegistry::get('property_favourites');
        $this->PropertySignatures = TableRegistry::get('property_signatures');
        $this->PropertyProposals = TableRegistry::get('property_proposals');
        $this->PropertyAuctions = TableRegistry::get('property_auctions');
        $this->PropertyViews = TableRegistry::get('property_views');
        $this->PropertyTypes = TableRegistry::get('propertytypes');
        //echo $page = isset($_GET['page'])?$_GET['page']:'1'; 
        parent::initialize();
        $page = isset($_GET['page'])?($_GET['page']-1):'0';
        $filter = isset($_GET['handling'])?'1':'0';
        $sort = isset($_GET['sort'])?'1':'0';
        $paginate = $page*$this->SettingConfig['admin_paging_limit'];
        $this->set(compact('paginate','page','filter','sort'));
       // $this->request->session()->write('lang', 'en_US');
         

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {


        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['is_read' => 'ASC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('2', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'), 'Properties.status' => '0', 'Properties.is_complete' => '1'];
        } else {
            $options['conditions'] = ['Properties.status' => '0','Properties.is_complete' => '1'];
        }
        if(isset($_GET['fromdate']) && $_GET['fromdate'] != '' && isset($_GET['todate']) && $_GET['todate'] != ''){
          $options['conditions'] = [
            'DATE(Properties.created) >=' => date('Y-m-d',strtotime($_GET['fromdate'])),
            'DATE(Properties.created) <=' => date('Y-m-d',strtotime($_GET['todate']))
                                  ];
        }
        if(isset($_GET['handling']) && $_GET['handling'] != ''){
          $options['conditions'] = ['handling' => $_GET['handling']];
        }
        if(isset($_GET['city']) && $_GET['city'] != ''){
          if(preg_match("/\p{Hebrew}/u", $_GET['city'])){
              $city = $_GET['city'];
              $connection = ConnectionManager::get('default');
              $cities =  $connection->execute("SELECT id,name FROM cities WHERE name = '$city'")->fetchAll('assoc');
              if(count($cities)>0){
                if(isset($cities[0])){
                    $options['conditions'] = ['Properties.city' => $cities[0]['id']];
                }
              }
          }else{
            $options['conditions'] = ['Properties.city' => $_GET['city']];
          }
        }
        $options['joins'] = ['table' => 'users','alias' => 'user','type' => 'INNER','conditions' => array(
          'user.id' =>'project.user_id')];
          if(isset($_GET['role']) && $_GET['role'] !=''){
            $options['contain'] = ['Users' => function($q) {
              return $q->select(['id', 'name', 'role_id'])->where(['role_id' => $_GET['role']]);
            }];
          }else{
            $options['contain'] = ['Users' => function($q) {
              return $q->select(['id', 'name', 'role_id']);
            }];
         }

        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }


     /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function pending() {

        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        // if (in_array($this->Auth->user('role_id'), array('5', '3', '4', '6'))) {
        //     $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'), 'Properties.status' => '0', 'Properties.is_complete' => '1'];
        // } else {
        //     $options['conditions'] = ['Properties.status' => '0', 'Properties.is_complete' => '1'];
        // }
        $options['conditions'] = ['Properties.status' => '0', 'Properties.is_complete' => '1'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users' => function($q) {
                return $q->select(['id', 'name', 'role_id']);
            }];
        //pr($options); die;
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();

        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function sale() {
        $this->paginate = [
            'contain' => []
        ];
        $options['conditions'] = [];
        $options['order'] = ['created' => 'DESC'];
       // $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['conditions'] = ['Properties.status' => '1','Properties.is_complete' => '1'];

     if (in_array($this->Auth->user('role_id'), array('2', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'), 'Properties.status' => '1'];
        } else {
            $options['conditions'] = ['Properties.status' => '1','Properties.is_complete' => '1'];
          //  $options['conditions'] = ['Properties.status' => '1'];
        }

        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];

        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
       // print_r($this->Properties);exit;
        $list = TableRegistry::get('roles')->find('list')->toArray();

        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function sold() {
        $this->paginate = [
            'contain' => []
        ];
        $options['order'] = ['sold_date' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('2', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'), 'Properties.status' => '3'];
        } else {
            $options['conditions'] = ['Properties.status' => '3','Properties.is_complete' => '1'];
        }

        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        //pr($options); die;
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($this->Auth->user('role_id')); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function inactive() {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['created' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('5', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'),'Properties.status' => '4'];
        }else{
            $options['conditions'] = ['Properties.status' => '4','Properties.is_complete' => '1'];
        }

        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        //pr($options); die;
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($this->Auth->user('role_id')); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function auction() {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['created' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('5', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'),'Properties.status' => '2'];
        }else{
            $options['conditions'] = ['Properties.status' => '2','Properties.is_complete' => '1'];
        }

        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        //pr($options); die;
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($this->Auth->user('role_id')); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function userPro($user_id = null) {

        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];

        $options['conditions'] = ['Properties.user_id' => $user_id];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($this->Auth->user('role_id')); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function buyer($user_id = null) {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];

        $options['conditions'] = ['Properties.buyer_id' => $user_id];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);

        $views = $this->PropertyViews->find()->where(['property_views.user_id' => $user_id])->group(['property_views.property_id'])->contain(['Properties'])->toArray();

        $favourites = $this->PropertyFavourites->find()->where(['property_favourites.user_id' => $user_id])->contain(['Properties'])->toArray();
        $signatures = $this->PropertySignatures->find()->where(['property_signatures.user_id' => $user_id])->contain(['Properties'])->toArray();
        $proposals = $this->PropertyProposals->find()->where(['property_proposals.user_id' => $user_id])->contain(['Properties'])->toArray();
        $auction = $this->PropertyAuctions->find()->where(['property_auctions.user_id' => $user_id])->contain(['Properties'])->toArray();

        $this->set(compact('properties', 'favourites', 'signatures', 'proposals','views'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function seller($user_id = null) {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['conditions'] = ['Properties.user_id' => $user_id,'Properties.status' => '0'];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties)->toArray();

        $options['conditions'] = ['Properties.user_id' => $user_id,'Properties.status' => '1'];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $propertiesonsale = $this->paginate($this->Properties)->toArray();


        $options['conditions'] = ['Properties.user_id' => $user_id,'Properties.status' => '2'];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $propertiesauction = $this->paginate($this->Properties)->toArray();


        $options['conditions'] = ['Properties.user_id' => $user_id,'Properties.status' => '3'];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $propertiessold = $this->paginate($this->Properties)->toArray();

        $options['conditions'] = ['Properties.user_id' => $user_id,'Properties.status' => '4'];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $propertiesinactive = $this->paginate($this->Properties)->toArray();


        $favourites = $this->PropertyFavourites->find()->where(['property_favourites.user_id' => $user_id])->contain(['Properties'])->toArray();
        $signatures = $this->PropertySignatures->find()->where(['property_signatures.user_id' => $user_id])->contain(['Properties'])->toArray();
        $proposals = $this->PropertyProposals->find()->where(['property_proposals.user_id' => $user_id])->contain(['Properties'])->toArray();


        $this->set(compact('properties', 'favourites', 'signatures', 'proposals','propertiesonsale','propertiesauction','propertiessold','propertiesinactive'));
        $this->set('_serialize', ['properties', 'list']);
    }

    function filterData(&$str) {

        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"'))
            $str = '"' . str_replace('"', '""', $str) . '"';
    }

    /**
     * View method
     *
     * @param string|null $id Property id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        // $lang = $this->request->session()->read('lang'); 
        // I18n::locale($lang); 
        $property = $this->Properties->get($id, [
            'contain' => ['PropertyImages', 'PropertyOwnerships', 'Users', 'PropertyOwners']
        ]);
		$this->Properties->updateAll(['is_read'=>'1'], ['id'=>$id]);
		$this->set('property', $property);
        $this->set('_serialize', ['property']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $property = $this->Properties->newEntity();

        if ($this->request->is('post')) {
            if (!isset($this->request->data['status'])) {
                $this->request->data['status'] = 0;
                $this->request->data['is_complete'] = 1;
            }
            if (empty($this->request->data['property_ownerships']['0']['image_file']['name'])) {
                unset($this->request->data['property_ownerships']['0']);
            }
            if (empty($this->request->data['property_ownerships']['1']['image_file']['name'])) {
                unset($this->request->data['property_ownerships']['1']);
            }
            if (empty($this->request->data['property_images']['0']['image_file']['name'])) {
                unset($this->request->data['property_images']);
            }

            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['publish'] = date('Y-m-d');
            $this->request->data['evaculation_date'] = date('Y-m-d',strtotime($this->request->data['evaculation_date']));
            $this->request->data['updated_price'] = $this->request->data['price'];
            $property = $this->Properties->patchEntity($property, $this->request->data);

            $this->request->data['user_id'] = $this->Auth->user('id');

            if ($this->Properties->save($property)) {
                $this->Flash->success(__('The property has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {

            }
            $this->Flash->error(__('The property could not be saved. Please, try again.'));
        }
        $projects = TableRegistry::get('projects')->find('list', ['limit' => 200]);
        //$propertytypes = $this->Properties->Propertytypes->find('list', ['limit' => 200]);
         $connection = ConnectionManager::get('default');
        $sql = "SELECT *  FROM propertytypes";  
        $propertytypes = $connection->execute($sql)->fetchAll('assoc'); 
        $this->set(compact('property', 'propertytypes', 'projects'));
        $this->set('_serialize', ['property']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Property id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $property = $this->Properties->get($id, [
            'contain' => ['PropertyImages', 'PropertyOwnerships', 'PropertyOwners']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            if (empty($this->request->data['property_ownerships']['0']['image_file']['name'])) {
                unset($this->request->data['property_ownerships']['0']);
            }
            if (empty($this->request->data['property_ownerships']['1']['file_file']['name']) && empty($this->request->data['property_ownerships']['1']['image_file']['name'])) {
                unset($this->request->data['property_ownerships']['1']);
            }
            if (empty($this->request->data['property_images']['0']['image_file']['name'])) {
                unset($this->request->data['property_images']);
            }
            $this->request->data['is_complete'] = 1;
            // $this->request->data['user_id'] = $this->Auth->user('id');

            $property = $this->Properties->patchEntity($property, $this->request->data);

            if ($this->Properties->save($property)) { 
                $entity = $this->PropertyUpdates->newEntity();
                $entity->property_id = $property->id;
                $entity->type = 'handling';
                $entity->date = date('Y-m-d');
                $this->PropertyUpdates->save($entity);
                $this->Flash->success(__('The property has been saved.'));
                return $this->redirect(['action' => 'edit/' . $id]);
            }
            $this->Flash->error(__('The property could not be saved. Please, try again.'));
        }
        $projects = TableRegistry::get('projects')->find('list', ['limit' => 200]);
        $connection = ConnectionManager::get('default');
        $sql = "SELECT *  FROM propertytypes";  
        $propertytypes = $connection->execute($sql)->fetchAll('assoc'); 
         
        $this->set(compact('property', 'projects', 'propertytypes', 'id'));
        $this->set('_serialize', ['property']); 
    }

    public function assign($id = null) {
        if (!empty($this->request->data)) {

            $entity = $this->Properties->get($id);
            $entity->assign = $this->request->data['role'];
            if ($this->Properties->save($entity)) {
                $this->Flash->success(__('Property assign to leader'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Property not assign to leader'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $roles = TableRegistry::get('Users')->find('list')->where(['role_id' => 3])->toArray();
        $this->set(compact('roles'));
    }

    public function assignpro() {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('5', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.assign' => $this->Auth->user('id')];
        }

        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users' => function($q) {
                return $q->select(['id', 'name', 'role_id']);
            }];

        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($properties); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function deletedocument($id = null, $redirect = null) {

        $this->PropertyOwnerships = TableRegistry::get('property_ownerships');
        if ($this->PropertyOwnerships->deleteAll(array('PropertyOwnerships.id' => $id))) {
            $this->Flash->success(__('Property document deleted successfully'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        } else {
            $this->Flash->error(__('Property document not deleted'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        }
    }

    public function deleteimage($id = null, $redirect = null) {

        $this->PropertyImages = TableRegistry::get('property_images');
        if ($this->PropertyImages->deleteAll(array('PropertyImages.id' => $id))) {
            $this->Flash->success(__('Property image deleted successfully'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        } else {
            $this->Flash->error(__('Property image not deleted'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        }
    }

    public function delowner($id = null, $redirect = null) {
        $this->PropertyOwners = TableRegistry::get('property_owners');
        if ($this->PropertyOwners->deleteAll(array('PropertyOwners.id' => $id))) {
            $this->Flash->success(__('Property Owners deleted successfully'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        } else {
            $this->Flash->error(__('Property image not deleted'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Property id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null ,$url = null) {

        $this->request->allowMethod(['post', 'delete']);
        $property = $this->Properties->get($id);
        if ($this->Properties->delete($property)) {
            $this->Flash->success(__('The property has been deleted.'));
        } else {
            $this->Flash->error(__('The property could not be deleted. Please, try again.'));
        }
        if(!empty($url)){
            return $this->redirect(['action' => $url]);
        }else{
            return $this->redirect(['action' => 'index']);
        }

    }

    public function getstate($id = null){

        $result = TableRegistry::get('states')->find('all')->select(['id','name'])->where(['country_id'=>$this->request->data['id']])->toArray();
        echo json_encode($result);
        die;
    }

    public function graph($id = null) {
        $result = $this->Properties->find()->contain(['PropertyBids'])->hydrate(false)->where(['id' => $id])->first();

        $this->set(compact('result','id'));
    }

    public function graphload($id = null) {
        $result = $this->Properties->find()->contain(['PropertyBids'])->hydrate(false)->where(['id' => $id])->first();

        $this->set(compact('result'));
    }

    public function project($id = null) {
        $query = TableRegistry::get('properties')->find()->where(['project_id' => $id]);
        $project = TableRegistry::get('projects')->find()->select(['name'])->where(['id' => $id])->first();
        $properties = $this->paginate($query);
        $this->set(compact('properties', 'project'));
    }

    public function status($id = null) {

        $property = $this->Properties->get($id);
        $this->set(compact('property'));

        if (!empty($this->request->data)) {

            if ($this->Properties->updateAll(['status' => $this->request->data['status']], ['id' => $id])) {

                $entity = $this->PropertyUpdates->newEntity();
                $entity->property_id = $id;
                $entity->type = 'status';
                $entity->status = $this->request->data['status'];
                $entity->date = date('Y-m-d H:i:s');
                $entity->created = date('Y-m-d H:i:s');
                $this->PropertyUpdates->save($entity);

                /* Send push here */
                $push = $this->Properties->find()
                        ->where(['Properties.id' => $id])
                        ->contain(['Users' => function($q) {
                                return $q->select(['id','language','device_token','device_type'])->where(['device_token !=' => '']);
                            }])
                        ->hydrate(false)
                        ->first();
                if(isset($push['user']) && $push['user']['language'] == 2){
                    $lan = "_he";
                }else{
                    $lan = "_en";
                }
                $device[] = $push['user'];
                if (!empty($device)) {
                    $message['title'] = $this->msgDictonary['notification' .$lan];
                    $message['body'] = $this->msgDictonary['prop_status' .$lan];
                    $aps['id'] = $id;
                    $aps['type'] = 'general';
                    $this->Default->pushnotification($message,$device,$aps);

                }

                $this->Flash->success(__('Property status change successfully'));
                $this->redirect(['controller' => 'properties', 'action' => 'status', $id]);
            }
        }
    }

    public function handling($id = null) {
        $property = $this->Properties->get($id);
        $this->set(compact('property'));

        if (!empty($this->request->data)) {

            if ($this->Properties->updateAll(['handling' => $this->request->data['handling']], ['id' => $id])) {

                /* Send push here */
                $push = $this->Properties->find()
                        ->where(['Properties.id' => $id])
                        ->contain(['Users' => function($q) {
                                return $q->select(['id','device_token','device_type'])->where(['device_token !=' => '']);
                            }])
                        ->hydrate(false)
                        ->first();
                $device[] = $push['user'];
                if (!empty($device)) {
                    $message['title'] = 'okbid';
                    $message['body'] = 'Your prperty handling status has beed changed';
                    $aps['id'] = $id;
                    $aps['type'] = 'general';
                    $this->Default->pushnotification($message,$device,$aps);

                }

                $entity = $this->PropertyUpdates->newEntity();
                $entity->property_id = $id;
                $entity->type = 'handling';
                $entity->status = $this->request->data['handling'];
                $entity->message = $this->request->data['message'];
                $entity->date = date('Y-m-d');
                $this->PropertyUpdates->save($entity);
                $this->Flash->success(__('Property handling status change successfully'));
                $this->redirect(['controller' => 'properties', 'action' => 'handling', $id]);
            }
        }
    }

    public function viewusers($id = null)
    {

        $users = TableRegistry::get('property_views')->find()->where(['property_id' => $id])->contain(['Users'])
				->group(['user_id'])
				->toArray();
			//	print_r(count($users));exit;
        $this->set(compact('users'));
    }
    public function signusers($id = null)
    {

        $users = TableRegistry::get('property_signatures')->find()->where(['property_id' => $id])->contain(['Users'])->toArray();
        $this->set(compact('users'));
    }
    public function bidusers($id = null)
    {

        $users = TableRegistry::get('property_bids')->find()
				->where(['property_id' => $id])->contain(['Users'])
				->order(['price'=>'desc'])
				->toArray();
        $this->set(compact('users'));
    }

	public function getcsv() {
		header("Content-Type: text/html; charset=UTF-8LE");
		$this->city = TableRegistry::get('cities');
        $file = fopen('rechovot_20181202.csv', 'r');

		$i=0;
		echo "<pre>";
        $conn = ConnectionManager::get('default');
        $arras = [];
        while (($line = fgetcsv($file)) !== FALSE) {

                // if(!in_array($line['2'], $arras)){
					// echo $sql =  "INSERT INTO `cities` (`id`, `code`, `name`, `status`) VALUES (NULL, ".trim($line['1']).",'".trim($line['2'])."',1);";
                    // $arras[] = $line['2'];
                    // echo "<br/>";
                // }
		if($line['3'] == '410'){
			echo "<br/>";
			echo $sql =  "INSERT INTO `streets` (`id`,`city_id`, `code`, `name`, `status`) VALUES (NULL, '".$line['1']."','".$line['3']."','".trim(str_replace("'","",$line['4']))."',1);";

		}

		$i++;

        }
        fclose($file);
		die;

    }
    public function getstreet() {
        header("Content-Type: text/html; charset=UTF-8LE");
        $this->city = TableRegistry::get('cities');
        $file = fopen('city.csv', 'r');
        $i = 0;
        echo "<pre>";
        $conn = ConnectionManager::get('default');
        while (($line = fgetcsv($file)) !== FALSE) {
            //echo $sql =  "INSERT INTO `cities` (`id`, `code`, `name`, `status`) VALUES (NULL, ".$line['2'].",'".trim($line['3'])."',1);";
            echo $sql = "INSERT INTO `streets` (`id`, `code`, `name`, `status`) VALUES (NULL, " . $line['4'] . ",'" . trim($line['5']) . "',1);";
            echo "<br/>";
            $i++;
        }
        fclose($file);
        die;
    }

        public function getprefix(){
        header("Content-Type: text/html; charset=UTF-8LE");
        $this->city = TableRegistry::get('cities');
        $file = fopen('code.csv', 'r');
        $i = 0;
        echo "<pre>";
        $conn = ConnectionManager::get('default');
        while (($line = fgetcsv($file)) !== FALSE) {

            echo $sql = "INSERT INTO `prefixs` (`id`, `country`, `code`,`dialing` ,`status`) VALUES (NULL, '" . $line['0'] . "','" . trim($line['1']) . "','" . trim($line['2']) . "',1);";
            echo "<br/>";
        }
        fclose($file);
        die;
    }

}
