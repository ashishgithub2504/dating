<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\AuditLogsTable|\Cake\ORM\Association\HasMany $AuditLogs
 * @property \App\Model\Table\UserTokensTable|\Cake\ORM\Association\HasMany $UserTokens
 * @property \App\Model\Table\AccountTypesTable|\Cake\ORM\Association\BelongsToMany $AccountTypes
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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
        $this->_dir = 'img' . DS . 'uploads' . DS . 'users' . DS;
        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->addBehavior('Upload', [
        //     'fields' => [
        //         'profile_photo' => [
        //             'path' => $this->_dir . ':name'
        //         ]
        //     ]
        //   ]
        // );

        $this->addBehavior('Timestamp');

        $this->hasMany('AuditLogs', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserTokens', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Chats', [
            'foreignKey' => 'user_to',
            'targetForeignKey' => 'user_to',
            'joinTable' => 'users'
        ]);
        $this->belongsToMany('AccountTypes', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'account_type_id',
            'joinTable' => 'users_account_types'
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
            ->scalar('first_name')
            ->maxLength('first_name', 100)
            ->requirePresence('first_name', 'create','First name is required')
            ->notEmpty('first_name');

        // $validator
        //     ->scalar('last_name')
        //     ->maxLength('last_name', 50)
        //     ->requirePresence('last_name', 'create')
        //     ->notEmpty('last_name');

        // $validator
        //     ->scalar('username')
        //     ->maxLength('username', 255)
        //     ->requirePresence('username', 'create')
        //     ->notEmpty('username')
        //     ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 15)
            ->requirePresence('mobile', 'create','Mobile number is required')
            ->notEmpty('mobile');
        

        $validator
            ->email('email')
            ->requirePresence('email', 'create','Email is required')
            ->notEmpty('email','Email should be entered')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => 'you have already registered']);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create','password should not be blank')
            ->notEmpty('password');

        
        // $validator
        //     ->scalar('profile_photo')
        //     ->maxLength('profile_photo', 255)
        //     ->requirePresence('profile_photo', 'create')
        //     ->notEmpty('profile_photo');

        $validator
            ->scalar('photo_dir')
            ->maxLength('photo_dir', 255)
            ->allowEmpty('photo_dir');

        $validator
            ->integer('photo_size')
            ->allowEmpty('photo_size');

        $validator
            ->scalar('photo_type')
            ->maxLength('photo_type', 250)
            ->allowEmpty('photo_type');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->boolean('is_verified')
            ->requirePresence('is_verified', 'create')
            ->notEmpty('is_verified');

        $validator
            ->integer('login_count')
            ->requirePresence('login_count', 'create')
            ->notEmpty('login_count');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
