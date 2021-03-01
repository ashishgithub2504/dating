<?php
namespace EmailManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailTemplates Model
 *
 * @property \EmailManager\Model\Table\EmailHooksTable|\Cake\ORM\Association\BelongsTo $EmailHooks
 * @property \EmailManager\Model\Table\EmailPreferencesTable|\Cake\ORM\Association\BelongsTo $EmailPreferences
 *
 * @method \EmailManager\Model\Entity\EmailTemplate get($primaryKey, $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate newEntity($data = null, array $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate[] newEntities(array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate[] patchEntities($entities, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailTemplatesTable extends Table
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

        $this->setTable('email_templates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EmailHooks', [
            'foreignKey' => 'email_hook_id',
            'joinType' => 'INNER',
            'className' => 'EmailManager.EmailHooks'
        ]);
        $this->belongsTo('EmailPreferences', [
            'foreignKey' => 'email_preference_id',
            'joinType' => 'INNER',
            'className' => 'EmailManager.EmailPreferences'
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
            ->notEmpty('email_hook_id','Email Hook is required field.')
            ->add('email_hook_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => 'Email Hook is not unique enough']);
        
        $validator
            ->scalar('subject')
            ->requirePresence('subject', 'create')
            ->notEmpty('subject','Subject is required field.');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description','Description is required field.');

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
        $rules->add($rules->existsIn(['email_hook_id'], 'EmailHooks'));
        $rules->add($rules->existsIn(['email_preference_id'], 'EmailPreferences'));

        return $rules;
    }
	
	
	/**
     * This hook function is a 'finder' to use for get email template
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findHook(\Cake\ORM\Query $query, $options)
    {
	    $query
            ->contain(['EmailHooks' => function($q) use($options){
				return $q->where(['EmailHooks.slug' => $options['slug'],'EmailHooks.status' => 1]);
			},'EmailPreferences']);
          return $query;
    }
	
}
