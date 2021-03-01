<?php namespace EmailManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailHooks Model
 *
 * @property \EmailManager\Model\Table\EmailTemplatesTable|\Cake\ORM\Association\HasMany $EmailTemplates
 *
 * @method \EmailManager\Model\Entity\EmailHook get($primaryKey, $options = [])
 * @method \EmailManager\Model\Entity\EmailHook newEntity($data = null, array $options = [])
 * @method \EmailManager\Model\Entity\EmailHook[] newEntities(array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailHook|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EmailManager\Model\Entity\EmailHook patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailHook[] patchEntities($entities, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailHook findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailHooksTable extends Table
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

        $this->setTable('email_hooks');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('EmailTemplates', [
            'foreignKey' => 'email_hook_id',
            'className' => 'EmailManager.EmailTemplates'
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
            ->notEmpty('title', 'Title is required field.');

        $validator
            ->allowEmpty('slug', 'Email Hook is required field.')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message'=>'Email Hook must be unique.']);

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description', 'Description is required field.');

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
}
