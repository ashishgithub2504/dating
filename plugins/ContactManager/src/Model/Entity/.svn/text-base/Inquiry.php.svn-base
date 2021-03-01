<?php

namespace ContactManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inquiry Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $mobile
 * @property string $message
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Inquiry extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'mobile' => true,
        'message' => true,
        'created' => true,
        'modified' => true
    ];

    protected function _getName() {
        return $this->_properties['first_name'] . '  ' . $this->_properties['last_name'];
    }

}
