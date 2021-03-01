<?php
namespace CategoryManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $banner
 * @property string $short_description
 * @property string $description
 * @property int $sort_order
 * @property int $lft
 * @property int $rght
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \CategoryManager\Model\Entity\ParentCategory $parent_category
 * @property \CategoryManager\Model\Entity\ChildCategory[] $child_categories
 */
class Category extends Entity
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
        'parent_id' => true,
        'title' => true,
        'slug' => true,
        'image' => true,
        'banner' => true,
        'short_description' => true,
        'description' => true,
        'sort_order' => true,
        'lft' => true,
        'rght' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'parent_category' => true,
        'child_categories' => true
    ];
}
