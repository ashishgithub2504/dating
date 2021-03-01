<?php
namespace CatalogManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attributes Model
 *
 * @property \CatalogManager\Model\Table\AttributeGroupsTable|\Cake\ORM\Association\BelongsTo $AttributeGroups
 *
 * @method \CatalogManager\Model\Entity\Attribute get($primaryKey, $options = [])
 * @method \CatalogManager\Model\Entity\Attribute newEntity($data = null, array $options = [])
 * @method \CatalogManager\Model\Entity\Attribute[] newEntities(array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Attribute|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CatalogManager\Model\Entity\Attribute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Attribute[] patchEntities($entities, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Attribute findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AttributesTable extends Table
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

        $this->setTable('attributes');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AttributeGroups', [
            'foreignKey' => 'attribute_group_id',
            'joinType' => 'INNER',
            'className' => 'CatalogManager.AttributeGroups'
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
        $rules->add($rules->existsIn(['attribute_group_id'], 'AttributeGroups'));

        return $rules;
    }
}
