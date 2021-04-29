<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserHistory Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_to
 * @property string|null $type
 * @property int $coin
 * @property string|null $status
 *
 * @property \App\Model\Entity\User $user
 */
class UserHistory extends Entity
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
        'user_id' => true,
        'user_to' => true,
        'type' => true,
        'coin' => true,
        'status' => true,
        'user' => true
    ];
}
