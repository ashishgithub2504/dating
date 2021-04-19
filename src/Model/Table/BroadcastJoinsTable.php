<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BroadcastJoins Model
 *
 * @property \App\Model\Table\BroadcastsTable|\Cake\ORM\Association\BelongsTo $Broadcasts
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\BroadcastJoin get($primaryKey, $options = [])
 * @method \App\Model\Entity\BroadcastJoin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BroadcastJoin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BroadcastJoin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BroadcastJoin saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BroadcastJoin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BroadcastJoin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BroadcastJoin findOrCreate($search, callable $callback = null, $options = [])
 */
class BroadcastJoinsTable extends Table
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

        $this->setTable('broadcast_joins');

        $this->belongsTo('Broadcasts', [
            'foreignKey' => 'broadcast_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['broadcast_id'], 'Broadcasts'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
