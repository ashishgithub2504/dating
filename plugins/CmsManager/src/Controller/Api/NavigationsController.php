<?php
namespace CmsManager\Controller\Api;

use CmsManager\Controller\AppController;

/**
 * Navigations Controller
 *
 * @property \CmsManager\Model\Table\NavigationsTable $Navigations
 *
 * @method \CmsManager\Model\Entity\Navigation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NavigationsController extends AppController
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
        $navigations = $this->Navigations->find("threaded")->find('position',$this->request->getQuery())->select(['Navigations.id','Navigations.title','Navigations.slug','Navigations.parent_id','Navigations.menu_link','Navigations.is_nav_type'])->order(['sort_order'=>'ASC']);
         $this->set([
            'message' => '',
            'data' => $navigations,
            '_serialize' => ['message','data']
        ]);
    }

}
