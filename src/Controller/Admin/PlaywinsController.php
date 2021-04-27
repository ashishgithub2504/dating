<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Playwins Controller
 *
 * @property \App\Model\Table\PlaywinsTable $Playwins
 *
 * @method \App\Model\Entity\Playwin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlaywinsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$query = $this->Playwins->find();
		$options['order'] = ['Playwins.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $playwins = $this->paginate($query);
		$this->set(compact('playwins'));
        $this->set('_serialize', ['playwins']);
    }


    /**
     * View method
     *
     * @param string|null $id Playwin id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $playwin = $this->Playwins->get($id, [
            'contain' => ['PlaywinJoin']
        ]);

        $this->set('playwin', $playwin);
        $this->set('_serialize', ['playwin']);
    }



    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Playwin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $playwin = $this->Playwins->get($id, [
                'contain' => []
            ]);
        }else{
            $playwin = $this->Playwins->newEntity();
        }
        if ($this->request->is(['post','patch', 'put'])) {
            $playwin = $this->Playwins->patchEntity($playwin, $this->request->getData());
            if ($this->Playwins->save($playwin)) {
                $this->Flash->success(__('The playwin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The playwin could not be saved. Please, try again.'));
        }
        
            $this->set(compact('playwin'));
        $this->set('_serialize', ['playwin']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Playwin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->add($id);
        $this->render("add");
    }


    /**
     * Delete method
     *
     * @param string|null $id Playwin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $playwin = $this->Playwins->get($id);
        if ($this->Playwins->delete($playwin)) {
            $this->Flash->success(__('The playwin has been deleted.'));
        } else {
            $this->Flash->error(__('The playwin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
            $status = $this->Playwins->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Playwins->save($status)) {
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
