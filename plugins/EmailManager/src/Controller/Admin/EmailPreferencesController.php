<?php
namespace EmailManager\Controller\Admin;

use EmailManager\Controller\AppController;

/**
 * EmailPreferences Controller
 *
 * @property \EmailManager\Model\Table\EmailPreferencesTable $EmailPreferences
 *
 * @method \EmailManager\Model\Entity\EmailPreference[] paginate($object = null, array $settings = [])
 */
class EmailPreferencesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->EmailPreferences->find();
        $options['order'] = ['EmailPreferences.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $emailPreferences = $this->paginate($query);
        $this->set(compact('emailPreferences'));
        $this->set('_serialize', ['emailPreferences']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Preference id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailPreference = $this->EmailPreferences->get($id, [
            'contain' => ['EmailTemplates']
        ]);

        $this->set('emailPreference', $emailPreference);
        $this->set('_serialize', ['emailPreference']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Email Preference id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id=null)
    {
    
        if($id){
            $emailPreference = $this->EmailPreferences->get($id, [
            'contain' => []
        ]);
        }else{
            $emailPreference = $this->EmailPreferences->newEntity();
        }
        if ($this->request->is(['post','patch', 'put'])) {
            $emailPreference = $this->EmailPreferences->patchEntity($emailPreference, $this->request->getData());
            if ($this->EmailPreferences->save($emailPreference)) {
                $this->Flash->success(__('The email preference has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email preference could not be saved. Please, try again.'));
        }
        $this->set(compact('emailPreference'));
        $this->set('_serialize', ['emailPreference']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Preference id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailPreference = $this->EmailPreferences->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailPreference = $this->EmailPreferences->patchEntity($emailPreference, $this->request->getData());
            if ($this->EmailPreferences->save($emailPreference)) {
                $this->Flash->success(__('The email preference has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email preference could not be saved. Please, try again.'));
        }
        $this->set(compact('emailPreference'));
        $this->set('_serialize', ['emailPreference']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Preference id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailPreference = $this->EmailPreferences->get($id);
        if ($this->EmailPreferences->delete($emailPreference)) {
            $this->Flash->success(__('The email preference has been deleted.'));
        } else {
            $this->Flash->error(__('The email preference could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
   }
