<?php
namespace BannerManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * BannerImage Entity
 *
 * @property int $id
 * @property int $banner_id
 * @property string $title
 * @property string $description
 * @property string $external_link
 * @property string $image
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \BannerManager\Model\Entity\Banner $banner
 */
class BannerImage extends Entity
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
        'banner_id' => true,
        'title' => true,
        'description' => true,
        'external_link' => true,
        'image' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'banner' => true
    ];
}
