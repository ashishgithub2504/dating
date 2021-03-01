<?php
namespace EmailManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailHook Entity
 *
 * @property int $id
 * @property string $title
 * @property string $hook
 * @property string $description
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EmailManager\Model\Entity\EmailTemplate[] $email_templates
 */
class EmailHook extends Entity
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
        'title' => true,
        'slug' => true,
        'description' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'email_templates' => true
    ];
}
