<?php
namespace CatalogManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockStatuses Model
 *
 * @property \CatalogManager\Model\Table\ProductsTable|\Cake\ORM\Association\HasMany $Products
 *
 * @method \CatalogManager\Model\Entity\StockStatus get($primaryKey, $options = [])
 * @method \CatalogManager\Model\Entity\StockStatus newEntity($data = null, array $options = [])
 * @method \CatalogManager\Model\Entity\StockStatus[] newEntities(array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\StockStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CatalogManager\Model\Entity\StockStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\StockStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\StockStatus findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StockStatusesTable extends Table
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

        $this->setTable('stock_statuses');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Products', [
            'foreignKey' => 'stock_status_id',
            'className' => 'CatalogManager.Products',
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
            ->maxLength('title', 150)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order');
        
        return $validator;
    }
}
