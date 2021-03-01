<?php namespace BannerManager\Controller\Admin;

use BannerManager\Controller\AppController;

/**
 * Banners Controller
 *
 * @property \BannerManager\Model\Table\BannersTable $Banners
 *
 * @method \BannerManager\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BannersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Banners->find();
        $options['order'] = ['Banners.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $banners = $this->paginate($query);
        $this->set(compact('banners'));
        $this->set('_serialize', ['banners']);
    }

    /**
     * View method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $banner = $this->Banners->get($id, [
            'contain' => ['BannerImages']
        ]);

        $this->set('banner', $banner);
        $this->set('_serialize', ['banner']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if ($id) {
            $banner = $this->Banners->get($id, [
                'contain' => ['BannerImages']
            ]);
        } else {
            $banner = $this->Banners->newEntity();
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            //dump($banner);die;
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('The banner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The banner could not be saved. Please, try again.'));
        }

        $this->set(compact('banner'));
        $this->set('_serialize', ['banner']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $banner = $this->Banners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('The banner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The banner could not be saved. Please, try again.'));
        }
        $this->set(compact('banner'));
        $this->set('_serialize', ['banner']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $banner = $this->Banners->get($id);
        if ($this->Banners->delete($banner)) {
            $msg = __('The banner has been deleted.');
            $this->Flash->success($msg);
            $response = ["success" => TRUE, "err_msg" => $msg];
        } else {
            $msg = __('The banner could not be deleted. Please, try again.');
            $this->Flash->error($msg);
            $response = ["success" => FALSE ,"err_msg" => $msg];
        }
        $this->set([
            'success' => $response['success'],
            'responce' => 200,
            'message' => $response['err_msg'],
            'data' => $banner,
            '_jsonOptions' => JSON_FORCE_OBJECT,
            '_serialize' => ['success', 'responce', 'message','data']
        ]);

        if (!$this->request->is('ajax')) {
            return $this->redirect(['action' => 'index']);
        }
    }
    /**
     * deleteImages method
     *
     * @param string|null $id Banner Images id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteImages($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bannerImage = $this->Banners->BannerImages->get($id);
        if ($this->Banners->BannerImages->delete($bannerImage)) {
            $msg = __('The banner image has been deleted.');
            $response = ["success" => TRUE, "err_msg" => $msg];
        } else {
            $msg = __('The banner image could not be deleted. Please, try again.');
            $response = ["success" => FALSE ,"err_msg" => $msg];
        }
        $this->set([
            'success' => $response['success'],
            'responce' => 200,
            'message' => $response['err_msg'],
            'data' => $bannerImage,
            '_jsonOptions' => JSON_FORCE_OBJECT,
            '_serialize' => ['success', 'responce', 'message','data']
        ]);

        if (!$this->request->is('ajax')) {
            $response['success'] === TRUE ? $this->Flash->success($msg) : $this->Flash->error($msg);
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * ChangeFlag method
     *
     * @param string|null &id flag id.
     * @param string|null &id field those update table field.
     * @param string|null &status Admin status.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Banners->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Banners->save($status)) {
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
