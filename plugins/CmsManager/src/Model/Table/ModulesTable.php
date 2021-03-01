<?php namespace CmsManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * Modules Model
 *
 * @property \CmsManager\Model\Table\MenusTable|\Cake\ORM\Association\HasMany $Menus
 *
 * @method \CmsManager\Model\Entity\Module get($primaryKey, $options = [])
 * @method \CmsManager\Model\Entity\Module newEntity($data = null, array $options = [])
 * @method \CmsManager\Model\Entity\Module[] newEntities(array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Module|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CmsManager\Model\Entity\Module patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Module[] patchEntities($entities, array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Module findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ModulesTable extends Table
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

        $this->setTable('modules');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('controller')
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->scalar('action')
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        $validator
            ->scalar('json_path')
            ->requirePresence('json_path', 'create')
            ->notEmpty('json_path');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    /**
     * before marshal used for trim whitspace for all form element
     *
     * @param Cake\Event\Event; $event .
     * @param type $data Options Array
     * @return \Cake\ORM\Query
     */
    public function beforeMarshal(Event $event, ArrayObject $data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
        }
        $data['plugin'] = $data['plugin'] ? $data['plugin'] : NULL;
        $data['json_path'] = json_encode(['plugin' => $data['plugin'], 'controller' => $data['controller'], 'action' => $data['action']]);
    }
    
    /**
     * This metas function is a 'finder' to use for get Meta data for every moduled pages
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findMetas(Query $query, array $options)
    {
		$conditions = [];
        if(isset($options['controller'])){
            $conditions['Modules.controller'] = $options['controller'];
        }
        if(isset($options['action'])){
            $conditions['Modules.action'] = $options['action'];
        }
        if(isset($options['plugin'])){
            $conditions['Modules.plugin'] = $options['plugin'];
        }
        $query->where($conditions);
        return $query;
    }
}
