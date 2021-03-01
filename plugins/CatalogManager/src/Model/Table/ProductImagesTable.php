<?php
namespace CatalogManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductImages Model
 *
 * @property \CatalogManager\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \CatalogManager\Model\Entity\ProductImage get($primaryKey, $options = [])
 * @method \CatalogManager\Model\Entity\ProductImage newEntity($data = null, array $options = [])
 * @method \CatalogManager\Model\Entity\ProductImage[] newEntities(array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\ProductImage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CatalogManager\Model\Entity\ProductImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\ProductImage[] patchEntities($entities, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\ProductImage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductImagesTable extends Table
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

        $this->setTable('product_images');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
            'className' => 'CatalogManager.Products'
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

        // $validator
        //     ->scalar('image')
        //     ->maxLength('image', 250)
        //     ->requirePresence('image', 'create')
        //     ->notEmpty('image');

        // $validator
        //     ->scalar('caption')
        //     ->maxLength('caption', 250)
        //     ->requirePresence('caption', 'create')
        //     ->notEmpty('caption');

        // $validator
        //     ->integer('sort_order')
        //     ->requirePresence('sort_order', 'create')
        //     ->notEmpty('sort_order');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }
}
