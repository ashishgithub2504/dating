<?php
namespace SettingManager\Controller\Api;

use SettingManager\Controller\AppController;

/**
 * Settings Controller
 *
 * @property \SettingManager\Model\Table\SettingsTable $Settings
 *
 * @method \SettingManager\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SettingsController extends AppController
{
public function initialize()
    {
		
	    parent::initialize();
		$this->Auth->allow();
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $settings = $this->ConfigSettings;

        $this->set([
            'message' => '',
            'data' => $settings,
            '_serialize' => ['message','data']
        ]);
    }

}
