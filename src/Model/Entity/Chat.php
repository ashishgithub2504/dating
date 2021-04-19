<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chat Entity
 *
 * @property int $id
 * @property string $type
 * @property int $chat_to
 * @property int $chat_from
 * @property string $message
 * @property int|null $is_read
 * @property string|null $status
 */
class Chat extends Entity
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
        'type' => true,
        'chat_to' => true,
        'chat_from' => true,
        'message' => true,
        'is_read' => true,
        'status' => true
    ];
}
