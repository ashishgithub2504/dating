<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Follower Entity
 *
 * @property int $id
 * @property int $follow_from
 * @property int $follow_to
 * @property string|null $status
 */
class Follower extends Entity
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
        'follow_from' => true,
        'follow_to' => true,
        'status' => true
    ];
}
