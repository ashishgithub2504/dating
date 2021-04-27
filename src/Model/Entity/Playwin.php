<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Playwin Entity
 *
 * @property int $id
 * @property string $name
 * @property int $max
 * @property int|null $coin
 * @property int|null $return_coin
 * @property int|null $win_coin
 * @property string|null $comment
 * @property string|null $status
 *
 * @property \App\Model\Entity\PlaywinJoin[] $playwin_join
 */
class Playwin extends Entity
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
        'name' => true,
        'max' => true,
        'coin' => true,
        'return_coin' => true,
        'win_coin' => true,
        'comment' => true,
        'status' => true,
        'playwin_join' => true
    ];
}
