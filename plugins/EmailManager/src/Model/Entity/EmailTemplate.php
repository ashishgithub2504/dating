<?php
namespace EmailManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailTemplate Entity
 *
 * @property int $id
 * @property int $email_hook_id
 * @property string $subject
 * @property string $description
 * @property string $footer_text
 * @property int $email_preference_id
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EmailManager\Model\Entity\EmailHook $email_hook
 * @property \EmailManager\Model\Entity\EmailPreference $email_preference
 */
class EmailTemplate extends Entity
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
        'email_hook_id' => true,
        'subject' => true,
        'description' => true,
        'footer_text' => true,
        'email_preference_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'email_hook' => true,
        'email_preference' => true
    ];
}
