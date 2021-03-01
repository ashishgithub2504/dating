<?php
namespace AdminUserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \AdminUserManager\Model\Table\AdminUsersTable|\Cake\ORM\Association\HasMany $AdminUsers
 *
 * @method \AdminUserManager\Model\Entity\Role get($primaryKey, $options = [])
 * @method \AdminUserManager\Model\Entity\Role newEntity($data = null, array $options = [])
 * @method \AdminUserManager\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\Role|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminUserManager\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\Role[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\Role findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RolesTable extends Table
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

        $this->setTable('roles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AdminUsers', [
            'foreignKey' => 'role_id',
            'className' => 'AdminUserManager.AdminUsers'
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
