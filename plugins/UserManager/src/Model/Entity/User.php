<?php
namespace UserManager\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $display_name
 * @property int $age
 * @property \Cake\I18n\FrozenDate $dob
 * @property string $town
 * @property int $state_id
 * @property int $country_id
 * @property string $zipcode
 * @property string $mobile
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $banner
 * @property string $profile_photo
 * @property int $status
 * @property bool $is_verified
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $fake_pass
 *
 * @property \UserManager\Model\Entity\State $state
 * @property \UserManager\Model\Entity\Country $country
 * @property \UserManager\Model\Entity\UserToken[] $user_tokens
 * @property \UserManager\Model\Entity\Venue[] $venues
 * @property \UserManager\Model\Entity\AccountType[] $account_types
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
        'username' => true,
        'first_name' => true,
        'last_name' => true,
        'display_name' => true,
        'age' => true,
        'dob' => true,
        'town' => true,
        'mobile' => true,
        'email' => true,
        'password' => true,
        'banner' => true,
        'profile_photo' => true,
        'profile_photo_file' => true,
		'photo_dir' => true,
		'photo_size' => true,
		'photo_type' => true,
        'eye_color' => true,
        'hair_color' => true,
        'country' => true,
        'state' => true,
        'height' => true,
        'status' => true,
        'is_verified' => true,
        'audio_call_rate' => true,
        'video_call_rate' => true,
        'sex' => true,
        'about_us' => true,
        'created' => true,
        'modified' => true,
        'fake_pass' => true,
        'user_tokens' => true,
        'fcm_Token' => true,
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
