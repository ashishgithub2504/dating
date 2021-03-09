<?php
namespace App\Model\Entity;

// use Cake\ORM\Entity;
use Hayko\Mongodb\ORM\Entity;
/**
 * UserCallInfo Entity
 *
 * @property int $id
 * @property int $user_from
 * @property int $user_to
 * @property string $type
 * @property \Cake\I18n\FrozenTime|null $start_time
 * @property \Cake\I18n\FrozenTime|null $end_time
 * @property string|null $status
 */
class UserCallInfo extends Entity
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
        'type' => true,
        'start_time' => true,
        'end_time' => true,
        'status' => true
    ];
}
