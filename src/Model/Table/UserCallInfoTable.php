<?php
namespace Hayko\Mongodb\ORM;

// use Cake\ORM\Query;
// use Cake\ORM\RulesChecker;
// use Cake\ORM\Table;
// use Cake\Validation\Validator;
use Hayko\Mongodb\ORM\Table;
/**
 * UserCallInfo Model
 *
 * @method \App\Model\Entity\UserCallInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserCallInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserCallInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserCallInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserCallInfo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserCallInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserCallInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserCallInfo findOrCreate($search, callable $callback = null, $options = [])
 */
class UserCallInfoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    // public function initialize(array $config)
    // {
    //     parent::initialize($config);

    //     $this->setTable('user_call_info');
    //     $this->setDisplayField('id');
    //     $this->setPrimaryKey('id');
    // }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    // public function validationDefault(Validator $validator)
    // {
    //     $validator
    //         ->integer('id')
    //         ->allowEmptyString('id', 'create');

    //     $validator
    //         ->integer('user_from')
    //         ->requirePresence('user_from', 'create')
    //         ->allowEmptyString('user_from', false);

    //     $validator
    //         ->integer('user_to')
    //         ->requirePresence('user_to', 'create')
    //         ->allowEmptyString('user_to', false);

    //     $validator
    //         ->scalar('type')
    //         ->requirePresence('type', 'create')
    //         ->allowEmptyString('type', false);

    //     $validator
    //         ->dateTime('start_time')
    //         ->allowEmptyDateTime('start_time');

    //     $validator
    //         ->dateTime('end_time')
    //         ->allowEmptyDateTime('end_time');

    //     $validator
    //         ->scalar('status')
    //         ->allowEmptyString('status');

    //     return $validator;
    // }
}
