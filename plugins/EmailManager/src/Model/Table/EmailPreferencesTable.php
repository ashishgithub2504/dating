<?php
namespace EmailManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailPreferences Model
 *
 * @property \EmailManager\Model\Table\EmailTemplatesTable|\Cake\ORM\Association\HasMany $EmailTemplates
 *
 * @method \EmailManager\Model\Entity\EmailPreference get($primaryKey, $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference newEntity($data = null, array $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference[] newEntities(array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference[] patchEntities($entities, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailPreferencesTable extends Table
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

        $this->setTable('email_preferences');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('EmailTemplates', [
            'foreignKey' => 'email_preference_id',
            'className' => 'EmailManager.EmailTemplates'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('layout_html')
            ->requirePresence('layout_html', 'create')
            ->notEmpty('layout_html');

        return $validator;
    }
}
