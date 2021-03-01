<?php

namespace CatalogManager\Controller\Admin;

use CatalogManager\Controller\AppController;

/**
 * Options Controller
 *
 * @property \CatalogManager\Model\Table\OptionsTable $Options
 *
 * @method \CatalogManager\Model\Entity\Option[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OptionsController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->Options->find();
        $options['order'] = ['Options.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $options = $this->paginate($query);
        $this->set(compact('options'));
        $this->set('_serialize', ['options']);
    }

    /**
     * View method
     *
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $option = $this->Options->get($id, [
            'contain' => ['OptionValues']
        ]);

        $this->set('option', $option);
        $this->set('_serialize', ['option']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id) {
            $option = $this->Options->get($id, [
                'contain' => ['OptionValues']
            ]);
        } else {
            $option = $this->Options->newEntity();
        }
        //dump($option);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $option = $this->Options->patchEntity($option, $this->request->getData());
            if ($this->Options->save($option)) {
                if (!$option->isNew()) {
                    if ($option->option_type == 'select' || $option->option_type == 'radio' || $option->option_type == 'checkbox' || $option->option_type == 'image') {
                        // not delete 
                    } else {
                        $this->Options->OptionValues->deleteAll(['option_id' => $option->id]);
                    }
                }
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The option could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('option'));
        $this->set('_serialize', ['option']);
    }

    /**
     * autocomplete method
     *
     * @param string $value otion name value.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function autocomplete() {
        
        if ($this->request->getData('value') != NULL) {
            $query = $this->Options->find();
            if($this->request->getData('value')){
                $conditions[] = ['Options.title LIKE' => '%' . $this->request->getData('value') . '%'];
                $query->where($conditions);
            }
            $query->contain(['OptionValues']);
            $options = $query->all();
            //dump($options);die;
            $json = [];
            foreach ($options as $option) {
                
                $option_value_data = [];
                if (!empty($option->option_values)) {
                   // die('tet');
                    //dump($option->option_values);
                    foreach ($option->option_values as $option_value) {
                        
                        $option_value_data[] = array(
                            'id' => $option_value->id,
                            'option_id' => $option_value->option_id,
                            'title' => $option_value->title,
                            'sort_order' => $option_value->sort_order,
                            'image' => $option_value->image
                        );
                    }

                    $sort_order = array();

                    foreach ($option_value_data as $key => $value) {
                        $sort_order[$key] = $value['sort_order'];
                    }

                    array_multisort($sort_order, SORT_ASC, $option_value_data);
                }
                
                $type = '';
                if ($option->option_type == 'select' || $option->option_type == 'radio' || $option->option_type == 'checkbox') {
                    $type = "Choose";
                }

                if ($option->option_type == 'text' || $option->option_type == 'textarea') {
                    $type = "Input";
                }

                if ($option->option_type == 'file') {
                    $type = "File";
                }

                if ($option->option_type == 'date' || $option->option_type == 'datetime' || $option->option_type == 'time') {
                    $type = "Date";
                }

                $json[] = array(
                    'id' => $option->id,
                    'title' => $option->title,
                    'category' => $type,
                    'type' => $option->option_type,
                    'sort_order' => $option->sort_order,
                    'option_value' => $option_value_data
                );
            }
            if (!empty($json)) {
                $success = true;
                $sort_order = array();
                foreach ($json as $key => $value) {
                    $sort_order[$key] = $value['title'];
                }
                array_multisort($sort_order, SORT_ASC, $json);
            } else {
                $success = false;
            }
            die(json_encode($json));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $option = $this->Options->get($id);
        if ($this->Options->delete($option)) {
            $this->Flash->success(__('The option has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Option id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function optionValuedelete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $option = $this->Options->OptionValues->get($id);
        if ($this->Options->OptionValues->delete($option)) {
            $this->Flash->success(__('The option value has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * ChangeFlag method
     *
     * @param string|null &id Status id.
     * @param string|null &id field those update table field.
     * @param string|null &status Admin status.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeFlag() {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Options->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Options->save($status)) {
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
