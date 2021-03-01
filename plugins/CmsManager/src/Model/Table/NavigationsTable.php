<?php namespace CmsManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Navigations Model
 *
 * @property \CmsManager\Model\Table\NavigationsTable|\Cake\ORM\Association\BelongsTo $ParentNavigations
 * @property \CmsManager\Model\Table\ModulesTable|\Cake\ORM\Association\BelongsTo $Modules
 * @property \CmsManager\Model\Table\NavigationsTable|\Cake\ORM\Association\HasMany $ChildNavigations
 *
 * @method \CmsManager\Model\Entity\Navigation get($primaryKey, $options = [])
 * @method \CmsManager\Model\Entity\Navigation newEntity($data = null, array $options = [])
 * @method \CmsManager\Model\Entity\Navigation[] newEntities(array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Navigation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CmsManager\Model\Entity\Navigation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Navigation[] patchEntities($entities, array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Navigation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class NavigationsTable extends Table
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

        $this->setTable('navigations');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentNavigations', [
            'className' => 'CmsManager.Navigations',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Modules', [
            'foreignKey' => 'module_id',
            'className' => 'CmsManager.Modules'
        ]);
        $this->hasMany('ChildNavigations', [
            'className' => 'CmsManager.Navigations',
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('slug')
            ->allowEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('menu_link')
            ->requirePresence('menu_link', 'create')
            ->notEmpty('menu_link');

        $validator->add('is_bottom', 'manuRule', [
            'rule' => function ($data, $provider) {
                if (($data == 0) && ($provider['data']['is_top'] == 0 && $provider['data']['is_bottom'] == 0)) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            },
            'message' => __('Please choose position for this navigation.'),
        ]);

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        return $rules;
    }

    /** getParentMenuList method
     * 
     *
     * @param $id|int
     * @return all parent ids with title
     */
    public function getParentMenuList($id = null)
    {
        $records = [];
        if (!empty($id)) {
            $parents = $this->find('path', ['for' => $id])
                ->select(['id', 'title'])
                //->where(['id != ' => $id])
                ->toArray();
            foreach ($parents as $parent) {
                $records[$parent->id] = $parent->title;
            }
        }
        return $records;
    }
    
    /**
     * This metas function is a 'finder' to use for get Meta data for every moduled pages
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findPosition(Query $query, array $options)
    {
		$conditions = [];
        if(isset($options['is_bottom']) && !empty($options['is_bottom'])){
            $conditions['Navigations.is_bottom'] = $options['is_bottom'];
        }
        if(isset($options['is_top']) && !empty($options['is_top'])){
            $conditions['Navigations.is_top'] = $options['is_top'];
        }
        
        $query->where($conditions);
        return $query;
    }
}
