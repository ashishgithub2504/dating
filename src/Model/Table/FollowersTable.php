<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Followers Model
 *
 * @method \App\Model\Entity\Follower get($primaryKey, $options = [])
 * @method \App\Model\Entity\Follower newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Follower[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Follower|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Follower saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Follower patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Follower[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Follower findOrCreate($search, callable $callback = null, $options = [])
 */
class FollowersTable extends Table
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

        $this->setTable('followers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->integer('follow_from')
            ->requirePresence('follow_from', 'create')
            ->allowEmptyString('follow_from', false);

        $validator
            ->integer('follow_to')
            ->requirePresence('follow_to', 'create')
            ->allowEmptyString('follow_to', false);

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        return $validator;
    }
}
