<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Playwins Model
 *
 * @property \App\Model\Table\PlaywinJoinTable|\Cake\ORM\Association\HasMany $PlaywinJoin
 *
 * @method \App\Model\Entity\Playwin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Playwin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Playwin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Playwin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Playwin saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Playwin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Playwin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Playwin findOrCreate($search, callable $callback = null, $options = [])
 */
class PlaywinsTable extends Table
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

        $this->setTable('playwins');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('PlaywinJoin', [
            'foreignKey' => 'playwin_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 155)
            ->requirePresence('name', 'create')
            ->allowEmpty('name', false);

        $validator
            ->integer('max')
            ->requirePresence('max', 'create')
            ->allowEmpty('max', false);

        $validator
            ->integer('coin')
            ->allowEmpty('coin');

        $validator
            ->integer('return_coin')
            ->allowEmpty('return_coin');

        $validator
            ->integer('win_coin')
            ->allowEmpty('win_coin');

        $validator
            ->scalar('comment')
            ->allowEmpty('comment');

        $validator
            ->scalar('status')
            ->allowEmpty('status');

        return $validator;
    }
}
