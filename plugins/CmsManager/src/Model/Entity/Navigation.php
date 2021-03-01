<?php
namespace CmsManager\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Navigation Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $parent_id
 * @property string $menu_link
 * @property int $module_id
 * @property int $lft
 * @property int $rght
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \CmsManager\Model\Entity\ParentNavigation $parent_navigation
 * @property \CmsManager\Model\Entity\Module $module
 * @property \CmsManager\Model\Entity\ChildNavigation[] $child_navigations
 */
class Navigation extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'slug' => true,
        'parent_id' => true,
        'menu_link' => true,
        'is_nav_type' => true,
        'module_id' => true,
        'page_id' => true,
        'lft' => true,
        'rght' => true,
        'status' => true,
        'sort_order' => true,
        'is_bottom' => true,
        'is_top' => true,
        'created' => true,
        'modified' => true,
        'parent_navigation' => true,
        'module' => true,
        'child_navigations' => true
    ];
    protected $_virtual = ['page_url'];
    
    protected function _getPageUrl()
    {
        if(isset($this->_properties['menu_link']) && !empty($this->_properties['menu_link'])){
        $json_url = json_decode($this->_properties['menu_link'], true);
            if (empty($json_url)) {
                $json_url = $this->_properties['menu_link'];
            } else {
                $json_url['prefix'] = FALSE;
            }
			$url = ltrim(Router::url($json_url), '/');
            return $url;
        }
        
    }
}
