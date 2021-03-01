<?php

namespace ContactManager\Controller\Admin;

use ContactManager\Controller\AppController;

/**
 * Inquiries Controller
 *
 * @property \ContactManager\Model\Table\InquiriesTable $Inquiries
 *
 * @method \ContactManager\Model\Entity\Inquiry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InquiriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->Inquiries->find();
        $options['order'] = ['Inquiries.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $options['contain'] = ['products'=>function($q){
            return $q->select(['id','title']);
        }];
        $this->paginate = $options;
        $inquiries = $this->paginate($query);
        $this->set(compact('inquiries'));
        $this->set('_serialize', ['inquiries']);
    }

    /**
     * View method
     *
     * @param string|null $id Inquiry id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $inquiry = $this->Inquiries->get($id,[
            'contain' => ['products'=>function($q){
                return $q->select(['id','title']);
            }]
        ]);
        
        $this->set('inquiry', $inquiry);
        $this->set('_serialize', ['inquiry']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Inquiry id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $inquiry = $this->Inquiries->get($id);
        if ($this->Inquiries->delete($inquiry)) {
            $this->Flash->success(__('The inquiry has been deleted.'));
        } else {
            $this->Flash->error(__('The inquiry could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
