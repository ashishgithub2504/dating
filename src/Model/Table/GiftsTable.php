<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Gifts Model
 *
 * @property |\Cake\ORM\Association\HasMany $UserGifts
 *
 * @method \App\Model\Entity\Gift get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gift newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Gift[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gift|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gift saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gift patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gift[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gift findOrCreate($search, callable $callback = null, $options = [])
 */
class GiftsTable extends Table
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
        $this->_dir = 'img' . DS . 'uploads' . DS . 'gifts' . DS;
        $this->setTable('gifts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('UserGifts', [
            'foreignKey' => 'gift_id'
        ]);

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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmpty('name', false);

        // $validator
        //     ->scalar('image')
        //     ->maxLength('image', 255)
        //     ->requirePresence('image', 'create')
        //     ->allowEmpty('image', false);

        $validator
            ->integer('coin')
            ->requirePresence('coin', 'create')
            ->allowEmpty('coin', false);

        $validator
            ->scalar('status')
            ->allowEmpty('status');

        return $validator;
    }
}
