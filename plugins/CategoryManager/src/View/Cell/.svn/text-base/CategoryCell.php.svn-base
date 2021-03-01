<?php
namespace CategoryManager\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Category cell
 */
class CategoryCell extends Cell
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
    
    public function getParentCategories($id = null) {
        $this->Categories = TableRegistry::get('CategoryManager.Categories');
        $records = $this->Categories->getParentCategoriesList($id);
        $this->set(compact('records','id'));
    }
    
}
