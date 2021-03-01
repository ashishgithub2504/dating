<?php
namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccountTypes Model
 *
 * @property \UserManager\Model\Table\UsersTable|\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \UserManager\Model\Entity\AccountType get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\AccountType newEntity($data = null, array $options = [])
 * @method \UserManager\Model\Entity\AccountType[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\AccountType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\AccountType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\AccountType[] patchEntities($entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\AccountType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccountTypesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('account_types');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Users', [
            'foreignKey' => 'account_type_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_account_types',
            'className' => 'UserManager.Users'
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        return $validator;
    }
}
