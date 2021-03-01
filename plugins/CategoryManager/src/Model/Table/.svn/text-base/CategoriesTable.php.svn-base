<?php
namespace CategoryManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Cache\Cache;

/**
 * Categories Model
 *
 * @property \CategoryManager\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $ParentCategories
 * @property \CategoryManager\Model\Table\CategoriesTable|\Cake\ORM\Association\HasMany $ChildCategories
 *
 * @method \CategoryManager\Model\Entity\Category get($primaryKey, $options = [])
 * @method \CategoryManager\Model\Entity\Category newEntity($data = null, array $options = [])
 * @method \CategoryManager\Model\Entity\Category[] newEntities(array $data, array $options = [])
 * @method \CategoryManager\Model\Entity\Category|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CategoryManager\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CategoryManager\Model\Entity\Category[] patchEntities($entities, array $data, array $options = [])
 * @method \CategoryManager\Model\Entity\Category findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class CategoriesTable extends Table
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

        $this->setTable('categories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentCategories', [
            'className' => 'CategoryManager.Categories',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildCategories', [
            'className' => 'CategoryManager.Categories',
            'foreignKey' => 'parent_id'
        ]);
        
        $this->addBehavior('Slug', [
            'field' => 'slug',
            'otherField' => 'title'
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
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

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
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order');

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

        return $validator;
    }
    
    
    /**
     * getParentCategoriesList method
     *
     * @param string $id The record id to get parent records
     * @param type $options Options Array
     * @return array key value pair of parent records
     */
    public function getParentCategoriesList($id = null) {
        $records = [];
        if (!empty($id)) {
            $parents = $this->find('path', ['for' => $id])
                    ->select(['id', 'title'])
                    //->where(['id != ' => $id])
                    ->toArray();
            
            if (!empty($parents)) {
                foreach ($parents as $parent) {
                    $records[$parent->id] = $parent->title;
                }
            }
        }
        return $records;
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentCategories'));

        return $rules;
    }
    
    /**
     * Return a query with where clause 
     * 
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findFilter(Query $query, array $options)
    {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                return $exp->or_([
                        'Categories.title LIKE' => '%' . trim($options['keyword']) . '%',
                    ]);
            });
        }
        
        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Categories.status' => $options['status']]);
        }
        if (isset($options['parent_id']) && $options['parent_id'] != "") {
            $childrens = $this->find('children', ['for' => $options['parent_id']])->find('list',['keyField' => 'id', 'valueField' => 'id'])->toArray();
            $childrens[] = $options['parent_id'];
             $query->where(function ($exp, $q) use($childrens) {
                return $exp->in('Categories.id', $childrens);
            });
        }
        
        return $query;
    }
    
    public function afterSave(Event $event, EntityInterface $entity)
    {
        if (!$entity->isNew()) {
            Cache::clear(false);
        } 
    }
}
