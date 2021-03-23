<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserGift Entity
 *
 * @property int $id
 * @property int $user_from
 * @property int|null $user_to
 * @property int $gift_id
 * @property int|null $coin
 * @property string|null $status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Gift $gift
 */
class UserGift extends Entity
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
        'user_from' => true,
        'user_to' => true,
        'gift_id' => true,
        'coin' => true,
        'status' => true,
        'user' => true,
        'gift' => true
    ];
}
