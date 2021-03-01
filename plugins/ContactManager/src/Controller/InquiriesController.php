<?php

namespace ContactManager\Controller;

use ContactManager\Controller\AppController;

/**
 * Inquiries Controller
 *
 * @property \ContactManager\Model\Table\InquiriesTable $Inquiries
 *
 * @method \ContactManager\Model\Entity\Inquiry[] paginate($object = null, array $settings = [])
 */
class InquiriesController extends AppController
{

    /**
     * Method : initialize
     * Return : null
     * Desc : call when initialize
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index']);
    }

    /**
     * Method : index
     * Return : 
     * Desc : generates  contact us page / email sending process
     */
    public function index() {
        $inquiry = $this->Inquiries->newEntity($this->Auth->User());
        $title = 'Contact Us';
        if ($this->request->is('post')) {
            $inquiry = $this->Inquiries->patchEntity($inquiry, $this->request->getData());
            if ($this->Inquiries->save($inquiry)) {
                $this->Flash->success("Thank you for submitting your enquiry, we will get back to you soon.");
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('inquiry', 'title'));
    }

}
