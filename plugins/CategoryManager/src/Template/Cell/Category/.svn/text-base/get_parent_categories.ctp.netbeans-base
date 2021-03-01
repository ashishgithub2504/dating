<?php
if (!empty($records)) {
    foreach ($records AS $key => $val) {
        if($key!=$id){
        $parentLinks[] = $this->Html->link($val, ['controller' => 'Categories','action' => 'view','plugin'=>'CategoryManager', $key]);
        }
    }
}
echo !empty($parentLinks) ? implode(' > ', $parentLinks)  : 'N/A';
