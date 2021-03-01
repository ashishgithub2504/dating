<?php
namespace CatalogManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attribute Entity
 *
 * @property int $id
 * @property int $attribute_group_id
 * @property string $title
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \CatalogManager\Model\Entity\AttributeGroup $attribute_group
 */
class Attribute extends Entity
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
        'attribute_group_id' => true,
        'title' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'attribute_group' => true
    ];
}
