<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserGifts Model
 *
 * @property \App\Model\Table\GiftsTable|\Cake\ORM\Association\BelongsTo $Gifts
 *
 * @method \App\Model\Entity\UserGift get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserGift newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserGift[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserGift|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserGift saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserGift patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserGift[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserGift findOrCreate($search, callable $callback = null, $options = [])
 */
class UserGiftsTable extends Table
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

        $this->setTable('user_gifts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Gifts', [
            'foreignKey' => 'gift_id',
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->integer('user_from')
            ->requirePresence('user_from', 'create')
            ->allowEmptyString('user_from', false);

        $validator
            ->integer('user_to')
            ->allowEmptyString('user_to');

        $validator
            ->integer('coin')
            ->allowEmptyString('coin');

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
        $rules->add($rules->existsIn(['gift_id'], 'Gifts'));

        return $rules;
    }
}
