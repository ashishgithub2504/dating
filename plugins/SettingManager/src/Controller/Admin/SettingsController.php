<?php

namespace SettingManager\Controller\Admin;

use SettingManager\Controller\AppController;

/**
 * Settings Controller
 *
 * @property \SettingManager\Model\Table\SettingsTable $Settings
 *
 * @method \SettingManager\Model\Entity\Setting[] paginate($object = null, array $settings = [])
 */
class SettingsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->Settings->find();
        $options['order'] = ['Settings.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $query->where(['Settings.manager' => 'general']);
        $settings = $this->paginate($query);
        $this->set(compact('settings'));
        $this->set('_serialize', ['settings']);
    }

    /**
     * View method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $setting = $this->Settings->get($id, [
            'contain' => []
        ]);

        $this->set('setting', $setting);
        $this->set('_serialize', ['setting']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Setting id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id) {
            $setting = $this->Settings->get($id, [
                'contain' => []
            ]);
        } else {
            $setting = $this->Settings->newEntity();
        }
        $resultJ = ['status' => false, 'errors' => ''];
        if ($this->request->is(['post', 'patch', 'put'])) {
            $this->request = $this->request->withData('manager','general');
            $setting = $this->Settings->patchEntity($setting, $this->request->getData());
            if ($this->Settings->save($setting)) {
                $status = true;
                $message = __('The setting has been saved.');
                if (!$this->request->is('Ajax')) {
                    $this->Flash->success($message);
                    return $this->redirect(['action' => 'index']);
                } else {
                    $resultJ = ['status' => $status, 'errors' => $message];
                }
            } else {
                if ($this->request->is('Ajax')) {
                    $resultJ = ['status' => false, 'errors' => $setting->getErrors()];
                }
            }
            if (!$this->request->is('Ajax')) {
            $this->Flash->error(__('The setting could not be saved. Please, try again.'));
            }
        }
        $this->set(['setting' => $setting,'status' => $resultJ['status'],'errors' => $resultJ['errors']]);
        $this->set('_serialize', ['setting','status','errors']);
    }

    /**
     * smtp method
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function smtp() {
        $conditions = ['manager' => 'smtp'];
        $setting = $this->Settings->find()->where($conditions)->all();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $settings = $this->Settings->patchEntities($setting, $this->request->getData());
            if ($this->Settings->saveMany($settings)) {
                $this->Flash->success(__('Smtp details has been saved.'));
                return $this->redirect(['action' => 'smtp']);
            } else {
                $this->Flash->error(__('Smtp details could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * logos method
     * Comments: add front, admin, logos and fav icons server detail
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function logos() {
        $conditions = ['manager' => 'theme_images'];
        $setting = $this->Settings->find()->where($conditions)->all();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntities($setting, $this->request->getData());
            if ($this->Settings->saveMany($setting)) {
                $this->Flash->success(__('Theme file details has been saved.'));
                return $this->redirect(['action' => 'logos']);
            } else {
                $this->Flash->error(__('Theme file details could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        //$this->request->allowMethod(['post', 'delete']);
        $setting = $this->Settings->get($id);
        if ($this->Settings->delete($setting)) {
            $this->Flash->success(__('The setting has been deleted.'));
        } else {
            $this->Flash->error(__('The setting could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    /**
     * social method
     * Comments: add front, admin, logos and fav icons server detail
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function social() {
        $conditions = ['manager' => 'social'];
        $setting = $this->Settings->find()->where($conditions)->first();
        if (empty($setting)) {
            $setting = $this->Settings->newEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->getData());
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('Social url details has been saved.'));
                return $this->redirect(['action' => 'social']);
            } else {
                $this->Flash->error(__('Social url details could not be saved. Please, try again.'));
            }
        }

        $_dir = str_replace("\\", "/", $this->Settings->_dir);
        $this->set(compact('setting', '_dir'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteSocial($id = null, $index = null) {
        $setting = $this->Settings->get($id);
        $config_array = json_decode($setting->config_value, true);
        if (count($config_array) == 1) {
            if ($this->Settings->delete($setting)) {
                $this->Flash->success(__('The setting has been deleted.'));
            } else {
                $this->Flash->error(__('The setting could not be deleted. Please, try again.'));
            }
        } else {
            unset($config_array[$index]);
            $config_value = json_encode($config_array);
            $this->Settings->updateAll(['config_value' => $config_value], ['id' => $id]);
            $this->Settings->yamlParse();
            $this->Flash->success(__('The setting has been deleted.'));
        }

        return $this->redirect($this->referer());
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
    public function changeFlag() {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Settings->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Settings->save($status)) {
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
