<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserRatings Model
 *
 * @method \App\Model\Entity\UserRating get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserRating newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserRating[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserRating|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserRating saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserRating patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserRating[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserRating findOrCreate($search, callable $callback = null, $options = [])
 */
class UserRatingsTable extends Table
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

        $this->setTable('user_ratings');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->requirePresence('user_from', 'create')
            ->allowEmptyString('user_from', false);

        $validator
            ->requirePresence('user_to', 'create')
            ->allowEmptyString('user_to', false);

        $validator
            ->scalar('rating')
            ->maxLength('rating', 255)
            ->requirePresence('rating', 'create')
            ->allowEmptyString('rating', false);

        $validator
            ->scalar('comment')
            ->requirePresence('comment', 'create')
            ->allowEmptyString('comment', false);

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        return $validator;
    }
}
