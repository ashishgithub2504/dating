<?php
namespace CatalogManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Options Model
 *
 * @property \CatalogManager\Model\Table\OptionValuesTable|\Cake\ORM\Association\HasMany $OptionValues
 *
 * @method \CatalogManager\Model\Entity\Option get($primaryKey, $options = [])
 * @method \CatalogManager\Model\Entity\Option newEntity($data = null, array $options = [])
 * @method \CatalogManager\Model\Entity\Option[] newEntities(array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Option|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CatalogManager\Model\Entity\Option patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Option[] patchEntities($entities, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Option findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OptionsTable extends Table
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

        $this->setTable('options');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('OptionValues', [
            'foreignKey' => 'option_id',
            'className' => 'CatalogManager.OptionValues',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]); 
        
        $this->hasMany('EventOptions', [
            'foreignKey' => 'option_id',
            'className' => 'CatalogManager.EventOptions',
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
            ->scalar('option_type')
            ->maxLength('option_type', 20)
            ->requirePresence('option_type', 'create')
            ->notEmpty('option_type');

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
}
