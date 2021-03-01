<?php
namespace CatalogManager\Controller\Admin;

use CatalogManager\Controller\AppController;

/**
 * AttributeGroups Controller
 *
 * @property \CatalogManager\Model\Table\AttributeGroupsTable $AttributeGroups
 *
 * @method \CatalogManager\Model\Entity\AttributeGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AttributeGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$query = $this->AttributeGroups->find();
		$options['order'] = ['AttributeGroups.sort_order' => 'ASC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $attributeGroups = $this->paginate($query);
		$this->set(compact('attributeGroups'));
        $this->set('_serialize', ['attributeGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Attribute Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attributeGroup = $this->AttributeGroups->get($id, [
            'contain' => ['Attributes']
        ]);

        $this->set('attributeGroup', $attributeGroup);
        $this->set('_serialize', ['attributeGroup']);
    }


    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Attribute Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $attributeGroup = $this->AttributeGroups->get($id, [
                'contain' => []
            ]);
        }else{
            $attributeGroup = $this->AttributeGroups->newEntity();
        }
        if ($this->request->is(['post','patch', 'put'])) {
            $attributeGroup = $this->AttributeGroups->patchEntity($attributeGroup, $this->request->getData());
            if ($this->AttributeGroups->save($attributeGroup)) {
                $this->Flash->success(__('The attribute group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attribute group could not be saved. Please, try again.'));
        }
        
            $this->set(compact('attributeGroup'));
        $this->set('_serialize', ['attributeGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Attribute Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $attributeGroup = $this->AttributeGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attributeGroup = $this->AttributeGroups->patchEntity($attributeGroup, $this->request->getData());
            if ($this->AttributeGroups->save($attributeGroup)) {
                $this->Flash->success(__('The attribute group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attribute group could not be saved. Please, try again.'));
        }
        $this->set(compact('attributeGroup'));
        $this->set('_serialize', ['attributeGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Attribute Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attributeGroup = $this->AttributeGroups->get($id);
        if ($this->AttributeGroups->delete($attributeGroup)) {
            $this->Flash->success(__('The attribute group has been deleted.'));
        } else {
            $this->Flash->error(__('The attribute group could not be deleted. Please, try again.'));
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
            $status = $this->AttributeGroups->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->AttributeGroups->save($status)) {
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
