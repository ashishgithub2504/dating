<?php
namespace CmsManager\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;
/**
 * Navigations cell
 */
class NavigationsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }
    
    public function getParentMenus($id = null) {
        $records = TableRegistry::get('CmsManager.Navigations')->getParentMenuList($id);
        $this->set(compact('records','id'));
    }
    
    public function navigation($condition = array()){
        $conditions[] = ['Navigations.status' => 1];
        if(!empty($condition)){
            $conditions[] = $condition;
        }
        $nav_tree = TableRegistry::get('CmsManager.Navigations')->find("threaded")->select(['id','title','slug','parent_id','menu_link','is_nav_type'])->where($conditions)->order(['sort_order'=>'ASC'])->toArray();
        $this->set(compact('nav_tree'));
    }
    public function getPage($slug = NULL){
        $page = TableRegistry::get('CmsManager.Pages')->find()->where(['Pages.slug'=>$slug])->first();
        $this->set(compact('page'));
    }
    
}
