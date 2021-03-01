<?php namespace CmsManager\Controller\Admin;

use CmsManager\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Navigations Controller
 *
 * @property \CmsManager\Model\Table\NavigationsTable $Navigations
 *
 * @method \CmsManager\Model\Entity\Navigation[] paginate($object = null, array $settings = [])
 */
class NavigationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Navigations->find();
        $query->contain(['ParentNavigations']);
        $options['order'] = ['Navigations.lft' => 'ASC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $navigations = $this->paginate($query);
        $this->set(compact('navigations'));
        $this->set('_serialize', ['navigations']);
    }

    /**
     * View method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $navigation = $this->Navigations->get($id, [
            'contain' => ['ParentNavigations', 'ChildNavigations']
        ]);

        $this->set('navigation', $navigation);
        $this->set('_serialize', ['navigation']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Navigation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {

        if ($id) {
            $navigation = $this->Navigations->get($id, [
                'contain' => []
            ]);
            $conditions['id !='] = $id;
            $children = $this->Navigations
                ->find('children', ['for' => $id])
                ->find('threaded')
                ->find('list')
                ->toArray();
            if(!empty($children)){
                $conditions['id NOT IN'] = array_keys($children);
            }
            //pr($conditions);die;
        } else {
            $navigation = $this->Navigations->newEntity();
            $conditions = [];
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            //pr($this->request->getData());die;
            $navigation = $this->Navigations->patchEntity($navigation, $this->request->getData());
            //pr($navigation->errors());die;
            if ($this->Navigations->save($navigation)) {
                $this->Flash->success(__('The navigation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The navigation could not be saved. Please, try again.'));
        }

        $parentNavigations = $this->Navigations->ParentNavigations->find('treeList', ['keyField' => 'id', 'valueField' => 'title'])->where($conditions)->toArray();

        $modules = $this->Navigations->Modules->find('list', ['keyField' => 'json_path', 'valueField' => 'title'])->where(['status' => 1])->toArray();
        //pr($modules);die;
        $cmspages = TableRegistry::get('Pages')->find('list', ['keyField' => 'slug', 'valueField' => 'title'])->where(['status' => 1])->toArray();
        $pages = [];
        foreach ($cmspages as $key => $value) {
            $pages[json_encode(['plugin' => 'CmsManager', 'controller' => 'Pages', 'action' => 'detail', 'slug' => $key])] = $value;
        }

        $this->set(compact('navigation', 'parentNavigations', 'modules', 'pages'));
        $this->set('_serialize', ['navigation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $navigation = $this->Navigations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $navigation = $this->Navigations->patchEntity($navigation, $this->request->getData());
            if ($this->Navigations->save($navigation)) {
                $this->Flash->success(__('The navigation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The navigation could not be saved. Please, try again.'));
        }
        $parentNavigations = $this->Navigations->ParentNavigations->find('list', ['limit' => 200]);
        $modules = $this->Navigations->Modules->find('list', ['limit' => 200]);
        $this->set(compact('navigation', 'parentNavigations', 'modules'));
        $this->set('_serialize', ['navigation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $navigation = $this->Navigations->get($id);
        if ($this->Navigations->delete($navigation)) {
            $this->Flash->success(__('The navigation has been deleted.'));
        } else {
            $this->Flash->error(__('The navigation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * ChangeFlag method
     *
     * @param string|null &id Admin User id.
     * @param string|null &id field those update table field.
     * @param string|null &status Admin status.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Navigations->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Navigations->save($status)) {
                $msg = $this->request->getData($field) == 1 ? __("Your {$field} has activated") : __("Your {$field} has deactivated");
                $response = ["success" => true, "err_msg" => $msg];
            } else {
                $response = ["success" => false, "err_msg" => __("Your Process faild. please try again!!")];
            }
            $this->set([
                'success' => $response['success'],
                'responce' => 200,
                'message' => $response['err_msg'],
                '_jsonOptions' => JSON_FORCE_OBJECT,
                '_serialize' => ['success', 'responce', 'message']
            ]);
        }
    }
}
