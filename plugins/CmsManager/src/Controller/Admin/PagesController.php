<?php
namespace CmsManager\Controller\Admin;

use CmsManager\Controller\AppController;

/**
 * Pages Controller
 *
 * @property \CmsManager\Model\Table\PagesTable $Pages
 *
 * @method \CmsManager\Model\Entity\Page[] paginate($object = null, array $settings = [])
 */
class PagesController extends AppController
{

    public function initialize() {
        parent::initialize();
        $_dir = str_replace("\\", "/", $this->Pages->_dir);
        $this->set(compact('_dir'));
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Pages->find();
        $options['order'] = ['Pages.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $pages = $this->paginate($query);
        $this->set(compact('pages'));
        $this->set('_serialize', ['pages']);
    }

    /**
     * View method
     *
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $page = $this->Pages->get($id, [
            'contain' => []
        ]);

        $this->set('page', $page);
        $this->set('_serialize', ['page']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id=null)
    {
    
        if($id){
            $page = $this->Pages->get($id, [
            'contain' => []
        ]);
        }else{
            $page = $this->Pages->newEntity();
        }
        if ($this->request->is(['post','patch', 'put'])) {
            $page = $this->Pages->patchEntity($page, $this->request->getData());
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }
        
        $this->set(compact('page'));
        $this->set('_serialize', ['page']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $page = $this->Pages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $page = $this->Pages->patchEntity($page, $this->request->getData());
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }
        $this->set(compact('page'));
        $this->set('_serialize', ['page']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        if ($this->Pages->delete($page) && $this->Pages->deleteImage($page->banner)) {
            $this->Flash->success(__('The page has been deleted.'));
        } else {
            $this->Flash->error(__('The page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * deleteimg method
     *
     * @param string|null $id CMS Page id.
     * @return \Cake\Http\Response|null Redirects to referer url.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteimg($id = null) {
        $page = $this->Pages->get($id);
        if ($this->Pages->deleteImage($page->banner, $page)) {
            $this->Flash->success(__('The Banner image has been deleted.'));
        } else {
            $this->Flash->error(__('The Banner image could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
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
            $status = $this->Pages->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Pages->save($status)) {
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