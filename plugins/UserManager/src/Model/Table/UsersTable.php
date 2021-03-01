<?php namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\File;

/**
 * Users Model
 *
 * @property \UserManager\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \UserManager\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \UserManager\Model\Table\UserTokensTable|\Cake\ORM\Association\HasMany $UserTokens
 * @property \UserManager\Model\Table\VenuesTable|\Cake\ORM\Association\HasMany $Venues
 * @property \UserManager\Model\Table\AccountTypesTable|\Cake\ORM\Association\BelongsToMany $AccountTypes
 *
 * @method \UserManager\Model\Entity\User get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \UserManager\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
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
        $this->_dir = 'webroot' . DS . 'img' . DS . 'uploads' . DS . 'users' . DS . 'photos' . DS;
        $this->setTable('users');
        $this->setDisplayField('display_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');


        $this->hasMany('UserTokens', [
            'foreignKey' => 'user_id',
            'className' => 'UserManager.UserTokens'
        ]);
        $this->hasMany('Venues', [
            'foreignKey' => 'user_id',
            'className' => 'UserManager.Venues'
        ]);
        $this->belongsToMany('AccountTypes', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'account_type_id',
            'joinTable' => 'users_account_types',
            'className' => 'UserManager.AccountTypes'
        ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'profile_photo' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'photo_dir', // defaults to `dir`
                    'size' => 'photo_size', // defaults to `size`
                    'type' => 'photo_type', // defaults to `type`
                ],
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                        $ext = pathinfo($data['name'], PATHINFO_EXTENSION);
                        return rand(100000,999999).time().rand(10000 , 99999).".".$ext;
                        //return strtolower(str_replace(" ","",$data['name']));
                },
                'path' => $this->_dir.'{month}'. DS,
                'keepFilesOnDelete' => false
            ],
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
            // ->requirePresence('first_name', 'create', 'First Name is required field.')
            ->allowEmpty('first_name');
            // ->notEmpty('first_name', 'First Name is required field.');

        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create', 'User Name is required field.')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message'=>'Your username already registered with us. Try with another username.'])
            ->notEmpty('username', 'User Name is required field.');


        // $validator
        //     ->date('dob')
        //     ->allowEmpty('dob');
        
        
        $validator
            ->allowEmpty('profile_photo');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 20)
            ->allowEmpty('mobile');

        $validator
            ->email('email')
            ->requirePresence('email', 'create', 'Email is required field.')
            ->allowEmpty('email')
            ->notEmpty('email', 'Email is required field.')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message'=>'Your email already registered with us.']);

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    public function validationResetpassword()
    {
        $obj = new \App\Model\Validation\PasswordValidator;
        return $obj->validations;
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
        $rules->add(function ($entity, $options) use($rules) {
            if (isset($entity->account_types)) {
                $rule = $rules->validCount('account_types', 1, '>=', 'You must have at least 1 role');

                return $rule($entity, $options);
            }
            return TRUE;
        },'validCount');
        return $rules;
    }

    public function findFilter(Query $query, array $options)
    {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                $conc = $q->func()->concat(['Users.first_name' => 'identifier', ' ', 'Users.last_name' => 'identifier']);
                return $exp->or_([
                        'Users.first_name LIKE' => '%' . trim($options['keyword']) . '%',
                        'Users.last_name LIKE' => '%' . trim($options['keyword']) . '%',
                        'Users.email LIKE' => '%' . trim($options['keyword']) . '%',
                    ])->like($conc, '%' . trim($options['keyword']) . '%');
            });
        }
        
        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Users.status' => $options['status']]);
        }
        if (isset($options['is_verified']) && $options['is_verified'] != "") {
            $query->where(['Users.is_verified' => $options['is_verified']]);
        }
        if (isset($options['account_type_id']) && $options['account_type_id'] != "") {
            $query->innerJoinWith('AccountTypes', function($q) use($options) {
                return $q->where(['AccountTypes.id' => $options['account_type_id']]);
            });
        }
        return $query;
    }

    public function findWithInDate(Query $query, array $options)
    {
        if ((isset($options['start_date']) && !empty($options['start_date'])) && (isset($options['end_date']) && !empty($options['end_date']))) {
            $query->where(function ($exp) use($options) {
                return $exp->gte("DATE(Users.created)", $options['start_date'])->lte("DATE(Users.created)", $options['end_date']);
            });
        }
        if ((isset($options['start_date']) && !empty($options['start_date'])) && (empty($options['end_date']))) {
            $query->where(function ($exp) use($options) {
                return $exp->eq("DATE(Users.created)", $options['start_date']);
            });
        }
        return $query;
    }
    
    public function findActive(Query $query)
    {
        $query->where(['Users.status' => 1, 'Users.is_verified' => 1]);
        return $query;
    }

   
    public function beforeMarshal(Event $event, ArrayObject $data)
    {
        $trim_ar = ['first_name', 'last_name',  'email', 'mobile'];
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

//    public function afterSave(Event $event, EntityInterface $entity)
//    {
//        if ($entity->isNew()) {
//                 //$this->getMailer('Manu')->send('welcome', [$entity]);
//        } else {
//            if ($entity->get('email') != $entity->getOriginal('email')) {
//                //$this->getMailer('Manu')->send('welcome', [$entity]);
//            }
//        }
//    }
    
    public function afterSave(Event $event, EntityInterface $entity)
    {
        
         if ($entity->isNew() || ($entity->get('email') != $entity->getOriginal('email'))) {
                $uid = \Cake\Utility\Text::uuid();
                $data = $entity->toArray();
                $uinfo = $data;
                // $uinfo['USER_NAME'] = $data['first_name']; //. " ".$data['last_name'];
                $uinfo['USER_INFO'] = "";
                $uinfo['verify_n_password'] = \Cake\Routing\Router::url(['controller' => 'AdminUsers', 'action' => 'verifyaccount','plugin'=>'AdminUserManager',$uid], true);
                $user_type = "users";
                $token_type = "account_confirmation";
                $_usertoken = TableRegistry::get('UserTokens')->newEntity();
                $_usertoken->user_id = $entity->id;
                $_usertoken->user_type = $user_type;
                $_usertoken->token_type = $token_type;
                $_usertoken->token = $uid;
                TableRegistry::get('UserTokens')->save($_usertoken);
                // \EmailQueue\EmailQueue::enqueue([$entity->email], $uinfo, ['template'=>'user-welcome-email']);
         }
        
//        if ($entity->isNew()) {
//            $this->getMailer('Manu')->send('welcome', [$entity]);
//        } else {
//            if ($entity->get('email') != $entity->getOriginal('email')) {
//                $this->getMailer('Manu')->send('welcome', [$entity]);
//            }
//        }
    }
}
