<?php
namespace CatalogManager\Controller\Admin;

use CatalogManager\Controller\AppController;

/**
 * StockStatuses Controller
 *
 * @property \CatalogManager\Model\Table\StockStatusesTable $StockStatuses
 *
 * @method \CatalogManager\Model\Entity\StockStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockStatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$query = $this->StockStatuses->find();
		$options['order'] = ['StockStatuses.sort_order' => 'ASC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $stockStatuses = $this->paginate($query);
		$this->set(compact('stockStatuses'));
        $this->set('_serialize', ['stockStatuses']);
    }

   

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Stock Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $stockStatus = $this->StockStatuses->get($id, [
                'contain' => []
            ]);
        }else{
            $stockStatus = $this->StockStatuses->newEntity();
        }
        if ($this->request->is(['post','patch', 'put'])) {
            $stockStatus = $this->StockStatuses->patchEntity($stockStatus, $this->request->getData());
            if ($this->StockStatuses->save($stockStatus)) {
                $this->Flash->success(__('The stock status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock status could not be saved. Please, try again.'));
        }
        
            $this->set(compact('stockStatus'));
        $this->set('_serialize', ['stockStatus']);
    }

    

    /**
     * Delete method
     *
     * @param string|null $id Stock Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockStatus = $this->StockStatuses->get($id);
        if ($this->StockStatuses->delete($stockStatus)) {
            $this->Flash->success(__('The stock status has been deleted.'));
        } else {
            $this->Flash->error(__('The stock status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
  
}
