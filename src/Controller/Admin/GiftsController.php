<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Gifts Controller
 *
 * @property \App\Model\Table\GiftsTable $Gifts
 *
 * @method \App\Model\Entity\Gift[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GiftsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$query = $this->Gifts->find();
		$options['order'] = ['Gifts.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $gifts = $this->paginate($query);
		$this->set(compact('gifts'));
        $this->set('_serialize', ['gifts']);
    }

    /**
     * View method
     *
     * @param string|null $id Gift id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gift = $this->Gifts->get($id, [
            'contain' => []
        ]);

        $this->set('gift', $gift);
        $this->set('_serialize', ['gift']);
    }


    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Gift id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $gift = $this->Gifts->get($id, [
                'contain' => []
            ]);
        }else{
            $gift = $this->Gifts->newEntity();
        }
        if ($this->request->is(['post','patch', 'put'])) {
            $gift = $this->Gifts->patchEntity($gift, $this->request->getData());
            // echo '<pre>';
            // print_r($this->request->getData());
            // print_r($gift); die;
            if ($this->Gifts->save($gift)) {
                $this->Flash->success(__('The gift has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gift could not be saved. Please, try again.'));
        }
        
        $this->set(compact('gift'));
        $this->set('_serialize', ['gift']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Gift id.
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
     * @param string|null $id Gift id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gift = $this->Gifts->get($id);
        if ($this->Gifts->delete($gift)) {
            $this->Flash->success(__('The gift has been deleted.'));
        } else {
            $this->Flash->error(__('The gift could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
