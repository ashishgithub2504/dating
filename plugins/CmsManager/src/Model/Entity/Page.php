<?php
namespace CmsManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Page Entity
 *
 * @property int $id
 * @property string $title
 * @property string $sub_title
 * @property string $slug
 * @property string $short_description
 * @property string $description
 * @property string $banner
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Page extends Entity
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
        'sub_title' => true,
        'slug' => true,
        'short_description' => true,
        'description' => true,
        'banner' => true,
        'banner_file' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'status' => true,
        'created' => true,
        'modified' => true
    ];
}
