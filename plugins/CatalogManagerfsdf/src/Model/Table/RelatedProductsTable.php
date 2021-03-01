<?php
namespace CatalogManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RelatedProducts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Products
 * @property \Cake\ORM\Association\BelongsTo $Relateds
 *
 * @method \App\Model\Entity\RelatedProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\RelatedProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RelatedProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RelatedProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RelatedProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RelatedProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RelatedProduct findOrCreate($search, callable $callback = null, $options = [])
 */
class RelatedProductsTable extends Table
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

        $this->setTable('related_products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Relateds', [
			'className' => 'CatalogManager.Products',
            'foreignKey' => 'related_id',
            'joinType' => 'INNER'
        ]);
    }

  
   
}
