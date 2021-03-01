<?php

namespace CmsManager\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Custom helper
 */
class CustomHelper extends Helper {

    public $helpers = ['Html'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    function recurse($menus, $ulClass = NULL) {
        echo '<ul class="'.$ulClass.'">';
        foreach ($menus as $menu) {
            $json_url = json_decode($menu->menu_link, true);
            if (empty($json_url)) {
                $json_url = $menu->menu_link;
            }
             $childClass = '';
            if (!empty($menu->children)) {
                $childClass = "class='menu-has-children'";
                $aopt['data-toggle'] = 'dropdown';
                $aopt['class'] = 'dropdown-toggle waves-effect waves-dark';
                $json_url = 'javascript:void(0);';
            }else{
                unset($aopt);
                $aopt['class'] = 'waves-effect waves-dark';
               
            }
            echo "<li ". (isset($childClass)?$childClass:'') ." >";
            echo $this->Html->link($menu->title, $json_url,$aopt);
            if (!empty($menu->children)) {
                $this->recurse($menu->children , 'dropdown-menu');
            }
            echo "</li>";
        }
        echo '</ul>';
    }

}
