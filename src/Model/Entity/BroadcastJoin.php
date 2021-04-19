<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BroadcastJoin Entity
 *
 * @property int $broadcast_id
 * @property int $user_id
 * @property string|null $status
 *
 * @property \App\Model\Entity\Broadcast $broadcast
 * @property \App\Model\Entity\User $user
 */
class BroadcastJoin extends Entity
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
        'broadcast_id' => true,
        'user_id' => true,
        'status' => true,
        'broadcast' => true,
        'user' => true
    ];
}
