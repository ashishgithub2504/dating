<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Broadcasts Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Broadcast get($primaryKey, $options = [])
 * @method \App\Model\Entity\Broadcast newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Broadcast[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Broadcast|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Broadcast saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Broadcast patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Broadcast[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Broadcast findOrCreate($search, callable $callback = null, $options = [])
 */
class BroadcastsTable extends Table
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

        $this->setTable('broadcasts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 155)
            ->requirePresence('type', 'create')
            ->allowEmptyString('type', false);

        $validator
            ->scalar('channel_name')
            ->maxLength('channel_name', 155)
            ->requirePresence('channel_name', 'create')
            ->allowEmptyString('channel_name', false);

        $validator
            ->scalar('token')
            ->maxLength('token', 155)
            ->requirePresence('token', 'create')
            ->allowEmptyString('token', false);

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
