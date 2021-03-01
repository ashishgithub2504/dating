<?php
namespace UserManager\Controller\Admin;

use UserManager\Controller\AppController;

/**
 * AccountTypes Controller
 *
 * @property \UserManager\Model\Table\AccountTypesTable $AccountTypes
 *
 * @method \UserManager\Model\Entity\AccountType[] paginate($object = null, array $settings = [])
 */
class AccountTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$query = $this->AccountTypes->find();
		$options['order'] = ['AccountTypes.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $accountTypes = $this->paginate($query);
		$this->set(compact('accountTypes'));
        $this->set('_serialize', ['accountTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Account Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accountType = $this->AccountTypes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('accountType', $accountType);
        $this->set('_serialize', ['accountType']);
    }


    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Account Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $accountType = $this->AccountTypes->get($id, [
                'contain' => ['Users']
            ]);
        }else{
            $accountType = $this->AccountTypes->newEntity();
        }
        if ($this->request->is(['post','patch', 'put'])) {
            $accountType = $this->AccountTypes->patchEntity($accountType, $this->request->getData());
            if ($this->AccountTypes->save($accountType)) {
                $this->Flash->success(__('The account type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account type could not be saved. Please, try again.'));
        }
        
            $users = $this->AccountTypes->Users->find('list', ['limit' => 200]);
        $this->set(compact('accountType', 'users'));
        $this->set('_serialize', ['accountType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Account Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accountType = $this->AccountTypes->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accountType = $this->AccountTypes->patchEntity($accountType, $this->request->getData());
            if ($this->AccountTypes->save($accountType)) {
                $this->Flash->success(__('The account type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account type could not be saved. Please, try again.'));
        }
        $users = $this->AccountTypes->Users->find('list', ['limit' => 200]);
        $this->set(compact('accountType', 'users'));
        $this->set('_serialize', ['accountType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Account Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accountType = $this->AccountTypes->get($id);
        if ($this->AccountTypes->delete($accountType)) {
            $this->Flash->success(__('The account type has been deleted.'));
        } else {
            $this->Flash->error(__('The account type could not be deleted. Please, try again.'));
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
            $status = $this->AccountTypes->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->AccountTypes->save($status)) {
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
