<?php

namespace ContactManager\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use Cake\Mailer\MailerAwareTrait;

/**
 * Inquiries Model
 *
 * @method \ContactManager\Model\Entity\Inquiry get($primaryKey, $options = [])
 * @method \ContactManager\Model\Entity\Inquiry newEntity($data = null, array $options = [])
 * @method \ContactManager\Model\Entity\Inquiry[] newEntities(array $data, array $options = [])
 * @method \ContactManager\Model\Entity\Inquiry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ContactManager\Model\Entity\Inquiry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ContactManager\Model\Entity\Inquiry[] patchEntities($entities, array $data, array $options = [])
 * @method \ContactManager\Model\Entity\Inquiry findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InquiriesTable extends Table
{

    use MailerAwareTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('inquiries');
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
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('first_name')
                ->maxLength('first_name', 50, 'First name must be maximum 50 character long.')
                ->requirePresence('first_name', 'create')
                ->notEmpty('first_name', 'Please enter your first name here.');

        // $validator
        //         ->scalar('last_name')
        //         ->maxLength('last_name', 50, 'Last name must be maximum 50 character long.')
        //         ->requirePresence('last_name', 'create')
        //         ->notEmpty('last_name', 'Please enter your last name here.');

        $validator
                ->email('email')
                ->requirePresence('email', 'create')
                ->notEmpty('email', 'Please enter your email here.');

        $validator
                ->scalar('mobile')
                ->requirePresence('mobile', 'create')
                ->notEmpty('mobile', 'Please enter your mobile number here.')
                ->add('mobile', 'custom', [
                    'rule' => array('custom', '/^[0-9+]*$/i'),
                    'message' => __('Please enter a valid mobile number')
                ])
                ->add('mobile', 'lengthBetween', [
                    'rule' => ['lengthBetween', 4, 16],
                    'message' => 'Mobile Number must contain minimum 4 and maximum 16 characters'
        ]);

        $validator
                ->scalar('message')
                ->requirePresence('message', 'create')
                ->maxLength('message', 1000, 'Message must be maximum 1000 character long.')
                ->notEmpty('message', 'Please enter your message here.');

        return $validator;
    }

    public function afterSave(Event $event, EntityInterface $entity) {
        // $this->getMailer('Manu')->send('contactUs', [$entity]);
    }

}
