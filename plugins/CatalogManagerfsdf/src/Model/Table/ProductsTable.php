<?php
namespace CatalogManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use ArrayObject;
use Cake\Filesystem\File;
/**
 * Products Model
 *
 * @property \CatalogManager\Model\Table\StockStatusesTable|\Cake\ORM\Association\BelongsTo $StockStatuses
 * @property \CatalogManager\Model\Table\ProductDiscountsTable|\Cake\ORM\Association\HasMany $ProductDiscounts
 * @property \CatalogManager\Model\Table\ProductImagesTable|\Cake\ORM\Association\HasMany $ProductImages
 * @property \CatalogManager\Model\Table\ProductOptionsTable|\Cake\ORM\Association\HasMany $ProductOptions
 * @property \CatalogManager\Model\Table\ProductSpecialsTable|\Cake\ORM\Association\HasMany $ProductSpecials
 * @property \CatalogManager\Model\Table\RelatedProductsTable|\Cake\ORM\Association\HasMany $RelatedProducts
 * @property \CatalogManager\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsToMany $Categories
 * @property \CatalogManager\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \CatalogManager\Model\Entity\Product get($primaryKey, $options = [])
 * @method \CatalogManager\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \CatalogManager\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CatalogManager\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \CatalogManager\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public $_dir;
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->_dir = 'img' . DS . 'uploads' . DS . 'products' . DS;
        $this->setTable('products');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('StockStatuses', [
            'foreignKey' => 'stock_status_id',
            'className' => 'CatalogManager.StockStatuses',
            'sort' => ['CatalogManager.StockStatuses.sort_order' => 'ASC']
        ]);
        $this->hasMany('ProductDiscounts', [
            'foreignKey' => 'product_id',
            'className' => 'CatalogManager.ProductDiscounts'
        ]);
        $this->hasMany('ProductImages', [
            'foreignKey' => 'product_id',
            'className' => 'CatalogManager.ProductImages'
        ]);
        $this->hasMany('ProductOptions', [
            'foreignKey' => 'product_id',
            'className' => 'CatalogManager.ProductOptions'
        ]);
        $this->hasMany('ProductSpecials', [
            'foreignKey' => 'product_id',
            'className' => 'CatalogManager.ProductSpecials'
        ]);
        $this->hasMany('RelatedProducts', [
            'foreignKey' => 'product_id',
			'className' => 'CatalogManager.Products'
        ]);
        $this->hasMany('RelatedProducts', [
            'foreignKey' => 'product_id',
            'className' => 'CatalogManager.RelatedProducts'
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'products_categories',
            'className' => 'CategoryManager.Categories'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'products_tags',
            'className' => 'CatalogManager.Tags'
        ]);
        
        $this->addBehavior('Slug', [
            'field' => 'slug',
            'otherField' => 'title'
            ]
        );
        
        $this->addBehavior('Upload', [
            'fields' => [
                'image' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
          ]
        );
        
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
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 250)
            ->requirePresence('slug', 'create')
            ->allowEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('model')
            ->maxLength('model', 61)
            ->requirePresence('model', 'create')
            ->notEmpty('model');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 64)
            ->allowEmpty('sku');

        $validator
            ->scalar('upc')
            ->maxLength('upc', 64)
            ->allowEmpty('upc');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->integer('minimum_quantity')
            ->requirePresence('minimum_quantity', 'create')
            ->notEmpty('minimum_quantity');

        $validator
            ->scalar('short_description')
            ->maxLength('short_description', 255)
            ->requirePresence('short_description', 'create')
            ->notEmpty('short_description');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
                ->requirePresence('image_file', 'create')
                ->allowEmpty('image_file')
                ->add('image_file', [
                    'fileSize' => [
                        'rule' => ['fileSize', '<=', '1mb'],
                        'last' => true,
                        'message' => __('Wrong file size. File size must be below 500 kb.')
                    ],
                    'validExtension' => [
                        'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']], // default  ['gif', 'jpeg', 'png', 'jpg']
                        'message' => __('These files extension are allowed: .jpeg, .jpg, .gif, .png')
                    ]
        ]);

        $validator
            ->scalar('meta_title')
            ->maxLength('meta_title', 255)
            ->requirePresence('meta_title', 'create')
            ->notEmpty('meta_title');

        $validator
            ->scalar('meta_keyword')
            ->maxLength('meta_keyword', 255)
            ->requirePresence('meta_keyword', 'create')
            ->notEmpty('meta_keyword');

        $validator
            ->scalar('meta_description')
            ->requirePresence('meta_description', 'create')
            ->notEmpty('meta_description');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['stock_status_id'], 'StockStatuses'));

        return $rules;
    }
    
    public function afterSave(Event $event, EntityInterface $entity, ArrayObject $options) {
		$dir = "img/tmp/";
		if(!empty($entity->product_images)){
			$is_dest = str_replace("\\", "/", $this->_dir).$entity->id."/";
			    if (!file_exists($is_dest)) {
                    mkdir($is_dest, 0777, true);
                }
				
				foreach ($entity->product_images as $limage) {
                    if (file_exists($dir . $limage->image) && ($limage->image != "")) {
                        rename($dir . $limage->image, $is_dest . $limage->image);
                    }
                }
		}
		//pr($entity);die;
	}
	
	public function deleteImage($image = '', $record = null) {
        if (!empty($image)) {
            $file = new File($this->_dir . $image, false);
            if ($file->exists()) {
                $file->delete();
            }
        }
        if (!empty($record)) {
            $record->banner = '';
            return $this->save($record);
        }
        return true;
    }
}
