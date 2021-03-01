<?php
namespace CatalogManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OptionValues Model
 *
 * @property \CatalogManager\Model\Table\OptionsTable|\Cake\ORM\Association\BelongsTo $Options
 *
 * @method \CatalogManager\Model\Entity\OptionValue get($primaryKey, $options = [])
 * @method \CatalogManager\Model\Entity\OptionValue newEntity($data = null, array $options = [])
 * @method \CatalogManager\Model\Entity\OptionValue[] newEntities(array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\OptionValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CatalogManager\Model\Entity\OptionValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\OptionValue[] patchEntities($entities, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\OptionValue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OptionValuesTable extends Table
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

        $this->setTable('option_values');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Options', [
            'foreignKey' => 'option_id',
            'joinType' => 'INNER',
            'className' => 'CatalogManager.Options'
        ]);
        
        $this->belongsTo('EventOptionValue', [
            'foreignKey' => 'option_value_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.EventOptionValue'
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

   
        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order');

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
        $rules->add($rules->existsIn(['option_id'], 'Options'));

        return $rules;
    }
}
