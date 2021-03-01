<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $mobile
 * @property \Cake\I18n\FrozenDate $dob
 * @property string $email
 * @property string $password
 * @property string $fake_pass
 * @property string $profile_photo
 * @property string $photo_dir
 * @property int $photo_size
 * @property string $photo_type
 * @property bool $status
 * @property bool $is_verified
 * @property int $login_count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\AuditLog[] $audit_logs
 * @property \App\Model\Entity\UserToken[] $user_tokens
 * @property \App\Model\Entity\AccountType[] $account_types
 */
class User extends Entity
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
        'username' => true,
        'mobile' => true,
        'dob' => true,
        'email' => true,
        'password' => true,
        'fake_pass' => true,
        'profile_photo' => true,
        'photo_dir' => true,
        'photo_size' => true,
        'photo_type' => true,
        'status' => true,
        'is_verified' => true,
        'login_count' => true,
        'created' => true,
        'modified' => true,
        'audit_logs' => true,
        'user_tokens' => true,
        'account_types' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected $_virtual = ['image_path'];
    
    protected function _setPassword($password) {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
    
    protected function _getName()
    {
        return $this->_properties['first_name'] . '  ' . $this->_properties['last_name'];
    }
    
    protected function _getImagePath()
    {
        if(isset($this->_properties['photo_dir'])){
            return str_replace("\\", "/", str_replace("webroot\img\\","", $this->_properties['photo_dir']));
        }
    }
}
