<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPlan Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $plan_id
 * @property int $amount
 * @property int $no_of_coin
 * @property string|null $status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Plan $plan
 */
class UserPlan extends Entity
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
        'plan_id' => true,
        'amount' => true,
        'no_of_coin' => true,
        'status' => true,
        'user' => true,
        'plan' => true
    ];
}
