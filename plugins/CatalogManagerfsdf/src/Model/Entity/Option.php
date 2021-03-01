<?php
namespace CatalogManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Option Entity
 *
 * @property int $id
 * @property string $option_type
 * @property string $title
 * @property string $image
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \CatalogManager\Model\Entity\OptionValue[] $option_values
 */
class Option extends Entity
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
        'option_type' => true,
        'title' => true,
        'image' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'option_values' => true
    ];
}
