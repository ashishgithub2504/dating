<?php
namespace AdminUserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use Cake\Filesystem\File;
use Cake\ORM\TableRegistry;
/**
 * AdminUsers Model
 *
 * @property \AdminUserManager\Model\Table\RolesTable|\Cake\ORM\Association\BelongsToMany $Roles
 *
 * @method \AdminUserManager\Model\Entity\AdminUser get($primaryKey, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser newEntity($data = null, array $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser[] newEntities(array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdminUsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
	public $_dir; 
    public function initialize(array $config)
    {
		parent::initialize($config);
		$this->_dir = 'img' . DS . 'uploads' . DS . 'admin_users' . DS . 'photos' . DS;
        $this->setTable('admin_users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Roles', [
            'foreignKey' => 'admin_user_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'admin_users_roles',
            'className' => 'AdminUserManager.Roles'
        ]);
        $this->addBehavior('AuditStash.AuditLog');
        $this->behaviors()->get('AuditLog')->persister()->config([
                'extractMetaFields' => [
                    'user.id' => 'user_id',
                ]
            ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmpty('name');


        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

       
        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
	
	public function validationResetpassword()
    {
        $obj = new \App\Model\Validation\PasswordValidator;
        return $obj->validations;
    }

    public function validationUpdate()
    {
        $validatorObj = new \App\Model\Validation\PasswordValidator(true);
        $validator = $this->validationDefault($validatorObj->password());
        $validator
            ->notEmpty('mobile', 'Mobile number is required')
            ->add('mobile', [
                'maxLength' => [
                    'rule' => ['maxLength', 14],
                    'message' => 'phone number is too long. The limit is 14 characters..'
                ],
                'custom' => [
                    'rule' => ['numeric'],
                    'on' => function($context) {
                    return !empty($context['data']['mobile']);
                },
                    'message' => 'Invalid phone number! phone number format: eg 0-9'
                ]
        ]);

        $validator
            ->requirePresence('profile_photo_file', 'create')
            ->allowEmpty('profile_photo_file')
            ->add('profile_photo_file', [
                'fileSize' => [
                    'rule' => ['fileSize', '<=', '1mb'],
                    'last' => true,
                    'message' => __('Wrong file size. File size must be below 500 kb.')
                ],
                'validExtension' => [
                    'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('These files extension are allowed: .jpeg, .jpg, .gif, .png')
                ]
        ]);
        return $validator;
    }
	
	

    public function beforeMarshal(Event $event, ArrayObject $data)
    {
        $trim_ar = ['name', 'email'];
        foreach ($data as $key => $value) {
            if (in_array($key, $trim_ar)) {
                $data[$key] = trim($value);
            }
        };
    }

    public function beforeSave(Event $event, EntityInterface $entity)
    {
        if (!$entity->isNew()) {
            if ($entity->get('email') != $entity->getOriginal('email')) {
                $entity->set("is_verified", 0);
            }
        }
    }

    public function afterSave(Event $event, EntityInterface $entity)
    {
        
         if ($entity->isNew() || ($entity->get('email') != $entity->getOriginal('email'))) {
                $uid = \Cake\Utility\Text::uuid();
                $data = $entity->toArray();
                $uinfo = $data;
                $uinfo['USER_NAME'] = $data['name'];
                $uinfo['USER_INFO'] = "";
                $uinfo['verify_n_password'] = \Cake\Routing\Router::url(['controller' => 'AdminUsers', 'action' => 'verifyaccount','plugin'=>'AdminUserManager',$uid], true);
                $user_type = "admin_user";
                $token_type = "account_confirmation";
                $_usertoken = TableRegistry::get('UserTokens')->newEntity();
                $_usertoken->user_id = $entity->id;
                $_usertoken->user_type = $user_type;
                $_usertoken->token_type = $token_type;
                $_usertoken->token = $uid;
                //TableRegistry::get('UserTokens')->save($_usertoken);
                //\EmailQueue\EmailQueue::enqueue([$entity->email], $uinfo, ['template'=>'welcome-email']);
                $data = [
                    'settings' => [
                        'to' => $entity->get('email'),
                        'from' => 'jainashish2504@gmail.com',
                    ],
                    'hooks' => 'welcome-email',
                    'hooksVars' => $uinfo,
                ];
            $queuedJobsTable = TableRegistry::get('Queue.QueuedJobs');
            $queuedJobsTable->createJob('Email', $data);
         }
         
    }
	
	/**
     * This auth function is a 'finder' to use in login with auth component
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findAuth(\Cake\ORM\Query $query)
    {
        $query
            ->select(['AdminUsers.id', 'AdminUsers.name', 'AdminUsers.email', 'AdminUsers.mobile', 'AdminUsers.password', 'AdminUsers.status', 'AdminUsers.login_count', 'AdminUsers.profile_photo', 'AdminUsers.is_verified', 'AdminUsers.created'])
            ->contain(['Roles']);
        return $query;
    }
	
	
	/**
     * This filters function is a 'finder' to use in the Index pages searching
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findFilters(Query $query, array $options)
    {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                return $exp->or_([
                        'AdminUsers.name LIKE' => '%' . trim($options['keyword']) . '%',
                        'AdminUsers.email LIKE' => '%' . trim($options['keyword']) . '%',
                        'AdminUsers.mobile LIKE' => '%' . trim($options['keyword']) . '%',
                    ]);
            });
        }
      
        return $query;
    }

    public function deleteImage($image = '', $record = null)
    {
        if (!empty($image)) {
            $file = new File($this->_dir . $image, false);
            if ($file->exists()) {
                $file->delete();
            }
        }
        if (!empty($record)) {
            $record->profile_photo = '';
            return $this->save($record);
        }
        return true;
    }
}
