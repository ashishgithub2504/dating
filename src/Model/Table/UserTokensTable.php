<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserTokens Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserToken get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserToken newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserToken[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserToken|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserToken patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserToken[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserToken findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserTokensTable extends Table
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

        $this->setTable('user_tokens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
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
            ->scalar('user_type')
            ->maxLength('user_type', 255)
            ->requirePresence('user_type', 'create')
            ->notEmpty('user_type');

        $validator
            ->scalar('token_type')
            ->maxLength('token_type', 255)
            ->requirePresence('token_type', 'create')
            ->notEmpty('token_type');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        return $validator;
    }

   
	
	/**
     * This token function is a 'finder' to get user token info
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findToken(\Cake\ORM\Query $query, $options)
    {
	    $query
           ->where(['UserTokens.token' => $options['token'], 'UserTokens.user_type' => $options['user_type'], 'UserTokens.token_type' => $options['token_type']]);
        return $query;
    }
	
}
