<?php
namespace AdminUserManager\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * AdminUser Entity
 *
 * @property int $id
 * @property string $name
 * @property string $mobile
 * @property \Cake\I18n\FrozenDate $dob
 * @property string $email
 * @property string $password
 * @property string $profile_photo
 * @property bool $status
 * @property bool $is_verified
 * @property int $login_count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \AdminUserManager\Model\Entity\Role[] $roles
 */
class AdminUser extends Entity
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
        'mobile' => true,
        'dob' => true,
        'email' => true,
        'password' => true,
        'profile_photo' => true,
		'profile_photo_file' => true,
        'status' => true,
        'is_verified' => true,
        'login_count' => true,
        'created' => true,
        'modified' => true,
        'roles' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
	
	protected function _setPassword($password) {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
