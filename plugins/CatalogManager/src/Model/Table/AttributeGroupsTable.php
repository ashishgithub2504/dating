<?php
namespace CatalogManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AttributeGroups Model
 *
 * @property \CatalogManager\Model\Table\AttributesTable|\Cake\ORM\Association\HasMany $Attributes
 *
 * @method \CatalogManager\Model\Entity\AttributeGroup get($primaryKey, $options = [])
 * @method \CatalogManager\Model\Entity\AttributeGroup newEntity($data = null, array $options = [])
 * @method \CatalogManager\Model\Entity\AttributeGroup[] newEntities(array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\AttributeGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CatalogManager\Model\Entity\AttributeGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\AttributeGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\AttributeGroup findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AttributeGroupsTable extends Table
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

        $this->setTable('attribute_groups');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Attributes', [
            'foreignKey' => 'attribute_group_id',
            'className' => 'CatalogManager.Attributes'
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
}
